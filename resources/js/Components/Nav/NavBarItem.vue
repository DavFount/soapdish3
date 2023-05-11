<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    active: Boolean
})
</script>

<template>
    <Link :active="active"
          class="rounded-md px-3 py-2 text-sm font-medium"
          :class="{
            'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white': !active,
            'bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white': active
          }"
    >
        <slot/>
    </Link>
</template>

<style scoped>

</style>
