<script setup>
import Accounts from '@/Pages/Users/Components/Table.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Filter from '@/Pages/Users/Components/Filter.vue';
defineProps(['users', 'roles']);

</script>

<template>
    <AppLayout title="Account Manager">
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Filter :roles="roles"/>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Accounts :users="users" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
