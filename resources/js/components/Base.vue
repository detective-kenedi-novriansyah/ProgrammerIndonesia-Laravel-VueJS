<template>
    <div id="app">
        <BaseNavbar/>
        <div class="square">
            <router-view></router-view>
        </div>
    </div>  
</template>

<script>
import BaseNavbar from './navbar/BaseNavbar.vue'
export default {
    components: {
        BaseNavbar
    },
}
</script>

<style>
.square {
    margin-top: 4.25rem;
}
</style>