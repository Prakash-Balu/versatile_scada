import{OperatorTypes}from'./type-enums';function select(a,b){return a=a&&a.constructor!==Array?[a]:a,{ops:'select',type:OperatorTypes.Select,fn:(c,d,e)=>{let f=[],g=[];if(a){let c;for(b=b||{exclude:!1},c=0;c<d.length;c++)(b.exclude&&!a.includes(d[c].name)||!b.exclude&&a.includes(d[c].name))&&(f.push(d[c]),g.push(c))}else f=d;return{data:c,schema:f,config:e,generatorFn:()=>{let a=g.length;if(0<a){let b,d,e,f=[];for(b=0;b<c.length;b++){for(e=[],d=0;d<a;d++)e[d]=c[b][g[d]];f[b]=e}return f}return c.slice(0)}}}}}function filter(a){return{ops:'filter',type:OperatorTypes.GenericFilter,fn:(b,c,d,e)=>({data:b,schema:c,config:d,generatorFn:()=>{e&&(b=e.call());let d={};for(let a=0;a<c.length;a++)d[c[a].name]=a;return b.filter(b=>a.call(this,b,d))}})}}export{select,filter};