jQuery.noConflict();
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
  
  jQuery(document).on('click','.wp-nn-parentpage-select-guten',function(e){
		e.preventDefault ? e.preventDefault() : e.returnValue = false;
		
    var selone = jQuery('input[name="wp-nn-parentpage-rad"]:checked');
		var vl = selone.val();
		var parentname = selone.attr('title');
		var parentid = selone.val();
    wp.data.dispatch( 'core/editor' ).editPost({parent:parseInt(parentid)});
		jQuery('input[name="wp-nn-parentpage-prev-selected"]').val(vl);
    jQuery('#wp-nn-parentpage-display').attr('value',parentname);
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
    setTimeout(function(){
      jQuery('input[name="wp-nn-parentpage-criteria"]').focus();
    }, 500);
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

//LOAD HTML
let wp_nn_loop_interval;
function load_parent_modal_html(){
  if (jQuery('.components-base-control.editor-page-attributes__order').length > 0 && jQuery('.wp-nn-parentpage-search-result').length > 0) {
    let cid = jQuery('.wp-nn-parentpage-display-wrapper').attr('cid');
    var vlu = wp.data.select( 'core/editor' ).getEditedPostAttribute('parent');
    wp.apiFetch({ url: '/wp-json/wpnnmodalparent/v2/getparentbyid?pid='+vlu}).then(data =>{     
      clearInterval(wp_nn_loop_interval);
      targetElemID = wp.data.select( 'core/editor' ).getEditedPostAttribute('parent');
      var ttl = data;
      ttl = (ttl === undefined)? '(no parent)': ttl;
      vlu = (vlu === undefined)? 0: vlu;
      htm = '';
            htm += '<div id="wp-nn-parentpage-display-wrapper" class="wp-nn-parentpage-display-wrapper" cid="'+wp.data.select( 'core/editor' ).getCurrentPostId()+'">';
              htm += '<div class="wp-nn-parentpage-display-block">';
                htm += '<input name="wp-nn-parentpage-display" type="text" id="wp-nn-parentpage-display" value="'+ttl+'" readonly="readonly">';
                htm += '<input type="button" class="button  wp-nn-parentpage-display-change" value="Change">';
              htm += '</div>';
            htm += '</div>';
          console.log('Still Here');
      jQuery('#wp-nn-parentpage-display-wrapper').remove();
      jQuery(htm).insertBefore(jQuery(".components-base-control.editor-page-attributes__order").closest('.components-panel__row'));
    })
  }
}

jQuery(document).on('click','button[data-label="Document"].edit-post-sidebar__panel-tab',function(e){
  if(!jQuery('.wp-nn-parentpage-display-wrapper').length){
    wp_nn_loop_interval = setInterval(load_parent_modal_html, 100);
  }
});

//AFTER DOM IS LOADED
let targetElemID = '';
var mutate_parent_value_element;
var mutate_parent_selector_element;
jQuery(window).bind("load", function() { 
  if(jQuery('.components-drop-zone__provider').length > 0){
    // Observer Open and Closing of the Workflow Column
    mutate_parent_selector_element = document.querySelector('.edit-post-layout');  
    load_parent_modal_html();
    
    // Observer Expand and Collapse of the Page Attribute Panel    
    wpnnParentPageComponenetsPanelObserver.observe(document.querySelector('.edit-post-sidebar'), {childList: true, subtree: true});
    // Observer for Settings Sidebar Settings Button  
    wpnnParentPageColumnsettingobserver.observe(document.querySelector('.edit-post-layout'), {childList: true, subtree: false});
    
  }
});

var wpnnParentPageComponenetsPanelObserver = new MutationObserver(function(mutations) {
    if(jQuery('.components-base-control.editor-page-attributes__order').length > 0){
        jQuery(document).on('click','.components-panel__body',function(){
          setTimeout(function(){
            if(jQuery('.components-base-control.editor-page-attributes__order').length > 0){
              load_parent_modal_html();
            }else{
              jQuery('#wp-nn-parentpage-display-wrapper').remove();
            }
          }, 100);
        })
        wpnnParentPageComponenetsPanelObserver.observe(document.querySelector('.edit-post-sidebar'), {childList: true, subtree: true});
    }
});

var wpnnParentPageColumnsettingobserver = new MutationObserver(function(mutations) {
    if(jQuery('.edit-post-sidebar .components-panel .edit-post-post-status').length > 0){ 
      load_parent_modal_html();
    }
});

