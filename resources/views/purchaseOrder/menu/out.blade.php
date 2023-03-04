<title>Purchase Order Out</title>
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
                        <form action="{{ url('/menu-purchase-order/destroy/' . $purchase->id) }}">
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
                            <h4 class="modal-title" style="color: white">List Item</h4>
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
                                        <th>UOM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ppb->itemppn as $item)
                                    <tr>
                                        <td>{{ $item->item }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->kategori }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <ul style="font-size: 18">
                                <li>- {{ $item->item }}</li>
                            </ul> --}}
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach ($datapo as $item_po)
            <div class="modal fade" id="modalItemVendor{{ $item_po->id }}" tabindex="-1" aria-hidden="true">
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

                                    @foreach ($item_po->itempo as $item)
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
                    <h3>Purchase Order Out</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Purchase Order Out</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- History  --}}
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
                            <form action="{{ route('menu-purchase-order.SearchPOOut') }}" method="get" class="input-group" >
                                <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-primary">
                                    <tr >
                                        <th>No</th>
                                        <th>No.Pengajuan</th>
                                        <th>Name</th>
                                        <th>Item</th>
                                        <th style="white-space: nowrap; text-align:center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    // $i = 1 ;
                                    $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                @endphp
                                <tbody>
                                    @foreach ($datappb as $ppb)
                                        @if (
                                        $ppb->status == 'Cross Check PO' ||
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            <tr style="background-color:#F1F6F5;">
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $ppb->code_pengajuan }}</td>
                                                <td>
                                                    <ul>
                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                        <li><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" style="word-break: break-word;">{{ $ppb->desc }}</a></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li style="margin-top:4px; white-space:nowrap;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                    </ul>

                                                </td>
                                                {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}
                                                <td style="text-align: center;">
                                                    <ul>
                                                        <li>
                                                            <a class="badge" style="text-align: center; font-size:10; color: white; background-color:rgb(0, 121, 6);">{{ $ppb->status }}</a>
                                                        </li>
                                                        <li style="text-align: center;">
                                                            {{-- @foreach ($comments as $c) --}}
                                                                <a style="font-style: italic; font-size:10; " href="{{ route('menu-purchase-order.detail',$ppb->id) }}/#comment">
                                                                - {{ $ppb->comment->count() }} Comments
                                                                </a>
                                                            {{-- @endforeach --}}
                                                        </li>
                                                    </ul>
                                                </td>
                                                @hasrole('purchasing|super admin')
                                                    <td style="text-align: center; white-space:nowrap;">

                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #B1D0E0; font-size:10;"
                                                        href="{{ url('/exportpdf/po/' . $ppb->id) }}" target="_blank"><i
                                                            class="icon-eye" title="Preview Purchase Order"></i>
                                                    </a>
                                                        @if ($ppb->status == 'Purchase Proses')
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #008000; font-size:10;"
                                                                href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                    class="icon-file" title="Record Data"></i>
                                                            </a>
                                                        @endif

                                                        <button class="btn btn-iconsolid mt-1"
                                                        style="background-color: #ff0000; font-size:10;"
                                                         data-bs-toggle="modal"
                                                            data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                class="icon-trash" title="Delete"></i>
                                                        </button>

                                                    </td>
                                                @endhasrole
                                            </tr>
                                            <tbody>
                                                @foreach ($ppb->quot as $var_po)
                                                <tr>

                                                    @php
                                                        // $po2 = \App\Models\CategoryPO::find('')->groupBy('ppb_id')->get();
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$var_po->id)->groupBy('po_id')->get();
                                                        // $item = $po3->count();
                                                        // dd($var_po);
                                                    @endphp

                                                    @if(empty($var_po))

                                                    @else
                                                    <td style="text-align: center">-</td>
                                                    <td>{{ $var_po->code_po }}</td>
                                                    <td>
                                                        @if($var_po->vendorable_id == 0)
                                                        Vendor : -
                                                        @else
                                                        Vendor : {{ $var_po->vendorable->nama }}
                                                        @endif
                                                    </td>
                                                    <td style="font-weight: 700; white-space:nowrap;">
                                                        @foreach ($po3 as $ipo)
                                                        <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $var_po->id }}">{{ $ipo->qty }} Item</label>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $var_po->quotation }}</td>
                                                    <td colspan="2"  class="text-center"><a
                                                        class="badge  mt-1"
                                                        style=" color: white; background-color: #008000; font-size:10;">{{ $var_po->status }}</a></td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        @endif
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
    {{-- multiple pagination --}}

</section>

@endsection
