jQuery(document).ready(function(){
window.retrieveCompareData = function retrieveCompareData(obj,tableDescription){
    console.log('rerouted');
    var tableid = obj.closest('.wpDataTablesWrapper').find('table.wpDataTable').attr('data-wpdatatable_id');
    globalresponse = 0;
    var table_name = (tableDescription.compareDetailPopupTitle == "")? "Compare Details": tableDescription.compareDetailPopupTitle;
    jQuery.ajax({
				type:'POST',
				url: wdt_ajax_object.ajaxurl,
        async: true,
				data: {'action':'extendTableObjectCompareAjax','table_id': tableid},
				success:function(response){

					globalresponse = JSON.parse(response);
          var alldata = [];


          var chtml = '<table arial-label="'+table_name+'">';
          chtml += '<tr>';
          chtml += '<td class="wdtcomparerow wdtcomparecol-0 hdr" tabindex="-1"></td>';
          for (var w = 0; w < forcompare.length; w++) {
              colno = w + 1;
              var fcmp = forcompare[w];
              chtml += '<td class="wdtcomparerow wdtcomparecol-'+colno+' hdr" tabindex="-1">';
                chtml += '<a class="wdt-remove-column" role="button" tabindex="0" aria-label="Remove column '+colno+' from comparison" fcmp="'+fcmp+'" col="'+colno+'">';
                  chtml += '<span class="dashicons dashicons-dismiss" tabindex="-1"></span>';
                chtml += '</a>';
              chtml += '</td>';
          }
          chtml += '</tr>';


          //column
          var colrw = 1;
          colArrayLength = globalresponse['column'].length;
          for (var x = 0; x < colArrayLength; x++) {

              var vis = globalresponse['column'][x]['compareDetailColumnOption'];


              if(vis > 0){
                chtml += '<tr>';
                var left_header = globalresponse['column'][x]['orig_header'];

                if(left_header != 'Compare'){
                  var left_display_header = globalresponse['column'][x]['display_header'];
                  chtml += '<th class="wdtcomparerow wdtcomparerow-'+0+'" scope="row" >';
                  chtml += '<span>';
                  chtml += left_display_header;
                  chtml += '</span>';
                  chtml += '</th>';

                  var forcomparelength = forcompare.length;
                  var colno = 1;
                  for (var y = 0; y < forcomparelength; y++) {
                    var fcmp = forcompare[y];


                    for (var q = 0; q < colArrayLength; q++) {
                      var vis = globalresponse['column'][q]['compareDetailColumnOption'];
                      var dtp = globalresponse['column'][q]['type'];
                      var tgt = globalresponse['column'][q]['linkTargetAttribute']
                      var btn = globalresponse['column'][q]['linkButtonAttribute']
                      var pfx = globalresponse['column'][q]['text_before'];
                      var sfx = globalresponse['column'][q]['text_after'];
                      var dec = globalresponse['column'][q]['decimalPlaces'];
                      var lnklabel = globalresponse['column'][q]['linkButtonLabel'];

                      if(vis > 0){
                        var col = globalresponse['column'][q]['orig_header'];
                        var dsp = globalresponse['column'][q]['display_header'];
                        if(left_header == col){

                          var dta = globalresponse['data'][fcmp][col];
                          if(dta !== null){
                            if(dtp == 'float'){

                              if(dec){
                                dta = thousands_separators(addZeroes(parseFloat(dta).toFixed(2)));
                              }else{
                                dta = thousands_separators(parseFloat(dta));
                              }
                            }
                            dta = pfx+dta+sfx;
                          }else{
                            dta = '';
                          }

                          if(colrw == 1){
                            chtml += '<th class="wdtcomparerow wdtcomparerow-'+colrw+' wdtcomparecol-'+colno+'"  scope="col">';
                            chtml += '<span>';
                            chtml += dta;
                            chtml += '</span>';
                            //chtml += '<div class="wdt-remove-column" tabindex="0" role="button" aria-label="Remove column '+colno+': '+dsp+' '+dta+' from comparison" fcmp="'+fcmp+'" col="'+colno+'"><span class="dashicons dashicons-dismiss"></span><div class="wdt-compare-tooltip"><span class="wdt-compare-tooltiptext">Remove</span></div></div>';
                            chtml += '</th>';
                          }else{
                            chtml += '<td class="wdtcomparerow wdtcomparerow-'+colrw+' wdtcomparecol-'+colno+'" >';
                            chtml += '<span>';
                            if(dtp == 'link'){
                                if(btn){
                                  chtml += '<a href="'+dta+'" target="'+tgt+'"><button class="">'+lnklabel+'</button></a>';
                                }else{
                                  chtml += '<a href="'+dta+'" target="'+tgt+'">'+lnklabel+'</a>';
                                }

                            }else{
                                chtml += dta;
                            }
                            chtml += '</span>';
                            chtml += '</td>';
                          }

                          colno++;
                        }
                      }
                    }

                  }
                  chtml += '</tr>';
                  colrw++;
                } //if(left_header != 'Compare'){


              }

          }
          chtml += '</table>';


          jQuery('#wdt-cd-modal').find('.wdt-compare-modal-body-content').append(chtml).show('slow')
          jQuery('.wdt-compare-preloader-wrapper').hide(300);


				},
				error: function(xhr, textStatus, errorThrown) {
           var errorMessage = xhr.status + ': ' + xhr.statusText
				   alert(errorMessage);
				}
		});


}
});