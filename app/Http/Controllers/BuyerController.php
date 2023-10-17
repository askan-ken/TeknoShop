<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.buyers.index', [
            'title' => 'Data Pelanggan',
            'buyers' => User::where('role', 'buyer')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.buyers.create', [
            'title' => 'Tambah Data Pelanggan'
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
            'address' => 'required',
        ]);


        $validated['password'] = bcrypt($request->username);
        $validated['role'] = 'buyer';

        User::create($validated);
        return redirect('/dashboard/users/buyers')->with('message', '<div class="alert alert-success" role="alert">Data pelanggan <strong>berhasil</strong> ditambah.</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $buyer)
    {
        if( $buyer->role !== 'buyer' or $buyer->id == auth()->user()->id ) :
            abort(403);
        endif;
        return view('dashboard.pages.buyers.show', [
            'title' => $buyer->name,
            'buyer' => $buyer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $buyer)
    {
        if( $buyer->role !== 'buyer' or $buyer->id == auth()->user()->id ) :
            abort(403);
        endif;
        return view('dashboard.pages.buyers.edit', [
            'title' => 'Ubah Pelanggan ' . $buyer->name,
            'buyer' => $buyer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $buyer)
    {
        if( $buyer->role !== 'buyer' or $buyer->id == auth()->user()->id ) :
            abort(403);
        endif;
        $rules = [
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3',
            'email' => 'required|email:dns',
            'phone' => 'required|min:11|max:13',
            'address' => 'required',
        ];

        if( $request->username != $buyer->username ) :
            $rules['username'] = 'required|min:3|unique:users,username';
        endif;
        if( $request->email != $buyer->email ) :
            $rules['email'] = 'required|email:dns|unique:users,email';
        endif;

        $validated = $request->validate($rules);


        $validated['password'] = bcrypt($request->username);
        $validated['role'] = 'buyer';

        User::find($buyer->id)->update($validated);
        return redirect('/dashboard/users/buyers')->with('message', '<div class="alert alert-success" role="alert">Data pelanggan <strong>berhasil</strong> diubah.</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $buyer)
    {
        if( $buyer->role !== 'buyer' or $buyer->id == auth()->user()->id ) :
            abort(403);
        endif;
        if( $buyer->photo != 'photos/profiles/avatar.png' ) :
            Storage::delete($buyer->photo);
        endif;
        User::find($buyer->id)->delete();
        return redirect('/dashboard/users/buyers')->with('message', '<div class="alert alert-success" role="alert">Data pelanggan <strong>berhasil</strong> dihapus.</div>');
    }
}
