<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import {onMounted} from 'vue'

const props = defineProps({
    schedule: {
        type: Object,
        required: true
    }
})

const form = useForm({
    publish_date: props.schedule.data.publish_date,
});

const submit = () => {
    form.put(route('admin.schedule.update', {
        schedule: props.schedule.data.id
    }))
}

onMounted(() => {
    const fp = flatpickr(document.getElementById('sSchedule'), {
        dateFormat: "Y-m-d H:i",
        minDate: 'today',
        enableTime: true,
        time_24hr: true,
        defaultHour: 12
    })
})

</script>

<template>
    <Head title="Category" />
    <AdminLayout>
        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <form @submit.prevent="submit">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="col-12">
                            <div class="layout-top-spacing mb-4">
                                <Link :href="route('admin.schedule.index')"
                                      class="btn btn-gray mr-2">Cancel</Link>
                                <PrimaryButton class="btn btn-primary" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-5">
                                <InputLabel for="sSchedule" value="Scheduled Time:"/>
                                <div class="form-group col-xl-2 col-lg-3 col-12">
                                    <input type="text" class="form-control mb-0 flatpickr flatpickr-input active form-control-sm" id="sSchedule" placeholder="Time..." v-model="form.publish_date">

                                    <InputError class="mt-2" :message="form.errors.publish_date"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
