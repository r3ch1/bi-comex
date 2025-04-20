<template>
    <app-header></app-header>

    <div class="grid grid-cols-[200px_auto]">
        <div class="200"><app-sidemenu/></div>
        <div class="200 p-5 border-t border-gray-100"><router-view/></div>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Home Mounted');
        }
    }
</script>
