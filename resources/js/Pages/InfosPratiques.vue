<script setup>
import { computed } from 'vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import Container from '@/Components/Container.vue'
import SectionTitle from '@/Components/SectionTitle.vue'
import AppButton from '@/Components/AppButton.vue'
import Countdown from '@/Components/Countdown.vue'
import Accordion from '@/Components/Accordion.vue'

defineProps({
    countdown: { type: Object, default: null },
})

const page = usePage()
const flash = computed(() => page.props.flash?.success)

const faqs = [
    { question: 'Dans quelle mesure allons nous faire vraiment vibrer', answer: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
    { question: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', answer: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
    { question: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', answer: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
    { question: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', answer: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
    { question: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', answer: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
    { question: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', answer: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' },
]

const team = [
    { name: 'Wilfried TEST', role: 'Fondateur & Directeur', image: '/images/gallery-6.jpg' },
    { name: 'Parfait TEST', role: 'Gérant', image: '/images/gallery-7.jpg' },
    { name: 'Savannah TEST', role: 'Gérant', image: '/images/gallery-8.jpg' },
]

const form = useForm({ name: '', email: '', phone: '', message: '' })
const submit = () => form.post(route('contact.store'), { preserveScroll: true, onSuccess: () => form.reset() })
</script>

<template>
    <Head title="Infos pratiques" />

    <PublicLayout>
        <section class="py-8 sm:py-12">
            <Container>
                <h1 class="mx-auto max-w-3xl text-center text-2xl font-black text-ink sm:text-3xl">
                    « Le Comité d'Organisation du FESTIRA (Festival International Racines d'Agonlin). »
                </h1>

                <div class="mt-8 flex items-center justify-center rounded-[40px] bg-gray-200 px-5 py-8 sm:px-6 sm:py-12">
                    <img src="/images/logo.png" alt="Festira" class="max-h-[180px] w-auto object-contain" />
                </div>

                <div class="mt-10 max-w-4xl">
                    <h2 class="text-2xl font-bold text-ink">La prochaine édition s'annonce super chaude</h2>
                    <p class="mt-4 text-gray-600">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p class="mt-4 text-gray-600">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.
                    </p>
                </div>

                <div class="mt-10 text-center">
                    <img src="/images/gallery-2.jpg" alt="" class="mx-auto h-[220px] w-full max-w-2xl rounded-[45%] object-cover sm:h-[280px]" />
                    <p class="mt-3 text-sm text-gray-500">Cliquez pour la localisation.</p>
                </div>

                <div class="mt-12">
                    <Countdown :date="countdown?.date" />
                </div>

                <div class="mt-8 text-center">
                    <AppButton variant="primary" size="lg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-4-4m4 4l4-4M5 19h14" />
                        </svg>
                        Télécharger le plan d'accès
                    </AppButton>
                </div>
            </Container>
        </section>

        <section class="py-10 sm:py-16">
            <Container>
                <SectionTitle title="Questions fréquemment posées" align="center" />
                <div class="mx-auto mt-10 max-w-4xl">
                    <Accordion :items="faqs" variant="filled" />
                </div>
            </Container>
        </section>

        <section class="py-8 sm:py-12">
            <Container>
                <div class="grid gap-6 lg:grid-cols-2">
                    <h2 class="text-3xl font-black text-ink sm:text-4xl">
                        Découvrez notre formidable équipe de référencement naturel
                    </h2>
                    <p class="text-gray-600 lg:pt-2">
                        Nous sommes conscients que vos besoins sont uniques, et c'est précisément ce qui motive
                        notre équipe.
                    </p>
                </div>

                <div class="mt-12 grid gap-8 sm:grid-cols-3">
                    <div v-for="member in team" :key="member.name" class="text-center">
                        <img :src="member.image" :alt="member.name" class="mx-auto h-40 w-40 rounded-full border-4 border-brand-200 object-cover" />
                        <p class="mt-4 text-lg font-bold text-ink">{{ member.name }}</p>
                        <p class="text-sm text-gray-500">{{ member.role }}</p>
                    </div>
                </div>
            </Container>
        </section>

        <section class="py-8 sm:py-12">
            <Container>
                <div class="grid items-center gap-8 lg:grid-cols-2">
                    <div class="relative">
                        <span class="absolute -left-2 bottom-8 top-8 w-4 rounded-full bg-brand-600"></span>
                        <img src="/images/hero.png" alt="Festival International Racines d'Agonlin" class="relative w-full rounded-[30px]" />
                    </div>
                    <div class="rounded-[30px] bg-gray-900 p-10 text-white sm:p-14">
                        <h2 class="text-4xl font-black sm:text-5xl">Rejoignez nous !</h2>
                        <p class="mt-6 text-gray-300">
                            Rejoignons-nous dans cette aventure : célébrons ensemble notre patrimoine, partageons nos
                            traditions et faisons rayonner Agonlin au-delà des frontières.
                        </p>
                        <div class="mt-8">
                            <AppButton variant="light" size="lg">S'inscrire</AppButton>
                        </div>
                    </div>
                </div>
            </Container>
        </section>

        <section class="py-10 sm:py-16">
            <Container>
                <div class="rounded-[40px] bg-blush-50 p-8 sm:p-12">
                    <div class="grid gap-10 lg:grid-cols-2">
                        <div>
                            <h2 class="text-2xl font-black text-ink sm:text-3xl">Contactez nous</h2>

                            <p v-if="flash" class="mt-4 rounded-lg bg-green-100 px-4 py-3 text-sm font-medium text-green-800">
                                {{ flash }}
                            </p>

                            <form @submit.prevent="submit" class="mt-6 space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nom Complet</label>
                                    <input v-model="form.name" type="text" class="mt-1 w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 focus:border-brand-500 focus:ring-brand-500" />
                                    <p v-if="form.errors.name" class="mt-1 text-sm text-brand-600">{{ form.errors.name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">E-mail</label>
                                    <input v-model="form.email" type="email" class="mt-1 w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 focus:border-brand-500 focus:ring-brand-500" />
                                    <p v-if="form.errors.email" class="mt-1 text-sm text-brand-600">{{ form.errors.email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Numéro téléphone</label>
                                    <input v-model="form.phone" type="text" class="mt-1 w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 focus:border-brand-500 focus:ring-brand-500" />
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Message</label>
                                    <textarea v-model="form.message" rows="4" class="mt-1 w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 focus:border-brand-500 focus:ring-brand-500"></textarea>
                                    <p v-if="form.errors.message" class="mt-1 text-sm text-brand-600">{{ form.errors.message }}</p>
                                </div>
                                <AppButton type="submit" variant="primary" size="md" :class="form.processing ? 'opacity-60' : ''">
                                    Envoyer
                                </AppButton>
                            </form>
                        </div>

                        <div class="flex flex-col items-center justify-center rounded-[30px] bg-white p-8 text-center">
                            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-600 text-white">
                                <img src="/images/map.svg" alt="" class="h-6 w-6" />
                            </span>
                            <p class="mt-4 text-lg font-bold text-ink">BENIN, COVE, AGONLIN</p>
                            <p class="mt-1 text-gray-500">01 00 00 00 00</p>
                        </div>
                    </div>
                </div>
            </Container>
        </section>
    </PublicLayout>
</template>
