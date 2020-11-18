<template>
    <vs-navbar center-collapsed v-model="active">
        <template #left>
          <!-- <img src="/logo2.png" alt=""> -->
        </template>
        <vs-navbar-item :active="active == 'guide'" id="guide" v-on:click="handleClickHistory('/')">
          Home
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'docs'" id="docs">
          Profile
        </vs-navbar-item>
        <template #right>
          <vs-button flat @click="handleClickHistory('/signin')">Login</vs-button>
          <vs-button v-on:click="handleClickHistory('/signup')">Get Started</vs-button>
        </template>
      </vs-navbar>
</template>

<script>
export default {
    data: () => ({
        active: 'guide'
    }),
    methods: {
        handleClickHistory(newValue) {
            this.$router.push(newValue)
        }
    }
}
</script>

<style>
nav {
    padding-top: 0.50rem;
    padding-bottom: 0.25rem;
    background-color: white;
    box-shadow: 0 1px 2px 0 rgba(60,64,67,0.302), 0 1px 3px 1px rgba(60,64,67,0.149);
}
nav ul {
    list-style-type: none;
    display: flex;
    justify-content: flex-end;
}
nav ul li {
    padding-left: 0.50rem;
    padding-right: 0.50rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
    background-color: red;
    margin-left: 0.25rem;
    margin-right: 0.25rem;
}

ul li a {
    text-decoration: none !important;
    color: white !important;
}
</style>