<template>
    <div>
        My name is Hello!
        {{ hello_vue }}
        <Test color="red"></Test>
        <Modifier></Modifier>

        <LifecycleHooks></LifecycleHooks>

        <div>
            <Watch></Watch>
        </div>

        <ModalTest />
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';
import Test from "./Test.vue";
import Modifier from './Modifier.vue';
import LifecycleHooks from './LifecycleHooks.vue';
import Watch from './Watch.vue';
import ModalTest from './ModalTest.vue';

export default defineComponent({
    components: {
        Test,
        Modifier,
        LifecycleHooks,
        Watch,
        ModalTest
    },
    setup() {
        return {
            hello_vue: 'Hello Vue JS.'
        }
    }
});

</script>