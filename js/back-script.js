jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	 });
    // Enable Crazy Egg Script Checkbox change handler
    jQuery('#wp_oese_theme_include_crazy_egg_script').on("change", function(){
      jQuery('#wp-oese-theme-settings .settings-error').hide();
      if (this.checked){
        jQuery('#wp_oese_theme_crazy_egg_script_address').prop("disabled", false);
      } else {
        jQuery('#wp_oese_theme_crazy_egg_script_address').prop("disabled", true);
      }
    });
    jQuery('#wp_oese_theme_crazy_egg_script_address').on('blur', function(e){
      var errorDisplay = jQuery('#wp-oese-theme-settings').find(".settings-error");
      if (jQuery('#wp_oese_theme_include_crazy_egg_script').is(":checked") && (!jQuery(this).val())) {
        errorDisplay.show()
        errorDisplay.removeClass('hidden').css("color","#ff0000");
      }

    });
    jQuery('.contact-edit').on("click", function(e){
        e.preventDefault();
        if (confirm('Are you sure that you want to change the global Contact page selection?')==true){
            jQuery('#wp_oese_theme_contact_page').show();
            jQuery(this).hide();
            jQuery('.contact-edit-link').hide();
        }
    });
    jQuery('.oese-tabs').tabs();
})



/* ******************** */
/* PERMALINK VALIDATION */
/* ******************** */
jQuery( document ).ready(function() {
  var posttype = getPostType();
  if(posttype != 'undefined' && (posttype == 'page' || posttype == 'post')){
    //Save Draft Button
    if(jQuery('#minor-publishing-actions #save-action #save-post').length){
      var btnText = jQuery('#minor-publishing-actions #save-action #save-post').attr('value');
      jQuery('#minor-publishing-actions #save-action #save-post').hide();
      jQuery('<input type="submit" name="save" id="secondary-save-post" value="'+btnText+'" class="button">').insertAfter(jQuery('#minor-publishing-actions #save-action #save-post'));
    }
    //Publish Button
    if(jQuery("#publish").length){
      var btnText = jQuery("#publish").attr('value');
      jQuery("#publish").hide();
      jQuery('#publishing-action').append('<input type="submit" name="publish" id="secondary-publish" class="button button-primary button-large" value="'+btnText+'">')
    }
  }
  //Save Draft Title Field Enter Key Event
  jQuery(document).on('keydown','input[name="post_title"]',function(e){
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if(keycode == '13'){
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
    }
  })
  //Secondary Update Button Click Event
  jQuery(document).on('click','#secondary-save-post',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    if(!jQuery('body').hasClass('home')){
      jQuery('input[name="post_title"]').trigger('blur');    
      var checkExist = setInterval(function() {
         if (jQuery('span#editable-post-name').length) {
            clearInterval(checkExist);
            interceptPublish('dft');
         }
      }, 100); // check every 100ms
    }else{
      jQuery("#publish").click();
    } 
  })
  //Publish Button Click Event
  jQuery(document).on('click','#secondary-publish',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    
    var element = document.getElementById("oese-preview-draft-publish-warning");
    if(typeof(element) != 'undefined' && element != null){
      var r = confirm('WARNING: Publishing this preview will overwrite its original version.\r\n\r\nIf you only wish to save this revision for review, please cancel this prompt and click "Save Draft" button instead.');
      if (r == true) {
        if(!jQuery('body').hasClass('home')){
          jQuery('input[name="post_title"]').trigger('blur');    
          var checkExist = setInterval(function() {
             if (jQuery('span#editable-post-name').length) {
                clearInterval(checkExist);
                interceptPublish('pub');
             }
          }, 100); // check every 100ms    
        }else{
          jQuery("#publish").click();
        } 
      }
    }else{
      if(!jQuery('body').hasClass('home')){
        jQuery('input[name="post_title"]').trigger('blur');    
        var checkExist = setInterval(function() {
           if (jQuery('span#editable-post-name').length) {
              clearInterval(checkExist);
              interceptPublish('pub');
           }
        }, 100); // check every 100ms    
      }else{
        jQuery("#publish").click();
      }
    }
    
    
    /*
    var element = document.getElementById("oese-preview-url-input");
    if(typeof(element) != 'undefined' && element != null){
      var r = confirm("WARNING: Publishing this revision will overwrite its original.");
      if (r == true) {    
        if(!jQuery('body').hasClass('home')){
          jQuery('input[name="post_title"]').trigger('blur');    
          var checkExist = setInterval(function() {
             if (jQuery('span#editable-post-name').length) {
                clearInterval(checkExist);
                interceptPublish('pub');
             }
          }, 100); // check every 100ms    
        }else{
          jQuery("#publish").click();
        }  
      }
    }else{
      if(!jQuery('body').hasClass('home')){
        jQuery('input[name="post_title"]').trigger('blur');    
        var checkExist = setInterval(function() {
           if (jQuery('span#editable-post-name').length) {
              clearInterval(checkExist);
              interceptPublish('pub');
           }
        }, 100); // check every 100ms    
      }else{
        jQuery("#publish").click();
      }  
    }
    */
    
  })
  //Notice Dismiss
  jQuery(document).on('click','.oese-permalink-validation-notice-dismiss',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    jQuery('.oese-prohibitedpermalinktext.notice').hide(100,function(){
      jQuery('.oese-prohibitedpermalinktext.notice').remove();
    });    
  })
  
})

var itvl;
function interceptPublish(typ){
    
    if(jQuery('input#new-post-slug').length){
        var slug = jQuery('input#new-post-slug').val(); 
    }else{
        var slug = jQuery('span#editable-post-name').text(); 
    }
    var prhbt = ["admin", "login", "user"];  
    var found = false;
    prhbt.forEach(function(item) {
        var idx = slug.indexOf(item);
        if(idx == 0){//found in the beginning
          found = true;
        }
    });
    if(found){
      var html = '<div class="oese-prohibitedpermalinktext notice notice-error is-dismissible" style="display:none;"><p>Please make sure the permalink doesn\'t begin with words such as <strong>admin, login, and user</strong> as they are known to cause issues</p><button type="button" class="oese-permalink-validation-notice-dismiss notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
      if (!jQuery('.oese-prohibitedpermalinktext').length){
        jQuery(html).insertAfter('hr.wp-header-end');
        jQuery('.oese-prohibitedpermalinktext').show(100);
      }
    }else{
      if(typ == 'pub'){
        jQuery("#publish").click();
      }else if(typ == 'dft'){
        jQuery("#save-post").click();
      }
    }

}

function getPostType(){
    var postType; var ret;
    var attrs = jQuery( 'body' ).attr( 'class' ).split( ' ' );
    jQuery( attrs ).each(function() {
      if (this.indexOf("post-type-") >= 0){
				postType = this.split( 'post-type-' );
        postType = postType[ postType.length - 1 ];	
				ret = postType;	
			}	
		});
  return ret;
}

function ispagehome(){
  var ret = false;
  if ( jQuery('body').hasClass('home')) {
      ret = true;
  }
  return ret;
}
    
