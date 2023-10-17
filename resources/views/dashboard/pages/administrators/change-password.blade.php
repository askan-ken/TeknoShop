@extends('dashboard.main')
@section('content')

<div class="card mt-3 border-0 shadow-none">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/storage/{{ auth()->user()->photo }}" class="img-fluid rounded" alt="{{ auth()->user()->name }}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        @if( session('message') )
        {!! session('message') !!}
        @endif
        <form action="/dashboard/change-password" method="post">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="old_password">Password Lama</label>
            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" required placeholder="Isi password lama">
            @error('old_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required placeholder="Isi password baru">
            @error('new_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="password_confirm">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirm" class="form-control @error('password_confirm') is-invalid @enderror" required placeholder="Konfirmasi password baru">
            @error('password_confirm')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-warning">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection