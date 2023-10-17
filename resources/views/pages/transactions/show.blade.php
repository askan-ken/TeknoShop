@extends('main')
  @section('content')

    <section class="py-5">
      <div class="container">
        <h2 class="font-regular h5">{{ $title }}</h2>
        <hr class="hr-section-1"><hr class="hr-section-2">
        @if( session('message') )
        {!! session('message') !!}
        @endif
        @if( $transaction->status == 'menunggu pembayaran' )
        <div class="alert alert-warning" role="alert">
          Segera lakukan pembayaran
        </div>
        @endif
        <div class="row g-3">
          <div class="col-12 col-md-6 col-lg-7">
            <h3 class="font-bold h6">Daftar Pembelian</h3>
            @foreach( $transaction->purchases as $purchase )
            <div class="card mb-2">
              <div class="card-body">
                <div class="row">
                  <div class="col-9 border-end">
                    <div class="card border-0">
                      <div class="row g-0">
                        <div class="col-5 col-md-4 col-lg-2">
                          <img src="/storage/{{ $purchase->product->photo }}" class="img-fluid rounded" alt="{{ $purchase->product->name }}">
                        </div>
                        <div class="col-7 col-md-8 col-lg-10">
                          <div class="card-body py-1">
                            <p class="card-text font-bold m-0">{{ $purchase->product->name }}</p>
                            <p class="card-text my-text-gray m-0">{{ $purchase->count . ' x ' . rupiah($purchase->product->price) }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <p class="m-0">Total Harga</p>
                    <p class="font-bold m-0">{{ rupiah($purchase->price) }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <h3 class="font-bold h6 mt-3">Informasi Transaksi</h3>
            <dl class="row mb-0">
              <dt class="col-3 mb-0">Total harga</dt>
              <dd class="col-9 mb-0">: {{ rupiah($transaction->price_total) }}</dd>
              <dt class="col-3 mb-0">Status transaksi</dt>
              <dd class="col-9 mb-0" id="status" data-status="{{ $transaction->status }}">: {{ $transaction->status }}</dd>
              <dt class="col-3 mb-0">Catatan</dt>
              <dd class="col-9 mb-0">: {{ $transaction->notes }}</dd>
            </dl>
          </div>
          
          <div class="col-12 col-md-6 col-lg-5">
            <h3 class="font-bold h6  mb-2">Nomor Rekening</h3>
            <div class="card">
              <div class="card-body">
                <h6>Pembayaran dapat melalui nomor rekening dibawah ini :</h6>
                <h6>579801016686507 (BRI) a.n. Gilang Eko Prasetyo</h6>  
              </div>
          </div>
            <h3 class="font-bold h6 mt-4">Upload Bukti Pembayaran</h3>
            @if ($transaction->status === 'menunggu pembayaran')
            <h5 id="countdown" class="text-danger">Batas Waktu: 0 Jam 0 Menit 0 Detik</h5>
            @endif
            <div class="card">
              <div class="card-body" id="card">
                @if( $transaction->status == 'menunggu pembayaran' )
                <form action="/transactions/{{ $transaction->id }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="status" value="diproses">
                  <div class="mb-2">
                    <label for="payment" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" id="file" name="payment" class="form-control  @error('payment') is-invalid @enderror" id="payment" required>
                    @error('payment')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn my-btn-warning w-100" id="btn-submit">Upload</button>
                </form>
                <hr>
                <form action="/transactions/{{ $transaction->id }}" method="post" onsubmit="return confirm('yakin ingin membatalkan pembelian?')" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="status" value="dibatalkan">
                  <button type="submit" class="btn btn-danger w-100">Batalkan</button>
                </form>
                @elseif( $transaction->status == 'dibatalkan' )
                <p>transaksi dibatalkan</p>
                @elseif( $transaction->status == 'ditolak' )
                <p>transaksi ditolak</p>
                @elseif( $transaction->status == 'diproses' or $transaction->status == 'selesai' )
                <a href="/storage/{{ $transaction->payment }}" target="_blank" class="btn btn-warning w-100">Lihat bukti pembayaran</a>
                @elseif( $transaction->status == 'dikirim' )
                <a href="/storage/{{ $transaction->payment }}" target="_blank">Lihat bukti pembayaran</a>
                <form action="/transactions/{{ $transaction->id }}" class="mt-2" method="post" onsubmit="return confirm('yakin barang sudah sampai?')" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="status" value="selesai">
                  <button type="submit" class="btn btn-warning w-100">Selesaikan</button>
                </form>
                @endif
              </div>
            </div>
        </div>
      </div>
    </section>
@endsection
@section('script')
<script src="/assets/js/cart.js"></script>
<script>
  const deadline = {{ strtotime($transaction->batas_waktu) }}
  let countdownInterval;

  async function updateCountDown(){
            const now = Math.floor(Date.now()/1000)
            const remainingTime = deadline - now

            if(remainingTime > 0){
                const hours = Math.floor(remainingTime / 3600);
                const minutes = Math.floor((remainingTime % 3600) / 60)
                const seconds = remainingTime % 60

                $("#countdown").html(" Batas Waktu: "  + hours + " Jam " + minutes + " Menit " + seconds + " Detik ")
            }else{
                $("#countdown").html('Waktu Habis')
                clearInterval(countdownInterval)
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch("http://127.0.0.1:8000/cancel-transaction/"+{{ $transaction->id }},{
                  method:'PATCH',
                  headers:{
                    'X-CSRF-Token': csrfToken,
                    'Content-Type': 'application/json'
                  }
                });
                const result = await response.json()
                if(result.status){
                  $('#status').html(': dibatalkan')
                  $('#card').html('<p>transaksi dibatalkan</p>')
                }
            }
  }

  $(document).ready(function(){
     if($("#status").attr('data-status') === "menunggu pembayaran"){
       countdownInterval = window.setInterval(updateCountDown, 1000);
     } 
  })
  // window.setInterval(updateCountDown, 1000);
</script>
@endsection