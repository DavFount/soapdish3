<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {computed, ref} from "vue";
import {marked} from "marked";

marked.setOptions({
    renderer: new marked.Renderer(),
    gfm: true,
    breaks: true,
    mangle: false,
    headerIds: false,
})

const preview = ref(false);

const form = useForm({
    _method: 'POST',
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const renderMarkdown = computed(() => {
    return marked(form.message);
})
const submit = () => {
    form.post(route('send-contact-form'), {
        errorBag: 'contactForm',
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
}
</script>
<template>
    <Head title="Contact"/>

    <div class="w-full">
        <div class="mt-5 md:mt-0 w-full">
            <form @submit.prevent="submit">
                <fieldset>
                    <legend class="sr-only">Contact Information</legend>
                    <div
                        class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md shadow-2xl"
                    >
                        <div class="w-8/12 mx-auto">
                            <div class="col-span-6 sm:col-span-4 text-left">
                                <InputLabel for="firstName" value="First Name"/>
                                <TextInput
                                    id="firstName"
                                    v-model="form.firstName"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="firstName"
                                />
                                <InputError :message="form.errors.firstName" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-4  text-left">
                                <InputLabel for="lastName" value="Last Name"/>
                                <TextInput
                                    id="lastName"
                                    v-model="form.lastName"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="lastName"
                                />
                                <InputError :message="form.errors.lastName" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-4  text-left">
                                <InputLabel for="email" value="Email"/>
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    autocomplete="email"
                                />
                                <InputError :message="form.errors.email" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-4  text-left">
                                <InputLabel for="phone" value="Phone"/>
                                <TextInput
                                    id="phone"
                                    v-model="form.phone"
                                    type="phone"
                                    class="mt-1 block w-full"
                                    autocomplete="phone"
                                />
                                <InputError :message="form.errors.phone" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-4  text-left">
                                <InputLabel for="subject" value="Subject"/>
                                <TextInput
                                    id="subject"
                                    v-model="form.subject"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="subject"
                                />
                                <InputError :message="form.errors.subject" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <div class="flex justify-between">
                                    <InputLabel for="message" value="Message"/>
                                    <button type="button"
                                            class="flex items-center p-1 border border-gray-100 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-lg"
                                            :class="{
                                                'bg-gray-100 dark:bg-gray-900': preview
                                            }"
                                            @click="preview = ! preview"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="text-sm">Preview</span>
                                    </button>
                                </div>
                                <div v-if="!preview">
                                    <textarea id="message" v-model="form.message"
                                              class="mt-1 block w-full h-36 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                              autocomplete="message">

                                    </textarea>

                                    <InputError :message="form.errors.message" class="mt-2"/>
                                    <div class="flex justify-between">
                                        <span class="text-xs">* Markdown Enabled *</span>
                                    </div>
                                </div>
                                <div class="prose dark:prose-invert text-left" v-html="renderMarkdown" v-else/>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </ActionMessage>

                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Submit
                        </PrimaryButton>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<style scoped>
textarea {
    resize: none;
}
</style>
