<script setup>
import {Link} from "@inertiajs/vue3";
defineProps({
    active: Boolean
})
</script>

<template>
    <Link class="text-gray-600 hover:text-gray-700 hover:bg-gray-300 dark:text-gray-300 dark:hover:text-gray-200 dark:hover:bg-gray-900 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
          :class="{
            'bg-gray-300 text-gray-700 dark:bg-gray-900 dark:text-gray-200': active,
          }"
    >
        <slot />
    </Link>
</template>

<style scoped>

</style>
