<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import {computed, inject, ref, onMounted, onUpdated, watch, onUnmounted} from 'vue'
import { hasRole, hasPermission} from '@/composables/helpers'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net'

const Acl = inject('Acl')

const props = defineProps({
    categories: Object,
})

DataTable.use(DataTablesCore)

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
    processing: true,
    ordering: true,
    order: [[0, 'desc']]
}
const columns = [
    {
        data: 'id',
        class: 'text-center'
    },
    {data: 'name'},
    {data: 'slug'},
    {data: 'created_at'},
    {
        data: 'id',
        class: 'text-center',
        render: function (data, type, full) {
            let canEdit = hasPermission(Acl.PERMISSION_CATEGORY_EDIT)
            let canDelete = hasPermission(Acl.PERMISSION_CATEGORY_DELETE)

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
                    <a href="javascript:" class="bs-tooltip btn-delete" data-id="${data}" data-toggle="tooltip" data-placement="top"
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
                </li>`
            }
            html += `</ul>`

            return html
        }
    }
]

const customDataTable = () => {
    // LengthPage
    dt.page.len(props.categories.meta.per_page)

    // Showing page
    const language = dt.settings()[0].oLanguage
    language.sInfo = `Showing page ${props.categories.meta.current_page} of ${props.categories.meta.last_page}`

    // Box select + box input
    const selectPage = dt.table().container().querySelector('.dataTables_length>label>select')
    const inputSearch = dt.table().container().querySelector('input[type="search"]')
    selectPage.classList.add('form-control')
    inputSearch.classList.add('form-control')

    dt.on('draw', function () {
        // Pagination custom
        const pagination = dt.table().container().querySelector('.dataTables_paginate')
        const links = props.categories.meta.links
        let page = 0
        let newPagination = `<ul class="pagination">`
        for (const [index, value] of links.entries()) {
            if (value.url) {
                let urlParams = new URL(value.url)
                page = urlParams.searchParams.get('page')
            }

            if (index === 0) {
                newPagination += `
                <li class="paginate_button page-item previous ${value.url ? '' : 'disabled'}" id="dt-table_previous">
                    <a href="javascript:" data-page="${page}" aria-controls="dt-table" data-dt-idx="0" tabindex="0" class="page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </a>
                </li>`
            } else if (index === links.length - 1) {
                newPagination += `
                <li class="paginate_button page-item next ${value.url ? '' : 'disabled'}" id="dt-table_next">
                    <a href="javascript:" data-page="${page}" aria-controls="dt-table" data-dt-idx="2" tabindex="0" class="page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </li>`
            } else {
                newPagination += `
                <li class="paginate_button page-item ${value.active ? 'active' : ''}">
                    <a href="javascript:" data-page="${page}" aria-controls="dt-table" data-dt-idx="1" tabindex="0" class="page-link">${value.label}</a>
                </li>`
            }
        }
        newPagination += `</ul>`

        pagination.innerHTML = newPagination
    })
}

const handleCickOnPage = () => {
    // Button edit onclick
    const editElts = dt.table().container().querySelectorAll('.btn-edit')
    editElts.forEach((elt) => {
        elt.addEventListener('click', function() {
            router.get(route('admin.category.edit', elt.dataset.id))
        })
    })

    // Button delete onclick
    const deleteElts = dt.table().container().querySelectorAll('.btn-delete')
    deleteElts.forEach((elt) => {
        elt.addEventListener('click', function() {
            router.delete(route('admin.category.destroy', elt.dataset.id))
            removeRow(elt)
        })
    })

    //Button pagination
    const paginationElts = dt.table().container().querySelectorAll('.page-link')
    paginationElts.forEach((elt) => {
        elt.addEventListener('click', function() {
            const page = elt.dataset.page
            if (page) {
                params.page = page
                redirectToThisPage()
            }
        })
    })
}

const redirectToThisPage = () => {
    router.get(route('admin.category.index'), params)
}

const removeRow = (elt) => {
    const row = elt.closest('tr')
    const idx = data.value.indexOf(row)
    data.value.splice(idx, 1)
}

onMounted(() => {
    const url = new URL(window.location)
    const keyword = url.searchParams.get('search')

    data.value = props.categories.data
    dt = table.value.dt

    if (keyword) {
        dt.search(keyword)
        const input = dt.table().container().querySelector('input[type="search"]')
        input?.focus()
    }

    if (props.categories.meta.current_page > props.categories.meta.last_page) {
        delete params.page
        redirectToThisPage()
    }

    customDataTable()

    dt.on('draw', function () {
        handleCickOnPage()
    })

    dt.on('search', (e, settings) => {
        const searchValue = settings.oPreviousSearch.sSearch

        if (searchValue != keyword && searchValue) {
            params.search = searchValue
            redirectToThisPage()
        } else if (searchValue != keyword && !searchValue && url.searchParams.has('search')) {
            delete params.search
            redirectToThisPage()
        }
    })

    dt.on('length', (e, settings, length) => {
        params.limit = length
        redirectToThisPage()
    })

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

                <DataTable ref="table" :data="data" :columns="columns" :options="options" class="display table style-3 table-hover">
                    <thead>
                    <tr>
                        <th class="checkbox-column text-center">ID</th>-->
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th class="text-center dt-no-sorting">Action</th>
                    </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
    </div>
    </AdminLayout>
</template>
