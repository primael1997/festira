<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('category:id,name')
            ->when($request->search, fn ($query, $search) => $query->where(
                fn ($sub) => $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
            ))
            ->when($request->category, fn ($query, $category) => $query->whereHas(
                'category',
                fn ($c) => $c->where('name', $category)
            ))
            ->latest()
            ->paginate(9)
            ->withQueryString()
            ->through(fn ($post) => $this->toCard($post));

        return Inertia::render('Actualites/Index', [
            'posts' => $posts,
            'categories' => Category::orderBy('name')->pluck('name'),
            'filters' => $request->only('search', 'category'),
        ]);
    }

    public function show(Post $post)
    {
        $post->load('category:id,name');

        return Inertia::render('Actualites/Show', [
            'post' => [
                'title' => $post->title,
                'image' => $post->image,
                'content' => $post->content,
                'category' => $post->category?->name,
                'date' => $post->created_at?->locale('fr')->translatedFormat('F d, Y'),
            ],
            'related' => Post::with('category:id,name')
                ->where('id', '!=', $post->id)
                ->latest()
                ->take(3)
                ->get()
                ->map(fn ($item) => $this->toCard($item)),
        ]);
    }

    private function toCard(Post $post): array
    {
        return [
            'title' => $post->title,
            'slug' => $post->slug,
            'image' => $post->image,
            'excerpt' => $post->description,
            'category' => $post->category?->name,
            'date' => $post->created_at?->locale('fr')->translatedFormat('F d, Y'),
        ];
    }
}
