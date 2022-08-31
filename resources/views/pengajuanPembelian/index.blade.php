<title>Pengajuan Pembelian</title>
@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Item</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form class="row g-3" action="{{ url('pengajuan-pembelian/store/' . $data_pd->id) }}" id="formAdd"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-4" id="floatingdateline" placeholder="Mata Uang" name="matauang" >
                                        <option value="USD">USD</option>
                                        <option value="RP">RP</option>
                                    </select>
                                    <label for="floatingdateline">-- Mata Uang --</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-2" id="floatingSubject" placeholder="Item"
                                        name="item">
                                    <label>Item</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control mt-4" id="floatingName"
                                            placeholder="Jumlah" name="qty">
                                        <label>Jumlah</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control mt-4" id="floatingName" placeholder="Harga"
                                            name="unit_price">
                                        <label>Harga</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary btn_add mt-3">Add Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($pd as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                            <span class="warning">
                                <img src="assets/images/warning.png">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/pengajuan-pembelian/destroy/' . $a->id) }}">
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
                    <h1>{{ $data_pd->ws }}</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        @hasrole('user|super admin')
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                    class="bx bx-list-plus"></i> Add+</button>
                        @endhasrole
                        @if ($data_pd->status == 'Accepted')
                            <a href={{ url('/export_excel/pengajuan_dana/' . $data_pd->id) }}
                                class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a>
                        @endif
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pd as $dataPengajuan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dataPengajuan->item }}</td>
                                    <td>{{ $dataPengajuan->qty }}</td>
                                    @if ($dataPengajuan->matauang == 'RP')
                                    <td>RP.{{ number_format(  $dataPengajuan->unit_price )}}</td>
                                    <td>RP.{{ number_format( $dataPengajuan->total )}}</td>
                                    @endif
                                    @if ($dataPengajuan->matauang == 'USD')
                                    <td>$ {{ number_format(  $dataPengajuan->unit_price )}}</td>
                                    <td>$ {{ number_format( $dataPengajuan->total )}}</td>
                                    @endif
                                    <td>
                                        <a href="{{ url('/pengajuan-pembelian/edit/' . $data_pd->id . '/' . $dataPengajuan->id) }}"
                                            class="btn shadow btn-outline-info">Edit</a>
                                        <a href="{{ url('/pengajuan-pembelian/destroy/' . $dataPengajuan->id) }}"
                                            class="btn shadow btn-outline-danger"
                                            onclick="return confirm ('Are you sure want to delete this item?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#formAdd').on('submit', function() {
                    $('#btnAdd').prop('disabled', true);
                })
            })
        </script>
    </section>
@endsection
