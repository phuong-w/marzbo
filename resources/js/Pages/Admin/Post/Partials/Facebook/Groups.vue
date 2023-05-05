<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/components/InputLabel.vue'
import InputError from '@/components/InputError.vue'
import { useForm } from '@inertiajs/vue3'

// defineProps({
//     groups: {
//         type: Object,
//         required: true
//     }
// })

const groups = ref([
    {
        id: 1,
        name: 'Group 1'
    },
    {
        id: 2,
        name: 'Group 2'
    },
    {
        id: 3,
        name: 'Group 3'
    }
])

onMounted(() => {
    $('.tagging').select2({
        placeholder: 'Choose group here'
    })
})

</script>

<template>
    <div class="layout-top-spacing">
        <InputLabel for="socialMediaSelected" value="Choose group media"/>

        <select id="socialMediaSelected" class="form-control" multiple="multiple">
            <option v-for="item in groups" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>

        <InputError class="mt-2" :message="form.errors.category_id"/>
    </div>
</template>

<style src="/resources/sass/plugins/select2/select2.min.scss" lang="scss"></style>
