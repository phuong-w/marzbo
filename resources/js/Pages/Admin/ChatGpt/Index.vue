<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, usePage, useForm } from '@inertiajs/vue3'
import { inject, ref, onMounted, computed } from 'vue'
import VueFeather from 'vue-feather'
import { hasRole, hasPermission} from '@/composables/helpers'
import ChatContent from '@/Pages/Admin/ChatGpt/Partials/ChatContent.vue'
import Skeleton from '@/components/Skeleton.vue'

const Acl = inject('Acl')

const promtInput = ref(null)
const chatContainer = ref(null)
const showConfirmDelete = ref(false)

const props = defineProps({
    messages: Array,
    chatGpt: null | Object
})

const form = useForm({
    promt: ''
})

const submit = () => {
    const url = props.chatGpt ? route('admin.chat_gpt.store', props.chatGpt.uuid) : route('admin.chat_gpt.store')
    form.post(url, {
        onFinish: () => clear()
    })
}

const scrollToBottom = () => {
    if (props.chatGpt) {
        const el = chatContainer.value
        el.scrollTop = el.scrollHeight
    }
}

const clear = () => {
    form.promt = ''
    promtInput.value?.focus()
    scrollToBottom()
}

onMounted(() => {
    clear()
})

const user = computed(() => usePage().props.auth.user.data)
const title = computed(() => props.chatGpt?.context[0].content ?? 'New Chat')

</script>

<template>
    <Head :title="`${title} - Chat GPT`" />
    <AdminLayout>
        <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="chat-system">
            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
            <div class="user-list-box" v-if="user.openai_api_key">
                <div class="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <Link :href="route('admin.chat_gpt.index')" class="btn-new-chat">
                        New chat
                    </Link>
                </div>
                <div class="people">
                    <template v-for="(message, index) in messages" :key="message.id">
                        <Link :href="route('admin.chat_gpt.index', message.uuid)">
                            <div class="person item-question" :class="{'active' : route().current('admin.chat_gpt.index', message.uuid), 'border-none' : index == messages.length - 1}">
                                <div class="user-info d-flex align-items-center">
                                    <div class="f-head d-flex">
                                        <VueFeather type="message-square" size="16" class="pr-2 mb-1" />
                                    </div>
                                    <div class="f-body d-flex">
                                        <!--                                <div class="meta-info">-->
                                        <!--                                    <span class="user-name" data-name="Alma Clarke">Alma Clarke</span>-->
                                        <!--                                    <span class="user-meta-time">1:44 PM</span>-->
                                        <!--                                </div>-->
                                        <span class="preview">{{ message.context[0].content }}</span>
                                    </div>
                                    <template v-if="route().current('admin.chat_gpt.index', message.uuid)">
                                        <div v-if="!showConfirmDelete" class="d-flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 s-task-edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>

                                            <svg @click.stop.prevent="showConfirmDelete = !showConfirmDelete" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 s-task-delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </div>
                                        <div v-if="showConfirmDelete" class="d-flex">
                                            <Link :href="route('admin.chat_gpt.destroy', chatGpt?.uuid)" method="DELETE" as="button" class="as-button d-flex p-0 b-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </Link>

                                            <svg @click.stop.prevent="showConfirmDelete = !showConfirmDelete" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </Link>
                    </template>

                </div>
            </div>
            <div class="chat-box">

                <div class="chat-not-selected" v-if="!user.openai_api_key">
                    <Link :href="route('admin.chat_gpt.create')" class="d-flex">
                        <p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg> Add Your Api Key</p>
                    </Link>
                </div>

                <div class="chat-box-inner d-block" v-if="user.openai_api_key">
                    <div class="chat-conversation-box" ref="chatContainer">
                        <!-- Chat content -->
                        <div class="chat-conversation-box-scroll">
                            <div class="chat active-chat col-sm-12 col-md-12 col-lg-12 col-xl-9 mx-auto">
                                <div class="conversation-start">
                                    <!--                                    <span>Today, 6:48 AM</span>-->
                                </div>

                                <template v-for="(content, index) in chatGpt?.context" :key="index">
                                    <ChatContent :content="content" />
                                </template>
                                <Skeleton v-show="form.processing" />
                                <div class="mb-5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-footer chat-active">
                        <div class="chat-input">
                            <form class="chat-form" action="javascript:void(0);">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <input type="text" class="mail-write-box form-control" placeholder="Enter any question" v-model="form.promt" :disabled="form.processing" ref="promtInput" @keyup.enter="submit"/>

                                <svg v-if="!form.processing" @click="submit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                <div v-if="form.processing" class="dot-typing d-content"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </AdminLayout>
</template>

<style scoped>

    svg.feather-edit-2, svg.feather-check {
        margin-right: 6px;
    }

    svg.feather-edit-2, svg.feather-check, svg.feather-x {
        color: #888ea8;
        vertical-align: middle;
        fill: rgba(0, 23, 55, 0.08);
    }

    svg.feather-check:hover  {
        color: #1abc9c;
        fill: rgba(27, 85, 226, 0.23921568627450981);
    }

    svg.feather-edit-2:hover, svg.feather-x:hover  {
        color: #4361ee;
        fill: rgba(27, 85, 226, 0.23921568627450981);
    }

    svg.feather-trash-2 {
        color: #e7515a;
        vertical-align: middle;
        fill: rgba(231, 81, 90, 0.14);
    }

    svg.feather-trash-2:hover {
        fill: rgba(231, 81, 90, 0.37);
    }

    .item-question:hover {
        background-color: lavender;
    }

    .item-question.active {
        background-color: lavender;
    }

    .chat-box {
        height: calc(100vh - 232px);
    }

    .chat-box .chat-box-inner {
        height: 100%
    }

    .chat-conversation-box {
        height: calc(100% - 6px) !important;
    }

    .feather-send {
        cursor: pointer;
        left: calc(100% - 34px) !important;
    }

    .btn-new-chat {
        border-radius: 4px;
        font-size: 16px;
        width: 100%;
        outline: none;
        padding: 12px 16px 12px 43px;
        background: #f1f2f3;
        margin: 0 20px 0 20px;
        border: 1px dashed #888ea8;
        cursor: pointer;
    }

    .delete-item:hover {
        color: #e7515a;
    }

    .dot-typing {
        position: absolute;
        left: calc(100% - 42px);
        top: 50%;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: #9880ff;
        color: #9880ff;
        box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
        15px 0 0 0 #9880ff;
        animation: dot-typing 1.5s infinite linear;
    }
    @keyframes dot-typing {
        0% {
            box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px 0 0 0 #9880ff;
        }
        16.667% {
            box-shadow: -15px -10px 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px 0 0 0 #9880ff;
        }
        33.333% {
            box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px 0 0 0 #9880ff;
        }
        50% {
            box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px 0 0 0 #9880ff;
        }
        66.667% {
            box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px 0 0 0 #9880ff;
        }
        83.333% {
            box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px -10px 0 0 #9880ff;
        }
        100% {
            box-shadow: -15px 0 0 0 #9880ff, 0 0 0 0 #9880ff,
            15px 0 0 0 #9880ff;
        }
    }
</style>
