<script setup>
import Footer from '@/Layouts/Partials/Footer.vue'
import Sidebar from '@/Layouts/Partials/Sidebar.vue'
import Navbar from '@/Layouts/Partials/Navbar.vue'
import Subnav from '@/Layouts/Partials/Subnav.vue'
import Loader from './Partials/Loader.vue'
</script>

<template>
    <!-- BEGIN LOADER -->
    <!--    <Loader />-->
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <Navbar />
    <!--  END NAVBAR  -->

    <!--  BEGIN BREADCRUMBS  -->
    <Subnav />
    <!--  END BREADCRUMBS  -->

    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <Sidebar />
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing layout-spacing">
                    <slot />
                </div>
            </div>

            <Footer />
        </div>
        <!--  END CONTENT PART  -->
    </div>
</template>
