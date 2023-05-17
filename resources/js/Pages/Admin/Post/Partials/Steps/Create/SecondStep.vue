<script setup>
import { onMounted, ref, watch, nextTick } from 'vue'
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import { useForm } from '@inertiajs/vue3'
// import Masonry from 'masonry-layout'

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    socialMediaSelected: {
        type: Array,
        required: true
    },
    facebookGroups: {
        type: Object,
            required: true
    },
    submitForm: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['form-submitted'])

const objData = ref({})
const images = ref([])
const videos = ref([])

const selectedFacebookPageIds = ref({})
const selectedFacebookGroupIds = ref({})
const selectedFacebookGroup = ref([])


const form = useForm({
    category_id: '',
    scheduled_time: '',
    facebook_pages: {},
    facebook_group: {},
    content: {},
    files: {}
})

const handleSubmit = () => {
    // const selectedFacebookPageIds = $('#sFacebookPagesSelected').val().map(item => parseInt(item))
    // const selectedFacebookGroupIds = $('#sFacebookGroupsSelected').val().map(item => parseInt(item))

    if (objData.value) {
        const entries = Object.entries(objData.value)
        for (const [idSocial, social] of entries) {
            form.content[idSocial] = social.simplemde.value()
            form.files[idSocial] = JSON.stringify(social.files)
            // console.log(social)
            // form.videos[idSocial] = JSON.stringify(social.videos)
        }
    }

    form.facebook_pages = selectedFacebookPageIds.value
    form.facebook_group = selectedFacebookGroup.value
    console.log(form)
    form.post(route('admin.post.store'), {
        onSuccess: () => emit('form-submitted'),
        onError: (response) => emit('form-submitted', response)
    })
}

const toolbarOptions = [
    'bold', 'italic', 'strikethrough', 'heading',
    '|',
    'quote', 'unordered-list', 'ordered-list',
    '|',
    'link', 'code', 'clean-block',
    '|',
    {
        name: "photoWithVideo",
        action: function(editor) {
            const inputVideo = $(editor.element).parent().siblings('.upload-image-video')
            inputVideo.click()
        },
        className: "fa fa-image",
        title: "Photo/video",
    },
    {
        name: "emojiable",
        action: function customFunction(editor) {
            console.log(editor)
        },
        className: "fa fa-smile-o",
        title: "Emoji",
    }, 'preview', 'side-by-side',
    '|',
    'guide'
]

const handleFormMarkdownFollowSocial = (social) => {
    let uploadedFiles = []

    const simplemde = new SimpleMDE({
        element: document.getElementById(`editor-container-${social}`),
        forceSync: true,
        parsingConfig: {
            allowAtxHeaderWithoutSpace: true,
            strikethrough: false,
            underscoresBreakWords: true,
        },
        placeholder: 'Type here...',
        promptURLs: true,
        renderingConfig: {
            singleLineBreaks: false,
            codeSyntaxHighlighting: true,
        },
        spellChecker: false,
        status: ['lines', 'words', 'cursor'],
        tabSize: 4,
        toolbar: toolbarOptions,
    })

    $(`#sUpload${social}`).change(function(e) {
        let file = e.target.files[0]

        if (file) {
            let reader = new FileReader()
            reader.onload = function(event) {
                let fileType = file.type
                let base64data = event.target.result

                uploadedFiles.push(base64data)

                const previewContent = document.getElementById('preview-content')
                let previewElement = createPreviewElement(base64data, fileType)
                console.log(fileType)

                previewContent.appendChild(previewElement)
            }

            reader.readAsDataURL(file)
        }

        return {
            simplemde,
            files: uploadedFiles
        }

    })

    return {
        simplemde,
        files: uploadedFiles
    }
}

const createPreviewElement = (fileUrl, fileType) => {
    const previewElement = document.createElement('div')
    previewElement.classList.add('preview-element')

    if (fileType.startsWith('image/')) {
        const imageElement = document.createElement('img')
        imageElement.src = fileUrl
        imageElement.classList.add('img-fluid')
        previewElement.appendChild(imageElement)
    } else if (fileType.startsWith('video/')) {
        const videoElement = document.createElement('video')
        videoElement.src = fileUrl
        videoElement.controls = true
        videoElement.classList.add('img-fluid')
        previewElement.appendChild(videoElement)
    }

    return previewElement
}

watch(
    [() => props.submitForm, () => props.socialMediaSelected],
    ([submitFormValue, socialMediaSelectedValue], [, oldSocialMediaSelectedValue]) => {
        if (submitFormValue) {
            handleSubmit()
        }

        if (socialMediaSelectedValue) {
            nextTick(() => {
                socialMediaSelectedValue.forEach((elt) => {
                    if (!oldSocialMediaSelectedValue.some(item => item.id === elt.id)) {
                        objData.value[elt.id] = handleFormMarkdownFollowSocial(elt.name)

                        // $('#sFacebookGroupsSelected').select2({
                        //     placeholder: 'Choose groups here...'
                        // })
                        $('#sFacebookGroupsSelected').selectpicker()

                        $('#sFacebookGroupsSelected').on('change', function() {
                            const selectedOptions = $(this).find('option:selected')
                            const id = parseInt($(this).val())
                            const name = selectedOptions.data('group-name')

                            selectedFacebookGroup.value.push({'id': id, 'name': name})
                        })

                        const fp = flatpickr(document.getElementById('sSchedule'), {
                            dateFormat: "Y-m-d H:i",
                            minDate: 'today',
                            enableTime: true,
                            time_24hr: true,
                            defaultHour: 12
                        })

                    }
                })
            })
        }
    }
)

