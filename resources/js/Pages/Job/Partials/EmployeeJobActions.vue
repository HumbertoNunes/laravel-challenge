<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {FwbBadge} from "flowbite-vue";
import {usePage} from "@inertiajs/vue3";
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
        <PrimaryButton v-if="true" @click="() => $emit('apply', job)">
            Schedule
        </PrimaryButton>

        <small>published {{ useTimeAgo(job.created_at) }}</small>
    </div>
</template>

<style scoped>

</style>
