!function(){"use strict";var e,t={259:function(){var e=window.wp.blocks,t=JSON.parse('{"TN":"Publication Download","W3":"oese-block-category","qv":"archive","WL":"Add Publication Download Block","Y4":{"blockid":{"type":"string"},"url":{"type":"string"},"title":{"type":"string"},"filesize":{"type":"string"},"filetype":{"type":"string"},"icon":{"type":"string"},"proc":{"type":"boolean","default":false}}}'),l=window.wp.element,n=window.wp.i18n,o=window.wp.blockEditor,i=(window.wp.components,"");const{__:__}=wp.i18n;window.oercurrBlocksJson=oese_publication_download_isjson,(0,e.registerBlockType)("oese-block/oese-publication-download-block",{title:__(t.TN),icon:t.qv,description:__(t.WL),category:t.W3,keywords:[__("oese"),__("publication"),__("intro")],attributes:t.Y4,edit:function(e){const t=e.attributes,a=e.setAttributes;let r=window.oercurrBlocksJson?(0,o.useBlockProps)():"";const c=e=>{let t=e.target.value;a({proc:!0,url:t}),clearTimeout(i),i=setTimeout((function(){wp.apiFetch({url:"/wp-json/oese/publication-download/query?url="+t}).then((e=>{e.status?(a({data:e}),a({title:e.title,filesize:e.filesize,filetype:e.filetype,icon:e.icon.icon})):a({title:void 0,filesize:void 0,filetype:void 0,icon:void 0}),a({proc:!1})})),clearTimeout(i)}),1500)};return t.proc?(0,l.createElement)("div",r,(0,l.createElement)(o.InspectorControls,null,(0,l.createElement)(PanelBody,{title:(0,n.__)("Publication Download Settings"),initialOpen:!0},(0,l.createElement)("div",{class:"oet_audience_link_inspector_wrapper"},(0,l.createElement)("label",{class:"components-base-control__label"},"Publication File URL",(0,l.createElement)("input",{type:"text",onChange:c,value:t.url}))))),(0,l.createElement)("div",null,(0,l.createElement)("div",{class:"oese-publication-download-404"},"Loading information, please wait ..."))):(0,l.createElement)("div",r,(0,l.createElement)(o.InspectorControls,null,(0,l.createElement)(PanelBody,{title:(0,n.__)("Publication Download Settings"),initialOpen:!0},(0,l.createElement)("div",{class:"oet_audience_link_inspector_wrapper"},(0,l.createElement)("label",{class:"components-base-control__label"},"Publication File URL",(0,l.createElement)("input",{type:"text",onChange:c,value:t.url}))))),(()=>{if(t.title)return(0,l.createElement)("div",null,(0,l.createElement)("div",{class:"oese-publication-download-block-container"},(0,l.createElement)("div",{class:"oese-publication-download-block"},(0,l.createElement)("div",{class:"col-md-3 oese-publication-download-block-thumbnail"},(0,l.createElement)("a",{href:t.url,target:"_blank",rel:"noopener"},(0,l.createElement)("i",{class:"far "+t.icon+" fa-3x"}))),(0,l.createElement)("div",{class:"col-md-9 oese-publication-download-block-details"},(0,l.createElement)("h4",null,(0,l.createElement)("a",{href:t.url,target:"_blank",rel:"noopener"},t.title)),(0,l.createElement)("h5",null,t.filetype+" ("+t.filesize+")"),(0,l.createElement)("div",{class:"oese-publication-download-block-button-wrapper"},(0,l.createElement)("a",{href:t.url,class:"btn oese-publication-download-block-button",target:"_blank",rel:"noopener"},"Download"))))));{let e=t.url;return void 0===e?(0,l.createElement)("div",null,(0,l.createElement)("div",{class:"oese-publication-download-404"},"Please provide the publication URL")):e.trim()>""?(0,l.createElement)("div",null,(0,l.createElement)("div",{class:"oese-publication-download-404"},"Unable to find URL")):(0,l.createElement)("div",null,(0,l.createElement)("div",{class:"oese-publication-download-404"},"Please provide the publication URL"))}})())},save:function(e){const t=e.attributes;return(0,l.createElement)("div",null,(0,l.createElement)("div",{class:"oese-publication-download-block-container"},(0,l.createElement)("div",{class:"oese-publication-download-block"},(0,l.createElement)("div",{class:"col-md-3 oese-publication-download-block-thumbnail"},(0,l.createElement)("a",{href:t.url,target:"_blank",rel:"noopener"},(0,l.createElement)("i",{class:"far "+t.icon+" fa-3x"}))),(0,l.createElement)("div",{class:"col-md-9 oese-publication-download-block-details"},(0,l.createElement)("h4",null,(0,l.createElement)("a",{href:t.url,target:"_blank",rel:"noopener"},t.title)),(0,l.createElement)("h5",null,t.filetype+" ("+t.filesize+")"),(0,l.createElement)("div",{class:"oese-publication-download-block-button-wrapper"},(0,l.createElement)("a",{href:t.url,class:"btn oese-publication-download-block-button",target:"_blank",rel:"noopener"},"Download"))))))},example:()=>{}})}},l={};function n(e){var o=l[e];if(void 0!==o)return o.exports;var i=l[e]={exports:{}};return t[e](i,i.exports,n),i.exports}n.m=t,e=[],n.O=function(t,l,o,i){if(!l){var a=1/0;for(u=0;u<e.length;u++){l=e[u][0],o=e[u][1],i=e[u][2];for(var r=!0,c=0;c<l.length;c++)(!1&i||a>=i)&&Object.keys(n.O).every((function(e){return n.O[e](l[c])}))?l.splice(c--,1):(r=!1,i<a&&(a=i));if(r){e.splice(u--,1);var s=o();void 0!==s&&(t=s)}}return t}i=i||0;for(var u=e.length;u>0&&e[u-1][2]>i;u--)e[u]=e[u-1];e[u]=[l,o,i]},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,431:0};n.O.j=function(t){return 0===e[t]};var t=function(t,l){var o,i,a=l[0],r=l[1],c=l[2],s=0;if(a.some((function(t){return 0!==e[t]}))){for(o in r)n.o(r,o)&&(n.m[o]=r[o]);if(c)var u=c(n)}for(t&&t(l);s<a.length;s++)i=a[s],n.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return n.O(u)},l=self.webpackChunkoese_publication_download_block=self.webpackChunkoese_publication_download_block||[];l.forEach(t.bind(null,0)),l.push=t.bind(null,l.push.bind(l))}();var o=n.O(void 0,[431],(function(){return n(259)}));o=n.O(o)}();