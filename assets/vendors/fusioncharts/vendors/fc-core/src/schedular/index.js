var jobList=[],pausedList={},priorityJobList=[],jobByID={},jobCount=0,win=window,nav=win.navigator,isIE11=/trident/i.test(nav.userAgent)&&/rv:11/i.test(nav.userAgent)&&!win.opera,isIE=/msie/i.test(nav.userAgent)&&!win.opera,isEdge=/Edge/.test(nav.userAgent),minMsThreshold=16,schedular={},fnStr='function',jobPrefixStr='JOB_',priorityList={instant:1,render:1,chartEvents:1,configure:2,chartClick:2,draw:3,entitydraw:4,label:4,animation:5,tracker:6,kdTree:6,postRender:7},jobFrame=win.requestAnimationFrame||win.webkitRequestAnimationFrame||win.mozRequestAnimationFrame||win.oRequestAnimationFrame||win.msRequestAnimationFrame||function(a){setTimeout(a,minMsThreshold)},jobExecutionFramerequested=!1,executeJob=function(){let a,b,c,d=!0,e=new Date().getTime();for(jobExecutionFramerequested=!0;d&&(a=jobList[0]);)b=new Date().getTime(),a.OIAF&&c||a.executeAfter&&!(a.executeAfter<b)||!(b-e<minMsThreshold)?d=!1:(jobList.shift(),priorityJobList[a.priority]-=1,jobByID[a.jobID]&&!a.executed&&(a.executed=!0,delete jobByID[a.jobID],a.job(),c=a.OIAF));jobList.length?jobFrame(executeJob):jobExecutionFramerequested=!1};(isIE11||isIE||isEdge)&&(jobFrame=jobFrame.bind(window)),schedular.addJob=function(a,b,c){var d,e,f,g=0,h=c&&c.oneInAFrame,j=c&&c.addToTop?b-1:b;for(typeof a==fnStr?(d=jobPrefixStr+ ++jobCount+'_'+(b||1),e={job:a,priority:b,OIAF:h,jobID:d},c&&c.executionDelay&&(e.executeAfter=new Date().getTime()+c.executionDelay)):e=a,f=0;f<=j;f++)g+=priorityJobList[f]||0;return jobList.splice(g,0,e),jobByID[e.jobID]=e,priorityJobList[b]=(priorityJobList[b]||0)+1,jobExecutionFramerequested||1!==jobList.length||(h?jobFrame(executeJob):setTimeout(executeJob,0)),d},schedular.removeJob=function(a){jobByID[a]&&delete jobByID[a]},schedular.updateJob=function(a,b,c,d){return jobByID[a]?(jobByID[a].job=b,a):this.addJob(b,c,d)},schedular.pauseExecution=function(a){return!!jobByID[a]&&void(pausedList[a]=jobByID[a],delete jobByID[a])},schedular.resumeExecution=function(a){var b=pausedList[a];return!!b&&void(schedular.addJob(b,b.priority),delete pausedList[a])};export default schedular;export{priorityList};