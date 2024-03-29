<!doctype html>
<html lang="en" id="home">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TeknoShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body class="mt-5">

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light my-bg-warning">
<div class="container">
  <a class="navbar-brand font-bold" href="#home">
    <img src="/assets/images/logo-2.png" alt="TeknoShop Logo" width="200"> <!-- Ganti 'logo.png' dengan nama file logo Anda -->
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item me-lg-3">
          <a class="nav-link active" href="#home">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/kategori?type=Laki-laki">Laki-laki</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kategori?type=Perempuan">Perempuan</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kategori?type=Unisex">Unisex</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kategori?type=makanan">makanan</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kategori?type=karya">karya</a></li>

          </ul>
        </li>
        <li class="nav-item me-lg-3">
          <a class="nav-link" href="#produk">Produk</a>
        </li>
        @guest
        <li class="nav-item">
          <a class="nav-link btn btn-sm my-btn-dark font-medium px-3 py-1 mt-1" href="/login">Login</a>
        </li>
        @endguest
        @can('is-administrator')
        <li class="nav-item">
          <a class="nav-link btn btn-sm my-btn-dark font-medium px-3 py-1 mt-1 me-lg-3" href="/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <form action="/logout" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="nav-link btn btn-sm my-btn-dark font-medium w-100 px-3 py-1 mt-1">Logout</button>
          </form>
        </li>
        @endcan
        @can('is-buyer')
        <li class="nav-item">
          <a class="nav-link btn btn-sm my-btn-dark font-medium px-3 py-1 mt-1 me-lg-3" href="/cart">
            <i class="mdi mdi-cart"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role a-button" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="rounded-circle" height="30" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile image">
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/transactions">Transaksi</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/profile">Profil</a></li>
            <li><a class="dropdown-item" href="/change-password">Ubah Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="post" class="dropdown-item">
                @method('delete')
                @csrf
                <button type="submit" class="border-0 bg-transparent">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endcan
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<!-- Hero -->
<div class="card text-white bg-pink rounded-0 card-hero py-5" style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
  <div class="container py-5">
  <div class="flower-container">
      <!-- Kelopak Bunga -->
      <div class="flower-petal petal-1"></div>
      <div class="flower-petal petal-2"></div>
      <div class="flower-petal petal-3"></div>
      <div class="flower-petal petal-4"></div>

      <!-- ... (tambahkan lebih banyak kelopak bunga sesuai kebutuhan) -->
    </div>

    <p class="card-text text-orange mb-0 d-flex justify-content-center" style="font-size: 50px; font-family: 'Monotype corsiva', sans-serif; font-weight: 500; text-shadow: 2px 2px 5px orange;">
      Selamat Belanja Di
    </p>
    <h1 class="card-title text-orange d-flex justify-content-center" style="font-size: 100px; font-family: 'Monotype corsiva', sans-serif; font-weight: 700; text-shadow: 2px 2px 5px white; color: red;">
  TeknoShop
</h1>

    </h1>
    <hr class="hr-hero-1 d-flex justify-content-center" style="background-color: #00ffff; height: 2px; width: 100%; border: none;">
    <hr class="hr-hero-2 d-flex justify-content-center" style="background-color: #00ffff; height: 2px; width: 60%; border: none;">
    <p class="card-text text-capitalize text-white mb-0 d-flex justify-content-center" style="font-size: 30px; font-family: 'Monotype corsiva', sans-serif; font-weight: 500; text-shadow: 2px 2px 5px orange;">
      Beli Produk Yang di Jual Oleh Mahasiswa kami
    </p>
    <a href="/products" class="btn btn-warning text-uppercase font-dark mt-3" style="margin-left: 43%; font-weight: bold; background-color: orange; color: #fff;">
  Belanja Sekarang
</a>

    </a>
  </div>
</div>



<!-- End Hero -->

<!-- Produk -->
<section id="produk" class="produk py-5">
  <div class="container">
    <h2 class="font-regular h5">Daftar Produk</h2>
    <hr class="hr-section-1"><hr class="hr-section-2">
    <div class="row justify-content-center g-3">
      @foreach( $products as $product )
      <div class="col-6 col-md-4 col-lg-3">
        <a class="product-item" href="/products/{{ $product->id }}">
          <div class="card my-border-gray">
            <img  src="<?php echo asset("storage/$product->photo")?>" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body text-center">
              <p class="text-capitalize mb-1">{{ $product->name }}</p>
              <p class="font-bold mb-0">{{ rupiah($product->price) }}</p>
              @if( $product->stock > 0 )
                <p class="card-text">Stok : {{ $product->stock }}</p>
              @else
                <p class="card-text text-danger">Stok Habis</p>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-3">
      <a href="/products" class="btn my-btn-warning">Semua Produk</a>
    </div>
  </div>
</section>
<!-- End Produk -->

<!-- Kontak dan Peta -->
<section id="brand" class="brand py-5 my-bg-gray">
  <div class="container">
    <hr class="my-4">
    <div class="row">
      <div class="col-md-6">
        <h2 class="text-uppercase font-bold h6">Contact Us</h2>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="mailto:askan.ken17@gmail.com" class="text-decoration-none text-black">
              <img src="/assets/images/foo_mail.svg" alt="email" height="20" class="me-2">
              askan.ken17@gmail.com
            </a>
          </li>
          <li class="mb-2">
            <img src="/assets/images/foo_call.svg" alt="phone" height="20" class="me-2">
            081386721966
          </li>
          <li class="mb-2">
            <img src="/assets/images/foo_map.svg" alt="address" height="20" class="me-2">
            Kampung Baru. Bumi Manti IV
          </li>
          <li class="mb-2">
            <a href="https://wa.me/6281386721966" class="text-decoration-none text-black" target="_blank">
              <img src="/assets/images/wa.svg" alt="address" height="20" class="me-2">
              wa.me/6281386721966
            </a>
          </li>
          <li class="mb-2">
            <a href="https://www.instagram.com/habi2e12" class="text-decoration-none text-black" target="_blank">
              <img src="/assets/images/ig.svg" alt="Instagram" height="20" class="me-2">
              habi2e12
            </a>
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <h2 class="text-uppercase font-bold h6">Map</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.2266202168294!2d105.25524097359336!3d-5.382383994596551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dadc7970b277%3A0x5b1fe57f83b6416c!2sUniversitas%20Teknokrat%20Indonesia!5e0!3m2!1sid!2sid!4v1701757880998!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p class="text-end">TeknoShop &copy; 2023</p>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="/assets/js/vanilla-tilt.min.js"></script>
<script type="text/javascript">
  // It also supports NodeList
  VanillaTilt.init(document.querySelectorAll(".product-item"), {
    max: 35,
    speed: 400
  });
</script>
</body>
</html>
