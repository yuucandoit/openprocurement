<title>Quotation</title>
@extends('layouts.master')

@section('main')
    <section>

        @foreach ($data as $a)
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
                            <form action="{{ url('/quotation/destroy/' . $a->id) }}">
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
                    <h1>{{ $data_company->company_name }}</h1>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                        @hasrole('user|super admin|purchasing')
                            <a href="{{ url('quotation/create/' . $data_company->id) }}" class="btn btn-primary mb-3"
                                style="align-self: flex-end"><i class="bx bx-list-plus"></i> Add+</a>
                        @endhasrole
                        @if ($data_company->status == 'Accepted')
                            <a href={{ url('/export_excel/quotation/' . $data_company->id) }}
                                class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a>
                        @endif
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Unit Price (Rp)</th>
                                    <th>Amount (Rp)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $dataQuotation)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dataQuotation->type }}</td>
                                    <td>{{ $dataQuotation->qty }}</td>
                                    <td>{{ $dataQuotation->unit }}</td>
                                    <td>{{ $dataQuotation->unitprice }}</td>
                                    <td>{{ $dataQuotation->amount }}</td>
                                    <td>
                                        <a href="{{ url('/quotation/show/' . $data_company->id . '/' . $dataQuotation->id) }}"
                                            class="btn btn-outline-info"> <i class="bx bxs-edit"></i> Edit</a>
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $dataQuotation->id }}">Delete</button>
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
