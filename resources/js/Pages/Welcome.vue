<template>
    <Head title="Welcome"/>
    

</template>

<script>
import {Head, Link} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

export default {
    layout: DefaultLayout,
    components: { Head, Link },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    }
}
</script>

<style scoped>
</style>
