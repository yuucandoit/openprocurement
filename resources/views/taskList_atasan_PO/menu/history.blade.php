<title>History Task List Atasan PO</title>

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
                        <h3>History Task List Super User PO</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Historty Task List Super User PO</li>
                        </ol>
                    </div>
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
                                            <tr>
                                                <th>No</th>
                                                <th>Request By</th>
                                                <th>Item</th>
                                                <th>Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                        <tbody>
                                            <tr style="background-color:#F1F6F5;">
                                                <td>{{ $ppb->code_pengajuan }}</td>
                                                <td>
                                                    <a href="{{ url('menu-taskList-atasan-po/detail/'.$ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                            <li style="margin-top: 10px;">{{ $ppb->desc }}</li>
                                                        </ul>
                                                    </a>
                                                </td>
                                                    <td><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item</label></td>
                                                <td style="white-space:nowrap; ">
                                                    <ul>
                                                        <li>
                                                            Estimate &nbsp;:
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
                                                        <li>
                                                            <p>Created &nbsp;At : {{ \Carbon\Carbon::parse($ppb->created_at)->format('d-F-y') }}</p>
                                                        </li>
                                                        <li>
                                                            @if($ppb->status == 'Delivery Success')
                                                            <p>Finished At : {{ \Carbon\Carbon::parse($ppb->updated_at)->format('d-F-y') }}</p>
                                                            @else
                                                            <p>Finished At : -</p>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </td>
                                                @php
                                                    $oldpo = \App\Models\CategoryPO::where('ppb_id', $ppb->id)->first();
                                                    $sigpo = \App\Models\POSignature::where('ppb_id', $ppb->id)->first();
                                                @endphp
                                                <td style="text-align: center;">
                                                    <ul>
                                                        @if($ppb->status == 'Rejected by Purchasing' || $ppb->status == 'Purchase Request Rejected By BOD' || $ppb->status == 'PO Rejected By BOD' || $ppb->status == 'Payment Rejected By BOD' || $ppb->status == 'Rejected By Finance')
                                                            <li>
                                                                <a class="badge badge-danger mt-1" style="color: white; font-size:10">
                                                                    {{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="mt-1" style=" font-size:10 font-weight:600;">
                                                                    {{ \Carbon\Carbon::parse($sigpo->approved_at)->format('d-m-y  H:i:s') }}
                                                                 </a>
                                                            </li>
                                                            <li>
                                                                <a class="mt-1" style=" font-size:10 font-weight:600;">
                                                                    @if($ppb->status == 'Rejected by Purchasing')
                                                                    {{ $ppb->note_purchase }}
                                                                    @endif

                                                                    @if($ppb->status == 'Purchase Request Rejected By BOD')
                                                                    {{ $ppb->note_bod_pr }}
                                                                    @endif

                                                                    @if($ppb->status == 'PO Rejected By BOD')
                                                                    {{ $ppb->note_bod_po }}
                                                                    @endif

                                                                    @if($ppb->status == 'Payment Rejected By BOD')
                                                                    {{ $ppb->note_bod_py }}
                                                                    @endif

                                                                    @if($ppb->status == 'Rejected By Finance')
                                                                    {{ $ppb->note_finance }}
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @else
                                                        <li>
                                                            <a class="badge badge-success mt-1" style="color: white; font-size:10">
                                                                Approved
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class=" mt-1" style="font-size:10; font-weight:600;">
                                                                {{ \Carbon\Carbon::parse($ppb->approved_at)->format('d-m-y H:i:s') }}
                                                             </a>
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </td>
                                            </tr>
                                                @foreach ($ppb->quot as $po)
                                                    <tr>

                                                        @php
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                            // dd($po2->ppb_id);
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td>{{ $po->code_po }}</td>
                                                        <td>
                                                            <a href="{{ route('menu-taskList-atasan-po.po_detail',$po->id) }}">
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
                                                            </a>
                                                        </td>
                                                        <td style="font-weight: 700; white-space:nowrap;">
                                                            @foreach ($po3 as $ipo)
                                                            <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                            @endforeach
                                                        </td>
                                                        <td style="text-align: center">
                                                            @foreach ($po4 as $ipo)
                                                                <label>
                                                                    @if($ipo->matauang == "RP")
                                                                    Rp.{{ number_format($ipo->grand_total ,2) }}
                                                                    @elseif ($ipo->matauang == "USD")
                                                                    $ {{ number_format($ipo->grand_total ,2) }}
                                                                    @endif
                                                                </label>
                                                            @endforeach
                                                        </td>
                                                        <td colspan="2"  class="text-center">
                                                            <ul>
                                                                <li><a class="badge badge-success mt-1" style="color: white; font-size:10">Approved</a></li>
                                                                <li>
                                                                    <a class=" mt-1" style="font-size:10; font-weight:600;">
                                                                        @if(empty($sigpo->approved_at))
                                                                        {{ \Carbon\Carbon::parse($oldpo->approved_at)->format('d-m-y H:i:s') }}
                                                                        @else
                                                                        {{ \Carbon\Carbon::parse($sigpo->approved_at)->format('d-m-y H:i:s') }}
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @endforeach
                                    </table>
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
