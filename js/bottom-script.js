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
     	let schoolName = parent.find('.column-schoolname').text();
     	let state = parent.find('.column-state').text();
     	let district = parent.find('.column-district').text();
     	let target = $('#ppe-details-modal');
     	target.find("#schoolName").text(schoolName)
     	target.find("#state").text(state)
     	target.find("#district").text(district)
     	target.modal('show');
     });
});
