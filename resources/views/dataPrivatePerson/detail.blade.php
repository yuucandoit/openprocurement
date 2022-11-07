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
                            <li class="breadcrumb-item"><a href="{{ url('/menu-private-person/') }}">Data Private Person</a>
                            </li>
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
                                <h5 class="text-white">Details From {{ $data_person->nama }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Full Name</td>
                                            <td>{{ $data_person->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $data_person->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>{{ $data_person->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td>NPWP</td>
                                            <td>{{ $data_person->npwp_pp }}</td>
                                        </tr>
                                        <tr>
                                            <td>PKP / Non-PKP</td>
                                            <td>{{ $data_person->pkp }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <a type="reset" class="btn btn-dark mt-3" href="{{ url('/menu-private-person/') }}"
                                    style="float: right;">Back</a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Container-fluid Ends-->
    </section>
@endsection
