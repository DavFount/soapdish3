<script setup>

</script>

<template>
    <div>
        <p class="text-2xl text-semibold text-blue-900 dark:text-blue-400">
            <slot name="title" />
        </p>

        <span class="block italic text-md text-gray-900 dark:text-gray-400">
            <slot name="subtitle" />
        </span>

        <p class="text-sm text-gray-900 dark:text-gray-200">
            <slot />
        </p>
    </div>
</template>

<style scoped>

</style>
