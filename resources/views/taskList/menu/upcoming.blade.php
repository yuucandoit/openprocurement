<title>Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datappb as $ppb)
        <div class="modal fade" id="modalItem{{ $ppb->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">

                        <h4 class="modal-title" style="color: white">List Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        @php
                            $i = 1;
                        @endphp
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Uom</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppb->itemppn as $item)
                                <tr>
                                    <td> {{ $item->item }}</td>
                                    <td> {{ $item->qty }}</td>
                                    <td> {{ $item->kategori }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                        <h3>Task List Up Comming</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Task List Up Coming</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-task-list.SearchtaskUpComming') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Pengajuan</th>
                                            <th>Request By</th>
                                            <th>Item</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $approvedPPB = [];
                                    @endphp
                                    <tbody>
                                    @foreach ($datappb as $ppb)
                                        <tr id="ppb-{{ $ppb->id }}">
                                            <td style="text-align: center;">{{ $no++ }}</td>
                                            <td style="text-align: center;">
                                                <ul>
                                                    {{-- <li>{{ $id_number }}/PB/SII/{{ $month }}/{{ $year }}</li> --}}
                                                    <li><a href="{{ url('menu-task-list/upcoming/detail/' . $ppb->id) }}" >{{ $ppb->code_pengajuan }}</a></li>
                                                </ul>
                                            </td>
                                            <td><a href="{{ url('menu-task-list/upcoming/detail/' . $ppb->id) }}">
                                                <ul>
                                                    <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                    <li>{{ $ppb->desc }}</li>
                                                </ul>

                                            </a></td>
                                            <td>
                                                @foreach ($ppb->itemppn as $ice)
                                                    @php
                                                    $ipb = \App\Models\PengajuanPembelian::select(DB::raw('pp_id,SUM(qty) as qty'))->where('pp_id',$ice->pp_id)->groupBy('pp_id')->first();
                                                    @endphp
                                                @endforeach
                                                <ul>
                                                    <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ipb->qty }} Item </label></li>
                                                </ul>

                                            </td>
                                            <td>
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
                                            <td style="text-align: center;">
                                                <ul>
                                                    <li>
                                                        @if($ppb->logistic_check == 1)
                                                        <a class="badge"style="color: white; background-color:black; font-size:10">
                                                        Waiting Approval Inventory Check
                                                        </a>
                                                        @else
                                                        <a class="badge"style="color: white; background-color:orange; font-size:10">
                                                        Waiting Approval Request {{ $ppb->bod->name }}
                                                        </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>

    <!-- Container-fluid starts-->
    </section>
@endsection

