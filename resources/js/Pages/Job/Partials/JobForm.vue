<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    "title": "",
    "description": "",
    "compensation": "",
    "requirement": "",
});

function submit() {
    return form.post(route("job.store"), { preserveScroll: true })
}
</script>

<template>
<form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                />

                <InputError
                    :message="form.errors.title"
                    class="mt-2"
                />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                />

                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div>
                <InputLabel
                    for="compensation"
                    value="Compensation"
                />

                <TextInput
                    id="compensation"
                    v-model="form.compensation"
                    type="number"
                    class="mt-1 block w-full"
                />

                <InputError
                    :message="form.errors.compensation"
                    class="mt-2"
                />
            </div>

             <div>
                <InputLabel
                    for="requirement"
                    value="Requirement"
                />

                <TextInput
                    id="requirement"
                    v-model="form.requirement"
                    type="text"
                    class="mt-1 block w-full"
                />

                <InputError
                    :message="form.errors.requirement"
                    class="mt-2"
                />
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
</template>

<style scoped>

</style>
