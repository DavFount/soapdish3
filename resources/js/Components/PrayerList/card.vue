<script setup>
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";

defineProps({
    id: Number,
    can: Object,
})

const isExpanded = ref(false);

const expand = () => {
    isExpanded.value = true;
}

const collapse = () => {
    isExpanded.value = false;
}
</script>

<template>
    <div
        class="bg-gray-100 dark:bg-gray-900 border border-gray-400 dark:border-gray-700 shadow-xl px-4 py-5 sm:px-6 rounded-md w-full">
        <div v-if="$slots.title" class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-300">
            <slot name="title" />
        </div>
        <div class="px-6 py-4" :class="{ truncate: ! isExpanded }">
            <p class="text-gray-700 dark:text-gray-400 text-base">
                <slot />
            </p>
        </div>
        <div class="flex justify-end gap-4">
            <slot name="buttons" />
            <button class="" v-if="!isExpanded" @click="expand">Expand</button>
            <button class="" v-if="isExpanded" @click="collapse">Collapse</button>
        </div>
    </div>
</template>

<style scoped>

</style>
