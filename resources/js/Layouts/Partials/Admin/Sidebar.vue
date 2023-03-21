<script setup>
import { Link } from '@inertiajs/vue3'
import VueFeather from 'vue-feather'
import { inject } from 'vue'
import { hasRole, hasPermission} from '@/composables/helpers'

const Acl = inject('Acl')

const menuItems = [
    {
        title: 'Dashboard',
        component: 'Dashboard',
        url: route('admin.dashboard'),
        icon: 'home',
        active: route().current('admin.dashboard'),
        show: hasPermission(Acl.PERMISSION_VIEW_MENU_DASHBOARD)
    },
    {
        title: 'Categories',
        component: 'Category',
        url: route('admin.category.index'),
        icon: 'credit-card',
        active: route().current('admin.category.*'),
        show: hasPermission(Acl.PERMISSION_CATEGORY_LIST)
    },
    {
        title: 'Posts',
        component: 'Post',
        url: route('admin.post.index'),
        icon: 'credit-card',
        active: route().current('admin.post.*'),
        show: hasPermission(Acl.PERMISSION_POST_LIST)
    },
    {
        title: 'Users',
        component: 'User',
        url: route('admin.user.index'),
        icon: 'users',
        active: route().current('admin.user.*'),
        show: hasPermission(Acl.PERMISSION_SCHEDULE_LIST)
    },
    {
        title: 'Roles',
        component: 'Role',
        url: route('admin.role.index'),
        icon: 'settings',
        active: route().current('admin.role.*'),
        show: hasPermission(Acl.PERMISSION_VIEW_MENU_ROLE_PERMISSION)
    },
    {
        title: 'Permissions',
        component: 'Permission',
        url: route('admin.permission.index'),
        icon: 'anchor',
        active: route().current('admin.permission.*'),
        show: hasPermission(Acl.PERMISSION_VIEW_MENU_ROLE_PERMISSION)
    },
];
</script>

<template>
    <div class="sidebar-wrapper sidebar-theme">
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories ps" id="accordionExample">
                <li class="menu" v-for="(item, index) in menuItems" :key="index">
                    <Link :href="item.url" v-if="item.show" class="dropdown-toggle" :class="{ 'active': item.active}">
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
