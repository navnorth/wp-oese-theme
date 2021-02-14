let wpnn_preview_publish_button;
let wpnn_preview_element_html;
function oesePreviewDraftCopyToClipboard(element) {
  var copyText = document.getElementById("oese-preview-url-input");
  copyText.select(); 
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
  document.execCommand("copy");
  alert("Copied Preview URL: " + copyText.value);
}

/* **************** */
/* GUTENBERG STARTS */
/* **************** */

jQuery(window).bind("load", function() {  
  
  //Sidebar Observer (When it disappears/appers on publish)
  /*
  let { select, subscribe }  = wp.data;
  const { isSavingPost } = select( 'core/editor' );
  var checked = true; // Start in a checked state.
  subscribe( () => {
      if ( isSavingPost() ) {
  		 checked = false;
      } else {
   		if ( ! checked ) {
              checkPostAfterSave(); // Perform tasks after save
              checked = true;
          }

      }
  } );
  
  function checkPostAfterSave(){
    console.log('SAVED!');
  }
  */
  
  /*
  if(wp.data !== undefined){
      const blocks = wp.data.select('core/block-editor').getBlocks();
      blocks.map(val=>{
        if(val.name == 'cgb/block-oese-shortcodes-block'){
          var uniq = 'cb' + (new Date()).getTime()
          var cid = val.clientId
          var attr = wp.data.select( 'core/block-editor' ).getBlockAttributes(cid)
          if(attr.blockid){
            console.log(cid);
            console.log(attr);      
            //let n_val = attr['selectedShortodeValue'];
            //n_val = n_val.replace(/u003c/g,'<');
            //n_val = n_val.replace(/u003e/g,'>');
            //n_val = n_val.replace(/u0022/g,'"');
            //n_val = n_val.replace(/u0027/g,'"');
            //wp.data.dispatch( 'core/block-editor' ).updateBlockAttributes( cid, { selectedShortodeValue: n_val} );
            
            //let n_html = attr['selectedShortodeHtml'];
            //n_html = n_html.replace(/u003c/g,'<');
            //n_html = n_html.replace(/u003e/g,'>');
            //n_html = n_html.replace(/u0022/g,'"');
            //n_html = n_html.replace(/u0027/g,'"');
            //wp.data.dispatch( 'core/block-editor' ).updateBlockAttributes( cid, { selectedShortodeHtml: n_html} );        
          }      
        }else {
          var cid = val.clientId
          var attr = wp.data.select( 'core/block-editor' ).getBlockAttributes(cid)

            console.log(cid);
            console.log(attr);
          
        }
      });
  }
  */
  
  // POST STATUS CHANGE OBSERVER
  let { subscribe } = wp.data;
  let oldPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
  wpnnSetButton(oldPostStatus);
  const unssubscribe = subscribe( () => {
    const newPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
    if ( oldPostStatus !== newPostStatus) {
        if(oldPostStatus == 'draft' &&  newPostStatus == 'publish'){
        }else if(oldPostStatus == 'pending' &&  newPostStatus == 'publish'){
        }else if(oldPostStatus == 'publish' &&  newPostStatus == 'draft'){
          wpnnSetButton(newPostStatus);
        }
        oldPostStatus = newPostStatus;
    }
  });
  
  
  // Post Status Info Panel Drop/Undrop observer.
  var mutate_target_element = document.querySelector('.edit-post-layout');
  columnsettingobserver.observe(mutate_target_element, {childList: true, subtree: false});
  
});


var columnsettingobserver = new MutationObserver(function(mutations) {
    if(jQuery('.edit-post-sidebar .components-panel .edit-post-post-status').length > 0){ 
      wpnnSetButton();
    }
});

// Status And Visibility Panel Drop/Undrop click
jQuery(document).on('click','.edit-post-post-status .components-panel__body-title .components-panel__body-toggle',function(){
  wpnnSetButton();
})

