!function(t){var n={};function e(r){if(n[r])return n[r].exports;var i=n[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,e),i.l=!0,i.exports}e.m=t,e.c=n,e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:r})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,n){if(1&n&&(t=e(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(e.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var i in t)e.d(r,i,function(n){return t[n]}.bind(null,i));return r},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="",e(e.s=236)}({10:function(t,n,e){var r=e(15),i=e(89),o=e(53),u=Math.max,a=Math.min;t.exports=function(t,n,e){var c,f,l,s,p,v,d=0,h=!1,y=!1,b=!0;if("function"!=typeof t)throw new TypeError("Expected a function");function g(n){var e=c,r=f;return c=f=void 0,d=n,s=t.apply(r,e)}function m(t){var e=t-v;return void 0===v||n<=e||e<0||y&&l<=t-d}function j(){var t=i();if(m(t))return x(t);p=setTimeout(j,function(t){var e=n-(t-v);return y?a(e,l-(t-d)):e}(t))}function x(t){return p=void 0,b&&c?g(t):(c=f=void 0,s)}function O(){var t=i(),e=m(t);if(c=arguments,f=this,v=t,e){if(void 0===p)return function(t){return d=t,p=setTimeout(j,n),h?g(t):s}(v);if(y)return clearTimeout(p),p=setTimeout(j,n),g(v)}return void 0===p&&(p=setTimeout(j,n)),s}return n=o(n)||0,r(e)&&(h=!!e.leading,l=(y="maxWait"in e)?u(o(e.maxWait)||0,n):l,b="trailing"in e?!!e.trailing:b),O.cancel=function(){void 0!==p&&clearTimeout(p),c=v=f=p=void(d=0)},O.flush=function(){return void 0===p?s:x(i())},O}},15:function(t,n){t.exports=function(t){var n=typeof t;return null!=t&&("object"==n||"function"==n)}},16:function(t,n){t.exports=function(t){return null!=t&&"object"==typeof t}},17:function(t,n,e){var r=e(22),i=e(67),o=e(68),u=r?r.toStringTag:void 0;t.exports=function(t){return null==t?void 0===t?"[object Undefined]":"[object Null]":u&&u in Object(t)?i(t):o(t)}},2:function(t,n){t.exports=jQuery},22:function(t,n,e){var r=e(9);t.exports=r.Symbol},236:function(t,n,e){"use strict";e.r(n);var r=e(2),i=e.n(r),o=e(10),u=e.n(o);function a(t,n){for(var e=0;e<n.length;e++){var r=n[e];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}var c=function(){function t(){!function(t,n){if(!(t instanceof n))throw new TypeError("Cannot call a class as a function")}(this,t),this.getContent=function(t){return i()(this.fields).each((function(n,e){t+=i()(e).val()})),t},this.init(),this.hooks(),this.events()}return function(t,n,e){n&&a(t.prototype,n)}(t,[{key:"init",value:function(){this.pluginName="RankMathCustomFields",this.fields=this.getFields(),this.getContent=this.getContent.bind(this)}},{key:"hooks",value:function(){RankMathApp.registerPlugin(this.pluginName),wp.hooks.addFilter("rank_math_content",this.pluginName,this.getContent)}},{key:"events",value:function(){var t=this;i()(this.fields).each((function(n,e){i()(e).on("keyup change",u()((function(){RankMathApp.reloadPlugin(t.pluginName)}),500))}))}},{key:"getFields",value:function(){var t=[];return i()("#the-list > tr:visible").each((function(n,e){var r=i()("#"+e.id+"-key").val();-1!==i.a.inArray(r,rankMath.analyzeFields)&&t.push("#"+e.id+"-value")})),t}}]),t}();i()((function(){setTimeout((function(){new c}),500)}))},26:function(t,n,e){var r=e(17),i=e(16);t.exports=function(t){return"symbol"==typeof t||i(t)&&"[object Symbol]"==r(t)}},43:function(t,n,e){var r;r=e(63),t.exports="object"==typeof r&&r&&r.Object===Object&&r},53:function(t,n,e){var r=e(15),i=e(26),o=/^\s+|\s+$/g,u=/^[-+]0x[0-9a-f]+$/i,a=/^0b[01]+$/i,c=/^0o[0-7]+$/i,f=parseInt;t.exports=function(t){if("number"==typeof t)return t;if(i(t))return NaN;if(r(t)){var n="function"==typeof t.valueOf?t.valueOf():t;t=r(n)?n+"":n}if("string"!=typeof t)return 0===t?t:+t;t=t.replace(o,"");var e=a.test(t);return e||c.test(t)?f(t.slice(2),e?2:8):u.test(t)?NaN:+t}},63:function(t,n){var e;e=function(){return this}();try{e=e||Function("return this")()}catch(t){"object"==typeof window&&(e=window)}t.exports=e},67:function(t,n,e){var r=e(22),i=Object.prototype,o=i.hasOwnProperty,u=i.toString,a=r?r.toStringTag:void 0;t.exports=function(t){var n=o.call(t,a),e=t[a];try{var r=!(t[a]=void 0)}catch(t){}var i=u.call(t);return r&&(n?t[a]=e:delete t[a]),i}},68:function(t,n){var e=Object.prototype.toString;t.exports=function(t){return e.call(t)}},89:function(t,n,e){var r=e(9);t.exports=function(){return r.Date.now()}},9:function(t,n,e){var r=e(43),i="object"==typeof self&&self&&self.Object===Object&&self,o=r||i||Function("return this")();t.exports=o}});