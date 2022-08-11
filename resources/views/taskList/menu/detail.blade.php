<title>Data Pengajuan</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail Dari {{ $data_pengajuan->ws }}</h1>
                            <table class="table table-bordered mt-4">
                                <tbody>
                                    <tr>
                                        <td>Company</td>
                                        <td>{{ $data_pengajuan->pt->nama }}</td>
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
                                        <td>{{ $data_pengajuan->item }}</td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td>{{ $data_pengajuan->qty }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ref</td>
                                        <td>{{ $data_pengajuan->ref }}</td>
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
                                        <td>Price Unit</td>
                                        <td>{{ $data_pengajuan->priceperunit }}</td>
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
                            @hasrole('purchasing')
                            @if ($data_pengajuan->status == 'Accepted')
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return"><b>Accepted</b></a>

                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return">Reject</a>

                            @elseif($data_pengajuan->status == 'pending')
                                    <a href="{{ url('menu-pengajuan-pembelian/accept', $data_pengajuan->id) }}"
                                        class="btn btn-success text-center" onclick="return">Accept</a>

                                    <a href="{{ url('menu-pengajuan-pembelian/reject', $data_pengajuan->id) }}"
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
        @if ($data_pengajuan->status == 'Accepted')
         <a href={{ url('#'){{--('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id)--}} }}
            class="btn btn-success" style="align-self: flex-end"> Export to Excel</a>
    @endif
        <a type="reset" class="btn btn-danger" href="{{ url('/menu-task-list/') }}">Back</a>
    </section>
@endsection
