<script>
export default {
  props: {
    users: Array,
  },
  //wait for the users prop to be available then console log it
    mounted() {
        console.log(this.users);
    },
};
</script>
<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th scope="col" class="px-6 py-3">User ID</th>
          <th scope="col" class="px-6 py-3">Username</th>
          <th scope="col" class="px-6 py-3">Role</th>
          <th scope="col" class="px-6 py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop through the users and display their data -->

        <tr v-for="user in users" :key="user.id">
          <td class="px-6 py-4">{{ user.id }}</td>
          <td class="px-6 py-4">{{ user.username }}</td>
          <td class="px-6 py-4">{{ user.employee?.role?.position }}</td>
          <!-- Display the position -->
          <td class="px-6 py-4">
            <!-- Add actions here if needed -->
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
