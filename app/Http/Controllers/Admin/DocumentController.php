<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CategoryDocument;
use App\Models\Document;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::orderBy('id','desc')->paginate(10);

        return view('admin.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryDocument::orderBy('id','desc')->get();

        return view('admin.document.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required','string',
            'description' => 'required','string',
            'category' => 'required','integer',
            'image' => 'nullable',
            'doc' => 'required','file','mimes:pdf',
        ]);

        /** Handle the image upload */
        $image = $this->uploadImage($request, 'image', 'uploads');
        $file_doc = $this->uploadFile($request, 'doc', 'files');

        $file = new Document();
        $file->title = $request->title;
        $file->slug = Str::slug($request->title);
        $file->description = $request->description;
        $file->category_document_id = $request->category;
        $file->image = $image;
        $file->file = $file_doc;
        $file->save();

        toastr()->success('Document ajouté avec succès');
        return redirect()->route('admin.documents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $file = Document::where('slug', $slug)->first();

        return response()->file(public_path($file->file));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file = Document::findOrFail($id);
        $categories = CategoryDocument::orderBy('id','desc')->get();

        return view('admin.document.edit', compact('file','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required','string',
            'description' => 'required','string',
            'category' => 'required','integer',
            'image' => 'nullable',
            'doc' => 'nullable','file','mimes:pdf',
        ]);

        $file = Document::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'uploads', $file->image);
        $filePath = $this->updateFile($request, 'doc', 'files', $file->file);

        $file->title = $request->title;
        $file->slug = Str::slug($request->title);
        $file->description = $request->description;
        $file->category_document_id = $request->category;
        $file->image = empty(!$imagePath) ? $imagePath : $file->image;
        $file->file = empty(!$filePath) ? $filePath : $file->file;

        $file->save();

        toastr()->success('Document modifié avec succès');
        return redirect()->route('admin.documents.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = Document::findOrFail($id);
        $this->deleteImage($file->image);
        $this->deleteImage($file->file);

        $file->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }
}
