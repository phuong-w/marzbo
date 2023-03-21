<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('admin.category.store'));
};

</script>

<template>
    <Head title="Category" />
    <AdminLayout>
        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
            <form @submit.prevent="submit">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="layout-top-spacing mb-4">
                            <Link :href="route('admin.category.index')"
                               class="btn btn-gray">Cancel</Link>
                            <PrimaryButton class="btn btn-primary" :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>
                        <div class="form-group mb-4">
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
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
