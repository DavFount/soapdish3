<script setup>

</script>

<template>
    <main>
        <div class="py-12">
            <div v-if="$slots.header" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <slot name="header" />
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-4 text-black dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                    <slot/>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>

</style>
