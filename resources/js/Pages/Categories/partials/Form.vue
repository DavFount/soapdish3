<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    action: {
        type: String,
        default: 'create',
    },
    category: Object,
});

const form = useForm({
    _method: props.action === 'create' ? 'POST' : 'PUT',
    title: props.category ? props.category.title : '',
    description: props.category ? props.category.description : '',
});

const submit = () => {
    if (props.action === 'create') {
        form.post(route('categories.store'));
    } else {
        form.put(route('categories.update', {category: props.category}))
    }
}
</script>

<template>
    <FormSection @submitted="submit">
        <template #title>
            Category
        </template>

        <template #description>
            Add/Update a category!
        </template>

        <template #form>
            <!-- Title -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="title" value="Title"/>
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="title"
                />
                <InputError :message="form.errors.title" class="mt-2"/>
            </div>

            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description" value="Description"/>
                <textarea id="description" v-model="form.description"
                          class="mt-1 block w-full h-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm resize-none"
                />

                <InputError :message="form.errors.description" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <Link :href="route('categories.index')"
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
