<script setup>
import { ref } from "vue";
import {Head, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import WelcomeMessage from "@/Pages/Profile/Partials/WelcomeMessage.vue";
import UserInformation from "@/Pages/Profile/Partials/UserInformation.vue";
import UpdateCandidateInformationForm from "@/Pages/Profile/Partials/UpdateCandidateInformationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import UpdateEmployeeInformationForm from "@/Pages/Profile/Partials/UpdateEmployeeInformationForm.vue";
import UpdateCompanyInformationForm from "@/Pages/Profile/Partials/UpdateCompanyInformationForm.vue";

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    profileIncomplete: {
        type: Boolean,
        default: false,
    },
});

const user = usePage().props.auth.user;
const showForm = ref(false);
const isCandidate = ref(user.profile_type?.endsWith('Candidate'));
function showProfileForm(isCandidateProfile) {
    showForm.value = true;
    isCandidate.value = isCandidateProfile || user.profile_type?.endsWith('Candidate');
}
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Profile
            </h2>
        </template>

        <template v-if="profileIncomplete">
            <WelcomeMessage @profileSelected="showProfileForm" />

          <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
              <div v-if="showForm && isCandidate" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <UpdateCandidateInformationForm />
              </div>

              <template v-else-if="showForm && !isCandidate">
                <div v-if="showForm" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                  <UpdateCompanyInformationForm />
                </div>

                <div v-if="showForm" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                  <UpdateEmployeeInformationForm />
                </div>
              </template>
            </div>
          </div>
        </template>

        <div class="py-12" v-else-if="!profileIncomplete && isCandidate">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                >
                    <UserInformation
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdateCandidateInformationForm/>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
