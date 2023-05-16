<script setup>
import FormSection from "@/Components/FormSection.vue";
import {useForm} from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    readOnly: Boolean,
    action: String,
    language: Object,
})

const form = useForm({
    _method: 'POST',
    name: props.language ? props.language.name : '',
})

const submit = () => {
    if (props.action === 'create') {
        form.post(route('languages.store'))
    } else {
        form.put(route('languages.update', {language: props.language}))
    }
}

</script>

<template>
    <FormSection @submitted="submit">
        <template #title>
            Language
        </template>

        <template #description>
            Add/Update a supported language.
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
        </template>

        <template #actions v-if="!readOnly">
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <Link :href="route('languages.index')"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ action }}
            </PrimaryButton>
        </template>

        <template #actions v-else>
            <Link :href="route('languages.index')"
                  class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <Link :href="route('languages.edit', {language: language})"
                  class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-700 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                Edit
            </Link>
        </template>
    </FormSection>
</template>

<style scoped>

</style>
