<!DOCTYPE html>
<html lang="en"></html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>Destination Events & Weddings</title>

	<link rel="stylesheet" type="text/css" href="res/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
	
	<link rel="stylesheet" href="res/css/owl.carousel.min.css">
	<link rel="stylesheet" href="res/css/owl.theme.default.min.css">


	<link rel="stylesheet" type="text/css" href="res/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="res/css/pages.css"/>


	<style type="text/css">
		.headerImage{
			background-image: url(res/images/about.jpg);
		}
	</style>
</head>
<body>
	<section class="service-carousel marginTop80">
		<div class="owl-carousel owl-theme" id="servcie-owl-carousel">
		    <div class="item"><img src="res/images/services/slider/wedding.jpg"/></div>
		    <div class="item"><img src="res/images/services/slider/wedding.jpg"/></div>
		    <div class="item"><img src="res/images/services/slider/wedding.jpg"/></div>
		    <div class="item"><img src="res/images/services/slider/wedding.jpg"/></div>
		</div>
	</section>
	<section class="service-page">
		<div class="page-container text-center">
			<h1 class="page-heading">WEDDING</h1>
			<p class="page-text">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id leo ut ex consequat lacinia. Curabitur vel mi tempor, dictum quam eu, consequat erat. Quisque dignissim blandit lorem vel ultricies. Morbi rutrum volutpat tellus in sollicitudin. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla tincidunt sodales sapien a tempor. Etiam suscipit, est non sodales ornare, orci mauris scelerisque lorem, ac vulputate metus ligula id augue. Fusce porttitor ex dui, at lacinia lectus cursus eget. Vestibulum lacus felis, varius non imperdiet fermentum, laoreet quis arcu.
			</p>
			<p class="page-text">
				Morbi rutrum volutpat tellus in sollicitudin. Orci Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id leo ut ex consequat lacinia. Curabitur vel mi tempor, dictum quam eu, consequat erat. Quisque dignissim blandit lorem vel ultricies.  
			</p>
			<p class="page-text">
				Sed id leo ut ex consequat lacinia. Curabitur vel mi tempor, Lorem ipsum dolor sit amet, consectetur adipiscing elit.

			</p>
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
				<li class="sub selected">
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
				<li>
					<a href="contact.html">Contact</a>
				</li>
			</ul>

			<span class="humburger inactive"><i class="fas fa-bars"></i><i class="fas fa-times"></i></span>
		</div>
	</div>

	<script src="res/js/jquery-3.3.1.min.js"></script>
	<script src="res/js/bootstrap.min.js"></script>
	<script src="res/js/script.js"></script>
	
	<script src="res/js/owl.carousel.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#servcie-owl-carousel').owlCarousel({
			    loop:true,
			    margin:0,
			    nav:false,
			    items:1
			});
		});
	</script>
</body>
</html>