<script setup>
import { defineProps, ref, onMounted, computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { initFlowbite } from 'flowbite';
import Pagination from '@/Shared/Pagination.vue';
import Swal from 'sweetalert2';
const { users } = defineProps(['users']);
onMounted(() => {
    initFlowbite();
});
const confirmDelete = (userId) => {
    Swal.fire({
        title: 'Confirm Delete',
        text: 'Are you sure you want to delete this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const deleteLink = route('users.destroy', userId);
            axios.delete(deleteLink)
                .then(() => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'The user has been deleted.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while deleting the user.' + error,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                });
        }
    });
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
                <tr v-for="user in  users.data " :key="user.id">
                    <td class="px-6 py-4">{{ user.id }}</td>
                    <td class="px-6 py-4">{{ user.username }}</td>
                    <td class="px-6 py-4">{{ user.employee?.role?.position }}</td>

                    <td class="px-6 py-4">
                        <Link :href="route('users.edit', user.id)" as="button" class="w-5 ">
                        <img src="@/Shared/Icons/edit.svg" alt="Edit" class="w-5 h-5 cursor-pointer" />
                        </Link>
                        <button @click="confirmDelete(user.id)" class="w-5">
                            <img src="@/Shared/Icons/delete.svg" alt="Delete" class="w-5 h-5 cursor-pointer" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :data="users" />
    </div>
</template>
