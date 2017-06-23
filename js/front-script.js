jQuery( document ).ready(function() {
    jQuery('#page_template').on('change', function() {
	  //alert(this.value);
	});

	jQuery(".fa-bars").click(function(){
		jQuery(".menu-primary-menu-container").css("display", "block");
		jQuery(".responsiv-menu_ul").css("display", "block");
   		jQuery(".responsiv-menu").slideToggle("slow");
 	});
	jQuery(".fa-print").click(function(){
		window.print();
	});

	var heght = jQuery("#lnk_btn_cntnr_center").height()
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
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').removeClass('fa-sort-asc')
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').addClass('fa-sort-desc')
		} else {
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').removeClass('fa-sort-desc')
		    jQuery('.responsiv-menu .responsiv-menu_ul > li.menu-item-has-children > .mobile-parent-menu').addClass('fa-sort-asc')
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

    //Wrap youtube video with video container
    jQuery("iframe[src*='youtube.com']").wrap("<div class='video-container'></div>");

    //Set the height of mega menu left to the height of the entire mega menu
    if (jQuery(".oii-mega-menu-left").length) {
	jQuery(".oii-mega-menu-left").height(jQuery(".oii-mega-menu").css('height'));
    }
    
    jQuery("#state-btn").on("click", function(){
	var state_url = jQuery("#us-states").val();
	if (state_url) {
	    window.location.href = state_url;
	}
    });
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

});

function oii_redirect_state(form) {
    var state = document.getElementById("us-states");
    if (state=="") {
	return false;
    } else {
	var url;
	switch (state) {
	    case "AL":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/alabama-state-regulations/";
		break;
	    case "AK":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/alaska-state-regulations/";
		break;
	    case "AS":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/american-samoa-regulations/";
		break;
	    case "AZ":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/arizona-state-regulations/";
		break;
	    case "AR":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/arkansas-state-regulations/";
		break;
	    case "CA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/california-state-regulations/";
		break;
	    case "CO":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/colorado-state-regulations/";
		break;
	    case "CT":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/connecticut-state-regulations/";
		break;
	    case "DE":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/district-columbia-regulations/";
		break;
	    case "DC":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/american-samoa-regulations/";
		break;
	    case "FL":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/florida-state-regulations/";
		break;
	    case "GA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/georgia-state-regulations/";
		break;
	    case "GU":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/guam-regulations/";
		break;
	    case "HI":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/hawaii-state-regulations/";
		break;
	    case "ID":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/idaho-state-regulations/";
		break;
	    case "IL":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/illinois-state-regulations/";
		break;
	    case "IN":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/indiana-state-regulations/";
		break;
	    case "IA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/iowa-state-regulations/";
		break;
	    case "KS":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/kansas-state-regulations/";
		break;
	    case "KY":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/kentucky-state-regulations/";
		break;
	    case "LA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/louisiana-state-regulations/";
		break;
	    case "ME":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/maine-state-regulations/";
		break;
	    case "MD":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/maryland-state-regulations/";
		break;
	    case "MA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/massachusetts-state-regulations/";
		break;
	    case "MI":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/michigan-state-regulations/";
		break;
	    case "MN":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/minnesota-state-regulations/";
		break;
	    case "MS":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/mississippi-state-regulations/";
		break;
	    case "MO":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/missouri-state-regulations/";
		break;
	    case "MT":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/montana-state-regulations/";
		break;
	    case "NE":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/nebraska-state-regulations/";
		break;
	    case "NV":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/nevada-state-regulations/";
		break;
	    case "NH":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/new-hampshire-state-regulations/";
		break;
	    case "NJ":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/new-jersey-state-regulations/";
		break;
	    case "NM":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/new-mexico-state-regulations/";
		break;
	    case "NY":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/new-york-state-regulations/";
		break;
	    case "NC":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/north-carolina-state-regulations/";
		break;
	    case "ND":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/north-dakota-state-regulations/";
		break;
	    case "MP":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/northern-marina-island-regulations/";
		break;
	    case "OH":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/ohio-state-regulations/";
		break;
	    case "OK":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/oklahoma-state-regulations/";
		break;
	    case "OR":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/oregon-state-regulations/";
		break;
	    case "PA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/pennsylvania-state-regulations/";
		break;
	    case "PR":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/puerto-rico-regulations/";
		break;
	    case "RI":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/rhode-island-state-regulations/";
		break;
	    case "SC":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/south-carolina-state-regulations/";
		break;
	    case "SD":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/south-dakota-state-regulations/";
		break;
	    case "TN":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/tennessee-state-regulations/";
		break;
	    case "TX":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/texas-state-regulations/";
		break;
	    case "UT":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/utah-state-regulations/";
		break;
	    case "VT":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/vermont-state-regulations/";
		break;
	    case "VI":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/virgin-islands-regulations/";
		break;
	    case "VA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/virginia-state-regulations/";
		break;
	    case "WA":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/washington-state-regulations/";
		break;
	    case "WV":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/west-virginia-state-regulations/";
		break;
	    case "WI":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/wisconsin-state-regulations/";
		break;
	    case "WY":
		url = "https://innovation.ed.gov/resources/state-nonpublic-education-regulation-map/wyoming-state-regulations/";
		break;
	    default:
		break;
	}
	if (url) {
	    window.href.url = url;
	    return true;
	} else {
	    return false;
	}
    }
}
