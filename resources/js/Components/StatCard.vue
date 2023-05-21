<script setup>

</script>

<template>
    <div class="min-w-0 rounded-lg shadow-xs overflow-hidden bg-gray-100 dark:bg-gray-800">
        <div class="p-4 flex items-center">
            <div
                class="p-3 rounded-full text-gray-600 dark:text-gray-300 bg-gray-300 dark:bg-gray-900 mr-4">
                <slot name="icon"/>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    <slot name="title"/>
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    <slot/>
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
