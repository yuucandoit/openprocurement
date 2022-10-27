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
                    <div class="col-sm-6 mt-4">
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
                    </div>
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
                            <div class="card-body text-center">
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
                                        @foreach ($datapo as $po)
                                            <tr>
                                                <td>Contact No</td>
                                                <td>{{ $po->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <td>Quotation</td>
                                                <td>{{ $po->quotation }}</td>
                                            </tr>
                                            <tr>
                                                <td>NPWP</td>
                                                <td>{{ $po->no_npwp }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Categori</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($pengajuan as $p)
                                            <tr>
                                                <td style="text-align: center;">{{ $p->item }}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($p->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">$ {{ number_format($p->total) }}</td>
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
                                                    $ {{ number_format($d->total) }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $data_pengajuan->ppn }}"
                                                @if ($data_pengajuan->ppn == 1) @checked(true)
                    @else @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        <td style="text-align:right;">
                                            @if ($data_pengajuan->ppn == 1)
                                                @foreach ($ppn as $p)
                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        RP. {{ number_format($p->total) }}
                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        $ {{ number_format($p->total) }}
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
                                                {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                    {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                                                @endif
                                            @endforeach
                                        @elseif ($data_pengajuan->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($tpn->total) }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                </table>
                                {{-- Start Modal Approval --}}
                                @if ($data_pengajuan->status == 'Waiting For PO Approval')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai" disabled>Approval Request Sent
                                    </button>
                                @elseif ($data_pengajuan->status == 'Purchase Proses')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai">Send Approval Request For Purchase Order</button>
                                @endif

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
                                                    <form class="text-center"
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
                            </div>
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>

                @if ($data_pengajuan->status == 'Purchase Proses')
                    {{-- <a href="{{ url('/export_excel/purchase_order/' . $data_pengajuan->id) }}"
                        class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a> --}}

                    <a type="reset" class="btn btn-dark mb-3 mr-1" href="{{ url('/menu-purchase-order/') }}">Back</a>
                @endif

                @if ($data_pengajuan->status == 'PO Approved')
                    <a href="{{ url('/exportpdf/po/' . $data_pengajuan->id) }}" class="btn btn-danger mb-3 mr-1"
                        style="align-self: flex-end"> Export to PDF</a>

                    <a type="reset" class="btn btn-dark mb-3 mr-1" href="{{ url('/menu-purchase-order/') }}">Back</a>
                @endif

    </section>
@endsection
