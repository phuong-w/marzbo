<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    src: {
        type: String,
        required: true
    },
    alt: {
        type: String,
        default: 'Example Image',
    },
})

const imageUrl = computed(() => `/${props.src}`)
const altText = ref(props.alt)
</script>

<template>
    <img :src="imageUrl" :alt="altText">
</template>
