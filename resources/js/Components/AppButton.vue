<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    href: { type: String, default: null },
    variant: { type: String, default: 'primary' },
    size: { type: String, default: 'md' },
    type: { type: String, default: 'button' },
})

const variants = {
    primary: 'bg-brand-600 text-white hover:bg-brand-700 focus-visible:outline-brand-600',
    dark: 'bg-gray-900 text-white hover:bg-black focus-visible:outline-gray-900',
    light: 'bg-white text-brand-700 hover:bg-brand-50 focus-visible:outline-white',
    outline: 'border border-brand-600 text-brand-700 hover:bg-brand-50 focus-visible:outline-brand-600',
    ghost: 'text-brand-700 hover:bg-brand-50 focus-visible:outline-brand-600',
}

const sizes = {
    sm: 'px-3 py-1.5 text-sm',
    md: 'px-5 py-2.5 text-sm',
    lg: 'px-7 py-3 text-base',
}

const classes = computed(() => [
    'inline-flex items-center justify-center gap-2 rounded-xl font-semibold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:opacity-50',
    variants[props.variant],
    sizes[props.size],
])

const isPlainLink = computed(() => props.href && /^(https?:|#|mailto:|tel:)/.test(props.href))
const isExternalUrl = computed(() => props.href && /^https?:/.test(props.href))
const component = computed(() => (props.href ? (isPlainLink.value ? 'a' : Link) : 'button'))
</script>

<template>
    <component
        :is="component"
        :href="href"
        :type="href ? undefined : type"
        :target="isExternalUrl ? '_blank' : undefined"
        :rel="isExternalUrl ? 'noopener' : undefined"
        :class="classes"
    >
        <slot />
    </component>
</template>
