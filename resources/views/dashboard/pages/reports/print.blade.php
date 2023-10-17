<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    *{
      font-family: serif;
    }
    .text-center{
      text-align: center;
    }
    table { 
        border-spacing: 0px;
        border-collapse: collapse;
        width: 100%;
      }
    table, td, th{
      border: 1px solid #000;
    }
    td {
      padding: 5px;
      vertical-align: middle;
    }
    th {
      padding: 10px;
    }
    table th{
      background-color: #dedede;
      vertical-align: middle;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
  <div style="width: 10%; float:left; margin-right: 20px;">
    <img src="{{ url('assets/images/logo-srl.jpg') }}" alt="" height="75px">
  </div>
  <div class="text-center">
    <h1>{{ $title }}</h1>
    @if($date)
    <p class="p-0 m-0">Waktu Pembelian : {{ $date }}</p>
    @endif
    @if($status)
    <p class="p-0 mb-3">Status Pembelian : {{ $status }}</p>
    @endif
  </div>
  <table>
    <thead>
      <tr>
        <th class="text-center">No</th>
        <th>Tanggal</th>
        <th>Pembeli</th>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga Beli</th>
        <th>Total Harga</th>
        <th>Status</th>
      </tr>
    </thead>
    @php
      $priceTotal = 0;
    @endphp
    <tbody>
      @foreach( $transactions as $transaction )
      <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-light' : '' }}">
        <td class="text-center" rowspan="{{ count($transaction->purchases) }}">{{ $loop->iteration }}</td>
        <td rowspan="{{ count($transaction->purchases) }}">{{ $transaction->created_at->isoFormat('D MMMM Y HH:mm') }}</td>
        <td rowspan="{{ count($transaction->purchases) }}">{{ $transaction->user->name }}</td>
        <td>{{ $transaction->purchases[0]->product->name }}</td>
        <td>{{ $transaction->purchases[0]->count }} x {{ rupiah($transaction->purchases[0]->product->price) }}</td>
        <td>{{ rupiah($transaction->purchases[0]->price) }}</td>
        <td class="fw-bold" rowspan="{{ count($transaction->purchases) }}">{{ rupiah($transaction->price_total) }}</td>
        <td rowspan="{{ count($transaction->purchases) }}">{{ $transaction->status }}</td>
      </tr>
      @if( count($transaction->purchases) > 1 )
      <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-light' : '' }}">
        @foreach( $transaction->purchases as $purchase )
          @if( $loop->index != 0 )
            <td>{{ $purchase->product->name }}</td>
            <td>{{ $purchase->count }} x {{ rupiah($purchase->product->price) }}</td>
            <td>{{ rupiah($purchase->price) }}</td>
          @endif
        @endforeach
      </tr>
      @endif
      @php
        $priceTotal += $transaction->price_total;
      @endphp
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" class="text-center fw-bold">Jumlah Pemasukan</td>
        <td colspan="2" class="text-center fw-bold">{{ rupiah($priceTotal) }}</td>
      </tr>
    </tfoot>
  </table>

  {{-- <div class="row justify-content-end mt-5">
    <div class="col-3">
      <p class="m-0 p-0">Administrator</p>
      <img src="{{ url('assets/images/ttd.png') }}" alt="Tanda Tangan" height="100">
      <p class="m-0 p-0">Linda Wati</p>
    </div>
  </div> --}}

  <script>
    window.print();
  </script>
</body>
</html>