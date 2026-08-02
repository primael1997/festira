<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Edition;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_edition = Edition::count();
        $total_actu = Post::count();
        $total_doc = Document::count();
        $total_user = User::count();

        $posts = Post::orderBy('id','desc')->limit(5)->get();

        return view('admin.dashboard', compact('posts','total_edition','total_actu','total_doc','total_user'));
    }
}
