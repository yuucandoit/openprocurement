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

        @foreach ($datapo as $po)
            <div class="modal fade" id="modalItemVendor{{ $po->id }}" tabindex="-1" aria-hidden="true">
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

                                    @foreach ($po->itempo as $item)
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
                        <h3>Task List Super User PO</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task List Super User PO</li>
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                        {{-- Data Masuk --}}
                             <table class="table table-bordered table-hover tasklistpo" >
                                        <thead class="bg-primary">
                                            <tr>
                                                <th style="text-align: center;"><input type="checkbox" id="head-cb"></th>
                                                <th style="text-align: center;">No</th>
                                                <th>Request By</th>
                                                <th>Item</th>
                                                <th style="text-align: center;">Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                            $year = Carbon\Carbon::now()->format('y');
                                            $month = Carbon\Carbon::now()->format('m');
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                                @if ($ppb->atasan_po == 3)
                                                @php
                                                     $approvedPPB[] =$ppb;
                                                @endphp
                                                <tbody>
                                                    <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}">
                                                                <ul>
                                                                    <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                                    <li style="word-break:break-all margin-top: 5px;">{{ $ppb->desc }}</li>
                                                                </ul>
                                                            </a></td>
                                                            <td><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item</label></td>
                                                            <td style="text-align: center;">
                                                             <ul>
                                                                <li>
                                                                    <p class="ppb-countdown" style="color:rgb(81, 171, 71)"></p>
                                                                </li>
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
                                                                class="badge badge-lable {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:12">{{ $ppb->status }}</a>
                                                            </td>
                                                    </tr>

                                                    @foreach ($ppb->quot as $po)
                                                    <tr>

                                                        @php
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get()
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td style="text-align: center"><input type="checkbox" class="child-po-cb po-cb-{{ $po2->ppb_id }}" value="{{ $po2->id }}"></td>
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <ul>
                                                                <li> Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}</li>
                                                                <li> Quotation : {{ $po2->quotation }}</li>
                                                            </ul>
                                                        </td>
                                                        <td style="font-weight: 700; white-space:nowrap;">
                                                            @foreach ($po3 as $ipo)
                                                            <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                            @endforeach
                                                        </td>
                                                        <td style="text-align: center">
                                                            @foreach ($po4 as $ipo)
                                                            <label >{{ $ipo->matauang }}. {{ number_format($ipo->grand_total ,2) }}</label>
                                                            @endforeach
                                                        </td>
                                                        {{-- <td>Vendor : Tokopedia</td> --}}
                                                        {{-- <td>20 Item</td> --}}
                                                        {{-- <td>Quotation : 25/TAM/I/2023</td> --}}
                                                        <td colspan="2"  class="text-center"><a
                                                            class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                        @endif
                                                    </tr>
                                                    @endforeach

                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                    <div class="box-header">
                                        <button type="button" id="button-approve-selected" disabled class="btn btn-danger btn-sm"
                                        style="margin-top: 20px; font-size:12px"  onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                                    </div>
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

