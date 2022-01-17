!function(){"use strict";var e,t={502:function(){var e=window.wp.blocks,t=JSON.parse('{"TN":"Featured Item","W3":"oese-block-category","qv":"pressthis","WL":"Add featured item block","Y4":{"blockid":{"type":"string"},"oeseblkFeaturedItemHeading":{"type":"string"},"oeseblkFeaturedItemTitle":{"type":"string"},"oeseblkDeaturedItemTitleRows":{"type":"integer","default":1},"oeseblkFeaturedItemDate":{"type":"string"},"oeseblkFeaturedItemButtonDisplay":{"type":"boolean","default":true},"oeseblkFeaturedItemButtonText":{"type":"string","default":"Button Text"},"oeseblkFeaturedItemURL":{"type":"string","source":"attribute","selector":"a","attribute":"href"},"mediaID":{"type":"number","source":"attribute","attribute":"data-id","selector":"img"},"mediaURL":{"type":"string","source":"attribute","attribute":"src","selector":"img"},"thumbnail":{"type":"string","source":"attribute","attribute":"data-thumb","selector":"img"},"thumbnailsize":{"type":"integer"},"titlesize":{"type":"integer"},"oeseblkFeaturedItemOpeninnewtab":{"type":"boolean","default":false}}}'),a=window.wp.element,o=window.wp.i18n,r=window.wp.blockEditor,l=window.wp.components;const n=["image"];function i(e){let{mediaID:t,onSelect:o}=e;return(0,a.createElement)(r.MediaUploadCheck,null,(0,a.createElement)(r.MediaUpload,{onSelect:o,allowedTypes:n,value:t,render:e=>{let{open:t}=e;return(0,a.createElement)(l.Button,{onClick:t,className:"button button-large oese-featured-item-addedit-image-button noimage"},"Upload Image")}}))}function s(e){const t=e.attributes,n=e.setAttributes;let s=window.oercurrBlocksJson?(0,r.useBlockProps)():"";function c(e){e.map((e=>{if("oese-block/oese-featured-item-block"==e.name){var t="cb"+(new Date).getTime(),a=e.clientId;wp.data.select("core/block-editor").getBlockAttributes(a).blockid||wp.data.dispatch("core/block-editor").updateBlockAttributes(a,{blockid:t})}e.innerBlocks.length>0&&c(e.innerBlocks)}))}document.body.addEventListener("keydown",(function(e){if("Backspace"==e.key){let t=wp.data.select("core/block-editor").getSelectionStart();jQuery(e.target).closest(".oese_featured_item_block_wrapper").length&&"offset"in t&&0===t.offset&&e.preventDefault()}})),wp.data.select("core/block-editor").getBlocks().map((e=>{if("oese-block/oese-featured-item-block"==e.name){var t="cb"+(new Date).getTime(),a=e.clientId;wp.data.select("core/block-editor").getBlockAttributes(a).blockid||wp.data.dispatch("core/block-editor").updateBlockAttributes(a,{blockid:t})}else"core/group"!=e.name&&"core/columns"!=e.name||c(e.innerBlocks)})),new Date;let d=[];d=[["core/heading",{placeholder:"Publishing Date",className:"oese-featured-item-date oese-featured-item-date-ytr85g9wer",level:5,textColor:"oese-color-pallete-black"}],["core/paragraph",{placeholder:"Featured Item Description",className:"oese-featured-item-content oese-featured-item-content-ytr85g9wer",align:"left",textColor:"oese-color-pallete-black",fontSize:"normal"}]],jQuery(document).ready((function(){setTimeout((function(){}),500)}));let u=t.oeseblkFeaturedItemOpeninnewtab?"_blank":"_self";return(0,a.createElement)("div",s,(0,a.createElement)("div",{className:"oese_featured_item_block_wrapper"},(0,a.createElement)(r.InspectorControls,null,(0,a.createElement)(PanelBody,{title:(0,o.__)("Accordion Block settings"),initialOpen:!0},(0,a.createElement)("div",{class:"oese_featured_item_inspector_wrapper"},(0,a.createElement)(l.ToggleControl,{label:(0,o.__)("Show Button"),help:t.oeseblkFeaturedItemButtonDisplay?(0,o.__)("Show Featured Item Button","five"):(0,o.__)("Hide Featured Item Button","five"),checked:!!t.oeseblkFeaturedItemButtonDisplay,onChange:e=>{return a=!t.oeseblkFeaturedItemButtonDisplay,void n({oeseblkFeaturedItemButtonDisplay:a});var a}}),(0,a.createElement)("div",{class:"oese_featured_item_block_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Button Text:",(0,a.createElement)("input",{type:"text",class:"oese_featured_item_block_button_text_inspector_control",onChange:e=>{n({oeseblkFeaturedItemButtonText:e.target.value})},value:t.oeseblkFeaturedItemButtonText})),(0,a.createElement)("label",{class:"components-base-control__label"},"URL:",(0,a.createElement)("input",{type:"text",class:"oese_featured_item_block_URL_inspector_control",onChange:e=>{wp.data.select("core/block-editor").getSelectedBlock().innerBlocks.map((t=>{if("core/button"==t.name){var a=t.clientId;wp.data.dispatch("core/block-editor").updateBlockAttributes(a,{url:e.target.value})}})),n({oeseblkFeaturedItemURL:e.target.value})},value:t.oeseblkFeaturedItemURL})),(0,a.createElement)(l.ToggleControl,{label:(0,o.__)("Open in new tab"),help:t.oeseblkFeaturedItemOpeninnewtab?(0,o.__)("Open link in new tab","five"):(0,o.__)("Open link in the current tab","five"),checked:!!t.oeseblkFeaturedItemOpeninnewtab,onChange:e=>{return a=!t.oeseblkFeaturedItemOpeninnewtab,void n({oeseblkFeaturedItemOpeninnewtab:a});var a}})),(()=>{if(t.mediaURL)return(0,a.createElement)(l.RangeControl,{label:(0,o.__)("Image Size"),value:t.thumbnailsize,onChange:e=>{return a=e,t.blockid,void n({thumbnailsize:a,titlesize:100-a});var a},help:(0,o.__)("Image width in percentage","five"),min:10,max:100})})()))),(0,a.createElement)("div",{class:t.oeseblkFeaturedItemButtonDisplay?"oese-shortcode oese_featured_item_block oeseblk-"+t.blockid:"oese-shortcode oese_featured_item_block oeseblk-"+t.blockid+" hidebutton"},(0,a.createElement)("div",{class:"col-md-12 col-sm-12 col-xs-12 rght_sid_mtr lft_sid_mtr"},(0,a.createElement)("h4",{class:"oese_featured_item_header"},(0,a.createElement)("input",{type:"text",class:"oese-featured-item-header-input",onChange:e=>{n({oeseblkFeaturedItemHeading:e.target.value})},placeholder:"Featured Item Heading",value:t.oeseblkFeaturedItemHeading})),(0,a.createElement)("div",{class:t.mediaURL?"oese-featured-item-image-wrapper-float-left":"oese-featured-item-image-wrapper-float-left minheight",style:void 0!==t.thumbnailsize?{width:t.thumbnailsize+"%"}:{width:"auto"}},(0,a.createElement)("img",{src:t.mediaURL,class:t.mediaURL?"featured_item_image oese-featured-item-image":"hidden",alt:"featured_item_image"}),t.mediaURL?(0,a.createElement)(l.Button,{onClick:t=>{e.setAttributes({mediaID:void 0,mediaURL:void 0,thumbnail:void 0,thumbnailsize:void 0,titlesize:void 0})},className:"button button-large oese-featured-item-delete-image-button noimage"},(0,a.createElement)("span",{class:"dashicons dashicons-trash"})):(0,a.createElement)(i,{mediaID:t.mediaID,onSelect:e=>{n({mediaID:e.id,mediaURL:e.url,thumbnail:e.sizes.thumbnail.url,thumbnailsize:50,titlesize:50})}})),(0,a.createElement)("input",{type:"text",onChange:function(e){n({oeseblkFeaturedItemTitle:e.target.value})},value:t.oeseblkFeaturedItemTitle,class:"oese-featured-item-title",placeholder:"Featured Item Title",style:t.titlesize>10?{width:t.titlesize+"%",resize:"none"}:{width:"100%",resize:"none"}}),(0,a.createElement)(r.InnerBlocks,{allowedBlocks:["core/paragraph"],templateInsertUpdatesSelection:!1,template:d,templateLock:"all"}),(()=>{if(t.oeseblkFeaturedItemButtonDisplay)return(0,a.createElement)("a",{href:t.oeseblkFeaturedItemURL,class:"oese-featured-item-block-button no_target_change",target:u,rel:"noopener"},t.oeseblkFeaturedItemButtonText)})()))))}function c(e){const t=e.attributes;let o=t.oeseblkFeaturedItemOpeninnewtab?"_blank":"_self";return(0,a.createElement)("div",null,(0,a.createElement)("div",{className:"oese_featured_item_block_wrapper "+t.oeseblkFeaturedItemOpeninnewtab},(0,a.createElement)("div",{class:t.oeseblkFeaturedItemButtonDisplay?"oese-shortcode oese_featured_item_block oeseblk-"+t.blockid:"oese-shortcode oese_featured_item_block oeseblk-"+t.blockid+" hidebutton"},(0,a.createElement)("div",{class:"col-md-12 col-sm-12 col-xs-12 rght_sid_mtr lft_sid_mtr"},(0,a.createElement)("h4",{class:"oese_featured_item_header"},t.oeseblkFeaturedItemHeading),(0,a.createElement)("div",{class:"oese-featured-item-image-wrapper-float-left",style:void 0!==t.thumbnailsize?{width:t.thumbnailsize+"%"}:{margin:"0"}},(()=>{if(t.mediaURL)return""!==t.oeseblkFeaturedItemURL?(0,a.createElement)("a",{href:t.oeseblkFeaturedItemURL,class:"oese-featured-item-block-image_link no_target_change",target:o,rel:"noopener"},(0,a.createElement)("img",{src:t.mediaURL,class:"featured_item_image oese-featured-item-image",alt:""})):(0,a.createElement)("img",{src:t.mediaURL,class:"featured_item_image oese-featured-item-image",alt:""})})()),(0,a.createElement)("div",{class:"oese-featured-item-title"},(0,a.createElement)("a",{href:t.oeseblkFeaturedItemURL,class:"oese-featured-item-block-image_link no_target_change",target:o,rel:"noopener"},t.oeseblkFeaturedItemTitle)),(0,a.createElement)(r.InnerBlocks.Content,null),(()=>{if(t.oeseblkFeaturedItemButtonDisplay)return(0,a.createElement)("a",{href:t.oeseblkFeaturedItemURL,class:"oese-featured-item-block-button no_target_change",target:o,rel:"noopener"},t.oeseblkFeaturedItemButtonText)})()))))}const{__:__}=wp.i18n;window.oercurrBlocksJson="undefined"==typeof oese_featured_item_legacy_marker,window.oercurrBlocksJson?(0,e.registerBlockType)("oese-block/oese-featured-item-block",{edit:s,save:c,example:()=>{}}):(0,e.registerBlockType)("oese-block/oese-featured-item-block",{title:__(t.TN),icon:t.qv,description:__(t.WL),category:t.W3,keywords:[__("oese"),__("featured"),__("item"),__("block")],attributes:t.Y4,edit:s,save:c,example:()=>{}})}},a={};function o(e){var r=a[e];if(void 0!==r)return r.exports;var l=a[e]={exports:{}};return t[e](l,l.exports,o),l.exports}o.m=t,e=[],o.O=function(t,a,r,l){if(!a){var n=1/0;for(d=0;d<e.length;d++){a=e[d][0],r=e[d][1],l=e[d][2];for(var i=!0,s=0;s<a.length;s++)(!1&l||n>=l)&&Object.keys(o.O).every((function(e){return o.O[e](a[s])}))?a.splice(s--,1):(i=!1,l<n&&(n=l));if(i){e.splice(d--,1);var c=r();void 0!==c&&(t=c)}}return t}l=l||0;for(var d=e.length;d>0&&e[d-1][2]>l;d--)e[d]=e[d-1];e[d]=[a,r,l]},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,46:0};o.O.j=function(t){return 0===e[t]};var t=function(t,a){var r,l,n=a[0],i=a[1],s=a[2],c=0;if(n.some((function(t){return 0!==e[t]}))){for(r in i)o.o(i,r)&&(o.m[r]=i[r]);if(s)var d=s(o)}for(t&&t(a);c<n.length;c++)l=n[c],o.o(e,l)&&e[l]&&e[l][0](),e[n[c]]=0;return o.O(d)},a=self.webpackChunkoese_featured_item_block=self.webpackChunkoese_featured_item_block||[];a.forEach(t.bind(null,0)),a.push=t.bind(null,a.push.bind(a))}();var r=o.O(void 0,[46],(function(){return o(502)}));r=o.O(r)}();