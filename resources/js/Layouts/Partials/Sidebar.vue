<script setup>
import { Link } from '@inertiajs/vue3'
import VueFeather from 'vue-feather'

const menuItems = [
    {
        title: 'Dashboard',
        component: 'Dashboard',
        url: route('admin.dashboard'),
        icon: 'home'
    },
    {
        title: 'Categories',
        component: 'Category',
        url: route('admin.category.index'),
        icon: 'credit-card'
    },
    {
        title: 'Posts',
        component: 'Post',
        url: route('admin.post.index'),
        icon: 'credit-card'
    },
    {
        title: 'Users',
        component: 'User',
        url: route('admin.user.index'),
        icon: 'users'
    },
];
</script>

<template>
    <div class="sidebar-wrapper sidebar-theme">
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories ps" id="accordionExample">
                <li class="menu" v-for="(item, index) in menuItems" :key="index">
                    <Link :href="item.url" class="dropdown-toggle" :class="{ 'active': $page.component.startsWith(item.component)}">
                        <div class="d-flex align-items-center">
                            <vue-feather :type="item.icon"></vue-feather>
                            <span class=""> {{ item.title }} </span>
                        </div>
                    </Link>
                </li>

            </ul>

        </nav>
    </div>
</template>

<style scoped>
.dropdown-toggle.active {
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
    color: #0e1726;
}
</style>
