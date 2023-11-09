<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { FwbSelect, FwbTextarea } from "flowbite-vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

const profile = usePage().props.profile?.data;

const form = useForm({
    name: profile?.name || "",
    birthdate: profile?.birthdate || "",
    gender: profile?.gender || "",
    course: profile?.course || "",
    biography: profile?.biography || "",
});

function submit() {
    return profile
        ? form.patch(route("candidate.profile.update"), {
              preserveScroll: true,
          })
        : form.post(route("candidate.profile.store"), { preserveScroll: true });
}
</script>

<template>
    <UpdateProfileInformationForm>
        <template #title> Candidate Profile Information </template>

        <template #subtitle>
            Update your candidate's profile information.
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
                <InputLabel for="birthdate" value="Birthdate" />

                <TextInput
                    id="birthdate"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.birthdate"
                    :required="!profile"
                    :class="{ 'bg-gray-50 cursor-not-allowed': !!profile }"
                    :disabled="!!profile"
                />

                <InputError class="mt-2" :message="form.errors.birthdate" />
            </div>

            <div>
                <fwb-select
                    id="gender"
                    v-model="form.gender"
                    :options="[
                        { value: 'male', name: 'Male' },
                        { value: 'female', name: 'Female' },
                    ]"
                    label="Gender"
                    :required="!profile"
                    :class="{ 'bg-gray-50': !!profile }"
                    :disabled="!!profile"
                />

                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div>
                <InputLabel for="course" value="Course" />

                <TextInput
                    id="course"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.course"
                    required
                />

                <InputError class="mt-2" :message="form.errors.course" />
            </div>

            <div>
                <fwb-textarea
                    id="biography"
                    v-model="form.biography"
                    :rows="4"
                    label="Biography"
                    placeholder="Write you message..."
                />

                <InputError class="mt-2" :message="form.errors.biography" />
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
