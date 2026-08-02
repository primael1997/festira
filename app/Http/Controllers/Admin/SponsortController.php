<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edition;
use App\Models\Sponsort;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SponsortController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sponsorts = Sponsort::where('etude', 'en attente')
        ->when($request->filled('edition'), function ($query) use ($request) {
            $query->where('edition_id', $request->edition);
        })
        ->orderBy('edition_id', 'desc')
        ->paginate(10);

        $editions = Edition::orderBy('id','desc')->get();

        return view('admin.sponsort.index', compact('sponsorts','editions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sponsort.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required','string','max:200',
            'structure' => 'required','string',
            'phone' => 'required',
            'secteur' => 'required','string','max:200',
            'email' => 'required','email',
            'adresse' => 'required','string',
            'logo' => 'required',
        ]);

        $edition = Edition::where('status',1)->first();
        if (empty($edition)) {
            toastr('Aucune édition en cours!', 'error');
            return back();
        }

        /** Handle the image upload */
        $logoPath = $this->uploadImage($request, 'logo', 'uploads');

        $sponsort = new Sponsort();
        $sponsort->edition_id = $edition->id;
        $sponsort->name = $request->nom;
        $sponsort->responsable = $request->structure;
        $sponsort->phone = $request->phone;
        $sponsort->secteur = $request->secteur;
        $sponsort->email = $request->email;
        $sponsort->adresse = $request->adresse;
        $sponsort->logo = $logoPath;

        $sponsort->save();

        toastr('Sponsort ajouté avec succès!', 'success');

        return redirect()->route('admin.sponsort.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sponsort = Sponsort::findOrFail($id);

        return view('admin.sponsort.show', compact('sponsort'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sponsort = Sponsort::findOrFail($id);

        return view('admin.sponsort.edit', compact('sponsort'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sponsort = Sponsort::findOrFail($id);

        $request->validate([
            'nom' => 'required','string','max:200',
            'structure' => 'required','string',
            'phone' => 'required',
            'secteur' => 'required','string','max:200',
            'email' => 'required','email',
            'adresse' => 'required','string',
            'logo' => 'nullable',
        ]);

        $edition = Edition::where('status',1)->first();
        if (empty($edition)) {
            toastr('Aucune édition en cours!', 'error');
            return back();
        }

        /** Handle the image upload */
        $logoPath = $this->uploadImage($request, 'logo', 'uploads');

        $sponsort->edition_id = $edition->id;
        $sponsort->name = $request->nom;
        $sponsort->responsable = $request->structure;
        $sponsort->phone = $request->phone;
        $sponsort->secteur = $request->secteur;
        $sponsort->email = $request->email;
        $sponsort->adresse = $request->adresse;
        $sponsort->logo = $logoPath;

        $sponsort->save();

        toastr('Sponsort modifié avec succès!', 'success');

        return redirect()->route('admin.sponsort.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sponsort = Sponsort::findOrFail($id);
        $this->deleteImage($sponsort->logo);
        $sponsort->delete();

        return response(['status' => 'success', 'message' => 'Sponsort Suprimés!']);
    }

    public function valideSponsort(Request $request,$id)
    {
        $request->validate([
            'status' => ['required','string'],
        ]);

        $sponsort = Sponsort::findOrFail($id);
        $sponsort->status = $request->status == 'validé' ? 1 : 0;
        $sponsort->etude = $request->status;

        $sponsort->save();

        toastr('Mise à jour éffectuée avec succès','success');
        return redirect()->route('admin.sponsort.index');
    }

    public function sponsortValides(Request $request)
    {
        $sponsorts = Sponsort::where('status', 1)
        ->when($request->filled('edition'), function ($query) use ($request) {
            $query->where('edition_id', $request->edition);
        })
        ->orderBy('edition_id', 'desc')
        ->paginate(10);

        $editions = Edition::orderBy('id','desc')->get();

        return view('admin.sponsort.valide', compact('sponsorts','editions'));
    }

    public function sponsortRejettes(Request $request)
    {
        $sponsorts = Sponsort::where('etude', 'rejetté')
        ->when($request->filled('edition'), function ($query) use ($request) {
            $query->where('edition_id', $request->edition);
        })
        ->orderBy('edition_id', 'desc')
        ->paginate(10);

        $editions = Edition::orderBy('id','desc')->get();

        return view('admin.sponsort.rejette', compact('sponsorts','editions'));
    }
}
