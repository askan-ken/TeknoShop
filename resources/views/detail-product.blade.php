@extends('main')
  @section('content')

    {{-- produk --}}
    <section id="produk" class="produk py-5">
      <div class="container">
        <div class="card mb-3 border-0">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="/storage/{{ $product->photo }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                @if( session('message') )
                {!! session('message') !!}
                @endif
                <h1 class="card-title h5">{{ $product->name }}</h1>
                <p class="card-text font-bold h3">{{ rupiah($product->price) }}</p>
                @if( $product->stock > 0 )
                  <p class="card-text">Stok : {{ $product->stock }}</p>
                @else
                  <p class="card-text text-danger">Stok Habis</p>
                @endif
                <a class="btn btn-sm my-btn-warning" href="{{ $product->video_link }}" target="_blank">Lihat Video Peragaan</a>
                <hr>
                <p class="card-text">{!! $product->description !!}</p>
                @can('is-buyer')
                @if( $product->stock > 0 )
                <form action="/products/cart/{{ $product->id }}" method="post">
                  @csrf
                  {{-- <input type="number" class="form-control mb-3 w-50" name="total_beli" min="1" max="{{ $product->stock }}" placeholder="1" value="1"> --}}
                  <button type="submit" class="btn my-btn-warning">Masukkan Keranjang</button>
                </form>
                @endif
                @endcan
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- end produk --}}
@endsection