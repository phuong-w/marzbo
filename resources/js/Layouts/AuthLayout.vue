<script setup>
import ToastList from '@/components/ToastList.vue'
</script>
<template>
    <ToastList />
    <div class="form-container outer">
        <div class="form-form">
            <slot />
        </div>
    </div>
</template>
