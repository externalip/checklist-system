<script setup>
import Accounts from '@/Pages/ManagePersonnel/Components/Table.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const { users, roles } = defineProps(['users', 'roles']);
</script>

<template>
    <AppLayout title="Account Manager">
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="pl-2 mb-2">
                    <Link :href="route('users.create')" class="bg-blue-500 text-white px-4 py-2 rounded-lg" as="button">
                    Add User
                    </Link>

                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Accounts :users="users" :roles="roles" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
