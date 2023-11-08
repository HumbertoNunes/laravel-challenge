<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import OpenPosition from "@/Components/OpenPosition.vue";
import {FwbPagination} from "flowbite-vue";
import {ref} from "vue";

const {jobs} = defineProps({
  jobs: {
    type: Object,
    default: {}
  }
})

const paginator = ref({
  currentPage: jobs.current_page,
  perPage: jobs.per_page,
  totalItems: jobs.total
})

function reload(page) {
  router.reload({
        data: { page },
        only: ['jobs'],
  });
}
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <OpenPosition :jobs="jobs.data"/>

              <fwb-pagination v-model="paginator.currentPage" @page-changed="reload" :perPage="paginator.perPage" :total-items="paginator.totalItems"></fwb-pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
