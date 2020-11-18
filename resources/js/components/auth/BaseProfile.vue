<template>
  <div>
      <div class="knd-profile">
          <img :src="fetchDetailAuth.profile" alt="">
          <a href="">
              {{fetchDetailAuth.name}}
          </a>
      </div>
        <div class="knd-card-container">
            <div v-for="post in fetchDetailAuthPost" :key="post.id">
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
    mounted() {
        const location = this.$router.history.current.query.username
    },
    computed: mapGetters(['fetchDetailAuth','fetchDetailAuthPost']),
    methods: {
        ...mapActions(['fetchUserDetail'])
    },
    beforeMount() {
        const pk = this.$router.history.current.query.username
        this.fetchUserDetail(pk).then((res) => {
                this.$store.commit('LOAD_DETAIL_AUTH', res.data.author),
                this.$store.commit('LOAD_DETAIL_AUTH_POST', res.data.post)
        })
    }
}
</script>

<style>
.knd-profile img {
    width: 100px;
    height: 100px;
    border-radius: 80%;
}

.knd-profile a {
    text-decoration: none;
    color: black;
    font-size: 26px;
    margin-left: 0.50rem;
}

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