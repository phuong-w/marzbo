<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import {useForm, usePage} from '@inertiajs/vue3'

defineProps({
    socialMedias: {
        type: Object,
        required: true
    },
    showMessage: {
        type: Boolean,
        required: true
    },
    messageRequired: {
        type: String,
        required: true
    }
})

const trans = usePage().props.trans


onMounted(() => {
    $('.tagging').select2({
        placeholder: trans.general.social_media.select_sub
    })
})

</script>

<template>
    <div class="layout-top-spacing">
        <InputLabel for="socialMediaSelected" :value="trans.general.social_media.select"/>

        <select id="socialMediaSelected" class="form-control tagging" multiple="multiple">
            <option v-for="item in socialMedias.data" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>

        <InputError v-if="showMessage" class="mt-2" :message="messageRequired"/>
    </div>
</template>

<style src="/resources/sass/plugins/select2/select2.min.scss" lang="scss"></style>
