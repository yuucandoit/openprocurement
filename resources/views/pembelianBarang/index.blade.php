<title>Pembelian barang</title>

@extends('layouts.master')

@section('main')
    <section>

        @foreach ($pb as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                            <span class="warning">
                                <img src="assets/images/warning.png">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/pembelian-barang-destroy/' . $a->id) }}">
                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h1>{{ $menu_pb->nama }}</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        @hasrole('user|super admin')
                            <a href="{{ url('/pembelian-barang/create/' . $menu_pb->id) }}" class="btn btn-primary mb-3"><i
                                    class="bx bx-list-plus"></i> Add+</a>
                        @endhasrole
                        @if ($menu_pb->status == 'Accepted')
                            <a href={{ url('/export_excel/pembelian_barang/' . $menu_pb->id) }}
                                class="btn btn-success mb-3 mr-1" style="align-self: flex-end">Export to Excel</a>
                        @endif
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Rev</th>
                                    <th>Lokasi</th>
                                    <th>Jangka waktu</th>
                                    <th>Dana yang dibutuhkan</th>
                                    <th>No.Rek</th>
                                    <th>Item</th>
                                    <th>Unit Quantity</th>
                                    <th>Jumlah Quantity</th>
                                    <th>Harga satuan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr> {{-- <td>{{ $dataPembelian->no_doc }}</td> --}}

                                {{-- <td>{{ $dataPembelian->revisi }}</td> --}}

                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pb as $dataPembelian)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dataPembelian->created_at }}</td>
                                    <td>{{ $dataPembelian->rev }}</td>
                                    <td>{{ $dataPembelian->lokasi }}</td>
                                    <td>{{ $dataPembelian->jangka_waktu }}</td>
                                    <td>{{ $dataPembelian->dana_diperlukan }}</td>
                                    <td>{{ $dataPembelian->no_rek }}</td>
                                    <td>{{ $dataPembelian->item }}</td>
                                    <td>{{ $dataPembelian->quantity }}</td>
                                    <td>{{ $dataPembelian->jumlah_quantity }}</td>
                                    <td>{{ $dataPembelian->harga_satuan }}</td>
                                    <td>{{ $dataPembelian->total }}</td>
                                    <td>{{ $dataPembelian->status }}</td>
                                    <td>
                                        <a href="{{ url('/pembelian-barang/show/' . $menu_pb->id . '/' . $dataPembelian->id) }}"
                                            class="btn btn-outline-info"> <i class="bx bxs-edit"></i> Edit</a>
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $dataPembelian->id }}">Delete</button>
                                    </td>
                                    @hasrole('admin|super admin')
                                    @endhasrole
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
