<script setup>
import Accounts from '@/Pages/AccountManager/Components/Table.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import EditModal from '@/Pages/AccountManager/Components/EditModal.vue';
const { users } = defineProps(['users']);
</script>

<template>
    <AppLayout title="Account Manager">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Accounts :users="users" />
                    <EditModal />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
