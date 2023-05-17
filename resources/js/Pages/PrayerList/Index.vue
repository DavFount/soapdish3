<script setup>
import MainSection from "@/Components/MainSection.vue";
import Card from "@/Components/PrayerList/card.vue";
import {Head, Link} from "@inertiajs/vue3";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import {ref} from "vue";

defineProps({
    prayerLists: Object
})

const currentItem = ref(null);

const deletePrayer = (id) => {
    currentItem.value = id;
}

</script>

<template>
    <Head title="Prayer List"/>
    <MainSection>
        <template #header>
            <div class="flex justify-end">
                <Link
                    class="py-2 px-3 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                    :href="route('prayerlist.create')"
                    v-text="'Add Prayer'"
                />
            </div>
        </template>

        <div class="grid grid-cols-2 gap-4">
            <Card @delete="deletePrayer" v-for="prayerList in prayerLists.data" :key="prayerList.id"
                  :prayerList="prayerList.id">
                <template #title>{{ prayerList.name }}</template>

                {{ prayerList.notes }}
            </Card>
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
                    method="delete" as="button" :href="route('prayerlist.delete', {prayerList: currentItem})" v-text="'Delete'"/>
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
