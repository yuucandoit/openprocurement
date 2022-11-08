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
                                <form class="row g-2" action={{ url('/menu-perusahaan/update/' . $dv->id) }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="fa fa-building-o"></i> Company
                                                Name</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="nama" value="{{ $dv->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="Your Name" name="alamat" value="{{ $dv->alamat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="floatingName"><i class="icofont icofont-telephone"></i> Office
                                                Contact</label>
                                            <input type="text" class="form-control" id="floatingName"
                                                placeholder="No Telpon" name="no_telp_kantor"
                                                value="{{ $dv->no_telp_kantor }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
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
                                            <select class="form-select" id="floatingUnit" placeholder="Bank"
                                                name="bank" value="{{ $dv->bank }}">
                                                <option value="BCA(014)">BCA(014)</option>
                                                <option value="Mandiri(008)">Mandiri(008)</option>
                                                <option value="BNI(009)">BNI(009)</option>
                                                <option value="BRI(002)">BRI(002)</option>
                                                <option value="BTN(200)">BTN(200)</option>
                                                <option value="Danamon(011)">Danamon(011)</option>
                                                <option value="Permata(013)">Permata(013)</option>
                                                <option value="Maybank(016)">Maybank(016)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingKeterangan"><i class="fa fa-code-fork"></i> Bank
                                                Branch</label>
                                            <input type="text" class="form-control" id="floatingKeterangan"
                                                placeholder="Email" name="cabang_bank" value="{{ $dv->cabang_bank }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
