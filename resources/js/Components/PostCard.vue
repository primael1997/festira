<script setup>
defineProps({
    post: { type: Object, required: true },
})
</script>

<template>
    <article class="flex flex-col gap-3.5 rounded-[25px] bg-gray-500/[0.12] px-6 py-8 backdrop-blur-[1px]">
        <img :src="post.image" :alt="post.title" class="h-60 w-full rounded-[20px] object-cover" />
        <div class="flex items-center justify-between text-[15px] font-medium text-gray-500">
            <span>{{ post.date }}</span>
            <span>{{ post.category }}</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-700">{{ post.title }}</h3>
        <p class="text-base leading-relaxed text-[#040404]">{{ post.excerpt }}</p>
    </article>
</template>
