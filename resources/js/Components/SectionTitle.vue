<script setup>
defineProps({
    eyebrow: { type: String, default: null },
    title: { type: String, required: true },
    align: { type: String, default: 'left' },
})
</script>

<template>
    <div :class="align === 'center' ? 'text-center' : 'text-left'">
        <p v-if="eyebrow" class="mb-2 text-sm font-semibold uppercase tracking-wider text-brand-600">
            {{ eyebrow }}
        </p>
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            {{ title }}
        </h2>
        <div v-if="$slots.default" class="mt-3 text-gray-600">
            <slot />
        </div>
    </div>
</template>
