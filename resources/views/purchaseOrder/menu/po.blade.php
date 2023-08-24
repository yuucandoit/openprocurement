<title>Detail Purchase Order</title>

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
                            <li class="breadcrumb-item"><a href="{{ url('/menu-purchase-order/') }}">Purchase Order</a></li>
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
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        @foreach ($datapo as $po)
                                            <tr>
                                                <td>Code PO</td>
                                                <td>{{ $datacpo->code_po }}</td>
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
                                                <td style="text-align:right;">
                                                {{ $item->matauang }}{{ number_format($item->unit_price) }}
                                                </td>
                                                <td style="text-align:right;">
                                                {{ $item->matauang }}{{ number_format($item->total) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item->matauang }} {{ number_format($item_po->dpp) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item->matauang }} {{ number_format($item_po->discount) }}
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
                                        <td style="text-align:right;">
                                            @if ($item_po->ppn == 1)
                                                {{ $item->matauang }} {{ number_format($item_po->ppn) }}
                                            @else
                                                {{ $item->matauang }} 0
                                            @endif
                                        </td>
                                    </tr>
                                       <tr>
                                        <td><label class="pull-right mx-2"> Shipping & Protection Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item->matauang }} {{ number_format($item_po->ongkir) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Admin Or Service Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item->matauang }} {{ number_format($item_po->admin_fee) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                        <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item_po->grand_total) }}</td>
                                    </tr>

                                </table>
                                @endif
                                <div class="mt-4">
                                    <a href="{{ url()->previous() }}" class="btn "
                                        style=" color:white; background-color:black">Back</a>
                                    <a href="{{ url('/exportpdf/po_id/' . $po->id) }}" class="btn btn-danger">Export PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
