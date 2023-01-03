<title>Task List Atasan PO</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datappb as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                            <span class="warning">
                                <img src="assets/images/warning.png">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}">
                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Task List Super User PO</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task List Super User PO</li>
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

        @if (Auth::user()->id === 3)
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User In</h5>
                        </div>
                        <div >
                            <button type="button" id="button-approve-selected" disabled class="btn btn-danger pull-right"
                            style="margin-top: -8px;" onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                        {{-- Data Masuk --}}
                             <table class="display tasklistpo" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th><input type="checkbox" id="head-cb"></th>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                                @if ($ppb->atasan_po == 3)
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('menu-taskList-atasan-po.accept_atasan_selected_po') }}" method="get" id="form-export-terpilih" class="hidden">
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>
    <!-- Container-fluid Ends-->
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User Out</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    {{-- Data Keluar --}}
                                    <table class="display mt-4" id="advance-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'PO Approved'||
                                        $ppb->status == 'Invoicing Process'||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid'||
                                        $ppb->status == 'Paid'||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan_po == 3)
                                                 <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                     </tr>
                                                </tbody>
                                                @endif
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Container-fluid Ends -->
@endif

    @if (Auth::user()->id === 6)
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User In</h5>
                        </div>
                        <div >
                            <button type="button" id="button-approve-selected" disabled class="btn btn-danger pull-right"
                            style="margin-top: -8px;" onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display tasklistpo" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th><input type="checkbox" id="head-cb"></th>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                            @if ($ppb->atasan_po == 6)
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
                                                    @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('menu-taskList-atasan-po.accept_atasan_selected_po') }}" method="get" id="form-export-terpilih" class="hidden">
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>

    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User Out</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    {{-- Data Keluar --}}
                                    <table class="display mt-4" id="advance-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'PO Approved'||
                                        $ppb->status == 'Invoicing Process'||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid'||
                                        $ppb->status == 'Paid'||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan_po == 6)
                                                 <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                     </tr>
                                                </tbody>
                                                @endif
                                        @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- Container-fluid Ends -->
    @endif

    @if (Auth::user()->id === 7)
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User In</h5>
                        </div>
                        <div >
                            <button type="button" id="button-approve-selected" disabled class="btn btn-danger pull-right"
                            style="margin-top: -8px;" onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display tasklistpo" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th><input type="checkbox" id="head-cb"></th>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                             @if ($ppb->atasan_po == 7)
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('menu-taskList-atasan-po.accept_atasan_selected_po') }}" method="get" id="form-export-terpilih" class="hidden">
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>

    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User Out</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display mt-4" id="advance-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'PO Approved'||
                                            $ppb->status == 'Invoicing Process'||
                                            $ppb->status == 'Payment Approved' ||
                                            $ppb->status == 'Unpaid'||
                                            $ppb->status == 'Paid'||
                                            $ppb->status == 'Delivery Process' ||
                                            $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan_po == 7)
                                                <tbody>
                                                    <tr>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                        </td> --}}
                                                    </tr>
                                                 </tbody>
                                              @endif
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

     <!-- Container-fluid Ends-->
    @endif


    @if (Auth::user()->id === 8)
    <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User In</h5>
                        </div>
                        <div >
                            <button type="button" id="button-approve-selected" disabled class="btn btn-danger pull-right"
                            style="margin-top: -8px;" onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display tasklistpo" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th><input type="checkbox" id="head-cb"></th>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                            @if ($ppb->atasan_po == 8)
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
                                              </tbody>
                                             @endif
                                        @endif
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('menu-taskList-atasan-po.accept_atasan_selected_po') }}" method="get" id="form-export-terpilih" class="hidden">
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>

    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User Out</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display mt-4" id="advance-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'PO Approved'||
                                            $ppb->status == 'Invoicing Process'||
                                            $ppb->status == 'Payment Approved' ||
                                            $ppb->status == 'Unpaid'||
                                            $ppb->status == 'Paid'||
                                            $ppb->status == 'Delivery Process' ||
                                            $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan_po == 8)
                                                <tbody>
                                                    <tr>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        {{-- <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                        </td> --}}
                                                    </tr>
                                                </tbody>
                                             @endif
                                         @endif
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endif

    @if (Auth::user()->id === 9)
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User In</h5>
                        </div>
                        <div >
                            <button type="button" id="button-approve-selected" disabled class="btn btn-danger pull-right"
                            style="margin-top: -8px;" onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display tasklistpo" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th><input type="checkbox" id="head-cb"></th>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                            @if ($ppb->atasan_po == 9)
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td>
                                                                <a class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                            {{-- <td style="text-align: center;">

                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #00008B;"
                                                                    href="{{ url('menu-taskList-atasan-po/detail/' . $ppb->id) }}"><i
                                                                        class="icon-zoom-in" title="Details"></i>
                                                                </a> --}}
                                                       </tr>
                                                 </tbody>
                                             @endif
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('menu-taskList-atasan-po.accept_atasan_selected_po') }}" method="get" id="form-export-terpilih" class="hidden">
                        <input type="hidden" name="ids">
                        <button class="hidden" style="display: none;" type="submit">S</button>
                    </form>

    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Task List Super User Out</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="display mt-4" id="advance-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'PO Approved'||
                                            $ppb->status == 'Invoicing Process'||
                                            $ppb->status == 'Payment Approved' ||
                                            $ppb->status == 'Unpaid'||
                                            $ppb->status == 'Paid'||
                                            $ppb->status == 'Delivery Process' ||
                                            $ppb->status == 'Delivery Success')
                                                @if ($ppb->atasan_po == 9)
                                                <tbody>
                                                    <tr>
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td>
                                                                <a class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                            {{-- <td style="text-align: center;">
                                                         <a class="btn btn-iconsolid mt-1"
                                                            style="background-color: #00008B;"
                                                            href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                         </a> --}}
                                                    </tr>
                                            </tbody>
                                            @endif
                                        @endif
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endif
<!-- Zero Configuration  Ends-->
                <script>
                    $(document).ready(function() {

                        $('.servidelet  ebtn').click(function(e) {
                            e.preventDefault();
                            alert('hello');
                        });

                    });
                </script>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        //Checkbox Cek All
        $("#head-cb").on('click', function() {
            var isChecked = $('#head-cb').prop('checked')
            $(".child-cb").prop('checked', isChecked)
            $("#button-approve-selected").prop('disabled', !isChecked)
        })

        $(".tasklistpo ").on('click', '.child-cb', function() {
            if ($(this).prop('checked') != true) {
                $("#head-cb").prop('checked', false)
            }
            let semua_checkbox = $(".tasklistpo  .child-cb:checked")
            let button_approve_selected = (semua_checkbox.length > 0)

            $("#button-approve-selected").prop('disabled', !button_approve_selected)
        })

        function approveDataTerpilihPO() {
            let checkbox_terpilih = $(".tasklistpo .child-cb:checked")
            let semua_id = []
            $.each(checkbox_terpilih, function(index, elm) {
                semua_id.push(elm.value)
            })
            let ids = semua_id.join(',')
            $("#button-approve-selected").prop('disabled', true)
            $("#form-export-terpilih [name='ids']").val(ids)
            $("#form-export-terpilih").submit()
           console.log(semua_id);
        }
    </script>
@endsection
