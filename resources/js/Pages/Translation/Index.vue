<script setup>
import {Head, Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import MainSection from "@/Components/MainSection.vue";
import TableSection from "@/Components/TableSection.vue";
import TableHeaderItem from "@/Components/TableHeaderItem.vue";
import TableBodyItem from "@/Components/TableBodyItem.vue";

defineProps({
    translations: Object
})
</script>

<template>
    <div>
        <Head title="Translations" />
        <MainSection>
            <TableSection title="Languages">
                <template #button>
                    <Link :href="route('translations.create')"
                          class="block rounded-md bg-blue-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
                        Add Translation
                    </Link>
                </template>

                <template #headers>
                    <TableHeaderItem>
                        Name
                    </TableHeaderItem>

                    <TableHeaderItem>
                        Abbreviation
                    </TableHeaderItem>

                    <TableHeaderItem>
                        Language
                    </TableHeaderItem>

                    <TableHeaderItem>
                        Books
                    </TableHeaderItem>

                    <TableHeaderItem class="sr-only">
                        Actions
                    </TableHeaderItem>
                </template>

                <tr v-for="translation in translations.data" :key="translation.id">
                    <TableBodyItem>
                        {{ translation.name }}
                    </TableBodyItem>

                    <TableBodyItem>
                        {{ translation.abbreviation }}
                    </TableBodyItem>

                    <TableBodyItem>
                        {{ translation.language.name }}
                    </TableBodyItem>

                    <TableBodyItem>
                        {{ translation.books.length }}
                    </TableBodyItem>

                    <TableBodyItem class="flex gap-3 justify-end">
                        <Link :href="route('translations.edit', {translation: translation})"
                              v-text="'Edit'"
                              class="text-blue-500 hover:underline"
                        />
                        <Link :href="route('translations.delete', {translation: translation})"
                              method="delete"
                              as="button"
                              v-text="'Delete'"
                              class="text-red-500 hover:underline"
                        />
                    </TableBodyItem>
                </tr>
            </TableSection>
            <Pagination v-if="translations.last_page > 1" :links="translations.links" class="mt-6"/>
        </MainSection>
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
