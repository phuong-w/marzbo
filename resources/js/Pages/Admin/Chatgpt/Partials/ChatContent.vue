<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import VueFeather from 'vue-feather'
import { marked } from 'marked'

const props = defineProps({
    content: Object,
})

const user = computed(() => usePage().props.auth.user.data)

</script>

<template>
    <div v-if="content.role === 'user'" class="d-flex align-items-start">
        <div>
            <img :src="user.avatar" alt="avatar" class="avatar-user-question">
        </div>
        <div class="bubble me" style="max-width: fit-content">
            <span v-html="marked.parse(content?.content)"></span>
        </div>
    </div>

    <div v-else class="d-flex align-items-start">
        <div class="box-icon-openai">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-openai" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M11.217 19.384a3.501 3.501 0 0 0 6.783 -1.217v-5.167l-6 -3.35"></path>
                <path d="M5.214 15.014a3.501 3.501 0 0 0 4.446 5.266l4.34 -2.534v-6.946"></path>
                <path d="M6 7.63c-1.391 -.236 -2.787 .395 -3.534 1.689a3.474 3.474 0 0 0 1.271 4.745l4.263 2.514l6 -3.348"></path>
                <path d="M12.783 4.616a3.501 3.501 0 0 0 -6.783 1.217v5.067l6 3.45"></path>
                <path d="M18.786 8.986a3.501 3.501 0 0 0 -4.446 -5.266l-4.34 2.534v6.946"></path>
                <path d="M18 16.302c1.391 .236 2.787 -.395 3.534 -1.689a3.474 3.474 0 0 0 -1.271 -4.745l-4.308 -2.514l-5.955 3.42"></path>
            </svg>
        </div>
        <div class="bubble you" style="max-width: fit-content">
            <span v-html="marked.parse(content?.content)"></span>
        </div>
    </div>
</template>

<style scoped>
    .avatar-user-question {
        width: 28px;
        height: 28px;
        border-radius: 4px;
        margin-right: 16px;
        margin-top: 5px;
    }

    .box-icon-openai {
        border-radius: 4px;
        margin-right: 15px;
        margin-top: 3px;
        color: #19C37D;
    }

    .icon-tabler-brand-openai {
        width: 30px;
        height: 30px;
    }

    .chat-box .bubble.me:before {
        left: -3px;
        background-color: #4361ee;
    }
</style>
