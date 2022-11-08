<title>Edit Vendor</title>

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
                            <li class="breadcrumb-item"><a href="{{ url('/menu-private-person/') }}">Data Private Person</a>
                            </li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
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
                                <div class="row">
                                    <form class="row g-2" action={{ url('/menu-private-person/update/' . $dv->id) }}
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="fa fa-user"></i> Full Name </label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="nama" value="{{ $dv->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="alamat" value="{{ $dv->alamat }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icofont icofont-id-card"></i>
                                                    NIK</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="NIK" name="nik" value="{{ $dv->nik }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icofont icofont-id-card"></i>
                                                    NPWP</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="npwp_pp" value="{{ $dv->npwp_pp }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingUnit"><i class="icofont icofont-paper"></i> -- PKP /
                                                    NON-PKP --</label>
                                                <select class="form-select" id="floatingUnit" placeholder="pkp"
                                                    name="pkp" value="{{ $dv->pkp }}">
                                                    <option value="PKP">PKP</option>
                                                    <option value="Non-PKP">Non-PKP</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <div style="text-align: right; float: right;">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    <a type="reset" class="btn btn-dark mt-3"
                                        href="{{ url('/menu-private-person/') }}">Back</a>
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
