!function(){"use strict";var e,t={259:function(){var e=window.wp.blocks,t=JSON.parse('{"TN":"Featured Card Block","W3":"oese-block-category","qv":"awards","WL":"Add Featured Card Block","Y4":{"blockid":{"type":"string"},"title":{"type":"string"},"content":{"type":"string"},"titleRows":{"type":"integer","default":1},"contentRows":{"type":"integer","default":1},"buttonText":{"type":"string","default":"Read More"},"url":{"type":"string"},"background":{"type":"string"}}}'),r=window.wp.element,a=window.wp.i18n,l=window.wp.blockEditor,o=window.wp.components;const{__:__}=wp.i18n;window.oercurrBlocksJson=oese_featured_card_block_localized.isjson,(0,e.registerBlockType)("oese-block/oese-featured-card-block",{title:__(t.TN),icon:t.qv,description:__(t.WL),category:t.W3,keywords:[__("oese"),__("subpages")],attributes:t.Y4,edit:function(e){const t=e.attributes,n=e.setAttributes;let c=window.oercurrBlocksJson?(0,l.useBlockProps)():"",s=void 0===t.background?oese_featured_card_block_localized.blockurl+"oese_featured_card_block_bg.png":t.background;const u=["image"];function d(e,t,r){const a=e.className;e.setAttribute("rows",1);const l=parseInt((e.scrollHeight-r)/t);"oese_featured_card_block_title_text"==a?n({titleRows:l}):"oese_featured_card_block_content_text"==a&&n({contentRows:l}),e.setAttribute("rows",l)}let i=t.title,_=t.content,b=t.buttonText,p=t.url;return(0,r.createElement)("div",c,(0,r.createElement)(InspectorControls,null,(0,r.createElement)(PanelBody,{title:(0,a.__)("Featured Card Settings"),initialOpen:!0},(0,r.createElement)("div",{class:"oese_featured_card_inspector_wrapper css-wdf2ti-Wrapper"},(0,r.createElement)("label",{class:"components-base-control__label"},"Title",(0,r.createElement)("textarea",{rows:t.titleRows,class:"oese_featured_card_block_title_text",onChange:e=>{let t=e.target.value;n({title:t});let r=window.getComputedStyle(e.target).lineHeight.replace("px","");d(jQuery(e.target)[0],r,0)},value:t.title,placeholder:"Title Here"})),(0,r.createElement)("label",{class:"components-base-control__label"},"Description",(0,r.createElement)("textarea",{rows:t.contentRows,class:"oese_featured_card_block_content_text",onChange:e=>{let t=e.target.value;n({content:t});let r=window.getComputedStyle(e.target).lineHeight.replace("px","");d(jQuery(e.target)[0],r,0)},value:t.content,placeholder:"Content Here"})),(0,r.createElement)("label",{class:"components-base-control__label"},"Button Text",(0,r.createElement)("input",{type:"text",class:"oese_featured_card_block_button_text",onChange:e=>{let t=e.target.value;n({buttonText:t})},value:t.buttonText,placeholder:"Button Text"})),(0,r.createElement)("label",{class:"components-base-control__label"},"URL",(0,r.createElement)("input",{type:"text",class:"oese_featured_card_block_url_text",onChange:e=>{let t=e.target.value;n({url:t.trim()})},value:t.url,placeholder:"URL Here"})),(0,r.createElement)("label",{class:"components-base-control__label"},"Background Image URL",(0,r.createElement)("input",{type:"text",class:"oese_featured_card_block_background_text",onChange:e=>{let t=e.target.value;t.trim()>""?n({background:t}):n({background:void 0})},value:t.background,placeholder:"URL Here"}),(0,r.createElement)((function(e){let{mediaID:t,onSelect:a}=e;return(0,r.createElement)(l.MediaUploadCheck,null,(0,r.createElement)(l.MediaUpload,{onSelect:a,allowedTypes:u,value:t,render:e=>{let{open:t}=e;return(0,r.createElement)(o.Button,{onClick:t,className:"button button-large oet-featured-item-addedit-image-button noimage"},"Select File")}}))}),{mediaID:t.mediaID,onSelect:e=>{n({background:e.url})}}))))),(0,r.createElement)("div",{class:"oese_featured_card_block_wrapper"},(0,r.createElement)("img",{src:s}),(0,r.createElement)("div",{class:"oese_featured_card_block_background"},(()=>{if(i>"")return(0,r.createElement)("div",{class:"oese_featured_card-block-title"},(0,r.createElement)("pre",null,t.title))})(),(()=>{if(_>"")return(0,r.createElement)("div",{class:"oese_featured_card-block-desc"},(0,r.createElement)("pre",null,t.content))})(),b.trim()>""?p>""?(0,r.createElement)("a",{href:t.url,class:"oese_featured_card_block_button"},t.buttonText+" →"):(0,r.createElement)("a",{href:"#",class:"oese_featured_card_block_button"},t.buttonText+" →"):p>""?(0,r.createElement)("a",{href:t.url,class:"oese_featured_card_block_button"}," →"):(0,r.createElement)("a",{href:"#",class:"oese_featured_card_block_button"}," →"))))},save:function(e){const t=e.attributes;let a=void 0===t.background?oese_featured_card_block_localized.blockurl+"oese_featured_card_block_bg.png":t.background,l=t.title,o=t.content,n=t.buttonText,c=t.url;return(0,r.createElement)("div",null,(0,r.createElement)("div",{class:"oese_featured_card_block_wrapper"},(0,r.createElement)("img",{src:a}),(0,r.createElement)("div",{class:"oese_featured_card_block_background"},(()=>{if(l>"")return(0,r.createElement)("div",{class:"oese_featured_card-block-title"},(0,r.createElement)("pre",null,t.title))})(),(()=>{if(o>"")return(0,r.createElement)("div",{class:"oese_featured_card-block-desc"},(0,r.createElement)("pre",null,t.content))})(),n.trim()>""?c>""?(0,r.createElement)("a",{href:t.url,class:"oese_featured_card_block_button"},t.buttonText+" →"):(0,r.createElement)("a",{href:"#",class:"oese_featured_card_block_button"},t.buttonText+" →"):c>""?(0,r.createElement)("a",{href:t.url,class:"oese_featured_card_block_button"}," →"):(0,r.createElement)("a",{href:"#",class:"oese_featured_card_block_button"}," →"))))},example:()=>{}})}},r={};function a(e){var l=r[e];if(void 0!==l)return l.exports;var o=r[e]={exports:{}};return t[e](o,o.exports,a),o.exports}a.m=t,e=[],a.O=function(t,r,l,o){if(!r){var n=1/0;for(d=0;d<e.length;d++){r=e[d][0],l=e[d][1],o=e[d][2];for(var c=!0,s=0;s<r.length;s++)(!1&o||n>=o)&&Object.keys(a.O).every((function(e){return a.O[e](r[s])}))?r.splice(s--,1):(c=!1,o<n&&(n=o));if(c){e.splice(d--,1);var u=l();void 0!==u&&(t=u)}}return t}o=o||0;for(var d=e.length;d>0&&e[d-1][2]>o;d--)e[d]=e[d-1];e[d]=[r,l,o]},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,431:0};a.O.j=function(t){return 0===e[t]};var t=function(t,r){var l,o,n=r[0],c=r[1],s=r[2],u=0;if(n.some((function(t){return 0!==e[t]}))){for(l in c)a.o(c,l)&&(a.m[l]=c[l]);if(s)var d=s(a)}for(t&&t(r);u<n.length;u++)o=n[u],a.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return a.O(d)},r=self.webpackChunkoese_featured_card_block=self.webpackChunkoese_featured_card_block||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))}();var l=a.O(void 0,[431],(function(){return a(259)}));l=a.O(l)}();