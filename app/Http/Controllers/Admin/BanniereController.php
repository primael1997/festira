<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banniere;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BanniereController extends Controller
{
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
            'title' => ['required','max:200'],
            'description' => ['required','max:300'],
            'btn_url' => ['url'],
            'status' => ['required']
        ]);

        if ($request->hasFile('baner')) {
            // Upload to Cloudinary using the modern API wrapper
            $upload = Cloudinary::uploadApi()->upload(
                $request->file('banner')->getRealPath(),
                [
                    'folder' => 'festira/bannieres'
                ]
            );

            // Extract required attributes from the response array
            $secureUrl = $upload['secure_url'];
            $publicId  = $upload['public_id'];
        }

        Banniere::create([
            'image' => $secureUrl,
            'title' => $request->title,
            'description' => $request->description,
            'btn_url' => $request->btn_url,
            'public_id' => $publicId,
            'status' => $request->status
        ]);

        toastr('Banniere ajoutée!', 'success');
        return redirect()->back();
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
        $baner = Banniere::find($id);

        $request->validate([
            'banner' => ['required','image', 'max:2000'],
            'title' => ['required','max:200'],
            'description' => ['required','max:300'],
            'btn_url' => ['url'],
            'status' => ['required']
        ]);

        if ($request->hasFile('baner')) {
            if ($baner->public_id) {
                // Supprimer le fichier sur Cloudinary
                $response = Cloudinary::uploadApi()->destroy($baner->public_id);
            }
            // Upload to Cloudinary using the modern API wrapper
            $upload = Cloudinary::uploadApi()->upload(
                $request->file('banner')->getRealPath(),
                [
                    'folder' => 'festira/bannieres'
                ]
            );

            // Extract required attributes from the response array
            $secureUrl = $upload['secure_url'];
            $publicId  = $upload['public_id'];

        }

        $baner->update([
            'image' => $secureUrl,
            'title' => $request->title,
            'description' => $request->description,
            'btn_url' => $request->btn_url,
            'public_id' => $publicId,
            'status' => $request->status
        ]);

        toastr('Banniere modifiée!', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $baner = Banniere::findOrFail($id);
        if ($baner->public_id) {

            // Supprimer le fichier sur Cloudinary
            $response = Cloudinary::uploadApi()->destroy($baner->public_id);

        }
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
