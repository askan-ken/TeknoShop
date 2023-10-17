@extends('dashboard.main')
@section('content')

  @if( session('message') )
  {!! session('message') !!}
  @endif

  <div class="row justify-content-end">
    <div class="col-12 col-md-8 col-lg-6">
      <form action="/dashboard/reports" method="get">
        <div class="form-group d-flex align-items-center mb-1">
          {{-- <select name="date" class="form-select rounded-0 rounded-start">
            <option value="">Semua</option>
            <option value="hari ini" {{ request('date') == 'hari ini' ? 'selected' : '' }}>Hari ini</option>
            <option value="minggu ini" {{ request('date') == 'minggu ini' ? 'selected' : '' }}>Minggu ini</option>
            <option value="bulan ini" {{ request('date') == 'bulan ini' ? 'selected' : '' }}>Bulan ini</option>
            <option value="tahun ini" {{ request('date') == 'tahun ini' ? 'selected' : '' }}>Tahun ini</option>
          </select>
          <select name="status" class="form-select rounded-0">
            <option value="">Semua</option>
            <option value="menunggu pembayaran" {{ request('status') == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Membayaran</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
          </select> --}}
          <label for="start">Awal</label>
          <input type="date" id="start" name="start_time" class="form-control" value="{{ request("start_time") }}" required>
          <label for="end">Akhir</label>
          <input type="date" id="end" name="end_time" class="form-control" value="{{ request("end_time") }}" required>
          <button type="submit" class="add btn btn-sm btn-warning rounded-0 rounded-end"><i class="mdi mdi-filter"></i></button>
        </div>
      </form>
    </div>
  </div>

  <div class="row justify-content-end mb-3">
    <div class="col-auto">
      <a target="_blank" href="/dashboard/reports/print?start_time={{ request('start_time') }}&end_time={{ request('end_time') }}" class="btn btn-sm btn-danger rounded"><i class="mdi mdi-printer"></i> Cetak PDF</a>
    </div>
  </div>

  <table class="table table-bordered w-100 mb-3" cellspacing="0">
      <thead>
          <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Pembeli</th>
              <th>Produk</th>
              <th>Qty</th>
              <th>Harga Beli</th>
              <th>Total Harga</th>
              <th>Status</th>
          </tr>
      </thead>
      <tbody>
        @foreach( $transactions as $transaction )
          <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-light' : '' }}">
            <td class="align-middle text-center" rowspan="{{ count($transaction->purchases) }}">{{ $loop->iteration }}</td>
            <td class="align-middle" rowspan="{{ count($transaction->purchases) }}">{{ $transaction->created_at->isoFormat('D MMMM Y HH:mm') }}</td>
            <td class="align-middle" rowspan="{{ count($transaction->purchases) }}">{{ $transaction->user->name }}</td>
            <td class="align-middle">{{ $transaction->purchases[0]->product->name }}</td>
            <td class="align-middle">{{ $transaction->purchases[0]->count }} x {{ rupiah($transaction->purchases[0]->product->price) }}</td>
            <td class="align-middle">{{ rupiah($transaction->purchases[0]->price) }}</td>
            <td class="align-middle fw-bold" rowspan="{{ count($transaction->purchases) }}">{{ rupiah($transaction->price_total) }}</td>
            <td class="align-middle" rowspan="{{ count($transaction->purchases) }}">{{ $transaction->status }}</td>
          </tr>
          @if( count($transaction->purchases) > 1 )
          <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-light' : '' }}">
            @foreach( $transaction->purchases as $purchase )
              @if( $loop->index != 0 )
                <td class="align-middle">{{ $purchase->product->name }}</td>
                <td class="align-middle">{{ $purchase->count }} x {{ rupiah($purchase->product->price) }}</td>
                <td class="align-middle">{{ rupiah($purchase->price) }}</td>
              @endif
            @endforeach
          </tr>
          @endif
          @endforeach
      </tbody>
  </table>
  {{ $transactions->links() }}

@endsection