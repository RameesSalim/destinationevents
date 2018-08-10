<?php
	require('res/php/components/main-header.php');
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
			<h1 class="page-heading text-center">CONTACT US</h1>
			<div class="row">
				<div class="col-sm-6 order-sm-2">
					<h5 style="color: #904aa3;">PHONE</h5>
					<h4><span class="mobile-only-block">+91 99876 45554 &nbsp;&nbsp;,&nbsp;</span> <span class="mobile-only-block">+91 99876 45554</span></h4>
					<h5 style="color: #904aa4;">EMAIL</h5>
					<h4>info@destinationevents.in</h4>
					<iframe frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/view?zoom=17&center=10.0410,76.3282&key=AIzaSyCdAwxfkW5_UAouWlYHlu0CnVx6gkBFTLQ" allowfullscreen></iframe>
				</div>
				<div class="col-sm-6 order-sm-1">
					<form class="contact-form" style="text-align: right;"> 
						<input type="text" class="textbox" required="required" name="name" placeholder="Name : *">
						<input type="text" class="textbox" required="required" name="mail" placeholder="Email *">
						<input type="text" class="textbox" required="required" name="phone" placeholder="Phone *">
						<textarea class="textbox" name="message" placeholder="Message *" required="required"></textarea>
						<button class="butn butn-block" type="submit">SEND A MAIL TO US</button>
					</form>
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
	
	<?=getHeader('contact')?>


	<script src="res/js/jquery-3.3.1.min.js"></script>
	<script src="res/js/bootstrap.min.js"></script>
	<script src="res/js/script.js"></script>
	
</body>
</html>