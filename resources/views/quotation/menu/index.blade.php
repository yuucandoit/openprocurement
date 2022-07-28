<title>Quotation</title>
@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('/menu-quotation/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-2" id="floatingName"
                                        placeholder="Your Name" name="company_name">
                                    <label for="floatingName">Company Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingAddress"
                                        placeholder="Address" name="address">
                                    <label for="floatingAddress">Address</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($dataqt as $a)
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
                            <form action="{{ url('/menu-quotation/destroy/' . $a->id) }}">
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
                    <h1>Quotation</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add</button>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    @hasrole('admin|super admin')
                                        <th>Status</th>
                                    @endhasrole
                                    <th>Action</th>
                                    @hasrole('admin|super admin')
                                        <th>Accept</th>
                                        <th>Reject</th>
                                    @endhasrole
                                    @hasrole('user')
                                        <th>Status</th>
                                    @endhasrole
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody>
                                @foreach ($dataqt as $quotation)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $quotation->company_name }}</td>
                                        <td>{{ $quotation->address }}</td>
                                        <td>{{ $quotation->created_at }}</td>
                                        @hasrole('admin|super admin')
                                            <td>
                                                <b>{{ $quotation->status }}</b>
                                            </td>
                                        @endhasrole
                                        <td>
                                            <a href="{{ url('/quotation/' . $quotation->id) }}"
                                                class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $quotation->id }}">Delete</button>
                                        </td>
                                        @hasrole('admin|super admin')
                                            @if ($quotation->status == 'Accepted')
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-success" onclick="return"><b>Accepted</b></a>
                                                </td>
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-danger" onclick="return">Reject</a>
                                                </td>
                                            @elseif($quotation->status == 'pending')
                                                <td>
                                                    <a href="{{ url('menu-quotation/accept', $quotation->id) }}"
                                                        class="btn btn-success" onclick="return">Accept</a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('menu-quotation/Reject', $quotation->id) }}"
                                                        class="btn btn-danger" onclick="return">Reject</a>
                                                </td>
                                            @else
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-success" onclick="return">Accept</a>
                                                </td>
                                                <td>
                                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                        class="btn btn-danger" onclick="return"><b>Rejected</b></a>
                                                </td>
                                            @endif
                                        @endhasrole
                                        @hasrole('user')
                                            <td> <a class="badge {{ $quotation->status == 'pending' ? 'bg-warning' : ($quotation->status == 'Accepted' ? 'bg-success' : 'bg-danger') }} mt-1"
                                                    style="color: white; font-size:18">{{ $quotation->status }}</a></td>
                                        @endhasrole
                                    </tr>
                                @endforeach
                            </tbody>
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
