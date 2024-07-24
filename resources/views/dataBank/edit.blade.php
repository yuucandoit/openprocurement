<title>Edit Bank</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('bank/') }}">List Bank</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Edit Vendor</h5>
                            </div>
                            <div class="card-body">
                                <form action={{ url('/bank/update/'.$data->id) }} id="formAdd" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="floatingName"><i data-feather="dollar-sign"></i> Bank Name</label>
                                                                    <input type="text" class="form-control" id="floatingName" placeholder="Name"
                                                                        name="name" value="{{ $data->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                                                    <textarea class="form-control" name="alamat" id="" rows="1">{{ $data->alamat }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="floatingNoTelpon"><i class="icofont icofont-bank"></i> Call Center</label>
                                                                    <input required type="text" class="form-control" id="floatingNoTelpon"
                                                                        placeholder="Call Center" name="call_center" value="{{ $data->call_center }}">
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
            </div>
            <!-- Container-fluid Ends-->
    </section>
@endsection
