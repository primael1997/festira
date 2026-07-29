<?php

namespace App\Http\Controllers;

use App\Models\Countdown;
use App\Models\Document;
use App\Models\Gallerie;
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
            'documents' => Document::latest()->get(['id', 'title', 'file']),
            'galleryImages' => Gallerie::latest()
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
