<template>
    <AppLayout title="Roles">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="add-role">
                <Switch />
                <Link :href="route('roles.create')" type="button" class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> Add Role
                </Link>
            </div>
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
                    <tbody class="text-xs">
                        <tr v-for="role in  roles" :key="role.id" class="hover:bg-gray-50 duration-200">
                            <td class="p-2">{{ role.id }}</td>
                            <td class="p-2 font-bold">{{ role.name }}</td>
                            <td class="p-2">{{ role.description ? role.description : 'No Role Description' }}</td>
                            <td class="p-2">
                                {{ role.permissions ? role.permissions.join(', ') : 'No Permissions' }}
                            </td>
                            <td class="p-2 flex flex-row">
                                <Link :href="route('roles.edit', role.id)" as="button" class="w-4 mx-4">
                                    <img src="@/Shared/Icons/edit.svg" alt="Edit" class="w-5 h-5 cursor-pointer" />
                                </Link>
                                <button class="w-4" @click="confirmDelete(role.id)">
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
import Switch from '../Components/Switch.vue';
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
    const deleteLink = await axios.delete(route('roles.destroy', id), { data: { id } });
    if (deleteLink.status == 200) {
        await Swal.fire({
            title: 'Deleted!',
            text: 'The role has been deleted.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: true
        }).then(() => {
            window.location.reload(true);
        });
    }
}
</script>
<style scoped>

</style>
