<?php

namespace App\Http\Controllers;

use App\Models\Countdown;
use App\Models\Document;
use App\Models\Gallery;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function festira()
    {
        return Inertia::render('Festira');
    }

    public function mediatheque()
    {
        return Inertia::render('Mediatheque', [
            'documents' => Document::latest()
                ->latest('id')
                ->get(['id', 'title', 'description', 'image', 'file'])
                ->map(fn ($doc) => [
                    'id' => $doc->id,
                    'title' => $doc->title,
                    'description' => $doc->description,
                    'image' => $this->publicUrl($doc->image),
                    'file' => $this->publicUrl($doc->file),
                ]),
            'galleryImages' => Gallery::latest()
                ->get()
                ->flatMap(fn ($gallery) => $gallery->images_array)
                ->values(),
        ]);
    }

    public function infos()
    {
        return Inertia::render('InfosPratiques', [
            'countdown' => Countdown::latest('date')->first(['title', 'date']),
        ]);
    }
}
