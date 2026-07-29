<script setup>
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import SectionTitle from '@/Components/SectionTitle.vue'
import TitleUnderline from '@/Components/TitleUnderline.vue'

const socials = ['/images/social/facebook.svg', '/images/social/instagram.svg', '/images/social/linkedin.svg']

const objectives = [
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
]

const interests = [
    { title: '1. Découverte culturelle', text: "Une immersion complète dans la culture riche et variée de la région d'Agonlin.", image: '/images/gallery-5.jpg' },
    { title: '2. Gastronomie', text: 'Dégustation de plats traditionnels emblématiques de la région.', image: '/images/gallery-6.jpg' },
    { title: '3. Promotion de danse', text: "Une immersion complète dans la culture riche et variée de la région d'Agonlin.", image: '/images/gallery-7.jpg' },
    { title: '4. Gastronomie', text: 'Dégustation de plats traditionnels emblématiques de la région.', image: '/images/gallery-8.jpg' },
]
</script>

<template>
    <Head title="Festira" />

    <PublicLayout>
        <section class="py-8 sm:py-12">
            <Container>
                <img
                    src="/images/festira-bg.jpg"
                    alt="Camp des Amazones de Zangnanado"
                    class="h-[280px] w-full rounded-[40px] object-cover object-[center_20%] sm:h-[440px]"
                />

                <div class="mt-12 grid items-start gap-10 lg:grid-cols-2">
                    <div class="rounded-3xl border border-brand-200 p-6 sm:p-8">
                        <div class="flex items-center gap-4">
                            <img src="/images/gallery-9.jpg" alt="" class="h-16 w-16 rounded-full object-cover" />
                            <div>
                                <p class="text-lg font-bold text-ink">Thierry TESTDESIGN</p>
                                <p class="text-sm text-gray-500">Directeur</p>
                            </div>
                        </div>
                        <span class="mt-4 inline-block rounded-md bg-brand-600 px-3 py-1 text-xs font-semibold uppercase text-white">
                            Docteur en médecine
                        </span>
                        <p class="mt-4 text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua.
                        </p>
                        <div class="mt-5 flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-500">Également sur :</span>
                            <a v-for="(icon, i) in socials" :key="i" href="#" class="flex h-8 w-8 items-center justify-center rounded-md bg-brand-600">
                                <img :src="icon" alt="" class="h-4 w-4" />
                            </a>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-3xl font-black text-brand-600 sm:text-4xl">FESTIRA</h2>
                        <p class="mt-4 text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>
                </div>
            </Container>
        </section>

        <section class="py-12">
            <Container>
                <div>
                    <h2 class="text-3xl font-black text-ink sm:text-4xl">Nos objectifs</h2>
                    <TitleUnderline />
                </div>
                <p class="mt-6 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <ul class="mt-4 list-disc space-y-2 pl-6 text-gray-600">
                    <li v-for="(obj, i) in objectives" :key="i">{{ obj }}</li>
                </ul>
                <blockquote class="mt-8 rounded-r-xl border-l-4 border-brand-600 bg-blush-100 px-6 py-5 text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat.
                </blockquote>
            </Container>
        </section>

        <section class="py-16">
            <Container>
                <SectionTitle
                    title="Intérêts des participants"
                    align="center"
                >
                    Le FESTIRA-Agonlin offre de nombreux avantages aux participants
                </SectionTitle>

                <div class="mt-12 space-y-10">
                    <div
                        v-for="(item, i) in interests"
                        :key="i"
                        class="grid items-center gap-6 lg:grid-cols-2"
                    >
                        <img
                            :src="item.image"
                            alt=""
                            class="h-[300px] w-full rounded-[30px] object-cover"
                            :class="i % 2 === 0 ? 'lg:order-1' : 'lg:order-2'"
                        />
                        <div
                            class="rounded-[30px] bg-gray-50 p-8 shadow-sm sm:p-10"
                            :class="i % 2 === 0 ? 'lg:order-2' : 'lg:order-1'"
                        >
                            <h3 class="text-2xl font-bold uppercase text-ink">{{ item.title }}</h3>
                            <p class="mt-3 text-gray-600">{{ item.text }}</p>
                        </div>
                    </div>
                </div>
            </Container>
        </section>
    </PublicLayout>
</template>
