if(!self.define){let e,o={};const i=(i,c)=>(i=new URL(i+".js",c).href,o[i]||new Promise((o=>{if("document"in self){const e=document.createElement("script");e.src=i,e.onload=o,document.head.appendChild(e)}else e=i,importScripts(i),o()})).then((()=>{let e=o[i];if(!e)throw new Error(`Module ${i} didn’t register its module`);return e})));self.define=(c,r)=>{const s=e||("document"in self?document.currentScript.src:"")||location.href;if(o[s])return;let t={};const n=e=>i(e,s),a={module:{uri:s},exports:t,require:n};o[s]=Promise.all(c.map((e=>a[e]||n(e)))).then((e=>(r(...e),t)))}}define(["./workbox-4a60e727"],(function(e){"use strict";self.addEventListener("message",(e=>{e.data&&"SKIP_WAITING"===e.data.type&&self.skipWaiting()})),e.precacheAndRoute([{url:"favicon.ico",revision:"d41d8cd98f00b204e9800998ecf8427e"},{url:"index.php",revision:"3b58bff18126a61c142cc576457c82a6"},{url:"Logo.png",revision:"71c73b5567eaa7bcae6e0246cca8f59a"},{url:"manifest.json",revision:"806dfdb712904a8219807dd358c6d2ef"},{url:"robots.txt",revision:"b6216d61c03e6ce0c9aea6ca7808f7ca"},{url:"storage/profile-photos/emBDxEXbjQ5awaHoW1PgQXKzeaFKkhpHikScaS9C.png",revision:"ac03805f7446a448ea4f50d42cdb2cc8"},{url:"storage/profile-photos/o1z66t3MroicIWTahzP5E8l8LXQugG8EO9aOs4HW.png",revision:"ac03805f7446a448ea4f50d42cdb2cc8"}],{ignoreURLParametersMatching:[/^utm_/,/^fbclid$/]})}));
//# sourceMappingURL=sw.js.map