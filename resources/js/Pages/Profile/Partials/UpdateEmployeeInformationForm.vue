<script setup>
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const profile = usePage().props.auth.user.profile;

const form = useForm({
    name: profile?.name ?? "",
    position: profile?.position ?? "",
});

function submit() {
    return profile
        ? form.patch(route("employee.profile.update"), { preserveScroll: true })
        : form.post(route("employee.profile.store"), { preserveScroll: true });
}
</script>

<template>
    <UpdateProfileInformationForm>
        <template #title> Employee Profile Information </template>
        <template #subtitle>
            Update your employee's profile information.
        </template>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    :required="!profile"
                    :class="{ 'bg-gray-50 cursor-not-allowed': !!profile }"
                    :disabled="!!profile"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="position" value="Position" />

                <TextInput
                    id="position"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.position"
                    required
                />

                <InputError class="mt-2" :message="form.errors.position" />
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
