import Vue from 'vue'
import VueRouter from 'vue-router'
import BaseHome from '../components/home/BaseHome.vue'
import BaseAbout from '../components/about/BaseAbout.vue'
import BaseLogin from '../components/auth/BaseLogin.vue'
import BaseRegister from '../components/auth/BaseRegister.vue'
import BaseProfile from '../components/auth/BaseProfile.vue'

Vue.use(VueRouter)


const routes = [{
    path: '/',
    component: BaseHome
},{
    path: '/about',
    component: BaseAbout
},{
    path: '/signin',
    component: BaseLogin
},{
    path: '/signup',
    component: BaseRegister
},{
    path: '/profile',
    name: 'profile',
    component: BaseProfile
}]

export default new VueRouter({
    routes
})