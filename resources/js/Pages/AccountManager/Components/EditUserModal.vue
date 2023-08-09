<template>
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
            <h2 class="text-lg font-semibold mb-4">Edit User</h2>
            <form @submit.prevent="updateUser">
                <div class="mb-3">
                    <label for="username" class="block mb-1">Username</label>
                    <input v-model="editedUser.username" type="text" id="username"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 p-2" />
                </div>
                <div class="mb-3">
                    <label for="firstName" class="block mb-1">First Name</label>
                    <input v-model="editedUser.firstName" type="text" id="firstName"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 p-2" />
                </div>
                <div class="mb-3">
                    <label for="lastName" class="block mb-1">Last Name</label>
                    <input v-model="editedUser.lastName" type="text" id="lastName"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 p-2" />
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-1">Password</label>
                    <input v-model="editedUser.password" type="password" id="password"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 p-2" />
                </div>
                <div class="mb-3">
                    <label for="role" class="block mb-1">Role</label>
                    <select v-model="editedUser.role" id="role"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 p-2">

                    </select>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Save</button>
                    <button @click="closeModal" type="button" class="ml-2 border rounded-lg px-4 py-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue';
import axios from 'axios';

const { id: userId, closeModalCallback } = defineProps(['id', 'closeModalCallback']);

const editedUser = ref({
    id: 0,
    username: '',
    firstName: '',
    lastName: '',
    password: '',
    role: '',
});

const showModal = ref(false);

const fetchUserData = async () => {
    try {
        const response = await axios.get(`api/user/${userId}`);
        const user = response.data;
        editedUser.value = {
            id: user.id,
            username: user.username,
            firstName: user.employee.first_name,
            lastName: user.employee.last_name,
            password: '',
            role: user.role?.position,
        };
        showModal.value = true;
    } catch (error) {
        console.error('Error fetching user data:', error);
        showModal.value = false;
    }
};

onMounted(async () => {
    await fetchUserData();
});

const updateUser = () => {
    // Implement the update logic here
};

const closeModal = () => {
    closeModalCallback();
};

</script>
