@extends('dashboard.main')
@section('content')

<form action="/dashboard/products" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="category">Pilih Kategori</label>
    <select class="form-select" id="select_category" aria-label="Default select example" name="category_id">
      <option value="-" selected>Pilih Gender</option>
      @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->gender }}</option>
      @endforeach
    </select>

  </div>
  <div class="form-group">
    <label for="name">Nama Produk</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Isi nama produk">
    @error('name')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="description">Deskripsi Produk</label>
    <textarea name="description" id="editor" class="form-control  @error('description') is-invalid @enderror" placeholder="Isi deskripsi produk">{{ old('description') }}</textarea>
    @error('description')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="price">Harga Produk</label>
    <input type="number" name="price" class="form-control  @error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="Isi harga produk">
    @error('price')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="stock">Stok Produk</label>
    <input type="number" name="stock" class="form-control  @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required placeholder="Isi stok produk">
    @error('stock')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="video_link">Link Video Peragaan</label>
    <input type="text" name="video_link" class="form-control  @error('video_link') is-invalid @enderror" value="{{ old('video_link') }}" required placeholder="Isi link video peragaan">
    @error('video_link')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <label for="photo">Foto Produk</label>
    <input type="file" name="photo" class="form-control  @error('photo') is-invalid @enderror" required>
    @error('photo')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-warning">Tambah</button>
  </div>
</form>

@endsection

@section('script')
  @include('dashboard.partials.ckeditor')
@endsection
