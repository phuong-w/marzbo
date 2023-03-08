<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <h1 class="text-center">This is home page</h1>
    <Link :href="route('admin.dashboard')">
        <h3 class="text-center">Click to get Dashboard</h3>
    </Link>
</template>
