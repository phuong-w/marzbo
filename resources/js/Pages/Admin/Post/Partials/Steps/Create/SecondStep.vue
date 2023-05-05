<script setup>
import { onMounted, ref, watch, nextTick } from 'vue'
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import { useForm } from '@inertiajs/vue3'

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

const showTab = ref(false)

const objData = ref({})
const content = ref(null)
const images = ref([])
const videos = ref([])


const form = useForm({
    category_id: '',
    facebook_pages: [],
    facebook_groups: [],
    content: {},
    images: {},
    videos: {}
})

const handleSubmit = () => {
    const selectedFacebookPageIds = $('#sFacebookPagesSelected').val().map(item => parseInt(item))
    const selectedFacebookGroupIds = $('#sFacebookGroupsSelected').val().map(item => parseInt(item))

    if (objData.value) {
        const entries = Object.entries(objData.value)
        for (const [idSocial, social] of entries) {
            form.content[idSocial] = social.quill.root.innerHTML
            form.images[idSocial] = JSON.stringify(social.images)
            form.videos[idSocial] = JSON.stringify(social.videos)
        }
    }
    form.facebook_pages = selectedFacebookPageIds
    form.facebook_groups = selectedFacebookGroupIds
    // console.log(form);
    form.post(route('admin.post.store'), {
        onSuccess: () => emit('form-submitted'),
        onError: (response) => emit('form-submitted', response)
    })
}

const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],
    ['blockquote', 'code-block'],

    [{ 'font': [] }],
    [{ 'indent': '-1'}, { 'indent': '+1' }, { 'align': [] }],

    [{ 'size': ['small', false, 'large', 'huge'] }],
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [{ 'color': [] }, { 'background': [] }],

    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    ['image', 'video'],
    [{ 'script': 'sub'}, { 'script': 'super' }],
    [{ 'direction': 'rtl' }],

    ['clean']
]

const handleFormQuillFollowSocial = (social) => {
    let tempImages = []
    let tempVideos = []
    const quill = new Quill(`#editor-container-${social}`, {
        modules: {
            imageResize: {
                displaySize: true
            },
            toolbar: toolbarOptions
        },
        placeholder: 'Compose an epic...',
        theme: 'snow'
    })

    const imageHandler = (value) => {
        if (value) {
            $(`#sPostImages${social}`).trigger('click')
        } else {
            quill.format('image', false)
        }
    }
    const videoHandler = (value) => {
        if (value) {
            $(`#sPostvideos${social}`).trigger('click')
        } else {
            quill.format('video', false)
        }
    }

    let toolbar = quill.getModule('toolbar')
    toolbar.addHandler('image', imageHandler)
    toolbar.addHandler('video', videoHandler)

    $(`#sPostImages${social}`).change(function(e) {
        if (e.target.files.length !== 0) {
            let reader = new FileReader()

            reader.readAsDataURL(e.target.files[0])

            reader.onloadend = () => {
                let base64data = reader.result
                tempImages.push(base64data)

                // Get cursor location
                let length = quill.getSelection().index

                // Insert image at cursor location
                quill.insertEmbed(length, 'image', base64data)

                // Set cursor to the end
                quill.setSelection(length + 1)
            }
        }
        return {
            quill,
            images: tempImages,
            videos: tempVideos
        }
    })

    $(`#sPostvideos${social}`).change(function(e) {
        if (e.target.files.length !== 0) {
            let reader = new FileReader()

            reader.readAsDataURL(e.target.files[0])

            reader.onloadend = (event) => {
                let base64data = reader.result
                tempVideos.push(base64data)
                console.log('upload video')

                // Get cursor location
                let length = quill.getSelection().index

                // Insert image at cursor location
                quill.insertEmbed(length, 'video', base64data)

                $('iframe[src="about:blank"].ql-video').each(function () {
                    $(this).attr('src', base64data)
                })

                // Set cursor to the end
                quill.setSelection(length + 1)
            }
        }
        return {
            quill,
            images: tempImages,
            videos: tempVideos
        }
    })

    return {
        quill,
        images: tempImages,
        videos: tempVideos
    }
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
                        objData.value[elt.id] = handleFormQuillFollowSocial(elt.name)

                        $('#sFacebookGroupsSelected').select2({
                            placeholder: 'Choose groups here...'
                        })
                        $('#sFacebookPagesSelected').select2({
                            placeholder: 'Choose pages here...'
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
        <div class="form-group col-12 mb-5">
            <InputLabel for="sCategory" value="Category"/>
            <select id="sCategory" class="selectpicker form-control" data-live-search="true" data-size="6" :class="{'is-invalid': form.errors.category_id}" v-model="form.category_id">
                <option value="" disabled>-- Choose the category --</option>
                <template v-for="item in categories.data" :key="item.id">
                    <option :value="item.id">{{ item.name }}</option>
                </template>
            </select>
            <InputError class="mt-2" :message="form.errors.category_id"/>
        </div>

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
                        <div class="layout-top-spacing">
                            <InputLabel for="sFacebookPagesSelected" value="Pages"/>

                            <select id="sFacebookPagesSelected" class="form-control" multiple="multiple">
                                <option v-for="item in pages" :key="item.id" :value="item.id">{{ item.name }}</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.pages"/>
                        </div>

                        <div class="layout-top-spacing">
                            <InputLabel for="sFacebookGroupsSelected" value="Groups"/>

                            <select id="sFacebookGroupsSelected" class="form-control" multiple="multiple">
                                <option v-for="item in facebookGroups.data" :key="item.group_id" :value="item.group_id">{{ item.group_name }}</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.groups"/>
                        </div>
                    </template>

                    <div class="form-group mb-4 pt-2">
                        <div class="widget-content widget-content-area">
                            <div :id="`editor-container-${item.name}`"></div>
                            <InputError class="mt-2" :message="form.errors.content"/>
                        </div>
                        <input class="d-none" :id="`sPostImages${item.name}`" type="file" accept="image/*">
                        <input class="d-none" :id="`sPostvideos${item.name}`" type="file" accept="video/*">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style src="/resources/sass/plugins/bootstrap-select/bootstrap-select.min.scss" lang="scss"></style>
<style src="/resources/sass/plugins/jquery-step/jquery.steps.scss" lang="scss"></style>
<style src="/resources/sass/plugins/editors/quill/quill.snow.scss" lang="scss"></style>
<style src="/resources/sass/assets/components/tabs-accordian/custom-tabs.scss" lang="scss"></style>
<style src="/resources/sass/plugins/select2/select2.min.scss" lang="scss"></style>
