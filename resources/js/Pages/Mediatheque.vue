<script setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import SectionTitle from '@/Components/SectionTitle.vue'
import AppButton from '@/Components/AppButton.vue'
import Accordion from '@/Components/Accordion.vue'

const props = defineProps({
    documents: { type: Array, default: () => [] },
    galleryImages: { type: Array, default: () => [] },
})

const fallbackDocuments = [
    { id: 'a', title: 'Rapport Edition 2025', file: '#' },
    { id: 'b', title: 'Rapport Edition 2026', file: '#' },
]

const fallbackGallery = Array.from({ length: 12 }, (_, i) => `/images/gallery-${i + 1}.jpg`)

const displayedDocuments = computed(() => (props.documents.length ? props.documents : fallbackDocuments))
const displayedGallery = computed(() => (props.galleryImages.length ? props.galleryImages : fallbackGallery))

const bullets = [
    'Arrivée et installation des festivaliers.',
    'Lancement du festival avec une caravane.',
    'Visite des lieux touristiques et historiques à Agonlin.',
    'Ouverture officielle du festival avec des animations de rythmes traditionnels en soirée.',
]

const programme = [
    { label: 'Jour 01.', title: 'Installation & Preparation', meta: 'Août 26, 2026 10:00', points: bullets },
    { label: 'Jour 02.', title: "Colloque sur les richesses et racines d'Agonlin", meta: 'Août 26, 2026 10:00', points: bullets },
    { label: 'Jour 03.', title: "Culte d'action de grace", meta: 'Août 26, 2026 10:00', points: bullets },
]
</script>

<template>
    <Head title="Médiathèque" />

    <PublicLayout>
        <section class="py-8 sm:py-12">
            <Container>
                <div class="flex items-center justify-center rounded-[40px] bg-gray-200 px-6 py-10">
                    <img src="/images/hero.png" alt="" class="max-h-[220px] w-auto object-contain" />
                </div>
                <img src="/images/gallery-3.jpg" alt="" class="mx-auto mt-8 h-[220px] w-full max-w-3xl rounded-[45%] object-cover sm:h-[300px]" />

                <figure class="mx-auto mt-10 max-w-3xl text-center">
                    <blockquote class="text-2xl font-bold text-ink sm:text-3xl">
                        « Le Comité d'Organisation du FESTIRA (Festival International Racines d'Agonlin) est bien organisé »
                    </blockquote>
                    <figcaption class="mt-4 text-gray-500">
                        <p class="font-medium">PDG Citation</p>
                        <p class="text-sm">Jean claude Thierry &amp; Naol</p>
                    </figcaption>
                </figure>
            </Container>
        </section>

        <section class="py-8">
            <Container>
                <div class="grid gap-8 md:grid-cols-2">
                    <article
                        v-for="(doc, i) in displayedDocuments"
                        :key="doc.id ?? i"
                        class="rounded-[25px] border border-brand-200 p-5"
                    >
                        <img :src="`/images/gallery-${(i % 12) + 1}.jpg`" alt="" class="h-52 w-full rounded-[18px] object-cover" />
                        <h3 class="mt-4 text-xl font-bold text-brand-600">{{ doc.title }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua.
                        </p>
                        <div class="mt-5 flex gap-3">
                            <AppButton :href="doc.file" variant="outline" size="sm">Télécharger</AppButton>
                            <AppButton :href="doc.file" variant="dark" size="sm">Ouvrir</AppButton>
                        </div>
                    </article>
                </div>
            </Container>
        </section>

        <section class="py-16">
            <Container>
                <SectionTitle title="Programme du Festival-Agonlin 2027" align="center">
                    Le FESTIRA-Agonlin offre de nombreux articles
                </SectionTitle>
                <div class="mx-auto mt-10 max-w-4xl">
                    <Accordion :items="programme" variant="plain" />
                </div>
            </Container>
        </section>

        <section class="py-12">
            <Container>
                <div class="mx-auto flex max-w-4xl flex-col items-center rounded-[50%] bg-gradient-to-br from-blush-100 to-blush-200 px-10 py-20 text-center sm:px-24 sm:py-24">
                    <h2 class="text-4xl font-black text-ink sm:text-5xl">Communiqué</h2>
                    <p class="mt-6 max-w-xl text-gray-600">
                        Retrouvez ici toutes les informations officielles et les annonces liées à l'organisation
                        du festival et à la participation.
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

        <section class="py-16">
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
            </Container>
        </section>
    </PublicLayout>
</template>
