<script setup>
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
import { FwbBadge, FwbHeading, FwbP, FwbRadio } from "flowbite-vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const emit = defineEmits(["profileSelected"]);

const open = ref(true);
const profile = ref(null);
const profiles = ref([
    { label: "Candidate Profile", value: "Candidate" },
    { label: "Company Profile", value: "Company" },
]);

function profileSelected() {
    emit("profileSelected", profile.value === 'Candidate');
    open.value = false;
}
</script>

<template>
    <Modal :show="open">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <fwb-heading tag="h4" class="mb-3"
                >Welcome to MyJobs Platform!</fwb-heading
            >

            <fwb-p class="mb-3"
                >Congratulations on creating your new account. We're excited to
                have you join our community. Your journey starts here, and the
                next step is to set up your profile.
            </fwb-p>

            <fwb-p class="mb-3">
                If you are a job seeker choose a
                <fwb-badge class="inline">Candidate Profile</fwb-badge>
                , otherwise a
                <fwb-badge class="inline" type="indigo"
                    >Company Profile</fwb-badge
                >
            </fwb-p>

            <ul
                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <li
                    class="w-full !m-0 pl-3 flex border-gray-200 rounded-t-lg dark:border-gray-600"
                >
                    <fwb-radio
                        v-for="profileOption in profiles"
                        name="radio-horizontal"
                        :label="profileOption.label"
                        :value="profileOption.value"
                        v-model="profile"
                    />
                </li>
            </ul>

            <PrimaryButton
                class="mt-5"
                :class="{ 'cursor-not-allowed opacity-70': !profile }"
                @click="profileSelected"
                :disabled="!profile"
                >Continue</PrimaryButton
            >
        </div>
    </Modal>
</template>
