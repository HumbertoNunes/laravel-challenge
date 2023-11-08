<script setup>
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {FwbSelect} from "flowbite-vue";

const profile = usePage().props.profile;

const form = useForm({
    name: profile?.company?.name ?? "",
    size: profile?.company?.size ?? "",
});

function submit() {
    return profile
        ? form.patch(route("company.profile.update"), { preserveScroll: true })
        : form.post(route("company.profile.store"), { preserveScroll: true });
}
</script>

<template>
    <UpdateProfileInformationForm :must-verify-email="false" :profile="{}">
        <template #title> Company Information </template>
        <template #subtitle>
            Your company's information.
        </template>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <fwb-select
                    id="size"
                    v-model="form.size"
                    :options="[
                        { value: 'small', name: 'Small' },
                        { value: 'big', name: 'Big' },
                    ]"
                    label="Size"
                    required
                />

                <InputError class="mt-2" :message="form.errors.size" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </UpdateProfileInformationForm>
</template>

