import Vue from 'vue'
import Base from './components/Base.vue'
import router from './routes'
import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css' //Vuesax styles
import store from './modules'
import 'bulma'

Vue.config.productionTip = false
Vue.use(Vuesax)

new Vue({
    el: '#app',
    router,
    store,
    render: (h) => h(Base)
}).$mount('app')