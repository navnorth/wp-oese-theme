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

    jQuery('.wp-nn-parentpage-display-block .components-select-control__input').val(parentid);
		jQuery('input[name="wp-nn-parentpage-prev-selected"]').val(vl);
		jQuery('.wp-nn-parentpage-display-block #'+targetElemID).val(parentid);
    jQuery('.wp-nn-parentpage-display-block #'+targetElemID).attr('value',parentid);
    jQuery('#wp-nn-parentpage-display').attr('value',parentname);
		jQuery('#wp-nn-parentpage-display').val(parentname);
		jQuery('.wp-nn-parentpage-overlay').css('visibility', 'hidden').removeClass('fadeIn').addClass('fadeOut');
    
    /*
    jQuery('.editor-page-attributes__parent select.components-select-control__input').removeAttr('selected');
    jQuery('.editor-page-attributes__parent select.components-select-control__input option[value='+parentid+']').attr('selected','selected').trigger('change');
    jQuery('.editor-page-attributes__parent select.components-select-control__input').focus().attr('value',parentid);
    jQuery('.editor-page-attributes__parent select.components-select-control__input').focus().val(parentid);
    */
    
    /*
    jQuery.ajax({
      type: 'POST',
      url: wp_nn_parentpage_ajax_object.ajaxurl,
      data: {'action':'wpnnAjaxParentPageUpdate', 'pid': parentid, 'cid':jQuery('.wp-nn-parentpage-display-wrapper').attr('cid')},
      success: function (response) {
        console.log(response);
      },error: function (error) {
        console.log(error);
      }
    });
    */
    
    /*
    let cid = jQuery('.wp-nn-parentpage-display-wrapper').attr('cid');
    wp.apiFetch({ url: '/wp-json/wpnnmodalparent/v2/updatequery?pid='+parentid+'&cid='+cid}).then(data =>{ 
      console.log(data);
    })
    */
    
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
let wp_nn_loop_interval, screen_type;
jQuery(window).bind("load", function() {
  /*
  screen_type = (wp.data === undefined)?'none': wp.data.select('core/editor').getCurrentPostAttribute('type');
  if(screen_type == 'page'){
    //wp_nn_loop_interval = setInterval(load_parent_modal_html, 100);    
    var ttl = jQuery('.wp-nn-parentpage-rad.checked').attr('title');
    //var vlu = jQuery('.wp-nn-parentpage-rad.checked').attr('value');
    var vlu = wp.data.select( 'core/editor' ).getCurrentPostAttribute('parent');
    ttl = (ttl === undefined)? '(no parent)': ttl;
    vlu = (vlu === undefined)? 0: vlu;
    htm = '';
    
    "use strict";
    const {registerPlugin} = wp.plugins;
    const {PluginDocumentSettingPanel} = wp.editPost;
    const WpnnPreviewModulePanel = () => React.createElement(
      PluginDocumentSettingPanel, {
      name: "wpnn-parent-page-selector-panel",
      title: "Parent Page Selector",
      className: "wpnn-parent-page-selector-panel"}, 
      
      React.createElement("div",{ 
          className: "wp-nn-parentpage-display-wrapper",
          id: "wp-nn-parentpage-display-wrapper",
          cid: jQuery('form.metabox-base-form #post_ID').attr('value')},
          
          
          React.createElement("div",{ 
              className: "components-base-control editor-page-attributes__template"},    
              React.createElement("div",{ 
                  className: "components-base-control__field"},    
                  React.createElement("div",{ 
                      className: "wp-nn-parentpage-display-block"},
                      React.createElement("label",{
                          for: "wp-nn-parentpage-display",
                          className: "components-base-control__label"},
                          "Parent Page:"   
                      ),
                      React.createElement("input",{
                          name: "wp-nn-parentpage-display",
                          type: "text",
                          id: "wp-nn-parentpage-display",
                          value: ttl,
                          //readonly: "readonly",
                          className: "wp-nn-parentpage-display-block tagsdiv"},    
                      ),
                      React.createElement("input",{
                          type: "text",
                          id: targetElemID,
                          value: vlu,
                          readonly: "readonly",
                          className: "components-select-control__input"}
                      ),
                      React.createElement("input",{
                          type: "button",
                          value: "Change",
                          readonly: "readonly",
                          className: "button wp-nn-parentpage-display-change"}
                      )
                                
                  ),
                  
              ),
          
          ),
          
      )
    
    );

    registerPlugin('wpnn-preview-module-panel', {
      render: WpnnPreviewModulePanel,
      icon: ''
    });
    wp.data.dispatch( 'core/edit-post' ).toggleEditorPanelOpened( 'wpnn-preview-module-panel/wp-nn-preview-panel' );
    jQuery('.components-base-control.editor-page-attributes__parent').hide();
    
    
  }
  */
});

