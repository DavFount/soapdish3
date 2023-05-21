<script setup>
defineProps({

})
</script>

<template>
    <div class="bg-gray-100 dark:bg-gray-900 border border-gray-400 dark:border-gray-700 shadow-xl px-4 py-5 sm:px-6 rounded-md h-44 w-full">
        <div class="flex items-center justify-start">
            <div>
                <div class="flex align-text-top">
                    <!-- Avatar -->
                    <div v-if="$slots.avatar" class="flex-shrink-0">
                        <slot name="avatar" />
                    </div>

                    <!-- Header -->
                    <div :class="{
                                    'ml-4': $slots.avatar
                                }">
                        <h3 v-if="$slots.header" class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-300"><slot name="header" /> </h3>
                        <p v-if="$slots.title()" class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            <slot name="title" />
                        </p>
                        <p v-if="$slots.socials" class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            <slot name="socials" />
                        </p>
                    </div>
                </div>

                <div class="px-6 py-4">
                    <p class="text-gray-700 dark:text-gray-400 text-base">
                        <slot />
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
