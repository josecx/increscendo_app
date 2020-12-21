(function(e){function n(n){for(var r,o,i=n[0],c=n[1],s=n[2],p=0,l=[];p<i.length;p++)o=i[p],Object.prototype.hasOwnProperty.call(a,o)&&a[o]&&l.push(a[o][0]),a[o]=0;for(r in c)Object.prototype.hasOwnProperty.call(c,r)&&(e[r]=c[r]);d&&d(n);while(l.length)l.shift()();return u.push.apply(u,s||[]),t()}function t(){for(var e,n=0;n<u.length;n++){for(var t=u[n],r=!0,o=1;o<t.length;o++){var i=t[o];0!==a[i]&&(r=!1)}r&&(u.splice(n--,1),e=c(c.s=t[0]))}return e}var r={},o={app:0},a={app:0},u=[];function i(e){return c.p+"js/"+({}[e]||e)+".js"}function c(n){if(r[n])return r[n].exports;var t=r[n]={i:n,l:!1,exports:{}};return e[n].call(t.exports,t,t.exports,c),t.l=!0,t.exports}c.e=function(e){var n=[],t={"chunk-0716fe5c":1,"chunk-1b202780":1,"chunk-5569a0ee":1,"chunk-6ab1cd69":1,"chunk-e272f2b0":1};o[e]?n.push(o[e]):0!==o[e]&&t[e]&&n.push(o[e]=new Promise((function(n,t){for(var r="css/"+({}[e]||e)+".css",a=c.p+r,u=document.getElementsByTagName("link"),i=0;i<u.length;i++){var s=u[i],p=s.getAttribute("data-href")||s.getAttribute("href");if("stylesheet"===s.rel&&(p===r||p===a))return n()}var l=document.getElementsByTagName("style");for(i=0;i<l.length;i++){s=l[i],p=s.getAttribute("data-href");if(p===r||p===a)return n()}var d=document.createElement("link");d.rel="stylesheet",d.type="text/css",d.onload=n,d.onerror=function(n){var r=n&&n.target&&n.target.src||a,u=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");u.code="CSS_CHUNK_LOAD_FAILED",u.request=r,delete o[e],d.parentNode.removeChild(d),t(u)},d.href=a;var f=document.getElementsByTagName("head")[0];f.appendChild(d)})).then((function(){o[e]=0})));var r=a[e];if(0!==r)if(r)n.push(r[2]);else{var u=new Promise((function(n,t){r=a[e]=[n,t]}));n.push(r[2]=u);var s,p=document.createElement("script");p.charset="utf-8",p.timeout=120,c.nc&&p.setAttribute("nonce",c.nc),p.src=i(e);var l=new Error;s=function(n){p.onerror=p.onload=null,clearTimeout(d);var t=a[e];if(0!==t){if(t){var r=n&&("load"===n.type?"missing":n.type),o=n&&n.target&&n.target.src;l.message="Loading chunk "+e+" failed.\n("+r+": "+o+")",l.name="ChunkLoadError",l.type=r,l.request=o,t[1](l)}a[e]=void 0}};var d=setTimeout((function(){s({type:"timeout",target:p})}),12e4);p.onerror=p.onload=s,document.head.appendChild(p)}return Promise.all(n)},c.m=e,c.c=r,c.d=function(e,n,t){c.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:t})},c.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,n){if(1&n&&(e=c(e)),8&n)return e;if(4&n&&"object"===typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(c.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var r in e)c.d(t,r,function(n){return e[n]}.bind(null,r));return t},c.n=function(e){var n=e&&e.__esModule?function(){return e["default"]}:function(){return e};return c.d(n,"a",n),n},c.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},c.p="increscendo/assets/",c.oe=function(e){throw console.error(e),e};var s=window["webpackJsonp"]=window["webpackJsonp"]||[],p=s.push.bind(s);s.push=n,s=s.slice();for(var l=0;l<s.length;l++)n(s[l]);var d=p;u.push([0,"chunk-vendors"]),t()})({0:function(e,n,t){e.exports=t("56d7")},4360:function(e,n,t){"use strict";t("d3b7");var r=t("2b0e"),o=t("2f62"),a=t("0e44"),u=t("0759"),i=t.n(u);r["a"].use(o["a"]),n["a"]=new o["a"].Store({state:{token:"",titulo:"",usuario:{}},mutations:{setToken:function(e,n){e.token=n},setUsuario:function(e,n){e.usuario=n}},actions:{login:function(e,n){return new Promise((function(t){e.commit("setToken",n.token),e.commit("setUsuario",n.registro),r["a"].prototype.$http.defaults.headers.common["Authorization"]=e.state.token,t(n)}))},logout:function(e){return new Promise((function(n){e.commit("setToken",null),e.commit("setUsuario",null),delete r["a"].prototype.$http.defaults.headers.common["Authorization"],n(e)}))}},getters:{isLoggedIn:function(e){return!!e.token}},plugins:[Object(a["a"])({key:"vuex-incresc"}),i()({predicate:["setToken","setUsuario"]})]})},"56d7":function(e,n,t){"use strict";t.r(n);t("d3b7"),t("e260"),t("e6cf"),t("cca6"),t("a79d");var r=t("2b0e"),o=function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("div",[t("router-view")],1)},a=[],u=t("2877"),i={},c=Object(u["a"])(i,o,a,!1,null,null,null),s=c.exports,p=(t("caad"),t("b0c0"),t("8c4f")),l=t("4360");r["a"].use(p["a"]);var d=[{path:"/",component:function(){return t.e("chunk-5569a0ee").then(t.bind(null,"bede"))},children:[{path:"",name:"Landing",component:function(){return t.e("chunk-5569a0ee").then(t.bind(null,"bede"))}}]},{path:"/app/",name:"Home",component:function(){return t.e("chunk-2d21a3d2").then(t.bind(null,"bb51"))},children:[{path:"principal",name:"Principal",component:function(){return t.e("chunk-2d0e8e7d").then(t.bind(null,"8aec"))}},{path:"cambiarpassword",name:"CambiarPassword",component:function(){return t.e("chunk-e272f2b0").then(t.bind(null,"4ad0"))}}]},{path:"/signup",name:"SignUp",component:function(){return t.e("chunk-1b202780").then(t.bind(null,"5c9c"))}},{path:"/recuperarpassword/:token?",name:"RecuperarPassword",component:function(){return t.e("chunk-0716fe5c").then(t.bind(null,"aa7a"))}},{path:"/login",name:"Login",component:function(){return t.e("chunk-6ab1cd69").then(t.bind(null,"a55b"))}}],f=new p["a"]({mode:"history",base:"",routes:d});f.beforeEach((function(e,n,t){["Landing","SignUp","RecuperarPassword","Login"].includes(e.name)?t():"Login"===e.name||l["a"].getters.isLoggedIn?"Login"==e.name&&l["a"].getters.isLoggedIn?t({name:"Principal"}):t():t({name:"Landing"})}));var h=f,m=t("bc3a"),g=t.n(m),b=(t("6672"),t("e382"),t("ecee")),v=t("ad3d"),y=t("c074"),k=t("b702"),w=t("f2d1");b["c"].add(y["a"],k["a"],w["a"]),r["a"].component("font-awesome-icon",v["a"]),r["a"].config.productionTip=!1,r["a"].prototype.urlBase="/increscendo.php",r["a"].prototype.$http=g.a.create(),r["a"].prototype.$http.defaults.headers.common["Authorization"]=l["a"].state.token,r["a"].prototype.$http.interceptors.response.use(void 0,(function(e){return new Promise((function(){401===e.response.status&&e.config&&!e.config.__isRetryRequest&&(l["a"].dispatch("logout"),h.push({name:"Login"}))}))})),new r["a"]({router:h,store:l["a"],render:function(e){return e(s)}}).$mount("#app")},6672:function(e,n,t){},e382:function(e,n,t){}});
//# sourceMappingURL=app.js.map