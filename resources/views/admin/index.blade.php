<title>Admin</title>
@extends('layouts.master')

@section('main')
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Add User</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('/store-admin') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName"
                                    placeholder="Name" name="name" required>
                                <label for="floatingKeterangan">Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required asp-for="email" type="email"
                                    class="form-control mt-3 @error('email') is invalid @enderror" id="floatingEmail"
                                    placeholder="Email" name="email" required>
                                <label for="floatingEmail">Email</label>
                            </div>
                            @error('email')
                                <div class='mt-1'>
                                    <span class=" text-danger" asp-validation-for="email">
                                        {{ $message }}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="password" class="form-control mt-3" id="floatingPassword"
                                    placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select mt-3" id="floatingRole" placeholder="Select Role" name="role">
                                    <option value="" selected>Select Role</option>
                                    @foreach ($role as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingRole">Role</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select mt-3" id="floatingDepartmnt" placeholder="Select Department" name="department">
                                    @foreach ($department as $d)
                                    <option value="{{ $d->name }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingDepartmnt">Department</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select mt-3" id="floatingLocation" placeholder="Select Location" name="location">
                                    <option value="Tebet">Tebet</option>
                                    <option value="Cikunir">Cikunir</option>
                                </select>
                                <label for="floatingLocation">Location</label>
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

    @foreach ($admin as $edit)
    <div class="modal fade" id="modalEdit{{ $edit->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Edit User</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('admin-update/'.$edit->id) }} id="formEdit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName"
                                    placeholder="Name" name="name" value="{{ $edit->name }}" required>
                                <label for="floatingKeterangan">Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required asp-for="email" type="email"
                                    class="form-control mt-3 @error('email') is invalid @enderror" id="floatingEmail"
                                    placeholder="Email" name="email" value="{{ $edit->email }}" required>
                                <label for="floatingEmail">Email</label>
                            </div>
                            @error('email')
                                <div class='mt-1'>
                                    <span class=" text-danger" asp-validation-for="email">
                                        {{ $message }}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="password" class="form-control mt-3" id="floatingPassword"
                                    placeholder="Password" name="password">
                                <label for="floatingPassword">Password</label>
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

    @foreach ($admin as $a)
        <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" style="color: white">Delete</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        <span class="warning">
                            <img src="assets/images/warning.png">
                        </span>
                        <h2 style="text-align: center"> are you sure want to delete this admin? </h2>
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
                    <h5>Add Users</h5>
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
                                <th>Email</th>
                                <th>role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $serial = 1;
                            $i = 1 + $admin->currentPage() * $admin->perPage() - $admin->perPage();
                        @endphp
                        @foreach ($admin as $dataAdmin)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $dataAdmin->name }}</td>
                                <td>{{ $dataAdmin->email }}</td>
                                <td>{{ $dataAdmin->roles->pluck('name')->implode('') }}</td>
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
                        {{ $admin->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
