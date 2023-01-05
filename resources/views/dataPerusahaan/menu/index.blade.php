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
                    <form action={{ url('/menu-perusahaan/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingName"><i class="fa fa-building-o"></i> Company Name</label>
                                        <input required type="text" class="form-control" id="floatingName"
                                            placeholder="Perusahaan" name="nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingAlamat"><i class="icon-location-pin"></i> Address</label>
                                        <input required type="text" class="form-control" id="floatingAlamat"
                                            placeholder="Alamat" name="alamat">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-telephone"></i> Office
                                            Contact</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="Contact Kantor" name="no_telp_kantor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="fa fa-link"></i> Website</label>
                                        <input type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="Website" name="website">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> PIC
                                            Name</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="Nama PIC" name="nama_pic">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-support"></i> Contact
                                            PIC</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="Contact PIC" name="no_telp_pic">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingEmail"><i class="icofont icofont-email"></i> Email</label>
                                        <input required type="email" class="form-control" id="floatingEmail"
                                            placeholder="Email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> Company
                                            NPWP</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="npwp_perusahaan" name="npwp_perusahaan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingPKP"><i class="icofont icofont-paper"></i> -- PKP / NON-PKP
                                            --</label>
                                        <select class="form-select" id="floatingPKP" placeholder="PKP" name="Pkp">
                                            <option value="PKP">PKP</option>
                                            <option value="Non-PKP">Non-PKP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="icofont icofont-id-card"></i> NIB</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="NIB" name="nib">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="fa fa-briefcase"></i> Business
                                            Field</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="bidang usaha" name="bidang_usaha">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="fa fa-credit-card"></i> Account
                                            Number</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="No Rek" name="no_rekening">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingUnit"><i class="fa fa-bank"></i> -- Bank --</label>
                                        <select class="form-select" id="floatingUnit" placeholder="Bank" name="bank">
                                            <option value="BCA(014)">BCA(014)</option>
                                            <option value="Mandiri(008)">Mandiri(008)</option>
                                            <option value="BNI(009)">BNI(009)</option>
                                            <option value="BRI(002)">BRI(002)</option>
                                            <option value="BTN(200)">BTN(200)</option>
                                            <option value="Danamon(011)">Danamon(011)</option>
                                            <option value="Permata(013)">Permata(013)</option>
                                            <option value="Maybank(016)">Maybank(016)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingCabangBank"><i class="fa fa-code-fork"></i> Bank
                                            Branch</label>
                                        <input required type="text" class="form-control" id="floatingCabangBank"
                                            placeholder="Penerima" name="cabang_bank">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="fa fa-user"></i> Recipient's Name</label>
                                        <input required type="text" class="form-control" id="floatingNoTelpon"
                                            placeholder="Penerima" name="nama_penerima">
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
                            <form action="{{ url('/menu-perusahaan/destroy/' . $a->id) }}">
                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($datadv as $a)
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
                            <form action="{{ url('/menu-perusahaan/destroy/' . $a->id) }}">
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
                        <h3>Data Company</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Company</li>
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
                            <h5>List Of Company Data</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                    class="bx bx-list-plus"></i> Add <i class="fa fa-plus"></i></button>
                            <a href={{ url('/export_excel/perusahaan/') }} class="btn btn-success mb-3 mr-1"
                                style="align-self: flex-end"><i class="icon-export"></i> Export to Excel</a>
                            <a href={{ url('file-import-pt') }} class="btn btn-danger mb-3 mr-1"
                                style="align-self: flex-end"><i class="icon-import"></i> Import From Excel</a>
                            <div class="pull-right">
                                <form action="{{ route('menu-perusahaan.SearchPT') }}" method="get"
                                            class="input-group">
                                            <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                                value="{{ old('cari') }}">
                                            <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                                    value="Go"></span>
                                        </form>
                                    </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-primary">
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>Contact Kantor</th>
                                            <th>Website</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $i = 1 + $admin->currentPage() * $admin->perPage() - $admin->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($datadv as $vendor)
                                            <tr>
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>{{ $vendor->nama }}</td>
                                                <td>{{ $vendor->alamat }}</td>
                                                <td>{{ $vendor->no_telp_kantor }}</td>
                                                <td><a href="{{ $vendor->website }}">{{ $vendor->website }}</a></td>
                                                @hasrole('admin|super admin')
                                                @endhasrole
                                                <td>
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                        href="{{ url('/perusahaan/detail/' . $vendor->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;"
                                                        href="{{ url('/menu-perusahaan/edit/' . $vendor->id) }}"><i
                                                            class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $vendor->id }}"><i
                                                            class="icon-trash" title="Delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $datadv->withQueryString()->links('pagination::bootstrap-5') }}
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
