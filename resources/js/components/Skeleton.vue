<script setup>
import VueFeather from 'vue-feather'
</script>

<template>
    <div class="loading-skeleton">
        <div class="d-flex align-items-start">
            <div>
                <VueFeather type="meh" stroke="white" size="28" class="pr-3" />
            </div>
            <div class="you w-100">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control w-100" id="exampleFormControlTextarea1" rows="2"></textarea>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .loading-skeleton h1, .loading-skeleton h2, .loading-skeleton h3, .loading-skeleton h4, .loading-skeleton h5, .loading-skeleton h6, .loading-skeleton p, .loading-skeleton li, .loading-skeleton .btn, .loading-skeleton label, .loading-skeleton .form-control {
        color: transparent;
        appearance: none;
        -webkit-appearance: none;
        background-color: #eee;
        border-color: #eee;
    }
    .loading-skeleton h1::placeholder, .loading-skeleton h2::placeholder, .loading-skeleton h3::placeholder, .loading-skeleton h4::placeholder, .loading-skeleton h5::placeholder, .loading-skeleton h6::placeholder, .loading-skeleton p::placeholder, .loading-skeleton li::placeholder, .loading-skeleton .btn::placeholder, .loading-skeleton label::placeholder, .loading-skeleton .form-control::placeholder {
        color: transparent;
    }
    @keyframes loading-skeleton {
        from {
            opacity: 0.1;
        }
        to {
            opacity: 0.4;
        }
    }
    .loading-skeleton {
        pointer-events: none;
        animation: loading-skeleton 1s infinite alternate;
    }
    .loading-skeleton img {
        filter: grayscale(100) contrast(0%) brightness(1.8);
    }
</style>
