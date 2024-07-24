<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="modal fade" id="modalAdd" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('/menu-private-person/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingName"><i data-feather="user"></i> Full Name</label>
                                        <input type="text" class="form-control" id="floatingName" placeholder="Name"
                                            name="nama">
                                    </div>
                                    @error('nama')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> NIK</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="NIK" name="nik">
                                    </div>
                                    @error('nama')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $nik }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> NPWP</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="npwp_private_person" name="npwp_pp">
                                    </div>
                                    @error('npwp_pp')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingPKP"><i class="icofont icofont-paper"></i> -- PKP / NON-PKP
                                            --</label>
                                        <select class="form-select" id="floatingPKP" placeholder="PKP" name="pkp">
                                            <option value="PKP">PKP</option>
                                            <option value="Non-PKP">Non-PKP</option>
                                        </select>
                                    </div>
                                    @error('pkp')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingEmail">Email</label>
                                       <input type="text" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>
                                    </div>
                                    @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingContact">Contact </label>
                                       <input type="text" name="contact" class="form-control" id="floatingContact" placeholder="Contact" required>
                                    </div>
                                    @error('contact')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i data-feather="credit-card"></i> -- Bank Account
                                            Number --</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="No Rek" name="no_rekening">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingUnit"><i data-feather="airplay"></i> -- Bank --</label>
                                        <select class="form-select js-example-basic-single" id="floatingUnit" placeholder="Bank" name="bank" data-live-search="true">
                                            @foreach ($bank as $b)
                                            <option value="{{ $b->name }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingCabangBank"><i data-feather="git-branch"></i> Bank
                                            Branch</label>
                                        <input required type="text" class="form-control" id="floatingCabangBank"
                                            placeholder="Cabang Bank" name="cabang_bank">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                        <textarea class="form-control" name="alamat" id="" rows="3"></textarea>
                                    </div>
                                    @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Data Private Person</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Private Person</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>List Of Private Person Data</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"> Add
                                <i class="icofont icofont-ui-add"></i></button>
                            <a href={{ url('/export_excel/private_person') }} class="btn btn-success mb-3 mr-1"
                                style="align-self: flex-end"><i class="icon-export"></i> Export to Excel</a>
                            <a href={{ url('file-import-pp') }} class="btn btn-danger mb-3 mr-1"
                                style="align-self: flex-end"><i class="icon-import"></i> Import From Excel</a>
                                    <div class="pull-right">
                                        <form action="{{ route('menu-private-person.SearchPP') }}" method="get"
                                            class="input-group">
                                            <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                                value="{{ old('cari') }}">
                                            <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                                    value="Go"></span>
                                        </form>
                                    </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-primary">
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>NIK</th>
                                            <th>NPWP</th>
                                            <th>PKP</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $i = 1 + $datadv->currentPage() * $datadv->perPage() - $datadv->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($datadv as $person)
                                            <tr>
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>{{ $person->nama }}</td>
                                                <td>{{ $person->alamat }}</td>
                                                <td>{{ $person->nik }}</td>
                                                <td>{{ $person->npwp_pp }}</td>
                                                <td>{{ $person->pkp }}</td>
                                                @hasrole('admin|super admin')
                                                @endhasrole
                                                <td>

                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                        href="{{ url('/menu-private-person/detail/' . $person->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;"
                                                        href="{{ url('/menu-private-person/edit/' . $person->id) }}"><i
                                                            class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                    <button class="btn btn-iconsolid mt-1" style="background-color: #ff0000;"
                                                    data-bs-toggle="modal" data-bs-target="#modalDelete{{ $person->id }}">
                                                    <i class="icon-trash" title="Delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modalDelete{{ $person->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h2 class="modal-title" style="color: white">Delete</h2>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-5 mb-3" style="text-align: center;">
                                                            <span class="warning">
                                                                <img src="assets/images/warning.png">
                                                            </span>
                                                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ url('/menu-private-person/destroy/' . $person->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datadv->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
                <script>

                </script>
    </section>
@endsection
