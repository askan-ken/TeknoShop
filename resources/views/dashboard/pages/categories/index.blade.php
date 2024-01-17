@extends('dashboard.main')
@section('content')

<button type="button" id="btn-add" class="btn btn-warning mb-3" data-bs-toggle="modal" 
data-bs-target="#modal-category">Tambah Kategori</button>

@if( session('message') )
{!! session('message') !!}
@endif

@error('gender')
<div class="alert alert-danger" role="alert">
  {{ $message }}
</div>
@enderror

<table class="table table-bordered w-100" id="dataTable" cellspacing="0">
    <thead>
        <tr>
            <th class="text-center">*</th>
            <th>Gender</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
      @foreach( $categories as $category )
        <tr>
          <td class="align-middle">{{ $loop->iteration}}</td>
          <td class="align-middle">{{ $category->gender}}</td>
          <td class="align-middle">
            <button data-bs-toggle="modal" data-bs-target="#modal-category" data-id="{{ $category->id }}" class="btn btn-success btn-edit">ubah</button>
            <a href="/dashboard/products/{{ $category->id }}" class="btn btn-primary">detail</a>
            <form action="/dashboard/categories/{{ $category->id }}" class="d-inline" method="post" onsubmit="return confirm('yakin ingin menghapus data?')">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="categoryModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formCategory" action="/dashboard/categories" method="post">
            @csrf
        <div class="modal-body">
            <input type="hidden" name="_method" id="method" value="POST">
            <select class="form-select" id="select_category" aria-label="Default select example" name="gender">
                <option value="-" selected>Jenis produk</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
                <option value="Unisex">Unisex</option>
                <option value="makanan">Makanan</option>
                <option value="karya">Karya</option>


              </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')
  @include('dashboard.partials.data-table')
  <script>

      const getCategoryById = (id) => {
      $.ajax({
        url:"/dashboard/categories/"+id,
        success: function(data){
          $('#select_category').val(data.data.gender)
        }
      })
    }

    const modalOpen = (modalTitle, modalUrl, modalSubmitText, modalMethod) => {
      $('#categoryModalLabel').html(modalTitle)
      $('#formCategory').attr('action', modalUrl)
      $('.modal-footer button[type=submit]').html(modalSubmitText)
      $('#method').val(modalMethod)
    }

    $('.btn-edit').on('click', function(){
      const id = $(this).data('id');
      modalOpen('Edit Category', '/dashboard/categories/'+id, 'Simpan Perubahan', 'PUT')

      getCategoryById(id)
    })

    $('#btn-add').on('click', function(){
      modalOpen('Add Category', '/dashboard/categories', 'Tambah Kategori', 'POST')
      $('select_category').val("-")
    })

  </script>
@endsection