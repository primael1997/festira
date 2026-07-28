<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'

const props = defineProps({
    date: { type: String, default: null },
})

const now = ref(Date.now())
let timer = null

onMounted(() => {
    timer = setInterval(() => (now.value = Date.now()), 1000)
})

onBeforeUnmount(() => clearInterval(timer))

const units = computed(() => {
    if (!props.date) {
        return [
            { value: 23, label: 'Jours' },
            { value: 9, label: 'Heures' },
            { value: 17, label: 'Minutes' },
            { value: 3, label: 'Secondes' },
        ]
    }

    const diff = Math.max(0, new Date(props.date).getTime() - now.value)
    const total = Math.floor(diff / 1000)

    return [
        { value: Math.floor(total / 86400), label: 'Jours' },
        { value: Math.floor((total % 86400) / 3600), label: 'Heures' },
        { value: Math.floor((total % 3600) / 60), label: 'Minutes' },
        { value: total % 60, label: 'Secondes' },
    ]
})

const pad = (n) => String(n).padStart(2, '0')
</script>

<template>
    <div class="flex flex-wrap justify-center gap-6 lg:gap-12">
        <div
            v-for="unit in units"
            :key="unit.label"
            class="flex min-w-[150px] flex-col items-center gap-5 rounded-[20px] bg-white px-12 py-9 shadow-[0_4px_20px_rgba(91,33,182,0.19)]"
        >
            <span class="text-5xl font-extrabold leading-none text-black sm:text-[72px]">{{ pad(unit.value) }}</span>
            <span class="text-xl font-semibold text-gray-500 sm:text-2xl">{{ unit.label }}</span>
        </div>
    </div>
</template>
