(self.webpackChunk=self.webpackChunk||[]).push([[818],{9090:(t,e,i)=>{"use strict";var n=i(538),r=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("div",{staticClass:"container max-height is-max-widescreen is-flex is-align-items-center is-justify-content-center"},[i("div",{staticClass:"card p-5 mx-3"},[i("section",{staticClass:"p-6"},[i("h1",{staticClass:"title"},[t._v("Inserisci il codice")]),t._v(" "),i("br"),t._v(" "),i("form",[i("b-field",{attrs:{label:"Name",type:t.error?"is-danger":""}},[i("b-input",{attrs:{placeholder:"Username",type:"Username",icon:"account","icon-clickable":""},model:{value:t.user,callback:function(e){t.user=e},expression:"user"}})],1),t._v(" "),i("br"),t._v(" "),i("b-field",{attrs:{label:"Password",type:t.error?"is-danger":""}},[i("b-input",{attrs:{type:"password",placeholder:"Password","password-reveal":""},on:{"icon-click":function(e){t.form,t.textbox,t.password}},model:{value:t.psw,callback:function(e){t.psw=e},expression:"psw"}})],1)],1),t._v(" "),i("br"),t._v(" "),i("div",{staticClass:"buttons"},[i("b-button",{attrs:{loading:this.querying,type:t.error?"is-danger":"is-success","icon-left":t.success?"check-all":"login-variant",expanded:""},on:{click:function(e){return t.login()}}},[t._v("Continua")])],1),t._v(" "),i("div",{staticClass:"buttons"},[i("b-button",{attrs:{loading:this.querying,type:t.error?"is-danger":"is-warning","icon-left":t.success?"check-all":"ticket-confirmation",expanded:""},on:{click:function(e){return t.creaBiglietto()}}},[t._v("Genera Biglietto")])],1),t._v(" "),i("div",{staticClass:"buttons"},[t.biglietto?i("b-button",{attrs:{type:"is-primary","icon-left":"eye",expanded:""},on:{click:function(e){return t.alertCustom()}}},[t._v("Riapri Credenziali Biglietto")]):t._e()],1),t._v(" "),i("div",{staticClass:"buttons"},[i("b-button",{attrs:{type:"is-info","icon-left":"graph",expanded:""},on:{click:function(e){return t.prendidati()}}},[t._v("Stampa dati biglietto")])],1),t._v(" "),i("b-select",{model:{value:t.data,callback:function(e){t.data=e},expression:"data"}},[i("optgroup",{attrs:{label:"Scegli l'anno"}},t._l(t.anni,(function(e){return i("option",{key:e,domProps:{value:e}},[t._v(t._s(e))])})),0)])],1)])])])};r._withStripped=!0;i(6572),i(3710),i(9554),i(4747),i(1539),i(9714),i(5306),i(4916),i(4765),i(285),i(8783),i(6992),i(3948);var a=i(9669),o=i.n(a);const s={data:function(){return{success:!1,error:!1,querying:!1,user:null,psw:null,biglietto:null,reportdatibiglietti:null,data:2021,anni:Array.of("tutti gli anni",2021,2022,2022,2023,2024)}},methods:{login:function(){var t=this;this.querying=!0;var e={username:this.user,password:this.psw};o().post("/login_check",e).then((function(e){t.querying=!1,t.data=e.data,t.error=!1,t.success=!0,window.location.href="/"})).catch((function(){t.error=!0,t.querying=!1,t.danger()}))},creaBiglietto:function(){var t=this;this.querying=!0,o().post("/login/creabiglietto").then((function(e){t.querying=!1,t.biglietto=e.data,t.error=!1,t.success=!0,t.alertCustom()})).catch((function(){t.error=!0,t.querying=!1}))},alertCustom:function(){this.$buefy.dialog.alert({title:"Credenziali Biglietto",message:"user: "+this.biglietto.user+"<br> psw: "+this.biglietto.psw+"<br> tipo giro: "+this.biglietto.tipo_giro+"<br> data: "+new Intl.DateTimeFormat("it-IT").format(new Date),confirmText:"Ho letto"})},danger:function(){this.$buefy.snackbar.open({duration:3e3,message:"Utente o Password errati! <em>Riprova<em>",type:"is-danger",position:"is-bottom-left",actionText:"Ritenta",queue:!1})},prendidati:function(){var t=this;this.querying=!0,"tutti gli anni"==this.data&&(this.data=null);var e={data:this.data};o().post("/login/dati",e).then((function(e){t.querying=!1,t.error=!1,t.success=!0,t.reportdatibiglietti=[],e.data.forEach((function(e){t.reportdatibiglietti.push(Array.of(e.id,e.username,e.tipo_giro,e.data_biglietto))})),console.log(t.reportdatibiglietti),t.exportToCsv("dati.csv",t.reportdatibiglietti)})).catch((function(){t.error=!0,t.querying=!1}))},exportToCsv:function(t,e){for(var i=function(t){for(var e="",i=0;i<t.length;i++){var n=null===t[i]?"":t[i].toString();t[i]instanceof Date&&(n=t[i].toLocaleString());var r=n.replace(/"/g,'""');r.search(/("|,|\n)/g)>=0&&(r='"'+r+'"'),i>0&&(e+=";"),e+=r}return e+"\n"},n="",r=0;r<e.length;r++)n+=i(e[r]);var a=new Blob([n],{type:"text/csv;charset=utf-8;"});if(navigator.msSaveBlob)navigator.msSaveBlob(a,t);else{var o=document.createElement("a");if(void 0!==o.download){var s=URL.createObjectURL(a);o.setAttribute("href",s),o.setAttribute("download",t),o.style.visibility="hidden",document.body.appendChild(o),o.click(),document.body.removeChild(o)}}}}};var l=(0,i(1900).Z)(s,r,[],!1,null,"250750be",null);l.options.__file="assets/componentsAuth/App.vue";const c=l.exports;var u=i(2381);i(9318);n.Z.use(u.ZP),new n.Z({components:{App:c}}).$mount("#app")}},t=>{"use strict";t.O(0,[675,635,434],(()=>{return e=9090,t(t.s=e);var e}));t.O()}]);