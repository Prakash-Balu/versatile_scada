import Canvas from'../canvases/canvas';import AxisRefVisualCartesian from'../axis-ref-visuals/axis-ref-component';import{componentFactory}from'../lib/lib';export default function(a){let b,c=a._parseCanvasCosmetics&&a._parseCanvasCosmetics();if(componentFactory(a,Canvas,'canvas',a.config.showVolumeChart?2:1),b=a.getChildren('canvas'),b)for(let a=0,d=b.length;a<d;a++)b[a].configure(c),componentFactory(b[a],AxisRefVisualCartesian,'axisRefVisualCartesian')}