<template>
    <form v-on:submit.prevent='onSubmit' class="knd-form">
        <div class="knd-form-x">
            <div class="knd-form-field">
                <vs-input type="email" v-model="email" placeholder="Email" ></vs-input>
            </div>
            <div class="knd-form-field">
                <vs-input type="password" v-model="password" placeholder="Password"></vs-input>
            </div>
            <div class="knd-field-group">
                <vs-button>
                    Submit
                </vs-button>
                <a v-on:click="handleClickHistory('/signup')">
                    Register
                </a>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import { mapActions } from 'vuex'

export default {
    data: () => ({
        email: '',
        password: ''
    }),
    methods: {
        ...mapActions(['loginUser']),
        handleClickHistory(newValue) {
            this.$router.push(newValue)
        },
        onSubmit() {
            const data = {
                email: this.email,
                password: this.password
            }
            this.loginUser(data).then((res) => {
                localStorage.setItem('token', res.data.access_token)
            }).catch((err) => {
                this.$vs.notification({
                    color: 'danger',
                    position: 'bottom-center',
                    title: 'Login Fails',
                    text: err.response.data.error
                })
            })
        }
    }
}
</script>

<style>

.knd-form {
    height: 80vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.knd-form-field {
    margin-top: 0.25rem;
    margin-bottom: 0.25rem;
}

.knd-form-x {
    padding: 1.25rem;
    background-color: #ffffff;
}

.vs-input {
    width: 460px !important
}

.knd-field-group {
    display: flex;
    align-items: center;
    flex-direction: row;
    margin-top: 0.50rem;
}

.knd-field-group a {
    text-decoration: none !important;
    text-transform: capitalize;
    margin-left: 0.50rem;
    cursor: pointer;
}
</style>