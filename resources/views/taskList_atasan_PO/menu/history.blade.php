<title>History Task list Po</title>

@extends('layouts.master')

@section('main')
    <section>

 <!-- Page Sidebar Ends-->
 <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6 mt-4">
                <h3>History Task List Super User PO </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">History Task List Super User PO</li>
                </ol>
            </div>

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
                                <h5> History Task List Super User PO</h5>
                            </div>
                              <div class="box-header mt-4">
                                <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                    <form action="{{ route('menu-taskList-atasan-po.SearchHistoryAtasanPO') }}" method="get"
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
                                        <table class="table table-bordered table-hover mt-4">
                                            <thead class="bg-primary">
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>Request By</th>
                                                    <th>Date Line</th>
                                                    <th>Status</th>
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
                                                                <td><a href="{{ $ppb->desc }}"
                                                                        target="_blank">
                                                                    <ul>
                                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                                        <li>{{ $ppb->desc }}</li>
                                                                    </ul>
                                                                        </a></td>

                                                                <td style="text-align: center;">
                                                                <ul>
                                                                <li style="white-space: nowrap;">
                                                                        @if($ppb->dateline == '≤24Jam')
                                                                        <strong><p>1 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                </td>
                                                                <td style="text-align: center;"> <a
                                                                        class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                        style="color: white; font-size:12">{{ $ppb->status }}</a>
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
                                <h5> History Task List Super User PO</h5>
                            </div>
                              <div class="box-header mt-4">
                                <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                    <form action="{{ route('menu-taskList-atasan-po.SearchHistoryAtasanPO') }}" method="get"
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
                                        <table class="table table-bordered table-hover mt-4">
                                            <thead class="bg-primary">
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>Request By</th>
                                                    <th>Date Line</th>
                                                    <th>Status</th>
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
                                                                <td><a href="{{ $ppb->desc }}"
                                                                        target="_blank">
                                                                    <ul>
                                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                                        <li>{{ $ppb->desc }}</li>
                                                                    </ul>
                                                                        </a></td>
                                                                <td style="text-align: center;">
                                                                <ul>
                                                                <li style="white-space: nowrap;">
                                                                        @if($ppb->dateline == '≤24Jam')
                                                                        <strong><p>1 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                </td>
                                                                <td style="text-align: center;"> <a
                                                                        class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                        style="color: white; font-size:12">{{ $ppb->status }}</a>
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
                                <h5> History Task List Super User PO</h5>
                            </div>
                              <div class="box-header mt-4">
                                <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                    <form action="{{ route('menu-taskList-atasan-po.SearchHistoryAtasanPO') }}" method="get"
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
                                        <table class="table table-bordered table-hover mt-4">
                                            <thead class="bg-primary">
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>Request By</th>
                                                    <th>Date Line</th>
                                                    <th>Status</th>
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
                                                                <td><a href="{{ $ppb->desc }}"
                                                                        target="_blank">
                                                                    <ul>
                                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                                        <li>{{ $ppb->desc }}</li>
                                                                    </ul>
                                                                        </a></td>
                                                                <td style="text-align: center;">
                                                                <ul>
                                                                <li style="white-space: nowrap;">
                                                                        @if($ppb->dateline == '≤24Jam')
                                                                        <strong><p>1 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                </td>
                                                                <td style="text-align: center;"> <a
                                                                        class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                        style="color: white; font-size:12">{{ $ppb->status }}</a>
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
        <!-- Container-fluid starts -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Zero Configuration  Starts-->
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5> History Task List Super User PO</h5>
                            </div>
                              <div class="box-header mt-4">
                                <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                    <form action="{{ route('menu-taskList-atasan-po.SearchHistoryAtasanPO') }}" method="get"
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
                                        <table class="table table-bordered table-hover mt-4">
                                            <thead class="bg-primary">
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>Request By</th>
                                                    <th>Date Line</th>
                                                    <th>Status</th>
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
                                                                <td><a href="{{ $ppb->desc }}"
                                                                        target="_blank">
                                                                    <ul>
                                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                                        <li>{{ $ppb->desc }}</li>
                                                                    </ul>
                                                                        </a></td>
                                                                <td style="text-align: center;">
                                                                <ul>
                                                                <li style="white-space: nowrap;">
                                                                        @if($ppb->dateline == '≤24Jam')
                                                                        <strong><p>1 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                </td>
                                                                <td style="text-align: center;"> <a
                                                                        class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                        style="color: white; font-size:12">{{ $ppb->status }}</a>
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
                                <h5> History Task List Super User PO</h5>
                            </div>
                              <div class="box-header mt-4">
                                <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                    <form action="{{ route('menu-taskList-atasan-po.SearchHistoryAtasanPO') }}" method="get"
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
                                        <table class="table table-bordered table-hover mt-4">
                                            <thead class="bg-primary">
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>Request By</th>
                                                    <th>Date Line</th>
                                                    <th>Status</th>
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
                                                                <td><a href="{{ $ppb->desc }}"
                                                                        target="_blank">
                                                                    <ul>
                                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                                        <li>{{ $ppb->desc }}</li>
                                                                    </ul>
                                                                        </a></td>
                                                                <td style="text-align: center;">
                                                                <ul>
                                                                <li style="white-space: nowrap;">
                                                                        @if($ppb->dateline == '≤24Jam')
                                                                        <strong><p>1 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                </td>
                                                                <td>
                                                                    <a class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                        style="color: white; font-size:12">{{ $ppb->status }}</a>
                                                                </td>
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
</section>
@endsection
