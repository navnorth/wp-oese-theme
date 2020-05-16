jQuery( document ).ready(function($) {
     $('.slideshow_container .slideshow_slide a').on("focus",function(){
	$(this).closest(".slideshow_container").trigger("mouseenter");
     });
     $('.slideshow_container .slideshow_slide a').on("focusout",function(){
	$(this).closest(".slideshow_container").trigger("mouseleave");
     });
     $('.wpdt-c table#table_1_wrapper #table_1[data-wpdatatable_id=8] tbody tr').on('click', function(e){
     	let schoolName = $(this).find('.column-schoolname').text();
     	let state = $(this).find('.column-state').text();
     	let district = $(this).find('.column-district').text();
     	let target = $('#ppe-details-modal');
     	target.find("#schoolName").text(schoolName)
     	target.find("#state").text(state)
     	target.find("#district").text(district)
     	target.modal('toggle');
     });
});
