/*
@license

dhtmlxGantt v.4.0.0 dhtmlx.com
This software can be used only as part of dhtmlx.com site.
You are not allowed to use it on any other site

(c) Dinamenta, UAB.
*/
gantt.config.undo_steps=10,gantt.config.undo=!0,gantt.config.redo=!0,gantt.undo=function(){this._undo.undo()},gantt.getUndoStack=function(){return this._undo._undoStack},gantt.getRedoStack=function(){return this._undo._redoStack},gantt.redo=function(){this._undo.redo()},gantt.config.undo_types={link:"link",task:"task"},gantt.config.undo_actions={update:"update",remove:"remove",add:"add"},gantt._undo={_undoStack:[],_redoStack:[],maxSteps:10,undo_enabled:!0,redo_enabled:!0,_push:function(t,e){if(e.commands.length){
for(t.push(e);t.length>this.maxSteps;)t.shift();return e}},_pop:function(t){return t.pop()},undo:function(){if(this.updateConfigs(),this.undo_enabled){var t=this._pop(this._undoStack);gantt.callEvent("onBeforeUndo",[t])!==!1&&t&&(this._applyAction(this.action.invert(t)),this._push(this._redoStack,t)),gantt.callEvent("onAfterUndo",[])}},redo:function(){if(this.updateConfigs(),this.redo_enabled){var t=this._pop(this._redoStack);gantt.callEvent("onBeforeRedo",[t])!==!1&&t&&(this._applyAction(t),this._push(this._undoStack,t)),
gantt.callEvent("onAfterRedo",[])}},_applyAction:function(t){var e=null,i=this.command.entity,n=this.command.type,a={};a[i.task]={add:"addTask",update:"updateTask",remove:"deleteTask",isExists:"isTaskExists"},a[i.link]={add:"addLink",update:"updateLink",remove:"deleteLink",isExists:"isLinkExists"},gantt.batchUpdate(function(){for(var i=0;i<t.commands.length;i++){e=t.commands[i];var s=a[e.entity][e.type],r=a[e.entity].isExists;e.type==n.add?gantt[s](e.oldValue,e.oldValue.parent,e.oldValue.$index):e.type==n.remove?gantt[r](e.value.id)&&gantt[s](e.value.id):e.type==n.update&&gantt[s](e.value.id,e.value);
}})},logAction:function(t){this._push(this._undoStack,t),this._redoStack=[]},action:{create:function(t){return{commands:t?t.slice():[]}},invert:function(t){for(var e=gantt.copy(t),i=gantt._undo.command,n=0;n<t.commands.length;n++){var a=e.commands[n]=i.invert(e.commands[n]);if(a.type==i.type.update){var s=a.value;a.value=a.oldValue,a.oldValue=s}}return e}},command:{create:function(t,e,i,n){return{entity:n,type:i,value:gantt.copy(t),oldValue:gantt.copy(e||t)}},invert:function(t){var e=gantt.copy(t);
return e.type=this.inverseCommands(t.type),e},entity:null,type:null,inverseCommands:function(t){switch(t){case this.type.update:return this.type.update;case this.type.remove:return this.type.add;case this.type.add:return this.type.remove;case this.type.load:return this.type.clear;case this.type.clear:return this.type.load;default:return gantt.assert(!1,"Invalid command "+t),null}}},monitor:{_batchAction:null,_batchMode:!1,_ignore:!1,startIgnore:function(){this._ignore=!0},stopIgnore:function(){this._ignore=!1;
},startBatchAction:function(){this.timeout&&clearTimeout(this.timeout),this.timeout=setTimeout(function(){gantt._undo.monitor.stopBatchAction()},10),this._ignore||this._batchMode||(this._batchMode=!0,this._batchAction=gantt._undo.action.create())},stopBatchAction:function(){if(!this._ignore){var t=gantt._undo;this._batchAction&&t.logAction(this._batchAction),this._batchMode=!1,this._batchAction=null}},_storeCommand:function(t){var e=gantt._undo;if(e.updateConfigs(),e.undo_enabled)if(this._batchMode)this._batchAction.commands.push(t);else{
var i=e.action.create([t]);e.logAction(i)}},_storeEntityCommand:function(t,e,i,n){var a=gantt._undo,s=a.command.create(t,e,i,n);this._storeCommand(s)},_storeTaskCommand:function(t,e){this._storeEntityCommand(t,this.getInitialTask(t.id),e,gantt._undo.command.entity.task)},_storeLinkCommand:function(t,e){this._storeEntityCommand(t,this.getInitialLink(t.id),e,gantt._undo.command.entity.link)},onTaskAdded:function(t){this._ignore||this._storeTaskCommand(t,gantt._undo.command.type.add)},onTaskUpdated:function(t){
this._ignore||this._storeTaskCommand(t,gantt._undo.command.type.update)},onTaskDeleted:function(t){if(!this._ignore){if(this._storeTaskCommand(t,gantt._undo.command.type.remove),this._nestedTasks[t.id])for(var e=this._nestedTasks[t.id],i=0;i<e.length;i++)this._storeTaskCommand(e[i],gantt._undo.command.type.remove);if(this._nestedLinks[t.id])for(var n=this._nestedLinks[t.id],i=0;i<n.length;i++)this._storeLinkCommand(n[i],gantt._undo.command.type.remove)}},onLinkAdded:function(t){this._ignore||this._storeLinkCommand(t,gantt._undo.command.type.add);
},onLinkUpdated:function(t){this._ignore||this._storeLinkCommand(t,gantt._undo.command.type.update)},onLinkDeleted:function(t){this._ignore||this._storeLinkCommand(t,gantt._undo.command.type.remove)},_initialTasks:{},_nestedTasks:{},_nestedLinks:{},_getLinks:function(t){return t.$source.concat(t.$target)},setNestedTasks:function(t,e){for(var i=null,n=[],a=this._getLinks(gantt.getTask(t)),s=0;s<e.length;s++)i=this.setInitialTask(e[s]),a=a.concat(this._getLinks(i)),n.push(i);for(var r={},s=0;s<a.length;s++)r[a[s]]=!0;
var o=[];for(var s in r)o.push(this.setInitialLink(s));this._nestedTasks[t]=n,this._nestedLinks[t]=o},setInitialTask:function(t){if(!this._initialTasks[t]||!this._batchMode){var e=gantt.copy(gantt.getTask(t));e.$index=gantt.getTaskIndex(t),this._initialTasks[t]=e}return this._initialTasks[t]},getInitialTask:function(t){return this._initialTasks[t]},_initialLinks:{},setInitialLink:function(t){return this._initialLinks[t]&&this._batchMode||(this._initialLinks[t]=gantt.copy(gantt.getLink(t))),this._initialLinks[t];
},getInitialLink:function(t){return this._initialLinks[t]}}},gantt._undo.updateConfigs=function(){gantt._undo.maxSteps=gantt.config.undo_steps,gantt._undo.command.entity=gantt.config.undo_types,gantt._undo.command.type=gantt.config.undo_actions,gantt._undo.undo_enabled=!!gantt.config.undo,gantt._undo.redo_enabled=!!gantt.config.undo&&!!gantt.config.redo},function(){function t(t){return o.setInitialTask(t),!0}function e(t,e,i){t&&(t.id==e&&(t.id=i),t.parent==e&&(t.parent=i))}function i(t,i,n){e(t.value,i,n),
e(t.oldValue,i,n)}function n(t,e,i){t&&(t.source==e&&(t.source=i),t.target==e&&(t.target=i))}function a(t,e,i){n(t.value,e,i),n(t.oldValue,e,i)}function s(t,e,n){for(var s=gantt._undo,r=0;r<t.length;r++)for(var o=t[r],_=0;_<o.commands.length;_++)o.commands[_].entity==s.command.entity.task?i(o.commands[_],e,n):o.commands[_].entity==s.command.entity.link&&a(o.commands[_],e,n)}function r(t,e,i){for(var n=gantt._undo,a=0;a<t.length;a++)for(var s=t[a],r=0;r<s.commands.length;r++){var o=s.commands[r];o.entity==n.command.entity.link&&(o.value&&o.value.id==e&&(o.value.id=i),
o.oldValue&&o.oldValue.id==e&&(o.oldValue.id=i))}}var o=gantt._undo.monitor,_={onBeforeUndo:"onAfterUndo",onBeforeRedo:"onAfterRedo"};for(var l in _)gantt.attachEvent(l,function(){o.startIgnore()}),gantt.attachEvent(_[l],function(){o.stopIgnore()});for(var d=["onTaskDragStart","onAfterTaskDelete","onBeforeBatchUpdate"],l=0;l<d.length;l++)gantt.attachEvent(d[l],function(){o.startBatchAction()});gantt.attachEvent("onBeforeTaskDrag",t),gantt.attachEvent("onLightbox",t),gantt.attachEvent("onBeforeTaskAutoSchedule",function(e){
t(e.id)}),gantt.attachEvent("onBeforeTaskDelete",function(e){t(e);var i=[];gantt.eachTask(function(t){i.push(t.id)},e),o.setNestedTasks(e,i)}),gantt.attachEvent("onAfterTaskAdd",function(t,e){o.onTaskAdded(e)}),gantt.attachEvent("onAfterTaskUpdate",function(t,e){o.onTaskUpdated(e)}),gantt.attachEvent("onAfterTaskDelete",function(t,e){o.onTaskDeleted(e)}),gantt.attachEvent("onAfterLinkAdd",function(t,e){o.onLinkAdded(e)}),gantt.attachEvent("onAfterLinkUpdate",function(t,e){o.onLinkUpdated(e)}),gantt.attachEvent("onAfterLinkDelete",function(t,e){
o.onLinkDeleted(e)}),gantt.attachEvent("onTaskIdChange",function(t,e){var i=gantt._undo;s(i._undoStack,t,e),s(i._redoStack,t,e)}),gantt.attachEvent("onLinkIdChange",function(t,e){var i=gantt._undo;r(i._undoStack,t,e),r(i._redoStack,t,e)}),gantt.attachEvent("onGanttReady",function(){gantt._undo.updateConfigs()})}();
//# sourceMappingURL=../sources/ext/dhtmlxgantt_undo.js.map