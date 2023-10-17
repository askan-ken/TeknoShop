<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="/dashboard">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{ request()->is('dashboard/categories*') ? 'active' : '' }}">
      <a class="nav-link" href="/dashboard/categories">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Category</span>
      </a>
    </li>
    <li class="nav-item nav-category">Data Master</li>
    <li class="nav-item  {{ request()->is('dashboard/products*') ? 'active' : '' }}">
      <a class="nav-link" href="/dashboard/products">
        <i class="menu-icon mdi mdi-hanger"></i>
        <span class="menu-title">Produk</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->is('dashboard/users*') ? 'collapsed' : '' }}" data-bs-toggle="collapse" href="#users" aria-expanded="{{ request()->is('dashboard/users*') ? 'true' : 'false' }}" aria-controls="users">
        <i class="menu-icon mdi mdi-account-multiple-outline"></i>
        <span class="menu-title">Pengguna</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ request()->is('dashboard/users*') ? 'show' : '' }}" id="users">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{ request()->is('dashboard/users/buyers*') ? 'active' : '' }}"> <a class="nav-link" href="/dashboard/users/buyers">Pelanggan</a></li>
          <li class="nav-item {{ request()->is('dashboard/users/administrators*') ? 'active' : '' }}"> <a class="nav-link" href="/dashboard/users/administrators">Administrator</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{ request()->is('dashboard/purchases*') ? 'active' : '' }}">
      <a class="nav-link" href="/dashboard/purchases">
        <i class="menu-icon mdi mdi-shopping"></i>
        <span class="menu-title">Penjualan</span>
      </a>
    </li>
    <li class="nav-item nav-category">Rekap</li>
    <li class="nav-item {{ request()->is('dashboard/reports*') ? 'active' : '' }}">
      <a class="nav-link" href="/dashboard/reports">
        <i class="mdi mdi-table menu-icon"></i>
        <span class="menu-title">Laporan</span>
      </a>
    </li>
  </ul>
</nav>