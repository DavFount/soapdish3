<script setup>
import DeleteTeamForm from '@/Pages/Teams/Partials/DeleteTeamForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TeamMemberManager from '@/Pages/Teams/Partials/TeamMemberManager.vue';
import UpdateTeamNameForm from '@/Pages/Teams/Partials/UpdateTeamNameForm.vue';

defineProps({
    team: Object,
    availableRoles: Array,
    permissions: Object,
});
</script>

<template>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <UpdateTeamNameForm :team="team" :permissions="permissions"/>

            <TeamMemberManager
                class="mt-10 sm:mt-0"
                :team="team"
                :available-roles="availableRoles"
                :user-permissions="permissions"
            />

            <template v-if="permissions.canDeleteTeam && ! team.personal_team">
                <SectionBorder/>

                <DeleteTeamForm class="mt-10 sm:mt-0" :team="team"/>
            </template>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

export default {
    layout: DefaultLayout
}
</script>
