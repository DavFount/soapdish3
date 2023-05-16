<script setup>
import FormSection from "@/Components/FormSection.vue";
import {useForm} from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Link} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref} from "vue";

const props = defineProps({
    readOnly: Boolean,
    action: String,
    translation: Object,
    languages: Object,
})

const form = useForm({
    _method: 'POST',
    name: props.translation ? props.translation.name : '',
    abbreviation: props.translation ? props.translation.abbreviation : '',
    language_id: props.translation ? props.translation.language_id : '',
    file: null,
})

const submit = () => {

    if (props.action === 'create') {
        if(fileInput.value) { // Only allow upload of file on new translation
            form.file = fileInput.value.files[0];
        }

        form.post(route('translations.store'))
    } else {
        form.put(route('translations.update', {translation: props.translation}))
    }
}

const fileInput = ref(null);
const selectNewFile = () => {
    fileInput.value.click();
}

</script>

<template>
    <FormSection @submitted="submit">
        <template #title>
            Translations
        </template>

        <template #description>
            Add/Update a supported translation.
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

            <!-- Abbreviation -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="abbreviation" value="Abbreviation"/>
                <TextInput
                    id="abbreviation"
                    v-model="form.abbreviation"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="abbreviation"
                    :readonly="readOnly"
                />
                <InputError :message="form.errors.abbreviation" class="mt-2"/>
            </div>

            <!-- Language -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="language" value="Language" />
                <select v-model="form.language_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option v-for="language in languages" :value="language.id" :key="language.id">{{ language.name }}</option>
                </select>
                <InputError :message="form.errors.language_id" class="mt-2" />
            </div>

            <!-- JSON File -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="fileInput" value="Bible File" />
                <input ref="fileInput" type="file" class="hidden" />
                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewFile">
                    Upload Bible JSON Config
                </SecondaryButton>
                <InputError :message="form.errors.file" class="mt-2" />
            </div>
        </template>

        <template #actions v-if="!readOnly">
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <Link :href="route('translations.index')"
                class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ action }}
            </PrimaryButton>
        </template>

        <template #actions v-else>
            <Link :href="route('translations.index')"
                  class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mr-3">
                Cancel
            </Link>

            <Link :href="route('translations.edit', {translation: translation})"
                  class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-700 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                Edit
            </Link>
        </template>
    </FormSection>
</template>

<style scoped>

</style>