const pages = ref([
    {
        id: 1,
        name: 'Pages 1'
    },
    {
        id: 2,
        name: 'Pages 2'
    },
    {
        id: 3,
        name: 'Pages 3'
    }
])

onMounted(() => {
    $('.selectpicker').selectpicker()
})
</script>

<template>
    <div class="layout-top-spacing">
<!--        <div class="form-group col-12 mb-5">-->
<!--            <InputLabel for="sCategory" value="Category"/>-->
<!--            <select id="sCategory" class="selectpicker form-control" data-live-search="true" data-size="6" :class="{'is-invalid': form.errors.category_id}" v-model="form.category_id">-->
<!--                <option value="" disabled>&#45;&#45; Choose the category &#45;&#45;</option>-->
<!--                <template >-->
<!--                    <option v-for="item in categories.data" :key="item.id" :value="item.id">{{ item.name }}</option>-->
<!--                </template>-->
<!--            </select>-->
<!--            <InputError class="mt-2" :message="form.errors.category_id"/>-->
<!--        </div>-->
        <div class="d-flex justify-content-end align-items-center mt-5">
            <InputLabel for="sSchedule" value="Scheduled Time:"/>
            <div class="form-group col-xl-2 col-lg-3 col-12">
                <input type="text" class="form-control mb-0 flatpickr flatpickr-input active form-control-sm" id="sSchedule" placeholder="Time..." v-model="form.scheduled_time">
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-12">
            <InputLabel for="sContent" value="Content"/>
            <ul class="nav nav-tabs mb-4 mt-0 justify-content-start" role="tablist">
                <li class="nav-item" v-for="(item, index) in socialMediaSelected" :key="item.id">
                    <a class="text-uppercase nav-link" :class="{'active': index === 0}"
                       :id="`${item.name}-tab`" data-toggle="tab" :href="`#${item.name}`" role="tab"
                       :aria-controls="item.name" aria-selected="true">{{ item.name }}</a>
                </li>
            </ul>

            <div class="tab-content">
                <div v-for="(item, index) in socialMediaSelected" :key="item.id" class="tab-pane fade" :class="{'show active': index === 0}" :id="item.name" role="tabpanel" :aria-labelledby="`${item.name}-tab`">
                    <template v-if="item.name.toLowerCase() == 'facebook'">
<!--                        <div class="layout-top-spacing">-->
<!--                            <InputLabel for="sFacebookPagesSelected" value="Pages"/>-->

<!--                            <select id="sFacebookPagesSelected" class="form-control" multiple="multiple">-->
<!--                                <option v-for="item in pages" :key="item.id" :value="item.id">{{ item.name }}</option>-->
<!--                            </select>-->

<!--                            <InputError class="mt-2" :message="form.errors.pages"/>-->
<!--                        </div>-->

                        <div class="layout-top-spacing mb-5">
                            <InputLabel for="sFacebookGroupsSelected" value="Group"/>

                            <select id="sFacebookGroupsSelected" class="selectpicker form-control " data-live-search="true" data-size="6" :class="{'is-invalid': form.errors.facebook_group}">
                                <option value="" disabled>-- Choose a group --</option>
                                <template v-for="item in facebookGroups.data" :key="item.id">
                                    <option :value="item.id" :data-group-name="item.name">{{ item.name }}</option>
                                </template>
                            </select>

                            <InputError class="mt-2" :message="form.errors.facebook_group"/>
                        </div>
                    </template>

                    <div class="form-group mb-4 pt-2">
                        <div class="widget-content widget-content-area">
                            <textarea :id="`editor-container-${item.name}`"></textarea>
                            <InputError class="mt-2" :message="form.errors.content"/>
                        </div>
                        <input type="file" :id="`sUpload${item.name}`" class="upload-image-video d-none" multiple/>
<!--                        <input class="images" :id="`sPostImages${item.name}`" type="file" accept="image/*">-->
<!--                        <input class="videos" :id="`sPostvideos${item.name}`" type="file" accept="video/*">-->
                        <div :id="`preview-container-${item.name}`" class="preview-container card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Box Preview</h5>
                                <div id="preview-content" class="preview-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.preview-container {
    max-width: 700px;
}

.preview-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 10px;
}

.preview-element {
    max-width: calc(50% - 5px);
    flex-grow: 1;
}

.preview-element img,
.preview-element video {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<style lang="scss">
@import "/resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss";
@import "/resources/sass/plugins/jquery-step/jquery.steps.scss";
@import "/resources/sass/plugins/editors/markdown/simplemde.min.scss";
@import "/resources/sass/assets/components/tabs-accordian/custom-tabs.scss";
@import "/resources/sass/plugins/select2/select2.min.scss";
@import "/resources/sass/plugins/flatpickr/custom-flatpickr.scss";
@import "/resources/sass/assets/apps/todolist.scss";
</style>
