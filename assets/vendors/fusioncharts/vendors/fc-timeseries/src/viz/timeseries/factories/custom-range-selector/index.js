import{componentFactory,pluckNumber}from'../../../../../../fc-core/src/lib';import CustomRangeSelector from'../../../../_internal/components/custom-range-selector';export default(a=>{let b=a.getFromEnv('dataSource'),c=b.extensions||{},d=pluckNumber(c.customrangeselector&&c.customrangeselector.enabled,1);if(d&&componentFactory(a,CustomRangeSelector,'customRangeSelector',+d,[{domain:a.getFocusLimit()}]),a.getChildren('customRangeSelector')){const b=a.getChildren('customRangeSelector')[0];b.addExtEventListener('focusLimitChanged',()=>{b.setData({domain:a.getFocusLimit()},!0)},a)}});