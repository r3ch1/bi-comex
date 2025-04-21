<template>
    <div class="flex h-screen overflow-hidden">
        <app-sidemenu/>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <app-header/>
            <main>
                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        <router-view/>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Home Mounted');
        }
    }
</script>
