<script setup>
import {Head} from "@inertiajs/vue3";
import Form from "@/Pages/Categories/partials/form.vue";
</script>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px- py-12">
        <Head title="Categories"/>
        <div
            class="p-4 text-black dark:text-gray-200 overflow-hidden sm:rounded-lg">
            <Form/>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
}
</script>
