<?php

namespace Database\Seeders;

use App\Models\Banniere;
use App\Models\Category;
use App\Models\CategoryDocument;
use App\Models\Countdown;
use App\Models\Document;
use App\Models\Edition;
use App\Models\Gallery;
use App\Models\GeneralSetting;
use App\Models\Participant;
use App\Models\Post;
use App\Models\Sponsort;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedSettings();
        $this->seedCountdown();
        $this->seedBannieres();
        $this->seedBlog();
        $this->seedGalleries();
        $this->seedMediatheque();
        $this->seedSponsors($this->seedEditions());

        User::firstOrNew(['email' => 'admin@admin.com'])
            ->forceFill([
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'isAdmin' => 1,
                'email_verified_at' => now(),
            ])
            ->save();
    }

    private function seedSettings(): void
    {
        GeneralSetting::forceCreate([
            'site_name' => 'FESTIRA',
            'email' => 'contact@festira.bj',
            'phone' => '+229 01 97 00 00 00',
            'contact_address' => 'Agonlin, Cotonou, Bénin',
            'fb' => 'https://www.facebook.com/festira.agonlin',
            'insta' => 'https://www.instagram.com/festira.agonlin',
        ]);
    }

    private function seedCountdown(): void
    {
        Countdown::forceCreate([
            'title' => "2ème édition du FESTIRA Agonlin",
            'date' => now()->addDays(30)->startOfDay()->addHours(10),
        ]);
    }

    private function seedBannieres(): void
    {
        $bannieres = [
            [
                'image' => '/images/hero.png',
                'title' => "Festival International Racines d'Agonlin",
                'description' => "Célébrons ensemble notre patrimoine et faisons rayonner Agonlin.",
                'btn_url' => 'https://festira.bj/inscription',
                'status' => 1,
            ],
            [
                'image' => '/images/edition-bg.png',
                'title' => "2ème édition Agonlin, Cotonou",
                'description' => "Trois jours de musique, de danses et de savoir-faire traditionnels.",
                'btn_url' => null,
                'status' => 1,
            ],
            [
                'image' => '/images/about.jpg',
                'title' => "Rejoignez la caravane du festival",
                'description' => "Une ancienne annonce, conservée mais désactivée.",
                'btn_url' => null,
                'status' => 0,
            ],
        ];

        foreach ($bannieres as $banniere) {
            Banniere::forceCreate($banniere + ['public_id' => null]);
        }
    }

    private function seedBlog(): void
    {
        $categories = collect(['Festira', 'Culture', 'Patrimoine', 'Programme', 'Communiqué'])
            ->mapWithKeys(fn ($name) => [$name => Category::forceCreate(['name' => $name])]);

        $articles = [
            ['Festira', 'Pourquoi Agonlin ?', 'post-1.jpg'],
            ['Patrimoine', 'Un patrimoine vivant', 'post-2.jpg'],
            ['Festira', 'Rendez-vous à Cotonou', 'post-3.jpg'],
            ['Culture', "Les rythmes traditionnels à l'honneur", 'gallery-1.jpg'],
            ['Programme', 'Le colloque sur les racines d\'Agonlin', 'gallery-2.jpg'],
            ['Communiqué', 'Appel à participation des artisans', 'gallery-3.jpg'],
            ['Culture', 'La danse Zinli, mémoire du peuple', 'gallery-4.jpg'],
            ['Patrimoine', 'Sur les traces des sites historiques', 'gallery-5.jpg'],
            ['Programme', "Culte d'action de grâce : le programme", 'gallery-6.jpg'],
            ['Festira', 'La diaspora se mobilise', 'gallery-7.jpg'],
            ['Communiqué', 'Ouverture des inscriptions en ligne', 'gallery-8.jpg'],
            ['Culture', 'Artisanat : le tissage revisité', 'gallery-9.jpg'],
        ];

        foreach ($articles as $index => [$category, $title, $image]) {
            Post::forceCreate([
                'category_id' => $categories[$category]->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => "Un territoire au patrimoine riche, berceau de traditions que le festival met à l'honneur chaque année.",
                'image' => "/images/{$image}",
                'content' => collect(range(1, 5))
                    ->map(fn () => "Le FESTIRA-Agonlin se veut être plus qu'un simple événement festif. C'est un cadre de retrouvailles, de partage et de valorisation de notre patrimoine culturel, porté par les fils et filles d'Agonlin et leur diaspora.")
                    ->implode("\n\n"),
                'created_at' => now()->subDays($index * 5),
                'updated_at' => now()->subDays($index * 5),
            ]);
        }
    }

    private function seedGalleries(): void
    {
        Gallery::forceCreate([
            'images' => json_encode(collect(range(1, 6))->map(fn ($i) => "/images/gallery-{$i}.jpg")),
        ]);

        Gallery::forceCreate([
            'images' => json_encode(collect(range(7, 12))->map(fn ($i) => "/images/gallery-{$i}.jpg")),
        ]);
    }

    private function seedMediatheque(): void
    {
        $rapports = CategoryDocument::forceCreate(['name' => 'Rapports']);
        $officiels = CategoryDocument::forceCreate(['name' => 'Documents officiels']);

        $documents = [
            [$rapports, 'Rapport Edition 2025', 'gallery-1.jpg'],
            [$rapports, 'Rapport Edition 2026', 'gallery-2.jpg'],
            [$officiels, 'Dossier de présentation du festival', 'gallery-3.jpg'],
            [$officiels, 'Communiqué officiel de la 2ème édition', 'gallery-4.jpg'],
        ];

        foreach ($documents as [$category, $title, $image]) {
            Document::forceCreate([
                'category_document_id' => $category->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => "Retrouvez ici les informations officielles liées à l'organisation du festival et à la participation.",
                'image' => "/images/{$image}",
                'file' => '/documents/'.Str::slug($title).'.pdf',
            ]);
        }
    }

    private function seedEditions(): Edition
    {
        Edition::forceCreate([
            'titre' => '1ère édition Agonlin, Cotonou',
            'date' => now()->subYear()->startOfDay(),
            'status' => 0,
        ]);

        $current = Edition::forceCreate([
            'titre' => '2ème édition Agonlin, Cotonou',
            'date' => now()->addMonths(7)->startOfDay(),
            'status' => 1,
        ]);

        Participant::factory(40)->create(['edition_id' => $current->id]);

        return $current;
    }

    private function seedSponsors(Edition $edition): void
    {
        Sponsort::factory(6)->create([
            'edition_id' => $edition->id,
            'status' => 1,
            'etude' => 'validé',
        ]);
    }
}
