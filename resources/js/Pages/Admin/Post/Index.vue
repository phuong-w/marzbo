<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import EditPostModal from './Partials/Modal/EditPostModal.vue'

import { Head, Link, router } from '@inertiajs/vue3'
import { computed, inject, ref, onMounted } from 'vue'
import { hasRole, hasPermission} from '@/composables/helpers'
import DataTable from 'datatables.net-vue3'
import DataTablesCore from 'datatables.net'
import { handleDataTableOnMounted } from '@/composables/dataTableHandle'

const Acl = inject('Acl')

const props = defineProps({
    posts: Object,
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
    {
        data: 'social_posts',
        render: function (data, type, full) {
            let canEdit = hasPermission(Acl.PERMISSION_POST_EDIT)
            let canDelete = hasPermission(Acl.PERMISSION_POST_DELETE)

            let html = ``
            for (const post of data) {
                let button = `<ul class="table-controls">`

                if (canEdit) {
                    button += `<li>
                        <a href="javascript:" class="bs-tooltip btn-edit" data-id="${post.id}" data-post-description="${post.content}" data-social-media-name="${post.social_media_name}"
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
                    button += `<li>
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
                button += `</ul>`

                html += `<table style="width: 100%">
                    <tr style="border: none">
                        <th style="border: none; width: 90%">${post.social_media_name}</th>
                        <th style="border: none; width: 10%"></th>
                    </tr>
                    <tr style="border: none">
                        <td style="border: none; padding-left: 28px">${post.content}</td>
                        <td style="border: none">
                            ${button}
                        </td>
                    </tr>
                </table>`
            }
            // console.log(data)
            return html
        }
    }
]

const toolbarOptions = [
    'bold', 'italic', 'strikethrough', 'heading',
    '|',
    'quote', 'unordered-list', 'ordered-list',
    '|',
    'link', 'code', 'clean-block',
    '|',
    {
        name: "emojiable",
        action: function customFunction(editor) {
            console.log(editor)
        },
        className: "fa fa-smile-o",
        title: "Emoji",
    }, 'preview',
    '|',
    'guide'
]

const handleCickOnPage = (simplemde) => {
    // Button edit onclick
    // const editElts = dt.table().container().querySelectorAll('.btn-edit')
    // editElts.forEach((elt) => {
    //     elt.addEventListener('click', function() {
    //         router.get(route($routeNameEdit, elt.dataset.id))
    //     })
    // })

    // $(document).on('click', '.btn-edit', function (e) {
    //     e.preventDefault()
    //     let $this = $(this)
    //
    //     let postText = $this.data('posttext')
    //
    //     simplemde.value(postText)
    //     $('#editPostModal').modal('show')
    //     console.log(simplemde)
    // })

    // Button delete onclick
    const deleteElts = dt.table().container().querySelectorAll('.btn-delete')
    deleteElts.forEach((elt) => {
        elt.addEventListener('click', function() {
            removeRow(elt)
            router.delete(route('admin.post.edit', elt.dataset.id))
        })
    })
}

const removeRow = (elt) => {
    const row = elt.closest('tr')
    const idx = data.value.indexOf(row)
    data.value.splice(idx, 1)
}

onMounted(() => {
    data.value = props.posts.data
    dt = table.value.dt

    handleDataTableOnMounted(dt, props.posts, params, 'admin.post.index')

    const simplemde = new SimpleMDE({
        element: document.getElementById(`postDescription`),
        forceSync: true,
        parsingConfig: {
            allowAtxHeaderWithoutSpace: true,
            strikethrough: false,
            underscoresBreakWords: true,
        },
        placeholder: 'Type here...',
        promptURLs: true,
        renderingConfig: {
            codeSyntaxHighlighting: true,
        },
        spellChecker: false,
        tabSize: 4,
        toolbar: toolbarOptions,
    })

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault()
        let $this = $(this)

        let socialMediaName = $this.data('social-media-name')
        let postDescription = $this.data('post-description')

        $('#sSocialMediaName').text(socialMediaName)
        simplemde.value(postDescription)

        $('#editPostModal').modal('show')
    })

    $('#editPostModal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()

        simplemde.value('')
    })
})

</script>

<template>
    <Head title="Post" />
    <AdminLayout>
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">

                    <div class="layout-top-spacing col-12">
                        <Link v-if="hasPermission(Acl.PERMISSION_POST_ADD)" :href="route('admin.post.create')" class="btn btn-primary mr-2">Create</Link>
                        <Link :href="route('admin.post.index')" class="btn btn-primary mr-2">Published</Link>
                        <Link :href="route('admin.post.index', { not_published: true })" class="btn btn-primary">Not published</Link>
                    </div>

                    <DataTable ref="table" :data="data" :columns="columns" :options="options" class="display table style-3 table-hover">
                        <thead>
                        <tr>
                            <th class="checkbox-column text-center" style="width: 5%">ID</th>-->
                            <th style="width: 95%">Content</th>
<!--                            <th>Created At</th>-->
<!--                            <th class="text-center dt-no-sorting">Action</th>-->
                        </tr>
                        </thead>
                    </DataTable>
                </div>
            </div>
        </div>
        <EditPostModal />
    </AdminLayout>
</template>

<style lang="scss">
@import "/resources/sass/plugins/table/datatable/datatables.scss";
@import "/resources/sass/plugins/table/datatable/dt-global_style.scss";
@import "/resources/sass/plugins/table/datatable/custom_dt_custom.scss";
</style>
