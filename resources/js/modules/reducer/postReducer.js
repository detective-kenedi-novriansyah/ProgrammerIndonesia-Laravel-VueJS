import axios from 'axios'

const state = {
    items: [],
    item: [],
    validate: false
}
const actions = {
    async fetchData({commit}) {
        const response = await axios.get('api/post/').then((res) => {
            commit('LOAD_POST', res.data.data)
        })
        return response
    },
    async createPost({commit}, data) {
        const response  = await axios.post('api/post/store', data, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        return response
    },
    async deletePost({commit}, data) {
        const response  = await axios.delete(`api/post/${data}`, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        return response
    },
    async updatePost({commit}, data) {
        const response  = await axios.put(`api/post/${data.id}`, {
            content: data.content
        },{
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        return response
    }
}
const mutations = {
    LOAD_POST: (posts, data) => (posts.items = data),
    CREATE_POST: (posts, data) => (posts.items.unshift(data)),
    DELETE_POST: (post, pk) => (post.items = post.items.filter(function(x) {
        return x.id !== pk
    })),
    UPDATE_POST: (post, data) => (post.items = post.items.map((x) => x.id == data.id ? data : x))
}
const getters = {
    fetchPost: (post) => post.items
}

export default {
    state,
    actions,
    mutations,
    getters
}