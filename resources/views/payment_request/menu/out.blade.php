<title>Payment Request</title>

@extends('layouts.master')

@section('main')
<section>

            @foreach ($datappb as $purchase)
                <div class="modal fade" id="modalDelete{{ $purchase->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h2 class="modal-title" style="color: white">Delete</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mx-5 mb-3">
                                <span class="warning">
                                    <img src="assets/images/warning.png">
                                </span>
                                <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('/delivery/destroy/' . $purchase->id) }}">
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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h2 class="modal-title" style="color: white">List Item</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
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
                            <div class="modal-footer">
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
                    <h3>Payment Request Out</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/payment_request/out') }}">Payment Request Out</a></li>
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
                            <form action="{{ route('payment_request.SearchPaymentreq_out') }}" method="get" class="input-group">
                                <input type="text" name="caripyOut" class="form-control " placeholder="Search ..." value="{{ request('caripyOut') }}">
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
                                    <th>No</th>
                                    <th>Code PR/PO</th>
                                    <th>Name</th>
                                    <th>Item</th>
                                    <th>Deadline</th>
                                    @hasrole('finance|super admin')
                                    <th style="text-align: center">Status</th>
                                    @endhasrole
                                    {{-- <th>Function</th> --}}
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                                $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                            @endphp
                            <tbody>
                                @foreach ($datappb as $ppb)
                                    @php $approvedPPB[] =$ppb; @endphp
                                    <tr style="background-color:#F1F6F5;">
                                        <td style="text-align: center;">{{ $i++ }}</td>
                                        <td>{{ $ppb->code_pengajuan }}</td>
                                        <td >
                                            <ul>
                                                <a href="{{ url('/payment_request/detail/' . $ppb->id) }}">
                                                    <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                    <li>{!! nl2br($ppb->desc) !!}</li>
                                                </a>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                            </ul>
                                        </td>
                                        {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}
                                        <td style="text-align: center; white-space:nowrap;">
                                            @if($ppb->dateline == '≤24Jam')
                                            <strong><p>1 Hari</p></strong>
                                            @elseif ($ppb->dateline == '≤72Jam')
                                            <strong><p>2 sd 3 Hari</p></strong>
                                            @elseif ($ppb->dateline == '≤168Jam')
                                            <strong><p>4 sd 7 Hari</p></strong>
                                            @elseif ($ppb->dateline == '≤336Jam')
                                            <strong><p>7 sd 14 Hari</p></strong>
                                            @endif
                                            {{-- {{ $ppb->dateline }} --}}
                                        </td>
                                        @hasrole('finance|super admin')
                                            <td style="text-align: center;">
                                                <ul>
                                                    <li>
                                                        <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:10">{{ $ppb->status }}</a>
                                                    </li>
                                                    <li style="text-align: center;">
                                                        <a style="font-style: italic; font-size:10; " href="{{ route('payment_request.detail',$ppb->id) }}/#comment">
                                                        - {{ $ppb->comment->count() }} Comments
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        @endhasrole
                                    </tr>
                                    @foreach ($ppb->quot as $po)
                                        @if($po->status == 'Payment Approved')
                                        <tr>

                                            @php
                                                $po2 = \App\Models\CategoryPO::find($po->id);
                                                $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                            @endphp

                                            @if(empty($po2))

                                            @else
                                            <td style="text-align: center">-</td>
                                            <td>
                                                <a href="{{ route('payment_request.po_detail',$po->id) }}">
                                                {{ $po->code_po }}
                                                </a>
                                            </td>
                                            <td>
                                                <ul>
                                                    <a href="{{ route('payment_request.po_detail',$po->id) }}">
                                                        <li style="white-space: nowrap;">
                                                            @if($po2->vendorable_id == 0)
                                                            Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                            @else
                                                            Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? ' - ' }}
                                                            @endif
                                                        </li>
                                                        <li> Quotation : {{ $po2->quotation }}</li>
                                                    </a>
                                                </ul>
                                            </td>
                                            <td style="font-weight: 700; white-space:nowrap;">
                                                @foreach ($po3 as $ipo)
                                                <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                @endforeach
                                            </td>
                                            <td style="text-align: center">
                                                @foreach ($po4 as $ipo)
                                                <label>
                                                    {{ $ipo->matauang }} {{ number_format($ipo->grand_total ,2) }}
                                                </label>
                                                @endforeach
                                            </td>
                                            <td class="text-center"><a
                                                class="badge bg-success mt-1"
                                                style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                            @endif
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Zero Configuration  Ends-->
</section>
@endsection
