<script setup>
import {FwbBadge, FwbCard} from "flowbite-vue";
import {usePage} from "@inertiajs/vue3";

const profile = usePage().props.profile.data;

const {jobs} = defineProps({
  jobs: {
    type: Object,
    default: {}
  }
})

</script>

<template v-if="jobs">
  <template v-for="job in jobs" :key="job.id">
    <fwb-card class="mb-5">
      <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
          {{ job.title }}
        </h5>
        <fwb-badge class="inline" type="green">$ {{ job.compensation }}</fwb-badge>
        <p class="font-normal text-gray-700 dark:text-gray-400 mt-2">
          {{ job.description }}
        </p>
        <p class="text-sm mt-5">
          You must study:
          <fwb-badge class="inline" type="indigo">{{ job.requirement }}</fwb-badge>
        </p>
        <slot name="actions" :job="job"/>
      </div>
    </fwb-card>
  </template>
</template>
<style scoped>

</style>
