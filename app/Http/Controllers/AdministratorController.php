<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.administrators.index', [
            'title' => 'Data Administrator',
            'administrators' => User::where('role', 'administrator')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.administrators.create', [
            'title' => 'Tambah Data Administrator'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email:dns|unique:users,email',
            'phone' => 'required|min:11|max:13',
        ]);

        $validated['password'] = bcrypt($request->username);
        $validated['role'] = 'administrator';

        User::create($validated);
        return redirect('/dashboard/users/administrators')->with('message', '<div class="alert alert-success" role="alert">Data administrator <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $administrator)
    {
        if( $administrator->role !== 'administrator' or $administrator->id == auth()->user()->id ) :
            abort(403);
        endif;
        return view('dashboard.pages.administrators.show', [
            'title' => $administrator->name,
            'administrator' => $administrator
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $administrator)
    {
        if( $administrator->role !== 'administrator' or $administrator->id == auth()->user()->id ) :
            abort(403);
        endif;
        return view('dashboard.pages.administrators.edit', [
            'title' => 'Ubah Administrator ' . $administrator->name,
            'administrator' => $administrator
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $administrator)
    {
        if( $administrator->role !== 'administrator' or $administrator->id == auth()->user()->id ) :
            abort(403);
        endif;
        $rules = [
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3',
            'email' => 'required|email:dns',
            'phone' => 'required|min:11|max:13',
        ];

        if( $request->username != $administrator->username ) :
            $rules['username'] = 'required|min:3|unique:users,username';
        endif;
        if( $request->email != $administrator->email ) :
            $rules['email'] = 'required|email:dns|unique:users,email';
        endif;

        $validated = $request->validate($rules);


        $validated['password'] = bcrypt($request->username);
        $validated['role'] = 'administrator';

        User::find($administrator->id)->update($validated);
        return redirect('/dashboard/users/administrators')->with('message', '<div class="alert alert-success" role="alert">Data administrator <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $administrator)
    {
        if( $administrator->role !== 'administrator' or $administrator->id == auth()->user()->id ) :
            abort(403);
        endif;
        if( $administrator->photo != 'photos/profiles/avatar.png' ) :
            Storage::delete($administrator->photo);
        endif;
        User::find($administrator->id)->delete();
        return redirect('/dashboard/users/administrators')->with('message', '<div class="alert alert-success" role="alert">Data administrator <strong>berhasil</strong> dihapus.</div>');
    }
}
