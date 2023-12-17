<template>

    <div>
        My name is Hello! 
        {{ hello_vue }}
        <Test color="red"></Test>
    </div>

</template>

<script>
import { defineComponent, ref } from 'vue';
import Test from "./Test.vue";

export default defineComponent({
    components: {
        Test,
    },
    setup() {
        return {
            hello_vue: 'Hello Vue JS.'
        }
    }
});

</script>