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

     /** Add Tab Index to WPDataTables row **/
     if ($('.wpdt-c .wpDataTablesWrapper table.wpDataTable').length){
          $('.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.odd,.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.even').each(function(){
               $(this).attr('tabindex', '0');
          });
          $(document).on('keyup', '.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.odd,.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.even', function(event){
               if (event.defaultPrevented) {
                    return;
               }

               var key = event.keyCode || event.which || event.key;

               if (key===32 || key===13) {
                    $(this).find('td').first().trigger('click');
               }
          });
          $('#wdt-md-modal').on('shown.bs.modal', function(){
               $(this).focus();
          });
     }
});