function load_parent_modal_html(){
  //if (jQuery('.editor-page-attributes__parent .components-select-control__input').length > 0 && jQuery('.wp-nn-parentpage-search-result').length > 0) {
    let cid = jQuery('.wp-nn-parentpage-display-wrapper').attr('cid');
    var vlu = wp.data.select( 'core/editor' ).getCurrentPostAttribute('parent');
    wp.apiFetch({ url: '/wp-json/wpnnmodalparent/v2/getparentbyid?pid='+vlu}).then(data =>{ 
      clearInterval(wp_nn_loop_interval);
      targetElemID = jQuery('.editor-page-attributes__parent .components-select-control__input').attr('id');
      var ttl = data;
      ttl = (ttl === undefined)? '(no parent)': ttl;
      vlu = (vlu === undefined)? 0: vlu;
      htm = '';
            htm += '<div id="wp-nn-parentpage-display-wrapper" class="wp-nn-parentpage-display-wrapper" cid="'+jQuery('form.metabox-base-form #post_ID').attr('value')+'">';
              htm += '<div class="wp-nn-parentpage-display-block">';
                htm += '<input name="wp-nn-parentpage-display" type="text" id="wp-nn-parentpage-display" value="'+ttl+'" readonly="readonly">';
        				htm += '<input id="'+targetElemID+'" type="hidden" class="components-select-control__input" value="'+vlu+'" class="tagsdiv">';
                htm += '<input type="button" class="button  wp-nn-parentpage-display-change" value="Change">';
              htm += '</div>';
            htm += '</div>';

      jQuery('#wp-nn-parentpage-display-wrapper').remove();
      jQuery(htm).insertAfter(".components-base-control.editor-page-attributes__parent .components-select-control__input");
    })
    
      
      //jQuery('.editor-page-attributes__parent').hide();
  //}
}

jQuery(document).on('click','button[data-label="Document"].edit-post-sidebar__panel-tab',function(e){
  if(!jQuery('.wp-nn-parentpage-display-wrapper').length){
    wp_nn_loop_interval = setInterval(load_parent_modal_html, 100);
  }
});



//SUBSCRIBE TO STATUS Change
/*
let { select, subscribe } = wp.data;
const { isSavingPost } = select( 'core/editor' );
var wpnnSubscribeStatus = true; // Start in a checked state.
subscribe( () => {
    if ( isSavingPost() ) {
      console.log('Saving');
		    wpnnSubscribeStatus = false;
    }else{
 		   if (!wpnnSubscribeStatus) {
            console.log('AFTER SAVE');
            //wpnnParentModalAfterSaveFunc() // Perform your custom handling here.
            wpnnSubscribeStatus = true;
        }
    }
});


function wpnnParentModalAfterSaveFunc(){
  //let new_parent = wp.data.select( 'core/editor' ).getEditedPostAttribute('parent');
  var selone = jQuery('input[name="wp-nn-parentpage-rad"]:checked');
  var parent_id = selone.val();
  var parentname = selone.attr('title');
  console.log(parent_id+' - '+parentname);
  setTimeout(function(){
    jQuery('#wp-nn-parentpage-display').attr('value',parentname).val(parentname);
    jQuery('.wp-nn-parentpage-display-block #'+targetElemID).val(parent_id);
  }, 1000);
}
*/



//AFTER DOM IS LOADED
let targetElemID = '';
var mutate_parent_value_element;
var mutate_parent_selector_element;
jQuery(window).bind("load", function() { 
  if(jQuery('.components-drop-zone__provider').length > 0){
    // Observer Open and Closing of the Workflow Column
    mutate_parent_selector_element = document.querySelector('.edit-post-layout');
    
    load_parent_modal_html(); //wpnnParentPagePublishToggleObserver.observe(mutate_parent_selector_element, {childList: true, subtree: false});
    
    
    // Observer Expand and Collapse of the Page Attribute Panel    
    wpnnParentPageComponenetsPanelObserver.observe(document.querySelector('.edit-post-sidebar'), {childList: true, subtree: true});
    // Observer for Settings Sidebar Settings Button  
    wpnnParentPageColumnsettingobserver.observe(document.querySelector('.edit-post-layout'), {childList: true, subtree: false});
    
  }
});

// Function to Observe Open and Closing of the Workflow Column
/*
var wpnnParentPagePublishToggleObserver = new MutationObserver(function(mutations) {
  load_parent_modal_html();
})
*/

var wpnnParentPageComponenetsPanelObserver = new MutationObserver(function(mutations) {
    if(jQuery('.editor-page-attributes__parent .components-select-control__input').length > 0){
      if(targetElemID ==''){
        targetElemID = jQuery('.editor-page-attributes__parent .components-select-control__input').attr('id');
        load_parent_modal_html();
        jQuery(document).on('mousedown','#'+targetElemID ,function(e){
          e.preventDefault ? e.preventDefault() : e.returnValue = false;
        });
        
        jQuery(document).on('click','.components-panel__body',function(){
          setTimeout(function(){
            if(jQuery('.editor-page-attributes__parent .components-select-control__input').length > 0){
              load_parent_modal_html();
            }
          }, 10);
        })
      }else{
        //wpnnParentPageComponenetsPanelObserver.disconnect();
        //load_parent_modal_html();
        wpnnParentPageComponenetsPanelObserver.observe(document.querySelector('.edit-post-sidebar'), {childList: true, subtree: true});
        
      }
    }
});

var wpnnParentPageColumnsettingobserver = new MutationObserver(function(mutations) {
    if(jQuery('.edit-post-sidebar .components-panel .edit-post-post-status').length > 0){ 
      load_parent_modal_html();
    }
});

