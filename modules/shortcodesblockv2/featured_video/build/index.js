!function(){"use strict";var e,o={502:function(){var e=window.wp.blocks,o=JSON.parse('{"TN":"Featured Video","W3":"oese-block-category","qv":"video-alt3","WL":"Add featured video block","Y4":{"blockid":{"type":"string"},"clientid":{"type":"string"},"youtubeid":{"type":"string"},"oeseblkFeaturedVideoHeading":{"type":"string"}}}'),t=window.wp.element,a=window.wp.i18n,l=window.wp.blockEditor;window.wp.components;const{__:__}=wp.i18n;window.oercurrBlocksJson=oese_featured_video_isjson,(0,e.registerBlockType)("oese-block/oese-featured-video-block",{title:__(o.TN),icon:o.qv,description:__(o.WL),category:o.W3,keywords:[__("oese"),__("disruptive"),__("content"),__("block")],attributes:o.Y4,edit:function(e){const o=e.attributes,d=e.setAttributes;let c=window.oercurrBlocksJson?(0,l.useBlockProps)():"";function r(e){e.map((e=>{if("oese-block/oese-featured-video-block"==e.name){var o="cb"+(new Date).getTime(),t=e.clientId;wp.data.select("core/block-editor").getBlockAttributes(t).blockid||wp.data.dispatch("core/block-editor").updateBlockAttributes(t,{blockid:o})}e.innerBlocks.length>0&&r(e.innerBlocks)}))}return wp.data.select("core/block-editor").getBlocks().map((e=>{if("oese-block/oese-featured-video-block"===e.name){var o="cb"+(new Date).getTime(),t=e.clientId;wp.data.select("core/block-editor").getBlockAttributes(t).blockid||wp.data.dispatch("core/block-editor").updateBlockAttributes(t,{blockid:o})}else"core/group"!=e.name&&"core/columns"!=e.name||r(e.innerBlocks)})),o.blockid?(document.body.addEventListener("keydown",(function(e){if("Backspace"==e.key){let o=wp.data.select("core/block-editor").getSelectionStart();jQuery(e.target).closest(".oese_featured_video_wrapper").length&&"offset"in o&&0===o.offset&&e.preventDefault()}})),(0,t.createElement)("div",c,(0,t.createElement)(InspectorControls,null,(0,t.createElement)(PanelBody,{title:(0,a.__)("Featured Video settings"),initialOpen:!0},(0,t.createElement)("div",{class:"oet_featured_video_inspector_wrapper"},(0,t.createElement)("label",{class:"components-base-control__label"},"Video ID",(0,t.createElement)("input",{type:"text",onChange:e=>{d({youtubeid:e.target.value})},value:o.youtubeid}))))),(0,t.createElement)("div",{id:"oese-featured-video-block-wrapper-"+o.blockid,class:"oese-featured-video-block-wrapper oese-featured-video-block-wrapper-"+o.blockid},(0,t.createElement)("input",{type:"hidden",class:"oese-featured-video-block-youtubeid",value:o.youtubeid}),(0,t.createElement)("div",{class:"col-xs-12"},(0,t.createElement)("h4",{class:"oese_featured_video_block_header"},(0,t.createElement)("input",{type:"text",class:"oese-featured-video-block-header-input",onChange:e=>{d({oeseblkFeaturedVideoHeading:e.target.value})},placeholder:"Featured Video Heading",value:o.oeseblkFeaturedVideoHeading})),(0,t.createElement)("div",{class:"oese-featured-video-block-embed"},(0,t.createElement)("img",{src:"https://img.youtube.com/vi/"+o.youtubeid+"/mqdefault.jpg",alt:""}),(0,t.createElement)("div",{class:"oese-featured-video-block-vertical-center"},(0,t.createElement)("div",{id:"oese-featured-video-block-play-button-"+o.blockid,class:"oese-featured-video-block-play-button"}))),(0,t.createElement)(l.InnerBlocks,{allowedBlocks:["core/paragraph"],templateInsertUpdatesSelection:!1,template:[["core/paragraph",{placeholder:"Description Here",className:"oese-featured-video-block-description oese-featured-video-block-description-ytr85g9wer",textColor:"black",fontSize:"normal"}]],templateLock:"all"}),(0,t.createElement)("div",{id:"oese-featured-video-block-modal-"+o.blockid,class:"oese-featured-video-block-modal oese-featured-video-block-modal-"+o.blockid},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-center"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-table"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-cell"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-container"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-embed-content",id:"oese-featured-video-block-modal-embed-content-"+o.blockid}))))),(0,t.createElement)("div",{class:"oese-featured-video-block-modal-close"},(0,t.createElement)("span",{class:"dashicons dashicons-no"}))))))):"Loading block attributes"},save:function(e){const o=e.attributes;return(0,t.createElement)("div",{id:"oese-featured-video-block-wrapper-"+o.blockid,class:"oese-featured-video-block-wrapper oese-featured-video-block-wrapper-"+o.blockid},(0,t.createElement)("input",{type:"hidden",class:"oese-featured-video-block-youtubeid",value:o.youtubeid}),(0,t.createElement)("div",{class:"col-xs-12"},(0,t.createElement)("h4",{class:"oese_featured_video_block_header"},o.oeseblkFeaturedVideoHeading),(0,t.createElement)("div",{class:"oese-featured-video-block-embed"},(0,t.createElement)("img",{src:"https://img.youtube.com/vi/"+o.youtubeid+"/mqdefault.jpg",alt:""}),(0,t.createElement)("div",{class:"oese-featured-video-block-vertical-center"},(0,t.createElement)("div",{id:"oese-featured-video-block-play-button-"+o.blockid,class:"oese-featured-video-block-play-button"}))),(0,t.createElement)(l.InnerBlocks.Content,null),(0,t.createElement)("div",{id:"oese-featured-video-block-modal-"+o.blockid,class:"oese-featured-video-block-modal oese-featured-video-block-modal-"+o.blockid},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-center"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-table"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-cell"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-container"},(0,t.createElement)("div",{class:"oese-featured-video-block-modal-embed-content",id:"oese-featured-video-block-modal-embed-content-"+o.blockid}))))),(0,t.createElement)("div",{class:"oese-featured-video-block-modal-close"},(0,t.createElement)("span",{class:"dashicons dashicons-no"})))))},example:()=>{}})}},t={};function a(e){var l=t[e];if(void 0!==l)return l.exports;var d=t[e]={exports:{}};return o[e](d,d.exports,a),d.exports}a.m=o,e=[],a.O=function(o,t,l,d){if(!t){var c=1/0;for(n=0;n<e.length;n++){t=e[n][0],l=e[n][1],d=e[n][2];for(var r=!0,i=0;i<t.length;i++)(!1&d||c>=d)&&Object.keys(a.O).every((function(e){return a.O[e](t[i])}))?t.splice(i--,1):(r=!1,d<c&&(c=d));if(r){e.splice(n--,1);var s=l();void 0!==s&&(o=s)}}return o}d=d||0;for(var n=e.length;n>0&&e[n-1][2]>d;n--)e[n]=e[n-1];e[n]=[t,l,d]},a.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},function(){var e={826:0,46:0};a.O.j=function(o){return 0===e[o]};var o=function(o,t){var l,d,c=t[0],r=t[1],i=t[2],s=0;if(c.some((function(o){return 0!==e[o]}))){for(l in r)a.o(r,l)&&(a.m[l]=r[l]);if(i)var n=i(a)}for(o&&o(t);s<c.length;s++)d=c[s],a.o(e,d)&&e[d]&&e[d][0](),e[c[s]]=0;return a.O(n)},t=self.webpackChunkoese_featured_video_block=self.webpackChunkoese_featured_video_block||[];t.forEach(o.bind(null,0)),t.push=o.bind(null,t.push.bind(t))}();var l=a.O(void 0,[46],(function(){return a(502)}));l=a.O(l)}();