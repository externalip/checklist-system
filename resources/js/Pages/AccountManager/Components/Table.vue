<script setup>
import { defineProps, ref, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Pagination from './Pagination.vue';
import EditUserModal from './EditUserModal.vue';

const { users } = defineProps(['users']);
const showEditModal = ref(false);
const editedUserId = ref(null);

const editUser = async (id) => {
    editedUserId.value = id;
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
};
onMounted(() => {
    initFlowbite();

});
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">User ID</th>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td class="px-6 py-4">{{ user.id }}</td>
                    <td class="px-6 py-4">{{ user.username }}</td>
                    <td class="px-6 py-4">{{ user.employee?.role?.position }}</td>

                    <td class="px-6 py-4">
                        <button class="mr-4" @click.prevent="editUser(user.id)" data-modal>
                            <img src="./Icons/edit.svg" alt="Edit" class="w-5 h-5 cursor-pointer" />
                        </button>
                        <button class="mr-4">
                            <img src="./Icons/delete.svg" alt="Delete" class="w-5 h-5 cursor-pointer" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 z-40">
            <EditUserModal v-if="showEditModal" :id="editedUserId" :closeModalCallback="closeEditModal" />
        </div>
        <Pagination :data="users" />
    </div>
</template>

