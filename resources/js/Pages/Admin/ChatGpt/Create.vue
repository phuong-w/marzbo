<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import InputError from '@/components/InputError.vue'
import InputLabel from '@/components/InputLabel.vue'
import PrimaryButton from '@/components/PrimaryButton.vue'
import TextInput from '@/components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
    openai_api_key: '',
});

const submit = () => {
    form.post(route('admin.chat_gpt.add_api_key'));
};

</script>

<template>
    <Head title="Add Your API Key - Chat GPT" />
    <AdminLayout>
        <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-4 m-auto layout-spacing ">
            <form @submit.prevent="submit">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="form-row mb-4">
                            <div class="col">
                                <TextInput
                                    type="text"
                                    class="form-control"
                                    placeholder="Your Api Key"
                                    v-model="form.openai_api_key"
                                    autofocus
                                    :class="{'is-invalid': form.errors.openai_api_key}"
                                />

                                <InputError class="mt-2" :message="form.errors.openai_api_key"/>
                            </div>
                        </div>
                        <input type="submit" class="mb-2 btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 layout-spacing ">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Detailed instructions</h4>
                            <p class="pl-3">1. Vào <a target="_blank" style="color: #007bff" href="https://platform.openai.com/account/api-keys">https://platform.openai.com/account/api-keys</a> tạo API Key và copy.</p>
                            <p class="pl-3">2. Paste Key vào ô input trên và submit.</p>
                            <p class="pl-3">3. Bắt đầu hỏi chat GPT bất cứ điều gì.</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">

                        <a class="img-1" href="assets/img/1280x857.jpg" data-size="1600x1068" data-med="assets/img/1280x857.jpg" data-med-size="1024x683" data-author="Samuel Rohl">
                            <img src="https://www.wildlifearchives.com/wp-content/uploads/2020/03/cinque-torri-italy-most-beautiful-picture-1584449765kgn84-1280x857.jpg" alt="image-gallery">
                            <figure>This is dummy caption. It has been placed here solely to demonstrate the look and feel of finished, typeset text.</figure>
                        </a>

                        <a class="img-2" href="assets/img/1280x857.jpg" data-size="1600x1068" data-med="assets/img/1280x857.jpg" data-med-size="1024x683" data-author="Samuel Rohl">
                            <img src="https://www.wildlifearchives.com/wp-content/uploads/2020/03/cinque-torri-italy-most-beautiful-picture-1584449765kgn84-1280x857.jpg" alt="image-gallery">
                            <figure>This is dummy caption. It has been placed here solely to demonstrate the look and feel of finished, typeset text.</figure>
                        </a>

                        <a class="img-3" href="assets/img/1280x857.jpg" data-size="1600x1067" data-med="assets/img/1280x857.jpg" data-med-size="1024x683" data-author="Michael Hull">
                            <img src="https://www.wildlifearchives.com/wp-content/uploads/2020/03/cinque-torri-italy-most-beautiful-picture-1584449765kgn84-1280x857.jpg" alt="image-gallery">
                            <figure>Dummy caption. It's Greek to you. Unless, of course, you're Greek, in which case, it really makes no sense.</figure>
                        </a>

                        <a class="img-4" href="assets/img/1280x857.jpg" data-size="1600x1600" data-med="assets/img/1280x857.jpg" data-med-size="1024x1024" data-author="Folkert Gorter">
                            <img src="https://www.wildlifearchives.com/wp-content/uploads/2020/03/cinque-torri-italy-most-beautiful-picture-1584449765kgn84-1280x857.jpg" alt="image-gallery">
                            <figure>This is dummy caption.</figure>
                        </a>

                        <a class="img-5" href="assets/img/1280x857.jpg" data-size="1600x1067" data-med="assets/img/1280x857.jpg" data-med-size="1024x683" data-author="Thomas Lefebvre">
                            <img src="https://www.wildlifearchives.com/wp-content/uploads/2020/03/cinque-torri-italy-most-beautiful-picture-1584449765kgn84-1280x857.jpg" alt="image-gallery">
                            <figure>It's a dummy caption. He who searches for meaning here will be sorely disappointed.</figure>
                        </a>

                        <a class="img-6" href="assets/img/1280x857.jpg" data-size="1600x1067" data-med="assets/img/1280x857.jpg" data-med-size="1024x683" data-author="Thomas Lefebvre">
                            <img src="https://www.wildlifearchives.com/wp-content/uploads/2020/03/cinque-torri-italy-most-beautiful-picture-1584449765kgn84-1280x857.jpg" alt="image-gallery">
                            <figure>It's a dummy caption. He who searches for meaning here will be sorely disappointed.</figure>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
