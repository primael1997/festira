<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banniere;
use App\Traits\ImageUploadTrait;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BanniereController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baners = Banniere::orderBy('id','desc')->get();

        return view('admin.banniere.index', compact('baners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banniere.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required','image', 'max:2000'],
            'title' => ['required','string','max:200'],
            'description' => ['required','max:300'],
            'btn_url' => ['url'],
            'status' => ['required']
        ]);

        /** Handle the image upload */
        $image = $this->uploadImage($request, 'banner', 'uploads');

        Banniere::create([
            'image' => $image,
            'title' => $request->title,
            'description' => $request->description,
            'btn_url' => $request->btn_url,
            'status' => $request->status
        ]);

        toastr('Banniere ajoutée!', 'success');
        return redirect()->route('admin.banniere.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $baner = Banniere::find($id);

        return view('admin.banniere.edit', compact('baner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $baner = Banniere::findOrFail($id);

        $request->validate([
            'banner' => ['nullable','image', 'max:2000'],
            'title' => ['required','max:200'],
            'description' => ['required','max:300'],
            'btn_url' => ['url'],
            'status' => ['required']
        ]);

        $imagePath = $this->updateImage($request, 'image', 'uploads', $baner->image);


        $baner->update([
            'image' => empty(!$imagePath) ? $imagePath : $baner->image,
            'title' => $request->title,
            'description' => $request->description,
            'btn_url' => $request->btn_url,
            'status' => $request->status
        ]);

        toastr()->success('Bannière modifiée avec succès.');
        return redirect()->route('admin.banniere.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $baner = Banniere::findOrFail($id);
        $this->deleteImage($baner->image);
        $baner->delete();

        return response(['status' => 'success', 'message' => 'Banniere supprimée!']);
    }

    public function changeStatus(Request $request)
    {
        $baner = Banniere::findOrFail($request->id);
        $baner->status = $request->status == 'true' ? 1 : 0;
        $baner->save();

        return response(['message' => 'Status modifié!']);
    }
}
