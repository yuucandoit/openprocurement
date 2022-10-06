<title>Detail Purchase Submission</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail {{ $data_pengajuan->ws }}</h1>
                            <table class="table table-bordered mt-4" style="">
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
                                        <td>Date Line</td>
                                        <td>{{ $data_pengajuan->dateline }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered mt-4 mb-4">
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
                                            <td>{{ $p->qty }}</td>
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
                                        <td><input class="mt-1 pull-right check-box" type="checkbox" value="{{ $data_pengajuan->ppn }}" @if ($data_pengajuan->ppn == 1)
                                            @checked(true)
                                            @else
                                        @endif disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
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
                        <div class="button text-center mb-2 mt-4">
                            {{-- @if ($data_pengajuan->status == '') --}}
                                 <a href={{ url('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) }}
                                     class="btn btn-success" style="align-self: flex-end"> Export to Excel</a>
                             {{-- @endif --}}
                             <a type="reset" class="btn btn-danger" href="{{ url('/menu-pengajuan-pembelian/') }}">Back</a>
                         </div>
                   </div>
             </div>
        </div>
  </section>
  @endsection
