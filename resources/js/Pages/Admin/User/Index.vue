<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head, Link, router} from '@inertiajs/vue3'
import {inject,onMounted, ref} from 'vue'
import { hasRole, hasPermission} from '@/composables/helpers'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net'
import { handleDataTableOnMounted, options } from '@/composables/dataTableHandle'

DataTable.use(DataTablesCore)

const Acl = inject('Acl')

const props = defineProps({
    users: Object,
})

let dt
const params = route().params
const data = ref([])
const table = ref()

const columns = [
    {
        data: 'id',
        class: 'text-center'
    },
    {
        data: 'name'
    },
    {
        data: 'email'
    },
    {
        data: 'roles',
        render: function (data, type, full)  {
            let html = ``

            data.forEach((role) => {
                html += `<span class="badge badge-primary">${role}</span>`
            })

            return html
        }
    },
    {
        data: 'id',
        class: 'text-center',
        render: function (data, type, full) {
            let canEdit = hasPermission(Acl.PERMISSION_USER_EDIT)
            let canDelete = hasPermission(Acl.PERMISSION_USER_DELETE)

            let html = `<ul class="table-controls">`
            if (canEdit) {
                html += `<li>
                    <a href="javascript:" class="bs-tooltip btn-edit" data-id="${data}"
                          data-toggle="tooltip" data-placement="top" title=""
                          data-original-title="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-edit-2 p-1 br-6 mb-1">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                            </path>
                        </svg>
                    </a>
                </li>`
            }
            if (canDelete) {
                html += `<li>
                    <a href="javascript:" class="bs-tooltip btn-lock" data-id="${data}" data-toggle="tooltip" data-placement="top"
                       title=""
                       data-original-title="lock">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock  p-1 br-6 mb-1">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </a>
                </li>`
            }
            html += `</ul>`

            return html
        }
    }
]

const handleClickOnPage = () => {
    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault()
        let id = $(this).attr('data-id')

        router.get(route('admin.user.edit', id))
    })

}

onMounted(() => {
    data.value = props.users.data
    dt = table.value.dt

    handleDataTableOnMounted(dt, props.users, params, 'admin.user.index')

    handleClickOnPage()
})
</script>

<template>
    <Head title="User" />
    <AdminLayout>
        <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <div class="layout-top-spacing col-12">
                    <Link :href="route('admin.user.create')" class="btn btn-primary">Create</Link>
                </div>

                <DataTable ref="table" :data="data" :columns="columns" :options="options" class="display table style-3 table-hover">
                    <thead>
                    <tr>
                        <th class="checkbox-column text-center">No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center dt-no-sorting">Actions</th>
                    </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
    </div>
    </AdminLayout>
</template>
