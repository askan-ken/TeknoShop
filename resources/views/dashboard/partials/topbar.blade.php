<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row navbar-warning">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="/dashboard">
        TeknoShop
      </a>
      <a class="navbar-brand brand-logo-mini" href="/dashboard">
        ST
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text text-white">Hai, <span class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
        <h3 class="welcome-sub-text text-white">Semangat bekerja</h3>
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="rounded-circle" height="30" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile image">
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="rounded-circle" height="30" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile image">
            <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
            <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
          </div>
          <a href="/dashboard/profile" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil</a>
          <a href="/dashboard/change-password" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-key text-primary me-2"></i> Ubah Password</a>
          <form action="/logout" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                LogOut
            </button>
          </form>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
