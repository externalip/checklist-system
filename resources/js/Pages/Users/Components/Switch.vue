<template>
    <div class="flex gap-2">
        <Link :href="route('users')" as="button" :class="{
                'underline': $page.url.startsWith('/Users'),
            }"> User
        </Link>
        <Link :href="route('roles.index')" as="button" :class="{ 'underline':  $page.url.startsWith('/roles') }"> Roles
        </Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
