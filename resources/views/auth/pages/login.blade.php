@extends('auth.main')

@section('content')
<div class="container-fluid p-0 m-0">
  <div class="row justify-content-center align-items-center welcome-animation full-height" style="position: relative; overflow: hidden; background-image: url('/assets/images/walp.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; font-family: 'Roboto', sans-serif;">
    <div class="col-md-4" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); border-radius: 10px; position: relative; z-index: 2; background-color: rgba(255, 255, 255, 0.7); padding: 20px; overflow: hidden;">
      <img src="/assets/images/logo-2.png" height="200" alt="Logo TeknoShop" class="mb-3 mx-auto d-block" style="border-radius: 100px;">

      <h3 id="spectacular-text" class="text-center">Halo! Mari Belanja</h4>

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

      <form method="POST" action="/login">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control form-control-lg" name="username" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
        </div>
        <div class="mt-3 text-center">
          <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn">LOGIN</button>
        </div>
        <div class="text-center mt-4 fw-light welcome-animation register-link" style="animation-delay: 2s;">
          Belum punya akun? <a href="/register" class="text-warning">Daftar</a>
        </div>
      </form>
    </div>
    <div id="stars-container">
      <!-- Tambahkan bintang-bintang di sini -->
      @for ($i = 0; $i < 500; $i++)
        <div class="star" style="--delay: {{ rand() }};"></div>
      @endfor
    </div>
  </div>
</div>

<style>
  body, html {
    height: 100%;
    margin: 0;
    overflow: hidden;
  }

  .container-fluid {
    padding: 0;
  }

  .full-height {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  @keyframes welcomeFadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  .welcome-animation {
    animation: welcomeFadeIn 2s ease-in-out;
  }

  @keyframes spectacularAnimation {
    0% {
      transform: scale(1);
      color: #FFD700; /* Initial color, you can change it */
    }
    50% {
      transform: scale(1.2);
      color: #00FFFF; /* Middle color, you can change it */
    }
    100% {
      transform: scale(1);
      color: #FFD700; /* Final color, you can change it */
    }
  }

  #spectacular-text {
    animation: spectacularAnimation 2s ease-in-out infinite;
  }

  @keyframes starFall {
    from {
      transform: translateY(-100vh);
    }
    to {
      transform: translateY(100vh);
    }
  }

  .star {
    position: absolute;
    width: 2px;
    height: 2px;
    background-color: #FFF;
    animation: starFall 5s linear infinite;
    animation-delay: calc(-1 * var(--delay) * 1s);
  }

  #stars-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  /* Tambahkan style untuk animasi pilihan Daftar */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .register-link {
    display: inline-block;
    margin-top: 10px;
    animation: fadeInUp 1s ease-in-out;
  }
</style>
