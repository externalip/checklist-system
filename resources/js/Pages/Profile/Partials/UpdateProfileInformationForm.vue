<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    user: Object,
    employee: Object,
});

const form = useForm({
    _method: "PUT",
    username: props.user?.username,
    first_name: props.employee?.first_name,
    last_name: props.employee?.last_name,
    gender: props.employee?.gender,
    date_of_birth: props.employee?.date_of_birth,
    contact: props.employee?.contact,
    shift: props.employee?.shift,
});
const updateProfileInformation = () => {
    form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};


</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title> Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="username" value="Username" />
                <TextInput id="username" v-model="form.username" type="text" class="mt-1 block w-full" required
                    autocomplete="username" />
                <InputError :message="form.errors.username" class="mt-2" />
            </div>
            <!-- Employee Form -->
            <div class="col-span-6 sm:col-span-4">
                <!-- First Name Input -->
                <InputLabel for="first_name" value="First Name" />
                <TextInput id="first_name" v-model="form.first_name" type="text" class="mt-1 block w-full" required
                    autocomplete="given-name" />
                <InputError :message="form.errors.first_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Last Name Input -->
                <InputLabel for="last_name" value="Last Name" />
                <TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 block w-full" required
                    autocomplete="family-name" />
                <InputError :message="form.errors.last_name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Gender Input -->
                <InputLabel for="gender" value="Gender" />
                <select id="gender" v-model="form.gender" class="mt-1 block w-full" required autocomplete="sex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <InputError :message="form.errors.gender" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Date of Birth Input -->
                <InputLabel for="date_of_birth" value="Date of Birth" />
                <TextInput id="date_of_birth" v-model="form.date_of_birth" type="date" class="mt-1 block w-full" required />
                <InputError :message="form.errors.date_of_birth" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Contact Input -->
                <InputLabel for="contact" value="Contact" />
                <TextInput id="contact" v-model="form.contact" type="number"
                    class="mt-1 block w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    required autocomplete="tel" />
                <InputError :message="form.errors.contact" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <!-- Shift Input -->
                <InputLabel for="shift" value="Shift" />
                <select id="shift" v-model="form.shift" class="mt-1 block w-full" required>
                    <option value="">None</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                </select>
                <InputError :message="form.errors.shift" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