// Sidbar Document Tab click
jQuery(document).on('click','button[data-label="Document"].edit-post-sidebar__panel-tab',function(e){
  wpnnSetButton();  
});

// Set Preview HTML/Button/URL Function
function wpnnSetButton(callback, newstatus){
  if (newstatus === undefined) {
      // newstatus was not passed
      newstatus = '&new='+wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );;
  }else{
     newstatus = '&new='+newstatus;
  }
  if(wp.apiFetch !== undefined){
    let pid = jQuery('form.metabox-base-form #post_ID').attr('value');
    wp.apiFetch({ url: '/wp-json/wpnnpreview/v2/elementquery?pid='+pid+newstatus}).then(data =>{      
        wpnn_preview_element_html = data['html'];
        
        Object.defineProperty(window, 'wpnn_preview_theme_url', {
          value: data['themedir'],
          configurable: false,
          writable: false
        });
        
        Object.defineProperty(window, 'wpnn_preview_isparent', {
          value: data['isparent'],
          configurable: false,
          writable: false
        });
        
        if(wpnn_preview_isparent == 'false' && !jQuery('a.editor-post-publish-panel__toggle').length ){ //Preview Type of post only
          wp.data.dispatch( 'core/editor' ).lockPostSaving( 'requiredValueLock' );
          jQuery('.editor-post-publish-panel__toggle').hide();
          v_btn = '<a href="'+wpnn_preview_theme_url+"/modules/oesepreview/oesepreview_ajax.php?action=wpnnTransitionHandlerGuten&old=draft&new=publish&pid="+pid+'" aria-disabled="false" aria-expanded="false" class="components-button editor-post-publish-panel__toggle is-button is-primary">Publish…</a>';
          wpnn_preview_publish_button = v_btn;
          jQuery(wpnn_preview_publish_button).insertAfter(".editor-post-publish-panel__toggle");
        }else{
          wp.data.dispatch( 'core/editor' ).unlockPostSaving( 'requiredValueLock' );
        }
        
        jQuery('.oese-preview-url-wrapper.gutenberg').remove();
        jQuery(wpnn_preview_element_html).insertAfter(".components-panel__body.edit-post-post-status .editor-post-trash");
        jQuery(".components-panel__body.edit-post-post-status .editor-post-trash").parent('.components-panel__row').addClass('wpnn-preview');
        typeof callback == 'function' && callback();      
    })
  }
  //if(!jQuery('.oese-preview-url-wrapper.gutenberg').length){
  /*
    let pid = jQuery('form.metabox-base-form #post_ID').attr('value');
    jQuery.ajax({
      type: 'POST',
      url: wp_nn_preview_ajax_object.ajaxurl,
      data: {'action':'wpnnPostButtonGuten','pid':pid},
      success: function (response) {
        
        var objJSON = JSON.parse(response);
        var nnhtmm = objJSON['data'];
        jQuery('body.wp-admin').attr('isparent',objJSON['isparent']);
        jQuery('.oese-preview-url-wrapper.gutenberg').remove();
        jQuery(".components-panel__body.edit-post-post-status").append(nnhtmm);
        typeof callback == 'function' && callback();
      },error: function () {

      }
    });
  */
  //}
}



