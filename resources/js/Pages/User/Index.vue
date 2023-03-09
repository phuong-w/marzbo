<script setup>
import AppLayout from '@/Layouts/App.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
    users: Object,
})
</script>

<template>
    <Head title="User" />
    <AppLayout>
        <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <div class="layout-top-spacing col-12">
                    <Link :href="route('admin.user.create')" class="btn btn-primary">Create</Link>
                </div>

                <table id="dt-table" class="table style-3  table-hover">
                    <thead>
                    <tr>
                        <th class="checkbox-column text-center">No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center dt-no-sorting">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user, index) in users.data" :key="index">
                        <td class="checkbox-column text-center">
                            {{ index + 1 }}
                        </td>
                        <td>
                            {{ user.name }}
                        </td>
                        <td>
                            {{ user.email }}
                        </td>
                        <td>
                            <span class="badge badge-primary" v-for="(role, index) in user.roles" :key="index">
                                    {{ role.name }}
                            </span>
                        </td>
                        <td class="text-center">
                            <ul class="table-controls">

                                <li>
                                    <Link :href="route('admin.user.show', {user: user.id})" class="bs-tooltip"
                                       data-toggle="tooltip" data-placement="top" title=""
                                       data-original-title="show">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-eye p-1 br-6 mb-1">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('admin.user.edit', {user: user.id})" class="bs-tooltip"
                                       data-toggle="tooltip" data-placement="top" title=""
                                       data-original-title="edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-edit-2 p-1 br-6 mb-1">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                            </path>
                                        </svg>
                                    </Link>
                                </li>

                                <li>
                                    <a class="bs-tooltip delete" data-toggle="tooltip" data-placement="top"
                                       title=""
                                       data-original-title="delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-trash p-1 br-6 mb-1">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </AppLayout>
</template>
