<script setup>
import {onMounted, ref} from "vue";

const isDark = ref(false);

onMounted(() => {
    isDark.value = localStorage.getItem('darkMode') == 'true' ||
        (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
})
const toggle = () => {
const element = document.getElementById('html-root')
    if(isDark.value) {
        isDark.value = false;
        localStorage.darkMode = isDark.value
        element.classList.remove('dark')
    } else {
        isDark.value = true;
        localStorage.darkMode = isDark.value
        element.classList.add('dark')
    }
}
</script>

<template>
    <button class="flex w-full lg:w-auto text-gray-600 dark:text-gray-300" @click="toggle">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-7 h-7 hidden lg:block"
             v-if="!isDark"
        >
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor"
             class="w-7 h-7  hidden lg:block"
             v-else
        >
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
        </svg>

        <span class="block lg:hidden w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-900" v-if="!isDark">Theme: Dark</span>
        <span class="block lg:hidden w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-900" v-else>Theme: Light</span>
        <!-- <span class="ml-3">Dark Mode</span> -->
    </button>
</template>

<style scoped>

</style>
