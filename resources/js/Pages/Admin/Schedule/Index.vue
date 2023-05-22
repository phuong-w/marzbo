<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'

import {Head, Link, router} from '@inertiajs/vue3'
import {computed, inject, ref, onMounted, onBeforeUnmount} from 'vue'
import {hasRole, hasPermission} from '@/composables/helpers'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net'
import {handleDataTableOnMounted, options} from '@/composables/dataTableHandle'
import PopupModal from '@/components/PopupModal.vue'
import { marked } from 'marked'

const Acl = inject('Acl')

const props = defineProps({
    schedules: Object,
})

DataTable.use(DataTablesCore)

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
        data: 'social_media_name',
        render: function(data, type, full) {
            return `<span class="font-weight-bold">${data}</span>`
        }
    },
    {
        data: 'post',
        render: function (data, type, full) {
            return `<div style="white-space: pre-wrap">${data.content ? marked.parse(data.content) : ''}</div>`
        }
    },
    {
        data: 'status',
        render: function(data, type, full) {
            return `<span class="${full.badge}">${full.status_name}</span>`
        }
    },
    {
        data: 'publish_date_formated',
        render: function (data, type, full) {
            return `<span class="badge outline-badge-dark" style="padding: 12px"> ${data} </span>`
        }
    },
    {
        data: 'id',
        class: 'text-center',
        render: function (data, type, full) {
            let canEdit = hasPermission(Acl.PERMISSION_SCHEDULE_EDIT)
            let canDelete = hasPermission(Acl.PERMISSION_SCHEDULE_DELETE)

            let html = `<ul class="table-controls">`
            if (canEdit) {
                html += `<li>
                    <a href="javascript:" class="bs-tooltip"
                          data-toggle="tooltip" data-placement="top" title=""
                          data-original-title="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-edit-2 p-1 br-6 mb-1 btn-edit" data-id="${data}">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                            </path>
                        </svg>
                    </a>
                </li>`
            }
            if (canDelete) {
                html += `<li>
                    <a href="javascript:" class="bs-tooltip" data-toggle="tooltip" data-placement="top"
                       title=""
                       data-original-title="delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-trash p-1 br-6 mb-1 btn-delete" data-id="${data}" >
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path
                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
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

const callAjaxRefreshStatsPost = (id) => {
    router.get(route('admin.post.stats', id),
        {
            onSuccess: () => data.value = props.posts.data
        }
    )
}

const handleClick = (e) => {
    const target = e.target
    if (target.classList.contains('btn-refresh')) {
        e.preventDefault()
        let id = target.getAttribute('data-id')
        callAjaxRefreshStatsPost(id)
    }

    if (target.classList.contains('btn-edit')) {
        e.preventDefault()
        let id = target.getAttribute('data-id')

        router.get(route('admin.schedule.edit', id))
    }

    if (target.classList.contains('btn-delete')) {
        e.preventDefault()

        let id = target.getAttribute('data-id')

        $('#sConfirmDelete').attr('data-id', id)
        $('#popup-modal').modal('show')
    }
}


onMounted(() => {
    data.value = props.schedules.data
    dt = table.value.dt


    handleDataTableOnMounted(dt, props.schedules, params, 'admin.schedule.index')

    document.addEventListener('click', handleClick)
})

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClick)
})

</script>
<template>
    <Head title="Post"/>
    <AdminLayout>
        <PopupModal/>
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">

                    <div class="layout-top-spacing col-12">
                        <Link v-if="hasPermission(Acl.PERMISSION_SCHEDULE_MANAGE)" :href="route('admin.post.create')" class="btn btn-primary mr-2"> Cron job
                        </Link>
                    </div>

                    <DataTable ref="table" :data="data" :columns="columns" :options="options" class="display table style-3 table-hover">
                        <thead>
                        <tr>
                            <th class="checkbox-column text-center" style="width: 10%">ID</th>
                            <th style="width: 10%">Social Media</th>
                            <th style="width: 50%">Content</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%">Schedule Time</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                        </thead>
                    </DataTable>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style lang="scss">
@import "/resources/sass/plugins/table/datatable/datatables.scss";
@import "/resources/sass/plugins/table/datatable/dt-global_style.scss";
@import "/resources/sass/plugins/table/datatable/custom_dt_custom.scss";
</style>
