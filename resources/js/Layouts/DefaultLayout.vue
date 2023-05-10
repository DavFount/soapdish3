<script setup>
import NavBar from "@/Components/Nav/NavBar.vue";
import NavBarItem from "@/Components/Nav/NavBarItem.vue";
</script>

<template>
    <div
        class="min-h-screen bg-center bg-gray-100 dark:bg-gray-900">
        <NavBar>

        </NavBar>
        <slot/>
    </div>
</template>

<style scoped>

</style>
