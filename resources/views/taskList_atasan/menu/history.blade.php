<title>History Task List Super User</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header mt-4">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Super User</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Super User</li>
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
                            <h5>History Task List Super User Purchase Request</h5>
                        </div>
                        <div class="box-header mt-4">
                            <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                <form action="{{ route('menu-taskList-atasan.SearchHistoryRequestTask') }}" method="get"
                                    class="input-group">
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                        value="{{ old('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                            value="Go"></span>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    {{-- Data Keluar --}}
                                    <table class="table table-bordered table-hover mt-4" >
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                             $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Purchase Submission Approved' ||
                                        $ppb->status == 'Purchase Proses' ||
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan == 3)
                                                 <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ $ppb->desc }}"
                                                                    target="_blank">{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                        <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td>
                                                     </tr>
                                                </tbody>
                                                @endif
                                        @endif
                                        @endforeach
                                    </table>
                                    <div class="mt-4">
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
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
                            <h5>History Task List Super User Purchase Request</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    {{-- Data Keluar --}}
                                    <table class="table table-bordered table-hover mt-4" >
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                             $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Purchase Submission Approved' ||
                                        $ppb->status == 'Purchase Proses' ||
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan == 6)
                                                 <tbody>
                                                        <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ $ppb->desc }}"
                                                                    target="_blank">{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                        <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td>
                                                     </tr>
                                                </tbody>
                                                @endif
                                        @endif
                                        @endforeach
                                    </table>
                                    <div class="mt-4">
                                        {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
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
                            <h5>History Task List Super User Purchase Request</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover mt-4" >
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                             $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Purchase Submission Approved' ||
                                                 $ppb->status == 'Purchase Proses' ||
                                                 $ppb->status == 'Waiting For PO Approval' ||
                                                 $ppb->status == 'PO Approved' ||
                                                 $ppb->status == 'Invoicing Process' ||
                                                 $ppb->status == 'Unpaid' ||
                                                 $ppb->status == 'Paid' ||
                                                 $ppb->status == 'Delivery Process' ||
                                                 $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan == 7)
                                                <tbody>
                                                    <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ $ppb->desc }}"
                                                                    target="_blank">{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                 </tbody>
                                              @endif
                                            @endif
                                        @endforeach
                                    </table>
                                    <div class="mt-4">
                                        {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

     <!-- Container-fluid Ends-->
    @endif


    @if (Auth::user()->id === 8)
    <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>History Task List Super User Purchase Request</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover mt-4" >
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                             $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Purchase Submission Approved' ||
                                            $ppb->status == 'Purchase Proses' ||
                                            $ppb->status == 'Waiting For PO Approval' ||
                                            $ppb->status == 'PO Approved' ||
                                            $ppb->status == 'Invoicing Process' ||
                                            $ppb->status == 'Unpaid' ||
                                            $ppb->status == 'Paid' ||
                                            $ppb->status == 'Delivery Process' ||
                                            $ppb->status == 'Delivery Success')
                                            @if ($ppb->atasan == 8)
                                                <tbody>
                                                    <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ $ppb->desc }}"
                                                                    target="_blank">{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td style="text-align: center;"> <a
                                                                    class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        <td style="text-align: center;">

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            {{-- <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #FF8C00;"
                                                                href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"><i
                                                                    class="icon-pencil-alt" title="Edit"></i>
                                                            </a> --}}

                                                        </td>
                                                    </tr>
                                                </tbody>
                                             @endif
                                         @endif
                                    @endforeach
                                    </table>
                                    <div class="mt-4">
                                        {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
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
                            <h5>History Task List Super User Purchase Request</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover mt-4" >
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Date Line</th>
                                                <th>Request By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                             $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Purchase Submission Approved' ||
                                                 $ppb->status == 'Purchase Proses' ||
                                                 $ppb->status == 'Waiting For PO Approval' ||
                                                 $ppb->status == 'PO Approved' ||
                                                 $ppb->status == 'Invoicing Process' ||
                                                 $ppb->status == 'Unpaid' ||
                                                 $ppb->status == 'Paid' ||
                                                 $ppb->status == 'Delivery Process' ||
                                                 $ppb->status == 'Delivery Success')
                                                @if ($ppb->atasan == 9)
                                                <tbody>
                                                    <tr>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ $ppb->desc }}"
                                                                    target="_blank">{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}
                                                            </td>
                                                            <td>
                                                                <a class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>

                                                            <td style="text-align: center;">
                                                         <a class="btn btn-iconsolid mt-1"
                                                            style="background-color: #00008B;"
                                                            href="{{ url('menu-taskList-atasan/detail/'.$ppb->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                         </a>
                                                    </tr>
                                            </tbody>
                                            @endif
                                        @endif
                                    @endforeach
                                    </table>
                                    <div class="mt-4">
                                        {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                        </div>
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
@endsection
