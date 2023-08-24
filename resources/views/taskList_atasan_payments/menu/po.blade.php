<title>Detail Pages</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details PO {{ $datacpo->code_po }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-purchase-order/') }}">Detail PO</a></li>
                            <li class="breadcrumb-item active">Details PO</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details {{ $datacpo->ppb->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        @foreach ($datapo as $po)
                                            <tr>
                                                <td>Code PO</td>
                                                <td>{{ $po->code_po }}</td>
                                            </tr>
                                            <tr>
                                                <td>Who Submitted</td>
                                                <td>{{ $po->ppb->whosubmit->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>{{ $po->ppb->date_ps }}</td>
                                            </tr>
                                            <tr>
                                                <td>Department</td>
                                                <td>{{ $po->ppb->dps->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $po->ppb->desc }}</td>
                                            </tr>
                                            <tr>
                                                <td>Purpose</td>
                                                <td>{{ $po->ppb->purpose->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Send To</td>
                                                <td>{{ $po->ppb->send_to }}</td>
                                            </tr>
                                            <tr>
                                                <td>Deadline</td>
                                                <td>
                                                    @if($po->ppb->dateline == '≤24Jam')
                                                    <strong><p>1 Hari</p></strong>
                                                    @elseif ($po->ppb->dateline == '≤72Jam')
                                                    <strong><p>2 sd 3 Hari</p></strong>
                                                    @elseif ($po->ppb->dateline == '≤168Jam')
                                                    <strong><p>4 sd 7 Hari</p></strong>
                                                    @elseif ($po->ppb->dateline == '≤336Jam')
                                                    <strong><p>7 sd 14 Hari</p></strong>
                                                    @endif
                                                    {{-- {{ $po->ppb->dateline }} --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Quotation</td>
                                                <td>{{ $po->quotation }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Vendor</td>
                                                @if (empty($po->vendorable_type))
                                                    Belum Diisi Datanya
                                                @else
                                                    <td>{{ $po->vendorable->nama ?? '-' }}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Approver Note</td>
                                                <td>
                                                    @if (empty($po->ppb->note_bod_pr))
                                                        -
                                                    @else
                                                        {{ $po->ppb->note_bod_pr }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approve To</td>
                                                <td>
                                                    @if (empty($po->ppb->atasans->name))
                                                        -
                                                    @else
                                                        {{ $po->ppb->atasans->name }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @php
                                   $item_po = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->first();
                                @endphp

                                @if(empty($item_po))
                                <table class="table table-bordered mt-4 mb-4 order-entry">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Category</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan as $p)
                                            <tr>
                                                <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($p->unit_price) }}</td>
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($p->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            @foreach ($dpp as $d)
                                                {{ $po->ppb->matauang }} {{ number_format($d->total) }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            @if($disc == null)
                                            0
                                            @else
                                                {{ $po->ppb->matauang }} {{ number_format($disc->discount) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $po->ppb->ppn }}"
                                                @if ($po->ppb->ppn == 1) @checked(true)
                                            @else
                                        @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        <td style="text-align:right;">
                                            @if ($po->ppb->ppn == 1)
                                                @foreach ($ppn as $p)
                                                        {{ $po->ppb->matauang }} {{ number_format($p->total) }}
                                                @endforeach
                                            @else
                                                @foreach ($ppn as $p)
                                                        {{ $po->ppb->matauang }} 0
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($po->ppb->ppn == 1)
                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total as $t)
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($t->total) }}</td>
                                            @endforeach
                                    @elseif ($po->ppb->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($tpn->total) }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                </table>
                                @else
                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Category</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($po->itempo as $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td style="text-align: center;">{{ $item->item }}</td>
                                                <td style="text-align: center;">{{ $item->qty }}</td>
                                                <td style="text-align: center;">{{ $item->kategori }}</td>
                                                <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item->unit_price) }}</td>
                                                <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->dpp) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">=
                                            {{ $item_po->matauang }} {{ number_format($item_po->discount) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $item_po->ppn }}"
                                                @if ($item_po->ppn == 1) @checked(true)
                                                @else @endif
                                                disabled="true">
                                            <label class="pull-right mx-2"> PPN 11% :</label>
                                        </td>
                                        @php
                                            $dpp = $item_po->dpp;
                                            $disc = $item_po->discount;
                                            $afterdisc = $dpp - $disc;
                                            $ppn = $afterdisc *11 /100;
                                        @endphp
                                        <td style="text-align:right;">
                                            @if ($item_po->ppn == 1)
                                                {{ $item_po->matauang }} {{ number_format($ppn) }}
                                            @else
                                                {{ $item_po->matauang }} 0
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Shipping & Protection Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->ongkir) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Admin Or Service Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->admin_fee) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                        <td style="text-align:right;">{{ $item_po->matauang }} {{ number_format($item_po->grand_total) }}</td>
                                    </tr>

                                </table>

                                @endif
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                    @hasrole('super user|super admin')
                                        @if ($datacpo->status == 'Payment Approved' ||
                                        $datacpo->status == 'Unpaid' ||
                                        $datacpo->status == 'Paid' ||
                                        $datacpo->status == 'Delivery Process' ||
                                        $datacpo->status == 'Delivery Success')
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return">Reject</a>
                                        @elseif($datacpo->status == 'Invoicing Process')
                                        <button type="button" class="btn btn-success text-center" data-bs-toggle="modal" data-bs-target="#approve"> Approve</button>
                                        <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                        @else
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return">Aprove</a>
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                        @endif
                                    @endhasrole
                                    </div>
                                    <div class="col-md-6 mt-3" style="text-align: right;">
                                        <a href="{{ url()->previous() }}" class="btn "
                                            style=" color:white; background-color:black">Back</a>
                                        <a href="{{ url('/exportpdf/po_id/' . $po->id) }}" class="btn btn-danger">Export PDF</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Modal -->
             <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="rejectLabel">Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('menu-taskList-atasan-payment/reject', $datacpo->id) }}" id="formAdd" method="get"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="note" class="form-label">Reject Message</label>
                            <textarea name="note_py" id="note" class="form-control" cols="30" rows="0" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="approve" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approveLabel">Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('menu-taskList-atasan-payment/approve_payment_py', $datacpo->id) }}" method="get">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="note" class="form-label">Approve Message</label>
                            <textarea name="note_py" id="note" class="form-control" cols="30" rows="0"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
    </section>
@endsection
