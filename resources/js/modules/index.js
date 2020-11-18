import Vue from 'vue'
import Vuex from 'vuex'
import userReducer from './reducer/userReducer'
import postReducer from './reducer/postReducer'


Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        userReducer,
        postReducer
    }
})