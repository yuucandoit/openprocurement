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
                                    @foreach ($pengajuan as $p)
                                    <tr>
                                        <td>Item {{ $p->id }}</td>
                                        <td>{{ $p->item }}</td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td>{{ $p->qty }}</td>
                                    </tr>
                                    @if ($p->matauang == 'RP')
                                    <tr>
                                        <td>Price</td>
                                        <td>RP. {{ number_format($p->unit_price) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>RP. {{ number_format($p->total) }}</td>
                                    </tr>
                                    @elseif ($p->matauang == 'USD')
                                    <tr>
                                        <td>Price</td>
                                        <td>$ {{ number_format($p->unit_price) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>$ {{ number_format($p->total) }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $data_pengajuan->desc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose</td>
                                        <td>{{ $data_pengajuan->purpose }}</td>
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
