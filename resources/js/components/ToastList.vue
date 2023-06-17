<script setup>
import ToastListItem from '@/components/ToastListItem.vue'
import {onMounted, onUnmounted, ref} from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const items = ref([])

const listenToasts = router.on('finish', () => {
    const page = usePage()

    if (page.props.flash.success) {
        items.value.unshift({
            key: Symbol(),
            type: 'success',
            message: page.props.flash.success
        })
    }

    if (page.props.flash.error) {
        items.value.unshift({
            key: Symbol(),
            type: 'error',
            message: page.props.flash.error
        })
    }
})

onUnmounted(() => listenToasts())

function remove(index) {
    items.value.splice(index, 1)
}
</script>
<template>
    <TransitionGroup
        tag="div"
        enter-from-class="tw-translate-x-full tw-opacity-0"
        enter-active-class="tw-duration-500"
        leave-active-class="tw-duration-500"
        leave-to-class="tw-translate-x-full tw-opacity-0"
        class="tw-fixed tw-z-50 tw-top-4 tw-right-4 tw-space-y-4 tw-w-full tw-max-w-xs">
        <ToastListItem
            v-for="(item, index) in items"
            :key="item.key"
            :type="item.type"
            :message="item.message"
            @remove="remove(index)"
        />
    </TransitionGroup>
</template>
