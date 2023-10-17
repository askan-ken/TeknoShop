@extends('dashboard.main')
@section('content')

<div class="card mt-3 border-0 shadow-none">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/storage/{{ $product->photo }}" class="img-fluid rounded" alt="{{ $product->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title h5">{{ $product->name }}</h1>
        <p class="card-text font-bold h3">{{ rupiah($product->price) }}</p>
        <p class="card-text">Stok : {{ $product->stock }}</p>
        <a class="btn btn-sm btn-warning" href="{{ $product->video_link }}" target="_blank">Lihat Video Peragaan</a>
        <hr>
        <p class="card-text">{!! $product->description !!}</p>

        <a href="/dashboard/products/{{ $product->id }}/edit" class="btn btn-success">ubah</a>
        <form action="/dashboard/products/{{ $product->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">hapus</button>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection