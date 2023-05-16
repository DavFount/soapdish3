<script setup>
import NavBar from "@/Components/Nav/NavBar.vue";
import {ref} from "vue";
import MobileSidebar from "@/Components/Nav/Admin/MobileSidebar.vue";
import Sidebar from "@/Components/Nav/Admin/Sidebar.vue";

const show = ref(true);


</script>

<template>
    <div>
        <NavBar class="z-50"/>


        <Sidebar/>


        <MobileSidebar/>

        <main class="py-10 lg:pl-72 mt-10 min-h-screen bg-white dark:bg-gray-900">
            <div class="px-4 sm:px-6 lg:px-8">
                <slot/>
            </div>
        </main>
    </div>
</template>

<style scoped>

</style>
