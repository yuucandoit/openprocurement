<title>Detail Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details PO</h3>
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
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details {{ $datacpo->ppb->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        @foreach ($datapo as $po)
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
                                                <td>Date Send</td>
                                                <td>{{ $po->ppb->dateline }}</td>
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
                                                    <td>{{ $po->vendorable->nama }}</td>
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

                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Category</th>
                                            <th>File</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @if (empty($po->items->item))
                                            @foreach ($pengajuan as $q)
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td style="text-align: center;">{{ $q->item }}</td>
                                                    <td style="text-align: center;">{{ $q->qty }}</td>
                                                    <td style="text-align: center;">{{ $q->kategori }}</td>
                                                    @if (empty($q->path_file))
                                                        <td></td>
                                                    @else
                                                        <td style="text-align: center;"><a
                                                                href="/upload_pengajuan/{{ $q->path_file }}"
                                                                class="btn btn-danger" target="_blank">See File</a></td>
                                                    @endif
                                                    @if ($po->ppb->matauang == 'RP')
                                                        <td style="text-align:right;">RP.
                                                            {{ number_format($q->unit_price) }}
                                                        </td>
                                                        <td style="text-align:right;">RP. {{ number_format($q->total) }}
                                                        </td>
                                                    @elseif ($po->ppb->matauang == 'USD')
                                                        <td style="text-align:right;">$ {{ number_format($q->unit_price) }}
                                                        </td>
                                                        <td style="text-align:right;">$ {{ number_format($q->total) }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <table class="table table-bordered ">
                                                <tr>
                                                    <td><label class="pull-right mx-2"> DPP :</label></td>
                                                    <td style="text-align: right;">
                                                        @foreach ($dpp as $d)
                                                            {{-- Ketika mata uang yang dipilih RP --}}
                                                            @if ($po->ppb->matauang == 'RP')
                                                                RP. {{ number_format($d->total) }}
                                                                {{-- Ketika mata uang yang dipilih USD --}}
                                                            @elseif ($po->ppb->matauang == 'USD')
                                                                $ {{ number_format($d->total) }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                            value="{{ $po->ppb->ppn }}"
                                                            @if ($po->ppb->ppn == 1) @checked(true)
                                                        @else @endif
                                                            disabled="true"><label class="pull-right mx-2"> PPN 11%
                                                            :</label></td>

                                                    <td style="text-align:right;">
                                                        @if ($po->ppb->ppn == 1)
                                                            @foreach ($ppn as $pn)
                                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                                @if ($po->ppb->matauang == 'RP')
                                                                    RP. {{ number_format($pn->total) }}
                                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                                @elseif ($po->ppb->matauang == 'USD')
                                                                    $ {{ number_format($pn->total) }}
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            {{-- Ketika mata uang yang dipilih RP --}}
                                                            @if ($po->ppb->matauang == 'RP')
                                                                RP. 0
                                                                {{-- Ketika mata uang yang dipilih USD --}}
                                                            @elseif ($po->ppb->matauang == 'USD')
                                                                $ 0
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if ($po->ppb->ppn == 1)
                                                    <tr>
                                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                        {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                        @foreach ($total as $t)
                                                            @if ($po->ppb->matauang == 'RP')
                                                                <td style="text-align:right;">RP.
                                                                    {{ number_format($t->total) }}</td>

                                                                {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                            @elseif ($po->ppb->matauang == 'USD')
                                                                <td style="text-align:right;">$
                                                                    {{ number_format($t->total) }}</td>
                                                            @endif
                                                        @endforeach
                                                    @elseif ($po->ppb->ppn == 0)
                                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                        @foreach ($total_tnpa_ppn as $tpn)
                                                            @if ($po->ppb->matauang == 'RP')
                                                                <td style="text-align:right;">RP.
                                                                    {{ number_format($tpn->total) }}</td>
                                                            @elseif ($po->ppb->matauang == 'USD')
                                                                <td style="text-align:right;">$
                                                                    {{ number_format($tpn->total) }}</td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endif
                                            </table>
                                        @else
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td style="text-align: center;">{{ $po->items->item }}</td>
                                                <td style="text-align: center;">{{ $po->items->qty }}</td>
                                                <td style="text-align: center;">{{ $po->items->kategori }}</td>
                                                @if (empty($po->items->path_file))
                                                    <td></td>
                                                @else
                                                    <td style="text-align: center;"><a
                                                            href="/upload_pengajuan/{{ $po->items->path_file }}"
                                                            class="btn btn-danger" target="_blank">See File</a></td>
                                                @endif
                                                @if ($po->ppb->matauang == 'RP')
                                                    <td style="text-align:right;">RP.
                                                        {{ number_format($po->items->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">RP.
                                                        {{ number_format($po->items->total) }}</td>
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    <td style="text-align:right;">$
                                                        {{ number_format($po->items->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">$ {{ number_format($po->items->total) }}
                                                    </td>
                                                @endif
                                            </tr>

                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            {{-- Ketika mata uang yang dipilih RP --}}
                                            @if ($po->ppb->matauang == 'RP')
                                                RP. {{ number_format($po->items->total) }}
                                                {{-- Ketika mata uang yang dipilih USD --}}
                                            @elseif ($po->ppb->matauang == 'USD')
                                                $ {{ number_format($po->items->total) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>

                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $po->ppb->ppn }}"
                                                @if ($po->ppb->ppn == 1) @checked(true)
                                                @else @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        @php
                                            $ppn = ($po->items->total * 11) / 100;
                                        @endphp
                                        <td style="text-align:right;">
                                            @if ($po->ppb->ppn == 1)
                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                @if ($po->ppb->matauang == 'RP')
                                                    RP. {{ number_format($ppn) }}
                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    $ {{ number_format($ppn) }}
                                                @endif
                                            @else
                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                @if ($po->ppb->matauang == 'RP')
                                                    RP. 0
                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                @elseif ($po->ppb->matauang == 'USD')
                                                    $ 0
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $ppn = ($po->items->total * 11) / 100;
                                        $grand_total = $ppn + $po->items->total;
                                    @endphp
                                    @if ($po->ppb->ppn == 1)
                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                            @if ($po->ppb->matauang == 'RP')
                                                <td style="text-align:right;">RP. {{ number_format($grand_total) }}</td>

                                                {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                            @elseif ($po->ppb->matauang == 'USD')
                                                <td style="text-align:right;">$ {{ number_format($grand_total) }}</td>
                                            @endif
                                        @elseif ($po->ppb->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @if ($po->ppb->matauang == 'RP')
                                                <td style="text-align:right;">RP. {{ number_format($po->items->total) }}
                                                </td>
                                            @elseif ($po->ppb->matauang == 'USD')
                                                <td style="text-align:right;">$ {{ number_format($po->items->total) }}</td>
                                            @endif
                                        </tr>
                                    @endif
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
