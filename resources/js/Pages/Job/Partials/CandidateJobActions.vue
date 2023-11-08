<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {FwbBadge} from "flowbite-vue";
import {router, usePage} from "@inertiajs/vue3";
import {useTimeAgo} from "@vueuse/core";

defineEmits(['apply']);

const profile = usePage().props.profile.data;

const {job} = defineProps({
    job: {
        type: Object,
    }
})
</script>

<template>
    <div class="flex items-end mt-5 justify-between">
        <fwb-badge v-if="profile?.jobs?.find(item => item.id === job.id)" class="inline" type="default"> Applied
        </fwb-badge>

        <PrimaryButton v-else-if="profile.course === job.requirement" @click="() => $emit('apply', job)">
            Apply
        </PrimaryButton>

        <fwb-badge v-else class="inline" type="red">Incompatible Course</fwb-badge>

        <small>published {{ useTimeAgo(job.created_at) }}</small>
    </div>
</template>

<style scoped>

</style>
