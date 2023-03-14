<title>Delivery</title>

@extends('layouts.master')

@section('main')
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
    <section>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('/menu-purchase-order/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-2" id="floatingName"
                                        placeholder="Your Name" name="name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingAddress"
                                        placeholder="Address" name="address">
                                    <label for="floatingAddress">Address</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

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

        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Delivery Process Out</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Delivery Process Out</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('delivery.SearchDeliveryOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover display">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Code PR/PO</th>
                                            <th style="white-space: nowrap;">Applicant Name</th>
                                            <th>Item</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $approvedPPB = [];
                                        $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Delivery Success')
                                                @php $approvedPPB[] =$ppb; @endphp
                                                <tr style="background-color:#F1F6F5;">
                                                    <td style="text-align: center;">{{ $i++ }}</td>
                                                    <td>{{ $ppb->code_pengajuan }}</td>
                                                    <td>
                                                        <ul>
                                                            <a href="{{ url('/delivery/detail/' . $ppb->id) }}">
                                                                <li><strong>{{ Carbon\Carbon::parse($ppb->date_ps)->format('d-m-Y') }}</strong></li>
                                                                <li>{{ $ppb->whosubmit->name }}</li>
                                                            </a>
                                                        </ul>
                                                        <td>
                                                            <ul>
                                                                <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                            </ul>
                                                        </td>
                                                    </td>
                                                    <td style="text-align: center">
                                                        @if($ppb->status == 'Delivery Success')
                                                        <a class="badge bg-success mt-1" style="color: white; font-size:12">Request Completed</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @foreach ($ppb->quot as $po)
                                                        <tr>

                                                            @php
                                                                $po2 = \App\Models\CategoryPO::with('vendorable')->find($po->id);
                                                                $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                                $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                            @endphp

                                                            @if(empty($po))

                                                            @else
                                                            <td style="text-align: center">-</td>
                                                            <td>
                                                                <a href="{{ route('delivery.po_detail',$po->id) }}">
                                                                {{ $po->code_po }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <ul>
                                                                    <a href="{{ route('delivery.po_detail',$po->id) }}">
                                                                        <li style="white-space: nowrap;">
                                                                            @if($po2->vendorable_id == 0)
                                                                            Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                            @else
                                                                            Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
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
                                                            <td  class="text-center"><a
                                                                class="badge {{ $ppb->status == '' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:12">{{ $po->status }}</a></td>

                                                            @endif
                                                        </tr>
                                                    @endforeach
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
                    <!-- Container-fluid Ends -->
                </div>
            </div>
        </div>
    </section>
@endsection
