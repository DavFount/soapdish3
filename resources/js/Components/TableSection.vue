<script setup>
defineProps({
    'title': String,
    'description': String,
})
</script>

<template>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-white" v-if="title">{{ title }}</h1>
            <p class="mt-2 text-sm text-gray-300" v-if="description">{{ description }}</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none" v-if="$slots.button">
            <slot name="button" />
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="table-auto min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                    <thead>
                    <tr>
                        <slot name="headers" />
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                    <slot />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