/*
let wpnn_preview_new_status = '';
let wpnn_preview_old_status = '';
if(wp.data !== undefined){
    let { subscribe } = wp.data;
    let oldPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
    
    if ( 'publish' !== oldPostStatus ) { // From Draft To Publish
    	const unssubscribe = subscribe( () => {
    		const newPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
        //console.log('111-'+oldPostStatus);
    		if ( oldPostStatus !== newPostStatus && typeof(oldPostStatus) !== 'undefined' ) {
          if(wpnn_preview_new_status == '' && wpnn_preview_old_status == ''){
            wpnn_preview_new_status = newPostStatus;
            wpnn_preview_old_status = oldPostStatus;

            oldPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
            //wpnnStatusChange(newPostStatus, oldPostStatus);
            
            // REPOST TECHNIQUE START
            if(wpnn_preview_isparent == 'false'){
              let pid = jQuery('form.metabox-base-form #post_ID').attr('value');
              let rurl = wpnn_preview_theme_url+"/modules/oesepreview/oesepreview_ajax.php?action=wpnnTransitionHandlerGuten&old="+wpnn_preview_old_status+"&new="+wpnn_preview_new_status+"&pid="+pid;
              window.location.href = rurl;
            }else{
              wpnnSetButton();
            }      
          }
          
          // REPOST TECHNIQUE END
          
    		}
    	} );
    }

    if ( 'draft' !== oldPostStatus ) { //From Published To Draft
    	const unssubscribe = subscribe( () => {
    		const newPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
    		if ( oldPostStatus !== newPostStatus ) {
          oldPostStatus = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'status' );
    		}
    	} );
    }
}
*/

/*
function wpnnStatusChange(new_status, old_status){
  
  let pid = jQuery('form.metabox-base-form #post_ID').attr('value');
  console.log(pid);
  jQuery.ajax({
    type: 'POST',
    url: wp_nn_preview_ajax_object.ajaxurl,
    data: {'action':'wpnnTransitionHandlerGuten','new':new_status,'old':old_status,'pid':pid},
    success: function (response) {
      var nnhtmm = response;
      console.log(nnhtmm);
      wpnnSetButton(function(){
        if(nnhtmm){
          window.location.href = 'http://oese.localhost.localdomain/wp-admin/post.php?action=edit&post='+nnhtmm;
        }else{
          wpnnSetButton();
        }
      });
    },error: function () {

    }
  });
  
}
*/

/*
wp.data.subscribe(function () {
  var isSavingPost = wp.data.select('core/editor').isSavingPost();
  var isAutosavingPost = wp.data.select('core/editor').isAutosavingPost();

  if (isSavingPost && !isAutosavingPost) {
    console.log('nag save');
    if(!jQuery('.wp-nn-parentpage-display-wrapper').length){
      wpnnSetButton();    
    }
    
  }
})
*/

/*
const unsubscribe = wp.data.subscribe(function () {
let select = wp.data.select('core/editor');
var isSavingPost = select.isSavingPost();
var isAutosavingPost = select.isAutosavingPost();
var didPostSaveRequestSucceed = select.didPostSaveRequestSucceed();
if (isSavingPost && !isAutosavingPost && didPostSaveRequestSucceed) {
    console.log("isSavingPost && !isAutosavingPost && didPostSaveRequestSucceed");
    unsubscribe();

    // your AJAX HERE();
}
});
*/

/*
"use strict";
const {registerPlugin} = wp.plugins;
const {PluginDocumentSettingPanel} = wp.editPost;
const WpnnPreviewModulePanel = () => React.createElement(PluginDocumentSettingPanel, {
  name: "wp-nn-preview-panel",
  title: "Preview",
  className: "wp-nn-preview-panel"
  }, React.createElement("a", { 
                              className: "button",
                              href: 'https://www.google.com'},'Create Preview')   );

registerPlugin('wpnn-preview-module-panel', {
  render: WpnnPreviewModulePanel,
  icon: '',
});
wp.data.dispatch( 'core/edit-post' ).toggleEditorPanelOpened( 'wpnn-preview-module-panel/wp-nn-preview-panel' );
*/

/*
"use strict";
var _plugins = wp.plugins
var _editPost = wp.editPost;

const PluginPostStatusInfoTest = () => React.createElement(
      _editPost.PluginPostStatusInfo, 
      null,
      React.createElement(
            "div", 
            {classname:'oese-preview-url-wrapper gutenberg'}, 
            React.createElement(
                  "a", { 
                  className: "button",
                  href: 'https://www.google.com'},'Create Preview')
      )
);



(0, _plugins.registerPlugin)('post-status-info-test', {
  render: PluginPostStatusInfoTest
});
*/


