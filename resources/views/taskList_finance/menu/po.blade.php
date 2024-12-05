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
                                        <tr>
                                            <td>Code PO</td>
                                            <td>{{ $datacpo->code_po }}</td>
                                        </tr>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $datacpo->ppb->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $datacpo->ppb->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $datacpo->ppb->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $datacpo->ppb->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{ $datacpo->ppb->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $datacpo->ppb->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>
                                                @if($datacpo->ppb->dateline == '≤24Jam')
                                                <strong><p>1 Hari</p></strong>
                                                @elseif ($datacpo->ppb->dateline == '≤72Jam')
                                                <strong><p>2 sd 3 Hari</p></strong>
                                                @elseif ($datacpo->ppb->dateline == '≤168Jam')
                                                <strong><p>4 sd 7 Hari</p></strong>
                                                @elseif ($datacpo->ppb->dateline == '≤336Jam')
                                                <strong><p>7 sd 14 Hari</p></strong>
                                                @endif
                                                {{-- {{ $datacpo->ppb->dateline }} --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>{{ $datacpo->quotation }}</td>
                                        </tr>
                                        <tr>
                                            <td>File Invoice</td>
                                            <td>
                                                @if (empty($datacpo->path_quotation))
                                                    -
                                                @else
                                                    <a href="/upload_quotation/{!! nl2br($datacpo->path_quotation) !!}" target="_blank" style="color: rgb(138, 43, 226); text-decoration:underline;">{!! nl2br($datacpo->path_quotation) !!}</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Vendor</td>
                                            <td>
                                            @if (empty($datacpo->vendorable_type))
                                                Null
                                            @else

                                                @if(empty($datacpo->vendorable->nama))
                                                -
                                                @else
                                                {{ $datacpo->vendorable->nama ?? '-' }}
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if (empty($datacpo->ppb->note_bod_pr))
                                                    -
                                                @else
                                                    {{ $datacpo->ppb->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                        @if($datacpo->payment_type == 'Bank')
                                        <tr>
                                            <td>Rekening </td>
                                            <td>
                                                @if (empty($datacpo->vendorRek))
                                                    {{ $datacpo->no_rekening ?? '-' }}
                                                @else
                                                    {{ $datacpo->vendorRek->no_rekening ?? '-' }} {{ $datacpo->vendorRek->rel_bank->name ?? '' }}  "{{ $datacpo->vendorRek->nama_penerima ?? '-' }}"
                                                @endif
                                            </td>
                                        </tr>

                                        @elseif($datacpo->payment_type == 'Va')
                                        <tr>
                                            <td>Virtual Account </td>
                                            <td>
                                                @if (!empty($datacpo->va_code))
                                                    {{ $datacpo->va_code }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @php
                                   $item_po = \App\Models\ItemPO::where('po_id',$datacpo->id)->groupBy('po_id')->first();
                                @endphp

                                @if(empty($item_po))
                                <table class="table table-bordered mt-4 mb-4 order-entry">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>UOM</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                @if ($po->ppb->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($p->unit_price /100 ,2) }}
                                                    </td>
                                                    <td style="text-align:right;">$ {{ number_format($p->total /100 ,2) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            @foreach ($dpp as $d)

                                                @if ($po->ppb->matauang == 'RP')
                                                    RP. {{ number_format($d->total) }}
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    $ {{ number_format($d->total /100 ,2) }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            @if($disc == null)
                                            0
                                            @else
                                                @if ($po->ppb->matauang == 'RP')
                                                    RP. {{ number_format($disc->discount) }}
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    $ {{ number_format($disc->discount /100 ,2) }}
                                                @endif
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
                                                    @if ($po->ppb->matauang == 'RP')
                                                        RP. {{ number_format($p->total) }}
                                                    @elseif ($po->ppb->matauang == 'USD')
                                                        $ {{ number_format($p->total /100 ,2) }}
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($ppn as $p)
                                                    @if ($po->ppb->matauang == 'RP')
                                                        RP. 0
                                                    @elseif ($po->ppb->matauang == 'USD')
                                                        $ 0
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($po->ppb->ppn == 1)
                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                            @foreach ($total as $t)
                                                @if ($po->ppb->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                @elseif ($po->ppb->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                @endif
                                            @endforeach
                                        @elseif ($po->ppb->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                @if ($po->ppb->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($tpn->total /100 ,2) }}</td>
                                                @endif
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
                                            <th>UOM</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($datacpo->itempo as $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td style="text-align: center;">{{ $item->item }}</td>
                                                <td style="text-align: center;">{{ $item->qty }}</td>
                                                <td style="text-align: center;">{{ $item->kategori }}</td>
                                                @if ($item->matauang == 'RP')
                                                    <td style="text-align:right;">RP.
                                                        {{ number_format($item->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">RP.
                                                        {{ number_format($item->total) }}</td>
                                                @elseif ($item->matauang == 'USD')
                                                    <td style="text-align:right;">$
                                                        {{ number_format($item->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">$ {{ number_format($item->total) }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            {{-- Ketika mata uang yang dipilih RP --}}
                                            @if ($item_po->matauang == 'RP')
                                                RP. {{ number_format($item_po->dpp) }}
                                                {{-- Ketika mata uang yang dipilih USD --}}
                                            @elseif ($item_po->matauang == 'USD')
                                                $ {{ number_format($item_po->dpp) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            {{-- Ketika mata uang yang dipilih RP --}}
                                            @if ($item_po->matauang == 'RP')
                                                RP. {{ number_format($item_po->discount) }}
                                                {{-- Ketika mata uang yang dipilih USD --}}
                                            @elseif ($item_po->matauang == 'USD')
                                                $ {{ number_format($item_po->discount) }}
                                            @endif
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
                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                @if ($item_po->matauang == 'RP')
                                                    RP. {{ number_format($ppn) }}
                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                @elseif ($item_po->matauang == 'USD')
                                                    $ {{ number_format($ppn) }}
                                                @endif
                                            @else
                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                @if ($item_po->matauang == 'RP')
                                                    RP. 0
                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                @elseif ($item_po->matauang == 'USD')
                                                    $ 0
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Shipping & Protection Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{-- Ketika mata uang yang dipilih RP --}}
                                            @if ($item_po->matauang == 'RP')
                                                RP. {{ number_format($item_po->ongkir) }}
                                                {{-- Ketika mata uang yang dipilih USD --}}
                                            @elseif ($item_po->matauang == 'USD')
                                                $ {{ number_format($item_po->ongkir) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Admin Or Service Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{-- Ketika mata uang yang dipilih RP --}}
                                            @if ($item_po->matauang == 'RP')
                                                RP. {{ number_format($item_po->admin_fee) }}
                                                {{-- Ketika mata uang yang dipilih USD --}}
                                            @elseif ($item_po->matauang == 'USD')
                                                $ {{ number_format($item_po->admin_fee) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                            @if ($item_po->matauang == 'RP')
                                                <td style="text-align:right;">RP. {{ number_format($item_po->grand_total) }}</td>

                                                {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                            @elseif ($item_po->matauang == 'USD')
                                                <td style="text-align:right;">$ {{ number_format($item_po->grand_total) }}</td>
                                            @endif
                                    </tr>

                                </table>

                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-3" style="text-align: center;">
                                            @hasrole('finance|super admin|super purchase')
                                            <form action="{{ url('menu-tasklist-finance/approve_tpy', $datacpo->id) }}" method="POST">
                                                @csrf
                                                {{-- <a href="{{ url()->previous() }}" class="btn" style=" color:white; background-color:black">Back</a>     --}}
                                                @if ($datacpo->status == 'Unpaid' ||
                                                $datacpo->status == 'Paid' ||
                                                $datacpo->status == 'Delivery Process' ||
                                                $datacpo->status == 'Delivery Success')
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-danger text-center" onclick="return">Reject</a>
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                                @elseif($datacpo->status == 'Payment Approved' || $datacpo->status == 'PO & Payment Approved')
                                                <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                                <button type="submit" class="btn btn-success text-center"> Process</button>
                                                @else
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-success text-center" onclick="return">Process</a>
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                                @endif
                                            </form>
                                            @endhasrole
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6"> --}}
                                        {{-- <div class="mt-3" style="text-align: right;"> --}}

                                            {{-- <a href="{{ url('/exportpdf/po_id/' . $po->id) }}" class="btn btn-danger">Export PDF</a> --}}
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>
                                    <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="rejectLabel">Reject Message</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ url('menu-tasklist-finance/reject_tpy', $datacpo->id) }}" id="formAdd" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <textarea name="notes" id="" cols="30" rows="10" class="form-control"></textarea>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Reject</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
