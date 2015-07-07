jQuery(document).ready(function() {
    /**
     * Page Template Change jQuery Event Handler
     * Description
     */
    jQuery('#page_template').change(function() {
        var page_template = jQuery(this).val()
        var template = jQuery('#oii-template').attr('data-template').split('|');
        
        if (template.indexOf(page_template) == -1) {
            jQuery('#contact-metabox').addClass('hidden')
        
        } else {
            jQuery('#contact-metabox').removeClass('hidden')
        }
    })
})