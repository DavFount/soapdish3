<script setup>
import {onMounted, ref} from 'vue';
import {Link, router, useForm} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    title: props.user.title,
    description: props.user.description,
    translation_id: props.user.translation_id,
    language_id: props.user.language_id,
    facebook: props.user.facebook,
    twitter: props.user.twitter,
    instagram: props.user.instagram,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo"/>

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Name"/>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2"/>
            </div>

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
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="description"
                />
                <InputError :message="form.errors.description" class="mt-2"/>
            </div>

            <!-- Language -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="language_id" value="Language"/>
                <select id="language_id" v-model="form.language_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                    <option v-for="language in $page.props.lang" :key="language.id" :value="language.id">{{ language.name }}</option>
                </select>
                <InputError :message="form.errors.language_id" class="mt-2"/>
            </div>

            <!-- Translation -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="translation_id" value="Translation"/>
                <select id="translation_id" v-model="form.translation_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm">
                    <option v-for="translation in $page.props.translation" :key="translation.id" :value="translation.id">{{ translation.abbreviation }} - {{ translation.name }}</option>
                </select>
                <InputError :message="form.errors.translation_id" class="mt-2"/>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email"/>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2"/>
            </div>

            <!-- Facebook -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="facebook" value="Facebook"/>
                <TextInput
                    id="facebook"
                    v-model="form.facebook"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="facebook"
                />
                <InputError :message="form.errors.facebook" class="mt-2"/>
            </div>

            <!-- Twitter -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="twitter" value="Twitter"/>
                <TextInput
                    id="twitter"
                    v-model="form.twitter"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="twitter"
                />
                <InputError :message="form.errors.twitter" class="mt-2"/>
            </div>

            <!-- Instagram -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="instagram" value="Instagram"/>
                <TextInput
                    id="instagram"
                    v-model="form.instagram"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="instagram"
                />
                <InputError :message="form.errors.instagram" class="mt-2"/>
            </div>

            <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                <p class="text-sm mt-2 dark:text-white">
                    Your email address is unverified.

                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                        @click.prevent="sendEmailVerification"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    A new verification link has been sent to your email address.
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
