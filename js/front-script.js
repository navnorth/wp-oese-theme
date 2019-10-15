jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});

	jQuery(".fa-bars").click(function(){
		jQuery(".menu-primary-menu-container").css("display", "block");
		jQuery(".responsiv-menu_ul").css("display", "block");
		jQuery('.mobile-nav-icons i').toggleClass("fa-bars fa-times");
   		jQuery(".responsiv-menu").slideToggle("slow");
 	});

	jQuery(".fa-print").click(function(){
		window.print();
	});

    var heght = jQuery("#lnk_btn_cntnr_center").height();
    jQuery(".link_dwnlds").height(heght);

	var a_hght = jQuery(".link_dwnlds").children("div").children("a").height();
	a_hght = parseInt(a_hght) + parseInt(30);
	var a_margin = parseInt(heght) - parseInt(a_hght);
	a_margin = a_margin/2;
	jQuery(".link_dwnlds").children("div").children("a").css("margin-top", a_margin+"px");

	/** Keyboard Navigation using Keydown event **/
	jQuery('.nav-menu > .menu-item > a').on('keydown',function(e){
	    if (e.which==40) { /* Down Arrow Key */
		/* Check if current menu item has a child menu */
		if (jQuery(this).parent().has('.sub-menu').length > 0) {
		    subMenu = jQuery(this).parent().find('.sub-menu');
		    subMenu.show();
		    subMenu.focus();
		} else {
		    jQuery(this).parent().next().find('a').focus();
		}
	       return false;
	    }
	    if (e.which==38) { /* Up Arrow Key */
		/* Check if sub menu is visible, then hide*/
		 if (jQuery(this).parent().has('.sub-menu').is(':visible')) {
		    jQuery(this).parent().find('.sub-menu').hide();
		    jQuery(this).parent().find('.sub-menu').removeAttr('style');
		}
		return false;
	    }
	});
	jQuery('.nav-menu > .menu-item > a').on('mouseenter' , function(){
	     if (jQuery(this).parent().has('.sub-menu')) {
		jQuery('.sub-menu').removeAttr('style');
	     }
	});
	jQuery('.nav-menu > .menu-item > a').on('focus' , function(){
	     if (jQuery(this).parent().has('.sub-menu').length==0) {
		jQuery('.sub-menu').hide();
	     } else {
		jQuery(this).parent().find('.sub-menu').show();
	     }
	});
	
	/** Mobile Menu **/
	if (jQuery('.responsiv-menu').length>0) {
	    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > a').after('<i class="fa fa-sort-asc mobile-parent-menu" aria-hidden="true"></i>');
	    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').on('click' , function(){
	     if (jQuery(this).parent().has('.sub-menu').length==0) {
		jQuery('.sub-menu').hide();
	     } else {
		jQuery(this).parent().find('.sub-menu').toggle();
		if (jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').hasClass('fa-sort-asc')){
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').removeClass('fa-sort-asc');
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').addClass('fa-sort-desc');
		} else {
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').removeClass('fa-sort-desc');
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').addClass('fa-sort-asc');
		}
	     }
	});
	}

    // set external links to open in new window and have distinct style
    jQuery('a').each(function() {
	var a = new RegExp('' + window.location.host + '|mailto' , 'i');
        if(!a.test(this.href)) {
            jQuery(this).attr( 'target','_blank' );
            jQuery(this).addClass( 'external_link' );
        }
    });
    
    jQuery('svg a').each(function() {
	if (jQuery(this).attr('target')) {
	    jQuery(this).removeAttr( 'target' );
	}
	if (jQuery(this).hasClass( 'external_link' )) {
	    jQuery(this).removeClass( 'external_link' );
	}
    });
    
    if (jQuery('#searchform.searchform a.external_link').length>0){
	jQuery('#searchform.searchform a.external_link').removeAttr('target');
	jQuery('#searchform.searchform a.external_link').removeClass( 'external_link' );
    }

    //Wrap youtube video with video container
    jQuery("iframe[src*='youtube.com']").wrap("<div class='video-container'></div>");

    //Set the height of mega menu left to the height of the entire mega menu
    if (jQuery(".oii-mega-menu-left").length) {
	jQuery(".oii-mega-menu-left").height(jQuery(".oii-mega-menu").css('height'));
    }
    
    // Accordion Menu
    /*jQuery('.nav-menu li .sub-menu li a').hover(function(){
	if(!jQuery(this).next().is(":visible"))
	{
		jQuery(this).next().slideDown("slow");
	}
    });*/

    // Replace SVGs with PNG on unsupported browsers
    if (!Modernizr.svg) {
        jQuery('img.svg-replace[src*="svg"]').attr('src', function() {
            return jQuery(this).attr('src').replace('.svg', '.png');
        });
        //jQuery('*[class=".slideshow_container_style-light .slideshow_pagination ul li"]').css('background', 'url(../images/slider_pager.png) 0 0 no-repeat !important;');
        console.log('Replaced SVG images with PNG');
    }
    
    
    if (jQuery('.tab-close-button').length){
        jQuery('.tab-close-button').removeAttr('target').removeClass('external_link');
        
        jQuery('.tab-close-button').on("click", function(e){
            close_tab(this);
        });
    }
    
    /** move cursor to top on pagination click **/
    jQuery(document).on("click", '.wdm_results .paginate_div li a.paginate', function(e){
        e.preventDefault();
        var offset = jQuery('.wdm_results').offset();
        window.scrollTo(offset.top, offset.left);
    });
    
    jQuery(document).ajaxComplete(function(event, request, settings){
        console.log(settings);
        setTimeout(displayNext10Results(),1000);
        setTimeout(displayPrev10Results(),1000);
    });
    
    displayNext10Results();
    displayPrev10Results();
    
    /** Select State on Interactive Map Redirection **/
    jQuery('#SelectState').on("change", function(){
        var url = jQuery(this).val();
        window.location = url;
    });
});

