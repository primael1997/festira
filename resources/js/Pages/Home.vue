<script setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import SectionTitle from '@/Components/SectionTitle.vue'
import AppButton from '@/Components/AppButton.vue'
import Countdown from '@/Components/Countdown.vue'
import PostCard from '@/Components/PostCard.vue'

const props = defineProps({
    banners: { type: Array, default: () => [] },
    posts: { type: Array, default: () => [] },
    galleryImages: { type: Array, default: () => [] },
    sponsors: { type: Array, default: () => [] },
    countdown: { type: Object, default: null },
})

const fallbackPosts = [
    {
        image: '/images/post-1.jpg',
        date: 'Février 26, 2026',
        category: 'Festira',
        title: 'Pourquoi Agonlin ?',
        excerpt: 'Un territoire au patrimoine riche, berceau de traditions que le festival met à l\'honneur chaque année.',
    },
    {
        image: '/images/post-2.jpg',
        date: 'Février 20, 2026',
        category: 'Festira',
        title: 'Un patrimoine vivant',
        excerpt: 'Musique, danses et savoir-faire se transmettent de génération en génération au cœur de la région.',
    },
    {
        image: '/images/post-3.jpg',
        date: 'Février 12, 2026',
        category: 'Festira',
        title: 'Rendez-vous à Cotonou',
        excerpt: 'La diaspora et les fils et filles d\'Agonlin se retrouvent pour célébrer ensemble leurs racines.',
    },
]

const fallbackGallery = Array.from({ length: 12 }, (_, i) => `/images/gallery-${i + 1}.jpg`)

const fallbackSponsors = Array.from({ length: 5 }, () => ({ name: 'Logo' }))

const displayedPosts = computed(() => (props.posts.length ? props.posts : fallbackPosts))
const displayedGallery = computed(() => (props.galleryImages.length ? props.galleryImages : fallbackGallery))
const displayedSponsors = computed(() => (props.sponsors.length ? props.sponsors : fallbackSponsors))

const mediaPoints = ['Un espace de partage culturel', 'Des rencontres et des échanges']
</script>

