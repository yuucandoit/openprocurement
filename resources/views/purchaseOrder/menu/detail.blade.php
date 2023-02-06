<title>Detail Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-purchase-order/') }}">Purchase Order</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div> --}}
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details {{ $data_pengajuan->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $data_pengajuan->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $data_pengajuan->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $data_pengajuan->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $data_pengajuan->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{ $data_pengajuan->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $data_pengajuan->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Send</td>
                                            <td>{{ $data_pengajuan->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if (empty($data_pengajuan->note_bod_pr))
                                                    -
                                                @else
                                                    {{ $data_pengajuan->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Approve To</td>
                                            <td>
                                                @if (empty($data_pengajuan->atasans->name))
                                                    -
                                                @else
                                                    {{ $data_pengajuan->atasans->name }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="card">
                                        @if (empty($vendor->vendorable->nama))
                                        <table class="table table-bordered mt-4 mb-4 order-entry">
                                            <thead>
                                                <tr class="text-center"
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Category</th>
                                                    <th>File</th>
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
                                                        @if(empty($p->path_file))
                                                        <td style="text-align: center;"> - </td>
                                                        @else
                                                        <td style="text-align: center;"> <a href="{{ $p->path_file }}" class="btn btn-danger">See File</a></td>
                                                        @endif
                                                        <td style="text-align: center;"></td>
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                            <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                            </td>
                                                            <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                        @elseif ($data_pengajuan->matauang == 'USD')
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
                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                            RP. {{ number_format($d->total) }}
                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            $ {{ number_format($d->total     /100 ,2) }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right mx-2"> Discount :</label></td>
                                                <td style="text-align: right;">
                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                            RP. {{ number_format($disc->discount) }}
                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            $ {{ number_format($disc->discount /100 ,2) }}
                                                        @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                        value="{{ $data_pengajuan->ppn }}"
                                                        @if ($data_pengajuan->ppn == 1) @checked(true)
                                                    @else
                                                @endif
                                                        disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                                <td style="text-align:right;">
                                                    @if ($data_pengajuan->ppn == 1)
                                                        @foreach ($ppn as $p)
                                                        @if(empty($disc->discount))
                                                         {{-- Ketika mata uang yang dipilih RP --}}
                                                         @if ($data_pengajuan->matauang == 'RP')
                                                         RP. {{ number_format($p->total) }}
                                                         {{-- Ketika mata uang yang dipilih USD --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            $ {{ number_format($p->total /100 ,2) }}
                                                        @endif

                                                        @else
                                                        @php
                                                            $ppndisc = $p->total - $disc->discount;
                                                        @endphp
                                                         {{-- Ketika mata uang yang dipilih RP --}}
                                                         @if ($data_pengajuan->matauang == 'RP')
                                                         RP. {{ number_format($ppndisc) }}
                                                         {{-- Ketika mata uang yang dipilih USD --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            $ {{ number_format($ppndisc /100 ,2) }}
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($ppn as $p)
                                                            {{-- Ketika mata uang yang dipilih RP --}}
                                                            @if ($data_pengajuan->matauang == 'RP')
                                                                RP. 0
                                                                {{-- Ketika mata uang yang dipilih USD --}}
                                                            @elseif ($data_pengajuan->matauang == 'USD')
                                                                $ 0
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($data_pengajuan->ppn == 1)
                                                <tr>
                                                    <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                                    @foreach ($total as $t)
                                                    @if(empty($disc->discount))
                                                     {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                     <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>
                                                     {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                    @endif

                                                    @else
                                                        @php
                                                            $totalwithdisc = $t->total - $disc->discount;
                                                        @endphp
                                                        {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                            <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                            {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                        @endif

                                                    @endif
                                                    @endforeach
                                                @elseif ($data_pengajuan->ppn == 0)
                                                    <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                    @foreach ($total_tnpa_ppn as $tpn)
                                                    @if(empty($disc->discount))
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                        <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            <td style="text-align:right;">$ {{ number_format($tpn->total /100 ,2) }}</td>
                                                        @endif

                                                    @else
                                                    @php
                                                    $tpnwithdisc = $tpn->total - $disc->discount;
                                                    @endphp
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                        <td style="text-align:right;">RP. {{ number_format($tpnwithdisc) }}</td>
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            <td style="text-align:right;">$ {{ number_format($tpnwithdisc /100 ,2) }}</td>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                </tr>
                                            @endif
                                        </table>
                                        <div class="card-body">
                                            <h6 class="text-center">PO Not Found</h6>
                                        </div>
                                        @else
                                        @foreach ($items as $po)
                                          <div class="card-body">
                                            <div class="default-according" id="accordionclose{{ $po->id }}">

                                              <div class="card">
                                                <div class="card-header" id="heading{{ $po->id }}">
                                                  <h5 class="mb-0">
                                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1">Vendor #<span>{{ $po->vendorable->nama }}</span></button>
                                                  </h5>
                                                </div>
                                                <div class="collapse" id="collapse{{ $po->id }}" aria-labelledby="heading{{ $po->id }}" data-bs-parent="#accordionclose{{ $po->id }}">
                                                  <div class="card-body">
                                                    <div class="row">
                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        Vendor &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                        &nbsp; &nbsp;:
                                                                        @if (empty($po->vendorable->nama))
                                                                        @else
                                                                            {{ $po->vendorable->nama }}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        Quotation &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :
                                                                        @if (empty($po->quotation))
                                                                        @else
                                                                            {{ $po->quotation }}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        Terms conditions :
                                                                        @if (empty($po->term->term_condition))
                                                                        @else
                                                                            <br>
                                                                            {!! nl2br($po->term->term_condition) !!}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        File :
                                                                        @if (empty($po->path_quotation))
                                                                            -
                                                                        @else
                                                                            <br>
                                                                            {!! nl2br($po->path_quotation) !!}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    </div>

                                                     @if(empty($vendor->item))
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
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                                        </td>
                                                                        <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
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
                                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        RP. {{ number_format($d->total) }}
                                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        $ {{ number_format($d->total /100 ,2) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="pull-right mx-2"> Discount :</label></td>
                                                            <td style="text-align: right;">
                                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        RP. {{ number_format($disc->discount) }}
                                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        $ {{ number_format($disc->discount /100 ,2) }}
                                                                    @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                                    value="{{ $data_pengajuan->ppn }}"
                                                                    @if ($data_pengajuan->ppn == 1) @checked(true)
                                                                @else
                                                            @endif
                                                                    disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                                            <td style="text-align:right;">
                                                                @if ($data_pengajuan->ppn == 1)
                                                                    @foreach ($ppn as $p)
                                                                    @if(empty($disc->discount))
                                                                     {{-- Ketika mata uang yang dipilih RP --}}
                                                                     @if ($data_pengajuan->matauang == 'RP')
                                                                     RP. {{ number_format($p->total) }}
                                                                     {{-- Ketika mata uang yang dipilih USD --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        $ {{ number_format($p->total /100 ,2) }}
                                                                    @endif

                                                                    @else
                                                                    @php
                                                                        $ppndisc = $p->total - $disc->discount;
                                                                    @endphp
                                                                     {{-- Ketika mata uang yang dipilih RP --}}
                                                                     @if ($data_pengajuan->matauang == 'RP')
                                                                     RP. {{ number_format($ppndisc) }}
                                                                     {{-- Ketika mata uang yang dipilih USD --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        $ {{ number_format($ppndisc /100 ,2) }}
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                @else
                                                                    @foreach ($ppn as $p)
                                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                                        @if ($data_pengajuan->matauang == 'RP')
                                                                            RP. 0
                                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                                            $ 0
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if ($data_pengajuan->ppn == 1)
                                                            <tr>
                                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                                                @foreach ($total as $t)
                                                                @if(empty($disc->discount))
                                                                 {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                                @if ($data_pengajuan->matauang == 'RP')
                                                                 <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>
                                                                 {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                                    <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                                @endif

                                                                @else
                                                                    @php
                                                                        $totalwithdisc = $t->total - $disc->discount;
                                                                    @endphp
                                                                    {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                                        {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                                    @endif

                                                                @endif
                                                                @endforeach
                                                            @elseif ($data_pengajuan->ppn == 0)
                                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                                @foreach ($total_tnpa_ppn as $tpn)
                                                                @if(empty($disc->discount))
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                    <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        <td style="text-align:right;">$ {{ number_format($tpn->total /100 ,2) }}</td>
                                                                    @endif

                                                                @else
                                                                @php
                                                                $tpnwithdisc = $tpn->total - $disc->discount;
                                                                @endphp
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                    <td style="text-align:right;">RP. {{ number_format($tpnwithdisc) }}</td>
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        <td style="text-align:right;">$ {{ number_format($tpnwithdisc /100 ,2) }}</td>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            </tr>
                                                        @endif
                                                    </table>
                                                    <a class="btn btn-danger mt-3" href="{{ url('/exportpdf/po/' . $data_pengajuan->id) }}"
                                                        target="_blank" style="font-size:12;">Export PDF PO</i>
                                                    </a>
                                                     @else
                                                    {{-- <table class="table table-bordered item order-entry mx-2">
                                                        <tr style="text-align: center;">
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                No</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Item</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Qty</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Category</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Price-per-unit</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Total</th>
                                                        </tr>
                                                        @php
                                                            $id = 1;
                                                        @endphp
                                                        @foreach ($datapo as $i)
                                                            @if ($i->vendorable_id == $po->vendorable_id)
                                                                @if ($i->vendorable_type == $po->vendorable_type)
                                                                <tr>
                                                                    <td class="text-center">{{ $id++ }}</td>
                                                                    <td class="text-center">{{ $i->item }}</td>
                                                                    <td class="text-center">{{ $i->qty }}</td>
                                                                    <td class="text-center">{{ $i->kategori }}</td>
                                                                    @if ($i->matauang == 'RP')
                                                                        <td class="text-end">RP.
                                                                            {{ number_format($i->unit_price) }}</td>
                                                                        <td class="text-end">RP. {{ number_format($i->total) }}
                                                                        </td>
                                                                    @elseif($i->matauang == 'USD')
                                                                        <td class="text-end">$
                                                                            {{ number_format($i->unit_price /100 ,2) }}</td>
                                                                        <td class="text-end">$
                                                                            {{ number_format($i->total /100 ,2) }}</td>
                                                                    @endif
                                                                </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                    <table class="table table-bordered ">
                                                        <tbody>
                                                        @foreach ($items as $calculate)
                                                        @if ($calculate->vendorable_id == $po->vendorable_id)
                                                        @if ($calculate->vendorable_type == $po->vendorable_type)
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> DPP :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->dpp) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->dpp /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> Ongkir :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->ongkir) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->ongkir /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> Discount :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->discount) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->discount /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                                        value="{{ $calculate->ppn }}"
                                                                        @if ($calculate->ppn == 1) @checked(true)
                                                                        @else
                                                                        @endif
                                                                        disabled="true"><label class="pull-right mx-2"> PPN 11%
                                                                        :</label></td>
                                                                <td style="text-align:right;">
                                                                    @if ($calculate->ppn == 1)
                                                                    @php
                                                                        $dpp = $calculate->dpp;
                                                                        $disc = $calculate->discount;
                                                                        $afterdisc = $dpp - $disc;
                                                                        $ppn = $afterdisc *11 /100;
                                                                    @endphp
                                                                        @if ($calculate->matauang == 'RP')
                                                                            RP. {{ number_format($ppn) }}
                                                                        @elseif ($calculate->matauang == 'USD')
                                                                            $ {{ number_format($ppn /100 ,2) }}
                                                                        @endif
                                                                    @else
                                                                        @if ($calculate->matauang == 'RP')
                                                                            RP. 0
                                                                        @elseif ($calculate->matauang == 'USD')
                                                                            $ 0
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                    <td class="text-end" style="font-weight: bold;">Grand Total
                                                                        :</td>
                                                                @if ($calculate->ppn == 1)
                                                                <td style="text-align:right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP.{{ number_format($calculate->grand_total) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        ${{ number_format($calculate->grand_total /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                                @elseif ($calculate->ppn == 0)
                                                                <td style="text-align:right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                    RP.{{ number_format($calculate->grand_total) }}</td>
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                    ${{ number_format($calculate->grand_total /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                                </tr>
                                                            @endif
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table> --}}
                                                    {{-- <a class="btn btn-danger mt-3" href="{{ url('/exportpdf/po_multi/' . $data_pengajuan->id) }}"
                                                        target="_blank" style="font-size:12;">Export PDF PO</i>
                                                    </a>
                                                    <button type="button" name="add" class=" btn btn-warning mt-3"  data-bs-toggle="modal"
                                                    data-bs-target="#modalEditPO{{ $po->item_ppid }}" > Edit
                                                        PO
                                                        <i class="fa fa-plus"></i>
                                                    </button> --}}
                                                    @endif
                                                    {{-- <div class="modal fade" id="modalEditPO{{ $po->item_ppid }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h2 class="modal-title">Edit PO</h2>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="row g-2 mt-4" action="{{ url('/menu-purchase-order/update/' . $data_pengajuan->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="item_ppid" value="{{ $po->item_ppid }}">
                                                                        <div class="col-md-4 ">
                                                                            <div class="form-group">
                                                                                <label class="form-label" style="font-weight: bold;"><i
                                                                                        class="fa fa-database"></i> Select
                                                                                    Vendor</label>
                                                                                <select class="form-select page pageSelectEdit" id="pageSelectEdit"
                                                                                    placeholder="Proposed To" name="vendor">
                                                                                    <option value="" disabled selected hidden>Select
                                                                                        Vendor
                                                                                    </option>
                                                                                    <option value="company">Company</option>
                                                                                    <option value="privateperson">Private Person
                                                                                    </option>
                                                                                    <option value="ecommerce">Ecommerce</option>
                                                                                </select>

                                                                                <select class=" form-select perusahaan_0_edit hide mt-2" id="selectedInput_edit"
                                                                                    name="perusahaan">
                                                                                    @foreach ($pt as $p)
                                                                                    <option value="{{ $p->id }}">{{ $p->nama }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>

                                                                                <select class=" form-select privateperson_0_edit hide" id="selectedInput2_edit"
                                                                                    name="orangpribadi">
                                                                                    @foreach ($op as $o)
                                                                                    <option value="{{ $o->id }}">{{ $o->nama }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>

                                                                                <select class=" form-select ecommerce_0_edit hide" id="selectedInput3_edit"
                                                                                    name="ecommerce">
                                                                                    @foreach ($ec as $e)
                                                                                    <option value="{{ $e->id }}">{{ $e->nama }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 page" style="margin-top: 10px;">
                                                                            <div class="form-group">
                                                                                <label for="floatingQuotation"><i class="fa fa-file-excel-o"></i>
                                                                                    Quotation</label>
                                                                                <div class="form-floating">
                                                                                    <input required type="text" class="form-control" id="floatingQuotation"
                                                                                        placeholder="Quotation" name="quotation" value="{{ $po->quotation }}">
                                                                                    <div class="invalid-feedback"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" style="font-weight: bold;"><i
                                                                                        class="fa fa-file-text-o"></i> Terms &
                                                                                    Conditions</label>
                                                                                <select class="form-select page pageSelectorEdit" id="pageSelectorEdit"
                                                                                    placeholder="Terms and Conditions" name="term_conditions">
                                                                                    <option value="{{ $po->term_conditions }}" selected >
                                                                                        {{ $po->term->term_condition }}
                                                                                    </option>
                                                                                    @foreach ($terms as $t)
                                                                                    <option value="{{ $t->id }}">
                                                                                        {{ $t->term_condition }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                    <option value="custom_edit">+ Add Terms & Conditions
                                                                                    </option>
                                                                                </select>
                                                                                <textarea class="hide form-control customInput_edit" name="term_condition"
                                                                                    cols="30" rows="10"
                                                                                    placeholder="Input Terms And Conditions"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label">
                                                                                    <i class="fa fa-file-pdf-o" style="font-weight: bold;"></i>
                                                                                    Upload Quotation
                                                                                </label>
                                                                                <input type="file" name="path_quotation" class="form-control form-control-lg">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 ">
                                                                            <div class="form-group">
                                                                                <label class="form-label" style="font-weight: bold;"><i
                                                                                        class="icofont icofont-stamp"></i> Send Approval To:</label>
                                                                                <select class="form-select page" id="floatingproposedto"
                                                                                    placeholder="Proposed To" name="atasan_po" required="">
                                                                                    <option selected="" value="{{ $data_pengajuan->atasan_po }}">
                                                                                        {{ $data_pengajuan->atasans->name }}
                                                                                    </option>
                                                                                    @foreach ($atasan as $sui)
                                                                                    <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="form-label" style="font-weight: bold;"><i class="fa fa-money"></i>
                                                                                    Currency :</label>
                                                                                <select class="form-select page" id="floatingdateline" placeholder="Mata Uang"
                                                                                    name="matauang" required="">
                                                                                    <option selected="" value="{{ $po->matauang }}">
                                                                                        {{ $po->matauang }}
                                                                                    </option>
                                                                                    <option value="USD">USD</option>
                                                                                    <option value="RP">RP</option>
                                                                                </select>
                                                                                @error('matauang')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <table class="table table-bordered item order-entry-edit mx-2">
                                                                            <tr style="text-align: center;">
                                                                                <th
                                                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                                    Item</th>
                                                                                <th
                                                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                                    Qty</th>
                                                                                <th
                                                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                                    Category</th>
                                                                                <th
                                                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                                    Price-per-unit</th>
                                                                                <th
                                                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                                    Total</th>
                                                                                <th
                                                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                                    Action</th>
                                                                            </tr>
                                                                            @php
                                                                            $id = 0;
                                                                            $id++;
                                                                            @endphp
                                                                        @foreach ($datapo as $i)
                                                                            @if ($i->vendorable_id == $po->vendorable_id)
                                                                                @if ($i->vendorable_type == $po->vendorable_type)

                                                                            <td class="text">
                                                                                <input type="text" name="id[]" placeholder="Input Item" class="form-control"
                                                                                    style="text-align: center;" value="{{ $i->id }}" hidden />
                                                                                <input type="text" placeholder="Input Item" class="form-control" name="item[]"
                                                                                    style="text-align: center;" value="{{ $i->item }}" />
                                                                            </td>
                                                                            <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                                                    class="form-control form-calc-edit form-qty-edit" style="text-align: center;"
                                                                                    value="{{ $i->qty }}" min="1" max="{{ $i->qty }}" />
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-select " placeholder="Kategori" name="kategori[]"
                                                                                    value="{{ $i->kategori }}">
                                                                                    <option value="{{ $i->kategori }}">
                                                                                        {{ $i->kategori }}</option>
                                                                                    <option value="Pcs">Pcs </option>
                                                                                    <option value="Lusin">Lusin </option>
                                                                                    <option value="Box">Box </option>
                                                                                    <option value="Unit">Unit </option>
                                                                                    <option value="Lot">Lot </option>
                                                                                    <option value="Rim">Rim </option>
                                                                                    <option value="Org">Org </option>
                                                                                    <option value="Line">Line </option>
                                                                                    <option value="Ruang">Ruang </option>
                                                                                    <option value="Pax">Pax </option>
                                                                                    <option value="Set">Set </option>
                                                                                    <option value="Piece">Piece </option>
                                                                                    <option value="Rol">Rol </option>
                                                                                    <option value="Pack">Pack </option>
                                                                                    <option value="Batang">Batang </option>
                                                                                </select>
                                                                            </td>

                                                                            <td>
                                                                                <input type="text" name="unit_price[]" placeholder="Input Price"
                                                                                    class="form-control text-end form-calc-edit form-cost-edit rupiah"
                                                                                    style="text-align: right;" value="{{ $i->unit_price }}" required />
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="total[]" class="form-control form-line-edit"
                                                                                    style="text-align: right;" value="{{ $i->total }}" required />
                                                                            </td>
                                                                            <td style="text-align: center;"><button type="button"
                                                                                    class="btn btn-danger remove-input-field"><i
                                                                                        class="fa fa-times"></i></button></td>

                                                                            </tr>
                                                                            @endif
                                                                            @endif
                                                                            @endforeach
                                                                        </table>

                                                                        <table class="table table-bordered  mx-2" style="margin-top: 0px;">
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="pull-right"
                                                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        DPP :</label>
                                                                                </td>
                                                                                <td>
                                                                                    <input  class="total_A-edit form-control disabled text-end " type="text" name="dpp">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="pull-right"
                                                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        Ongkir :</label>
                                                                                </td>
                                                                                <td>
                                                                                    <input  class="ongkir-edit form-control text-end rupiah" type="text" name="ongkir">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="pull-right"
                                                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        Discount :</label>
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    <input class="form-control discount-edit form-calc-edit rupiah text-end" type="text"
                                                                                        id="discount-edit" name="discount">
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="pull-right"
                                                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                                                        Discount :</label>
                                                                                </td>
                                                                                <td class="total_disc-edit text-end">
                                                                                    <input style="display: none;" class=" total_disc-edit " type="text"
                                                                                        name="total_disc">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <input class="mt-1 pull-right check-box-edit" type="checkbox" name="ppn"
                                                                                        value="1" {{ old('ppn-edit', 0)===1 ? 'checked' : '' }}>
                                                                                    <label class="pull-right" style="font-weight: bold;"> PPN 11%
                                                                                    </label>
                                                                                </td>
                                                                                <td class="ppn-edit text-end">
                                                                                    <input style="display: none;" class="ppn-edit" type="text" name="ppn">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                                                    :</td>
                                                                                <td>
                                                                                    <input class="form-control text-end total-edit"
                                                                                        type="text" name="grand_total">
                                                                                </td>
                                                                            </tr>
                                                                        </table>

                                                                        <div class="form-group" style="text-align:right;">
                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                            <a type="reset" class="btn btn-dark"
                                                                                href="{{ url('/menu-purchase-order/') }}">Back</a>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div> --}}
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          @endforeach
                                        @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <hr>



                                {{-- Start Modal Approval --}}
                                @if ($data_pengajuan->status == 'Waiting For PO Approval')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai" disabled>Approval Request Sent
                                    </button>
                                @elseif ($data_pengajuan->status == 'Purchase Proses')
                                    @if (empty($data_pengajuan->atasans->name))
                                        <div class="text-center">
                                            <button class="btn btn-outline-success mt-2 disabled" data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai">Send Approval Request For Purchase
                                                Order</button>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai">Send Approval Request For Purchase
                                                Order</button>
                                        </div>
                                    @endif
                                @endif


                                <style>
                                    /* textarea {
                                               height: 20px;
                                               width: 100%;
                                               border: none;
                                               border-bottom: 2px solid #aaa;
                                               background-color: transparent;
                                               margin-bottom: 10px;
                                               resize: none;
                                               outline: none;
                                               transition: .5s
                                           } */

                                    .AllComment {
                                        box-sizing: border-box;
                                        border: 2px solid rgb(236, 236, 236);
                                        border-radius: 10px;
                                        padding: 15px 10px;
                                    }
                                </style>

                                <div class="mt-4">
                                    <form action="{{ route('comment.store', $data_pengajuan->id) }}" method="POST">
                                        @csrf
                                        <textarea class="form-control" name="comment" placeholder='Add Your Comment'></textarea>
                                        <div style="text-align: right; margin-top:20px;">
                                            <input type="submit" class="btn btn-primary" value="Comment">
                                            <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="AllComment" id="comment">
                                    <div class="container">
                                        @foreach ($comments as $c)
                                            <ul>
                                                <li>
                                                    <p>
                                                        <strong>
                                                            @if (empty($c->users->name))
                                                            @else
                                                                - {{ $c->users->name }}
                                                            @endif
                                                        </strong>
                                                        @if (empty($c->created_at))
                                                        @else
                                                            &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if (empty($c->comment))
                                                    @else
                                                        <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h2 class="modal-title" style="color: white">Warning</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mx-5 mb-3">
                                                <span class="warning">
                                                    <img src="{{ asset('assets/images/warning.png') }}">
                                                </span>
                                                <h2 style="text-align: center">Make sure the data is correct!</h2>
                                            </div>
                                            {{-- End Modal Approval --}}

                                            <div class="modal-footer">
                                                @if ($data_pengajuan->status == 'Purchase Proses')
                                                    <form class="text-center" style="text-align: center;"
                                                        action="{{ url('menu-purchase-order/ajukan_keatasan/' . $data_pengajuan->id) }}">
                                                        <button type="submit" class="btn btn-outline-danger "><i
                                                                class="bx bx-trash"></i>
                                                            Send Approval Request For Purchase Order
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="modal fade" id="modalCreatePO" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title">Create PO</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-2 mt-4" action="{{ url('/menu-purchase-order/store/' . $data_pengajuan->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @if(empty($id_item->item_ppid))
                                                    <input type="hidden" name="item_ppid" value="1">
                                                    @else
                                                    @php
                                                    $item_id = $id_item->item_ppid;
                                                    $val_id = $item_id + 1;
                                                    @endphp
                                                    <input type="hidden" name="item_ppid" value="{{ $val_id }}">
                                                    @endif

                                                    <div class="col-md-4 ">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i
                                                                    class="fa fa-database"></i> Select
                                                                Vendor</label>
                                                            <select class="form-select page pageSelect" id="pageSelect"
                                                                placeholder="Proposed To" name="vendor">
                                                                <option value="" disabled selected hidden>Select
                                                                    Vendor
                                                                </option>
                                                                <option value="company">Company</option>
                                                                <option value="privateperson">Private Person
                                                                </option>
                                                                <option value="ecommerce">Ecommerce</option>
                                                            </select>

                                                            <select class=" form-select perusahaan_0 hide mt-2" id="selectedInput"
                                                                name="perusahaan">
                                                                @foreach ($pt as $p)
                                                                <option value="{{ $p->id }}">{{ $p->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                            <select class=" form-select privateperson_0 hide" id="selectedInput2"
                                                                name="orangpribadi">
                                                                @foreach ($op as $o)
                                                                <option value="{{ $o->id }}">{{ $o->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                            <select class=" form-select ecommerce_0 hide" id="selectedInput3"
                                                                name="ecommerce">
                                                                @foreach ($ec as $e)
                                                                <option value="{{ $e->id }}">{{ $e->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 page" style="margin-top: 10px;">
                                                        <div class="form-group">
                                                            <label for="floatingQuotation"><i class="fa fa-file-excel-o"></i>
                                                                Quotation</label>
                                                            <div class="form-floating">
                                                                <input required type="text" class="form-control" id="floatingQuotation"
                                                                    placeholder="Quotation" name="quotation">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i
                                                                    class="fa fa-file-text-o"></i> Terms &
                                                                Conditions</label>
                                                            <select class="form-select page pageSelector" id="pageSelector"
                                                                placeholder="Terms and Conditions" name="term_conditions">
                                                                <option value="" disabled selected hidden>Terms And
                                                                    Conditions
                                                                </option>
                                                                @foreach ($terms as $t)
                                                                <option value="{{ $t->id }}">
                                                                    {{ $t->term_condition }}
                                                                </option>
                                                                @endforeach
                                                                <option value="custom">+ Add Terms & Conditions
                                                                </option>
                                                            </select>
                                                            <textarea class="hide form-control customInput" name="term_condition"
                                                                id="customInput" cols="30" rows="10"
                                                                placeholder="Input Terms And Conditions"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                <i class="fa fa-file-pdf-o" style="font-weight: bold;"></i>
                                                                Upload Quotation
                                                            </label>
                                                            <input type="file" name="path_quotation" class="form-control form-control-lg">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 ">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i
                                                                    class="icofont icofont-stamp"></i> Send Approval To:</label>
                                                            <select class="form-select page" id="floatingproposedto"
                                                                placeholder="Proposed To" name="atasan_po" required="">
                                                                <option selected="" disabled="" value="">-- Please Choose
                                                                    One
                                                                    --
                                                                </option>
                                                                @foreach ($atasan as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i class="fa fa-money"></i>
                                                                Currency :</label>
                                                            <select class="form-select page" id="floatingdateline" placeholder="Mata Uang"
                                                                name="matauang" required="">
                                                                <option value="RP">RP</option>
                                                                <option value="USD">USD</option>
                                                            </select>
                                                            @error('matauang')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <table class="table table-bordered item order-entry mx-2">
                                                        <tr style="text-align: center;">
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Item</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Qty</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Category</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Price-per-unit</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Total</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Action</th>
                                                        </tr>
                                                        @php
                                                        $id = 0;
                                                        $id++;
                                                        @endphp
                                                        @foreach ($pengajuan as $i)

                                                        <td class="text">
                                                            <input type="text" name="id[]" placeholder="Input Item" class="form-control"
                                                                style="text-align: center;" value="{{ $i->id }}" hidden />
                                                            <input type="text" placeholder="Input Item" class="form-control" name="item[]"
                                                                style="text-align: center;" value="{{ $i->item }}" />
                                                        </td>
                                                        <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                                class="form-control form-calc form-qty" style="text-align: center;"
                                                                value="{{ $i->qty }}" min="1" max="{{ $i->qty }}" />
                                                        </td>
                                                        <td>
                                                            <select class="form-select " placeholder="Kategori" name="kategori[]"
                                                                value="{{ $i->kategori }}">
                                                                <option value="{{ $i->kategori }}">
                                                                    {{ $i->kategori }}</option>
                                                                <option value="Pcs">Pcs </option>
                                                                <option value="Lusin">Lusin </option>
                                                                <option value="Box">Box </option>
                                                                <option value="Unit">Unit </option>
                                                                <option value="Lot">Lot </option>
                                                                <option value="Rim">Rim </option>
                                                                <option value="Org">Org </option>
                                                                <option value="Line">Line </option>
                                                                <option value="Ruang">Ruang </option>
                                                                <option value="Pax">Pax </option>
                                                                <option value="Set">Set </option>
                                                                <option value="Piece">Piece </option>
                                                                <option value="Rol">Rol </option>
                                                                <option value="Pack">Pack </option>
                                                                <option value="Batang">Batang </option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <input type="text" name="unit_price[]" placeholder="Input Price"
                                                                class="form-control text-end form-calc  rupiah"
                                                                style="text-align: right;" required />

                                                                <input type="text" name="unit_price[]" placeholder="Input Price"
                                                                class="form-control text-end form-calc form-cost dollar"
                                                                style="text-align: right;" required />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="total[]" class="form-control form-line"
                                                                style="text-align: right;" required />
                                                        </td>
                                                        <td style="text-align: center;"><button type="button"
                                                                class="btn btn-danger remove-input-field"><i
                                                                    class="fa fa-times"></i></button></td>

                                                        </tr>
                                                        @endforeach
                                                    </table>

                                                    <table class="table table-bordered  mx-2" style="margin-top: 0px;">
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    DPP :</label>
                                                            </td>
                                                            <td>
                                                                <input  class="total_A form-control disabled text-end " type="text" name="dpp">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Ongkir :</label>
                                                            </td>
                                                            <td>
                                                                <input  class="ongkir form-control text-end rupiah" type="text" name="ongkir">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Discount :</label>
                                                            </td>
                                                            <td class="text-end">
                                                                <input class="form-control discount form-calc rupiah text-end" type="text"
                                                                    id="discount" name="discount">
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                                    Discount :</label>
                                                            </td>
                                                            <td class="total_disc text-end">
                                                                <input style="display: none;" class=" total_disc " type="text"
                                                                    name="total_disc">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input class="mt-1 pull-right check-box-create" type="checkbox" name="ppn"
                                                                    value="1" {{ old('ppn', 0)===1 ? 'checked' : '' }}>
                                                                <label class="pull-right" style="font-weight: bold;"> PPN 11%
                                                                </label>
                                                            </td>
                                                            <td class="ppn text-end">
                                                                <input style="display: none;" class="ppn" type="text" name="ppn">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-end" style="font-weight: bold;">Grand Total
                                                                :</td>
                                                            <td>
                                                                <input class="form-control text-end total"
                                                                    type="text" name="grand_total">
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="form-group" style="text-align:right;">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a type="reset" class="btn btn-dark"
                                                            href="{{ url('/menu-purchase-order/') }}">Back</a>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                            </div>
                                        </div>

                                <div class="mt-4">
                                    <button type="button" name="add" class=" btn btn-outline-primary"  data-bs-toggle="modal"
                                    data-bs-target="#modalCreatePO" > Create
                                        PO
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div> --}}
                            </div>
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>

                {{-- <style>
                    .tutup {
                        width: 0;
                        height: 0;
                        opacity: 0;
                    }
                    .createPO {
                        display: none;
                    }

                    .hide {
                        width: 0;
                        height: 0;
                        opacity: 0;
                    }

                    .page {
                        height: 60px;
                    }

                    .terms {
                        height: 60px;
                    }
                </style>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-absolute createPO">
                                <div class="card-header bg-primary">
                                    <h5 class="text-white">Create PO</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Floating Labels Form -->
                                    <form class="row g-2 mt-4" action="{{ url('/menu-purchase-order/store/' . $data_pengajuan->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(empty($id_item->item_ppid))
                                        <input type="hidden" name="item_ppid" value="1">
                                        @else
                                        @php
                                        $item_id = $id_item->item_ppid;
                                        $val_id = $item_id + 1;
                                        @endphp
                                        <input type="hidden" name="item_ppid" value="{{ $val_id }}">
                                        @endif

                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-label" style="font-weight: bold;"><i
                                                        class="fa fa-database"></i> Select
                                                    Vendor</label>
                                                <select class="form-select page pageSelect" id="pageSelect"
                                                    placeholder="Proposed To" name="vendor">
                                                    <option value="" disabled selected hidden>Select
                                                        Vendor
                                                    </option>
                                                    <option value="company">Company</option>
                                                    <option value="privateperson">Private Person
                                                    </option>
                                                    <option value="ecommerce">Ecommerce</option>
                                                </select>

                                                <select class=" form-select perusahaan_0 hide mt-2" id="selectedInput"
                                                    name="perusahaan">
                                                    @foreach ($pt as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nama }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <select class=" form-select privateperson_0 hide" id="selectedInput2"
                                                    name="orangpribadi">
                                                    @foreach ($op as $o)
                                                    <option value="{{ $o->id }}">{{ $o->nama }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <select class=" form-select ecommerce_0 hide" id="selectedInput3"
                                                    name="ecommerce">
                                                    @foreach ($ec as $e)
                                                    <option value="{{ $e->id }}">{{ $e->nama }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 page" style="margin-top: 10px;">
                                            <div class="form-group">
                                                <label for="floatingQuotation"><i class="fa fa-file-excel-o"></i>
                                                    Quotation</label>
                                                <div class="form-floating">
                                                    <input required type="text" class="form-control" id="floatingQuotation"
                                                        placeholder="Quotation" name="quotation">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" style="font-weight: bold;"><i
                                                        class="fa fa-file-text-o"></i> Terms &
                                                    Conditions</label>
                                                <select class="form-select page pageSelector" id="pageSelector"
                                                    placeholder="Terms and Conditions" name="term_conditions">
                                                    <option value="" disabled selected hidden>Terms And
                                                        Conditions
                                                    </option>
                                                    @foreach ($terms as $t)
                                                    <option value="{{ $t->id }}">
                                                        {{ $t->term_condition }}
                                                    </option>
                                                    @endforeach
                                                    <option value="custom">+ Add Terms & Conditions
                                                    </option>
                                                </select>
                                                <textarea class="hide form-control customInput" name="term_condition"
                                                    id="customInput" cols="30" rows="10"
                                                    placeholder="Input Terms And Conditions"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="fa fa-file-pdf-o" style="font-weight: bold;"></i>
                                                    Upload Quotation
                                                </label>
                                                <input type="file" name="path_quotation" class="form-control form-control-lg">
                                            </div>
                                        </div>
                                        <table class="table table-bordered item order-entry mx-2">
                                            <tr style="text-align: center;">
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Item</th>
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Qty</th>
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Category</th>
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Price-per-unit</th>
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Total</th>
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Action</th>
                                            </tr>
                                            @php
                                            $id = 0;
                                            $id++;
                                            @endphp
                                            @foreach ($pengajuan as $i)

                                            <td class="text">
                                                <input type="text" name="id[]" placeholder="Input Item" class="form-control"
                                                    style="text-align: center;" value="{{ $i->id }}" hidden />
                                                <input type="text" placeholder="Input Item" class="form-control" name="item[]"
                                                    style="text-align: center;" value="{{ $i->item }}" />
                                            </td>
                                            <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                    class="form-control form-calc form-qty" style="text-align: center;"
                                                    value="{{ $i->qty }}" min="1" max="{{ $i->qty }}" />
                                            </td>
                                            <td>
                                                <select class="form-select " placeholder="Kategori" name="kategori[]"
                                                    value="{{ $i->kategori }}">
                                                    <option value="{{ $i->kategori }}">
                                                        {{ $i->kategori }}</option>
                                                    <option value="Pcs">Pcs </option>
                                                    <option value="Lusin">Lusin </option>
                                                    <option value="Box">Box </option>
                                                    <option value="Unit">Unit </option>
                                                    <option value="Lot">Lot </option>
                                                    <option value="Rim">Rim </option>
                                                    <option value="Org">Org </option>
                                                    <option value="Line">Line </option>
                                                    <option value="Ruang">Ruang </option>
                                                    <option value="Pax">Pax </option>
                                                    <option value="Set">Set </option>
                                                    <option value="Piece">Piece </option>
                                                    <option value="Rol">Rol </option>
                                                    <option value="Pack">Pack </option>
                                                    <option value="Batang">Batang </option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="unit_price[]" placeholder="Input Price"
                                                    class="form-control text-end form-calc form-cost rupiah"
                                                    style="text-align: right;" required />
                                            </td>
                                            <td>
                                                <input type="text" name="total[]" class="form-control form-line"
                                                    style="text-align: right;" required />
                                            </td>
                                            <td style="text-align: center;"><button type="button"
                                                    class="btn btn-danger remove-input-field"><i
                                                        class="fa fa-times"></i></button></td>

                                            </tr>
                                            @endforeach
                                        </table>

                                        <table class="table table-bordered  mx-2" style="margin-top: 0px;">
                                            <tr>
                                                <td>
                                                    <label class="pull-right"
                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                        DPP :</label>
                                                </td>
                                                <td>
                                                    <input  class="total_A form-control disabled text-end " type="text" name="dpp">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="pull-right"
                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Discount :</label>
                                                </td>
                                                <td class="text-end">
                                                    <input class="form-control discount form-calc rupiah text-end" type="text"
                                                        id="discount" name="discount">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="pull-right"
                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                        Discount :</label>
                                                </td>
                                                <td class="total_disc text-end">
                                                    <input style="display: none;" class=" total_disc " type="text"
                                                        name="total_disc">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="mt-1 pull-right check-box" type="checkbox" name="ppn"
                                                        value="1" {{ old('ppn', 0)===1 ? 'checked' : '' }}>
                                                    <label class="pull-right" style="font-weight: bold;"> PPN 11%
                                                    </label>
                                                </td>
                                                <td class="ppn text-end">
                                                    <input style="display: none;" class="ppn" type="text" name="ppn">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                    :</td>
                                                <td>
                                                    <input class="form-control text-end total"
                                                        type="text" name="grand_total">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="mt-2" style="float: right;">
                                            <button type="button" name="add" class="addItem btn btn-outline-primary"> AddItem
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <div class="form-group">
                                                <label class="form-label" style="font-weight: bold;"><i
                                                        class="icofont icofont-stamp"></i> Send Approval To:</label>
                                                <select class="form-select page" id="floatingproposedto"
                                                    placeholder="Proposed To" name="atasan_po" required="">
                                                    <option selected="" disabled="" value="">-- Please Choose
                                                        One
                                                        --
                                                    </option>
                                                    @foreach ($atasan as $sui)
                                                    <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" style="font-weight: bold;"><i class="fa fa-money"></i>
                                                    Currency :</label>
                                                <select class="form-select page" id="floatingdateline" placeholder="Mata Uang"
                                                    name="matauang" required="">
                                                    <option selected="" disabled="" value="">select currency
                                                    </option>
                                                    <option value="USD">USD</option>
                                                    <option value="RP">RP</option>
                                                </select>
                                                @error('matauang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group" style="text-align:right;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a type="reset" class="btn btn-dark"
                                                href="{{ url('/menu-purchase-order/') }}">Back</a>
                                        </div>
                                        <div>
                                            <button type="button" name="add" class="addPO btn btn-outline-primary disabled"> Add
                                                Vendor
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                </div>
                            </div>
                            </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
    </section>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets/AutoNumeric/dist/autoNumeric.min.js') }}"></script>

    <script>
        const dollars = document.querySelectorAll('.dollar');
        dollars.forEach(dollar => {
            new AutoNumeric(dollar,'dollar');
        })
        const
    </script>

    </script> --}}
    {{-- <script type="text/javascript">
        function createPO(element){
            if(element.style.display === "none"){
                element.style.display = "block";
            }else{
               element.style.display = "none";
            }
        }
        const button  = document.querySelector('.po');
        const content = document.querySelector('.createPO');

        button.addEventListener("click", function(){
            createPO(content);
        })

        </script> --}}
    {{-- <script type="text/javascript">
        //Math
                                $(document).ready(function() {
                                    //Convert To Rupiah
                                    var rupiah = document.querySelector(".rupiah");
                                    rupiah.addEventListener('keyup', function(e) {
                                        // tambahkan 'Rp.' pada saat form di ketik
                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                        rupiah.value = formatRupiah(this.value, "");
                                    });
                                    /* Fungsi formatRupiah */
                                    function formatRupiah(angka, prefix) {
                                        var number_string = angka.replace(/[^,\d]/g, ""),
                                            split = number_string.split("."),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if (ribuan) {
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }
                                        rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                    }

                                    $(".order-entry").on("keyup", ".form-calc", function() {
                                        var parent = $(this).closest("tr");
                                        var str = parent.find(".form-cost").val();
                                        var res = str.replace(/\D/g, "");
                                        // var repl = res.replace
                                        console.log(str);
                                        parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                                        var total = 0;
                                        $(".form-line").each(function() {
                                            total += parseInt($(this).val() || 0);
                                        });
                                        $(".total_A").val(total);

                                        var ongkir = document.querySelector(".ongkir")
                                        ongkir.addEventListener("input", function(){
                                            var ongkos = ongkir.value;
                                            var replace = ongkos.replace(/\D/g, "");
                                            var ongkoskirim = parseInt(replace);
                                            ongkoskir = total + ongkoskirim ;
                                            console.log(ongkoskir);

                                        var diskon = document.querySelector(".discount");
                                        diskon.addEventListener("input", function() {
                                            var disc = diskon.value;
                                            var rep = disc.replace(/\D/g, "");
                                            var discint = parseInt(rep);
                                           discount = ongkoskir - discint;
                                           console.log(discount);
                                           $(".total_disc").text(discount.toLocaleString('en-US'));

                                        var checkbox = document.querySelector(".check-box-create");
                                        checkbox.addEventListener('change', (event) => {
                                            // console.log(event.currentTarget.checked);
                                            if (event.currentTarget.checked) {
                                                totalppn = discount * 11 / 100;
                                                grandtotal = discount + totalppn;
                                                console.log(grandtotal);
                                                $(".ppn").text(totalppn.toLocaleString('en-US'));
                                                // $(".total").val(grandtotal.toLocaleString('en-US'));
                                                $(".total").val(grandtotal);
                                            } else {
                                                totalppn = discount * 0;
                                                $(".ppn").text(totalppn);
                                                // $(".total").val(discount.toLocaleString('en-US'));
                                                $(".total").val(discount);
                                            }
                                            });
                                        });
                                    });
                                });
                            });
                                //Add Form
                                $(".addItem").on('click', function() {
                                    addItem();
                                });
                                function addItem() {
                                    var item =
                                        `<tr><td><input type="text" name="id[]"
                                                                placeholder="Input Item" class="form-control"
                                                                style="text-align: center;" value="{{ $i->id }}" hidden /><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option> <option value="Lot">Lot </option> <option value="Rim">Rim </option>
                                                        <option value="Org">Org </option><option value="Line">Line </option> <option value="Ruang">Ruang </option><option value="Pax">Pax </option><option value="Set">Set </option>
                                                        <option value="Piece">Piece </option><option value="Rol">Rol </option><option value="Pack">Pack </option>
                                                        <option value="Batang">Batang </option></select></td> <td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;"  required/></td><td><input type="text" name="total[]" class="form-control form-line" style="text-align: right;" required  /></td> <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> `;
                                    $(".item").append(item)
                                    var rupiah = document.querySelectorAll(".rupiah");
                                    rupiah.forEach((item) => {
                                        item.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            item.value = formatRupiah(this.value, "");
                                        });
                                    });
                                    /* Fungsi formatRupiah */
                                    function formatRupiah(angka, prefix) {
                                        var number_string = angka.replace(/[^,\d]/g, ""),
                                            split = number_string.split(","),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if (ribuan) {
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }
                                        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                    }
                                    new AutoNumeric(document.querySelector('.dollar'), 'dollar');


                                    $(".order-entry").on("keyup", ".form-calc", function() {
                                        var parent = $(this).closest("tr");
                                        var str = parent.find(".form-cost").val();
                                        var res = str.replace(/\D/g, "");
                                        parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                                        var total = 0;
                                        $(".form-line").each(function() {
                                            total += parseInt($(this).val() || 0);
                                        });
                                        $(".total_A").val(total.toLocaleString('en-US'));
                                        var checkbox = document.querySelector(".check-box");
                                        checkbox.addEventListener('change', (event) => {

                                            if (event.currentTarget.checked) {
                                                totalppn = total * 11 / 100;
                                                grandtotal = total + totalppn;
                                                $(".ppn").text(totalppn.toLocaleString('en-US'));
                                                $(".total").text(grandtotal.toLocaleString('en-US'));
                                            } else {
                                                totalppn = total * 0;
                                                $(".ppn").text(totalppn);
                                                $(".total").text(total.toLocaleString('en-US'));
                                            }
                                        });
                                    });
                                }
                                $(document).on('click', '.remove-input-field', function() {
                                    $(this).parents('tr').remove();
                                });
                                var rupiah = document.querySelectorAll(".rupiah");
                                rupiah.forEach((item) => {
                                    item.addEventListener('keyup', function(e) {
                                        // tambahkan 'Rp.' pada saat form di ketik
                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                        item.value = formatRupiah(this.value, "");
                                    });
                                });
                                /* Fungsi formatRupiah */
                                function formatRupiah(angka, prefix) {
                                    var number_string = angka.replace(/[^,\d]/g, ""),
                                        split = number_string.split(","),
                                        sisa = split[0].length % 3,
                                        rupiah = split[0].substr(0, sisa),
                                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                    if (ribuan) {
                                        separator = sisa ? "." : "";
                                        rupiah += separator + ribuan.join(".");
                                    }
                                    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                }


    </script>

    <script type="text/javascript">
        var pageSelector = document.querySelector('.pageSelector');
                                var customInput = document.querySelector('.customInput');
                                pageSelector.addEventListener('change', function() {
                                    if (this.value == "custom") {
                                        customInput.classList.remove('hide');
                                    } else {
                                        customInput.classList.add('hide');
                                    }
                                })
    </script>
    <script type="text/javascript">
        var pageSelect = document.querySelector('.pageSelect');
                                var selectedInput = document.querySelector('.perusahaan_0');
                                var selectedInput2 = document.querySelector('.privateperson_0');
                                var selectedInput3 = document.querySelector('.ecommerce_0');
                                // Company
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "company") {
                                        selectedInput.classList.remove('hide');
                                    } else {
                                        selectedInput.classList.add('hide');
                                    }
                                })
                                // Private Person
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "privateperson") {
                                        selectedInput2.classList.remove('hide');
                                    }  else {
                                        selectedInput2.classList.add('hide');
                                    }
                                })
                                // Ecommerce
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "ecommerce") {
                                        selectedInput3.classList.remove('hide');
                                    }  else {
                                        selectedInput3.classList.add('hide');
                                    }
                                })
    </script>


<script type="text/javascript">
    //Math
                            $(document).ready(function() {
                                //Convert To Rupiah
                                var rupiah = document.querySelector(".rupiah");
                                rupiah.addEventListener('keyup', function(e) {
                                    // tambahkan 'Rp.' pada saat form di ketik
                                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                    rupiah.value = formatRupiah(this.value, "");
                                });
                                /* Fungsi formatRupiah */
                                function formatRupiah(angka, prefix) {
                                    var number_string = angka.replace(/[^,\d]/g, ""),
                                        split = number_string.split("."),
                                        sisa = split[0].length % 3,
                                        rupiah = split[0].substr(0, sisa),
                                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                    if (ribuan) {
                                        separator = sisa ? "." : "";
                                        rupiah += separator + ribuan.join(".");
                                    }
                                    rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
                                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                }
                                $(".order-entry-edit").on("keyup", ".form-calc-edit", function() {
                                    var parent = $(this).closest("tr");
                                    var str = parent.find(".form-cost-edit").val();
                                    var res = str.replace(/\D/g, "");
                                    // console.log(res);
                                    parent.find(".form-line-edit").val((parent.find(".form-qty-edit").val() * res).toFixed(0));
                                    var total = 0;
                                    $(".form-line-edit").each(function() {
                                        total += parseInt($(this).val() || 0);
                                    });
                                    $(".total_A-edit").val(total);

                                    var ongkir = document.querySelector(".ongkir-edit")
                                    ongkir.addEventListener("input", function(){
                                        var ongkos = ongkir.value;
                                        var replace = ongkos.replace(/\D/g, "");
                                        var ongkoskirim = parseInt(replace);
                                        ongkoskir = total + ongkoskirim ;
                                        console.log(ongkoskir);

                                    var diskon = document.querySelector(".discount-edit");
                                    diskon.addEventListener("input", function() {
                                        var disc = diskon.value;
                                        var rep = disc.replace(/\D/g, "");
                                        var discint = parseInt(rep);
                                       discount = ongkoskir - discint;
                                       console.log(discount);
                                       $(".total_disc-edit").text(discount.toLocaleString('en-US'));

                                    var checkboxedit = document.querySelector(".check-box-edit");
                                    checkboxedit.addEventListener('change', (event) => {
                                        // console.log(event.currentTarget.checked);
                                        if (event.currentTarget.checked) {
                                            totalppn = discount * 11 / 100;
                                            grandtotal = discount + totalppn;
                                            console.log(grandtotal);
                                            $(".ppn-edit").text(totalppn.toLocaleString('en-US'));
                                            // $(".total").val(grandtotal.toLocaleString('en-US'));
                                            $(".total-edit").val(grandtotal);
                                        } else {
                                            totalppn = discount * 0;
                                            $(".ppn-edit").text(totalppn);
                                            // $(".total").val(discount.toLocaleString('en-US'));
                                            $(".total-edit").val(discount);
                                        }
                                        });
                                    });
                                });
                            });
                        });
                            //Add Form
                            $(".addItem").on('click', function() {
                                addItem();
                            });
                            function addItem() {
                                var item =
                                    `<tr><td><input type="text" name="id[]"
                                                            placeholder="Input Item" class="form-control"
                                                            style="text-align: center;" value="{{ $i->id }}" hidden /><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option> <option value="Lot">Lot </option> <option value="Rim">Rim </option>
                                                    <option value="Org">Org </option><option value="Line">Line </option> <option value="Ruang">Ruang </option><option value="Pax">Pax </option><option value="Set">Set </option>
                                                    <option value="Piece">Piece </option><option value="Rol">Rol </option><option value="Pack">Pack </option>
                                                    <option value="Batang">Batang </option></select></td> <td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;"  required/></td><td><input type="text" name="total[]" class="form-control form-line" style="text-align: right;" required  /></td> <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> `;
                                $(".item").append(item)
                                var rupiah = document.querySelectorAll(".rupiah");
                                rupiah.forEach((item) => {
                                    item.addEventListener('keyup', function(e) {
                                        // tambahkan 'Rp.' pada saat form di ketik
                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                        item.value = formatRupiah(this.value, "");
                                    });
                                });
                                /* Fungsi formatRupiah */
                                function formatRupiah(angka, prefix) {
                                    var number_string = angka.replace(/[^,\d]/g, ""),
                                        split = number_string.split(","),
                                        sisa = split[0].length % 3,
                                        rupiah = split[0].substr(0, sisa),
                                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                    if (ribuan) {
                                        separator = sisa ? "." : "";
                                        rupiah += separator + ribuan.join(".");
                                    }
                                    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                }

                                $(".order-entry").on("keyup", ".form-calc", function() {
                                    var parent = $(this).closest("tr");
                                    var str = parent.find(".form-cost").val();
                                    var res = str.replace(/\D/g, "");
                                    parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                                    var total = 0;
                                    $(".form-line").each(function() {
                                        total += parseInt($(this).val() || 0);
                                    });
                                    $(".total_A").val(total.toLocaleString('en-US'));
                                    var checkbox = document.querySelector(".check-box");
                                    checkbox.addEventListener('change', (event) => {

                                        if (event.currentTarget.checked) {
                                            totalppn = total * 11 / 100;
                                            grandtotal = total + totalppn;
                                            $(".ppn").text(totalppn.toLocaleString('en-US'));
                                            $(".total").text(grandtotal.toLocaleString('en-US'));
                                        } else {
                                            totalppn = total * 0;
                                            $(".ppn").text(totalppn);
                                            $(".total").text(total.toLocaleString('en-US'));
                                        }
                                    });
                                });
                            }
                            $(document).on('click', '.remove-input-field', function() {
                                $(this).parents('tr').remove();
                            });
                            var rupiah = document.querySelectorAll(".rupiah");
                            rupiah.forEach((item) => {
                                item.addEventListener('keyup', function(e) {
                                    // tambahkan 'Rp.' pada saat form di ketik
                                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                    item.value = formatRupiah(this.value, "");
                                });
                            });
                            /* Fungsi formatRupiah */
                            function formatRupiah(angka, prefix) {
                                var number_string = angka.replace(/[^,\d]/g, ""),
                                    split = number_string.split(","),
                                    sisa = split[0].length % 3,
                                    rupiah = split[0].substr(0, sisa),
                                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                if (ribuan) {
                                    separator = sisa ? "." : "";
                                    rupiah += separator + ribuan.join(".");
                                }
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                            }
</script>


<script type="text/javascript">
    var pageSelectorEdit = document.querySelector('.pageSelectorEdit');
                            var customInput_edit = document.querySelector('.customInput_edit');
                            pageSelectorEdit.addEventListener('change', function() {
                                if (this.value == "custom_edit") {
                                    customInput_edit.classList.remove('hide');
                                } else {
                                    customInput_edit.classList.add('hide');
                                }
                            })
</script>
<script type="text/javascript">
    var pageSelectEdit = document.querySelector('.pageSelectEdit');
                            var selectedInput_edit = document.querySelector('.perusahaan_0_edit');
                            var selectedInput2_edit = document.querySelector('.privateperson_0_edit');
                            var selectedInput3_edit = document.querySelector('.ecommerce_0_edit');
                            // Company
                            pageSelectEdit.addEventListener('change', function() {
                                if (this.value == "company") {
                                    selectedInput_edit.classList.remove('hide');
                                } else {
                                    selectedInput_edit.classList.add('hide');
                                }
                            })
                            // Private Person
                            pageSelectEdit.addEventListener('change', function() {
                                if (this.value == "privateperson") {
                                    selectedInput2_edit.classList.remove('hide');
                                }  else {
                                    selectedInput2_edit.classList.add('hide');
                                }
                            })
                            // Ecommerce
                            pageSelectEdit.addEventListener('change', function() {
                                if (this.value == "ecommerce") {
                                    selectedInput3_edit.classList.remove('hide');
                                }  else {
                                    selectedInput3_edit.classList.add('hide');
                                }
                            })
</script> --}}

@endsection
