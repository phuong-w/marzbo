<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import FirstStep from './Partials/Steps/Create/FirstStep.vue'
import SecondStep from './Partials/Steps/Create/SecondStep.vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import { computed, onMounted, ref, watch } from 'vue'

const props = defineProps({
    categories: {
        type: Object,
        required: true
    },
    socialMedias: {
        type: Object,
        required: true
    },
    facebookGroups: {
        type: Object,
        required: true
    }
})

const messageRequired = ref('Please select at least one social media.')
const socialMediaSelected = ref([])
const showMessage = ref(false)

const showFirstStep = ref(true)
const showSecondStep = ref(false)

const doneFirstStep = ref(false)
const doneSecondStep = ref(false)

const processing = ref(false)

const user = usePage().props.auth.user.data

const backToFirstStep = () => {
    showFirstStep.value = true
    showSecondStep.value = false

    doneFirstStep.value = false
    doneSecondStep.value = true
}

const nextToSecondStep = () => {
    const selectedOptionIds = $('#socialMediaSelected').val().map(item => parseInt(item))
    const selectedOptionsToAdd = props.socialMedias.data.filter(option => selectedOptionIds.includes(option.id))

    if (selectedOptionsToAdd.length !== 0) {
        socialMediaSelected.value = []
        socialMediaSelected.value.push(...selectedOptionsToAdd)

        showMessage.value = false

        showFirstStep.value = false
        showSecondStep.value = true

        doneFirstStep.value = true
        doneSecondStep.value = false
    } else {
        showMessage.value = true
        showFirstStep.value = true
    }
}

const handleSubmit = () => {
    processing.value = true
}

const handleSubmitForm = (response) => {
    if (response) {
        console.log(response)
        processing.value = false
    } else {
        console.log('321')
        processing.value = true
    }
}

onMounted(() => {

})

</script>

<template>
    <Head title="Post" />
    <AdminLayout>
        <div class="col-12">
            <h1>Create post</h1>
        </div>

        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="pill wizard clearfix p-4">
                        <div class="steps clearfix">
                            <ul role="tablist">
                                <li @click="backToFirstStep" class="first" :class="{'current': showFirstStep, 'done': doneFirstStep}">
                                    <a href="javascript:" aria-controls="form-wizard-p-0">
                                        <span class="number">1</span> Select social media
                                    </a>
                                </li>
                                <li @click="nextToSecondStep" class="last" :class="{'current': showSecondStep, 'disabled': !showSecondStep && !doneSecondStep, 'done': doneSecondStep}">
                                    <a href="javascript:">
                                        <span class="number">2</span> Write content
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="pill wizard clearfix">
                            <FirstStep v-show="showFirstStep" :socialMedias="socialMedias" :showMessage="showMessage" :messageRequired="messageRequired"/>

                            <SecondStep v-show="showSecondStep" :socialMediaSelected="socialMediaSelected" :categories="categories" :facebookGroups="facebookGroups" :submitForm="processing" @form-submitted="handleSubmitForm"/>
                        </div>

                        <div class="actions clearfix">
                            <ul>
                                <li :class="{'disabled': showFirstStep}" @click="backToFirstStep">
                                    <a href="javascript:">Previous</a>
                                </li>
                                <li v-if="showFirstStep" @click="nextToSecondStep">
                                    <a href="javascript:">Next</a>
                                </li>
                                <li v-else :class="{'disabled': processing}" @click="handleSubmit">
                                    <a href="javascript:">Finish</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
