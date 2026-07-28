<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    post: { type: Object, required: true },
})

const target = props.post.slug ? route('actualites.show', props.post.slug) : null
</script>

<template>
    <component
        :is="target ? Link : 'article'"
        :href="target"
        class="flex flex-col gap-3.5 rounded-[25px] bg-gray-500/[0.12] px-6 py-8 backdrop-blur-[1px] transition hover:shadow-lg"
    >
        <img :src="post.image" :alt="post.title" class="h-60 w-full rounded-[20px] object-cover" />
        <div class="flex items-center justify-between text-[15px] font-medium text-gray-500">
            <span>{{ post.date }}</span>
            <span>{{ post.category }}</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-700">{{ post.title }}</h3>
        <p class="text-base leading-relaxed text-[#040404]">{{ post.excerpt }}</p>
    </component>
</template>
