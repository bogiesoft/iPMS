/*
@license
dhtmlxScheduler v.4.3.25 Professional

This software can be used only as part of dhtmlx.com site.
You are not allowed to use it on any other site

(c) Dinamenta, UAB.


*/
Scheduler.plugin(function(e){e.attachEvent("onTemplatesReady",function(){function t(e,t,a,n){for(var i=t.getElementsByTagName(e),r=a.getElementsByTagName(e),d=r.length-1;d>=0;d--){var a=r[d];if(n){var l=document.createElement("SPAN");l.className="dhx_text_disabled",l.innerHTML=n(i[d]),a.parentNode.insertBefore(l,a),a.parentNode.removeChild(a)}else a.disabled=!0,t.checked&&(a.checked=!0)}}var a=e.config.lightbox.sections.slice(),n=e.config.buttons_left.slice(),i=e.config.buttons_right.slice();e.attachEvent("onBeforeLightbox",function(t){
if(this.config.readonly_form||this.getEvent(t).readonly){this.config.readonly_active=!0;for(var r=0;r<this.config.lightbox.sections.length;r++)this.config.lightbox.sections[r].focus=!1}else this.config.readonly_active=!1,e.config.lightbox.sections=a.slice(),e.config.buttons_left=n.slice(),e.config.buttons_right=i.slice();var d=this.config.lightbox.sections;if(this.config.readonly_active){for(var r=0;r<d.length;r++)if("recurring"==d[r].type){this.config.readonly_active&&d.splice(r,1);break}for(var l=["dhx_delete_btn","dhx_save_btn"],o=[e.config.buttons_left,e.config.buttons_right],r=0;r<l.length;r++)for(var s=l[r],_=0;_<o.length;_++){
for(var c=o[_],u=-1,h=0;h<c.length;h++)if(c[h]==s){u=h;break}-1!=u&&c.splice(u,1)}}return this.resetLightbox(),!0});var r=e._fill_lightbox;e._fill_lightbox=function(){var a=this.getLightbox();this.config.readonly_active&&(a.style.visibility="hidden",a.style.display="block");var n=r.apply(this,arguments);if(this.config.readonly_active&&(a.style.visibility="",a.style.display="none"),this.config.readonly_active){var i=this.getLightbox(),l=this._lightbox_r=i.cloneNode(!0);l.id=e.uid(),t("textarea",i,l,function(e){
return e.value}),t("input",i,l,!1),t("select",i,l,function(e){return e.options.length?e.options[Math.max(e.selectedIndex||0,0)].text:""}),i.parentNode.insertBefore(l,i),d.call(this,l),e._lightbox&&e._lightbox.parentNode.removeChild(e._lightbox),this._lightbox=l,e.config.drag_lightbox&&(l.firstChild.onmousedown=e._ready_to_dnd),this.setLightboxSize(),l.onclick=function(t){var a=t?t.target:event.srcElement;if(a.className||(a=a.previousSibling),a&&a.className)switch(a.className){case"dhx_cancel_btn":
e.callEvent("onEventCancel",[e._lightbox_id]),e._edit_stop_event(e.getEvent(e._lightbox_id),!1),e.hide_lightbox()}}}return n};var d=e.showCover;e.showCover=function(){this.config.readonly_active||d.apply(this,arguments)};var l=e.hide_lightbox;e.hide_lightbox=function(){return this._lightbox_r&&(this._lightbox_r.parentNode.removeChild(this._lightbox_r),this._lightbox_r=this._lightbox=null),l.apply(this,arguments)}})});
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_readonly.js.map