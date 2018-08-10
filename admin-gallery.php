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
  if(isset($_GET['delete'])){
    try{
        $deleteId = intval($_GET['delete']);
        $deleteCheckQuery = $DB_con->prepare("SELECT * FROM `gallery_thumb` WHERE `id` = ? ");
        $deleteCheckQuery->execute(array($deleteId));

        if($deleteCheckQuery->rowCount() > 0){
          $deleteQuery = $DB_con->prepare("DELETE FROM `gallery_thumb` WHERE `id`=:id");
          $deleteQuery->execute(array(':id'=>$deleteId));
          unlink('res/images/gallery/gallery'.$deleteId.'.jpg');
          deleteDir('res/images/gallery/slider/gallery'.$deleteId);

          $url = $_SERVER['SCRIPT_NAME'];

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
        else{
          throw new RuntimeException('No Gallery is found with this Id '. $deleteId);
        }
    }
    catch(Exception $e) {
      array_push($error, '<strong>Error!</strong> ' .$e->getMessage());
    }
  }
  elseif(isset($_POST['gallery_update'])){
    try{
      if($_POST['gallery_update'] == 'new'){
          $galleryName = $_POST['gallery_name'];
          if(empty($galleryName)){
              throw new RuntimeException('No Gallery Name is Provided');
          }
          $ThumbFile = $_FILES['gallery_thumb'];

          if (!isset($ThumbFile['error']) || is_array($ThumbFile['error'])) {
              throw new RuntimeException('Invalid parameters.');
          }

          // Check $_FILES['grid-pic-'.$i]['error'] value.
          switch ($ThumbFile['error']) {
              case UPLOAD_ERR_OK:
                  break;
              case UPLOAD_ERR_NO_FILE:
                  throw new RuntimeException('No Thumbnail selected');
              case UPLOAD_ERR_INI_SIZE:
              case UPLOAD_ERR_FORM_SIZE:
                  throw new RuntimeException('Exceeded filesize limit.');
              default:
                  throw new RuntimeException('Unknown errors.');
          }

          // You should also check filesize here. 
          if ($ThumbFile['size'] > 1000000) {
              throw new RuntimeException('Exceeded filesize limit.');
          }

          // DO NOT TRUST $_FILES['grid-pic-'.$i]['mime'] VALUE !!
          // Check MIME Type by yourself.
          $finfo = new finfo(FILEINFO_MIME_TYPE);
          if (false === $ext = array_search(
              $finfo->file($ThumbFile['tmp_name']),
              array(
                  'jpg' => 'image/jpeg',
                  'png' => 'image/png',
              ),
              true
          )) {
              throw new RuntimeException('Invalid file format.');
          }

          $galleryInsertQuery = $DB_con->prepare("INSERT INTO `gallery_thumb` (`gallery_name`,`uploaded_by`) VALUES (:galname,:admin)");      
          $galleryInsertQuery->execute(array(':galname'=>$galleryName,":admin"=>$user->get_admin_id()));
          $i = $DB_con->lastInsertId();


          $file = new Upload($ThumbFile); 

          if ($file->uploaded) {
              $file->file_new_name_body = 'gallery'.$i;
               $file->image_resize = true;
               $file->file_overwrite = true;
               $file->file_auto_rename = false;

               $file->image_convert = 'jpg';

                $file->image_x = 300;
                $file->image_y = 300;

               $file->image_ratio_crop = true;

               $file->Process(getcwd().'/res/images/gallery/');
               if ($file->processed) {
                 array_push($success, '<stong>Success!</strong>New Gallery is created') ;
                 $file->Clean();
               } else {
                  throw new RuntimeException($file->error);
               }
          }
      }
      elseif(intval($_POST['gallery_update']) > 0){
        $i = intval($_POST['gallery_update']) > 0;
        
        $galleryName = $_POST['gallery_name'];
          if(empty($galleryName)){
            throw new RuntimeException('No Gallery Name is Provided');
        }

        $galleryUpdateQuery = $DB_con->prepare("UPDATE `gallery_thumb` SET `gallery_name`=:galname,`uploaded_by`=:admin WHERE `id`=:id ");
        $galleryUpdateQuery->execute(array(':galname'=>$galleryName,":admin"=>$user->get_admin_id(),':id'=>$i));




        // Upload Thumbnail
        $ThumbFile = $_FILES['gallery_thumb'];

        if (!isset($ThumbFile['error']) || is_array($ThumbFile['error'])) {
            throw new RuntimeException('Invalid parameters.');
        }
        if(!($ThumbFile['error'] == UPLOAD_ERR_NO_FILE)){
                // Check $_FILES['grid-pic-'.$i]['error'] value.
                switch ($ThumbFile['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('No Thumbnail selected on gallery with id '.$i);
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Exceeded filesize limit on gallery with id '.$i);
                    default:
                        throw new RuntimeException('Unknown errors on gallery with id '.$i);
                }

                // You should also check filesize here. 
                if ($ThumbFile['size'] > 1000000) {
                    throw new RuntimeException('Exceeded filesize limit on gallery with id '.$i);
                }

                // DO NOT TRUST $_FILES['grid-pic-'.$i]['mime'] VALUE !!
                // Check MIME Type by yourself.
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search(
                    $finfo->file($ThumbFile['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                    ),
                    true
                )) {
                    throw new RuntimeException('Invalid file format on gallery with id '.$i);
                }

                $file = new Upload($ThumbFile); 

                if ($file->uploaded) {
                    $file->file_new_name_body = 'gallery'.$i;
                     $file->image_resize = true;
                     $file->file_overwrite = true;
                     $file->file_auto_rename = false;

                     $file->image_convert = 'jpg';

                      $file->image_x = 300;
                      $file->image_y = 300;

                     $file->image_ratio_crop = true;

                     $file->Process(getcwd().'/res/images/gallery/');
                     if ($file->processed) {
                       array_push($success, '<stong>Success!</strong>Gallery '.$i.' thumbnail is updated') ;
                       $file->Clean();
                     } else {
                        throw new RuntimeException($file->error);
                     }
                }
        }
      }
     }
    catch(Exception $e) {
      array_push($error, '<strong>Error!</strong> ' .$e->getMessage());
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
            <h1 class="h2">Gallery</h1>           
          </div>

          <div class="section">
            <?php
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
              <table  width="100%" cellpadding="5" border="1">
                <tr>
                  <th>Id.</th>
                  <th width="20%">Name</th>
                  <th width="20%">Thumbnail</th>
                  <th width="20%">Update<br/>Thumbnail</th>
                  <th width="10%">Image Count</th>
                  <th width="20%">Action</th>
                </tr>
                <?php
                  $i = 1;

                  $galleryQuery = $DB_con->query("
                    SELECT gallery_thumb.* , COUNT(gallery_images.galleryid) as imagecount
                    FROM gallery_thumb
                    LEFT JOIN gallery_images
                    ON (gallery_thumb.id = gallery_images.galleryid) 
                    GROUP BY gallery_thumb.id
                  ");
                  $rows = $galleryQuery->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($rows as $row) {
                    echo '
                    <tr>
                      <form method="post" action="'.$_SERVER['SCRIPT_NAME'].'" enctype="multipart/form-data">
                        <td>'.$row['id'].'</cairo_matrix_transform_distance(matrix, dx, dy)>
                        <td><textarea type="text" name="gallery_name" class="form-control" rows="3">'.$row['gallery_name'].'</textarea></td>
                        <td><img src="res/images/gallery/gallery'.$row['id'].'.jpg" style="height:120px;margin-right:10px;"></td>
                        <td>
                          <input type="file" name="gallery_thumb"/><br/>
                          <input type="submit" class="btn btn-success" style="margin:5px 0;" value="Change">
                        </td>
                        <td>'.$row['imagecount'].'</td>
                        <td>
                          <input type="hidden" name="gallery_update" value="'.$row['id'].'"><br/>
                          <a href="admin-gallery-images.php?gallery='.$row['id'].'" class="btn btn-primary">Edit Slides</a>
                          <a 
                            href="admin-gallery.php?delete='.$row['id'].'"
                            class="btn btn-danger"
                            onClick="if(!confirm('."'If you delete this gallery, all images inside the gallery will be deleted'".')){return false;}"
                          >Delete</a> 
                        </td>
                      </form>
                    </tr>
                    ';
                    $i++;
                  }
                ?>
                <tr>
                  <form method="post" action="<?=$_SERVER['SCRIPT_NAME']?>" enctype="multipart/form-data">
                    <td></td>
                    <td><textarea type="text" name="gallery_name"></textarea></td>
                    <td></td>
                    <td><input type="file" name="gallery_thumb"/></td>
                    <td>0</td>
                    <td><input type="submit" onClick="this.form.submit();this.disabled=true;this.value='Sending…';return false;" value="Add Gallery"></td>
                    <input type="hidden" name="gallery_update" value="new">
                  </form>
                </tr>
              </table>
          </div>

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
