jQuery( document ).ready(function($) {
     $('.slideshow_container .slideshow_slide a').on("focus",function(){
	$(this).closest(".slideshow_container").trigger("mouseenter");
     });
     $('.slideshow_container .slideshow_slide a').on("focusout",function(){
	$(this).closest(".slideshow_container").trigger("mouseleave");
     });
});
