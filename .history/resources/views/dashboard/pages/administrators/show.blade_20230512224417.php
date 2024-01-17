@extends('dashboard.main')
@section('content')

<div class="card mt-3 border-0 shadow-none">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/storage/{{ $administrator->photo }}" class="img-fluid rounded" alt="{{ $administrator->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title h5">{{ $administrator->name }}</h1>
        <p class="card-text"><strong>Username</strong><br> {{ $administrator->username }}</p>
        <p class="card-text"><strong>Email</strong><br> {{ $administrator->email }}</p>
        <p class="card-text"><strong>No. Telepon</strong><br> {{ $administrator->phone }}</p>
        <hr>
        <a href="/dashboard/users/administrators/{{ $administrator->id }}/edit" class="btn btn-success">ubah</a>
        <form action="/dashboard/users/administrators/{{ $administrator->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">hapus</button>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection