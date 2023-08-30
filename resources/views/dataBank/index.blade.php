<title>Data Bank</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Data Bank</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Bank</li>
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
                            <h5>List Of Bank Data</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"> Add
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                    <div>
                                        <form action="{{ route('bank.SearchBank') }}" method="get"
                                            class="input-group">
                                            <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                                value="{{ old('cari') }}">
                                            <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                                    value="Go"></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th style="text-align: center">No</th>
                                            <th style="white-space: nowrap;">Bank Name</th>
                                            <th>Address</th>
                                            <th style="white-space: nowrap;">Call Center</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($data as $b)
                                            <tr>
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>{{ $b->name }}</td>
                                                <td>{{ $b->alamat }}</td>
                                                <td>{{ $b->nik }}</td>
                                                <td style="text-align: center;white-space: nowrap;">

                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                        href="{{ url('/bank/detail/' . $b->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ route('bank.edit',$b->id) }}">
                                                        <i class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #ff0000;"
                                                        data-bs-toggle="modal" data-bs-target="#modalDelete{{ $b->id }}">
                                                        <i class="icon-trash" title="Delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modalDelete{{$b->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h2 class="modal-title" style="color: white">Delete</h2>
                                                            <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-5 mb-3 text-center">
                                                            <span class="warning">
                                                                <img src="{{ asset('assets/images/warning.png') }}">
                                                            </span>
                                                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ url('/bank/destroy/' .$b->id) }}" method="POST">
                                                                @csrf @method('DELETE')
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
                                    {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                                <div>
                                    <div class="modal fade" id="modalAdd" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h2 class="modal-title" style="color: white">Add Form</h2>
                                                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action={{ url('/bank/store') }} id="formAdd" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="floatingName"><i class="fa fa-user"></i>Bank Name</label>
                                                                    <input type="text" class="form-control" id="floatingName" placeholder="Name"
                                                                        name="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                                                    <textarea class="form-control" name="alamat" id="" rows="1"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="floatingCallCenter"><i class="icofont icofont-bank"></i> Call Center</label>
                                                                    <input required type="text" class="form-control" id="floatingCallCenter"
                                                                        placeholder="" name="call_center">
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
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3>Import Data Bank</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="importform"  action="{{ route('bank.import') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile" >
                                Input File
                            </label>
                            <input type="file" id="file" name="file" class="@error('file')is-invalid @enderror form-control">
                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- <p class="text-danger">{{ $errors->first('file') }}</p> --}}

                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="text-end" style="margin-right: 30px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    <div class="card-body">
                    <div class="alert alert-warning alert-dismissible">
                        <i class="icon fa fa-warning"></i> Warning! &nbsp;
                        File Data Item Only Type (.xls, .xlsx)
                    </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
