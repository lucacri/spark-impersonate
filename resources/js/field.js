Nova.booting((Vue, router, store) => {
    Vue.component('index-spark-impersonate', require('./components/IndexField'));
    Vue.component('detail-spark-impersonate', require('./components/DetailField'));
})
