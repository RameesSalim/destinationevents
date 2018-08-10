<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");


require('res/php/config.php');
require('res/php/components/admin-nav.php');

$error = array();
$success = array();
if($user->is_loggedin() == "")
{
 $user->redirect('index.php');
}

$longImages = [3,5,7];

if(isset($_POST['grid-photo-data'])){
  
  require('res/php/class.upload.php');


    for ($i=1; $i <= 9; $i++) { 
      try{
          if (
              !isset($_FILES['grid-pic-'.$i]['error']) ||
              is_array($_FILES['grid-pic-'.$i]['error'])
          ) {
              throw new RuntimeException('Invalid parameters.');
          }

          if($_FILES['grid-pic-'.$i]['error'] == UPLOAD_ERR_NO_FILE){continue;}

          // Check $_FILES['grid-pic-'.$i]['error'] value.
          switch ($_FILES['grid-pic-'.$i]['error']) {
              case UPLOAD_ERR_OK:
                  break;
              case UPLOAD_ERR_NO_FILE:
                  throw new RuntimeException('No file sent.');
              case UPLOAD_ERR_INI_SIZE:
              case UPLOAD_ERR_FORM_SIZE:
                  throw new RuntimeException('Exceeded filesize limit.');
              default:
                  throw new RuntimeException('Unknown errors.');
          }

          // You should also check filesize here. 
          if ($_FILES['grid-pic-'.$i]['size'] > 1000000) {
              throw new RuntimeException('Exceeded filesize limit.');
          }

          // DO NOT TRUST $_FILES['grid-pic-'.$i]['mime'] VALUE !!
          // Check MIME Type by yourself.
          $finfo = new finfo(FILEINFO_MIME_TYPE);
          if (false === $ext = array_search(
              $finfo->file($_FILES['grid-pic-'.$i]['tmp_name']),
              array(
                  'jpg' => 'image/jpeg',
                  'png' => 'image/png',
              ),
              true
          )) {
              throw new RuntimeException('Invalid file format.');
          }


          $file = new Upload($_FILES['grid-pic-'.$i]); 
          if ($file->uploaded) {
              $file->file_new_name_body = 'grid'.$i;
               $file->image_resize = true;
               $file->file_overwrite = true;
               $file->file_auto_rename = false;

               $file->image_convert = 'jpg';

               if(in_array($i, $longImages)){
                  $file->image_x = 300;
                  $file->image_ratio_y = true;
               }
               else{
                  $file->image_ratio_x = true;
                  $file->image_y = 250;
               }

               $file->Process(getcwd().'/res/images/home-photos/');
               if ($file->processed) {
                 array_push($success, '<stong>Grid '.$i.'</strong> is Uploaded') ;
                 $file->Clean();
               } else {
                  throw new RuntimeException($file->error);
               }
          }
          // die($file->log);
      }

      catch(Exception $e) {
        array_push($error, '<strong>Error on grid '.$i.'</strong> ' .$e->getMessage());
      }

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

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="res/css/bootstrap.min.css"/>

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">DWE</a>
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
            <h1 class="h2">Photo Grid</h1>           
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
            <form method="POST" enctype="multipart/form-data">
              <table  width="100%" cellpadding="5">
                <tr>
                  <th>No.</th>
                  <th width="30%">Thumbnail</th>
                  <th width="20%">Height</th>
                  <th width="40%">Change</th>
                </tr>
                <?php

                  for($i=1;$i<=9;$i++) {
                    echo '
                    <tr>
                      <td style="font-weight: bold;">'.$i.'</td>
                      <td><img src="res/images/home-photos/grid'.$i.'.jpg" style="width:150px;"></td>
                      <td>'.(in_array($i, $longImages)?'2x':'1x').'</td>
                      <td><input type="file" name="grid-pic-'.$i.'"></td>
                    </tr>
                    ';
                  }

                ?>
              </table>
              <center>
                <input type="submit" name="grid-photo-data" style="margin:20px 0;" />
              </center>
            </form>
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
