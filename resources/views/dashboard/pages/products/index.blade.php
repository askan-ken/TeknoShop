@extends('dashboard.main')
@section('content')

<a href="/dashboard/products/create" class="btn btn-warning mb-3">Tambah Produk</a>

  @if( session('message') )
  {!! session('message') !!}
  @endif

  <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
      <thead>
          <tr>
              <th>Kategori</th>
              <th class="text-center">*</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach( $products as $product )
          <tr>
            <td class="align-middle">{{ $product->category->gender }}</td>
            <td class="text-center">
              <img src="{{ url('storage/' . $product->photo) }}" alt="{{ $product->name }}" height="80" class="rounded">
            </td>
            <td class="align-middle">{{ $product->name }}</td>
            <td class="align-middle">{{ rupiah( $product->price ) }}</td>
            <td class="align-middle">{{ $product->stock }}</td>
            <td class="align-middle">
              <a href="/dashboard/products/{{ $product->id }}/edit" class="btn btn-success">ubah</a>
              <a href="/dashboard/products/{{ $product->id }}" class="btn btn-primary">detail</a>
              <form action="/dashboard/products/{{ $product->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>

@endsection

@section('script')
  @include('dashboard.partials.data-table')
@endsection