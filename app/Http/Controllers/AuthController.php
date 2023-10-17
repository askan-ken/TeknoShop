<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{


    public function login()
    {
        return view('auth.pages.login', [
            'title' => 'Halaman Login'
        ]);
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'administrator') :
                return redirect('/dashboard');
            else :
                return redirect('/');
            endif;
        }

        return redirect('/login')->with('failed', 'Login gagal. Pastikan username dan password benar.');
    }

    public function register()
    {
        return view('auth.pages.register', [
            'title' => 'Halaman Daftar Akun'
        ]);
    }

    public function registerAction(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|email:dns|unique:users,email',
            'phone' => 'required|min:11|max:13',
            'address' => 'required',
            'password' => 'required|min:8',
            'password_confirm' => 'same:password'
        ]);


        $validated['password'] = bcrypt($request->password);
        $validated['role'] = 'buyer';

        User::create($validated);
        return redirect('/login')->with('success', 'Registrasi berhasil. Silahkan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index()
    {
        return view('dashboard.pages.index', [
            'title' => 'Dashboard Admin',
            'product' => Product::count(),
            'transaction' => Transaction::count(),
            'pending_transaction' => Transaction::where('status', 'diproses')->count(),
            'administrator' => User::where('role', 'administrator')->count(),
            'buyer' => User::where('role', 'buyer')->count(),
        ]);
    }

    public function administratorProfile()
    {
        return view('dashboard.pages.administrators.profile', [
            'title' => 'Ubah Profil'
        ]);
    }

    public function administratorProfileAction(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3',
            'email' => 'required|email:dns',
            'phone' => 'required|min:11|max:13',
            'photo' => 'image|file|max:1500'
        ];

        if ($request->username != auth()->user()->username) :
            $rules['username'] = 'required|min:3|unique:users,username';
        endif;
        if ($request->email != auth()->user()->email) :
            $rules['email'] = 'required|email:dns|unique:users,email';
        endif;

        $validated = $request->validate($rules);

        if ($request->file('photo') != null) :
            if (auth()->user()->photo != 'photos/profiles/avatar.png') :
                Storage::delete(auth()->user()->photo);
            endif;
            $validated['photo'] = $request->file('photo')->store('photos/profiles');
        else :
            $validated['photo'] = auth()->user()->photo;
        endif;

        User::find(auth()->user()->id)->update($validated);
        return redirect('/dashboard/profile')->with('message', '<div class="alert alert-success" role="alert">Data profil <strong>berhasil</strong> diubah.</div>');
    }

    public function administratorChangePassword()
    {
        return view('dashboard.pages.administrators.change-password', [
            'title' => 'Ubah Password'
        ]);
    }

    public function changePasswordAction( Request $request )
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'password_confirm' => 'same:new_password'
        ]);
        $user = User::firstWhere('id', auth()->user()->id);

        if( !password_verify($validated['old_password'], $user->password) ) :
            if (auth()->user()->role == 'administrator') :
                return redirect('/dashboard/change-password')->with('message', '<div class="alert alert-danger" role="alert">Password lama <strong>salah!</strong>.</div>');
            else :
                return redirect('/change-password')->with('message', '<div class="alert alert-danger" role="alert">Password lama <strong>salah!</strong>.</div>');
            endif;
        endif;
        if( $validated['old_password'] === $validated['new_password'] ) :
            if (auth()->user()->role == 'administrator') :
                return redirect('/dashboard/change-password')->with('message', '<div class="alert alert-danger" role="alert">Password baru <strong>harus beda</strong> dengan password lama.</div>');
            else :
                return redirect('/change-password')->with('message', '<div class="alert alert-danger" role="alert">Password baru <strong>harus beda</strong> dengan password lama.</div>');
            endif;
        endif;

        User::where('id', auth()->user()->id)->update([
            'password' => bcrypt($validated['new_password'])
        ]);
        if (auth()->user()->role == 'administrator') :
            return redirect('/dashboard/change-password')->with('message', '<div class="alert alert-success" role="alert">Password <strong>berhasil</strong> diubah.</div>');
        else :
            return redirect('/change-password')->with('message', '<div class="alert alert-success" role="alert">Password <strong>berhasil</strong> diubah.</div>');
        endif;
    }

    public function buyerProfile()
    {
        return view('profile', [
            'title' => 'Ubah Profil'
        ]);
    }

    public function buyerProfileAction( Request $request )
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'username' => 'required|min:3',
            'address' => 'required',
            'email' => 'required|email:dns',
            'phone' => 'required|min:11|max:13',
            'photo' => 'image|file|max:1500'
        ];

        if ($request->username != auth()->user()->username) :
            $rules['username'] = 'required|min:3|unique:users,username';
        endif;
        if ($request->email != auth()->user()->email) :
            $rules['email'] = 'required|email:dns|unique:users,email';
        endif;

        $validated = $request->validate($rules);

        if ($request->file('photo') != null) :
            if (auth()->user()->photo != 'photos/profiles/avatar.png') :
                Storage::delete(auth()->user()->photo);
            endif;
            $validated['photo'] = $request->file('photo')->store('photos/profiles');
        else :
            $validated['photo'] = auth()->user()->photo;
        endif;

        User::find(auth()->user()->id)->update($validated);
        return redirect('/profile')->with('message', '<div class="alert alert-success" role="alert">Data profil <strong>berhasil</strong> diubah.</div>');
    }

    public function buyerChangePassword()
    {
        return view('change-password', [
            'title' => 'Ubah Password'
        ]);
    }

}
