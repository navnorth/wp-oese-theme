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
          addRowTabIndex();
          $(document).on('keyup', '.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.odd,.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.even', function(event){
               if (event.defaultPrevented) {
                    return;
               }

               var key = event.keyCode || event.which || event.key;

               if (key===32 || key===13) {
                    $(this).addClass('current');
                    $(this).find('td').first().trigger('click');
               }
          });
          $('#wdt-md-modal').on('shown.bs.modal', function(){
               $(this).focus();
          });
          $('#wdt-md-modal').on('hidden.bs.modal', function(){
               let curRow = $('.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.current');
               curRow.focus();
               curRow.removeClass('current');
          });
          $(document).on('keyup', '.wpdt-c .wpDataTablesWrapper .paginate_button', function(event){
               var kCode = event.keyCode || event.which || event.key;
               if (kCode===32 || kCode===13) {
                    setTimeout(addRowTabIndex(),100);
               }
          });

     }

     /* Add label to State box selection */
     var mapSelector = $('.usacustomHtml5MapSelector');
     if (mapSelector.length){
          if (mapSelector.find('select')){
               let sel = mapSelector.find('select');
               let selId = sel.attr('id');
               mapSelector.prepend('<label for="' + selId  + '">Select an area: </label>');
               sel.find('option').first().text("");
          }
     }

     function addRowTabIndex(){
          $('.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.odd,.wpdt-c .wpDataTablesWrapper table.wpDataTable tr.even').each(function(){
               $(this).attr('tabindex', '0');
          });
     }
});
