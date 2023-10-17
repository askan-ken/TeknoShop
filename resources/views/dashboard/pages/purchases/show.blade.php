@extends('dashboard.main')
@section('content')

  @if( session('message') )
  {!! session('message') !!}
  @endif

  <div class="row g-3">
    <div class="col-12 col-md-6 col-lg-7">
      <h3 class="fw-bold h6">Daftar Pembelian</h3>
      @foreach( $transaction->purchases as $purchase )
      <div class="card mb-2 rounded border shadow-none">
        <div class="card-body p-2">
          <div class="row">
            <div class="col-9 border-end">
              <div class="card border-0 shadow-none">
                <div class="row g-0">
                  <div class="col-5 col-md-4 col-lg-2">
                    <img src="/storage/{{ $purchase->product->photo }}" class="img-fluid rounded" alt="{{ $purchase->product->name }}">
                  </div>
                  <div class="col-7 col-md-8 col-lg-10">
                    <div class="card-body py-1">
                      <p class="card-text fw-bold m-0">{{ $purchase->product->name }}</p>
                      <p class="card-text my-text-gray m-0">{{ $purchase->count . ' x ' . rupiah($purchase->product->price) }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <p class="m-0">Total Harga</p>
              <p class="fw-bold m-0">{{ rupiah($purchase->price) }}</p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <h3 class="fw-bold h6 mt-3">Informasi Transaksi</h3>
      <dl class="row p-0">
        <dt class="col-3 fw-normal">Total harga</dt>
        <dd class="col-9 fw-bold">: {{ rupiah($transaction->price_total) }}</dd>
        <dt class="col-3 fw-normal">Pembeli</dt>
        <dd class="col-9">: {{ $transaction->user->name }}</dd>
        <dt class="col-3 fw-normal">Alamat</dt>
        <dd class="col-9">: {{ $transaction->user->address }}</dd>
        <dt class="col-3 fw-normal">Status transaksi</dt>
        <dd class="col-9">: {{ $transaction->status }}</dd>
        <dt class="col-3 fw-normal">Catatan</dt>
        <dd class="col-9">: {{ $transaction->notes }}</dd>
      </dl>
    </div>
    <div class="col-12 col-md-6 col-lg-5">
      <h3 class="fw-bold h6">Rincian Pembayaran</h3>
      <div class="card rounded border shadow-none">
        <div class="card-body p-2">
          @if( $transaction->status == 'dibatalkan' )
          <p>transaksi dibatalkan</p>
          @elseif( $transaction->status == 'ditolak' )
          <p>transaksi ditolak</p>
          @elseif( $transaction->status == 'dikirim' or $transaction->status == 'selesai' )
          <a href="/storage/{{ $transaction->payment }}" target="_blank" class="btn btn-warning w-100">Lihat bukti pembayaran</a>
          @elseif( $transaction->status == 'diproses' )
          <a href="/storage/{{ $transaction->payment }}" target="_blank">Lihat bukti pembayaran</a>
          <form action="/dashboard/purchases/{{ $transaction->id }}" class="mt-2" method="post" onsubmit="return confirm('yakin mengkonfirmasi?')" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="dikirim">
            <button type="submit" class="btn btn-warning w-100">Kirim</button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>


@endsection