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
          $(document).on('keyup', '.wpdt-c .wpDataTablesWrapper table.wpDataTable tr td a.master_detail_column_btn', function(event){
               if (event.defaultPrevented) {
                    return;
               }

               var key = event.keyCode || event.which || event.key;

               if (key===32 || key===13) {
                    $(this).addClass('current');
               }
          });
          $('#wdt-md-modal').on('shown.bs.modal', function(){
               if (!$(this).find('#modalintro').length)
                    $(this).prepend('<div id="modalintro" tabindex="0"></div>');
               $(this).attr('aria-hidden', false);
               $(this).focus();
          });
          $('#wdt-md-modal').on('hidden.bs.modal', function(){
               $(this).attr('aria-hidden', true);
               if ($(this).find('#modalintro').length)
                    $(this).find('#modalintro').remove();
               let curBtn = $('.wpdt-c .wpDataTablesWrapper table.wpDataTable tr td a.master_detail_column_btn.current');
               curBtn.focus();
               curBtn.removeClass('current');
          });
          /*$(document).on('keyup', '.wpdt-c .wpDataTablesWrapper .paginate_button', function(event){
               var kCode = event.keyCode || event.which || event.key;
               if (kCode===32 || kCode===13) {
                    setTimeout(addRowTabIndex(),100);
               }
          });*/

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

     /* Add label to WPDataTables Filters */
     if ($('.wpdt-c .wpDataTablesFilter .wpDataTableFilterBox').length){
          $('.wpdt-c .wpDataTablesFilter .wpDataTableFilterBox .wpDataTableFilterSection').each(function(){
               let lbl = $(this).find('label');
               var id = $(this).find('div').attr('class');
               if (typeof id !== 'undefined')
                    id = id.replace(/-/g, '_');
               let input = $(this).find('input').attr('id',id);
               lbl.attr('for',id);
          });
     }

     function addRowTabIndex(){
          $('.wpdt-c .wpDataTablesWrapper table.wpDataTable tr td a.master_detail_column_btn').each(function(){
               $(this).attr('tabindex', '0');
          });
     }
});
