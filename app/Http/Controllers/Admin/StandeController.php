<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edition;
use App\Models\Participant;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class StandeController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stands = Participant::where('etude', 'en attente')
        ->when($request->filled('edition'), function ($query) use ($request) {
            $query->where('edition_id', $request->edition);
        })
        ->orderBy('edition_id', 'desc')
        ->paginate(10);

        $editions = Edition::orderBy('id','desc')->get();

        return view('admin.stande.index', compact('stands','editions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stande.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required','string'],
            'prenom' => ['required','string'],
            'sexe' => ['required','string'],
            'structure' => ['required','string'],
            'secteur' => ['required','string'],
            'phone' => ['required','string'],
            'email' => ['required','email'],
            'ville' => ['required','string'],
            'adresse' => ['required','string'],
            'piece' => ['nullable', 'image', 'max:3000'],
            'logo' => ['nullable', 'image', 'max:3000'],
            'presentation' => ['nullable','mimes:pdf','max:10000']
        ]);

        $edition = Edition::where('status',1)->first();
        if (empty($edition)) {
            toastr('Aucune édition en cours!', 'error');
            return back();
        }

        /** Handle the image upload */
        $piecePath = $this->uploadImage($request, 'piece', 'uploads');
        $logoPath = $this->uploadImage($request, 'logo', 'uploads');
        $presentationPath = $this->uploadImage($request, 'presentation', 'uploads');

        $stands = new Participant();
        $stands->nom = $request->nom;
        $stands->prenom = $request->prenom;
        $stands->sexe = $request->sexe;
        $stands->structure = $request->structure;
        $stands->secteur = $request->secteur;
        $stands->phone = $request->phone;
        $stands->email = $request->email;
        $stands->ville = $request->ville;
        $stands->adresse = $request->adresse;
        $stands->piece_identite = $piecePath;
        $stands->logo = $logoPath;
        $stands->presentation_activite = $presentationPath;
        $stands->edition_id = $edition->id;
        $stands->save();

        toastr('Stande reservé avec succès!', 'success');
        return redirect()->route('admin.standes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stand = Participant::findOrFail($id);

        return view('admin.stande.show',compact('stand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stand = Participant::findOrFail($id);

        return view('admin.stande.edit', compact('stand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stand = Participant::findOrFail($id);

        $request->validate([
            'nom' => ['required','string'],
            'prenom' => ['required','string'],
            'sexe' => ['required','string'],
            'structure' => ['required','string'],
            'secteur' => ['required','string'],
            'phone' => ['required','string'],
            'email' => ['required','email'],
            'ville' => ['required','string'],
            'adresse' => ['required','string'],
            'piece' => ['required', 'image', 'max:3000'],
            'logo' => ['required', 'image', 'max:3000'],
            'presentation' => ['required','mimes:pdf','max:10000']
        ]);

        $edition = Edition::where('status',1)->first();
        if (empty($edition)) {
            toastr('Aucune édition en cours!', 'error');
            return back();
        }

        /** Handle the image upload */
        $piecePath = $this->uploadImage($request, 'piece', 'uploads');
        $logoPath = $this->uploadImage($request, 'logo', 'uploads');
        $presentationPath = $this->uploadImage($request, 'presentation', 'uploads');

        $stand->nom = $request->nom;
        $stand->prenom = $request->prenom;
        $stand->sexe = $request->sexe;
        $stand->structure = $request->structure;
        $stand->secteur = $request->secteur;
        $stand->phone = $request->phone;
        $stand->email = $request->email;
        $stand->ville = $request->ville;
        $stand->adresse = $request->adresse;
        $stand->piece_identite = $piecePath;
        $stand->logo = $logoPath;
        $stand->presentation_activite = $presentationPath;
        $stand->edition_id = $edition->id;
        
        $stand->save();

        toastr('Stande modifié avec succès!', 'success');
        return redirect()->route('admin.standes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stand = Participant::findOrFail($id);

        $stand->delete();

        return response(['status' => 'success', 'message' => 'Stande Suprimés!']);
    }

    public function lirePdf($id)
    {
        $stand = Participant::findOrFail($id);

        $path = public_path($stand->presentation_activite);

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="presentation-{{$stand->structure}}.pdf"'
        ]);
    }

    public function valideStand(Request $request,$id)
    {
        $request->validate([
            'status' => ['required','string'],
        ]);

        $stand = Participant::findOrFail($id);
        $stand->status = $request->status == 'validé' ? 1 : 0;
        $stand->etude = $request->status;

        $stand->save();

        toastr('Mise à jour éffectuée avec succès','success');

        return redirect()->route('admin.standes.index');
    }

    public function standeValides(Request $request)
    {
        $stands = Participant::where('status', 1)
        ->when($request->filled('edition'), function ($query) use ($request) {
            $query->where('edition_id', $request->edition);
        })
        ->orderBy('edition_id', 'desc')
        ->paginate(10);

        $editions = Edition::orderBy('id','desc')->get();

        return view('admin.stande.valide', compact('stands','editions'));
    }

    public function standeRejettes(Request $request)
    {
        $stands = Participant::where('etude', 'rejetté')
        ->when($request->filled('edition'), function ($query) use ($request) {
            $query->where('edition_id', $request->edition);
        })
        ->orderBy('edition_id', 'desc')
        ->paginate(10);

        $editions = Edition::orderBy('id','desc')->get();

        return view('admin.stande.rejette', compact('stands','editions'));
    }
}
