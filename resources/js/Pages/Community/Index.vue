<script setup>
import {computed, ref, watch} from "vue";
import {Head, router} from "@inertiajs/vue3";
import Card from "@/Components/Community/Card.vue";
import Pagination from "@/Components/Pagination.vue";
import MainSection from "@/Components/MainSection.vue";
import debounce from "lodash/debounce";

const props = defineProps({
    users: Object,
    filters: Array
});

const search = ref(props.filters.search);

watch(search, debounce(function (value) {
    router.get(route('community.index'), { search: value }, { preserveState: true, replace: true });
}, 300));

const memberCount = computed(() => {
   return Object.keys(props.users).length;
});

const userRole = (role) => {
    if(role) return role.charAt(0).toUpperCase() + role.slice(1);

    return 'Owner';
}
</script>

<template>
    <div>
        <Head title="Community"/>

        <MainSection>

            <template #header>
                <input v-model="search"
                       type="text"
                       placeholder="Search..."
                       class="mt-1 block border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm" />
            </template>

            <div class="grid grid-cols-3 gap-4" v-if="memberCount">
                <div v-for="user in users" :key="user.id">
                    <Card>
                        <template #avatar>
                            <img class="h-16 w-16 rounded-full object-cover border border-gray-400 dark:border-gray-600" :src="user.profile_photo_url"
                                 :alt="user.name">
                        </template>

                        <template #header>
                            {{ user.name }}
                            <span class="text-xs text-gray-400 dark:text-gray-600 ml-1">{{ userRole(user.membership ? user.membership.role : null) }}</span>
                        </template>

                        <template #title>
                            {{ user.title }}
                        </template>

                        <template #socials
                                  v-if="user.facebook || user.twitter || user.instagram">
                            <div class="flex justify-start gap-x-4">
                                <div v-if="user.facebook">
                                    <a :href="'https://www.facebook.com/' + user.facebook" target="_blank">
                                        <svg fill="#6b7280" viewBox="0 0 1920 1920"
                                             class="w-6 h-6"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m1416.013 791.915-30.91 225.617h-371.252v789.66H788.234v-789.66H449.808V791.915h338.426V585.137c0-286.871 176.207-472.329 449.09-472.329 116.87 0 189.744 6.205 231.822 11.845l-3.272 213.66-173.5.338c-4.737-.451-117.771-9.25-199.332 65.655-52.568 48.169-79.191 117.433-79.191 205.65v181.96h402.162Zm-247.276-304.018c44.446-41.401 113.71-36.889 118.787-36.663l289.467-.113 6.204-417.504-43.544-10.717C1511.675 16.02 1426.053 0 1237.324 0 901.268 0 675.425 235.206 675.425 585.137v93.97H337v451.234h338.425V1920h451.234v-789.66h356.7l61.932-451.233H1126.66v-69.152c0-54.937 14.214-96 42.078-122.058Z"
                                                fill-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                                <div v-if="user.twitter">
                                    <a :href="'https://twitter.com/' + user.twitter" target="_blank">
                                        <svg fill="#6b7280" xmlns="http://www.w3.org/2000/svg"
                                             preserveAspectRatio="xMidYMid"
                                             class="w-6 h-6"
                                             width="31.812" height="26"
                                             viewBox="0 0 31.812 26">
                                            <path
                                                d="M20.877,2.000 C22.519,2.000 24.382,2.652 25.426,3.738 C26.724,3.486 27.949,3.025 29.050,2.386 C28.625,3.687 27.718,4.779 26.540,5.469 C27.693,5.332 28.797,5.035 29.820,4.590 C29.054,5.707 28.087,6.690 26.971,7.477 C26.981,7.715 26.987,7.955 26.987,8.195 C26.987,15.562 21.445,24.000 10.939,24.000 C7.715,24.000 4.507,23.133 1.982,21.551 C2.428,21.605 2.883,21.631 3.343,21.631 C6.019,21.631 8.482,20.740 10.439,19.242 C7.937,19.199 5.827,17.586 5.103,15.373 C5.450,15.437 5.810,15.473 6.178,15.473 C6.696,15.473 7.203,15.406 7.681,15.277 C5.068,14.768 3.100,12.514 3.100,9.813 C3.100,9.787 3.100,9.764 3.100,9.740 C3.871,10.158 4.750,10.410 5.687,10.440 C4.154,9.437 3.147,7.734 3.147,5.799 C3.147,4.777 3.428,3.818 3.919,2.998 C6.735,6.367 10.945,8.588 15.693,8.822 C15.594,8.414 15.543,7.984 15.543,7.553 C15.543,4.473 17.721,2.000 20.877,2.000 M29.820,4.590 L29.825,4.590 M20.877,-0.000 C17.033,-0.000 14.060,2.753 13.614,6.552 C10.425,5.905 7.524,4.204 5.440,1.711 C5.061,1.257 4.503,0.998 3.919,0.998 C3.867,0.998 3.815,1.000 3.763,1.004 C3.123,1.055 2.547,1.413 2.216,1.966 C1.525,3.122 1.159,4.447 1.159,5.799 C1.159,6.700 1.321,7.579 1.625,8.400 C1.300,8.762 1.113,9.238 1.113,9.740 L1.113,9.813 C1.113,11.772 1.882,13.589 3.160,14.952 C3.087,15.294 3.103,15.655 3.215,15.998 C3.657,17.348 4.459,18.510 5.499,19.396 C4.800,19.552 4.079,19.631 3.343,19.631 C2.954,19.631 2.577,19.609 2.222,19.565 C2.141,19.556 2.061,19.551 1.981,19.551 C1.148,19.551 0.391,20.078 0.108,20.886 C-0.202,21.770 0.140,22.753 0.932,23.249 C3.764,25.023 7.318,26.000 10.939,26.000 C17.778,26.000 22.025,22.843 24.383,20.195 C27.243,16.984 28.907,12.718 28.972,8.455 C29.899,7.682 30.717,6.790 31.410,5.792 C31.661,5.458 31.810,5.041 31.810,4.590 C31.810,3.909 31.473,3.308 30.958,2.946 C31.181,2.176 30.925,1.342 30.303,0.833 C29.940,0.537 29.496,0.386 29.049,0.386 C28.708,0.386 28.365,0.474 28.056,0.654 C27.391,1.040 26.680,1.344 25.931,1.562 C24.555,0.592 22.688,-0.000 20.877,-0.000 L20.877,-0.000 Z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div v-if="user.instagram">
                                    <a :href="'https://www.instagram.com/' + user.instagram" target="_blank">
                                        <svg viewBox="0 0 192 192"
                                             class="w-6 h-6"
                                             xmlns="http://www.w3.org/2000/svg" fill="none">
                                            <path stroke="#6b7280" stroke-width="12"
                                                  d="M96 162c-14.152 0-24.336-.007-32.276-.777-7.849-.761-12.87-2.223-16.877-4.741a36 36 0 0 1-11.33-11.329c-2.517-4.007-3.98-9.028-4.74-16.877C30.007 120.336 30 110.152 30 96c0-14.152.007-24.336.777-32.276.76-7.849 2.223-12.87 4.74-16.877a36 36 0 0 1 11.33-11.33c4.007-2.517 9.028-3.98 16.877-4.74C71.663 30.007 81.847 30 96 30c14.152 0 24.336.007 32.276.777 7.849.76 12.87 2.223 16.877 4.74a36 36 0 0 1 11.329 11.33c2.518 4.007 3.98 9.028 4.741 16.877.77 7.94.777 18.124.777 32.276 0 14.152-.007 24.336-.777 32.276-.761 7.849-2.223 12.87-4.741 16.877a36 36 0 0 1-11.329 11.329c-4.007 2.518-9.028 3.98-16.877 4.741-7.94.77-18.124.777-32.276.777Z"/>
                                            <circle cx="96" cy="96" r="30" stroke="#6b7280" stroke-width="12"/>
                                            <circle cx="135" cy="57" r="9" fill="#6b7280"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </template>
                        {{ user.description }}
                    </Card>
                </div>
            </div>
            <div v-else>
                There are currently no members on this team.
            </div>
<!--            <Pagination v-if="users.last_page > 1" :links="users.links" class="mt-6"/>-->
        </MainSection>
    </div>
</template>

<style scoped>

</style>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    layout: AdminLayout,
}
</script>
