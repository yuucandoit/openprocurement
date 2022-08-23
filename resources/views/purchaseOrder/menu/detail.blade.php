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
                                                <td>Date Send</td>
                                                <td>{{ $data_pengajuan->dateline }}</td>
                                            </tr>
                                            <tr>
                                                <td>Proposed Supplier</td>
                                                <td>{{ $data_pengajuan->proposed_supplier }}</td>
                                            </tr>
                                            <tr>
                                                <td>Contact No</td>
                                                <td>{{ $data_pengajuan->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <td>Quotation</td>
                                                <td>{{ $data_pengajuan->quotation }}</td>
                                            </tr>
                                            <tr>
                                                <td>NPWP</td>
                                                <td>{{ $data_pengajuan->npwp }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                            @if ($data_pengajuan->status == 'Selesai Di proses Purchasing')
                                            <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai" disabled>Terselesaikan</button>
                                            @else
                                            <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai">Selesaikan</button>
                                            @endif
                                            <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h2 class="modal-title" style="color: white">Selesai</h2>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mx-5 mb-3">
                                                            <span class="warning">
                                                                <img src="{{ asset('assets/images/warning.png') }}">
                                                            </span>
                                                            <h2 style="text-align: center"> Are you sure to set this task Done? </h2>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ url('  menu-purchase-order/selesai', $data_pengajuan->id)  }}">
                                                                <button type="submit" class="btn btn-success"><i class="bx bx-trash"></i>
                                                                    Selesai</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($data_pengajuan->status == 'Accepted')
                            <a href={{ url('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) }}
                                class="btn btn-success" style="align-self: flex-end"> Export to Excel</a>
                            @endif

                        <div class="back mt-4">
                            <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
                        </div>
                        </section>
                    @endsection
