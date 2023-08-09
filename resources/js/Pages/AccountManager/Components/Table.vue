<script>
import { defineProps, ref, onMounted } from 'vue';
import editModal from './EditModal.vue';
import { initFlowbite } from 'flowbite';
import Pagination from './Pagination.vue';
export default {
    components: {
        editModal,
        Pagination,
    },
    props: {
        users: Object,
    },
    setup() {
        onMounted(() => {
            initFlowbite();
        });
    },
};
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
                        <button class="mr-4">
                            <img src="./Icons/view.svg" alt="View" class="w-5 h-5 cursor-pointer" />
                        </button>
                        <button class="mr-4" data-modal-toggle="defaultModal">
                            <img src="./Icons/edit.svg" alt="Edit" class="w-5 h-5 cursor-pointer" />
                        </button>
                        <button class="mr-4">
                            <img src="./Icons/delete.svg" alt="Delete" class="w-5 h-5 cursor-pointer" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :data="users" />
    </div>
</template>

