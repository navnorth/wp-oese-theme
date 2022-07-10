!function(){"use strict";var e,t={165:function(){var e=window.wp.blocks,t=JSON.parse('{"TN":"Subpages","W3":"oese-block-category","qv":"admin-page","WL":"Add Subpages Block","Y4":{"blockid":{"type":"string"},"id":{"type":"string"},"heading":{"type":"string"},"title":{"type":"string","default":"Subpages"},"data":{"type":"array","default":[]},"proc":{"type":"boolean","default":false}}}');function s(){return s=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var s=arguments[t];for(var a in s)Object.prototype.hasOwnProperty.call(s,a)&&(e[a]=s[a])}return e},s.apply(this,arguments)}var a=window.wp.element,l=window.wp.i18n,n=(window.wp.components,window.wp.blockEditor),r="",c=!0;const{__:__}=wp.i18n;window.oercurrBlocksJson=oese_subpages_isjson,(0,e.registerBlockType)("oese-block/oese-subpages-block",{title:__(t.TN),icon:t.qv,description:__(t.WL),category:t.W3,keywords:[__("oese"),__("subpages")],attributes:t.Y4,edit:function(e){const t=e.attributes,o=e.setAttributes;let i=window.oercurrBlocksJson?(0,n.useBlockProps)():"";c&&wp.apiFetch({url:"/wp-json/oese/subpages/query?id="+t.id}).then((e=>{o({data:e,proc:!1}),c=!1}));const p=e=>{o({title:e.target.value})},u=e=>{let t=e.target.value;t.trim().length>0?(o({proc:!0,id:t.trim()}),clearTimeout(r),r=setTimeout((function(){wp.apiFetch({url:"/wp-json/oese/subpages/query?id="+t}).then((e=>{o({data:e,proc:!1})})),clearTimeout(r)}),1500)):o({id:void 0,data:[],proc:!1})},d=e=>{o({heading:e.target.value})},b=e=>"h2"==e&&""==t.heading?(0,a.createElement)("option",{value:e,selected:"selected"},e.toUpperCase()):(0,a.createElement)("option",s({value:e},e==t.heading&&"selected='selected'"),e.toUpperCase()),m=()=>(0,a.createElement)("select",{class:"oese_subpages_htag_inspector",onChange:d},b("h1"),b("h2"),b("h3"),b("h4"),b("h5"),b("h6"));return t.proc?(0,a.createElement)("div",i,(0,a.createElement)(InspectorControls,null,(0,a.createElement)(PanelBody,{title:(0,l.__)("Subpages Settings"),initialOpen:!0},(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Title",(0,a.createElement)("input",{type:"text",class:"oese_subpages_title_inspector",onChange:p,value:t.title}))),(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Page ID",(0,a.createElement)("input",{type:"text",class:"oese_subpages_postid_inspector",onChange:u,value:t.id}))),(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Heading Tag",m())))),(0,a.createElement)("div",null,(0,a.createElement)("div",{class:"oese-publication-download-404"},"Loading information, please wait ",(0,a.createElement)("div",{class:"oese-subpages-preloader"},(0,a.createElement)("div",null),(0,a.createElement)("div",null),(0,a.createElement)("div",null),(0,a.createElement)("div",null))))):c?(0,a.createElement)("div",i,(0,a.createElement)(InspectorControls,null,(0,a.createElement)(PanelBody,{title:(0,l.__)("Subpages Settings"),initialOpen:!0},(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Title",(0,a.createElement)("input",{type:"text",class:"oese_subpages_title_inspector",onChange:p,value:t.title}))),(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Page ID",(0,a.createElement)("input",{type:"text",class:"oese_subpages_postid_inspector",onChange:u,value:t.id}))),(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Heading Tag",m())))),(0,a.createElement)("div",null,(0,a.createElement)("div",{class:"oese-publication-download-404"},"Checking updates, please wait ",(0,a.createElement)("div",{class:"oese-subpages-preloader"},(0,a.createElement)("div",null),(0,a.createElement)("div",null),(0,a.createElement)("div",null),(0,a.createElement)("div",null))))):(0,a.createElement)("div",i,(0,a.createElement)(InspectorControls,null,(0,a.createElement)(PanelBody,{title:(0,l.__)("Subpages Settings"),initialOpen:!0},(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Title",(0,a.createElement)("input",{type:"text",class:"oese_subpages_title_inspector",onChange:p,value:t.title}))),(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Page ID",(0,a.createElement)("input",{type:"text",class:"oese_subpages_postid_inspector",onChange:u,value:t.id}))),(0,a.createElement)("div",{class:"oese_subpages_inspector_wrapper css-wdf2ti-Wrapper"},(0,a.createElement)("label",{class:"components-base-control__label"},"Heading Tag",m())))),(0,a.createElement)("div",{class:"oese-subpages_container"},(0,a.createElement)("div",{class:"oese-subpages"},(e=>{switch(e){case"h1":return(0,a.createElement)("h1",{class:"oese-subpages-title"},t.title);case"h2":return(0,a.createElement)("h2",{class:"oese-subpages-title"},t.title);case"h3":return(0,a.createElement)("h3",{class:"oese-subpages-title"},t.title);case"h4":return(0,a.createElement)("h4",{class:"oese-subpages-title"},t.title);case"h5":return(0,a.createElement)("h5",{class:"oese-subpages-title"},t.title);case"h6":return(0,a.createElement)("h6",{class:"oese-subpages-title"},t.title)}})(t.heading),(0,a.createElement)("ul",{class:"oese-subpages-list"},t.data.map(((e,t)=>(0,a.createElement)("li",{class:"oese-subpages-listitem"},(0,a.createElement)("a",{href:e.link},e.title))))))))},save:function(e){const t=e.attributes;return(0,a.createElement)("div",null,(0,a.createElement)("div",{class:"oese-subpages_container"},(0,a.createElement)("div",{class:"oese-subpages"},(e=>{switch(e){case"h1":return(0,a.createElement)("h1",{class:"oese-subpages-title"},t.title);case"h2":return(0,a.createElement)("h2",{class:"oese-subpages-title"},t.title);case"h3":return(0,a.createElement)("h3",{class:"oese-subpages-title"},t.title);case"h4":return(0,a.createElement)("h4",{class:"oese-subpages-title"},t.title);case"h5":return(0,a.createElement)("h5",{class:"oese-subpages-title"},t.title);case"h6":return(0,a.createElement)("h6",{class:"oese-subpages-title"},t.title)}})(t.heading),(0,a.createElement)("ul",{class:"oese-subpages-list"},t.data.map(((e,t)=>(0,a.createElement)("li",{class:"oese-subpages-listitem"},(0,a.createElement)("a",{href:e.link},e.title))))))))},example:()=>{}})}},s={};function a(e){var l=s[e];if(void 0!==l)return l.exports;var n=s[e]={exports:{}};return t[e](n,n.exports,a),n.exports}a.m=t,e=[],a.O=function(t,s,l,n){if(!s){var r=1/0;for(p=0;p<e.length;p++){s=e[p][0],l=e[p][1],n=e[p][2];for(var c=!0,o=0;o<s.length;o++)(!1&n||r>=n)&&Object.keys(a.O).every((function(e){return a.O[e](s[o])}))?s.splice(o--,1):(c=!1,n<r&&(r=n));if(c){e.splice(p--,1);var i=l();void 0!==i&&(t=i)}}return t}n=n||0;for(var p=e.length;p>0&&e[p-1][2]>n;p--)e[p]=e[p-1];e[p]=[s,l,n]},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={826:0,46:0};a.O.j=function(t){return 0===e[t]};var t=function(t,s){var l,n,r=s[0],c=s[1],o=s[2],i=0;if(r.some((function(t){return 0!==e[t]}))){for(l in c)a.o(c,l)&&(a.m[l]=c[l]);if(o)var p=o(a)}for(t&&t(s);i<r.length;i++)n=r[i],a.o(e,n)&&e[n]&&e[n][0](),e[r[i]]=0;return a.O(p)},s=self.webpackChunkoese_subpages_block=self.webpackChunkoese_subpages_block||[];s.forEach(t.bind(null,0)),s.push=t.bind(null,s.push.bind(s))}();var l=a.O(void 0,[46],(function(){return a(165)}));l=a.O(l)}();