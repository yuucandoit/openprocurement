<title>Data Pengajuan</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail Dari {{ $data_pengajuan->ws }}</h1>
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
                                    <tr>
                                        <td>Proposed Supplier</td>
                                        <td>{{ $data_pengajuan->proposed_supplier }}</td>
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
                        </div>
                        <div class="button text-center mb-2">
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
