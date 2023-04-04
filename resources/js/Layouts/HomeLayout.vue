<script setup>
import Footer from '@/Layouts/Partials/Footer.vue'
import Header from '@/Layouts/Partials/Header.vue'
</script>

<template>
    <div id="Wrapper">
        <div id="Header_wrapper">
            <!-- BEGIN HEADER -->
            <Header />
            <!--  END HEADER -->
        </div>

        <div id="Content">
            <slot />
        </div>

        <!-- BEGIN FOOTER -->
        <Footer />
        <!--  END FOOTER -->
    </div>
</template>
