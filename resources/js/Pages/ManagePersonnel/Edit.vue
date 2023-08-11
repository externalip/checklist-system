<template>
    <AppLayout title="Edit User">
        <form @submit.prevent="updateAccount">
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
                                <!-- Add other account details fields here -->
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
                                    <input v-model="form.contact" type="number" id="contact"
                                        class="w-full rounded-lg p-2" />
                                    <InputError class="mt-2" :message="form.errors.contact" />
                                </div>
                                <div>
                                    <label for="shift" class="block mb-1">Shift</label>
                                    <input v-model="form.shift" type="text" id="shift" class="w-full rounded-lg p-2" />
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
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Update
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
const { user, roles } = defineProps(['user', 'roles']);
const form = useForm({
    username: user.username,
    first_name: user.employee.first_name,
    last_name: user.employee.last_name,
    gender: user.employee.gender,
    date_of_birth: user.employee.date_of_birth,
    contact: user.employee.contact,
    shift: user.employee.shift,
    role_id: user.employee.role_id,
    employee_id: user.employee.id,
});


const updateAccount = () => {
    form.put(route("users.update", user.id), {
        onFinish: () => {
            // Do something after the form has been submitted successfully

        },
    });
};
</script>
