<title>Vendor</title>
@extends('layouts.master')

@section('main')
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Add Vendor</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('/store-vendor') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Npwp"
                                    name="npwp" required>
                                <label for="floatingNPWP">NPWP</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Nama Vendor"
                                    name="nama" required>
                                <label for="floatingNama">Nama Vendor</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Nomor Telpon"
                                    name="no_telp" required>
                                <label for="floatingNomorTelpon">Nomor Telpon</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Alamat"
                                    name="alamat" required>
                                <label for="floatingAlamat">Alamat</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required="email" type="email"
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
                                <select class="form-select" id="floatingPkp"placholder="PKP / Non PKP" name="pkp" required>
                                    <option value="">PKP / Non PKP</option>
                                    <option value="PKP">PKP</option>
                                    <option value="Non-PKP">Non-PKP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Jenis Usaha"
                                    name="jenis_usaha" required>
                                <label for="floatingJenisUsaha">Jenis Usaha</label>
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

    @foreach ($datavendor as $dv)
        <div class="modal fade" id="modalDelete{{ $dv->id }}" tabindex="-1" aria-hidden="true">
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
                        <form action="{{ url('/vendor-destroy/' . $dv->id) }}">
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
                    <button class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                            class="bx bx-list-plus"></i> Add+</button>
                    <table class="table table-striped" id="table1" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPWP</th>
                                <th>Nama</th>
                                <th>Nomor Telpon</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>PKP / NON PKP</th>
                                <th>Jenis Usaha</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach ($datavendor as $dataVend)
                            <tr>
                                <td>{{ $serial++ }}</td>
                                <td>{{ $dataVend->npwp }}</td>
                                <td>{{ $dataVend->nama }}</td>
                                <td>{{ $dataVend->no_telp }}</td>
                                <td>{{ $dataVend->alamat }}</td>
                                <td>{{ $dataVend->email }}</td>
                                <td>{{ $dataVend->Pkp }}</td>
                                <td>{{ $dataVend->jenis_usaha }}</td>
                                <td>
                                    <a href="{{ url('/show-vendor').'/'. $dataVend->id }}">
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalUpdate{{ $dataVend->id }}">Edit</button>
                                    </a>
                                </td>
                                <td>

                                    <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $dataVend->id }}">Delete</button>
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
