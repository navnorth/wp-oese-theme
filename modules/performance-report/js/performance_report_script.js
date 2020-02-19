jQuery( document ).ready(function() {
  
  jQuery(document).on('click','#oese-perfrep-nav tr td a.oese_perfrep_nav_button',function(e){
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    var v = jQuery('.oese-perfrep-search input[type="search"]').val().trim();
    getPerfrep(this,v,srt['col'],srt['dir'],srt['ent']);
  });
  
  var typingTimer;
  jQuery('.oese-perfrep-search input[type="search"]').keyup(function(e){
    if (e.key != "Tab" || e.key != "Tab") {
     clearTimeout(typingTimer);
     typingTimer = setTimeout(applysearch, 1000); 
    }
  });
    
  jQuery(document).on('click','table#oese-perfrep-table tr th a',function(e){
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      var v = jQuery('.oese-perfrep-search input[type="search"]').val().trim();
      var col = jQuery(this).attr('col');
      var dir;
      if(jQuery(this).hasClass('headerSortAsc')){
        dir = 'desc';
      }else{
        dir = 'asc';
      }
      srt['col'] = col;
      srt['dir'] = dir;
      getPerfrep(this,v,srt['col'],srt['dir'],srt['ent']);
  });
  
  jQuery(document).on('change','.oese-perfrep-showentries-select',function(e){
        var ent = jQuery(this).children("option:selected").val();
        srt['ent'] = ent;
        var v = jQuery('.oese-perfrep-search input[type="search"]').val().trim();
        getPerfrep(this, v,srt['col'],srt['dir'],srt['ent']);
    });
  
});

function applysearch(){
  var v = jQuery('.oese-perfrep-search input[type="search"]').val().trim();
  getPerfrep(this, v,srt['col'],srt['dir'],srt['ent']);
}

var srt = [];
srt['ent'] = 10;
srt['col'] = 'state';
srt['dir'] = 'asc';
function getPerfrep(obj,crit,col,dir,ent){
  var pre = jQuery('.oese-perfrep-preloader');
  var fixstate = jQuery('#oese-perfrep-table').attr('stt');
  pre.show(200);
  var attributes = {};
  attributes['action'] = 'retrieveperfrep';
  attributes['stt'] = (fixstate)? fixstate: '';
  attributes['page'] = jQuery(obj).attr('pg');
  attributes['crit'] = (typeof crit != 'undefined')? crit: '';
  attributes['col'] = (typeof col != 'undefined')? col: 'state';
  attributes['dir'] = (typeof dir != 'undefined')? dir: 'asc';
  attributes['ent'] = (typeof ent != 'undefined')? ent: 10;
  
  var ret = '';
  jQuery.ajax({
    type:'POST',
    url: perfrep_ajax_object.ajaxurl,
    data: attributes,
    success:function(response){
      jQuery('.oese-perfrep-content-block').html(response);
      pre.hide(200);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
       alert("Error rendering data, please try again.");
       pre.hide(200);
    }
  });
  return ret;
}

jQuery.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};
