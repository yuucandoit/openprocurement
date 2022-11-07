<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-perusahaan/') }}">Company Data</a></li>
                            <li class="breadcrumb-item active">Details</li>
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
                                <h5 class="text-white">Details From {{ $data_perusahaan->nama }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Company Name</td>
                                            <td>{{ $data_perusahaan->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $data_perusahaan->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>Office Contact</td>
                                            <td>{{ $data_perusahaan->no_telp_kantor }}</td>
                                        </tr>
                                        <tr>
                                            <td>Website</td>
                                            <td><a
                                                    href="{{ $data_perusahaan->website }}">{{ $data_perusahaan->website }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PIC Name</td>
                                            <td>{{ $data_perusahaan->nama_pic }}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact PIC</td>
                                            <td>{{ $data_perusahaan->no_telp_pic }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $data_perusahaan->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Company NPWP</td>
                                            <td>{{ $data_perusahaan->npwp_perusahaan }}</td>
                                        </tr>
                                        <tr>
                                            <td>PKP / Non-PKP</td>
                                            <td>{{ $data_perusahaan->Pkp }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIB</td>
                                            <td>{{ $data_perusahaan->nib }}</td>
                                        </tr>
                                        <tr>
                                            <td>Business Fields</td>
                                            <td>{{ $data_perusahaan->bidang_usaha }}</td>
                                        </tr>
                                        <tr>
                                            <td>Account Number</td>
                                            <td>{{ $data_perusahaan->no_rekening }}</td>
                                        </tr>
                                        <tr>
                                            <td>Bank</td>
                                            <td>{{ $data_perusahaan->bank }}</td>
                                        </tr>
                                        <tr>
                                            <td>Recipient's Name</td>
                                            <td>{{ $data_perusahaan->nama_penerima }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <a type="reset" class="btn btn-dark mt-3" href="{{ url('/menu-perusahaan/') }}"
                                    style="float: right;">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
        </div>
    </section>
@endsection
