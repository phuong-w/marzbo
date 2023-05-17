<script setup>
import ToastListItem from '@/components/ToastListItem.vue'
const props = defineProps({
    type: String,
    message: String
})

const emit = defineEmits(['remove'])
</script>
<template>
    <div>
        <!--Success notification-->
        <div v-if="type === 'success'" class="tw-flex tw-items-center tw-p-4 tw-mb-4 tw-text-gray-500 tw-bg-white tw-rounded-lg tw-shadow tw-dark:tw-text-gray-400 tw-dark:tw-bg-gray-800" role="alert">
            <div class="tw-inline-flex tw-items-center tw-justify-center tw-flex-shrink-0 tw-w-8 tw-h-8 tw-text-green-500 tw-bg-green-100 tw-rounded-lg tw-dark:tw-bg-green-800 tw-dark:tw-text-green-200">
                <svg aria-hidden="true" class="tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span class="tw-sr-only">Check icon</span>
            </div>
            <div class="tw-ml-3 tw-text-sm tw-font-normal">{{ props.message }}</div>
            <button @click="emit('remove')" type="button" class="tw-ml-auto tw--mx-1.5 tw--my-1.5 tw-bg-white tw-text-gray-400 tw-hover:tw-text-gray-900 tw-rounded-lg tw-focus:tw-ring-2 tw-focus:tw-ring-gray-300 tw-p-1.5 tw-hover:tw-bg-gray-100 tw-inline-flex tw-h-8 tw-w-8 tw-dark:tw-text-gray-500 tw-dark:hover:tw-text-white tw-dark:tw-bg-gray-800 tw-dark:hover:tw-bg-gray-700 tw-border-none" aria-label="Close">
                <span class="tw-sr-only">Close</span>
                <svg aria-hidden="true" class="tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>

        <!--Error notification-->
        <div v-if="type === 'error'" class="tw-flex tw-items-center tw-p-4 tw-mb-4 tw-text-gray-500 tw-bg-white tw-rounded-lg tw-shadow tw-dark:tw-text-gray-400 tw-dark:tw-bg-gray-800" role="alert">
            <div class="tw-inline-flex tw-items-center tw-justify-center tw-flex-shrink-0 tw-w-8 tw-h-8 tw-text-red-500 tw-bg-red-100 tw-rounded-lg tw-dark:tw-bg-red-800 tw-dark:tw-text-red-200">
                <svg aria-hidden="true" class="tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="tw-ml-3 tw-text-sm tw-font-normal">{{ props.message }}</div>
            <button @click="emit('remove')" type="button" class="tw-ml-auto tw--mx-1.5 tw--my-1.5 tw-bg-white tw-text-gray-400 tw-hover:tw-text-gray-900 tw-rounded-lg tw-focus:tw-ring-2 tw-focus:tw-ring-gray-300 tw-p-1.5 tw-hover:tw-bg-gray-100 tw-inline-flex tw-h-8 tw-w-8 tw-dark:tw-text-gray-500 tw-dark:tw-hover:tw-text-white tw-dark:tw-bg-gray-800 tw-dark:tw-hover:tw-bg-gray-700 tw-border-none" aria-label="Close">
                <span class="tw-sr-only">Close</span>
                <svg aria-hidden="true" class="tw-w-5 tw-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </div>
</template>
