$(document).ready(function(){
	$(".humburger").on("click",function(){
		$(".humburger").toggleClass("inactive");
		$(".nav").toggle("fast");
	});
});

$(window).on("load",function(){
	$(".sub").each(function(x,t){
		var subnav = $(this).find(".sub-nav");
		var l = $(this).offset().left + $(this).width()/2 - subnav.width()/2;
		var t = $(this).offset().top + $(this).outerHeight();
		subnav.css({"left":l,"top":t});
	});

});