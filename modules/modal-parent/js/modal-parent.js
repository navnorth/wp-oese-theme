$.noConflict();
jQuery( document ).ready(function() {

    jQuery(document).on('click','.wp-nn-parentpage-select',function(e){
		e.preventDefault ? e.preventDefault() : e.returnValue = false;
		var selone = jQuery('input[name="wp-nn-parentpage-rad"]:checked');
		var vl = selone.val();
		var parentname = selone.attr('title');
		var parentid = selone.val();
		jQuery('input[name="wp-nn-parentpage-prev-selected"]').val(vl);
		jQuery('#parent_id').val(parentid);
		jQuery('#wp-nn-parentpage-display').val(parentname);
		jQuery('.wp-nn-parentpage-overlay').css('visibility', 'hidden').removeClass('fadeIn').addClass('fadeOut');
	});

	jQuery(document).on('click','.wp-nn-parentpage-display-change',function(e){
		e.preventDefault ? e.preventDefault() : e.returnValue = false;
		jQuery('.wp-nn-tag-p').removeClass('checked');
		var prv = jQuery('input[name="wp-nn-parentpage-prev-selected"]').val();
		var rad = jQuery('input:radio[name="wp-nn-parentpage-rad"][value='+prv+']');
		rad.attr('checked', true);
		rad.parent().addClass('checked');
		jQuery('.wp-nn-parentpage-overlay').removeClass('fadeOut').addClass('fadeIn').css('display', 'block').css('visibility', 'visible');
		jQuery('input[name="wp-nn-parentpage-criteria"]').val('');
		jQuery('#wp-nn-parentpage-dynahide').remove();
	});

	jQuery(document).on('change','input[name="wp-nn-parentpage-rad"]', function(){
		jQuery('.wp-nn-tag-p').removeClass('checked');
		jQuery(this).parent().addClass('checked');
	});

	jQuery(document).on('click','.wp-nn-parentpage-search-close', function(e){
		e.preventDefault ? e.preventDefault() : e.returnValue = false;
		jQuery('.wp-nn-parentpage-overlay').removeClass('fadeIn').addClass('fadeOut');
		setTimeout(function(){ jQuery('.wp-nn-parentpage-overlay').css('display', 'none').css('visibility', 'hidden') }, 800);
	});

	jQuery(document).on('input','input[name="wp-nn-parentpage-criteria"]', function(e) {
		console.log('RUN');
		var searchTerm = jQuery.trim(this.value).toLowerCase();
		jQuery('#wp-nn-parentpage-dynahide').remove();
		if(searchTerm > ''){
		  jQuery('#wp-nn-parentpage-dynahide').remove();
		  css = '.wp-nn-parentpage-search-result .wp-nn-tag-p:not([data-search-term*="'+searchTerm+'"]){display:none;}'
		  style = jQuery('<style type="text/css" id="wp-nn-parentpage-dynahide">').text(css)
		  jQuery('head').append(style);
		}
	});

});
