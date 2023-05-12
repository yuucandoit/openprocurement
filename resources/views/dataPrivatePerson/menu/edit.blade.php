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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="fa fa-user"></i> Full Name </label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="nama" value="{{ $dv->nama }}">
                                            </div>
                                            @error('nama')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icofont icofont-id-card"></i>
                                                    NIK</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="NIK" name="nik" value="{{ $dv->nik }}">
                                            </div>
                                            @error('nik')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icofont icofont-id-card"></i>
                                                    NPWP</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="npwp_pp" value="{{ $dv->npwp_pp }}">
                                            </div>
                                            @error('npwp_pp')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingEmail">Email</label>
                                               <input type="text" name="email" class="form-control" id="floatingEmail" placeholder="Email" value="{{ $dv->email }}" required>
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
                                               <input type="text" name="contact" class="form-control" id="floatingContact" placeholder="Contact" value="{{ $dv->contact }}" required>
                                            </div>
                                            @error('contact')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="fa fa-credit-card"></i> Account
                                                    Number</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="no_rekening"
                                                    value="{{ $dv->no_rekening }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingUnit"><i class="fa fa-bank"></i> -- Bank --</label>
                                                <select class="form-select js-example-basic-single" id="floatingUnit" placeholder="Bank"
                                                    name="bank">
                                                    @foreach ($bank as $b)
                                                    @if($b->name == $dv->bank)
                                                    <option value="{{ $dv->bank }}" selected >{{ $dv->bank }}</option>
                                                    @else
                                                    <option value="{{ $b->name }}">{{ $b->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingKeterangan"><i class="fa fa-code-fork"></i> Bank
                                                    Branch</label>
                                                <input type="text" class="form-control" id="floatingKeterangan"
                                                    placeholder="Email" name="cabang_bank" value="{{ $dv->cabang_bank }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                                <textarea class="form-control" name="alamat" id="" rows="4">{{ $dv->alamat }}</textarea>
                                            </div>
                                            @error('alamat')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
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