@endif

    @if (Auth::user()->id === 6)
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
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover tasklistpo">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th style="text-align: center;"><input type="checkbox" id="head-cb"></th>
                                                <th style="text-align: center;">No</th>
                                                <th>Request By</th>
                                                <th>Item</th>
                                                <th style="text-align: center;">Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                            @if ($ppb->atasan_po == 6)
                                            @php
                                                $approvedPPB[] =$ppb;
                                            @endphp
                                                <tbody>
                                                    <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">
                                                             <ul>
                                                                <li>
                                                                    <p class="ppb-countdown" style="color:rgb(81, 171, 71)"></p>
                                                                </li>
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
                                                    @foreach ($ppb->quot as $po)
                                                    <tr>

                                                        @php
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td style="text-align: center"><input type="checkbox" class="child-po-cb po-cb-{{ $po2->ppb_id }}" value="{{ $po2->id }}"></td>
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>Vendor : {{ $po2->vendorable->nama }}</td>
                                                        <td style="font-weight: 700; white-space:nowrap;">
                                                            @foreach ($po3 as $ipo)
                                                            <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                            @endforeach
                                                        </td>
                                                        <td style="text-align: center">{{ $po2->quotation }}</td>
                                                        {{-- <td>Vendor : Tokopedia</td> --}}
                                                        {{-- <td>20 Item</td> --}}
                                                        {{-- <td>Quotation : 25/TAM/I/2023</td> --}}
                                                        <td colspan="2"  class="text-center"><a
                                                            class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                    <div class="box-header">
                                        <button type="button" id="button-approve-selected" disabled class="btn btn-danger btn-sm"
                                        style="margin-top: 20px; font-size:12px"  onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                                    </div>
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

    @endif

    @if (Auth::user()->id === 7)
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
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover tasklistpo">
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th style="text-align: center;"><input type="checkbox" id="head-cb"></th>
                                                <th style="text-align: center;">No</th>
                                                <th>Request By</th>
                                                <th>Item</th>
                                                <th style="text-align: center;">Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                             @if ($ppb->atasan_po == 7)
                                             @php
                                             $approvedPPB[] =$ppb;
                                            @endphp
                                                <tbody>
                                                    <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">
                                                             <ul>
                                                                <li>
                                                                    <p class="ppb-countdown" style="color:rgb(81, 171, 71)"></p>
                                                                </li>
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
                                                    @foreach ($ppb->quot as $po)
                                                    <tr>

                                                        @php
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td style="text-align: center"><input type="checkbox" class="child-po-cb po-cb-{{ $po2->ppb_id }}" value="{{ $po2->id }}"></td>
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>Vendor : {{ $po2->vendorable->nama }}</td>
                                                        <td style="font-weight: 700; white-space:nowrap;">
                                                            @foreach ($po3 as $ipo)
                                                            <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                            @endforeach
                                                        </td>
                                                        <td style="text-align: center">{{ $po2->quotation }}</td>
                                                        {{-- <td>Vendor : Tokopedia</td> --}}
                                                        {{-- <td>20 Item</td> --}}
                                                        {{-- <td>Quotation : 25/TAM/I/2023</td> --}}
                                                        <td colspan="2"  class="text-center"><a
                                                            class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                    <div class="box-header">
                                        <button type="button" id="button-approve-selected" disabled class="btn btn-danger btn-sm"
                                        style="margin-top: 20px; font-size:12px"  onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                                    </div>
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
     @endif


    @if (Auth::user()->id === 8)
    <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">

                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover tasklistpo">
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th style="text-align: center;"><input type="checkbox" id="head-cb"></th>
                                                <th style="text-align: center;">No</th>
                                                <th>Request By</th>
                                                <th>Item</th>
                                                <th style="text-align: center;">Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                            @if ($ppb->atasan_po == 8)
                                            @php
                                             $approvedPPB[] =$ppb;
                                            @endphp
                                                <tbody>
                                                    <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                        <td style="text-align: center;">{{ $i++ }}</td>
                                                        <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">
                                                         <ul>
                                                                <li>
                                                                    <p class="ppb-countdown" style="color:rgb(81, 171, 71)"></p>
                                                                </li>
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
                                                    @foreach ($ppb->quot as $po)
                                                    <tr>

                                                        @php
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td style="text-align: center"><input type="checkbox" class="child-po-cb po-cb-{{ $po2->ppb_id }}" value="{{ $po2->id }}"></td>
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>Vendor : {{ $po2->vendorable->nama }}</td>
                                                        <td style="font-weight: 700; white-space:nowrap;">
                                                            @foreach ($po3 as $ipo)
                                                            <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                            @endforeach
                                                        </td>
                                                        <td style="text-align: center">{{ $po2->quotation }}</td>
                                                        {{-- <td>Vendor : Tokopedia</td> --}}
                                                        {{-- <td>20 Item</td> --}}
                                                        {{-- <td>Quotation : 25/TAM/I/2023</td> --}}
                                                        <td colspan="2"  class="text-center"><a
                                                            class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                        @endif
                                                    </tr>
                                                    @endforeach
                                              </tbody>
                                             @endif
                                        @endif
                                    @endforeach
                                    </table>
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                    <div class="box-header">
                                        <button type="button" id="button-approve-selected" disabled class="btn btn-danger btn-sm"
                                        style="margin-top: 20px; font-size:12px"  onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                                    </div>
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

   @endif

    @if (Auth::user()->id === 9)
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
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover tasklistpo">
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th style="text-align: center;"><input type="checkbox" id="head-cb"></th>
                                                <th style="text-align: center;">No</th>
                                                <th>Request By</th>
                                                <th>Item</th>
                                                <th style="text-align: center;">Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Waiting For PO Approval')
                                            @if ($ppb->atasan_po == 9)
                                            @php
                                             $approvedPPB[] =$ppb;
                                            @endphp
                                                <tbody>
                                                    <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                            <td style="text-align: center;">{{ $i++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                            <td style="text-align: center;">
                                                             <ul>
                                                                <li>
                                                                    <p class="ppb-countdown" style="color:rgb(81, 171, 71)"></p>
                                                                </li>
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
                                                       </tr>
                                                       @foreach ($ppb->quot as $po)
                                                            <tr>

                                                                @php
                                                                    $po2 = \App\Models\CategoryPO::find($po->id);
                                                                    $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                                    // dd($po2->ppb_id);
                                                                @endphp

                                                                @if(empty($po2))

                                                                @else
                                                                <td style="text-align: center"><input type="checkbox" class="child-po-cb po-cb-{{ $po2->ppb_id }}" value="{{ $po2->id }}"></td>
                                                                <td>{{ $po->code_po }}</td>
                                                                <td>Vendor : {{ $po2->vendorable->nama }}</td>
                                                                <td style="font-weight: 700; white-space:nowrap;">
                                                                    @foreach ($po3 as $ipo)
                                                                    <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                                    @endforeach
                                                                </td>
                                                                <td style="text-align: center">{{ $po2->quotation }}</td>
                                                                {{-- <td>Vendor : Tokopedia</td> --}}
                                                                {{-- <td>20 Item</td> --}}
                                                                {{-- <td>Quotation : 25/TAM/I/2023</td> --}}
                                                                <td colspan="2"  class="text-center"><a
                                                                    class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                 </tbody>
                                             @endif
                                            @endif
                                        @endforeach
                                    </table>
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                    <div class="box-header">
                                        <button type="button" id="button-approve-selected" disabled class="btn btn-danger btn-sm"
                                        style="margin-top: 20px; font-size:12px"  onclick="approveDataTerpilihPO()">Approve Selected Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('menu-taskList-atasan-po.accept_atasan_selected_po') }}" method="get" id="form-export-terpilih" class="hidden">
                        <input type="hidden" name="ids">
                        <button class="hidden" style="display: none;" type="submit">S</button>
                    </form>

   @endif

    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        //Checkbox Cek All
        $("#head-cb").on('click', function() {
            var isChecked = $('#head-cb').prop('checked')
            $(".child-cb").prop('checked', isChecked)
            $(".child-po-cb").prop('checked', isChecked)
            $("#button-approve-selected").prop('disabled', !isChecked)
        })

        $(".tasklistpo ").on('click', '.child-cb', function() {
            if ($(this).prop('checked') != true) {
                $("#head-cb").prop('checked', false)
            }
            let semua_checkbox = $(".tasklistpo  .child-cb:checked")
            let button_approve_selected = (semua_checkbox.length > 0)

            $(".child-po-cb").prop('checked',false); //reset checkboxpo
            $.each(semua_checkbox, function(index, elm){
                let cbId = $(elm).val();
                console.log(cbId);
                $('.po-cb-' + cbId).prop('checked',true); //set Checkbox PO
            });

            $("#button-approve-selected").prop('disabled', !button_approve_selected)
        })

        // $(".tasklistpo").on('click','.child-po-cb', function() {
        //     if ($(this).prop('checked') != true) {
        //         $("#head-cb").prop('checked', false)
        //     }

        //     let checkboxPO = $(".tasklistpo .child-po-cb:checked")
        //     let button_approve_po = (checkboxPO.length > 0)

        //     $("#button-approve-selected").prop('disabled', !button_approve_po)
        // })

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

            // let checkbox_po =  $(".tasklistpo .child-po-cb:checked")
            // let semua_id_po = []
            // $.each(checkbox_po, function(index, elm){
            //     semua_id_po.push(elm.value)
            // })
            // let id_po = semua_id_po.join(',')

           console.log(ids);
        }
    </script>
