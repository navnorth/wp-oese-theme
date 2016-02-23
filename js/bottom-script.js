jQuery( document ).ready(function() {
    // Update Slide Title
    jQuery('.slideshow_container .slideshow_view .slideshow_slide').each(function(){
	var sImg = jQuery(this).find('a > img, img');
        var sHeight = sImg.height();
	var oTop = -40;
	if (sHeight>340) {
	    oTop = 340-sHeight+oTop;
	}
	if (jQuery(this).find('.slideshow_description_box .slideshow_title').length>0) {
	    jQuery(this).find('.slideshow_description_box .slideshow_title').css({ 'margin-top': oTop + 'px' });
	} else {
	    jQuery(this).height(sHeight);
	}
    });
});