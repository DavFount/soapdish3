<script setup>

import {computed, ref} from "vue";

const props = defineProps({
    selectedVerses: Array,
});

const hide = ref(false);
const highlight = ref('');
const underline = ref('');

</script>

<template>
    <div
        class="absolute py-2 px-3 left-0 right-0 bottom-0 mx-auto menu overflow-hidden bg-white dark:bg-gray-800 border border-gray-600 shadow rounded-t-lg"
        :class="{
            'h-6': hide,
            'h-42': ! hide,
         }"
    >
        <div class="flex justify-center">
            <button @click="hide = !hide">
                <svg v-if="hide" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                </svg>

                <svg v-else xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>

            </button>
        </div>
        <div class="grid grid-cols-1 gap-5 mt-1 text-gray-600 dark:text-gray-300">
            <!-- Highlight Options -->
            <div class="flex justify-between">

                <button @click="highlight = ''" class="bg-white rounded-full p-3"></button>

                <!-- Yellow -->
                <button @click="highlight = 'bg-yellow-100/60 dark:bg-yellow-100/30'" class="bg-yellow-100 rounded-full p-3"></button>
                <button @click="highlight = 'bg-yellow-200/60 dark:bg-yellow-200/30'" class="bg-yellow-200 rounded-full p-3"></button>

                <!-- Orange -->
                <button @click="highlight = 'bg-orange-100/60 dark:bg-orange-100/30'" class="bg-orange-100 rounded-full p-3"></button>
                <button @click="highlight = 'bg-orange-200/60 dark:bg-orange-200/30'" class="bg-orange-200 rounded-full p-3"></button>

                <!-- Blue -->
                <button @click="highlight = 'bg-blue-100/60 dark:bg-blue-100/30'" class="bg-blue-100 rounded-full p-3"></button>
                <button @click="highlight = 'bg-blue-200/60 dark:bg-blue-200/30'" class="bg-blue-200 rounded-full p-3"></button>

                <!-- Blue -->
                <button @click="highlight = 'bg-green-100/60 dark:bg-green-100/30'" class="bg-green-100 rounded-full p-3"></button>
                <button @click="highlight = 'bg-green-100/60 dark:bg-green-200/30'" class="bg-green-200 rounded-full p-3"></button>

                <!-- Red -->
                <button @click="highlight = 'bg-green-200/60 dark:bg-red-100/30'" class="bg-red-100 rounded-full p-3"></button>
                <button @click="highlight = 'bg-red-100/60 dark:bg-red-200/30'" class="bg-red-200 rounded-full p-3"></button>
            </div>
            <!-- Underline Options -->
            <div class="flex justify-between">
                <button @click="underline = ''" class="">None</button>
                <button @click="underline = 'underline decoration-solid'" class="underline decoration-solid">Solid</button>
                <button @click="underline = 'underline decoration-double'" class="underline decoration-double">Double</button>
                <button @click="underline = 'underline decoration-dashed'" class="underline decoration-dashed">Dashed</button>
                <button @click="underline = 'underline decoration-wavy'" class="underline decoration-wavy">Wavy</button>
            </div>
            <!-- Save -->
            <div class="flex justify-between">
                <span
                    :class="highlight + ' ' + underline"
                >
                    Sample Text
                </span>
                <div class="flex justify-end gap-4">
                    <button @click="$emit('cancelSaveVerse')" class="border border-gray-600 py-0.5 px-1">Cancel</button>
                    <button @click="$emit('saveVerses', {styleHighlight: highlight, styleUnderline: underline})" class="border border-gray-600 py-0.5 px-1">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.menu {
    width: 25rem;
}

</style>
