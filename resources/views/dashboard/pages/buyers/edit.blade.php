@extends('dashboard.main')
@section('content')

<form action="/dashboard/users/buyers/{{ $buyer->id }}" method="post">
  @method('put')
  @csrf
  <div class="form-group">
    <label for="name">Nama Pelanggan</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $buyer->name) }}" required placeholder="Isi nama pelanggan">
    @error('name')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="username">Username Pelanggan</label>
    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $buyer->username) }}" required placeholder="Isi username pelanggan">
    @error('username')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="email">Email Pelanggan</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $buyer->email) }}" required placeholder="Isi email pelanggan">
    @error('email')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="phone">No. Telepon Pelanggan</label>
    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $buyer->phone) }}" required placeholder="Isi no. telepon pelanggan">
    @error('phone')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="address">Alamat</label>
    <textarea name="address" rows="5" id="address" class="form-control  @error('address') is-invalid @enderror" placeholder="Isi alamat pelanggan">{{ old('address', $buyer->address) }}</textarea>
    @error('address')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <p class="text-danger">password sesuai dengan username</p>
  <div class="form-group">
    <button type="submit" class="btn btn-warning">Ubah</button>
  </div>
</form>

@endsection
