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
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                    {{-- Data Keluar --}}
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-primary">
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
                                                        <tr style="background-color:#F1F6F5;">
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                             <td style="white-space:nowrap;">
                                                        @if($ppb->dateline == '≤24Jam')
                                                        <strong><p>1 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                        @endif
                                                    </td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
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
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get()
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    @if($po2->vendorable_id == 0)
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                    @else
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                    @endif
                                                                    {{-- Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }} --}}
                                                                </li>
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
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    {{-- Data Keluar --}}
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-primary">
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
                                                        <tr style="background-color:#F1F6F5;">
                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                            <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                    >{{ $ppb->desc }}</a></td>
                                                             <td style="white-space:nowrap;">
                                                        @if($ppb->dateline == '≤24Jam')
                                                        <strong><p>1 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                        @endif
                                                    </td>
                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
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
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get()
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    @if($po2->vendorable_id == 0)
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                    @else
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                    @endif
                                                                    {{-- Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }} --}}
                                                                </li>
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
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-primary">
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
                                                    <tr style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                >{{ $ppb->desc }}</a></td>
                                                         <td style="white-space:nowrap;">
                                                        @if($ppb->dateline == '≤24Jam')
                                                        <strong><p>1 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                        @endif
                                                    </td>
                                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}
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
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get()
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    @if($po2->vendorable_id == 0)
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                    @else
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                    @endif
                                                                    {{-- Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }} --}}
                                                                </li>
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
                                                 </tbody>
                                              @endif
                                            @endif
                                        @endforeach
                                    </table>
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-primary">
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
                                                    <tr style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                >{{ $ppb->desc }}</a></td>
                                                         <td style="white-space:nowrap;">
                                                        @if($ppb->dateline == '≤24Jam')
                                                        <strong><p>1 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                        @endif
                                                    </td>
                                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}
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
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get()
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    @if($po2->vendorable_id == 0)
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                        @else
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                    @endif
                                                                    {{-- Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }} --}}
                                                                </li>
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
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan-po.SearchAtasanPOOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered table-hover ">
                                        <thead class="bg-primary">
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
                                                    <tr style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}"
                                                                >{{ $ppb->desc }}</a></td>
                                                         <td style="white-space:nowrap;">
                                                        @if($ppb->dateline == '≤24Jam')
                                                        <strong><p>1 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                        @endif
                                                    </td>
                                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}
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
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get()
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>@if($po2->vendorable_id == 0)
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                        @else
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                    @endif
                                                                    {{-- Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }} --}}
                                                                </li>
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
                                            </tbody>
                                            @endif
                                        @endif
                                    @endforeach
                                    </table>
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
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
