

jQuery( window ).load(function() {
  setTimeout(function(){
    oese_gutenberg_toolbar_observer_func.observe(document.querySelector(".edit-post-visual-editor .popover-slot"), {childList: true, subtree: true });
  }, 500);
  var oese_gutenberg_toolbar_observer_func = new MutationObserver(function(mutations) { oese_gutenberg_toolbar_enpoint_script();});
  function oese_gutenberg_toolbar_enpoint_script(){
    var oese_target = jQuery('.edit-post-visual-editor');
    oese_gutenberg_toolbar_observer_clear_classes(oese_target);
    if(jQuery('.edit-post-visual-editor .popover-slot').html().length > 0){
      var oese_title_selected = jQuery('.oese-featured-item-title-ytr85g9wer').hasClass('is-selected');
      var oese_date_selected = jQuery('.oese-featured-item-date-ytr85g9wer').hasClass('is-selected');
      var oese_button_selected = jQuery('.oese-featured-item-button-ytr85g9wer').hasClass('is-selected');
      if(oese_title_selected || oese_date_selected){
          oese_target.addClass('oese-featured-item-title-toolbar-hide');
      }else if(oese_button_selected){
          oese_target.addClass('oese-featured-item-button-toolbar-hide');
      }
    }
    jQuery('.oese_featured_item_block_wrapper .block-list-appender').hide();
  }
  
});

function oese_gutenberg_toolbar_observer_clear_classes(tgt){
  tgt.removeClass('oese-featured-item-title-toolbar-hide oese-featured-item-button-toolbar-hide');
}