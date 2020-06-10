jQuery( document ).ready(function($) {
     $('.slideshow_container .slideshow_slide a').on("focus",function(){
	$(this).closest(".slideshow_container").trigger("mouseenter");
     });
     $('.slideshow_container .slideshow_slide a').on("focusout",function(){
	$(this).closest(".slideshow_container").trigger("mouseleave");
     });
     /** Add Tab Index to WPDataTables tool buttons **/
     if ($('.wpDataTables.wpDataTablesWrapper .dt-buttons').length){
     	$('.wpDataTables.wpDataTablesWrapper .dt-buttons .dt-button').each(function(){
     		$(this).attr('tabindex','0');
     	});
     }
});
