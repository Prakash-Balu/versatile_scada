import ComponentBase,{addAllEventsOnGraphic,removeAllEventsFromGraphic,_mapSubFnForward}from'./component-base';let UNDEF,addEventOnAllGraphics=function(a,b,c){var d;b&&c&&(d=a=>{a.on&&a.on(b,c)},_mapSubFnForward(a.getGraphicalElement(),d),_mapSubFnForward(a.getChildContainer(),d))},removeEventFromAllGraphics=function(a,b,c){var d;b&&c&&(d=a=>{a.off&&a.off(b,c)},_mapSubFnForward(a.getGraphicalElement(),d),_mapSubFnForward(a.getChildContainer(),d))};class ComponentInterface extends ComponentBase{constructor(){super();let a=this;a._components={},a.fireEvent('instantiated'),a.__setDefaultConfig()}addGraphicalElement(a,b,c,d){var e=this._graphics;return c=c||!1,b&&(c?(e[a]===UNDEF&&(e[a]=[]),d?e[a][d]=b:e[a].push(b)):(e[a]=b,this.fireEvent('graphicalelementattached',{element:b})),addAllEventsOnGraphic(b,this._middleListeners,this)),b}removeGraphicalElement(a){let b,c=this,d=c._graphics;_mapSubFnForward(d,(e,f,g)=>{e===a&&(b=!0,removeAllEventsFromGraphic(e,c._middleListeners),c._setRemoveAnim(e,f),g===UNDEF?delete d[f]:d[f].splice(g,1))}),b&&this.fireEvent('graphicalelementremoved',{element:a})}getGraphicalElement(a){return'undefined'==typeof a?this._graphics:this._graphics[a]}addChildContainer(a,b){var c=this,d=c._childContainers;return b&&(d===UNDEF&&(d=c._childContainers={}),d[a]=b,addAllEventsOnGraphic(b,c._middleListeners,c)),b}removeChildContainer(a){let b=this,c=b._childContainers;c&&c[a]&&(removeAllEventsFromGraphic(c[a],b._middleListeners),b._setRemoveAnim(c[a],a),delete c[a])}getChildContainer(a){return this._childContainers===UNDEF&&(this._childContainers={}),a?this._childContainers[a]:this._childContainers}addContainer(a,b){var c=this._containers;return b&&(c===UNDEF&&(c=this._containers={}),c[a]=b),b}removeContainer(a){let b=this,c=b._containers;c&&c[a]&&(b._setRemoveAnim(c[a],a),delete c[a])}getContainer(a){return this._containers===UNDEF&&(this._containers={}),a?this._containers[a]:this._containers}addEventListener(a,b,c){var d=super.addEventListener(a,b,c);return!0===d?(addEventOnAllGraphics(this,a,this._middleListeners[a]),b):!!d&&b}removeEventListener(a,b){super.removeEventListener(a,b)&&removeEventFromAllGraphics(this,a,this._middleListeners[a])}_dispose(){let a,b=this;if(super._dispose()){for(a in b.getFromEnv('paper')&&!b.getFromEnv('paper').removed&&(_mapSubFnForward(b.getChildContainer(),b.__instantRemoveFn),_mapSubFnForward(b.getGraphicalElement(),b.__instantRemoveFn),_mapSubFnForward(b.getContainer(),b.__instantRemoveFn)),b)b.hasOwnProperty(a)&&delete b[a];b.fireEvent('removed')}}removingDraw(){var a=this;_mapSubFnForward(a.getChildContainer(),a._setRemoveAnim),_mapSubFnForward(a.getGraphicalElement(),a._setRemoveAnim),_mapSubFnForward(a.getContainer(),a._setRemoveAnim)}attachChild(a,b,c){var d=b||a.getType(),e=this._components;return!1===c?e[d]=a:(!(e[d]&&e[d]instanceof Array)&&(e[d]=[]),e[d].push(a)),a._setLinkedParent(this),this.fireEvent('childattached',{attachedChild:a}),a}getChild(a){var b,c=this._components;return a===UNDEF?c:(this._searchChildren(a,function(a){b=a}),b)}_searchChildren(a,b){var c,d,e,f=this._components;for(d in f)if(f.hasOwnProperty(d))if(c=f[d],c.constructor===Array){for(e=c.length-1;0<=e;e--)if(c[e].getId&&c[e].getId()===a)return b(c[e],e,c);}else if(c.getId&&c.getId()===a)return b(d,UNDEF,f)}getChildren(a){return a?this._components[a]:this._components}}export default ComponentInterface;