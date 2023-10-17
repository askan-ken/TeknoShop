@extends('dashboard.main')
@section('content')

<div class="card mt-3 border-0 shadow-none">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/storage/{{ $buyer->photo }}" class="img-fluid rounded" alt="{{ $buyer->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title h5">{{ $buyer->name }}</h1>
        <p class="card-text"><strong>Username</strong><br> {{ $buyer->username }}</p>
        <p class="card-text"><strong>Email</strong><br> {{ $buyer->email }}</p>
        <p class="card-text"><strong>No. Telepon</strong><br> {{ $buyer->phone }}</p>
        <p class="card-text"><strong>Alamat</strong><br> {{ $buyer->address }}</p>
        <hr>
        <a href="/dashboard/users/buyers/{{ $buyer->id }}/edit" class="btn btn-success">ubah</a>
        <form action="/dashboard/users/buyers/{{ $buyer->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">hapus</button>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection