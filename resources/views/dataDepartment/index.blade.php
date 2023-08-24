<title>Data Department</title>

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
                        <div class="modal-body mx-5 mb-3 text-center">
                            <span class="warning">
                                <img src="{{ asset('assets/images/warning.png') }}">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/department/destroy/' . $a->id) }}">
                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Department</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Department</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/department/create/') }}" class="btn btn-primary mb-3"></i> Add <i
                                    class="fa fa-plus"></i></a>
                                    <div class="pull-right">
                                        <form action="{{ route('department.SearchDepartment') }}" method="get"
                                            class="input-group">
                                            <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                                value="{{ old('cari') }}">
                                            <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                                    value="Go"></span>
                                        </form>
                                    </div>
                            <div class="table-responsive">
                                <table class="table table-striped" >
                                    <thead class="bg-primary">
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                        @endphp
                                        @foreach ($data as $ws)
                                            <tr>
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>{{ $ws->name }}</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;"
                                                        href="{{ url('/department/edit/' . $ws->id) }}"><i
                                                            class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                    {{-- <button class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $ws->id }}"><i
                                                            class="fa fa-trash-o" title="Delete."></i></button> --}}
                                                </td>

                                            </tr>
                                            {{-- @endif --}}
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection
