$(document).ready(function(){
	$(".humburger").on("click",function(){
		$(".humburger").toggleClass("inactive");
		$(".nav").toggle("fast");
	});
});
