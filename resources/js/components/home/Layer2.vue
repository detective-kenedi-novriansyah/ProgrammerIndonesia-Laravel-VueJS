<template>
    <div>
        <form v-on:submit.prevent="onSubmit" class="knd-form-x">
            <div class="knd-form-field">
                <textarea name="content" id="content" cols="30" rows="5" class="textarea has-fixed-size" :value="content" @input="onChangeContent"></textarea>
            </div>
            <div class="knd-form-field">
                <div class="knd-form-field-group" v-if="id">
                    <vs-button>
                        Update
                    </vs-button>
                    <vs-button type="button" v-on:click="handleClickClose">
                        Close
                    </vs-button>
                </div>
                <vs-button class="knd-form-button" v-else>
                    Posting
                </vs-button>
            </div>
        </form>
        <div class="knd-card-container">
            <div v-for="post in fetchPost" :key="post.id">
                <div class="knd-card">
                    <div class="knd-card-header">
                        <img :src="post.user_id.profile" alt="" class="knd-card-avatar">
                        <a v-on:click="handleClickProfile(post.user_id.id)">
                            {{post.user_id.name}}
                        </a>
                        <div class="knd-push"></div>
                        <vs-button v-on:click="handleClickUpdate(post.id,post.content)">
                            Update
                        </vs-button>
                        <vs-button color="danger" v-on:click="handleClickDelete(post.id)">
                            Delete
                        </vs-button>
                    </div>
                    <div class="knd-card-content">
                        {{post.content}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    props: {
        id: {
            type: Number
        },
        content: {
            type: String
        }
    },
    data: () => ({
        softContent: ''
    }),
    computed: mapGetters(['fetchPost']),
    methods: {
        ...mapActions(['createPost','fetchData','deletePost','updatePost','fetchUserDetail']),
        handleClickProfile(newValue) {
            this.fetchUserDetail(newValue).then((res) => {
                this.$store.commit('LOAD_DETAIL_AUTH', res.data.author),
                this.$store.commit('LOAD_DETAIL_AUTH_POST', res.data.post)
                this.$router.push({
                    name: 'profile',
                    query: {
                        username: res.data.author.id
                    }
                })
            })
        },
        onChangeContent(event) {
            this.softContent = event.target.value
            this.$emit('onChangeContent', this.softContent)
        },
        onSubmit() {
            let data;
            if(!this.id) {
                data = {
                    content: this.softContent,
                }

                this.createPost(data).then((res) => {
                this.$store.commit('CREATE_POST', res.data.result)
                this.$vs.notification({
                    color: 'success',
                    position: 'bottom-center',
                    title: 'Successfully',
                    text: res.data.message
                })
                    this.softContent = '';
                    this.$emit('onChangeContent', this.softContent)
                }).catch((err) => {

                })
            } else {
                data = {
                    id: this.id,
                    content: this.softContent
                }
                this.updatePost(data).then((res) => {
                    this.$store.commit('UPDATE_POST', res.data.result)
                    this.$vs.notification({
                        color: 'success',
                        position: 'bottom-center',
                        title: 'Successfully',
                        text: res.data.message
                    })
                })
            }
        },
        handleClickDelete(pk) {
            this.deletePost(pk).then((res) => {
                this.$store.commit('DELETE_POST',pk)
                this.$vs.notification({
                    color: 'success',
                    position: 'bottom-center',
                    title: 'Successfully',
                    text: res.data.message
                })
            })
        },
        handleClickUpdate(pk, content) {
            this.$emit('handleClickUpdate', pk, content)
        },
        handleClickClose() {
            this.$emit('handleClickClose',0)
        }
    },
    mounted() {
        this.fetchData();
    }
}
</script>

<style>
.knd-card-container {
    width: 50%;
    display: block;
    margin-right: auto;
    margin-left: auto;

}

.knd-card {
    padding: 1.25rem;
    box-shadow: 0 1px 2px 0 rgba(60,64,67,0.302), 0 1px 3px 1px rgba(60,64,67,0.149);
    border-radius: 10px;
    margin-bottom: 1.25rem;
}

.knd-card-header {
    display: flex;
    align-items: center;
}

.knd-push {
    flex:  1 1 0%;
}

.knd-form-field-group {
    display: flex;
    align-items: center;
}

.knd-form-x {
    width: 50%;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.knd-form-button {
    width: 160px;
}

.knd-card-avatar {
    width: 40px;
    height: 40px;
    border-radius: 80%;
    margin-right: 0.50rem;
}
</style>