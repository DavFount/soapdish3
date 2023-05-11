<script setup>
import {Link} from "@inertiajs/vue3";
import NavBarItem from "@/Components/Nav/NavBarItem.vue";
</script>

<template>
    <div class="hidden lg:ml-4 lg:block">
        <div class="flex items-center">
            <div class="relative ml-4 flex-shrink-0">
                <div>
                    <NavBarItem :href="route('login')" v-text="'Login'" />
                    <NavBarItem :href="route('register')" v-text="'Register'" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
