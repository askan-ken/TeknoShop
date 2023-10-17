@extends('auth.main')
@section('content')
  <img src="/assets/images/logo-srl.jpg" height="70" alt="Logo TeknoShop" class="mb-3">
  <h4>Halo! mari belanja</h4>
  <h6 class="fw-light">Daftar untuk lanjut belanja</h6>
  <form class="pt-3" method="POST" accept="/register">
    @csrf
    <div class="form-group">
      <label for="name">Nama</label>
      <input type="text" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="nama" required>
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" class="form-control form-control-lg @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username" placeholder="Username" required>
      @error('username')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email" required>
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="phone">No. Telepon</label>
      <input type="text" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" placeholder="Nomor telepon" required>
      @error('phone')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="address">Alamat</label>
      <textarea rows="5" id="address" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" placeholder="Alamat" required>{{ old('address') }}</textarea>
      @error('address')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Konfirmasi Password</label>
      <input type="password" id="password" class="form-control form-control-lg @error('password_confirm') is-invalid @enderror" name="password_confirm" placeholder="Konfirmasi password">
      @error('password_confirm')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn">DAFTAR</button>
    </div>
    <div class="mt-4 fw-light">
      Sudah punya akun? <a href="/login" class="text-warning">Login</a>
    </div>
  </form>
@endsection
