<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { onMounted } from 'vue'
import Multiselect from 'vue-multiselect'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'

const props = defineProps({
    role: {
        type: Object,
        required: true,
    },
    permissions: Object,
})

const form = useForm({
    name: props.role.data.name,
    permissions: []
})

onMounted(() => {
    form.permissions = props.role.data?.permissions
})

const submit = () => {
    form.put(route('admin.role.update', {
        role: props.role.data.id
    }))
}

</script>

<template>
    <Head title="Edit role" />
    <AdminLayout>
        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <form @submit.prevent="submit">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="layout-top-spacing mb-4">
                            <Link :href="route('admin.role.index')"
                               class="btn btn-gray">Cancel</Link>
                            <PrimaryButton class="btn btn-primary" :disabled="form.processing">
                                Update
                            </PrimaryButton>
                        </div>

                        <div class="form-group mb-4">
                            <InputLabel for="sName" value="Name"/>

                            <TextInput
                                id="sName"
                                type="text"
                                class="form-control"
                                v-model="form.name"
                                :class="{'is-invalid': form.errors.name}"
                            />

                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="form-group mb-4">
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
                    <div class="widget-content widget-content-area">
                        <h3 class="text-center mb-4">Permissions</h3>
                        <table id="dt-table" class="table style-3  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column text-center">ID</th>
                                <th>Name</th>
                                <th class="text-center dt-no-sorting">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in role.data.permissions" :key="item.id">
                                <td class="checkbox-column text-center">
                                    {{ item.id }}
                                </td>
                                <td>
                                    {{ item.name }}
                                </td>
                                <td class="text-center">
                                    <ul class="table-controls">

                                        <li>
                                            <Link :href="route('admin.role.edit', {role: item.id})" class="bs-tooltip"
                                                  data-toggle="tooltip" data-placement="top" title=""
                                                  data-original-title="edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-edit-2 p-1 br-6 mb-1">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </Link>
                                        </li>

                                        <li>
                                            <a class="bs-tooltip delete" data-toggle="tooltip" data-placement="top"
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
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
