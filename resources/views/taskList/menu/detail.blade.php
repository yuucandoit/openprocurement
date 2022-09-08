<title>Data Pengajuan</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        @foreach ($data_pengajuan as $dp)
                        <h1>Detail Dari {{ $dp->ws }}</h1>
                            <table class="table table-bordered mt-4">
                                <tbody>
                                    <tr>
                                        <td>Proposed Supplier</td>
                                        <td>{{ $dp->proposed_supplier }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>{{ $dp->date_ps }}</td>
                                    </tr>
                                    <tr>
                                        <td>Who Submitted</td>
                                        <td>{{ $dp->ws }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $dp->desc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose</td>
                                        <td>{{ $dp->tujuan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Price Unit</td>
                                        <td>{{ $dp->priceperunit }}</td>
                                    </tr>
                                    <tr>
                                        <td>Send To</td>
                                        <td>{{ $dp->send_to }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Line</td>
                                        <td>{{ $dp->dateline }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @endforeach
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
                                    @foreach ($data_pengajuan as $dp)
                                    @if ($dp->matauang == 'RP')
                                        <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}</td>
                                        <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                    @elseif ($dp->matauang == 'USD')
                                        <td style="text-align:right;">$ {{ number_format($p->unit_price) }}</td>
                                        <td style="text-align:right;">$ {{ number_format($p->total) }}</td>
                                    @endif
                                    @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @hasrole('purchasing')
                            @foreach ($data_pengajuan as $dp)
                            @if ($dp->status == 'Accepted by Purchasing')
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return"><b>Accepted</b></a>

                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return">Reject</a>

                            @elseif($dp->status == 'Accepted by Super user')
                                    <a href="{{ url('menu-task-list/accept', $dp->id) }}"
                                        class="btn btn-success text-center" onclick="return">Accept</a>

                                    <a href="{{ url('menu-task-list/reject', $dp->id) }}"
                                        class="btn btn-danger text-center" onclick="return">Reject</a>
                            @else
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return">Accept</a>

                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>

                             @endif
                             @endforeach
                        @endhasrole
                        </div>
                    </div>
                    </div>
                </div>

         <a href={{ url('#'){{--('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id)--}} }}
            class="btn btn-success" style="align-self: flex-end"> Export to Excel</a>
        <a type="reset" class="btn btn-danger" href="{{ url('/menu-task-list/') }}">Back</a>
    </section>
@endsection
