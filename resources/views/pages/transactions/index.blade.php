@extends('main')
  @section('content')

    <section class="py-5">
      <div class="container">
        <h2 class="font-regular h5">{{ $title }}</h2>
        <hr class="hr-section-1"><hr class="hr-section-2">
        @if( session('message') )
        {!! session('message') !!}
        @endif

        <div class="row justify-content-end">
          <div class="col-12 col-md-6 col-xl-4">
            <form action="/transactions" method="get">
              <div class="input-group mb-3">
                <select name="status" class="form-control">
                  <option value="">Semua</option>
                  <option value="menunggu pembayaran" {{ request('status') == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                  <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                  <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                  <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                  <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                  <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <div class="input-group-append">
                  <button class="btn my-btn-warning rounded-0 rounded-end" type="submit"><i class="mdi mdi-filter"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>

        @if( count($transactions) > 0 )
        <div class="row gy-3">

          @foreach($transactions as $transaction)
          <div class="col-12 col-md-6">
            <a href="/transactions/{{ $transaction->id }}" class="text-decoration-none transaction-item">
              <div class="card">
                <div class="card-body">
                  <p class="font-weight-bold text-dark m-0">
                    <span class="font-weight-normal">{{  '(' . $transaction->created_at->isoFormat('D MMMM Y HH:mm:ss') . ')' }}</span>
                    @if( $transaction->status == 'menunggu pembayaran' )
                    <span class="badge bg-warning text-small ml-3">{{ $transaction->status }}</span></p>
                    @elseif( $transaction->status == 'selesai' )
                    <span class="badge bg-success text-small text-white ml-3">{{ $transaction->status }}</span></p>
                    @elseif( $transaction->status == 'dibatalkan' )
                    <span class="badge bg-danger text-small text-white ml-3">{{ $transaction->status }}</span></p>
                    @else
                    <span class="badge bg-primary text-small text-white ml-3">{{ $transaction->status }}</span></p>
                    @endif
                    <p class="m-0">Pembelian : {{ $transaction->purchases[0]->product->name }}
                    @if( count($transaction->purchases) > 1 )
                    {{ 'dan ' . count($transaction->purchases) - 1 . ' lainnya.' }}
                    @endif
                    </p>
                    <p class="m-0">Total Biaya : {{ rupiah($transaction->price_total) }}</p>
                </div>
              </div>
            </a>
          </div>
          @endforeach

          {{ $transactions->links() }}

        </div>
        @else
        <p>belum ada transaksi pembelian</p>
        @endif
      </div>
    </section>
@endsection
@section('script')
<script src="/assets/js/cart.js"></script>
@endsection