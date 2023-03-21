<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { inject } from 'vue'
import { hasRole, hasPermission} from '@/composables/helpers'

const Acl = inject('Acl')

defineProps({
    categories: Object,
})
</script>

<template>
    <Head title="Category" />
    <AdminLayout>
        <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <div v-if="hasPermission(Acl.PERMISSION_CATEGORY_ADD)" class="layout-top-spacing col-12">
                    <Link :href="route('admin.category.create')" class="btn btn-primary">Create</Link>
                </div>

                <table id="dt-table" class="table style-3  table-hover">
                    <thead>
                    <tr>
                        <th class="checkbox-column text-center">ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th class="text-center dt-no-sorting">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in categories.data" :key="index">
                        <td class="checkbox-column text-center">
                            {{ index + 1 }}
                        </td>
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            {{ item.slug }}
                        </td>
                        <td>
                            <label class="switch s-primary m-0">
                                <input type="checkbox" class="toggle-active" :checked="{true: item.status}" >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <ul class="table-controls">

                                <li v-if="hasPermission(Acl.PERMISSION_CATEGORY_EDIT)">
                                    <Link :href="route('admin.category.edit', {category: item.id})" class="bs-tooltip"
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

                                <li v-if="hasPermission(Acl.PERMISSION_CATEGORY_DELETE)">
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
    </AdminLayout>
</template>
