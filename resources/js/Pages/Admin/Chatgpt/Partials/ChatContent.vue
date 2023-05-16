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
        <div>
            <VueFeather type="meh" stroke="white" size="28" class="pr-3" />
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
        margin-right: 1rem;
    }

    .chat-box .bubble.me:before {
        left: -3px;
        background-color: #4361ee;
    }
</style>
