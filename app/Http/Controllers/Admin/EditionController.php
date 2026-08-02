<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Edition;
use App\Models\Participant;
use App\Models\Sponsort;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $editions = Edition::orderBy('id','desc')->paginate(5);

        return view('admin.edition.index', compact('editions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.edition.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:100'],
            'date' => ['required','date'],
        ]);

        $edition = new Edition();

        $edition->titre = $data['title'];
        $edition->date = $data['date'];

        $edition->save();

        toastr('Edition ajoutée avec succès!', 'success');
        return redirect()->route('admin.edition.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Edition $edition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Edition $edition)
    {
        $edition = Edition::findOrFail($edition->id);

        return view('admin.edition.edit', compact('edition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Edition $edition)
    {
        $edition = Edition::findOrFail($edition->id);

        $data = $request->validate([
            'title' => ['required','string','max:100'],
            'date' => ['required','date'],
            'status' => ['required','integer']
        ]);

        $edition->titre = $data['title'];
        $edition->date = $data['date'];
        $edition->status = $data['status'];

        $edition->save();

        toastr('Edition modifiée avec succès!', 'success');
        return redirect()->route('admin.edition.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Edition $edition)
    {
        $edition = Edition::findOrFail($edition->id);
        if ($edition->participants()->exists() || $edition->sponsorts()->exists()) {
            return response([
                'status' => 'error',
                'message' => 'Impossible de supprimer cette édition car elle contient des données.'
            ]);
        }

        $edition->delete();

        return response(['status' => 'success', 'message' => 'Edition Suprimées!']);
    }

    public function changeStatus(Request $request)
    {
        $edition = Edition::findOrFail($request->id);
        if ($request->status == 'true') {
            // Désactiver toutes les éditions
            Edition::query()->update([
                'status' => 0
            ]);
            // Activer uniquement l'édition sélectionnée
            $edition->status = 1;

        } else {

            // Désactiver uniquement cette édition
            $edition->status = 0;
        }

        $edition->save();

        return response(['message' => 'Status modifié!']);
    }
}
