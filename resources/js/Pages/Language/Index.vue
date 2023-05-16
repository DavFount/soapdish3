<script setup>
import {Head, Link} from "@inertiajs/vue3";
import MainSection from "@/Components/MainSection.vue";
import TableSection from "@/Components/TableSection.vue";
import TableBodyItem from "@/Components/TableBodyItem.vue";
import TableHeaderItem from "@/Components/TableHeaderItem.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
    'languages': Object,
})

const formatDate = (date)  => {
    return new Date(date).toString();
}

</script>

<template>
<MainSection>
    <Head title="Languages" />

    <TableSection title="Languages">
        <template #button>
            <Link :href="route('languages.create')"
                    class="block rounded-md bg-blue-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
                Add Language
            </Link>
        </template>

        <template #headers>
            <TableHeaderItem>
                Name
            </TableHeaderItem>
            <TableHeaderItem>
                Number of Bibles
            </TableHeaderItem>
            <TableHeaderItem class="sr-only">
                Actions
            </TableHeaderItem>
        </template>

        <tr v-for="language in languages.data" :key="language.id">
            <TableBodyItem>
                {{ language.name }}
            </TableBodyItem>

            <TableBodyItem>
                {{ language.translations.length }}
            </TableBodyItem>

            <TableBodyItem class="flex gap-3 justify-end">
                <Link :href="route('languages.show', {language: language})"
                      v-text="'View'"
                      class="text-blue-500 hover:underline"
                />
                <Link :href="route('languages.edit', {language: language})"
                      v-text="'Edit'"
                      class="text-blue-500 hover:underline"
                />
                <Link :href="route('languages.delete', {language: language})"
                      method="delete"
                      as="button"
                      v-text="'Delete'"
                      class="text-red-500 hover:underline"
                />
            </TableBodyItem>
        </tr>
    </TableSection>
    <Pagination v-if="languages.last_page > 1" :links="languages.links" class="mt-6"/>
</MainSection>
</template>

<style scoped>

</style>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout
}
</script>
