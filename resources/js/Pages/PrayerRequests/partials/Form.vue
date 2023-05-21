<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    action: {
        type: String,
        default: 'create',
    },
    prayerRequest: Object,
});

const form = useForm({
    _method: props.action === 'create' ? 'POST' : 'PUT',
    body: props.prayerRequest ? props.prayerRequest.body : '',
});

const submit = () => {
    if (props.action === 'create') {
        form.post(route('prayerrequests.store'));
    } else {
        form.put(route('prayerrequests.update', {prayerRequest: props.prayerRequest}))
    }
}
</script>

<template>
    <FormSection @submitted="submit">
        <template #title>
            Prayer Request
        </template>

        <template #description>
            Create/Update a Prayer Request.
        </template>

        <template #form>
            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="body" value="Body"/>
                <textarea id="body" v-model="form.body"
                          class="mt-1 block w-full h-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm resize-none"
                />

                <InputError :message="form.errors.body" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <Link :href="route('prayerrequests.index')"
                  class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ action }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<style scoped>

</style>
