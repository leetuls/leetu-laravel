<template>
    <div>
        This is a Lifecycle Hooks!
    </div>
</template>


<script setup>
import { onMounted } from 'vue'

onMounted(() => {
    setTimeout(function () {
        console.log(`the component is now mounted.`);
    }, 2000);
})
</script>