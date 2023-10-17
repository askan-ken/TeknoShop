@extends('main')
  @section('content')
    @php
      $price = 0;
    @endphp
    <section class="py-5">
      <div class="container">
        <h2 class="font-regular h5">{{ $title }}</h2>
        <hr class="hr-section-1"><hr class="hr-section-2">
        <p class="text-small font-bold">*jika barang tidak tampil, artinya barang sudah habis stok.</p>
        <div class="row justify-content-center">
          <div class="col-12 col-md-8">
            <form action="/checkout" method="post" id="formCheckout">
              @csrf
              <div class="mb-3">
                <label for="notes">Isi Catatan</label>
                <textarea name="notes" id="notes" rows="4" class="form-control" placeholder="Jika bukan dikirim atas nama anda atau bukan ke alamat anda, maka isi catatan sesuai pemesanan"></textarea>
              </div>
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
                      <input type="hidden" name="cartIds[]" value="{{ $item->id }}">
                      <input type="hidden" name="purchases[{{ $loop->index }}][product_price]" value="{{ $item->product->price }}">
                      <input type="hidden" name="purchases[{{ $loop->index }}][product_id]" value="{{ $item->product->id }}">
                      <input type="number" class="form-control form-control-sm form-input-count" name="purchases[{{ $loop->index }}][count]" placeholder="Banyak beli" min="1" max="{{ $item->product->stock }}" data-price="{{ $item->product->price }}" value="1">
                    </div>
                  </div>
                </div>
              </div>
              @php
                $price += $item->product->price;
              @endphp
              @endforeach
            </form>
          </div>
          <div class="col-12 col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Ringkasan Beli</h5>
                <p class="card-text">Total harga : <span id="price">{{ rupiah($price) }}</span></p>
                <hr>
                <button class="btn my-btn-warning w-100" id="submitCheckout">Beli</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('script')
<script src="/assets/js/checkout.js"></script>
@endsection