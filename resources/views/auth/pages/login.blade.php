@extends('auth.main')
@section('content')
  <img src="/assets/images/logo-srl.jpg" height="70" alt="Logo  TeknoShop" class="mb-3" style="margin-left: 45%">
  <h4 class="d-flex justify-content-center">Halo! Mari Belanja</h4>
  <h6 class="fw-light d-flex justify-content-center">Login untuk lanjut belanja</h6>
  @if (session('failed'))
  <div class="alert alert-danger alert-dismissible text-dark my-1" role="alert">
    {!! session('failed') !!}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  @endif
  @if (session('success'))
  <div class="alert alert-success alert-dismissible text-dark my-1" role="alert">
    {!! session('success') !!}
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible text-dark my-1" role="alert">
    Login gagal. Pastikan username dan password benar.
    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  @endif
  <form class="pt-3" method="POST" action="/login">
    @csrf
    <div class="form-group">
      <input type="text" class="form-control form-control-lg" name="username" placeholder="Username">
    </div>
    <div class="form-group">
      <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn" style="margin-left: 39.5%">LOGIN</button>
    </div>
    <div class="text-center mt-4 fw-light">
      Belum punya akun? <a href="/register" class="text-warning">Daftar</a>
    </div>
  </form>
@endsection
