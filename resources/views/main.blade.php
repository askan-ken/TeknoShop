<!doctype html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
  </head>
  <body class="mt-5">

    {{-- navbar --}}
    <nav class="navbar fixed-top navbar-expand-lg navbar-light my-bg-warning">
      <div class="container">
        <a class="navbar-brand font-bold" href="/">TeknoShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item me-lg-3">
              <a class="nav-link" href="/">Home</a>
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
              <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">Produk</a>
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
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    {{-- end navbar --}}

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="<?= url('') ?>/assets/js/jquery.min.js"></script>
    <script src="/assets/js/vanilla-tilt.min.js"></script>
    <script type="text/javascript">
      //It also supports NodeList
      VanillaTilt.init(document.querySelectorAll(".product-item"), {
        max: 35,
        speed: 400
      });
    </script>
    @yield('script')
  </body>
</html>
