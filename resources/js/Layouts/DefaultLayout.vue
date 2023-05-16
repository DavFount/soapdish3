<script setup>
import NavBar from "@/Components/Nav/NavBar.vue";
</script>

<template>

    <div>
        <div class="min-h-screen bg-center bg-gray-100 dark:bg-gray-900">
            <div class="h-16"></div>
            <NavBar/>

            <slot/>
        </div>
    </div>
</template>

<style scoped>

</style>
