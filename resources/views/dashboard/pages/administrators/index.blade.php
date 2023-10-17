@extends('dashboard.main')
@section('content')

<a href="/dashboard/users/administrators/create" class="btn btn-warning mb-3">Tambah Administrator</a>

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
        @foreach( $administrators as $administrator )
          <tr>
            <td class="text-center">
              <img src="{{ url('storage/' . $administrator->photo) }}" alt="{{ $administrator->name }}" height="80" class="rounded">
            </td>
            <td class="align-middle">{{ $administrator->name }}</td>
            <td class="align-middle">{{ $administrator->username }}</td>
            <td class="align-middle">{{ $administrator->email }}</td>
            <td class="align-middle">{{ $administrator->phone }}</td>
            <td class="align-middle">
              @if( $administrator->id != auth()->user()->id )
              <a href="/dashboard/users/administrators/{{ $administrator->id }}/edit" class="btn btn-success">ubah</a>
              <a href="/dashboard/users/administrators/{{ $administrator->id }}" class="btn btn-primary">detail</a>
              <form action="/dashboard/users/administrators/{{ $administrator->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">hapus</button>
              </form>
              @else
              <p>diri anda</p>
              @endif
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>

@endsection

@section('script')
  @include('dashboard.partials.data-table')
@endsection