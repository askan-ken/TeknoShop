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
                <h1 class="card-title h5">Ubah Profil</h1>
                @if( session('message') )
                {!! session('message') !!}
                @endif
                <form action="/profile" method="post" enctype="multipart/form-data">
                  @method('put')
                  @csrf
                  <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required placeholder="Isi nama anda">
                    @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', auth()->user()->username) }}" required placeholder="Isi username anda">
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required placeholder="Isi email anda">
                    @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="phone">No. Telepon</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}" required placeholder="Isi no. telepon anda">
                    @error('phone')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="address">Alamat</label>
                    <textarea rows="3" name="address" class="form-control @error('address') is-invalid @enderror" required placeholder="Isi alamat anda">{{ old('address', auth()->user()->address) }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="photo">Foto Profil</label>
                    <input type="file" name="photo" class="form-control  @error('photo') is-invalid @enderror">
                    @error('photo')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <p class="text-danger">kosongkan jika tidak ingin mengganti foto</p>
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