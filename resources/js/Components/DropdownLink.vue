<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    active: Boolean,
});
</script>

<template>
    <Link class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 transition duration-150 ease-in-out"
          :class="{
            'bg-gray-100 dark:bg-gray-800': active,
            'hover:bg-gray-100 dark:hover:bg-gray-800': ! active,
          }"
    >
        <slot/>
    </Link>
</template>
