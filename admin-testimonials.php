<?php
require('res/php/config.php');
require('res/php/components/admin-nav.php');

$error = '';
$success = '';
if($user->is_loggedin() == "")
{
 $user->redirect('index.php');
}
$numberOfTestimonials = 5;

if(isset($_POST['testimonial-data'])){
  try{
      $newTestimonials = array();
      for ($i=1; $i <= $numberOfTestimonials; $i++) { 
        array_push($newTestimonials, array($_POST['testimonial-name-'.$i],$_POST['testimonial-text-'.$i]));
      }
      $encodedData = json_encode($newTestimonials);

      $testimonialInsertQuery = $DB_con->prepare("UPDATE `public_data` SET `data`=:data,`lastupdate`=NOW(),`updatedby`=:admin WHERE `type`='testimonial' ");      
      $testimonialInsertQuery->execute(array(':data'=>$encodedData,":admin"=>$user->get_admin_id()));
      $success = 'Database Updated';
  }
  catch(Exception $e) {
    $error =  'Some Error Occured: ' .$e->getMessage();
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

        <?=getAdminNavigation('home')?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Testimonials</h1>           
          </div>

          <div class="section">
            <?php
              if(!empty($error)){
                echo '<div class="alert alert-danger"><strong>Error!</strong> '.$error.'</div>';
              }
              if(!empty($success)){
                echo '<div class="alert alert-success"><strong>Success!</strong> '.$success.'</div>';
              }
            ?>
            <form method="POST">
              <table  width="100%" cellpadding="5">
                <tr>
                  <th>No.</th>
                  <th width="30%">Name</th>
                  <th width="60%">Content</th>
                </tr>

                <?php
                  $i = 1;

                  $testimonialQuery = $DB_con->query("SELECT * FROM `public_data` WHERE `type`='testimonial' LIMIT 1");
                  $testimonialRow = $testimonialQuery->fetch();
                  $testimonials = json_decode($testimonialRow['data']);

                  foreach ($testimonials as $testimonialDatas) {
                    echo '
                    <tr>
                      <td style="font-weight: bold;">'.$i.'</td>
                      <td><input type="text" name="testimonial-name-'.$i.'" value="'.$testimonialDatas[0].'" style="width: 95%;"></td>
                      <td><textarea  name="testimonial-text-'.$i.'" style="width: 95%;">'.$testimonialDatas[1].'</textarea></td>
                    </tr>
                    ';
                    $i++;
                  }
                ?>

              </table>
              <center>
                <input type="submit" name="testimonial-data" style="margin:20px 0;" />
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
