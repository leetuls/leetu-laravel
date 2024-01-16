<template>
    My name is Test!

    <div id="app1">
        <span>{{ testClickStopParent }}</span>
        <div id="app" :color="color">
            <span>{{ testClickStopChilrent }}</span>
            <button @click="increment">
                Count is: {{ count }}
            </button>
            <button @click="helloVue">
                Click Me!
            </button>
            <button @click.stop="onClick">Click me</button>
        </div>
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

        const testClickStopParent = ref('this is a parent component!');

        const testClickStopChilrent = ref('this is a chilrent component!');

        const increment = () => {
            count.value++;
        };

        const helloVue = () => {
            alert('Hello Vue!');
        }

        const onClick = () => {
            testClickStopParent.value = 'changed!';
            testClickStopChilrent.value = 'Chilrent changed!';
            alert('click stop!');
        };

        return { count, increment, helloVue, onClick, testClickStopParent, testClickStopChilrent };
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