<?php

	require('res/php/config.php');
	require('res/php/components/admin-nav.php');
	require('res/php/class.upload.php');
	require('res/php/delete-directory.php');

	if($user->is_loggedin() == "")
	{
	 $user->redirect('index.php');
	}

$error = array();
$success = array();

if(isset($_POST['new-image-upload']) && isset($_GET['gallery'])){
	try{

			$galleryId = intval($_GET['gallery']);
			$galleryQuery = $DB_con->prepare("SELECT `gallery_name` FROM `gallery_thumb` WHERE `id` = ? ");
			$galleryQuery->execute(array($galleryId)); 
			if($galleryQuery->rowCount() == 0){
					throw new RuntimeException('"Gallery with this id is not found"');
			}

			$NewImage = $_FILES['new-gallery'];

			if (!isset($NewImage['error']) || is_array($NewImage['error'])) {
					throw new RuntimeException('Invalid parameters.');
			}

			// Check $_FILES['grid-pic-'.$i]['error'] value.
			switch ($NewImage['error']) {
					case UPLOAD_ERR_OK:
							break;
					case UPLOAD_ERR_NO_FILE:
							throw new RuntimeException('No image selected');
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
							throw new RuntimeException('Exceeded filesize limit on server');
					default:
							throw new RuntimeException('Unknown errors.');
			}

			// You should also check filesize here. 
			if ($NewImage['size'] > 1000000) {
					throw new RuntimeException('Exceeded filesize limit.');
			}

			// DO NOT TRUST $_FILES['grid-pic-'.$i]['mime'] VALUE !!
			// Check MIME Type by yourself.
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			if (false === $ext = array_search(
					$finfo->file($NewImage['tmp_name']),
					array(
							'jpg' => 'image/jpeg',
							'png' => 'image/png',
					),
					true
			)) {
					throw new RuntimeException('Invalid file format.');
			}

			$galleryInsertQuery = $DB_con->prepare("INSERT INTO `gallery_images` (`galleryid`,`uploaded_by`) VALUES (:galid,:admin)");      
			$galleryInsertQuery->execute(array(':galid'=>$galleryId,":admin"=>$user->get_admin_id()));
			$i = $DB_con->lastInsertId();


			$file = new Upload($NewImage); 
			$thumb = new Upload($NewImage); 

			if ($file->uploaded) {
					$file->file_new_name_body = 'slider-'.$i;
					 $file->image_resize = true;
					 $file->file_overwrite = true;
					 $file->file_auto_rename = false;

					 $file->image_convert = 'jpg';

					 if($file->image_src_x > $file->image_src_y){
				  $file->image_x = 800;
				  $file->image_ratio_y = true;
			   }
			   else{
				  $file->image_ratio_x = true;
				  $file->image_y = 600;
			   }

					 $file->Process(getcwd().'/res/images/gallery/slider/gallery'.$galleryId);

					 if ($file->processed) {
						
						$thumb->image_x = 190;
						$thumb->image_y = 90;
						$thumb->image_resize = true;
						$thumb->image_convert = 'jpg';


						$thumb->image_ratio_crop = true;

						$thumb->image_ratio_x = false;
						$thumb->image_ratio_y = false;

						$thumb->jpeg_quality  = 75;

						$thumb->file_new_name_body = 'slider-'.$i.'-s190x90';
						$thumb->Process(getcwd().'/res/images/gallery/slider/gallery'.$galleryId);

						array_push($success, '<stong>Success!</strong>New slider image is added') ;

						$file->Clean();
						$thumb->Clean();

					 } else {
							throw new RuntimeException($file->error);
					 }
			}

	}

	catch(Exception $e) {
		array_push($error, '<strong>Error on Uploading Image</strong> ' .$e->getMessage());
	}
}
elseif(isset($_GET['delete'])) {
	try{
		$deleteId = intval($_GET['delete']);
		$existanceQuery = $DB_con->prepare("SELECT `galleryid` FROM `gallery_images` WHERE `id` = ? ");
		$existanceQuery->execute(array($deleteId));
		if($existanceQuery->rowCount() == 0){
			throw new RuntimeException("The image is not found");
		}
		$galleryId=$existanceQuery->fetch(PDO::FETCH_ASSOC);
		$galleryId = $galleryId['galleryid'];

		$deleteQuery = $DB_con->prepare("DELETE FROM `gallery_images` WHERE `id`=:id");
		  $deleteQuery->execute(array(':id'=>$deleteId));

		  unlink('res/images/gallery/slider/gallery'.$galleryId.'/slider-'.$deleteId.'.jpg');
		  unlink('res/images/gallery/slider/gallery'.$galleryId.'/slider-'.$deleteId.'-s190x90.jpg');


		  $url = $_SERVER['SCRIPT_NAME'] .'?gallery='.$galleryId;

		  if (!headers_sent()) {
			  //If headers not sent yet... then do php redirect
			  header('Location: '.$url); exit;
		  } else {
			  //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
			  echo '<script type="text/javascript">';
			  echo 'window.location.href="'.$url.'";';
			  echo '</script>';
			  echo '<noscript>';
			  echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			  echo '</noscript>'; exit;
		  }
		
	}
	catch(Exception $e) {
		array_push($error, '<strong>Error on Deleting Image</strong> ' .$e->getMessage());
	}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">

		<title>Dashboard | Destination Events</title>
		<style type="text/css">
				.container-fluid{
					padding-bottom: 100px;
				}
				.card{
					display: inline-block;
					margin: 5px;
					float: left;
					width: 300px;
				}
		</style>
		<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="res/css/bootstrap.min.css"/>

		<!-- Custom styles for this template -->
		<link href="dashboard.css" rel="stylesheet">
	</head>

	<body>
		<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
			<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">DEW</a>
			<ul class="navbar-nav px-3">
				<li class="nav-item text-nowrap">
				 <a href="logout.php" class="nav-link">Signout</a>
				</li>
			</ul>
		</nav>
		<br><br>

		<div class="container-fluid">
			<div class="row">

				<?=getAdminNavigation('testimonial')?>

				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Gallery Images</h1>           
					</div>

					<div class="section">
						<?php
							if(!isset($_GET['gallery'])){
								if(!isset($_GET['delete'])){
									array_push($error, "No gallery is selected");
								}
								$galleryId = FALSE;
							}  
							else{
								$galleryId = intval($_GET['gallery']);
								$galleryQuery = $DB_con->prepare("SELECT `gallery_name` FROM `gallery_thumb` WHERE `id` = ? ");
								$galleryQuery->execute(array($galleryId)); 
								if($galleryQuery->rowCount() == 0){
									$galleryId = FALSE;
									array_push($error, "Gallery with this id is not found");
								}
								else{
									$galleryData = $galleryQuery->fetch(PDO::FETCH_ASSOC);
								}
							}

							
							if(!empty($error)){
								foreach ($error as $value) {
									echo '<div class="alert alert-danger">'.$value.'</div>';
								}
							}
							if(!empty($success)){
								foreach ($success as $value) {
									echo '<div class="alert alert-success">'.$value.'</div>';
								}
							}
						?>

					</div>

					<?php
						if($galleryId != FALSE){
					?>

					<div class="alert alert-info"><strong>Gallery : (<?=$galleryId?>)</strong> <?=$galleryData['gallery_name'] ?></div>
								<span class="card" style="display: block;width:100%;">
											<div class="card-body" style="color: #3b543b;text-align: center;">
													<form method="POST"  enctype="multipart/form-data">
														<input type="file" name="new-gallery">
														<input type="submit" name="new-image-upload" class="btn btn-primary" value="UPLOAD NEW SLIDE">
													</form>
											</div>
								</span>
					<?php
						$sliderQuery = $DB_con->prepare("SELECT * FROM `gallery_images` WHERE `galleryId` = :id ");
						$sliderQuery->execute(array('id'=>$galleryId));
						$rows = $sliderQuery->fetchAll(PDO::FETCH_ASSOC);

						foreach ($rows as $row) {
							echo '
								<span class="card">
									<img class="card-img-top" src="res/images/gallery/slider/gallery'.$galleryId.'/slider-'.$row['id'].'.jpg">
									<div class="card-body">
										<span style="float: left;">slider'.$row['id'].'.jpg</span>
										<a href="?delete='.$row['id'].'"
											class="btn btn-danger"
											style="float:right;"
											onClick="if(!confirm('."'Deleting this image, are you sure ? '".')){return false;}"
										>Delete</a>
									</div>
								</span>
							';
						}


					?>

					<?php
						}
					?>


				</main>
			</div>
		</div
>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="../../assets/js/vendor/popper.min.js"></script>
		<script src="res/js/bootstrap.min.js"></script>

		<!-- Icons -->
		<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
		<script>
			feather.replace()
		</script>

	</body>
</html>
