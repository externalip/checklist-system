<template>
    <!-- LINKS TO SWITCH PAGES -->
    <div class="flex gap-2 text-blue-800">

        <!-- user page -->
        <a :href="route('users')" as="button" :class="{
                'underline': $page.url.startsWith('/Users')}"> User
        </a>

        <!-- roles page -->
        <a :href="route('roles.index')" as="button" :class="{
            'underline':  $page.url.startsWith('/roles')}"> Roles
        </a>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
