@extends('main')
  @section('content')

    {{-- produk --}}
    <section id="produk" class="produk py-5">
      <div class="container">
        <div class="card mb-3 border-0">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="/storage/{{ auth()->user()->photo }}" class="img-fluid rounded" alt="{{ auth()->user()->name }}">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h1 class="card-title h5">Ubah Password</h1>
                @if( session('message') )
                {!! session('message') !!}
                @endif
                <form action="/change-password" method="post">
                  @method('put')
                  @csrf
                  <div class="mb-3">
                    <label for="old_password">Password Lama</label>
                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" required placeholder="Isi password lama">
                    @error('old_password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="new_password">Password Baru</label>
                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required placeholder="Isi password baru">
                    @error('new_password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="password_confirm">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirm" class="form-control @error('password_confirm') is-invalid @enderror" required placeholder="Konfirmasi password baru">
                    @error('password_confirm')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- end produk --}}
@endsection