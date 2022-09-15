<title>Detail Purchase Order</title>

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
                                            @if ($data_pengajuan->pt_id)
                                                        <tr>
                                                            <td>Perusahaan</td>
                                                            <td>{{ $data_pengajuan->pt->nama }}</td>
                                                        </tr>
                                            @endif
                                            @if ($data_pengajuan->proposed_supplier == 'OrangPribadi')
                                                        <tr>
                                                            <td>Orang Pribadi</td>
                                                            <td>{{ $data_pengajuan->op->nama }}</td>
                                                        </tr>
                                            @endif
                                            @if ($data_pengajuan->proposed_supplier == 'Ecommerce')
                                                        <tr>
                                                            <td>Ecommerce</td>
                                                            <td>{{ $data_pengajuan->ec->nama }}</td>
                                                        </tr>
                                            @endif
                                            @if ($data_pengajuan->proposed_supplier == 'Unknown')
                                                <tr>
                                                    <td>Supplier / Vendor</td>
                                                    <td>{{ $data_pengajuan->vendor }}</td>
                                                </tr>
                                            @endif
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
                                                            <form action="{{ url('menu-purchase-order/selesai', $data_pengajuan->id)  }}">
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

                            <a href={{ url('/export_excel/purchase_order/' . $data_pengajuan->id) }}
                                class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a>

                        <div class="back mt-4">
                            <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
                        </div>
                        </section>
                    @endsection
