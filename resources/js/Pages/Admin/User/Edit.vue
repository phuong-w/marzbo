<script setup>
import {Link, useForm} from '@inertiajs/vue3'
import { inject, onMounted } from 'vue'
import InputError from '@/components/InputError.vue'
import TextInput from '@/components/TextInput.vue'
import InputLabel from '@/components/InputLabel.vue'
import {hasPermission} from '@/composables/helpers'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Multiselect from 'vue-multiselect'

const Acl = inject('Acl')

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    roles: Object
})

const form = useForm({
    first_name: props.user.data.first_name,
    last_name: props.user.data.last_name,
    phone: props.user.data.phone,
    roles: [],
});

const submit = () => {
    form.put(route('admin.user.update', {
        user: props.user.data.id
    }))
}

onMounted(() => {
    form.roles = props.user.data.roles
})
</script>
<template>
    <AdminLayout>
        <div class="col-lg-8 col-sm-12 col-12 layout-spacing">
        <form @submit.prevent="submit">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="col-12">
                        <div class="layout-top-spacing mb-4">
                            <Link :href="route('admin.user.index')" class="btn btn-gray mr-2">Cancel</Link>
                            <button type="submit" class="btn btn-primary" :disabled="form.processing">Update</button>
                        </div>
                        <div class="row">
                            <div class="form-group mb-4 col-md-6">
                                <InputLabel for="sFirstName" value="First name"/>

                                <TextInput
                                    id="sFirstName"
                                    type="text"
                                    class="form-control"
                                    v-model="form.first_name"
                                    placeholder="First name"
                                    :class="{'is-invalid': form.errors.first_name}"
                                />

                                <InputError class="mt-2" :message="form.errors.first_name"/>
                            </div>
                            <div class="form-group mb-4 col-md-6">
                                <InputLabel for="sLastName" value="Last name"/>

                                <TextInput
                                    id="sLastName"
                                    type="text"
                                    class="form-control"
                                    v-model="form.last_name"
                                    placeholder="Last name"
                                    :class="{'is-invalid': form.errors.last_name}"
                                />

                                <InputError class="mt-2" :message="form.errors.last_name"/>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <InputLabel for="sEmail" value="Email"/>

                            <TextInput
                                id="sEmail"
                                type="text"
                                class="form-control"
                                placeholder="Email"
                                :value="user.data.email"
                                disabled="disabled"
                            />
                        </div>

                        <div class="form-group mb-4">
                            <InputLabel for="sPhone" value="Phone"/>

                            <TextInput
                                id="sPhone"
                                type="text"
                                class="form-control"
                                v-model="form.phone"
                                placeholder="Phone"
                                :class="{'is-invalid': form.errors.phone}"
                            />

                            <InputError class="mt-2" :message="form.errors.phone"/>
                        </div>

                        <div class="form-group mb-4" v-if="hasPermission(Acl.PERMISSION_ASSIGNEE)">
                            <label for="sRolePicker">User role</label>
                            <Multiselect
                                :class="{'is-invalid': form.errors.roles}"
                                v-model="form.roles"
                                :options="roles.data"
                                :multiple="true"
                                :close-on-select="true"
                                placeholder="Pick role"
                                label="name"
                                track-by="name"
                            />

                            <InputError class="mt-2" :message="form.errors.roles"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
