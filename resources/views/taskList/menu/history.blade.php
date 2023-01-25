<title>History Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Task List Purchasing</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">History Task List Purchase order</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6 mt-4">
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
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-task-list.SearchtaskPOHistory') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-header bg-primary">
                            <h5>History Task List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Description</th>
                                            <th>Date Line</th>
                                            <th>Approved At</th>
                                            <th>Request By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Purchase Proses' ||
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td> <a href="{{ url('/menu-task-list/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                    <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                    <td style="text-align: center;">{{ $ppb->approved_at }}</td>
                                                    <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                    <td>
                                                        <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #0014FF;"
                                                        href="{{ url('/exportpdf/ppb/' . $ppb->id) }}"><i
                                                            class="icon-eye" title="Preview PDF Purchase request"></i>
                                                        </a>

                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #B1D0E0;"
                                                        href="{{ url('/exportpdf/po/' . $ppb->id) }}"><i
                                                            class="icon-eye" title="Preview Purchase Order"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1"
                                                    style="background-color: #c713e7;"
                                                    href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}"><i
                                                        class="icon-eye" title="Preview PDF"></i>
                                                </a>

                                                        <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                            href="{{ url('menu-task-list/detail/' . $ppb->id) }}"><i
                                                                class="icon-zoom-in" title="Details"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
                    <script>
                        $(document).ready(function() {

                            $('.servidelet  ebtn').click(function(e) {
                                e.preventDefault();
                                alert('hello');
                            });

                        });
                    </script>
                </section>
            @endsection
