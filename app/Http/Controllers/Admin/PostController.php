<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Traits\ImageUploadTrait;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->get();

        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required','string',
            'description' => 'required','string',
            'content' => 'required','string',
            'category' => 'required','string',
            'image' => 'required','string',
        ]);

        /** Handle the image upload */
        $image = $this->uploadImage($request, 'image', 'uploads');

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->image = $image;
        $post->save();

        toastr()->success('Actualité ajoutée avec succès.');
        return redirect()->route('admin.posts.index');
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
        $categories = Category::orderBy('id','desc')->get();
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required','string',
            'description' => 'required','string',
            'content' => 'required','string',
            'category' => 'required','string',
            'image' => 'nullable','string',
        ]);

        /** Handle the image upload */
        $post = Post::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'uploads', $post->image);


        $post->image = empty(!$imagePath) ? $imagePath : $post->image;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->save();

        toastr()->success('Actualité modifiée avec succès');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $this->deleteImage($post->image);
        $post->delete();

        return response(['status' => 'success', 'Deleted Successfully!']);
    }
}
