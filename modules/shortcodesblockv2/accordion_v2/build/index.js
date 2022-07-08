!function(){"use strict";var e,o={723:function(){var e=window.wp.blocks,o=JSON.parse('{"TN":"Accordion","W3":"oese-block-category","qv":"block-default","WL":"Add Accordion Block","Y4":{"blockid":{"type":"string"},"accordionexpanded":{"type":"boolean","default":true},"accordiontitle":{"type":"string"}}}'),c=window.wp.element,t=window.wp.i18n,n=window.wp.blockEditor,r=window.wp.components;function a(e){const o=e.attributes,a=e.setAttributes;let l=window.oercurrBlocksJson?(0,n.useBlockProps)():"";function i(e){e.map((e=>{if("cgb/oese-accordion-block"==e.name){var o="cb"+(new Date).getTime(),c=e.clientId;wp.data.select("core/block-editor").getBlockAttributes(c).blockid||wp.data.dispatch("core/block-editor").updateBlockAttributes(c,{blockid:o,postsPerPage:5,sortBy:"modified"})}e.innerBlocks.length>0&&i(e.innerBlocks)}))}return wp.data.select("core/block-editor").getBlocks().map((e=>{if("cgb/oese-accordion-block"==e.name){var o="cb"+(new Date).getTime(),c=e.clientId;wp.data.select("core/block-editor").getBlockAttributes(c).blockid||wp.data.dispatch("core/block-editor").updateBlockAttributes(c,{blockid:o,postsPerPage:5,sortBy:"modified"})}else"core/group"!=e.name&&"core/columns"!=e.name||i(e.innerBlocks)})),Array.apply(null,{length:10}).map(Number.call,Number),(0,c.createElement)("div",l,(0,c.createElement)(n.InspectorControls,null,(0,c.createElement)(r.PanelBody,{title:(0,t.__)("Accordion Block settings"),initialOpen:!0},(0,c.createElement)("div",{class:"oer_curriculum_inspector_wrapper oer_curriculum_inspector_Postperpage"},(0,c.createElement)(r.ToggleControl,{label:(0,t.__)("Expanded"),help:o.accordionexpanded?(0,t.__)("Accordion content will be shown initially","five"):(0,t.__)("Accordion content will be hidden initially","five"),checked:!!o.accordionexpanded,onChange:e=>{return c=!o.accordionexpanded,void a({accordionexpanded:c});var c}})))),(0,c.createElement)("div",{class:"oeseblk-"+o.blockid},(0,c.createElement)("div",{class:"oese-blk-accordion",id:"oese-blk-accordion-parent-"+o.blockid},(0,c.createElement)("div",{class:"z-depth-0 bordered"},(0,c.createElement)("div",{class:"oese-blk-accordion-header",id:"headingOne"},(0,c.createElement)("h4",{class:"mb-0 oese-blk-accordion-title"},(0,c.createElement)("a",{class:o.accordionexpanded?"btn btn-primary oese-blk-accordion-button":"btn btn-primary oese-blk-accordion-button collapsed","data-toggle":"collapse",href:"#"+o.blockid+"-oeseCollapse1",role:"button","aria-expanded":o.accordionexpanded,"aria-controls":"oeseCollapse1"},(0,c.createElement)("input",{type:"text",class:"oese-blk-accordion-button-input",onChange:e=>{a({accordiontitle:e.target.value})},placeholder:"Accordion Title",value:o.accordiontitle})))),(0,c.createElement)("div",{id:o.blockid+"-oeseCollapse1",class:o.accordionexpanded?"oese-blk-accordion-content collapse show":"oese-blk-accordion-content collapse","aria-labelledby":"headingOne",tabindex:"0"},(0,c.createElement)("div",{class:"card-body"},(0,c.createElement)(n.InnerBlocks,{templateInsertUpdatesSelection:!0,template:[["core/paragraph",{placeholder:"Your accordion content here."}]]})))))))}function l(e){const o=e.attributes;return(0,c.createElement)("div",null,(0,c.createElement)("div",{class:"oeseblk-"+o.blockid},(0,c.createElement)("div",{class:"oese-blk-accordion",id:"oese-blk-accordion-parent-"+o.blockid},(0,c.createElement)("div",{class:"z-depth-0 bordered"},(0,c.createElement)("div",{class:"oese-blk-accordion-header",id:"headingOne"},(0,c.createElement)("h4",{class:"mb-0 oese-blk-accordion-title"},(0,c.createElement)("a",{class:o.accordionexpanded?"btn btn-primary oese-blk-accordion-button":"btn btn-primary oese-blk-accordion-button collapsed","data-toggle":"collapse",href:"#"+o.blockid+"-oeseCollapse1",role:"button","aria-expanded":o.accordionexpanded,"aria-controls":"oeseCollapse1","aria-label":o.accordiontitle},o.accordiontitle))),(0,c.createElement)("div",{id:o.blockid+"-oeseCollapse1",class:o.accordionexpanded?"oese-blk-accordion-content collapse show":"oese-blk-accordion-content collapse",tabindex:"0"},(0,c.createElement)("div",{class:"card-body"},(0,c.createElement)(n.InnerBlocks.Content,null)))))))}window.wp.data;const{__:__}=wp.i18n;window.oercurrBlocksJson="undefined"==typeof oese_accordion_legacy_marker,window.oercurrBlocksJson?(0,e.registerBlockType)("cgb/oese-accordion-block",{edit:a,save:l,example:()=>{}}):(0,e.registerBlockType)("cgb/oese-accordion-block",{title:__(o.TN),icon:o.qv,description:__(o.WL),category:o.W3,keywords:[__("oese"),__("accordion"),__("block")],attributes:o.Y4,edit:a,save:l,example:()=>{}})}},c={};function t(e){var n=c[e];if(void 0!==n)return n.exports;var r=c[e]={exports:{}};return o[e](r,r.exports,t),r.exports}t.m=o,e=[],t.O=function(o,c,n,r){if(!c){var a=1/0;for(s=0;s<e.length;s++){c=e[s][0],n=e[s][1],r=e[s][2];for(var l=!0,i=0;i<c.length;i++)(!1&r||a>=r)&&Object.keys(t.O).every((function(e){return t.O[e](c[i])}))?c.splice(i--,1):(l=!1,r<a&&(a=r));if(l){e.splice(s--,1);var d=n();void 0!==d&&(o=d)}}return o}r=r||0;for(var s=e.length;s>0&&e[s-1][2]>r;s--)e[s]=e[s-1];e[s]=[c,n,r]},t.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},function(){var e={826:0,46:0};t.O.j=function(o){return 0===e[o]};var o=function(o,c){var n,r,a=c[0],l=c[1],i=c[2],d=0;if(a.some((function(o){return 0!==e[o]}))){for(n in l)t.o(l,n)&&(t.m[n]=l[n]);if(i)var s=i(t)}for(o&&o(c);d<a.length;d++)r=a[d],t.o(e,r)&&e[r]&&e[r][0](),e[a[d]]=0;return t.O(s)},c=self.webpackChunkoese_accordion_block=self.webpackChunkoese_accordion_block||[];c.forEach(o.bind(null,0)),c.push=o.bind(null,c.push.bind(c))}();var n=t.O(void 0,[46],(function(){return t(723)}));n=t.O(n)}();