function close_tab(close_button){
    curtab = jQuery(close_button).closest('.tab-pane.active');
    curtabid = curtab.attr('id');
    curtab.removeClass('active');
    jQuery('#mobileSidebarTab a[href="#' + curtabid +'"]').removeClass('active');
}

function displayNext10Results() {
    /** Insert Next 10 results button on the fly **/
    if (jQuery('.paginate_div #pagination-flickr').is(":visible")) {
        var nextPage = jQuery('.cls_search form .ui-widget input[id="paginate"]').val();
        if (nextPage==0) {
            nextPage = 1;
        }
        
        nextPage = parseInt(nextPage) + 1;
        var next10 = '<li><a class="paginate show next" href="javascript:void(0)" id="' + nextPage + '">Next 10 Results</a></li>';
        jQuery('.paginate_div #pagination-flickr').append(next10);
    }
}

function displayPrev10Results() {
    /** Insert Prev 10 results button on the fly **/
    if (jQuery('.paginate_div #pagination-flickr').is(":visible")) {
        var curPage = jQuery('.cls_search form .ui-widget input[id="paginate"]').val();
        if (curPage==0 || curPage==1)
            return;
        
        prevPage = parseInt(curPage) - 1;
        var prev10 = '<li><a class="paginate show prev" href="javascript:void(0)" id="' + prevPage + '">Previous 10 Results</a></li>';
        jQuery('.paginate_div #pagination-flickr').prepend(prev10);
    }
}

// Event Tracker Function
function oese_trackEvent(eventCategory, eventAction, eventLabel, eventValue = null) {
    eventLabel = eventLabel.toString();

    // To make all google event param in lower case
    eventLabel      = eventLabel.toLowerCase();
    eventAction     = eventAction.toLowerCase();
    eventCategory   = eventCategory.toLowerCase();
    
    if (typeof ga != 'undefined' && ga != null){
        if(eventValue == null)
          return ga('send', 'event',eventCategory,eventAction,eventLabel)
        else
          eventValue = eventValue.toLowerCase()
          return ga('send', 'event',eventCategory,eventAction,eventLabel,eventValue)
    }
    return 0;
}
