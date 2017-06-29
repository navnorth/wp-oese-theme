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

/*function oii_redirect_state() {
    event.preventDefault();
    
    var url;
    var state = document.getElementById("oerstate").value;
    
    if (state=="") {
	return false;
    } else {
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
	    window.location.href = url;
	    return true;
	}  else {
	    return false;
	}
    }
} */   