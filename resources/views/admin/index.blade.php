<title>Admin</title>
@extends('layouts.master')

@section('main')
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Add Admin</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('/store-admin') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Name"
                                    name="name" required>
                                <label for="floatingKeterangan">Name</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
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
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="password" class="form-control mt-3 " id="floatingPassword"
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
            <div class="py-3">
                <h1>Admin</h1>
            </div>

            <div class="card shadow mb-5">
                <div class="card-body">
                    <button class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                            class="bx bx-list-plus"></i> Add+</button>
                    <table class="table table-striped" id="table1" style="width: 100%">
                        <thead>
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
                        @endphp
                        @foreach ($admin as $dataAdmin)
                            <tr>
                                <td>{{ $serial++ }}</td>
                                <td>{{ $dataAdmin->name }}</td>
                                <td>{{ $dataAdmin->email }}</td>
                                <td>{{ $dataAdmin->roles->pluck('name')->implode('') }}</td>
                                <td>
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $dataAdmin->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
