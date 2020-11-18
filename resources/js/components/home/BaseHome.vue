
<template>
    <div>
        <Layer2 :id="id" :content="content" @handleClickClose="handleClickClose($event)" @handleClickUpdate="handleClickUpdate($event)" @onChangeContent="onChangeContent($event)"/>
    </div>  
</template>

<script>
import Layer2 from './Layer2.vue'

export default {
    data: () => ({
        id: 0,
        content: 'Programmer Indonesia'
    }),
    components: {
        Layer2
    },
    methods: {
        onChangeContent(newValue) {
            this.content = newValue
        },
        handleClickUpdate(pk, content) {
            this.id = pk
            this.content = content
        },
        handleClickClose(newValue) {
            this.id = newValue;
            this.content = ''
        }
    }
}
</script>

<style>

</style>