jQuery(window).bind("load", function() {
    //YOUTUBE API
    console.log("API LOADED");
    setTimeout(function(){
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }, 1000);
});

var oese_recommended_resources_block_player = [];
function onYouTubeIframeAPIReady() {
  jQuery.each(jQuery('.oese-recommended-resources-block.video'), function(i, elm) { 
    let blkid = jQuery(elm).attr('blkid');
    console.log(blkid);
    oese_recommended_resources_block_player[blkid] = new YT.Player('oese-recommended-resources-block-embed-'+blkid, {
      height: 'auto',
      width: '800',
      videoId: jQuery('#oese-recommended-resources-block-embed-'+blkid).attr('vid'),
      playerVars: {
        autoplay: 0, // Auto-play the video on load
        controls: 1, // Show pause/play buttons in player
        showinfo: 0, // Hide the video title
        modestbranding: 1, // Hide the Youtube Logo
        loop: 0, // Run the video in a loop
        fs: 0, // Hide the full screen button
        cc_load_policy: 0, // Hide closed captions
        iv_load_policy: 3, // Hide the Video Annotations
        autohide: 0, // Hide video controls when playing
        rel: 0
      },
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
    
    jQuery(document).on('click','.oese-recommended-resources-block-wrapper-'+blkid+' .oese-recommended-resources-block-wrapper',function(e){
      jQuery('body').addClass('modal-open');
      jQuery('.oese-recommended-resources-block-embed-'+blkid).show(500);
      setTimeout(function(){
        oese_recommended_resources_block_player[blkid].playVideo();
      }, 1000);
    })
    
    jQuery(document).on('click','.oese-recommended-resources-block-embed-'+blkid,function(e){
      jQuery('body').removeClass('modal-open');
      oese_recommended_resources_block_player[blkid].pauseVideo();
      jQuery(this).closest('.oese-recommended-resources-block-embed-'+blkid).hide(500);
    })
    
    var pauseFlag = false;
    function onPlayerStateChange(event) {
      let vttl = jQuery('#oese-recommended-resources-block-embed-'+blkid).attr('ttl');
      let vdid = jQuery('#oese-recommended-resources-block-embed-'+blkid).attr('vid');
      
      // track when user clicks to Play
      if (event.data == YT.PlayerState.PLAYING) {
        //ga('send', 'event','Recommended Resources: '+ vttl, 'Play', vdid);
        pauseFlag = true;
      }
      
      // track when user clicks to Pause
      if (event.data == YT.PlayerState.PAUSED && pauseFlag) {
        //ga('send', 'event','Recommended Resources: '+ vttl, 'Pause', vdid);
        pauseFlag = false;
      }
      
      // track when video ends
      if (event.data == YT.PlayerState.ENDED) {
        //ga('send', 'event','Recommended Resources: '+ vttl, 'Finished', vdid);
      }
      
    }
    
    function onPlayerReady(event) {
      //console.log('player is ready');
    }

    var done = false;
    function onPlayerReady(event) {
      // do nothing, no tracking needed
    }
    
  });
  
  
}


function oeseRecommendedResourcesBlockDynamicChange(blkid, vid){
  if(oese_recommended_resources_block_player[blkid]){
    if(vid !== ""){
      oese_recommended_resources_block_player[blkid].loadVideoById(vid);
      oese_recommended_resources_block_player[blkid].stopVideo();
    }else{
      oese_recommended_resources_block_player[blkid].destroy();
    }
  }
    
}

function oeseRecommendedResourcesBlockFirstLoad(blkid) {

    oese_recommended_resources_block_player[blkid] = '';
    jQuery('#oese-recommended-resources-block-embed-'+blkid).html('');
    oese_recommended_resources_block_player[blkid] = new YT.Player('oese-recommended-resources-block-embed-'+blkid, {
      height: 'auto',
      width: '800',
      videoId: jQuery('#oese-recommended-resources-block-embed-'+blkid).attr('vid'),
      playerVars: {
        autoplay: 0, // Auto-play the video on load
        controls: 1, // Show pause/play buttons in player
        showinfo: 0, // Hide the video title
        modestbranding: 1, // Hide the Youtube Logo
        loop: 0, // Run the video in a loop
        fs: 0, // Hide the full screen button
        cc_load_policy: 0, // Hide closed captions
        iv_load_policy: 3, // Hide the Video Annotations
        autohide: 0, // Hide video controls when playing
        rel: 0
      }
    });
  
  
}