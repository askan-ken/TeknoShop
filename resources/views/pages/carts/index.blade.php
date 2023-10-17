@extends('main')
  @section('content')

    <section class="py-5">
      <div class="container">
        <h2 class="font-regular h5">{{ $title }}</h2>
        <hr class="hr-section-1"><hr class="hr-section-2">
        @if (session("errorCheckout"))
            {!! session("errorCheckout") !!}
        @endif
        @if( count($carts) > 0 )
        <div class="row justify-content-center">
          <div class="col-12 col-md-8">
            <form action="/cart" method="post" id="formCheckout">
              @csrf
              @foreach ($carts as $item)
              <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-5 col-md-4 col-lg-2">
                    <img src="/storage/{{ $item->product->photo }}" class="img-fluid rounded-start" alt="{{ $item->product->name }}">
                  </div>
                  <div class="col-7 col-md-8 col-lg-10">
                    <div class="card-body py-1">
                      <p class="card-text font-bold m-0">{{ $item->product->name }}</p>
                      <p class="card-text m-0">{{ rupiah($item->product->price) }}</p>
                      @if( $item->product->stock > 0 )
                        <p class="card-text m-0">Stok : {{ $item->product->stock }}</p>
                      @else
                        <p class="card-text text-danger m-0">Stok Habis</p>
                      @endif
                      {{-- <input type="number" class="form-control w-50 total_beli" name="total_beli[]" min="1" max="{{ $item->product->stock }}" placeholder="1" value="{{ $item->total_beli }}"> --}}
                      <div class="form-check">
                        <input class="form-check-input cart-item-check-input" data-price="{{ $item->product->price }}" name="carts[]" type="checkbox" value="{{ $item->id }}" id="check_{{ $loop->iteration }}">
                        <label class="form-check-label" for="check_{{ $loop->iteration }}">Pilih</label>
                      </div>
                      <input type="hidden" name="total_harga">
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </form>
          </div>
          <div class="col-12 col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Ringkasan Checkout</h5>
                <p class="card-text">Total harga : Rp.<span id="price">0</span></p>
                <hr>
                <button class="btn my-btn-warning w-100" id="submitCheckout" disabled>Checkout</button>
              </div>
            </div>
          </div>
        </div>
        @else
        <p>keranjang masih kosong</p>
        @endif
        @if( count($buys) > 0 )
        <h2 class="font-regular h5 mt-4">Stok Habis</h2>
        <hr class="hr-section-1"><hr class="hr-section-2">
        <div class="row">
          <div class="col-12 col-md-8">
            @foreach ($buys as $item)
              <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-5 col-md-4 col-lg-2">
                    <img src="/storage/{{ $item->product->photo }}" class="img-fluid rounded-start" alt="{{ $item->product->name }}">
                  </div>
                  <div class="col-7 col-md-8 col-lg-10">
                    <div class="card-body py-1">
                      <p class="card-text font-bold m-0">{{ $item->product->name }}</p>
                      <p class="card-text m-0">{{ rupiah($item->product->price) }}</p>
                      @if( $item->product->stock > 0 )
                        <p class="card-text m-0">Stok : {{ $item->product->stock }}</p>
                      @else
                        <p class="card-text text-danger m-0">Stok Habis</p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
          </div>
        </div>
      @endif
      </div>
    </section>
@endsection
@section('script')
<script src="/assets/js/cart.js"></script>
@endsection