<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue'
import InputError from '@/components/InputError.vue'
import {Head, Link, useForm, usePage} from '@inertiajs/vue3'

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const trans = usePage().props.trans

const submit = () => {
    form.post(route('admin.login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login"/>
    <AuthLayout>
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
        <h1 class="">{{ trans.general.login.title }}</h1>
        <p class="">{{ trans.general.login.subtitle }}</p>

        <form @submit.prevent="submit" class="text-left">
            <div class="form">
                <div id="username-field" class="field-wrapper input">
                    <label for="email">Email</label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input id="email" name="email" type="text"
                           class="form-control"
                           placeholder="e.g john_doe@gmail.com" v-model="form.email">
                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>

                <div id="password-field" class="field-wrapper input mb-2">
                    <div class="d-flex justify-content-between">
                        <label for="password">{{ trans.general.login.password }}</label>
<!--                        <a href="auth_pass_recovery_boxed.html" class="forgot-pass-link">-->
<!--                            {{ trans.general.login.password }}-->
<!--                        </a>-->
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                        <rect x="3" y="11" width="18" height="11" rx="2"
                              ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input id="password" name="password" type="password"
                           class="form-control" v-model="form.password"
                           placeholder="Password">
                    <InputError class="mt-2" :message="form.errors.password"/>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                         class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </div>

                <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper">
                        <button type="submit" class="btn btn-primary">
                            {{ trans.general.login.button.submit }}
                        </button>
                    </div>
                </div>

                <p class="signup-link">{{ trans.general.login.question }} <Link :href="route('admin.register.show-form')">{{ trans.general.login.button.create }}</Link></p>

            </div>
        </form>

                </div>
            </div>
        </div>
    </AuthLayout>
</template>
