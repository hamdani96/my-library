@extends('layouts.app')
@section('title', 'My Library | Data Users')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Buku</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="#modal-tambah-buku" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus-square"> Tambah</i></a>
  </div>
  <div class="card-body">
    {{ $errors->first('isbn') }}
    {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $errors->first('isbn') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> --}}
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Cover</th>
            <th>Judul</th>
            <th>ISBN</th>
            <th>pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Jumlah Buku</th>
            <th>Deskripsi</th>
            <th>Lokasi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($book as $books)
          <tr>
            <td>{{ $books->id }}</td>
            <td> <a href="#modal-cover{{ $books->id }}" data-toggle="modal"><img src="/img/book/{{ $books->cover }}" style="width: 50px" alt=""></a></td>
            <td>{{ $books->judul }}</td>
            <td>{{ $books->isbn }}</td>
            <td>{{ $books->pengarang }}</td>
            <td>{{ $books->penerbit }}</td>
            <td>{{ $books->tahun_terbit }}</td>
            <td>{{ $books->jumlah_buku }}</td>
            <td>{{ $books->deskripsi }}</td>
            <td>{{ $books->lokasi }}</td>
            <td>
              <a href="#modal-edit-buku{{ $books->id }}" data-toggle="modal" class="btn btn-success"><i class="fa fa-edit"></i></a>
              <a href="/book/delete/{{ $books->id }}" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $book->links() }}
    </div>
  </div>
</div>

{{-- Modal Tambah Book --}}
<div class="modal fade" id="modal-tambah-buku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="form-group col-md-6">
              <label for=""> Judul</label>
              <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
              <span class="text-danger">{{ $errors->first('judul') }}</span>
            </div>
            <div class="form-group col-md-6">
              <label for=""> ISBN</label>
              <input type="text" name="isbn" id="" class="form-control" value="{{ old('isbn') }}" required>
              <span class="text-danger">{{ $errors->first('isbn') }}</span>
            </div>
            <div class="form-group col-md-6">
              <label for="">Pengarang</label>
              <input type="text" name="pengarang" id="" class="form-control" value="{{ old('pengarang') }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="">Penerbit</label>
              <input type="text" name="penerbit" id="" class="form-control" value="{{ old('penerbit') }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for=""> Tahun Terbit</label>
              <input type="text" name="tahun_terbit" id="" class="form-control" value="{{ old('tahun_terbit') }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for=""> Jumlah Buku</label>
              <input type="text" name="jumlah_buku" id="" class="form-control" value="{{ old('jumlah_buku') }}" required>
            </div>
            <div class="form-group col-md-12">
              <label for=""> Deskripsi</label>
              <textarea name="deskripsi" id="" rows="5" class="form-control">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for=""> Cover</label>
              <input type="file" name="cover" id="chose_image" class="form-control" required>
              <img src="" id="show_image" style="width: 150px; margin-top: 5px;" alt="">
            </div>
            <div class="form-group col-md-6">
              <label for=""> Lokasi</label>
              <select name="lokasi" class="form-control" id="">
                <option value="rak1"> Rak 1</option>
                <option value="rak2"> Rak 2</option>
                <option value="rak3"> Rak 3</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- End Modal Book --}}

{{-- Modal Edit Buku --}}
@foreach ($book as $edit)
<div class="modal fade" id="modal-edit-buku{{ $edit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/book/update/{{ $edit->id }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="form-group col-md-6">
              <label for=""> Judul</label>
              <input type="text" class="form-control" name="judul" value="{{ $edit->judul }}" required>
              <span class="text-danger">{{ $errors->first('judul') }}</span>
            </div>
            <div class="form-group col-md-6">
              <label for=""> ISBN</label>
              <input type="text" name="isbn" id="" class="form-control" value="{{ $edit->isbn }}" required>
              <span class="text-danger">{{ $errors->first('isbn') }}</span>
            </div>
            <div class="form-group col-md-6">
              <label for="">Pengarang</label>
              <input type="text" name="pengarang" id="" class="form-control" value="{{ $edit->pengarang }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for="">Penerbit</label>
              <input type="text" name="penerbit" id="" class="form-control" value="{{ $edit->penerbit }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for=""> Tahun Terbit</label>
              <input type="text" name="tahun_terbit" id="" class="form-control" value="{{ $edit->tahun_terbit }}" required>
            </div>
            <div class="form-group col-md-6">
              <label for=""> Jumlah Buku</label>
              <input type="text" name="jumlah_buku" id="" class="form-control" value="{{ $edit->jumlah_buku }}" required>
            </div>
            <div class="form-group col-md-12">
              <label for=""> Deskripsi</label>
              <textarea name="deskripsi" id="" rows="5" class="form-control">{{ $edit->deskripsi }}</textarea>
            </div>
            <div class="form-group col-md-6">
              <label for=""> Cover</label>
              <input type="file" name="cover" id="chose_image" class="form-control">
              <img src="/img/book/{{ $edit->cover }}" id="show_image" style="width: 150px; margin-top: 5px;" alt="">
              <input type="hidden" name="cover_lama" value="{{ $edit->cover }}">
            </div>
            <div class="form-group col-md-6">
              <label for=""> Lokasi</label>
              <select name="lokasi" class="form-control" id="">
                <option value="rak1"> Rak 1</option>
                <option value="rak2"> Rak 2</option>
                <option value="rak3"> Rak 3</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
{{-- End Modal Edit --}}

{{-- Modal Foto --}}
@foreach ($book as $cover)
<div class="modal fade" id="modal-cover{{ $cover->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="/img/book/{{ $cover->cover }}" width="100%" alt="">
      </div>
    </div>
  </div>
</div>    
@endforeach
{{-- End Modal Foto --}}
@endsection

@section('js')
    <script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#chose_image").change(function(){
        readURL(this);
    });
    </script>
@endsection
