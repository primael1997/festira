<script setup>
import { computed, ref, onMounted, onBeforeUnmount } from 'vue'
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import SectionTitle from '@/Components/SectionTitle.vue'
import AppButton from '@/Components/AppButton.vue'
import Countdown from '@/Components/Countdown.vue'
import PostCard from '@/Components/PostCard.vue'
import TitleUnderline from '@/Components/TitleUnderline.vue'
import DocumentCard from '@/Components/DocumentCard.vue'

const props = defineProps({
    banners: { type: Array, default: () => [] },
    posts: { type: Array, default: () => [] },
    galleryImages: { type: Array, default: () => [] },
    sponsors: { type: Array, default: () => [] },
    countdown: { type: Object, default: null },
    documents: { type: Array, default: () => [] },
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

const fallbackBanners = [
    {
        id: 'fallback',
        image: '/images/hero.png',
        title: "Festival International Racines d'Agonlin",
        description: null,
        btn_url: null,
    },
]

const displayedPosts = computed(() => (props.posts.length ? props.posts : fallbackPosts))
const displayedGallery = computed(() => (props.galleryImages.length ? props.galleryImages : fallbackGallery))
const displayedSponsors = computed(() => (props.sponsors.length ? props.sponsors : fallbackSponsors))
const displayedBanners = computed(() => (props.banners.length ? props.banners : fallbackBanners))

const activeBanner = ref(0)
const currentBanner = computed(
    () => displayedBanners.value[activeBanner.value] ?? displayedBanners.value[0]
)

const headline = computed(() => {
    const [first, ...rest] = (currentBanner.value?.title ?? '').split(' ')
    return { first, rest: rest.join(' ') }
})

let bannerTimer = null

const startAutoplay = () => {
    clearInterval(bannerTimer)
    if (displayedBanners.value.length < 2) return
    bannerTimer = setInterval(() => {
        activeBanner.value = (activeBanner.value + 1) % displayedBanners.value.length
    }, 6000)
}

const goToBanner = (index) => {
    activeBanner.value = index
    startAutoplay()
}

onMounted(startAutoplay)
onBeforeUnmount(() => clearInterval(bannerTimer))

const mediaPoints = ['Un espace de partage culturel', 'Des rencontres et des échanges']

const testimonials = [
    {
        quote: "Le FESTIRA nous permet de célébrer nos racines et de rassembler la diaspora autour d'une culture vivante.",
        name: 'Jean Luc Ohanian',
        role: 'Fondateur',
        avatar: '/images/gallery-9.jpg',
    },
    {
        quote: "Trois jours de rencontres, de musique et de transmission : le festival donne à voir tout ce que la région d'Agonlin a de plus vivant.",
        name: 'Merveille',
        role: 'Participant',
        avatar: '/images/gallery-6.jpg',
    },
    {
        quote: "Un cadre de retrouvailles qui rapproche les générations et fait rayonner notre patrimoine bien au-delà des frontières.",
        name: 'Témoignage à remplacer',
        role: 'Jacques',
        avatar: '/images/gallery-7.jpg',
    },
]

const activeTestimonial = ref(0)
const currentTestimonial = computed(() => testimonials[activeTestimonial.value])

const moveTestimonial = (step) => {
    const total = testimonials.length
    activeTestimonial.value = (activeTestimonial.value + step + total) % total
}
</script>

<template>
    <Head title="Accueil" />

    <PublicLayout>
        <section id="accueil" class="py-8 sm:py-12">
            <Container>
                <div class="relative h-[400px] overflow-hidden rounded-[40px] sm:h-auto sm:aspect-[1219/801]">
                    <img
                        :src="currentBanner.image"
                        :alt="currentBanner.title"
                        class="absolute inset-0 h-full w-full object-cover"
                    />

                    <div class="absolute inset-0 flex items-center">
                        <div class="max-w-xl px-6 sm:px-12 lg:px-16">
                            <p class="flex items-center gap-2.5 text-lg font-semibold text-white drop-shadow">
                                Bienvenue sur notre site de billetterie !
                                <img src="/images/ticket.svg" alt="" class="h-[18px] w-6" />
                            </p>
                            <h1 class="mt-4 text-2xl font-black uppercase leading-[1.02] tracking-tight sm:text-4xl md:text-5xl lg:text-7xl">
                                <span class="block text-brand-600">{{ headline.first }}</span>
                                <span v-if="headline.rest" class="block text-white drop-shadow-md">{{ headline.rest }}</span>
                            </h1>
                            <div class="mt-8">
                                <AppButton :href="currentBanner.btn_url || '#festira'" variant="primary" size="lg">
                                    Découvrez l'événement
                                </AppButton>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="displayedBanners.length > 1"
                        class="absolute right-5 top-1/2 flex -translate-y-1/2 flex-col gap-2.5"
                    >
                        <button
                            v-for="(banner, i) in displayedBanners"
                            :key="banner.id ?? i"
                            type="button"
                            :aria-label="`Bannière ${i + 1}`"
                            :aria-current="i === activeBanner"
                            @click="goToBanner(i)"
                            :class="[
                                'rounded-full transition',
                                i === activeBanner ? 'h-2.5 w-2.5 bg-brand-600' : 'h-2 w-2 bg-gray-300 hover:bg-gray-400',
                            ]"
                        ></button>
                    </div>
                </div>
            </Container>
        </section>

        <section id="festira" class="py-12 sm:py-16">
            <Container>
                <Countdown :date="countdown?.date" />

                <div id="a-propos" class="mt-12 grid items-center gap-10 sm:mt-20 lg:mt-28 lg:grid-cols-2 lg:gap-20">
                    <div>
                        <h2 class="text-4xl font-black uppercase tracking-tight text-ink sm:text-5xl">
                            À propos de Festira
                        </h2>
                        <TitleUnderline />

                        <p class="mt-10 max-w-lg text-lg leading-relaxed text-gray-700">
                            Le FESTIRA-Agonlin se veut être plus qu'un simple événement festif. C'est un
                            cadre de retrouvailles, de convivialité, de mise en réseau et de valorisation
                            des richesses variées de la région d'Agonlin. Il s'agit d'un creuset qui permet
                            aux participants de découvrir et d'apprécier les multiples facettes de la
                            culture locale.
                        </p>

                        <div class="mt-10">
                            <AppButton :href="route('festira')" variant="dark" size="lg">
                                En savoir plus
                            </AppButton>
                        </div>
                    </div>

                    <div class="relative mx-auto w-full max-w-2xl pb-[37%]">
                        <img
                            src="/images/about-us.jpg"
                            alt="Danseur masqué Egungun lors du festival"
                            class="aspect-[3/4] w-[58%] rounded-[24px] object-cover shadow-lg"
                        />
                        <img
                            src="/images/zangnanado_view.jpg"
                            alt="Panneau d'entrée de Zangnanado"
                            class="absolute bottom-0 right-0 aspect-[3/4] w-[58%] rounded-[24px] object-cover shadow-xl ring-4 ring-blush-50"
                        />
                    </div>
                </div>

                <div class="relative mt-16 overflow-hidden rounded-[40px]">
                    <img src="/images/edition-bg.png" alt="" class="absolute inset-0 h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-brand-600/20"></div>
                    <div class="relative flex flex-col gap-10 px-5 py-8 sm:gap-24 sm:px-16 sm:py-16">
                        <div>
                            <h3 class="text-4xl font-black text-white sm:text-6xl">1<sup>ère</sup> Edition</h3>
                            <div class="mt-3 flex items-center gap-2.5 text-2xl font-medium text-white sm:text-3xl">
                                Agonlin, Cotonou
                                <img src="/images/map.svg" alt="" class="h-7 w-7" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                            <button type="button" class="group flex items-center gap-5 text-white">
                                <span class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-600 ring-2 ring-white/50 transition group-hover:bg-brand-700 sm:h-20 sm:w-20">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6 translate-x-0.5 sm:h-8 sm:w-8">
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
                        class="inline-flex items-center gap-3 rounded-2xl bg-gray-900 px-5 py-4 text-base font-semibold text-white transition hover:bg-black sm:px-8 sm:py-5 sm:text-lg"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-4-4m4 4l4-4M5 19h14" />
                        </svg>
                        Document pour la 2ème édition
                    </a>
                </div>
            </Container>
        </section>

        <section id="mediatheque" class="py-12 sm:py-20">
            <Container>
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div>
                        <h2 class="text-4xl font-black text-ink sm:text-5xl">Médiathèque</h2>
                        <TitleUnderline />
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

        <section v-if="documents.length" id="communique" class="py-10 sm:py-16">
            <Container>
                <SectionTitle title="Communiqué" class="uppercase" align="center" />
                <p class="mx-auto mt-4 max-w-xl text-center text-gray-600">
                    Retrouvez ici toutes les informations officielles et les annonces liées à
                    l'organisation du festival et à la participation.
                </p>

                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <DocumentCard v-for="doc in documents" :key="doc.id" :document="doc" />
                </div>
            </Container>
        </section>

        <section id="galerie" class="py-12 sm:py-20">
            <Container>
                <SectionTitle title="Notre galerie" class="uppercase" align="center" />
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

        <section id="actualites" class="bg-gray-50 py-12 sm:py-20">
            <Container>
                <SectionTitle title="Dernières actualités" class="uppercase" align="center" />
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <PostCard v-for="(post, i) in displayedPosts" :key="i" :post="post" />
                </div>
                <div class="mt-12 text-center">
                    <AppButton :href="route('actualites.index')" variant="outline" size="lg">Voir plus</AppButton>
                </div>
            </Container>
        </section>

        <section class="py-12 sm:py-20">
            <Container>
                <SectionTitle eyebrow="Témoignages" title="Ils parlent de nous" align="center" />

                <div class="relative mt-12">
                    <div class="rounded-[40px] bg-gradient-to-b from-blush-100 to-blush-50 px-5 py-10 sm:rounded-[50px] sm:px-24 sm:py-24">
                        <figure class="mx-auto max-w-2xl text-center">
                            <blockquote class="text-2xl font-medium leading-snug text-ink sm:text-3xl">
                                {{ currentTestimonial.quote }}
                            </blockquote>
                            <figcaption class="mt-10 flex items-center justify-center gap-4">
                                <img
                                    :src="currentTestimonial.avatar"
                                    alt=""
                                    class="h-14 w-14 shrink-0 rounded-full object-cover"
                                />
                                <div class="text-left">
                                    <p class="font-bold text-ink">{{ currentTestimonial.name }}</p>
                                    <p class="text-sm text-gray-500">{{ currentTestimonial.role }}</p>
                                </div>
                            </figcaption>
                        </figure>
                    </div>

                    <template v-if="testimonials.length > 1">
                        <button
                            type="button"
                            aria-label="Témoignage précédent"
                            @click="moveTestimonial(-1)"
                            class="absolute left-3 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white text-ink shadow-md transition hover:bg-gray-50 sm:left-8 sm:h-14 sm:w-14"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7m-7 7h18" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            aria-label="Témoignage suivant"
                            @click="moveTestimonial(1)"
                            class="absolute right-3 top-1/2 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white text-ink shadow-md transition hover:bg-gray-50 sm:right-8 sm:h-14 sm:w-14"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7m7-7H3" />
                            </svg>
                        </button>
                    </template>
                </div>
            </Container>
        </section>

        <section id="inscription" class="py-12 sm:py-20">
            <Container>
                <div class="grid items-center gap-8 lg:grid-cols-2">
                    <div class="relative">
                        <span class="absolute -left-2 bottom-8 top-8 w-4 rounded-full bg-brand-600"></span>
                        <img src="/images/hero.png" alt="Festival International Racines d'Agonlin" class="relative w-full rounded-[30px]" />
                    </div>
                    <div class="rounded-[30px] bg-gray-900 p-6 text-white sm:p-14">
                        <h2 class="text-4xl font-black sm:text-5xl">Rejoignez nous !</h2>
                        <p class="mt-6 text-gray-300">
                            Rejoignons-nous dans cette aventure : célébrons ensemble notre patrimoine,
                            partageons nos traditions et faisons rayonner Agonlin au-delà des frontières.
                        </p>
                        <div class="mt-8">
                            <AppButton variant="light" size="lg" class="!text-black">S'inscrire</AppButton>
                        </div>
                    </div>
                </div>
            </Container>
        </section>

        <section id="sponsors" class="bg-gray-50 py-12 sm:py-20">
            <Container>
                <SectionTitle title="Nos partenaires" class="uppercase" align="center" />
                <div class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-8 sm:gap-x-16 sm:gap-y-10">
                    <div
                        v-for="(sponsor, i) in displayedSponsors"
                        :key="sponsor.id ?? i"
                        class="flex h-16 w-28 items-center justify-center rounded-xl bg-white px-3 text-center text-sm font-medium text-gray-500 shadow-sm sm:w-36 sm:px-4"
                    >
                        <img
                            v-if="sponsor.logo"
                            :src="sponsor.logo"
                            :alt="sponsor.name"
                            class="max-h-10 max-w-full object-contain"
                        />
                        <span v-else>{{ sponsor.name }}</span>
                    </div>
                </div>
            </Container>
        </section>
    </PublicLayout>
</template>
