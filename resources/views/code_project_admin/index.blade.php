<title>Code Project</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Code Project</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Code Project</li>
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
                            <a href="{{ url('/project-code/create/') }}" class="btn btn-primary mb-3"></i> Add <i class="fa fa-plus"></i></a>
                            <div class="pull-right">
                                <form action="{{ route('project-reference.SearchProject') }}" method="get"
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
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $i = 1 + $list->currentPage() * $list->perPage() - $list->perPage();
                                        @endphp
                                        @foreach ($list as $cp)
                                            <tr>
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td style="text-align: center;"><strong>{{ $cp->project_code }}</strong></td>
                                                <td style="text-align: center;">
                                                    <a class="badge @if($cp->status == 'Waiting Approval') bg-warning @elseif($cp->status == 'Approved') bg-success @else bg-danger @endif mt-1">
                                                    {{ $cp->status }}
                                                    </a>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;"href="{{ url('/project-code/edit/' . $cp->id) }}">
                                                        <i class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $list->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
