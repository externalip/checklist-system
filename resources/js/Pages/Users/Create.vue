<template>
    <AppLayout title="Add User">
        <form @submit.prevent="createAccount">
            <div class="flex items-center justify-center h-screen">
                <div class="max-w-3xl mx-auto p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Account Details -->
                        <div class="col-span-2 md:col-span-1">
                            <h3 class="text-lg font-semibold mb-2">Account Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="username" class="block mb-1">Username</label>
                                    <input v-model="form.username" type="text" id="username"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.username" />
                                </div>
                                <div>
                                    <label for="password" class="block mb-1">Password</label>
                                    <input v-model="form.password" type="password" id="password"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block mb-1">Confirm Password</label>
                                    <input v-model="form.password_confirmation" type="password" id="password_confirmation"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>
                            </div>
                        </div>

                        <!-- Employee Details -->
                        <div class="col-span-2 md:col-span-1">
                            <h3 class="text-lg font-semibold mb-2">Employee Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="first_name" class="block mb-1">First Name</label>
                                    <input v-model="form.first_name" type="text" id="first_name"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.first_name" />
                                </div>
                                <div>
                                    <label for="last_name" class="block mb-1">Last Name</label>
                                    <input v-model="form.last_name" type="text" id="last_name"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.last_name" />
                                </div>
                                <div>
                                    <label for="gender" class="block mb-1">Gender</label>
                                    <select v-model="form.gender" type="text" id="gender" class="w-full rounded-lg p-2">
                                        <option value="" disabled>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.gender" />
                                </div>
                                <div>
                                    <label for="date_of_birth" class="block mb-1">Date of Birth</label>
                                    <input v-model="form.date_of_birth" type="date" id="date_of_birth"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.date_of_birth" />
                                </div>
                                <div>
                                    <label for="contact" class="block mb-1">Contact</label>
                                    <input v-model="form.contact" type="text" id="contact" class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.contact" />
                                </div>
                                <div>
                                    <label for="shift" class="block mb-1">Shift</label>
                                    <select v-model="form.shift" type="text" id="shift" class="w-full rounded-lg p-2">
                                        <option value="0">None</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.shift" />
                                </div>
                                <div>
                                    <label for="role_id" class="block mb-1">Role</label>
                                    <select v-model="form.role_id" type="text" id="role_id" class="w-full rounded-lg p-2">
                                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.position }}
                                        </option>
                                        <InputError class="mt-2" :message="form.errors.role_id" />
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Create
                            Account</button>
                    </div>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import { ref, defineProps } from 'vue';
import { useForm } from "@inertiajs/vue3";
const { roles } = defineProps(['roles']);
const form = useForm({
    username: '',
    password: '',
    password_confirmation: '',
    first_name: '',
    last_name: '',
    gender: '',
    date_of_birth: '',
    contact: '',
    shift: '',
    role_id: '',
});

const createAccount = () => {
    form.post(route("users.store"))
        .then(response => {
            form.reset("password", "password_confirmation");
            if (response.data.status === 'success') {
                visit(route("users.index"));
            }
        });
};
</script>