<template>
    <Head title="Accueil" />

    <PublicLayout>
        <section id="accueil" class="py-8 sm:py-12">
            <Container>
                <div class="relative overflow-hidden rounded-[40px]">
                    <img
                        src="/images/hero.png"
                        alt="Festival International Racines d'Agonlin"
                        class="h-full w-full object-cover"
                    />

                    <div class="absolute inset-0 flex items-center">
                        <div class="max-w-xl px-8 sm:px-12 lg:px-16">
                            <p class="flex items-center gap-2.5 text-lg font-semibold text-white drop-shadow">
                                Bienvenue sur notre site de billetterie !
                                <img src="/images/ticket.svg" alt="" class="h-[18px] w-6" />
                            </p>
                            <h1 class="mt-4 text-4xl font-black uppercase leading-[1.02] tracking-tight sm:text-6xl lg:text-7xl">
                                <span class="text-brand-600">Festival</span><br />
                                <span class="text-white drop-shadow-md">International</span><br />
                                <span class="text-white drop-shadow-md">Racines d'Agonlin</span>
                            </h1>
                            <div class="mt-8">
                                <AppButton href="#festira" variant="primary" size="lg">
                                    Découvrez l'événement
                                </AppButton>
                            </div>
                        </div>
                    </div>

                    <div class="absolute right-5 top-1/2 flex -translate-y-1/2 flex-col gap-2.5">
                        <span class="h-2.5 w-2.5 rounded-full bg-brand-600"></span>
                        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
                        <span class="h-2 w-2 rounded-full bg-gray-300"></span>
                    </div>
                </div>
            </Container>
        </section>

        <section id="festira" class="py-12 sm:py-16">
            <Container>
                <Countdown :date="countdown?.date" />

                <div class="relative mt-16 overflow-hidden rounded-[40px]">
                    <img src="/images/edition-bg.png" alt="" class="absolute inset-0 h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-brand-600/20"></div>
                    <div class="relative flex flex-col gap-16 px-8 py-12 sm:gap-24 sm:px-16 sm:py-16">
                        <div>
                            <h3 class="text-4xl font-black text-white sm:text-6xl">1<sup>ère</sup> Edition</h3>
                            <div class="mt-3 flex items-center gap-2.5 text-2xl font-medium text-white sm:text-3xl">
                                Agonlin, Cotonou
                                <img src="/images/map.svg" alt="" class="h-7 w-7" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                            <button type="button" class="group flex items-center gap-5 text-white">
                                <span class="flex h-20 w-20 items-center justify-center rounded-full bg-brand-600 ring-2 ring-white/50 transition group-hover:bg-brand-700 sm:h-[120px] sm:w-[120px]">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8 translate-x-0.5 sm:h-12 sm:w-12">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </span>
                                <span class="text-2xl font-medium sm:text-[28px]">Jouer la video</span>
                            </button>
                            <span class="text-2xl font-medium text-white">Février 27, 2025</span>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex justify-center">
                    <a
                        href="#"
                        class="inline-flex items-center gap-3 rounded-2xl bg-gray-900 px-8 py-5 text-lg font-semibold text-white transition hover:bg-black"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-4-4m4 4l4-4M5 19h14" />
                        </svg>
                        Document pour la 2ème édition
                    </a>
                </div>
            </Container>
        </section>

        <section id="mediatheque" class="py-20">
            <Container>
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <h2 class="text-4xl font-black text-ink sm:text-5xl">Médiathèque</h2>
                        <p class="mt-6 max-w-md text-gray-600">
                            Le FESTIRA-Agonlin se veut être plus qu'un simple événement festif. C'est un
                            cadre de retrouvailles, de partage et de valorisation de notre patrimoine culturel.
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li v-for="point in mediaPoints" :key="point" class="flex items-center gap-3 text-gray-700">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-600 text-white">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                        <path fill-rule="evenodd" d="M16.7 5.3a1 1 0 010 1.4l-7.5 7.5a1 1 0 01-1.4 0L3.3 9.7a1 1 0 011.4-1.4l3.8 3.8 6.8-6.8a1 1 0 011.4 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                {{ point }}
                            </li>
                        </ul>
                        <div class="mt-10">
                            <AppButton href="#actualites" variant="primary" size="lg">En savoir plus</AppButton>
                        </div>
                    </div>
                    <img src="/images/media.jpg" alt="Médiathèque" class="h-[420px] w-full rounded-[30px] object-cover lg:h-[560px]" />
                </div>
            </Container>
        </section>

        <section class="py-16">
            <Container>
                <div class="mx-auto flex max-w-4xl flex-col items-center rounded-[50%] bg-gradient-to-br from-blush-100 to-blush-200 px-10 py-20 text-center sm:px-24 sm:py-24">
                    <h2 class="text-4xl font-black text-ink sm:text-5xl">Communiqué</h2>
                    <p class="mt-6 max-w-xl text-gray-600">
                        Retrouvez ici toutes les informations officielles et les annonces liées à
                        l'organisation du festival et à la participation.
                    </p>
                    <div class="mt-8">
                        <AppButton variant="primary" size="lg">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v4a1 1 0 001 1h4M14 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V8l-5-5z" />
                            </svg>
                            Télécharger
                        </AppButton>
                    </div>
                </div>
            </Container>
        </section>

        <section id="galerie" class="py-20">
            <Container>
                <SectionTitle title="Notre galerie" align="center" />
                <div class="mt-12 columns-2 gap-4 lg:columns-4 lg:gap-[30px] [&>img]:mb-4 lg:[&>img]:mb-[30px]">
                    <img
                        v-for="(img, i) in displayedGallery"
                        :key="i"
                        :src="img"
                        alt=""
                        class="w-full break-inside-avoid rounded-[20px] object-cover"
                    />
                </div>
                <div class="mt-12 text-center">
                    <AppButton variant="outline" size="lg">Voir plus</AppButton>
                </div>
            </Container>
        </section>

        <section id="actualites" class="bg-gray-50 py-20">
            <Container>
                <SectionTitle title="Dernières actualités" align="center" />
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <PostCard v-for="(post, i) in displayedPosts" :key="i" :post="post" />
                </div>
                <div class="mt-12 text-center">
                    <AppButton variant="outline" size="lg">Voir plus</AppButton>
                </div>
            </Container>
        </section>

        <section class="py-20">
            <Container>
                <SectionTitle eyebrow="Témoignages" title="Ils parlent de nous" align="center" />
                <figure class="mx-auto mt-10 max-w-3xl text-center">
                    <blockquote class="text-xl leading-relaxed text-gray-700 sm:text-2xl">
                        « Le FESTIRA nous permet de célébrer nos racines et de rassembler la diaspora
                        autour d'une culture vivante. »
                    </blockquote>
                    <figcaption class="mt-6">
                        <p class="font-semibold text-ink">Jean-Luc Ohanian</p>
                        <p class="text-sm text-gray-500">Fondateur</p>
                    </figcaption>
                </figure>
            </Container>
        </section>

        <section id="inscription" class="py-20">
            <Container>
                <div class="grid items-center gap-8 lg:grid-cols-2">
                    <div class="relative">
                        <span class="absolute -left-2 bottom-8 top-8 w-4 rounded-full bg-brand-600"></span>
                        <img src="/images/hero.png" alt="Festival International Racines d'Agonlin" class="relative w-full rounded-[30px]" />
                    </div>
                    <div class="rounded-[30px] bg-gray-900 p-10 text-white sm:p-14">
                        <h2 class="text-4xl font-black sm:text-5xl">Rejoignez nous !</h2>
                        <p class="mt-6 text-gray-300">
                            Rejoignons-nous dans cette aventure : célébrons ensemble notre patrimoine,
                            partageons nos traditions et faisons rayonner Agonlin au-delà des frontières.
                        </p>
                        <div class="mt-8">
                            <AppButton variant="light" size="lg">S'inscrire</AppButton>
                        </div>
                    </div>
                </div>
            </Container>
        </section>

        <section id="sponsors" class="bg-gray-50 py-20">
            <Container>
                <SectionTitle title="Nos partenaires" align="center" />
                <div class="mt-12 flex flex-wrap items-center justify-center gap-x-16 gap-y-10">
                    <div
                        v-for="(sponsor, i) in displayedSponsors"
                        :key="sponsor.id ?? i"
                        class="flex h-16 w-36 items-center justify-center rounded-xl bg-white px-4 text-center text-sm font-medium text-gray-500 shadow-sm"
                    >
                        {{ sponsor.name }}
                    </div>
                </div>
            </Container>
        </section>
    </PublicLayout>
</template>
