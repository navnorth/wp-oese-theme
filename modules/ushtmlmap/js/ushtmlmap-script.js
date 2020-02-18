jQuery(document).ready(function(e) {
	jQuery('img[usemap]').ushtmlmaps();
	jQuery('img[usemap]').maphilight({ stroke: false, fillColor: 'ffffff', fillOpacity: .4 });
	
	jQuery('area').on('click', function(e) {
		e.preventDefault ? e.preventDefault() : e.returnValue = false;
		var shrt = jQuery(this).attr('shrt');
    var href = jQuery(this).attr('href');
		shrt = shrt.toLowerCase()
    if (typeof href !== typeof undefined && href !== false) {
      window.open(href);
    }else{
		  window.open("https://www2.ed.gov/admins/lead/account/performance/map/"+shrt+".html");
	  }
  });
	jQuery(document).on('mousemove','area',function(e){
		clearTimeout(removeTooltip);
		jQuery('.oese-map-tooltip').remove();
		var ctnt = '<table>';
		ctnt += '<tr><td>'+jQuery(this).attr('tooltip')+'</td></tr>';
		ctnt += '<tr><td>Click for State Information</td></tr>';
		ctnt += '</table>';
		var htm = '<div class="oese-map-tooltip" style="display:none;">'+ctnt+'</div>';
		jQuery('body').append(htm);
		var x = jQuery(".oese-map-content").offset();
		var halfY = x.top + ((jQuery('.oese-map-content').height() / 5) * 4);
		var halfX = x.left + (jQuery('.oese-map-content').width() / 2);
		var tooltiptop = (e.pageY > halfY)? tooltiptop = -115: 40;
		var tooltipleft = (e.pageX > halfX)? tooltipleft = -220: 0;
		jQuery('.oese-map-tooltip').css({
			top: e.pageY + tooltiptop + 'px',
			left: e.pageX + tooltipleft + 'px',
			display: 'block'
		});
	});
	var removeTooltip;
	jQuery(document).on('mouseout','area',function(){
		removeTooltip = setTimeout(function(){
			jQuery('.oese-map-tooltip').hide(200, function(){
				jQuery('.oese-map-tooltip').remove();
			});
        }, 200);
	});
	var cur = '';
	jQuery('img').click(function(e) {
		var offset = jQuery(this).offset();
		var xy = ", " + Math.floor((e.pageX - offset.left)) + ", " + Math.floor((e.pageY - offset.top));
	});
	//jQuery(window).on('resize.usemaps',function(){
	/*
	jQuery(window).bind('resize', function(e){
        clearTimeout(resizeEvt);
        var resizeEvt = setTimeout(function(){
            jQuery('img[usemap]').maphilight({ stroke: false, fillColor: 'ffffff', fillOpacity: .4 });
			console.log('RESIZED');
        }, 200);
    });
	*/
	jQuery(window).bind('resize', function(e){    
    jQuery('img[usemap]').maphilight({ stroke: false, fillColor: 'ffffff', fillOpacity: .4 });   
  });
	 
	jQuery(document).on('change','#oese-map-dropdown',function(){
		shrt = jQuery('#oese-map-dropdown option:selected').val().toLowerCase()
		window.open("https://www2.ed.gov/admins/lead/account/performance/map/"+shrt+".html");     
	});
  
});


;(function($) {
	$.fn.ushtmlmaps = function() {
		var $img = this;

		var ushtmlmap = function() {
			$img.each(function() {
				if (typeof($(this).attr('usemap')) == 'undefined')
					return;

				var that = this,
					$that = $(that);

				$('<img />').on('load', function() {
					var attrW = 'width',
						attrH = 'height',
						w = $that.attr(attrW),
						h = $that.attr(attrH);

					if (!w || !h) {
						var temp = new Image();
						temp.src = $that.attr('src');
						if (!w)
							w = temp.width;
						if (!h)
							h = temp.height;
					}

					var wPercent = $that.width()/100,
						hPercent = $that.height()/100,
						map = $that.attr('usemap').replace('#', ''),
						c = 'coords';

					$('map[name="' + map + '"]').find('area').each(function() {
						var $this = $(this);
						if (!$this.data(c))
							$this.data(c, $this.attr(c));

						var coords = $this.data(c).split(','),
							coordsPercent = new Array(coords.length);

						for (var i = 0; i < coordsPercent.length; ++i) {
							if (i % 2 === 0)
								coordsPercent[i] = parseInt(((coords[i]/w)*100)*wPercent);
							else
								coordsPercent[i] = parseInt(((coords[i]/h)*100)*hPercent);
						}
						$this.attr(c, coordsPercent.toString());
					});
				}).attr('src', $that.attr('src'));
			});
		};
		$(window).resize(ushtmlmap).trigger('resize');

		return this;
	};
})(jQuery);