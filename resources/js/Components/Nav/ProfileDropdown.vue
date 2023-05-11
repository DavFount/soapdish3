<script setup>
import {computed, onMounted, onUnmounted, ref} from "vue";
import ProfileDropdownItem from "@/Components/Nav/ProfileDropdownItem.vue";

const dropdown = {
    visible: ref(false),
    toggle: () => {
        dropdown.visible.value = !dropdown.visible.value;
    },
    hide: () => {
        dropdown.visible.value = false;
    },
}

const visible = computed(() => {
    return dropdown.visible.value;
})

onMounted(() => {
    document.addEventListener('click', dropdown.hide);
})

onUnmounted(() => {
    document.removeEventListener('click', dropdown.hide);
})
</script>

<template>
    <div class="hidden lg:flex">
        <div class="flex items-center">
            <div class="relative ml-4 flex-shrink-0">
                <div>
                    <button type="button"
                            @click.stop="dropdown.toggle"
                            class="flex rounded-full text-sm text-gray-200 focus:outline-none"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true"
                    >
                        <span class="mr-2">Welcome Back, {{ $page.props.auth.user.name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                </div>
                <Transition>
                    <div
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-gray-100 py-1 shadow-lg ring ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                        tabindex="-1"
                        @click.stop
                        v-if="visible"
                    >
                        <ProfileDropdownItem :href="route('dashboard')" v-text="'Dashboard'" />
                        <ProfileDropdownItem :href="route('profile.show')" v-text="'Profile'" />
                        <ProfileDropdownItem :href="route('logout')" method="post" as="button" v-text="'Sign Out'" @click="dropdown.toggle"/>
                    </div>
                </Transition>
            </div>
        </div>
    </div>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.01s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