@endsection
@section('scripts')
<script>
    const data = @json($approvedPPB);
    // console.log(data);
    const item = data[0];

    // FOR CALCULATE REMAINING DEADLINE TIME 😃
    const remainingTime = (data, elmnt) => {
        const {
            approved_at,
            dateline_time,
            datetime
        } = data;

        const dateline = {
            day     : () => dateline.toDigit(Math.floor(parseInt(dateline.split()[0])/24.1) || 1),
            hours   : () => dateline.toDigit(Math.floor(parseInt(dateline.split()[0])%24.1)),
            minutes : () => dateline.split()[1],
            seconds : () => dateline.split()[2],
            time    : () => `${dateline.hours()}:${dateline.minutes()}:${dateline.seconds()}`,
            split   : () => dateline_time.split(':'),
            toDigit : (val) => val > 9 ? val : '0'+val,
        }

        const approvedAt = new Date(approved_at);
        const dueDateTime = new Date(`1970-01-${dateline.day()}T${dateline.time()}Z`);
        const dueDateAt = new Date(approvedAt.getTime() + dueDateTime.getTime());
        const remainingTime = new Date(dueDateAt.getTime() - Date.now());
        const expiredTime = new Date(dueDateAt.getTime() + Date.now());
        const lable = elmnt.querySelector('.badge-lable');

        // console.log(dateline_time, remainingTime.getTime());

        if (remainingTime.getTime() < 1) {
            lable.classList.remove('bg-dark');
            lable.classList.add('bg-dark');
            const days  = dateline.split()[0] == 24 ? (expiredTime.getDate()-2).toString() : (expiredTime.getDate()-1).toString();
            const hours = expiredTime.getUTCHours().toString();
            const minutes = expiredTime.getUTCMinutes().toString();
            const seconds = expiredTime.getUTCSeconds().toString();
            return (
            (days.length == 1 ? `-0${days}:` : `-${days}:`)+
            (hours.length == 1 ? `0${hours}:` : `${hours}:`) +
            (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
            (seconds.length == 1 ? `0${seconds}` : `${seconds}`)
        );
            }

        let colors = [];
        const days  = dateline.split()[0] == 24 ? (remainingTime.getDate()-2).toString() : (remainingTime.getDate()-1).toString();
        const hours = remainingTime.getUTCHours().toString();
        const minutes = remainingTime.getUTCMinutes().toString();
        const seconds = remainingTime.getUTCSeconds().toString();

        lable.classList.remove('bg-danger');
        lable.classList.remove('bg-warning');
        lable.classList.remove('bg-success');

        // SUDAH OTOMATIS HITUNG DISINI YAAAAA 😁
        lable.classList.add((() => {
            const dueDate   = dueDateTime.getTime();
            const remaining = remainingTime.getTime();

            if(remaining <= 60*60*1000) return 'bg-dark';
            if(remaining <= dueDate*1/3) return'bg-danger';
            if(remaining <= dueDate*2/3) return'bg-warning';
            if(remaining <= dueDate*3/3) return'bg-success';
        })());

        return (
            (days.length == 1 ? `0${days}:` : `${days}:`)+
            (hours.length == 1 ? `0${hours}:` : `${hours}:`) +
            (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
            (seconds.length == 1 ? `0${seconds}` : `${seconds}`)
        );
    }

    // FOR HANDLE REWRITE ELEMENT 😃
    const countdownHandle = (elmnt, item) => {
        const countdownElmnt = elmnt.querySelector('.ppb-countdown');
        countdownElmnt.innerText = remainingTime(item, elmnt);
    }

    // FOR INITIALIZE COUNTDOWN 😃
    const initCountdown = (data) => {
        data.forEach(item => {
            if (!item.approved_at) return;
            setInterval(() => countdownHandle(document.querySelector(
                `#ppb-${item.id}`
            ), item), 1000);
        });
    }

    initCountdown(data);
</script>
@endsection

