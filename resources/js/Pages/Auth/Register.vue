<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    username: "",
    password: "",
    password_confirmation: "",
    first_name: "",
    last_name: "",
    gender: "",
    date_of_birth: "",
    contact: "",
    shift: "",
    role_id: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
            <div
                class="mx-auto pt-3 pb-3 divide-x border-b-2 border-indigo-100"
            >
                <h1 class="font-bold">Account Details</h1>
            </div>
            <div class="pt-3">
                <InputLabel for="username" value="Username" />
                <TextInput
                    id="username"
                    v-model="form.username"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 pb-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <!-- Employee Details -->
            <div
                class="mx-auto pt-3 pb-3 divide-x border-b-2 border-indigo-100"
            >
                <h1 class="font-bold">Employee Details</h1>
            </div>
            <div class="pt-3">
                <InputLabel for="first_name" value="First Name" />
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.first_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="last_name" value="Last Name" />
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.last_name" />
            </div>

            <div class="mt-4">
                <InputLabel for="gender" value="Gender" />
                <select
                    id="gender"
                    v-model="form.gender"
                    class="block w-full mt-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                >
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div class="mt-4">
                <InputLabel for="date_of_birth" value="Date of Birth" />
                <TextInput
                    id="date_of_birth"
                    v-model="form.date_of_birth"
                    type="date"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.date_of_birth" />
            </div>

            <div class="mt-4">
                <InputLabel for="contact" value="Contact" />
                <TextInput
                    id="contact"
                    v-model="form.contact"
                    type="number"
                    class="mt-1 block w-full [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                    required
                />
                <InputError class="mt-2" :message="form.errors.contact" />
            </div>

            <div class="mt-4">
                <InputLabel for="shift" value="Shift" />
                <select
                    id="shift"
                    v-model="form.shift"
                    class="block w-full mt-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                >
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Night">Night</option>
                </select>
                <InputError class="mt-2" :message="form.errors.shift" />
            </div>
            <div class="mt-4">
                <InputLabel for="role_id" value="Role" />
                <select
                    id="role_id"
                    v-model="form.role_id"
                    class="block w-full mt-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                >
                    <option value="">Select Role</option>
                    <option value="1">Admin</option>
                    <!-- Loop through roles and display options -->
                </select>
                <InputError class="mt-2" :message="form.errors.role_id" />
            </div>
            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
