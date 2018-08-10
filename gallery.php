 <?php
	require('res/php/config.php');
	require('res/php/components/gallery.creator.php');
	require('res/php/components/main-header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>Destination Events &amp; Weddings</title>

	<link rel="stylesheet" type="text/css" href="res/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="res/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="res/css/pages.css"/>

	<link rel="stylesheet" type="text/css" href="res/css/slider.css"/>

	<style type="text/css">
		.headerImage{
			background-image: url(res/images/about.jpg);
		}
	</style>
</head>
<body>
	<section class="gallery marginTop80">
		<div class="container text-center">
			<h1 class="page-heading">GALLERY</h1>
			<div class="gallery-grid">
				<?php 
                  $galleryQuery = $DB_con->query("
                  	SELECT * FROM `gallery_thumb`
                  	WHERE EXISTS (SELECT NULL from gallery_images where galleryid = gallery_thumb.id)
                  ");
                  $galleries = $galleryQuery->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($galleries as $gallery) {
                  	echo '<a href="#" class="gallery-box" data-galley="gal'.$gallery['id'].'">
						<span class="gallery-crop"><img src="res/images/gallery/gallery'.$gallery['id'].'.jpg"></span>
						<span class="gallery-label"><span class="gallery-label-text">'.nl2br($gallery['gallery_name']).'</span></span>
					</a>';
        		  }
				?>
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


	<?php
		foreach ($galleries as $gallery) {
	    	addGallery($gallery['id'],$DB_con);
	    }
		echo getHeader('gallery');
	?>

	
	<script src="res/js/jquery-3.3.1.min.js"></script>
	<script src="res/js/bootstrap.min.js"></script>
	<script src="res/js/script.js"></script>
	

	<!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <script src="res/js/jssor.slider-27.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_options = {
              $AutoPlay: 1,
              $LazyLoading:1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $SpacingX: 5,
                $SpacingY: 5
              }
            };

            var jssor_sliders = new Array();

            <?php
				foreach ($galleries as $gallery) {
					echo 'var slider = new $JssorSlider$("jssor_'.$gallery['id'].'", jssor_options);
						jssor_sliders.push(slider);
            		';
				}
			?>
            
            console.log(jssor_sliders);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var parentWidth = $('.slide-container').width();
                var parentHeight = $('.slide-container').height();

		       if (parentWidth) {
		       		jssor_sliders.map(function(e){
		                e.$ScaleWidth(parentWidth);
		       		});
	            } 
                else {
                    window.setTimeout(ScaleSlider, 30);
                }

            }

            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/

            $(".gallery-close").on("click",function(){
            	$(".gallery-slide").fadeOut();
            	$(".slide-container").hide();
            	return false;
            });

            $(".gallery-box").on("click",function(){
				var galleryid = $(this).attr("data-galley");
            	var gallery = $("#"+galleryid);
            	if(gallery.length == 0){alert("Gallery with id " + galleryid +" not found");return false;}
            	gallery.fadeIn();
            	gallery.find(".slide-container").slideDown();

            	return false;
            })
        });
    </script>
    <script>
    	
    </script>
    
</body>
</html>