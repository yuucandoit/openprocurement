<title>Data Pengajuan</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <a type="reset" class="btn btn-danger mb-2" href="{{ url('/menu-taskList-atasan/') }}">Back</a>
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail Dari {{ $data_pengajuan->ws }}</h1>
                            <table class="table table-bordered mt-4">
                                <tbody>
                                    <tr>
                                        <td>Proposed Supplier</td>
                                        <td>{{ $data_pengajuan->proposed_supplier }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>{{ $data_pengajuan->date_ps }}</td>
                                    </tr>
                                    <tr>
                                        <td>Who Submitted</td>
                                        <td>{{ $data_pengajuan->ws }}</td>
                                    </tr>
                                    <tr>
                                        <td>Item</td>
                                        @foreach ($pengajuan as $p)
                                        <td>{{ $p->item }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        @foreach ($pengajuan as $p)
                                        <td>{{ $p->qty }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Price Unit</td>
                                        @foreach ($pengajuan as $p)
                                        <td>{{ number_format($p->unit_price) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Price Unit</td>
                                        @foreach ($pengajuan as $p)
                                        <td>{{ number_format($p->total )}}</td>
                                        @endforeach
                                    </tr>
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
                                </tbody>
                            </table>
                            <div class="mt-3">
                                @hasrole('super user')
                                @if ($data_pengajuan->status == 'Accepted by Super user')
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return"><b>Accepted</b></a>

                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>

                                @elseif($data_pengajuan->status == 'pending')
                                        <a href="{{ url('menu-taskList-atasan/accept_atasan', $data_pengajuan->id) }}"
                                          class="btn btn-success text-center" onclick="return">Accept</a>

                                        <a href="{{ url('menu-taskList-atasan/reject', $data_pengajuan->id) }}"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                @else
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-successtext-center" onclick="return">Accept</a>

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
