<title>Purchase order</title>

@extends('layouts.master')

@section('main')
    <section>

        @foreach ($po as $a)
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
                            <form action="{{ url('/purchase-order/destroy/' . $a->id) }}">
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
                    <h1>{{ $data_company_po->nama }}</h1>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                        @hasrole('user|super admin')
                            <a href="{{ url('purchase-order/create/' . $data_company_po->id) }}"
                                class="btn btn-primary mb-3"><i class="bx bx-list-plus"></i> Add+</a>
                        @endhasrole
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($po as $dataPurchase)
                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $dataPurchase->keterangan }}</td>
                                    <td>{{ $dataPurchase->qty }}</td>
                                    <td>{{ $dataPurchase->unit }}</td>
                                    <td>{{ $dataPurchase->unit_price }}</td>
                                    <td>{{ $dataPurchase->amount }}</td>
                                    <td>
                                        <a href="{{ url('/purchase-order/show/' . $data_company_po->id . '/' . $dataPurchase->id) }}"
                                            class="btn btn-outline-info"><i class="bx bxs-edit"></i> Edit</a>
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $dataPurchase->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
