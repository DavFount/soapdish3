<script setup>
import {Head} from "@inertiajs/vue3";
import Form from "@/Pages/Translation/partials/Form.vue";
defineProps({
    languages: Object,
})
</script>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px- py-12">
        <Head title="Translations" />
        <div
            class="p-4 text-black dark:text-gray-200 overflow-hidden sm:rounded-lg">
            <Form action="create" :languages="languages" />
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
