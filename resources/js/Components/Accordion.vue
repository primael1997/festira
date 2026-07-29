<script setup>
import { ref } from 'vue'

defineProps({
    items: { type: Array, default: () => [] },
    variant: { type: String, default: 'filled' },
})

const openIndex = ref(0)
const toggle = (i) => (openIndex.value = openIndex.value === i ? -1 : i)
</script>

<template>
    <div :class="variant === 'filled' ? 'space-y-3' : 'divide-y divide-gray-200'">
        <div
            v-for="(item, i) in items"
            :key="i"
            :class="variant === 'filled' ? 'overflow-hidden rounded-xl bg-blush-50' : ''"
        >
            <button
                type="button"
                @click="toggle(i)"
                class="flex w-full items-center justify-between gap-4 px-4 py-4 text-left sm:px-6"
            >
                <span class="flex flex-col gap-1">
                    <span v-if="item.label" class="w-fit border-b-2 border-brand-600 pb-0.5 text-sm font-semibold text-ink">{{ item.label }}</span>
                    <span class="font-semibold" :class="openIndex === i ? 'text-brand-600' : 'text-ink'">{{ item.title ?? item.question }}</span>
                    <span v-if="item.meta" class="text-xs font-medium uppercase text-gray-400">{{ item.meta }}</span>
                </span>
                <span
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xl text-gray-400"
                    :class="variant === 'plain' ? 'border border-gray-200' : ''"
                >
                    {{ openIndex === i ? '−' : '+' }}
                </span>
            </button>
            <div v-show="openIndex === i" class="px-4 pb-4 text-gray-600 sm:px-6">
                <ul v-if="item.points" class="list-disc space-y-1.5 pl-5 text-sm">
                    <li v-for="(point, p) in item.points" :key="p">{{ point }}</li>
                </ul>
                <p v-else class="text-sm leading-relaxed">{{ item.answer }}</p>
            </div>
        </div>
    </div>
</template>
