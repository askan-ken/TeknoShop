@extends('dashboard.main')
@section('content')

  @if( session('message') )
  {!! session('message') !!}
  @endif

  <div class="row justify-content-end">
    <div class="col-12 col-md-8 col-lg-6">
      <form action="/dashboard/purchases" method="get" class="mb-3">
        <div class="form-group d-flex mb-1">
          <select name="date" class="form-select rounded-0 rounded-start">
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
          </select>
          <button type="submit" class="add btn btn-sm btn-warning rounded-0 rounded-end"><i class="mdi mdi-filter"></i></button>
        </div>
      </form>
    </div>
  </div>

  <table class="table table-bordered w-100 mb-3" id="dataTable" cellspacing="0">
      <thead>
          <tr>
              <th>Tanggal</th>
              <th>Pembeli</th>
              <th>Produk</th>
              <th>Status</th>
              <th>*</th>
          </tr>
      </thead>
      <tbody>
        @foreach( $transactions as $transaction )
          <tr>
            <td class="align-middle">{{ $transaction->created_at->isoFormat('D MMMM Y HH:mm') }}</td>
            <td class="align-middle">{{ $transaction->user->name }}</td>
            <td class="align-middle">
              {{ $transaction->purchases[0]->product->name }}
              @if( count($transaction->purchases) > 1 )
              {{ 'dan ' . count($transaction->purchases) - 1 . ' lainnya.' }}
              @endif
            </td>
            <td class="align-middle">{{ $transaction->status }}</td>
            <td class="align-middle">
              <a href="/dashboard/purchases/{{ $transaction->id }}" class="btn btn-sm btn-primary rounded">detail</a>
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>

@endsection
@section('script')
  @include('dashboard.partials.data-table')
@endsection