<script setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import PostCard from '@/Components/PostCard.vue'

const props = defineProps({
    post: { type: Object, required: true },
    related: { type: Array, default: () => [] },
})

const shareIcons = [
    '/images/social/facebook.svg',
    '/images/social/instagram.svg',
    '/images/social/linkedin.svg',
]

const readTime = computed(() => {
    const text = (props.post.content ?? '').replace(/<[^>]+>/g, ' ')
    const words = text.trim().split(/\s+/).filter(Boolean).length
    return Math.max(1, Math.round(words / 200))
})
</script>

<template>
    <Head :title="post.title" />

    <PublicLayout>
        <article class="py-10 sm:py-14">
            <Container>
                <div class="mx-auto max-w-4xl">
                    <p class="text-center text-sm font-medium text-gray-500">
                        {{ post.date }}
                        <span v-if="post.category"> · {{ post.category }}</span>
                        · {{ readTime }} min de lecture
                    </p>
                    <h1 class="mt-4 text-center text-3xl font-black leading-tight text-ink sm:text-4xl">
                        {{ post.title }}
                    </h1>

                    <img :src="post.image" :alt="post.title" class="mt-8 h-[320px] w-full rounded-[30px] object-cover sm:h-[460px]" />

                    <div
                        class="mt-10 text-gray-700 [&>h2]:mb-3 [&>h2]:mt-8 [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:text-ink [&>p]:mb-4 [&>p]:leading-relaxed"
                        v-html="post.content"
                    />

                    <div class="mt-10 flex items-center gap-5 border-t border-gray-100 pt-6">
                        <span class="text-sm font-medium text-gray-500">Partager :</span>
                        <a v-for="(icon, i) in shareIcons" :key="i" href="#" class="opacity-70 transition hover:opacity-100">
                            <img :src="icon" alt="" class="h-6 w-6 [filter:brightness(0)]" />
                        </a>
                    </div>
                </div>
            </Container>
        </article>

        <section v-if="related.length" class="py-10 sm:py-16">
            <Container>
                <div class="mb-10 flex items-center gap-4">
                    <span class="h-0.5 w-12 bg-brand-600"></span>
                    <h2 class="text-2xl font-bold text-ink sm:text-3xl">Posts similaires</h2>
                </div>
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <PostCard v-for="item in related" :key="item.slug" :post="item" />
                </div>
            </Container>
        </section>
    </PublicLayout>
</template>
