<template>
    <!-- when used click.stop -->
    <span>when used click.stop</span>
    <div id="app2">
        <ul @click="handleListClick">
            <li v-for="(item, index) in items1" :key="index">
                {{ item }}
                <button @click.stop="handleButtonClick(index)">Click me</button>
            </li>
        </ul>
    </div>

    <!-- when unused click.stop -->
    <span>when unused click.stop</span>
    <div id="app3">
        <ul @click="handleListClick">
            <li v-for="(item, index) in items2" :key="index">
                {{ item }}
                <button @click="handleButtonClick(index)">Click me</button>
            </li>
        </ul>
    </div>

    <!-- when used click.prevent -->
    <span>when used click.prevent</span>
    <div id="app4">
        <form @submit.prevent="submitForm">
            <label for="username">Username:</label>
            <input type="text" id="username" v-model="username" />

            <label for="password">Password:</label>
            <input type="password" id="password" v-model="password" />

            <button type="submit">Submit</button>
        </form>

        <p v-if="formSubmitted">Form submitted successfully!</p>
    </div>

    <!-- when unused click.prevent -->
    <span>when unused click.prevent</span>
    <div id="app5">
        <form @submit="submitForm">
            <label for="username">Username:</label>
            <input type="text" id="username2" v-model="username" />

            <label for="password">Password:</label>
            <input type="password" id="password2" v-model="password" />

            <button type="submit">Submit</button>
        </form>

        <p v-if="formSubmitted">Form submitted successfully!</p>
    </div>
    <!-- Key Modifiers -->
    <br>
    <div id="app6">
        <!-- only call `submit` when the `key` is `Enter` -->
        <input @keyup.enter="hello" />

        <!-- Event Modifiers -->
        <a @click.stop.prevent="doThat">asdsd</a>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue';

export default defineComponent({
    setup() {
        const formSubmitted = ref(false);
        return {
            username: '',
            password: '',
            formSubmitted,
            items1: ['Item 1', 'Item 2', 'Item 3'],
            items2: ['Item 3', 'Item 4', 'Item 5']
        }
    },
    methods: {
        handleListClick() {
            console.log('List Clicked');
        },
        handleButtonClick(index) {
            console.log(`Button Clicked for item at index ${index}`);
        },
        submitForm() {
            // Xử lý logic khi biểu mẫu được gửi
            console.log('Form submitted');
            // Ở đây bạn có thể thêm logic xử lý form hoặc gửi dữ liệu đến server
            this.formSubmitted = true;
        },
        hello() {
            alert('Enter hello!');
        },
        doThat() {
            alert('do that');
        }
    }
});
</script>