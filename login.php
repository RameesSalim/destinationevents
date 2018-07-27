<?php
ob_start();
include_once 'res/php/config.php';

//Login Check
if($user->is_loggedin()!="")
{
 $user->redirect('admin.php');
}

//
if(isset($_POST['set']))
{
	$error = array();
	$username=$_POST['username'];
	$password=$_POST['password'];
	$value=$user->login($username,$password);

	if($value == true )
	{

		$user->redirect('admin.php');

	}	
	else
	{

		$display =array(1=>"alert alert-danger",2=>"You username or password is incorrect.");
	}
}


?>


<!DOCTYPE html>
<html lang="en"></html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>Destination Events & Weddings</title>

	<link rel="stylesheet" type="text/css" href="res/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="res/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="res/css/pages.css"/>
	<style type="text/css">
		.headerImage{
			background-image: url(res/images/about.jpg);
		}
	</style>
</head>
<body>
	<section class="contact marginTop80">
		<div class="page-container">
			<h1 class="page-heading text-center">LOGIN</h1>
			<div class="row">
			
			<h3><?php 
			echo $_SESSION['a']."<br>";  echo $_SESSION['b'];
			
			?></h3>
			
				<div class="col-sm-3 order-sm-1">
				</div>
				<div class="col-sm-6 order-sm-1">
				
					<?php if(isset($display)): ?>
						<div class="<?php echo $display['1'];?>">
							<?php echo $display['2']; $error=array();?>

						</div>
					<?php endif ?>

					<form class="contact-form" style="text-align: right;" method="post"> 
						<input type="text" class="textbox username" required="required" name="username" placeholder="Username : *">
						<input type="password" class="textbox password" required="required" name="password" placeholder="Password : *">
						<input class="butn butn-block set" type="submit" name="set" value="Submit" style="cursor:pointer;">
					</form>
				</div>
				<div class="col-sm-3 order-sm-1">
				</div>
			</div>
		</div>
	</section>

	<footer>
		<div class="container text-center">
			<div class="row">
				<div class="col-sm-4">
					<h5 class="footer-head">PARTY WITH US</h5>
					<p class="footer-address">
						<i class="fas fa-phone"></i> +91 98765 24321 <br/>
						<i class="fas fa-phone"></i> +91 12345 67893 <br/>
						<br/>
					</p>
				</div>
				<div class="col-sm-4 social">
					<h5 class="footer-head">FOLLOW US</h5>
					<a href="#"><i class="fas fa-phone"></i></a>
					<a href="#"><i class="fas fa-twitter"></i></a>
					<a href="#"><i class="fas fa-twitter"></i></a>
					<a href="#"><i class="fas fa-twitter"></i></a>
					<a href="#"><i class="fas fa-twitter"></i></a>
				</div>
				<div class="col-sm-4">
					<h5 class="footer-head">OUR ADDRESS</h5>
					<p class="footer-address">
						Lorem ipsum dolor sit amet, consectetur adipiscing <br/>elit. Duis et gravida felis, ac cursus purus
					</p>
				</div>
			</div>	
		</div>
	</footer>
	<div class="header">
		<div class="header-content">
			<a href="index.html"><img src="res/images/dew_logo_header.jpg"/></a>
			<ul class="nav">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a href="about.html">About</a>
				</li>
				<li class="sub">
					<a href="services.html">Services</a>
					<ul class="sub-nav">
						<li><a href="services-wedding.html">Wedding</a></li>
						<li><a href="services-wedding.html">FUNCTIONS</a></li>
						<li><a href="services-wedding.html">HOUSE WARMING</a></li>
						<li><a href="services-wedding.html">Wedding</a></li>
					</ul>
				</li>
				<li>
					<a href="gallery.html">Gallery</a>
				</li>
				<li class="selected">
					<a href="contact.html">Contact</a>
				</li>
			</ul>

			<span class="humburger inactive"><i class="fas fa-bars"></i><i class="fas fa-times"></i></span>
		</div>
	</div>


	<script src="res/js/jquery-3.3.1.min.js"></script>
	<script src="res/js/bootstrap.min.js"></script>
	<script src="res/js/script.js"></script>
	
</body>
</html>
