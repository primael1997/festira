<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import Container from '@/Components/Container.vue'
import AppButton from '@/Components/AppButton.vue'

const page = usePage()
const settings = computed(() => page.props.generalSettings ?? {})
const siteName = computed(() => settings.value.name_site ?? 'FESTIRA')
const year = new Date().getFullYear()

const navigation = [
    { name: 'Accueil', href: '#accueil' },
    { name: 'Festira', href: '#festira' },
    { name: 'Actualités', href: '#actualites' },
    { name: 'Médiathèque', href: '#mediatheque' },
    { name: 'Infos pratiques', href: '#infos' },
]

const mobileOpen = ref(false)

const footerColumns = [
    { title: 'ACTION', links: ['Participer', 'Connecter', 'Prix'] },
    { title: 'FONCTIONNALITÉS', links: ['Payer', 'Newsletter', 'Être partenaire'] },
    { title: 'NOUS', links: ['Business', 'À propos', 'Blog'] },
]

const socials = computed(() => [
    { name: 'Facebook', icon: '/images/social/facebook.svg', href: settings.value.fb || '#' },
    { name: 'Instagram', icon: '/images/social/instagram.svg', href: settings.value.insta || '#' },
    { name: 'LinkedIn', icon: '/images/social/linkedin.svg', href: '#' },
    { name: 'YouTube', icon: '/images/social/youtube.svg', href: '#' },
])
</script>

<template>
    <div class="flex min-h-screen flex-col bg-white text-gray-900">
        <header class="sticky top-0 z-40 border-b border-gray-100 bg-white/90 backdrop-blur">
            <Container>
                <div class="flex h-20 items-center justify-between">
                    <Link href="/" class="flex items-center">
                        <img src="/images/logo.png" :alt="siteName" class="h-16 w-auto" />
                    </Link>

                    <nav class="hidden items-center gap-10 md:flex">
                        <a
                            v-for="item in navigation"
                            :key="item.href"
                            :href="item.href"
                            class="text-lg font-medium text-gray-700 transition hover:text-brand-700"
                        >
                            {{ item.name }}
                        </a>
                    </nav>

                    <div class="hidden md:block">
                        <AppButton href="#inscription" variant="dark" size="md">
                            Inscription
                        </AppButton>
                    </div>

                    <button
                        type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-600 md:hidden"
                        @click="mobileOpen = !mobileOpen"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                :d="mobileOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"
                            />
                        </svg>
                    </button>
                </div>
            </Container>

            <div v-show="mobileOpen" class="border-t border-gray-100 md:hidden">
                <Container>
                    <div class="flex flex-col gap-1 py-3">
                        <a
                            v-for="item in navigation"
                            :key="item.href"
                            :href="item.href"
                            class="rounded-md px-3 py-2 text-base font-medium text-gray-700 hover:bg-brand-50 hover:text-brand-700"
                            @click="mobileOpen = false"
                        >
                            {{ item.name }}
                        </a>
                        <AppButton href="#inscription" variant="dark" size="sm" class="mt-2">
                            Inscription
                        </AppButton>
                    </div>
                </Container>
            </div>
        </header>

        <main class="flex-1">
            <slot />
        </main>

        <footer id="infos" class="mt-16 bg-[#171717] text-gray-300">
            <Container>
                <div class="flex flex-col gap-16 py-20">
                    <div class="flex flex-col gap-12 lg:flex-row lg:justify-between">
                        <div>
                            <p class="text-4xl font-bold text-white">{{ siteName }}</p>
                            <p class="mt-2 font-medium text-white">Festival international d'Agonlin</p>
                        </div>

                        <div class="grid grid-cols-2 gap-x-16 gap-y-10 sm:grid-cols-3">
                            <div v-for="col in footerColumns" :key="col.title">
                                <p class="text-xl font-semibold text-white">{{ col.title }}</p>
                                <ul class="mt-4 space-y-4">
                                    <li v-for="link in col.links" :key="link">
                                        <a href="#" class="text-[15px] font-medium text-gray-300 transition hover:text-white">
                                            {{ link }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex flex-wrap items-center gap-8">
                            <div class="flex items-center gap-5">
                                <a
                                    v-for="s in socials"
                                    :key="s.name"
                                    :href="s.href"
                                    target="_blank"
                                    rel="noopener"
                                    :aria-label="s.name"
                                >
                                    <img :src="s.icon" :alt="s.name" class="h-10 w-10 transition hover:opacity-80" />
                                </a>
                            </div>
                            <div class="flex gap-4 text-[15px] font-medium text-gray-300">
                                <a href="#" class="transition hover:text-white">Termes et conditions</a>
                                <a href="#" class="transition hover:text-white">Privacy</a>
                            </div>
                        </div>
                        <p class="text-[15px] font-medium text-gray-300">Copyright © {{ year }}</p>
                    </div>
                </div>
            </Container>
        </footer>
    </div>
</template>
