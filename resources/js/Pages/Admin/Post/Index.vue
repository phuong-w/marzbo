<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
    posts: Object,
})
</script>

<template>
    <AdminLayout>
        <div class="col-12">
            <h1>
                Posts
            </h1>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <div class="widget widget-content-area br-4">
                <div class="widget-one">
                    <h6>Here is a quote to inspire your day</h6>
                    <p class="mb-0 mt-3" v-html="quote"></p>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
