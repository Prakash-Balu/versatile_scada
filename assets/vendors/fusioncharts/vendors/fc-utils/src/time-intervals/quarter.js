import TimeInterval from'./time-interval.js';const quarter=new TimeInterval('quarter',a=>{a.setMonth(a.getMonth()-(a.getMonth()+3)%3,1),a.setHours(0,0,0,0)},(a,b)=>a.setMonth(a.getMonth()+3*b),(a,b)=>(b.getMonth()-(b.getMonth()+3)%3-(a.getMonth()-(a.getMonth()+3)%3))/3+4*(b.getFullYear()-a.getFullYear()),a=>Math.floor(a.getMonth()/3));export default quarter;