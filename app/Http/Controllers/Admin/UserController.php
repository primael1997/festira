<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role',0)->orderBy('id','desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required','string',
            'email' => 'required','email','exists:users,email',
            'role' => 'required','integer',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->isAdmin = 1;
        $user->role = $request->role;
        $user->password = bcrypt('Festir@2026');

        $user->save();

        toastr()->success('Utilisateur ajouté avec succès');
        return redirect()->route('admin.users.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required','string',
            'email' => 'required','email','exists:users,email',
            'role' => 'required','integer',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->isAdmin = $request->role;

        $user->save();

        toastr()->success('Utilisateur modifié avec succès');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response(['status' => 'success', 'message' => 'Utilisateur Suprimés!']);
    }
}
