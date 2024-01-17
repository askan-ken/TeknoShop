@extends('auth.main')
@section('content')
<style>
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background-image: url('/assets/images/walp.jpg');
    background-size: cover;
    background-position: left;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white; /* Set text color to white */
}

.overlay-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.form-container {
    position: relative;
    z-index: 1;
    background-image: url('/assets/images/okk.avif');

    padding: 20px;
    border-radius: 20px;
    text-align: left;
    margin-top: 50px; /* Increase the margin to move the form down */
}

.form-group {
    color: white;
}

.logo-container {
    text-align: center;
    margin-bottom: 20px; /* Add margin to create space between logo and form */
}

.logo-container img {
    height: 200px; /* Adjust the height of the logo as needed */
}

.mt-4 a.text-black {
        color: black;
    }
    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="password"],
    .form-container textarea {
        color: white;
    }

    /* Tambahkan gaya untuk mempertebal teks di textarea */
    .form-container textarea {
        font-weight: bold;
        color: white !important;

    }
</style>
</head>
<body>

<div class="overlay-container">
    <div class="logo-container">
        <img src="/assets/images/logo-2.png" alt="Logo TeknoShop" class="mb-3">
    </div>
    
    <div>
        <form class="pt-3 form-container" method="POST" accept="/register">
        @csrf
       <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="nama" required>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username" placeholder="Username" required>
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email" required>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="phone">No. Telepon</label>
        <input type="text" id="phone" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" placeholder="Nomor telepon" required>
        @error('phone')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="address">Alamat</label>
        <textarea rows="5" id="address" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('address') is-invalid @enderror" name="address" placeholder="Alamat" required>{{ old('address') }}</textarea>
        @error('address')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="password">Konfirmasi Password</label>
        <input type="password" id="password" style="width: 400px; height: 40px; border-radius:10px;" class="form-control form-control-lg @error('password_confirm') is-invalid @enderror" name="password_confirm" placeholder="Konfirmasi password">
        @error('password_confirm')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn">DAFTAR</button>
      </div>
      <div class="mt-4 fw-black">
        Sudah punya akun? <a href="/login" class="text-warning">Login</a>
      </div>
    </form>
  </div>

  @endsection