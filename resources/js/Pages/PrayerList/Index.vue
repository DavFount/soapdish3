<script setup>
import MainSection from "@/Components/MainSection.vue";
import Card from "@/Components/PrayerList/card.vue";
import {Head, Link, router} from "@inertiajs/vue3";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import {ref, watch} from "vue";
import debounce from "lodash/debounce.js";

defineProps({
    prayerLists: Object
})

const currentItem = ref(null);
const search = ref('');

const deletePrayer = (id) => {
    console.log(currentItem.value);
    currentItem.value = id;
    console.log(currentItem.value);
}

watch(search, debounce(function (value) {
    router.get(route('prayerlist.index'), {search: value}, {preserveState: true, replace: true});
}, 300));
</script>

<template>
    <Head title="Prayer List"/>
    <MainSection>
        <template #header>
            <div class="flex justify-between">
                <input v-model="search"
                       type="text"
                       placeholder="Search..."
                       class="mt-1 block border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm"
                />
                <Link
                    class="py-2 px-3 h-10 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                    :href="route('prayerlist.create')"
                    v-text="'Add Prayer'"
                />
            </div>
        </template>

        <div class="grid grid-cols-2 gap-4" v-if="prayerLists.data.length">
            <Card v-for="prayerList in prayerLists.data" :key="prayerList.id"
                  @delete="deletePrayer"
                  :id="prayerList.id"
                  :editRoute="route('prayerlist.edit', {prayerList: prayerList.id})"
            >
                <template #title>{{ prayerList.name }}</template>

                {{ prayerList.notes }}

                <template #buttons>
                    <Link :href="route('prayerlist.edit', { prayerList: prayerList })"
                          v-text="'Edit'"
                    />
                    <button @click="deletePrayer(prayerList.id)">Delete</button>
                </template>
            </Card>
        </div>
        <div v-else>
            You currently do not have anything on your Prayer List. Click the add button to create!
        </div>
    </MainSection>

    <ConfirmationModal :show="currentItem">
        <template #title>Delete Prayer List Item?</template>

        <template #content>Are you sure you want to delete this prayer request? This action cannot be undone!</template>

        <template #footer>
            <div class="flex gap-4">
                <button
                    class="py-2 px-3 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700"
                    @click="currentItem = null">Cancel
                </button>
                <Link
                    @click="currentItem = null"
                    class="py-2 px-3 text-sm rounded text-gray-100 bg-red-700 hover:bg-red-600"
                    method="delete" as="button" :href="route('prayerlist.delete', {prayerList: currentItem})"
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
    layout: AdminLayout
}
</script>
