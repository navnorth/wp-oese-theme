jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});
    jQuery('.contact-edit').on("click", function(e){
        e.preventDefault();
        if (confirm('Are you sure that you want to change the global Contact page selection?')==true){
            jQuery('#wp_oese_theme_contact_page').show();
            jQuery(this).hide();
            jQuery('.contact-edit-link').hide();
        }
    });
});