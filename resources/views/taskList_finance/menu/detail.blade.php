<title>Detail Task Finance</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <a type="reset" class="btn btn-danger mb-2" href="{{ url('/menu-tasklist-finance/') }}">Back</a>
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail From {{ $data_pengajuan->whosubmit->name }}</h1>
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
                                    <td>{{ $data_pengajuan->referensi->name }}</td>
                                </tr>
                                <tr>
                                    <td>Send To</td>
                                    <td>{{ $data_pengajuan->send_to }}</td>
                                </tr>
                                <tr>
                                    <td>Date Line</td>
                                    <td>{{ $data_pengajuan->dateline }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered mt-4 mb-4 order-entry">
                            <thead>
                                <tr class="text-center">
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price-per-unit</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $p)
                                <tr>
                                    <td>{{ $p->item }}</td>
                                    <td >{{ $p->qty }}</td>
                                @if ($data_pengajuan->matauang == 'RP')
                                    <td style="text-align:right;" >RP. {{ number_format($p->unit_price) }}</td>
                                    <td style="text-align:right;" >RP. {{ number_format($p->total) }}</td>
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
                                <td><input class="mt-1 pull-right check-box" type="checkbox" value="{{ $data_pengajuan->ppn }}" @if ($data_pengajuan->ppn == 1)
                                    @checked(true)
                                    @else
                                    @endif disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
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
                                <td class="text-end">Grand Total :</td>

                                @foreach ($total as $t)
                                {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                @if ($data_pengajuan->matauang == 'RP')
                                <td style="text-align:right;" >RP. {{ number_format($t->total) }}</td>

                                {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                @elseif ($data_pengajuan->matauang == 'USD')
                                <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                                @endif
                                @endforeach

                                @elseif ($data_pengajuan->ppn == 0)
                                <td class="text-end">Grand Total :</td>
                                @foreach ($total_tnpa_ppn as $tpn)
                                @if ($data_pengajuan->matauang == 'RP')
                                <td style="text-align:right;" >RP. {{ number_format($tpn->total) }}</td>
                            @elseif ($data_pengajuan->matauang == 'USD')
                                <td style="text-align:right;">$ {{ number_format($tpn->total) }}</td>
                            @endif
                            @endforeach
                            </tr>
                            @endif
                        </table>
                            <div class="mt-3">
                                @hasrole('finance|super admin')
                                @if ($data_pengajuan->status == 'Unpaid')
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return"><b>Approved</b></a>

                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>

                                @elseif($data_pengajuan->status == 'Invoicing Process')
                                        <a href="{{ url('menu-tasklist-finance/approve', $data_pengajuan->id) }}"
                                            class="btn btn-success text-center" onclick="return">Approve</a>

                                        <a href="{{ url('menu-tasklist-finance/reject', $data_pengajuan->id) }}"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                @else
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-successtext-center" onclick="return">Approve</a>

                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>

                                @endif
                            @endhasrole
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        @if ($data_pengajuan->status == 'Accepted')
         {{-- <a href=url('#')('/export_excel/pengajuan_pembelian/'.$data_pengajuan->id)
            class="btn btn-success" style="align-self: flex-end"> Export to Excel</a> --}}
    @endif
    </section>
@endsection
