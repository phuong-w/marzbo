<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue'
import InputError from '@/components/InputError.vue'
import {Head, Link, useForm, usePage} from '@inertiajs/vue3'
import { onMounted } from 'vue'
import { reloadPageWithParamRefresh } from '@/composables/helpers'

const form = useForm({
    first_name: '',
    last_name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: '',
});

const trans = usePage().props.trans

const submit = () => {
    form.post(route('admin.register'), {
        onFinish: () => form.reset('password', 'password_confirmation', 'terms'),
    })
}

onMounted(() => {
    reloadPageWithParamRefresh()
})

</script>

<template>
    <Head title="Register" />
    <AuthLayout>
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="">{{ trans.general.register.title }}</h1>
                    <p class="signup-link register">{{ trans.general.register.subtitle }} <Link :href="route('admin.login.show-form')">{{ trans.general.register.button.login }} </Link></p>
                    <form @submit.prevent="submit" class="text-left">
                        <div class="form">
                            <div class="box-fullname">
                                <div id="first_name" class="field-wrapper input">
                                    <label for="first_name">
                                        {{ trans.general.register.first_name }}
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input v-model="form.first_name" id="first_name" name="first_name" type="text" class="form-control" :placeholder="trans.general.register.first_name" dusk="first_name">
                                    <InputError class="mt-2" :message="form.errors.first_name"/>
                                </div>

                                <div class="field-wrapper input">
                                    <label for="last_name">
                                        {{ trans.general.register.last_name }}
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input v-model="form.last_name" id="last_name" name="last_name" type="text" class="form-control" :placeholder="trans.general.register.last_name" dusk="last_name">
                                    <InputError class="mt-2" :message="form.errors.last_name"/>
                                </div>
                            </div>
                            <div id="phone-field" class="field-wrapper input">
                                <label for="phone">
                                    {{ trans.general.register.phone }}
                                </label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smartphone"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                                <input v-model="form.phone" id="phone" name="phone" type="text" class="form-control" :placeholder="trans.general.register.phone">
                                <InputError class="mt-2" :message="form.errors.phone" dusk="phone"/>
                            </div>

                            <div id="email-field" class="field-wrapper input">
                                <label for="email">EMAIL</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input v-model="form.email" id="email" name="email" type="text" class="form-control" placeholder="Email" dusk="email">
                                <InputError class="mt-2" :message="form.errors.email"/>
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">
                                        {{ trans.general.register.password }}
                                    </label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input v-model="form.password" id="password" name="password" type="password" class="form-control" :placeholder="trans.general.register.password" dusk="password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">
                                        {{ trans.general.register.password_confirmation }}
                                    </label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input v-model="form.password_confirmation" id="password" name="password" type="password" class="form-control" :placeholder="trans.general.register.password_confirmation" dusk="password_confirmation">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                            </div>

                            <div class="field-wrapper terms_condition">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input v-model="form.terms" type="checkbox" class="new-control-input" name="terms" id="terms">
                                        <span class="new-control-indicator"></span>
                                        <span>{{ trans.general.register.cb_text.start }}
                                            <a href="javascript:void(0);">  {{ trans.general.register.cb_text.terms }} {{ trans.general.register.cb_text.between }} {{ trans.general.register.cb_text.policy }} {{ trans.general.register.cb_text.end }}
                                            </a>
                                        </span>
                                    </label>
                                    <InputError class="mt-2" :message="form.errors.terms"/>
                                </div>

                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" dusk="register">{{ trans.general.register.button.submit }} </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<style scoped>
.form-form .form-form-wrap {
    max-width: 646px !important;
}
.box-fullname {
    display: flex;
}

.box-fullname #first_name {
    padding-right: 12px;
}

.new-control.new-checkbox .new-control-indicator {
    width: 18px;
    height: 18px;
    border-radius: 3px;
}
</style>
