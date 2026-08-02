<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required','unique:categories,name',
        ]);

        Category::create($data);

        toastr('Catégorie ajoutée avec succès!', 'success');
        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validate([
            'name' => 'required','unique:categories,name,'.$id,
        ]);

        $category->name = $data['name'];
        $category->save();

        toastr('Catégorie modifiée avec succès!', 'success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $post = Post::where('category_id', $category->id)->count();
        if($post > 0){
            return response(['status' => 'error', 'message' => 'Cette catégorie contient des articles et ne peut être supprimé']);
        }
        $category->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }
}
