<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        @foreach ($dv as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3 text-center">
                            <span class="warning">
                                <img src="{{ asset('assets/images/warning.png') }}">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/data-vendor/destroy/' . $a->id) }}">
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
                    <h1>{{ $data_vendor->nama }}</h1>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                        @hasrole('user|super admin |admin')
                            <a href="{{ url('data-vendor/create/' . $data_vendor->id) }}" class="btn btn-primary mb-3"><i
                                    class="bx bx-list-plus"></i> Add+</a>
                        @endhasrole
                        {{-- @if ($data_vendor->status == 'Accepted') --}}
                        <a href={{ url('/export_excel/vendor/' . $data_vendor->id) }} class="btn btn-success mb-3 mr-1"
                            style="align-self: flex-end"> Export to Excel</a>
                        {{-- @endif --}}
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NPWP</th>
                                    <th>Pkp</th>
                                    <th>Type of Business</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $serial = 1;
                                $i = 1 + $datadv->currentPage() * $datadv->perPage() - $datadv->perPage();
                            @endphp
                            @foreach ($dv as $dataVendor)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $dataVendor->npwp }}</td>
                                    <td>{{ $dataVendor->Pkp }}</td>
                                    <td>{{ $dataVendor->jenis_usaha }}</td>
                                    <td>
                                        <a href="{{ url('/data-vendor/show/' . $data_vendor->id . '/' . $dataVendor->id) }}"
                                            class="btn btn-outline-info"><i class="bx bxs-edit"></i> Edit</a>
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $dataVendor->id }}">Delete</button>
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
