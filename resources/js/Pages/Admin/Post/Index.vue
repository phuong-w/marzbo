<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import EditPostModal from './Partials/Modal/EditPostModal.vue'

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
    posts: Object,
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
        data: 'social_posts',
        render: function (data, type, full) {
            const PUBLISH = 2
            let canEdit = hasPermission(Acl.PERMISSION_POST_EDIT)
            let canDelete = hasPermission(Acl.PERMISSION_POST_DELETE)

            let html = ``
            for (const post of data) {
                let button = `<ul class="table-controls">`
                let stats = ``
                let badge = post.status == PUBLISH ? `badge outline-badge-primary` : `badge outline-badge-warning`
                let colTime = ``

                button += `<li>
                    <a href="javascript:" class="bs-tooltip"
                          data-toggle="tooltip" data-placement="top" title=""
                          data-original-title="edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw p-1 br-6 mb-1 btn-refresh" data-id="${post.id}">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                        </svg>
                    </a>
                </li>`

                if (canEdit) {
                    button += `<li>
                        <a href="javascript:" class="bs-tooltip"
                              data-toggle="tooltip" data-placement="top" title=""
                              data-original-title="edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-edit-2 p-1 br-6 mb-1 btn-edit" data-id="${post.id}" data-post-description="${post.content}" data-social-media-name="${post.social_media_name}">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                </path>
                            </svg>
                        </a>
                    </li>`
                }
                if (canDelete) {
                    button += `<li>
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
                button += `</ul>`

                stats = `<div>
                    <span class="badge badge-info ml-2 p-2">
                        <span>React: </span> <span class="badge badge-light">${post.total_react}</span>&nbsp;&nbsp;
                        <span>View: </span> <span class="badge badge-light">${post.total_view}</span>&nbsp;&nbsp;
                        <span>Comment: </span> <span class="badge badge-light">${post.total_comment}</span>
                        </span>
                </div>`

                html += `<table style="width: 100%">
                    <tr style="border: none">
                        <th style="border: none; width: 44%">${post.social_media_name}</th>
                        <th style="border: none; width: 9%"></th>
                        <th style="border: none; width: 18%"></th>
                        <th style="border: none; width: 20%"></th>
                        <th style="border: none; width: 9%"></th>
                    </tr>
                    <tr style="border: none">
                        <td style="border: none; padding-left: 28px"><div style="white-space: pre-wrap">${marked.parse(post.content)}</div></td>
                        <td style="border: none">
                            <span class="${badge}">${post.status_name}</span>
                        </td>
                        <td style="border: none">
                            <div>
                                <p class="d-flex justify-content-between ">
                                    <span class="font-weight-bold">Schedule time: </span>
                                    <span class="badge outline-badge-dark">${post.schedule_time}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Publish date: </span>
                                    <span class="${badge}">${post.updated_at}</span>
                                </p>
                            </div>
                        </td>
                        <td style="border: none; text-align: center">
                            ${stats}
                        </td>
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
let simplemde = null
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

        let socialMediaName = target.getAttribute('data-social-media-name')
        let postDescription = target.getAttribute('data-post-description')

        $('#sSocialMediaName').text(socialMediaName)
        simplemde.value(postDescription)

        $('#editPostModal').modal('show')
    }

    if (target.classList.contains('btn-delete')) {
        e.preventDefault()

        let id = target.getAttribute('data-id')

        $('#sConfirmDelete').attr('data-id', id)
        $('#popup-modal').modal('show')
    }
}


onMounted(() => {
    data.value = props.posts.data
    dt = table.value.dt

    handleDataTableOnMounted(dt, props.posts, params, 'admin.post.index')

    simplemde = new SimpleMDE({
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

    document.addEventListener('click', handleClick)

    $('#editPostModal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()

        simplemde.value('')
    })

    // $(document).on('click', '#sConfirmDelete', function () {
    //     let id = $(this).attr('data-id')
    // })
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
                        <Link v-if="hasPermission(Acl.PERMISSION_POST_ADD)" :href="route('admin.post.create')"
                              class="btn btn-primary mr-2">Create
                        </Link>
                        <Link :href="route('admin.post.index')" class="btn btn-primary mr-2">Published</Link>
                        <Link :href="route('admin.post.index', { not_published: true })" class="btn btn-primary">Not
                            published
                        </Link>
                    </div>

                    <DataTable ref="table" :data="data" :columns="columns" :options="options"
                               class="display table style-3 table-hover">
                        <thead>
                        <tr>
                            <th class="checkbox-column text-center" style="width: 5%">ID</th>
                            -->
                            <th>Content</th>
                            <!--                            <th>Created At</th>-->
                            <!--                            <th class="text-center dt-no-sorting">Action</th>-->
                        </tr>
                        </thead>
                    </DataTable>
                </div>
            </div>
        </div>
        <EditPostModal/>
    </AdminLayout>
</template>

<style lang="scss">
@import "/resources/sass/plugins/table/datatable/datatables.scss";
@import "/resources/sass/plugins/table/datatable/dt-global_style.scss";
@import "/resources/sass/plugins/table/datatable/custom_dt_custom.scss";
</style>
