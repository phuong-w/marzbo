<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import Multiselect from 'vue-multiselect'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'

defineProps({
    permissions: Object,
})

const form = useForm({
    name: '',
    permissions: []
})

const submit = () => {
    form.post(route('admin.role.store'))
}

</script>

<template>
    <Head title="Create role" />
    <AdminLayout>
        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <form @submit.prevent="submit">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="layout-top-spacing col-12 mb-4">
                            <Link :href="route('admin.role.index')"
                               class="btn btn-gray mr-2">Cancel</Link>
                            <PrimaryButton class="btn btn-primary" :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>

                        <div class="form-group col-12 mb-4">
                            <InputLabel for="sName" value="Name"/>

                            <TextInput
                                id="sName"
                                type="text"
                                class="form-control"
                                v-model="form.name"
                                autofocus
                                :class="{'is-invalid': form.errors.name}"
                            />

                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="form-group col-12 mb-4">
                            <InputLabel for="sPermissions" value="Permissions"/>

                            <Multiselect
                                v-model="form.permissions"
                                :options="permissions.data"
                                :multiple="true"
                                :close-on-select="true"
                                placeholder="Pick some"
                                label="name"
                                track-by="id"
                            />

                            <InputError class="mt-2" :message="form.errors.permissions"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
