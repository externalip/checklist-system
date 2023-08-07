<script setup>
import Accounts from '@/Pages/AccountManager/Components/Table.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { defineProps } from 'vue';

const { users } = defineProps(['users']); // Receive the "users" prop
</script>

<template>
  <MainLayout title="Account Manager">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <!-- Pass the "users" prop to the Table component -->
          <Accounts :users="users" />
        </div>
      </div>
    </div>
  </MainLayout>
</template>
