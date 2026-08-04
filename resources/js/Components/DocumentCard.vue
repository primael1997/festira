<script setup>
import AppButton from '@/Components/AppButton.vue'

defineProps({
    document: { type: Object, required: true },
})
</script>

<template>
    <article class="flex flex-col rounded-[25px] border border-brand-200 bg-white p-5">
        <img
            :src="document.image"
            :alt="document.title"
            class="h-52 w-full rounded-[18px] object-cover"
        />

        <h3 class="mt-4 text-xl font-bold text-brand-600">{{ document.title }}</h3>

        <div class="mt-auto pt-5">
            <AppButton :href="document.file" download variant="soft" size="md">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v4a1 1 0 001 1h4M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8l-5-5z" />
                    <path stroke-linecap="round" d="M9 13h6M9 17h4" />
                </svg>
                Télécharger
            </AppButton>
        </div>
    </article>
</template>
