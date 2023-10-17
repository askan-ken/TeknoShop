@extends('main')
@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="font-regular h5">{{ $title }}</h2>
        <hr class="hr-section-1"><hr class="hr-section-2">
        <div class="row justify-content-center g-3">
            @foreach( $category->products as $product )
            <div class="col-6 col-md-4 col-lg-3">
              <a class="product-item" href="/products/{{ $product->id }}">
                <div class="card my-border-gray">
                  <img src="/storage/{{ $product->photo }}" class="card-img-top" alt="{{ $product->name }}">
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
    </div>
</section>
@endsection
@section('script')
@endsection
