<script setup>
import {Head, Link} from "@inertiajs/vue3";
import MainSection from "@/Components/MainSection.vue";
import Card from "@/Components/PrayerList/card.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import Pagination from "@/Components/Pagination.vue";
import {ref} from "vue";

defineProps({
    prayerRequests: {
        type: Object,
        required: true
    }
});

const currentItem = ref(null);

const deletePrayer = (id) => {
    currentItem.value = id;
}

</script>

<template>
    <Head title="Prayer Requests"/>
    <MainSection>
        <template #header>
            <div class="flex justify-end">
                <Link
                    class="py-2 px-3 text-sm rounded border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                    :href="route('prayerrequests.create')"
                    v-text="'Add Request'"
                />
            </div>
        </template>

        <div class="grid grid-cols-2 gap-4" v-if="prayerRequests.data.length">
            <Card v-for="prayerRequest in prayerRequests.data" :key="prayerRequest.id"
                  @delete="deletePrayer"
                  :id="prayerRequest.id"
            >
                {{ prayerRequest.body }}

                <template #buttons>
                    <Link v-if="prayerRequest.can.edit"
                          :href="route('prayerrequests.edit', { prayerRequest: prayerRequest })"
                          v-text="'Edit'"
                    />
                    <button v-if="prayerRequest.can.delete" @click="deletePrayer(prayerRequest.id)">Delete</button>
                </template>
            </Card>
        </div>
        <div v-else>
            You currently do not have anything on your Prayer List. Click the add button to create!
        </div>

        <Pagination v-if="prayerRequests.last_page > 1" :links="prayerRequests.links" class="mt-6"/>
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
                    method="delete" as="button" :href="route('prayerrequests.delete', {prayerRequest: currentItem})"
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
