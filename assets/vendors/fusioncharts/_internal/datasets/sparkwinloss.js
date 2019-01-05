import{BLANKSTRING,pluck,pluckNumber,parseUnsafeString,toRaphaelColor,POSITION_START,POSITION_END,getDashStyle,getValidValue,HUNDREDSTRING}from'../../_internal/lib/lib';import{getLightColor,getColumnColor}from'../lib/lib-graphics';import ColumnDataset from'./column';import{addDep}from'../../_internal/dependency-manager';import sparkwinlossAnimation from'../animation-rules/sparkwinloss-animation';var UNDEF,math=Math,mathMin=math.min,mathMax=math.max,GUTTER_PADDING=2,drawSparkValues=function(){var a=this,b=a.getFromEnv('chart'),c=b.config,d=c.dataLabelStyle,e=c.valuepadding+GUTTER_PADDING,f=a.getContainer('labelGroup'),g=c.sparkValues||(c.sparkValues={}),h=a.getGraphicalElement('closeValue'),i=a.getFromEnv('animationManager'),j={class:'fusioncharts-label',"text-anchor":POSITION_END,fill:d.color,"font-size":d.fontSize,"font-weight":d.fontWeight,"font-style":d.fontStyle,"font-family":d.fontFamily,visibility:'visible'},k={x:0,y:0};b.getChildContainer('datalabelsGroup').attr({"clip-rect":null}),k.y=.5*c.canvasHeight+c.canvasTop,j['text-anchor']=POSITION_START,k.x=c.canvasWidth+c.canvasLeft+e,g.closeValue&&g.closeValue.label&&(a.addGraphicalElement('closeValue',i.setAnimation({el:h||'text',attr:{text:g.closeValue.label,x:k.x,y:k.y,fill:g.closeValue.color||j.fill,"text-anchor":POSITION_START,"line-height":d.lineHeight,"text-bound":[d.backgroundColor,d.borderColor,d.borderThickness,d.borderPadding,d.borderRadius,d.borderDash],visibility:'visible'},container:f,component:a,label:'text'})),k.x+=g.closeValue.smartObj&&g.closeValue.smartObj.width+GUTTER_PADDING+e||0),a.labelDrawn=!0};addDep({name:'sparkwinlossAnimation',type:'animationRule',extension:sparkwinlossAnimation});class SparkWinLossDataset extends ColumnDataset{constructor(){super(),this.drawLabel=drawSparkValues}getType(){return'dataset'}getName(){return'sparkWinLoss'}_setConfigure(a,b){var c,d,e,f,g,h,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I=this,J=I.getFromEnv('chart'),K=J.config,L=I.config,M=I.config.JSONData,N=a||M.data,O=N&&N.length,P=I.getFromEnv('xAxis'),Q=P.getTicksLen(),R=a&&a.data.length||mathMin(Q,O),S=J.getFromEnv('dataSource').chart,T=I.getFromEnv('color-manager'),U=I.index||I.positionIndex,V=K.showplotborder,W=L.plotColor=T.getPlotColor(U),X=pluck(S.plotfillcolor,T.getColor('plotFillColor')),Y=pluck(S.wincolor,T.getColor('winColor')),Z=pluck(S.losscolor,T.getColor('lossColor')),$=pluck(S.drawcolor,T.getColor('drawColor')),_=pluck(S.scorelesscolor,T.getColor('scorelessColor')),aa=S.winhovercolor,ba=S.losshovercolor,ca=S.drawhovercolor,da=S.scorelesshovercolor,ea=0,fa=0,ga=0,ha=K.plotborderthickness,ia=K.isroundedges,ja=K.plothovereffect,ka=L.plotfillangle,la=L.plotBorderDashStyle,ma=I.components.data,na=J.isBar,oa=J.is3D,pa=L.maxValue||-Infinity,qa=L.minValue||+Infinity;for(ma||(ma=I.components.data=[]),super._setConfigure(),L.plotgradientcolor='',G=L.showPlotBorder=pluckNumber(S.showplotborder,0),L.plotborderalpha=h=G?pluck(S.plotborderalpha,f,HUNDREDSTRING):0,L.showTooltip=0,K.showtooltip=0,F=0;F<R;F++){switch(a?(k=a&&a.data[F],b===UNDEF?(H=ma.length-R+F,m=ma[H]):(H=b+F,m=ma[H])):(m=ma[F],k=N[F]),n=m&&m.config,m||(m=ma[F]={}),m.config||(n=ma[F].config={}),(k.value||'').toLowerCase()){case'w':W=pluck(k.color,Y,X),p=pluck(k.hovercolor,aa,W),n.setValue=l=1,ea+=1;break;case'l':W=pluck(k.color,Z,X),p=pluck(k.hovercolor,ba,W),n.setValue=l=-1,fa+=1;break;case'd':W=pluck(k.color,$,X),p=pluck(k.hovercolor,ca,W),n.setValue=l=.1,ga+=1;break;default:n.setValue=l=null;}1==k.scoreless&&(W=pluck(k.color,_,X),p=pluck(k.hovercolor,da,k.color,_,p)),n.toolText=!1,n.setLink=pluck(k.link),n.setDisplayValue=parseUnsafeString(k.displayvalue),C=pluckNumber(k.dashed),D=pluckNumber(k.dashlen,d),E=e=pluckNumber(k.dashgap,L.plotDashGap),null!==l&&(pa=mathMax(pa,l),qa=mathMin(qa,l)),n.plotBorderDashStyle=j=1===C?getDashStyle(D,E):0===C?'none':la,f=pluck(k.alpha,L.plotfillalpha),h=pluck(k.alpha,L.plotborderalpha,f).toString(),0>l&&!ia&&(c=L.plotfillAngle,ka=na?180-ka:360-ka),n.colorArr=o=getColumnColor(W+','+L.plotgradientcolor,f,g=L.plotfillratio,ka,ia,L.plotbordercolor,h,na?1:0,!!oa),n.label=getValidValue(parseUnsafeString(P.getLabel(pluckNumber(H-R,F)).label)),0!==ja&&(p=pluck(k.hovercolor,M.hovercolor,S.plotfillhovercolor,S.columnhovercolor,W),q=pluck(k.hoveralpha,M.hoveralpha,S.plotfillhoveralpha,S.columnhoveralpha,f),r=pluck(k.hovergradientcolor,M.hovergradientcolor,S.plothovergradientcolor,L.plotgradientcolor),!r&&(r=''),s=pluck(k.hoverratio,M.hoverratio,S.plothoverratio,g),t=pluckNumber(360-k.hoverangle,360-M.hoverangle,360-S.plothoverangle,ka),u=pluck(k.borderhovercolor,M.borderhovercolor,S.plotborderhovercolor,L.plotbordercolor),v=pluck(k.borderhoveralpha,M.borderhoveralpha,S.plotborderhoveralpha,h,f),w=pluckNumber(k.borderhoverthickness,M.borderhoverthickness,S.plotborderhoverthickness,ha),x=pluckNumber(k.borderhoverdashed,M.borderhoverdashed,S.plotborderhoverdashed),y=pluckNumber(k.borderhoverdashgap,M.borderhoverdashgap,S.plotborderhoverdashgap,d),z=pluckNumber(k.borderhoverdashlen,M.borderhoverdashlen,S.plotborderhoverdashlen,e),A=x?getDashStyle(z,y):j,1==ja&&p===W&&(p=getLightColor(p,70)),B=getColumnColor(p+','+r,q,s,t,ia,u,v.toString(),na?1:0,!!oa),n.setRolloutAttr={fill:oa?[toRaphaelColor(o[0]),!K.use3dlighting]:toRaphaelColor(o[0]),stroke:V&&toRaphaelColor(o[1]),"stroke-width":ha,"stroke-dasharray":j},n.setRolloverAttr={fill:oa?[toRaphaelColor(B[0]),!K.use3dlighting]:toRaphaelColor(B[0]),stroke:V&&toRaphaelColor(B[1]),"stroke-width":w,"stroke-dasharray":A}),c&&(ka=c),H++,n._x=F,n._y=l}L.maxValue=1,L.minValue=-1,1==pluckNumber(S.showvalue,1)?(K.sparkValues={closeValue:{}},K.sparkValues.closeValue.label=ea+'-'+fa+(0<ga?'-'+ga:BLANKSTRING)):K.sparkValues=UNDEF}}export default SparkWinLossDataset;