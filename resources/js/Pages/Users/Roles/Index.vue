<template>
    <AppLayout title="Roles">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Role ID</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Permissions</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in  roles" :key="role.id">
                            <td class="px-6 py-4">{{ role.id }}</td>
                            <td class="px-6 py-4">{{ role.name }}</td>
                            <td class="px-6 py-4">{{ role.description ? role.description : 'No Role Description' }}</td>
                            <td class="px-6 py-4">
                                {{ role.permissions.join(', ') ? role.permissions.join(', ') : 'No Permissions'}}
                            </td>
                            <td class="px-6 py-4">
                                <Link :href="route('roles.edit', role.id)" as="button" class="w-5 mx-4">
                                    <img src="@/Shared/Icons/edit.svg" alt="Edit" class="w-5 h-5 cursor-pointer" />
                                </Link>
                                <button class="w-5" @click="confirmDelete(role.id)">
                                    <img src="@/Shared/Icons/delete.svg" alt="Delete" class="w-5 h-5 cursor-pointer" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { defineProps, ref, onMounted, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps(['roles', 'permissions']);
const confirmDelete = async (id) => {
   const isConfirmed = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
   });
   if (!isConfirmed.isConfirmed) return;

}
</script>
