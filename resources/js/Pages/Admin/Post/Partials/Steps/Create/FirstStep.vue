<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import { useForm } from '@inertiajs/vue3'

defineProps({
    socialMedia: {
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

onMounted(() => {
    $('.tagging').select2({
        placeholder: 'Choose social media here'
    })
})

</script>

<template>
    <div class="layout-top-spacing">
        <InputLabel for="socialMediaSelected" value="Choose social media"/>

        <select id="socialMediaSelected" class="form-control tagging" multiple="multiple">
            <option v-for="item in socialMedia" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>

        <InputError v-if="showMessage" class="mt-2" :message="messageRequired"/>
    </div>
</template>

<style src="/resources/sass/plugins/select2/select2.min.scss" lang="scss"></style>
