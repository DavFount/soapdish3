<template>
    <div class="flex justify-end">
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="(link, index) in links"
            :key="index"
            :href="link.url"
            v-html="link.label"
            class="px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800"
            :class="{
                'text-gray-300 dark:text-gray-700': ! link.url,
                'text-gray-800 dark:text-gray-400 font-bold bg-gray-200 dark:bg-gray-900' : link.active,
                'text-gray-800 dark:text-gray-400 font-bold hover:bg-gray-200 dark:hover:bg-gray-900' : ! link.active && link.url,

            }"
        />
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    props: {
        links: Array
    },
    components: {Link}
};
</script>
