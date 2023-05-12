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
                            <li class="breadcrumb-item"><a href="{{ url('/menu-perusahaan/') }}">Company Data</a></li>
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
                                <form class="row g-2" action={{ url('/menu-perusahaan/update/' . $dv->id) }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="fa fa-building-o"></i> Company
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nama" value="{{ $dv->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="alamat" value="{{ $dv->alamat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-telephone"></i> Office
                                                Contact</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="No Telpon" name="no_telp_kantor"
                                                value="{{ $dv->no_telp_kantor }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingAddress"><i class="fa fa-link"></i> Website</label>
                                            <input type="text" class="form-control" id="floatingAddress"
                                                placeholder="alamat" name="website" value="{{ $dv->website }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-id-card"></i> PIC
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nama_pic" value="{{ $dv->nama_pic }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-support"></i> Contact
                                                PIC</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="no_telp_pic"
                                                value="{{ $dv->no_telp_pic }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingKeterangan"><i class="icofont icofont-email"></i>
                                                Email</label>
                                            <input type="text" class="form-control" id="floatingKeterangan"
                                                placeholder="Email" name="email" value="{{ $dv->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-id-card"></i> Company
                                                NPWP</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="npwp_perusahaan"
                                                value="{{ $dv->npwp_perusahaan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingUnit"><i class="icofont icofont-paper"></i> -- PKP /
                                                NON-PKP --</label>
                                            <select class="form-select" id="floatingUnit" placeholder="pkp"
                                                name="Pkp" value="{{ $dv->Pkp }}">
                                                <option value="PKP">PKP</option>
                                                <option value="Non-PKP">Non-PKP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-id-card"></i> NIB</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nib" value="{{ $dv->nib }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="fa fa-briefcase"></i> Business
                                                Fields</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="bidang_usaha"
                                                value={{ $dv->bidang_usaha }}>
                                        </div>
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
                                                    @if($dv->bank == $b->name)
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="floatingKeterangan"><i class="fa fa-user"></i> Recipient's
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingKeterangan"
                                                placeholder="Email" name="nama_penerima"
                                                value="{{ $dv->nama_penerima }}">
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                        <a type="reset" class="btn btn-dark mt-3"
                                            href="{{ url('/menu-perusahaan/') }}">Back</a>
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
