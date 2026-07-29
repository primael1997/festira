<?php

namespace App\Http\Controllers;

use App\Models\Banniere;
use App\Models\Countdown;
use App\Models\Gallerie;
use App\Models\Post;
use App\Models\Sponsort;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banniere::where('status', 1)
            ->latest()
            ->get(['id', 'title', 'image', 'description', 'btn_url']);

        $countdown = Countdown::latest('date')->first(['title', 'date']);

        $posts = Post::with('category:id,name')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn ($post) => [
                'title' => $post->title,
                'slug' => $post->slug,
                'image' => $post->image,
                'excerpt' => $post->description,
                'category' => $post->category?->name,
                'date' => $post->created_at?->locale('fr')->translatedFormat('d F Y'),
            ]);

        $galleryImages = Gallerie::latest()
            ->get()
            ->flatMap(fn ($gallery) => $this->parseImages($gallery->images))
            ->take(12)
            ->values();

        $sponsors = Sponsort::get(['id', 'name']);

        return Inertia::render('Home', [
            'banners' => $banners,
            'countdown' => $countdown,
            'posts' => $posts,
            'galleryImages' => $galleryImages,
            'sponsors' => $sponsors,
        ]);
    }

    private function parseImages($value)
    {
        if (blank($value)) {
            return [];
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : array_map('trim', explode(',', $value));
    }
}
