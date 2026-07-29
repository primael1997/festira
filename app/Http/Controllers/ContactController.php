<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'max:40'],
            'message' => ['required', 'max:2000'],
        ]);

        return back()->with('success', 'Votre message a bien été envoyé.');
    }
}
