@extends('layouts.app')
@section('title', 'My Library | Data Users')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"> Data Users</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="#modal-tambah-user" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus-square"> Tambah</i></a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Action</>
          </tr>
        </thead>
        <tbody>
          @foreach ($user as $users)
          <tr>
            <td>{{ $users->id }}</td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->username }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ $users->level }}</td>
            <td>
                <a href="#" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td> 
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $user->links() }}
    </div>
  </div>
</div>

<div class="modal fade" id="modal-tambah-usesr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for=""> Name</label>
              <input type="text" name="name" value="{{ old('name') }}" id="" required class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for=""> Username</label>
              <input type="text">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
