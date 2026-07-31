<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import AppButton from '@/Components/AppButton.vue'
import PostCard from '@/Components/PostCard.vue'

const props = defineProps({
    posts: { type: Object, required: true },
    categories: { type: Array, default: () => [] },
    filters: { type: Object, default: () => ({}) },
})

const search = ref(props.filters.search ?? '')

const visit = (params) => {
    router.get(route('actualites.index'), params, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    })
}

const submitSearch = () => visit({ search: search.value || undefined, category: props.filters.category })
const filterByCategory = (category) => visit({ search: search.value || undefined, category })
</script>

<template>
    <Head title="Actualités" />

    <PublicLayout>
        <section class="py-8 sm:py-12">
            <Container>
                <img src="/images/about-us.jpg" alt="" class="h-[280px] w-full rounded-[40px] object-cover sm:h-[380px]" />

                <div class="mt-10 text-center">
                    <h1 class="text-4xl font-black text-ink sm:text-5xl">Nos Articles</h1>
                    <p class="mt-3 text-gray-600">Le FESTIRA-Agonlin offre de nombreux articles</p>
                </div>

                <form @submit.prevent="submitSearch" class="mx-auto mt-8 flex max-w-3xl gap-3">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Recherchez un article de votre choix"
                        class="w-full rounded-xl border-gray-200 bg-white px-5 py-3 text-gray-700 focus:border-brand-500 focus:ring-brand-500"
                    />
                    <AppButton type="submit" variant="primary" size="md">Recherche</AppButton>
                </form>

                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <button
                        type="button"
                        @click="filterByCategory(undefined)"
                        :class="['rounded-full px-4 py-2 text-sm font-medium transition', !filters.category ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200']"
                    >
                        Tous
                    </button>
                    <button
                        v-for="cat in categories"
                        :key="cat"
                        type="button"
                        @click="filterByCategory(cat)"
                        :class="['rounded-full px-4 py-2 text-sm font-medium transition', filters.category === cat ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200']"
                    >
                        {{ cat }}
                    </button>
                </div>

                <div v-if="posts.data.length" class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <PostCard v-for="post in posts.data" :key="post.slug" :post="post" />
                </div>
                <p v-else class="mt-16 text-center text-gray-500">Aucun article trouvé.</p>

                <div v-if="posts.links.length > 3" class="mt-12 flex flex-wrap justify-center gap-2">
                    <template v-for="(link, i) in posts.links" :key="i">
                        <Link
                            v-if="link.url"
                            :href="link.url"
                            preserve-scroll
                            :class="['rounded-lg px-4 py-2 text-sm transition', link.active ? 'bg-brand-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200']"
                            v-html="link.label"
                        />
                        <span v-else class="rounded-lg px-4 py-2 text-sm text-gray-400" v-html="link.label" />
                    </template>
                </div>
            </Container>
        </section>
    </PublicLayout>
</template>
