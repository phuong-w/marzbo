<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import {Head, Link, router, useForm} from '@inertiajs/vue3'
import {inject, onMounted, ref} from 'vue'
import Multiselect from 'vue-multiselect'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net'
import { hasRole, hasPermission} from '@/composables/helpers'
import { handleDataTableOnMounted } from '@/composables/dataTableHandle'
import PopupModal from '@/components/PopupModal.vue'

DataTable.use(DataTablesCore)

const Acl = inject('Acl')

const props = defineProps({
    role: {
        type: Object,
        required: true,
    },
    permissions: Object,
    roleWithPermissions: Object,
})

let dt
const params = route().params
const data = ref([])
const table = ref()

const options = {
    dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
    oLanguage: {
        "oPaginate": {
            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sEmptyTable": "No data available in table",
        "sInfo": `Showing page _PAGE_ of _PAGES_`,
        "sInfoEmpty": "Showing page 0 of 0",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
    },
    lengthMenu: [5, 10, 20, 50],
    pageLength: 50,
    processing: true,
    ordering: true,
    order: [[0, 'desc']],
}
const columns = [
    {
        data: 'id',
        class: 'text-center'
    },
    {data: 'name'},
    {
        data: 'id',
        class: 'text-center',
        render: function (data, type, full) {
            let canEdit = hasPermission(Acl.PERMISSION_PERMISSION_MANAGE)
            let canDelete = hasPermission(Acl.PERMISSION_PERMISSION_MANAGE)

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
            html += `</ul>`

            return html
        }
    }
]

const form = useForm({
    name: props.role.data.name,
    permissions: []
})

onMounted(() => {
    data.value = props.roleWithPermissions.data
    dt = table.value.dt
    handleDataTableOnMounted(dt, props.roleWithPermissions, params, 'admin.role.edit', props.role.data.id)

    form.permissions = props.role.data.permissions

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault()
        let $this = $(this)

        router.get(route('admin.permission.edit', $this.data('id')))
    })
})

const submit = () => {
    form.put(route('admin.role.update', {
            role: props.role.data.id
        }),
        {
            onSuccess: () => {
                data.value = props.roleWithPermissions.data
            }
        }
    )
}

</script>

<template>
    <Head title="Edit role" />
    <AdminLayout>
        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <form @submit.prevent="submit">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="layout-top-spacing col-12 mb-4">
                            <Link :href="route('admin.role.index')"
                               class="btn btn-gray mr-2">Cancel</Link>
                            <PrimaryButton class="btn btn-primary" :disabled="form.processing">
                                Update
                            </PrimaryButton>
                        </div>

                        <div class="form-group col-12 mb-4">
                            <InputLabel for="sName" value="Name"/>

                            <TextInput
                                id="sName"
                                type="text"
                                class="form-control"
                                v-model="form.name"
                                :class="{'is-invalid': form.errors.name}"
                            />

                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="form-group col-12 mb-4">
                            <InputLabel for="sPermissions" value="Permissions"/>

                            <Multiselect
                                v-model="form.permissions"
                                :options="permissions.data"
                                :multiple="true"
                                :close-on-select="true"
                                placeholder="Pick some"
                                label="name"
                                track-by="id"
                            />

                            <InputError class="mt-2" :message="form.errors.permissions"/>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <h3 class="text-center mb-4">Permissions</h3>
                        <DataTable ref="table" :data="data" :columns="columns" :options="options" class="display table style-3 table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column text-center">ID</th>
                                <th>Name</th>
                                <th class="text-center dt-no-sorting">Actions</th>
                            </tr>
                            </thead>
                        </DataTable>
<!--                        <table id="dt-table" class="table style-3  table-hover">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th class="checkbox-column text-center">ID</th>-->
<!--                                <th>Name</th>-->
<!--                                <th class="text-center dt-no-sorting">Actions</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr v-for="item in role.data.permissions" :key="item.id">-->
<!--                                <td class="checkbox-column text-center">-->
<!--                                    {{ item.id }}-->
<!--                                </td>-->
<!--                                <td>-->
<!--                                    {{ item.name }}-->
<!--                                </td>-->
<!--                                <td class="text-center">-->
<!--                                    <ul class="table-controls">-->

<!--                                        <li>-->
<!--                                            <Link :href="route('admin.role.edit', {role: item.id})" class="bs-tooltip"-->
<!--                                                  data-toggle="tooltip" data-placement="top" title=""-->
<!--                                                  data-original-title="edit">-->
<!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"-->
<!--                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"-->
<!--                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                                                     class="feather feather-edit-2 p-1 br-6 mb-1">-->
<!--                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">-->
<!--                                                    </path>-->
<!--                                                </svg>-->
<!--                                            </Link>-->
<!--                                        </li>-->

<!--                                        <li>-->
<!--                                            <a class="bs-tooltip delete" data-toggle="tooltip" data-placement="top"-->
<!--                                               title=""-->
<!--                                               data-original-title="delete">-->
<!--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"-->
<!--                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"-->
<!--                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                                                     class="feather feather-trash p-1 br-6 mb-1">-->
<!--                                                    <polyline points="3 6 5 6 21 6"></polyline>-->
<!--                                                    <path-->
<!--                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">-->
<!--                                                    </path>-->
<!--                                                </svg>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
