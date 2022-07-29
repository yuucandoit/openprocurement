<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('/menu-data-vendor/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-2" id="floatingName" placeholder="Your Name"
                                        name="nama">
                                    <label for="floatingName">Nama Vendor</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="Address" name="no_telp">
                                    <label for="floatingNoTelpon">Nomor Telepon</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingAlamat"
                                        placeholder="Alamat" name="alamat">
                                    <label for="floatingAlamat">Alamat</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="email" class="form-control mt-4 mb-4" id="floatingEmail"
                                        placeholder="Email" name="email">
                                    <label for="floatingEmail">Email</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        @foreach ($datadv as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                            <span class="warning">
                                <img src="assets/images/warning.png">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/menu-data-vendor/destroy/' . $a->id) }}">
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
                    <h1>Data Vendor</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add+</button>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                    @hasrole('admin|super admin')

                                    @endhasrole

                                    @hasrole('admin|super admin')

                                    @endhasrole
                                    @hasrole('user')

                                    @endhasrole
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody>
                                @foreach ($datadv as $vendor)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $vendor->nama }}</td>
                                        <td>{{ $vendor->no_telp }}</td>
                                        <td>{{ $vendor->alamat }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->created_at }}</td>
                                        @hasrole('admin|super admin')

                                        @endhasrole
                                        <td>
                                <a href="{{ url('/data-vendor/' . $vendor->id) }}" class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                 <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                 data-bs-target="#modalUpdate{{ $vendor->id }}">Update</button>
                                 <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                 data-bs-target="#modalDelete{{ $vendor->id }}">Delete</button>


                                        </td>
                                        {{-- @hasrole('admin|super admin')
                                            @if ($vendor->status == 'Accepted')
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-success" onclick="return"><b>Accepted</b></a>
                                                </td>
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-danger" onclick="return">Reject</a>
                                                </td>
                                            @elseif($purchase->status == 'pending')
                                                <td>
                                                    <a href="{{ url('menu-purchase-order/accept', $purchase->id) }}"
                                                        class="btn btn-success" onclick="return">Accept</a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('menu-purchase-order/Reject', $purchase->id) }}"
                                                        class="btn btn-danger" onclick="return">Reject</a>
                                                </td>
                                            @else
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-success" onclick="return">Accept</a>
                                                </td>
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-danger" onclick="return"><b>Rejected</b></a>
                                                </td>
                                            @endif
                                        @endhasrole
                                        @hasrole('user')
                                            <td> <a class="badge {{ $purchase->status == 'pending' ? 'bg-warning' : ($purchase->status == 'Accepted' ? 'bg-success' : 'bg-danger') }} mt-1"
                                                    style="color: white; font-size:18">{{ $purchase->status }}</a></td>
                                        @endhasrole --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {

                $('.servideletebtn').click(function(e) {
                    e.preventDefault();
                    alert('hello');
                });

            });
        </script>
    </section>
@endsection
