<title>Data Vendor</title>

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
                    <form action={{ url('/menu-private-person/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingName"><i class="fa fa-user"></i> Full Name</label>
                                        <input type="text" class="form-control" id="floatingName" placeholder="Name"
                                            name="nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingAlamat"><i class="icon-location-pin"></i> Address</label>
                                        <input required type="text" class="form-control" id="floatingAlamat"
                                            placeholder="Address" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> NIK</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="NIK" name="nik">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> NPWP</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="npwp_private_person" name="npwp_pp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingPKP"><i class="icofont icofont-paper"></i> -- PKP / NON-PKP
                                            --</label>
                                        <select class="form-select" id="floatingPKP" placeholder="PKP" name="pkp">
                                            <option value="PKP">PKP</option>
                                            <option value="Non-PKP">Non-PKP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>


        @foreach ($datadv as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                            <span class="warning">
                                <img src="assets/images/warning.png">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/menu-private-person/destroy/' . $a->id) }}">
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
                        <h3>Data Private Person</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Private Person</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>List Of Private Person Data</h5>
                        </div>
                        <div class="card-body" style="text-align: right;">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"> Add
                                <i class="fa fa-plus"></i></button>
                            <a href={{ url('/export_excel/private_person') }} class="btn btn-success mb-3 mr-1"
                                style="align-self: flex-end"><i class="icon-export"></i> Export to Excel</a>
                            <a href={{ url('file-import-pp') }} class="btn btn-danger mb-3 mr-1"
                                style="align-self: flex-end"><i class="icon-import"></i> Import From Excel</a>
                            <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>No</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>NIK</th>
                                            <th>NPWP</th>
                                            <th>PKP</th>
                                            <th>Action</th>
                                            @hasrole('admin|super admin')
                                            @endhasrole

                                            @hasrole('admin|super admin')
                                            @endhasrole
                                            @hasrole('user')
                                            @endhasrole
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($datadv as $person)
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td>{{ $person->nama }}</td>
                                                <td>{{ $person->alamat }}</td>
                                                <td>{{ $person->nik }}</td>
                                                <td>{{ $person->npwp_pp }}</td>
                                                <td>{{ $person->pkp }}</td>
                                                @hasrole('admin|super admin')
                                                @endhasrole
                                                <td>

                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                        href="{{ url('/private-person/detail/' . $person->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;"
                                                        href="{{ url('/menu-private-person/edit/' . $person->id) }}"><i
                                                            class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $person->id }}"><i
                                                            class="icon-trash" title="Delete"></i>
                                                    </button>
                                                </td>
                                                {{-- @hasrole('admin|super admin')
                                        @if ($vendor->status == 'Accepted')
                                            <td>
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                    class="btn btn-success" onclick="return"><b>Accepted</b></a>
                                            </td>
                                            <td>
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                    class="btn btn-danger" onclick="return">Reject</a>
                                            </td>
                                        @elseif($purchase->status == 'pending')
                                            <td>
                                                <a href="{{ url('menu-purchase-order/accept', $purchase->id) }}"
                                                    class="btn btn-success" onclick="return">Accept</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('menu-purchase-order/Reject', $purchase->id) }}"
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
                                        <td> <a class="badge {{ $purchase->status == 'pending' ? 'bg-warning' : ($purchase->status == 'Accepted' ? 'bg-success' : 'bg-danger') }} mt-1"
                                                style="color: white; font-size:18">{{ $purchase->status }}</a></td>
                                    @endhasrole --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
                <script>
                    $(document).ready(function() {

                        $('.servidelet  ebtn').click(function(e) {
                            e.preventDefault();
                            alert('hello');
                        });

                    });
                </script>
    </section>
@endsection
