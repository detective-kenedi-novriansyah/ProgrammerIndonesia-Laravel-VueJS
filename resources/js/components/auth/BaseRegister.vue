<template>
    <form v-on:submit.prevent="onSubmit" class="knd-form">
        <div>
            <div class="knd-form-field">
                <vs-input type="text" v-model="username" placeholder="Username"></vs-input>
            </div>
            <div class="knd-form-field">
                <vs-input type="email" v-model="email" placeholder="email"></vs-input>
            </div>
            <div class="knd-form-field">
                <vs-input type="password" v-model="password" placeholder="Password"></vs-input>
            </div>
            <div class="knd-form-field">
                <vs-input type="password" v-model="confirm_password" placeholder="Confirm Password"></vs-input>
            </div>
            <div class="knd-form-field-submit">
                <vs-button>
                    Sign up
                </vs-button>
                <a href="">
                    Already exists account?
                </a>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios'
import { mapActions } from 'vuex'

export default {
    data: () => ({
        username: '',
        email: '',
        password: '',
        confirm_password: ''
    }),
    methods: {
        ...mapActions(['registerUser']),
        onSubmit() {
            const data = {
                name: this.username,
                email: this.email,
                password: this.password,
                confirm_password: this.confirm_password
            }
            this.registerUser(data).then((res) => {
                this.$router.push('/signin')
                this.$vs.notification({
                    color: 'success',
                    position: 'bottom-center',
                    title: 'Successfully',
                    text: res.data.message
                })
            }).catch((err) => {
                this.$vs.notification({
                    color: 'danger',
                    position: 'bottom-center',
                    title: 'Failes',
                    text: err.response.data.message
                })
            })
        }
    }
}
</script>

<style>
.knd-form {
    height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.knd-form-field {
    margin-top: 0.50rem;
    margin-bottom: 0.50rem;
}

.knd-form-field-submit {
    display: flex;
    align-items: center;
    flex-direction: row;
}
</style>