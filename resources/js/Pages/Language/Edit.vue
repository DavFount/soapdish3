<script setup>
import {Head} from "@inertiajs/vue3";
import Form from "@/Pages/Language/partials/Form.vue";

defineProps({
    language: Object
})
</script>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px- py-12">
        <Head title="Languages" />
        <div
            class="p-4 text-black dark:text-gray-200 overflow-hidden sm:rounded-lg">
            <Form action="Save" :language="language"/>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout
}
</script>
