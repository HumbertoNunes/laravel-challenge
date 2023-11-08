<script setup>
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {FwbSelect} from "flowbite-vue";
import {ref} from "vue";

const profile = usePage().props.profile?.data;

const form = useForm({
    name: profile?.company_name ?? "",
    size: profile?.company_size ?? "",
});

const message = ref();

function submit() {
    return form.post(route("company.store"), { preserveScroll: true })
}
</script>

<template>
    <UpdateProfileInformationForm>
        <template #title> Company Information </template>
        <template #subtitle>
            Your company's information.
        </template>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="company_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    :required="!profile?.company_name"
                    :class="{ 'bg-gray-50 cursor-not-allowed': !!profile?.company_name }"
                    :disabled="!!profile?.company_name"
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
                    :required="!profile?.company_size"
                    :class="{ 'bg-gray-50 cursor-not-allowed': !!profile?.company_size }"
                    :disabled="!!profile?.company_size"
                />

                <InputError class="mt-2" :message="form.errors.size" />
            </div>

            <div class="flex items-center gap-4">
              <PrimaryButton
                  :class="{ 'cursor-not-allowed opacity-70': !profile }"
                  :disabled="form.processing || !profile"
                  @mouseover="() => {if (!profile) message = 'Save your employee\'s informations first'}"
                  @mouseout="message = ''"
              >
                Save
              </PrimaryButton>

              <InputError class="mt-2" :message="message" />

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

