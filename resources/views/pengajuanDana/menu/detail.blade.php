<title>Detail Invoicing</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail {{ $data_pengajuan->ws }}</h1>
                        <table class="table table-bordered mt-4">
                            <tbody>

                                <tr>
                                    <td>Date</td>
                                    <td>{{ $data_pengajuan->date_ps }}</td>
                                </tr>
                                <tr>
                                    <td>Who Submitted</td>
                                    <td>{{ $data_pengajuan->ws }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $data_pengajuan->desc }}</td>
                                </tr>
                                <tr>
                                    <td>Purpose</td>
                                    <td>{{ $data_pengajuan->referensi->nama }}</td>
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
                                <tr class="text-center">
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Kategori</th>
                                    <th>Price-per-unit</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $p)
                                    <tr>
                                        <td>{{ $p->item }}</td>
                                        <td>{{ $p->qty }}</td>
                                        <td>{{ $p->kategori }}</td>
                                        @if ($data_pengajuan->matauang == 'RP')
                                            <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}</td>
                                            <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                        @elseif ($data_pengajuan->matauang == 'USD')
                                            <td style="text-align:right;">$ {{ number_format($p->unit_price) }}</td>
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
                                    @foreach ($ppn as $p)
                                        {{-- Ketika mata uang yang dipilih RP --}}
                                        @if ($data_pengajuan->matauang == 'RP')
                                            RP. {{ number_format($p->total) }}
                                            {{-- Ketika mata uang yang dipilih USD --}}
                                        @elseif ($data_pengajuan->matauang == 'USD')
                                            $ {{ number_format($p->total) }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            @if ($data_pengajuan->ppn == 1)
                                <tr>
                                    <td class="text-end">Grand Total :</td>

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
                        @if ($data_pengajuan->status == 'Invoicing Process')
                            <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                data-bs-target="#modalSelesai" disabled>Successfully send data</button>
                        @elseif ($data_pengajuan->status == 'PO Approved')
                            <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                data-bs-target="#modalSelesai">Apply For Payment Process</button>
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
                                        @if ($data_pengajuan->status == 'PO Approved')
                                            <form class="text-center"
                                                action="{{ url('purchase-funding-submission/ajukan_dana', $data_pengajuan->id) }}">
                                                <button type="submit" class="btn btn-outline-danger "><i
                                                        class="bx bx-trash"></i>
                                                    Apply For Purchase Funding
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($data_pengajuan->status == 'PO Approved')
            <a href={{ url('/exportpdf/po/' . $data_pengajuan->id) }} class="btn btn-danger mb-3 mr-1"
                style="align-self: flex-end"> Export to PDF</a>

            <a type="reset" class="btn btn-danger mb-3 mr-1" href="{{ url('/invoicing/') }}">Back</a>
        @endif

    </section>
@endsection
