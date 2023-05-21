<script setup>
import {Head, Link} from "@inertiajs/vue3";
import TableSection from "@/Components/TableSection.vue";
import TableHeaderItem from "@/Components/TableHeaderItem.vue";
import TableBodyItem from "@/Components/TableBodyItem.vue";
import Pagination from "@/Components/Pagination.vue";
import MainSection from "@/Components/MainSection.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import {ref} from "vue";

defineProps({
    'categories': Object,
    'can': Object,
});

const currentItem = ref(null);

</script>

<template>
    <MainSection>
        <Head title="Categories"/>
        <TableSection title="Categories">
            <template #button>
                <Link v-if="can.create"
                      :href="route('categories.create')"
                      class="block rounded-md bg-blue-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
                    Add Category
                </Link>
            </template>

            <template #headers>
                <TableHeaderItem>
                    Title
                </TableHeaderItem>
                <TableHeaderItem>
                    Description
                </TableHeaderItem>
                <TableHeaderItem class="sr-only">
                    Actions
                </TableHeaderItem>
            </template>

            <tr v-for="category in categories.data" :key="category.id">
                <TableBodyItem>
                    {{ category.title }}
                </TableBodyItem>

                <TableBodyItem>
                    {{ category.description }}
                </TableBodyItem>

                <TableBodyItem class="flex gap-3 justify-end">
                    <Link :href="route('categories.show', {category: category})"
                          v-text="'View'"
                          class="text-blue-500 hover:underline"
                    />
                    <Link v-if="can.edit"
                          :href="route('categories.edit', {category: category})"
                          v-text="'Edit'"
                          class="text-blue-500 hover:underline"
                    />
                    <button v-if="can.delete"
                        @click.prevent="currentItem = category.id"
                        class="text-red-500 hover:underline">
                        Delete
                    </button>
                </TableBodyItem>
            </tr>
        </TableSection>
        <Pagination v-if="categories.last_page > 1" :links="categories.links" class="mt-6"/>
    </MainSection>

    <ConfirmationModal :show="currentItem">
        <template #title>Delete Category?</template>

        <template #content>Are you sure you want to delete this category? This action cannot be undone!</template>

        <template #footer>
            <div class="flex gap-4">
                <button
                    class="py-2 px-3 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
                    @click="currentItem = null">Cancel
                </button>
                <Link
                    @click="currentItem = null"
                    class="py-2 px-3 text-sm rounded text-gray-100 bg-red-700 hover:bg-red-600"
                    method="delete" as="button" :href="route('categories.delete', {category: currentItem})"
                    v-text="'Delete'"/>
            </div>
        </template>
    </ConfirmationModal>
</template>

<style scoped>

</style>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
}
</script>
