import axios from 'axios'

const state = {
    item: {},
    items: []
}

const actions = {
    async loginUser({commit},data) {
        const response = await axios.post('api/auth/login', data)
        return response
    },
    async registerUser({commit}, data) {
        const response = await axios.post('api/auth/create', data)
        return response
    },
    async fetchUserDetail({commit}, data) {
        const response = await axios.get(`api/auth/profile/${data}`, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        return response
    }
}
const mutations = {
    LOAD_DETAIL_AUTH: (auth, data) => (auth.item = data),
    LOAD_DETAIL_AUTH_POST: (post, data) => (post.items = data)
}
const getters = {
    fetchDetailAuth: (auth) => auth.item,
    fetchDetailAuthPost: (post) => post.items
}

export default {
    state,
    actions,
    mutations,
    getters
}
