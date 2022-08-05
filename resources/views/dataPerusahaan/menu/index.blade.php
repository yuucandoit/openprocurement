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
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Perusahaan"
                                        name="nama">
                                    <label for="floatingName">Nama Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingAlamat"
                                        placeholder="Alamat" name="alamat">
                                    <label for="floatingAlamat">Alamat</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="Contact Kantor" name="no_telp_kantor">
                                    <label for="floatingNoTelpon">Contact Kantor</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="Website" name="website">
                                    <label for="floatingNoTelpon">Website</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="Nama PIC" name="nama_pic">
                                    <label for="floatingNoTelpon">Nama PIC</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="Contact PIC" name="no_telp_pic">
                                    <label for="floatingNoTelpon">Contact PIC</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="email" class="form-control mt-4 mb-4" id="floatingEmail"
                                        placeholder="Email" name="email">
                                    <label for="floatingEmail">Email</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="npwp_perusahaan" name="npwp_perusahaan">
                                    <label for="floatingNoTelpon">NPWP</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingPKP" placeholder="PKP" name="Pkp" >
                                        <option value="PKP">PKP</option>
                                        <option value="Non-PKP">Non-PKP</option>
                                    </select>
                                    <label for="floatingPKP">-- PKP / NON-PKP --</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="NIB" name="nib">
                                    <label for="floatingNoTelpon">NIB</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="bidang usaha" name="bidang_usaha">
                                    <label for="floatingNoTelpon">Bidang</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="No Rek" name="no_rekening">
                                    <label for="floatingNoTelpon">No Rekening</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
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
                                    <label for="floatingUnit">-- Bank --</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingCabangBank"
                                        placeholder="Penerima" name="cabang_bank">
                                    <label for="floatingCabangBank">Cabang Bank</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="Penerima" name="nama_penerima">
                                    <label for="floatingNoTelpon">Penerima</label>
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



        <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h1>Data Perusahaan</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add+</button>
                                <a
                                href={{ url('/export_excel/perusahaan/' ) }}
                                    class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a>
                                    <a href={{ url('file-import-pt') }} class="btn btn-danger mb-3 mr-1" style="align-self: flex-end"> Import From Excel</a>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th >Alamat</th>
                                    <th>Contact Kantor</th>
                                    <th>Website</th>
                                    {{-- <th>Nama PIC</th>
                                    <th>Contact PIC</th>
                                    <th>Email</th>
                                    <th>NPWP PT</th>
                                    <th>PKP</th>
                                    <th>NIB</th>
                                    <th>Bidang Usaha</th>
                                    <th>No_rekening</th>
                                    <th>Bank</th>
                                    <th>Nama Penerima</th>
                                    <th>Created At</th>
                                    <th>Actions</th> --}}
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
                                @foreach ($datadv as $vendor)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $vendor->nama }}</td>
                                        <td >{{ $vendor->alamat }}</td>
                                        <td>{{ $vendor->no_telp_kantor }}</td>
                                        <td><a href="{{ $vendor->website }}">{{ $vendor->website }}</a></td>
                                        {{-- <td>{{ $vendor->nama_pic }}</td>
                                        <td>{{ $vendor->no_telp_pic }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->npwp_perusahaan }}</td>
                                        <td>{{ $vendor->Pkp }}</td>
                                        <td>{{ $vendor->nib }}</td>
                                        <td>{{ $vendor->bidang_usaha }}</td>
                                        <td>{{ $vendor->no_rekening }}</td>
                                        <td>{{ $vendor->bank }}</td>
                                        <td>{{ $vendor->nama_penerima    }}</td> --}}
                                        {{-- <td>{{ $vendor->created_at }}</td> --}}
                                        @hasrole('admin|super admin')

                                        @endhasrole
                                        <td>
                                <a href="{{ url('/perusahaan/detail/' . $vendor->id) }}" class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                <a href="{{ url('/menu-perusahaan/edit/' . $vendor->id) }}"
                                    class="btn btn-outline-warning"><i class="bx bxs-edit"></i> Edit</a>
                                 <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                 data-bs-target="#modalDelete{{ $vendor->id }}">Delete</button>
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
