<title>Admin Add Role</title>
@extends('layouts.master')

@section('main')
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Add Role</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('/store-role') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName"
                                    placeholder="Name" name="name" required>
                                <label for="floatingKeterangan">Name</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($role as $edit)
    <div class="modal fade" id="modalEdit{{ $edit->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Edit Role</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('role-update/'.$edit->id) }} id="formEdit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName"
                                    placeholder="Name" name="name" value="{{ $edit->name }}" required>
                                <label for="floatingKeterangan">Name</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($role as $a)
        <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" style="color: white">Delete</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3" style="text-align: center;">
                        <span>
                            <img src="assets/images/warning.png">
                        </span>
                        <h2> Are you sure<br>Want to delete this role? </h2>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('/admin-destroy/' . $a->id) }}">
                            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container-fluid">
        <div class="row">
            <div class="card card-absolute">
                <div class="card-header bg-primary">
                    <h5>List Roles</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                            class="bx bx-list-plus"></i> Add+</button>
                        <div class="pull-right">
                            <form action="{{ route('admin.SearchUser') }}" method="get"
                                class="input-group">
                                <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                    value="{{ old('cari') }}">
                                <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                        value="Go"></span>
                            </form>
                        </div>
                <div class="table-responsive">
                    <table class="table table-striped" style="width: 100%">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Guard Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $serial = 1;
                            $i = 1 + $role->currentPage() * $role->perPage() - $role->perPage();
                        @endphp
                        @foreach ($role as $dataAdmin)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $dataAdmin->name }}</td>
                                <td>{{ $dataAdmin->guard_name }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $dataAdmin->id }}">Edit</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $dataAdmin->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                    <div class="mt-4">
                        {{ $role->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
