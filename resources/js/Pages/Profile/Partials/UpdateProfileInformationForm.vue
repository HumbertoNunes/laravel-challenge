<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { FwbSelect, FwbTextarea } from "flowbite-vue";

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
});

const profile = usePage().props.profile;

const form = useForm({
    name: profile?.name || "",
    birthdate: profile?.birthdate || "",
    gender: profile?.gender || "",
    course: profile?.course || "",
    biography: profile?.biography || "",
});

function submit() {
    return props.profile
        ? form.patch(route("profile.update"), { preserveScroll: true })
        : form.post(route("profile.store"), { preserveScroll: true });
}
</script>

<template>
    <section class="max-w-xl">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                <slot name="title"></slot>
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                <slot name="subtitle"></slot>
            </p>
        </header>

        <slot />
    </section>
</template>
