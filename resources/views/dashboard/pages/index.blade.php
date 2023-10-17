@extends('dashboard.main')
@section('content')
  <div class="row mb-3 g-3">
    <div class="col-12 col-md-6">
      <div class="card bg-warning text-white rounded">
        <div class="card-body">
          <h2 class="h4">Transaksi Pending</h2>
          <p class="fw-bold m-0 p-0 h1">{{ $pending_transaction }}</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card bg-success text-white rounded">
        <div class="card-body">
          <h2 class="h4">Banyak Transaksi</h2>
          <p class="fw-bold m-0 p-0 h1">{{ $transaction }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-md-4">
      <div class="card bg-primary text-white rounded">
        <div class="card-body">
          <h2 class="h4">Banyak Produk</h2>
          <p class="fw-bold m-0 p-0 h1">{{ $product }}</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card bg-secondary text-white rounded">
        <div class="card-body">
          <h2 class="h4">Banyak Pengguna</h2>
          <p class="fw-bold m-0 p-0 h1">{{ $buyer }}</p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card bg-info text-white rounded">
        <div class="card-body">
          <h2 class="h4">Banyak Administrator</h2>
          <p class="fw-bold m-0 p-0 h1">{{ $administrator }}</p>
        </div>
      </div>
    </div>
  </div>
@endsection