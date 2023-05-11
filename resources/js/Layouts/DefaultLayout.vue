<script setup>
import NavBar from "@/Components/Nav/NavBar.vue";
import Banner from "@/Components/Banner.vue";
</script>

<template>

    <div>
        <Banner/>

        <div
            class="min-h-screen bg-center bg-gray-100 dark:bg-gray-900">
            <NavBar/>
            <!--<header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">-->
            <!--<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">-->
            <!--<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">-->
            <!--<slot name="header" />-->
            <!--</h2>-->
            <!--</div>-->
            <!--</header>-->

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
        </div>
    </div>
</template>

<style scoped>

</style>
