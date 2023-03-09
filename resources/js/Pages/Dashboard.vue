<script setup>
import AppLayout from '@/Layouts/App.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    quote: String,
})
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout>
        <div class="col-12">
            <h1>
                Dashbroad
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
    </AppLayout>
</template>
