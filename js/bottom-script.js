jQuery( document ).ready(function($) {
     $('.slideshow_container .slideshow_slide a').on("focus",function(){
	$(this).closest(".slideshow_container").trigger("mouseenter");
     });
     $('.slideshow_container .slideshow_slide a').on("focusout",function(){
	$(this).closest(".slideshow_container").trigger("mouseleave");
     });
     $(document).on('click', '.wpdt-c .wpDataTablesWrapper table.wpDataTable[data-wpdatatable_id="8"] tr td', function(e){
          console.log(e);
          console.log(this);
          let parent = $(this).parent();
          let target = $('#ppe-details-modal');
          let data = {
               school: parent.find('.column-schoolname').text(),
               state: parent.find('.column-state').text(),
               district: parent.find('.column-district').text(),
               isdn: parent.find('.column-stateschoolid').text(),
               nces: parent.find('.column-ncesdistrictid').text(),
               statelocalppe: parent.find('.column-formula_1').text(),
               federalppe: parent.find('.column-formula_2').text(),
               totalppe: parent.find('.column-formula_3').text()
          };

     	target.find("#schoolName").text(data.school);
     	target.find("#state").text(data.state);
     	target.find("#district").text(data.district);
          target.find("#sidn").text(data.isdn);
          target.find("#ncesno").text(data.nces);
          target.find("#totalslppe").text(data.statelocalppe);
          target.find("#totalfppe").text(data.federalppe);
          target.find("#totalppe").text(data.totalppe);
     	target.modal('show');
     });
});
