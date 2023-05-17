<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    readOnly: {
        type: Boolean,
        default: false,
    },
    action: {
        type: String,
        default: 'create',
    },
    prayerList: Object
})

const form = useForm({
    _method: props.action === 'create' ? 'POST' : 'PUT',
    name: props.prayerList ? props.prayerList.name : '',
    notes: props.prayerList ? props.prayerList.notes : '',
})

const submit = () => {

    if (props.action === 'create') {
        form.post(route('prayerlist.store'))
    } else {
        form.put(route('prayerlist.update', {prayerList: props.prayerList}))
    }
}
</script>

<template>
    <FormSection @submitted="submit">
        <template #title>
            Prayer List
        </template>

        <template #description>
            Add/Update a Prayer List item so that you always have a reference of who you are praying for!
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Name"/>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                    :readonly="readOnly"
                />
                <InputError :message="form.errors.name" class="mt-2"/>
            </div>

            <!-- Notes -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="notes" value="Notes"/>
                <textarea id="notes" v-model="form.notes"
                          class="mt-1 block w-full h-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm resize-none"
                          :readonly="readOnly"/>

                <InputError :message="form.errors.notes" class="mt-2"/>
            </div>
        </template>

        <template #actions v-if="!readOnly">
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <Link :href="route('prayerlist.index')"
                  class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ action }}
            </PrimaryButton>
        </template>

        <template #actions v-else>
            <Link :href="route('prayerlist.index')"
                  class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <Link
                :href="route('prayerlist.edit', {prayerList: prayerList})"
                class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-700 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                Edit
            </Link>
        </template>
    </FormSection>
</template>

<style scoped>

</style>
