<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import OpenPosition from "@/Components/OpenPosition.vue";
import { FwbPagination } from "flowbite-vue";
import { ref } from "vue";
import CandidateJobActions from "@/Pages/Job/Partials/CandidateJobActions.vue";
import EmployeeJobActions from "@/Pages/Job/Partials/EmployeeJobActions.vue";

const profile = usePage().props.profile.data;

const { jobs, page } = defineProps({
    jobs: {
        type: Object,
        default: {},
    },
});

const paginator = ref({
    currentPage: jobs.current_page ?? page,
    perPage: jobs.per_page,
    totalItems: jobs.total,
});

function reload(page) {
    router.reload({
        data: { page },
        only: ["jobs"],
    });
}

function apply(job) {
    router.post(
        route(
            "job.apply",
            { job: job.id, page: paginator.value.currentPage },
            {
                preserveScroll: true,
            },
        ),
    );
}
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Opportunities
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <OpenPosition :jobs="jobs.data">
                    <template #actions="{ job }">
                        <CandidateJobActions
                            v-if="profile.isCandidate"
                            :job="job"
                            @apply="apply"
                        />
                        <EmployeeJobActions v-else :job="job" />
                    </template>
                </OpenPosition>

                <fwb-pagination
                    v-model="paginator.currentPage"
                    @page-changed="reload"
                    :perPage="paginator.perPage"
                    :total-items="paginator.totalItems"
                ></fwb-pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
