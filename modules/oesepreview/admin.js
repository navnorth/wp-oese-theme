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
  
  // POST STATUS CHANGE OBSERVER
  if(wpoesePreviewGlobal['oeseIsGutenbergActive'] == 'true'){ //Gutenberg Editor is in use
    var screen_type = (wp.data === undefined)?'none': wp.data.select('core/editor').getCurrentPostAttribute('type');
    if(screen_type == 'page' || screen_type == 'post'){
      
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
              /* load_parent_modal_html() */;
            }
            oldPostStatus = newPostStatus;
        }
      });
      
      // Post Status Info Panel Drop/Undrop observer.
      var mutate_target_element = document.querySelector('.edit-post-layout');
      columnsettingobserver.observe(mutate_target_element, {childList: true, subtree: false});
      
    }
    
    setTimeout(function(){
      var oese_preview_observer_target = document.querySelectorAll(".edit-post-sidebar__panel-tab");
      for (var i = 0; i < oese_preview_observer_target.length; i++) {
        create_preview_observer(oese_preview_observer_target[i]);
      }
      function create_preview_observer(elementToObserve){
        var create_preview_observer = new MutationObserver(function(mutations) {
          mutations.forEach(function(mutation){
            var oese_active_panel = mutation.target.attributes.getNamedItem('data-label').value;
            if(oese_active_panel == 'Page' && mutation.target.classList.contains('is-active')){ //page is active
              setTimeout(function(){ wpnnSetButton() }, 100);
            } //else block is active
          })
        });
        create_preview_observer.observe(elementToObserve, {attributes: true, childList: false, characterData: false, subtree: false });
      }
    }, 500);
    

  }
  
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

// Sidbar Page Tab click
jQuery(document).on('click','button[data-label="Page"].edit-post-sidebar__panel-tab',function(e){
  wpnnSetButton();  
});

// Sidbar Post Tab click
jQuery(document).on('click','button[data-label="Post"].edit-post-sidebar__panel-tab',function(e){
  wpnnSetButton();  
});

// Detect focus on title block
jQuery(document).on('focus','.editor-post-title__input',function(){
  setTimeout(function(){
    wpnnSetButton(); 
  }, 100);
})

// Prevent accidental published
jQuery(document).on('click','.oese-preview-publish-button',function(e){
  e.preventDefault ? e.preventDefault() : e.returnValue = false;
  var targeturl = jQuery(this).attr('href');
  var oesePubConfirmAns = confirm('Publishing this preview will overwrite its original.\r\nIf you only want to save this preview, please use "Save Draft".\r\n\r\n Would you like to publish this preview?');
  if (oesePubConfirmAns == true) {
    window.location.href = targeturl;
  }
})

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
          v_btn = '<a href="'+wpnn_preview_theme_url+"/modules/oesepreview/oesepreview_ajax.php?action=wpnnTransitionHandlerGuten&old=draft&new=publish&pid="+pid+'" aria-disabled="false" aria-expanded="false" class="components-button editor-post-publish-panel__toggle is-button is-primary oese-preview-publish-button">Publish…</a>';
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

}

