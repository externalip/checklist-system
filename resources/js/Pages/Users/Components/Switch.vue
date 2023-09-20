<template>
    <!-- LINKS TO SWITCH PAGES -->
    <div class="flex gap-2">

        <!-- user page -->
        <Link :href="route('users')" as="button" :class="{
                'underline': $page.url.startsWith('/Users'),}"> User
        </Link>

        <!-- roles page -->
        <Link :href="route('roles.index')" as="button" :class="{
            'underline':  $page.url.startsWith('/roles') }"> Roles
        </Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
