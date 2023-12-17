<template>
    My name is Test!

    <div id="app" :color="color">
        <button @click="increment">
            Count is: {{ count }}
        </button>
        <button @click="helloVue">
            Click Me!
        </button>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
    name: 'Test',

    // setup() {
    //     return {
    //         count: ref(0)
    //     }
    // },
    // methods: {
    //     increment() {
    //         this.count++
    //     }
    // },

    setup() {
        const count = ref(0);

        const increment = () => {
            count.value++;
        };

        const helloVue = () => {
            alert('Hello Vue!');
        }

        return { count, increment, helloVue };
    },
    props: {
        color: 'green'
    }
});

</script>

<style>
#app {
    background-color: v-bind(color);
}
</style>