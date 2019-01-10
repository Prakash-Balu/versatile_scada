import{OperatorTypes}from'./type-enums';import{columnIndexOf}from'../utils/datatable-utils';import{numberComparator,stringComparator}from'../utils/comparators';import timSort from'../utils/sort';function sort(a){let c=a;return{ops:'sort',type:OperatorTypes.Sort,_updateArgs:a=>{c=a},fn:(a,d,b,e)=>({data:a,schema:d,config:b,generatorFn:()=>{e&&(a=e.call());let b;if(c.constructor===Function)b=c;else{c.constructor!==Array&&(c=[c]);let e,a,f,g=[],h=[];for(e=0;e<c.length;e++)if(c[e].column){if(a=columnIndexOf(c[e].column,d),h.push(a),-1===a)throw new Error('Sort column is not found in schema - '+c[e].column);switch(d[a].type){case'number':case'interval':case'date':g.push(numberComparator);break;default:g.push(stringComparator);}}b=(i,a)=>{for(e=0;e<c.length;e++)if(f='interval'===d[h[e]].type?'desc'===c[e].order?g[e](a[h[e]].start,i[h[e]].start):g[e](i[h[e]].start,a[h[e]].start):'desc'===c[e].order?g[e](a[h[e]],i[h[e]]):g[e](i[h[e]],a[h[e]]),0===f){if(e===c.length-1)return 0;continue}else return f}}return timSort(a,b),a}})}}export default sort;