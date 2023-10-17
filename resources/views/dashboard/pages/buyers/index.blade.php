@extends('dashboard.main')
@section('content')

<a href="/dashboard/users/buyers/create" class="btn btn-warning mb-3">Tambah Pelanggan</a>

  @if( session('message') )
  {!! session('message') !!}
  @endif

  <table class="table table-bordered w-100" id="dataTable" cellspacing="0">
      <thead>
          <tr>
              <th class="text-center">*</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Email</th>
              <th>No. Telp</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach( $buyers as $buyer )
          <tr>
            <td class="text-center">
              <img src="{{ url('storage/' . $buyer->photo) }}" alt="{{ $buyer->name }}" height="80" class="rounded">
            </td>
            <td class="align-middle">{{ $buyer->name }}</td>
            <td class="align-middle">{{ $buyer->username }}</td>
            <td class="align-middle">{{ $buyer->email }}</td>
            <td class="align-middle">{{ $buyer->phone }}</td>
            <td class="align-middle">
              <a href="/dashboard/users/buyers/{{ $buyer->id }}/edit" class="btn btn-success">ubah</a>
              <a href="/dashboard/users/buyers/{{ $buyer->id }}" class="btn btn-primary">detail</a>
              <form action="/dashboard/users/buyers/{{ $buyer->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
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