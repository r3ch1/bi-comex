<template>
    <div>
        <h1>Welcome to Laravel 12 with Vue 3</h1>
    </div>
    <div>
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('App Mounted');
        }
    }
</script>
