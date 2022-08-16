<title>Pengajuan Pembelian</title>

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
                    <form action={{ url('/menu-pengajuan-pembelian/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row modal-body container">
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-2" id="floatingPKP" placeholder="Company" name="pt_id">
                                        @foreach ($datapt as $pt)
                                        <option value="{{ $pt->id }}">{{ $pt->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingPKP">-- Company --</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input required type="date"
                                        class="form-control @error('date_ps') is-invalid @enderror mt-2 "
                                        id="floatingTanggal" placeholder="Tanggal" name="date_ps"
                                        value="{{ old('date_ps', date('Y-m-d')) }}">
                                    <label for="floatingTanggal">Date</label>
                                    @error('date_ps')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select mt-2" id="floatingdateline" placeholder="Dateline" name="dateline" >
                                        <option value="Urgent">Urgent</option>
                                        <option value="≤3Jam">≤ 3 Jam</option>
                                        <option value="≤24Jam">≤ 24 Jam</option>
                                        <option value="≤2Hari">≤ 2 Hari</option>
                                        <option value="SesuaiPo">Sesuai PO</option>
                                    </select>
                                    <label for="floatingdateline">-- Date Line --</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4" id="floatingws"
                                        placeholder="Who Submitted" name="ws">
                                    <label for="floatingws">Who Submitted</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="Purpose" name="purpose">
                                    <label for="floatingNoTelpon">Purpose</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingitem"
                                        placeholder="Item" name="item">
                                    <label for="floatingitem">Item</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingNoTelpon"
                                        placeholder="Quantity" name="qty">
                                    <label for="floatingNoTelpon">Qty</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingEmail"
                                        placeholder="PricePerUnit" name="priceperunit">
                                    <label for="floatingEmail">Price/Unit</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingNoTelpon"
                                        placeholder="Ref" name="ref">
                                    <label for="floatingNoTelpon">Ref</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="desc" name="desc">
                                    <label for="floatingNoTelpon">Description</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="bidang usaha" name="send_to">
                                    <label for="floatingNoTelpon">Send To</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="PS" name="proposed_supplier">
                                    <label for="floatingNoTelpon">Proposed Supplier</label>
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
                        <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}">
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
                            <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}">
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
                    <h1>Pengajuan Pembelian</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add+</button>
                                {{-- <a
                                href={{ url('/export_excel/perusahaan/' ) }}
                                    class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a>
                                    <a href={{ url('file-import-pt') }} class="btn btn-danger mb-3 mr-1" style="align-self: flex-end"> Import From Excel</a> --}}

                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Company</th>
                                                <th>Date</th>
                                                <th>Who Filed</th>
                                                <th>Description</th>
                                                {{-- <th>Purpose</th>
                                                <th>Price Per Unit</th>
                                                <th>Sent to</th>
                                                <th>Delivery Date</th>
                                                <th>Suggested supplier</th> --}}
                                                @hasrole('admin|super admin')
                                                    <th>Status</th>
                                                @endhasrole
                                                <th>Action</th>
                                                @hasrole('user')
                                                    <th>status</th>
                                                @endhasrole
                                                @hasrole('admin|')
                                                    <th>Accept</th>
                                                    <th>Reject</th>
                                                @endhasrole
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datadv as $ppembelian)

                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $ppembelian->pt->nama }}</td>
                                                <td>{{ $ppembelian->date_ps }}</td>
                                                <td>{{ $ppembelian->ws }}</td>
                                                <td>{{ $ppembelian->desc }}</td>
                                                @hasrole('admin|super admin')
                                                   <td>
                                                        <b>{{ $ppembelian->status }}</b>
                                                    </td>
                                                @endhasrole
                                                <td>
                                                    <a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}"
                                                        class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                                        @if ($ppembelian->status == 'Accepted' )

                                                        @else
                                                        <a href="{{ url('/menu-pengajuan-pembelian/edit/' . $ppembelian->id) }}"
                                                            class="btn btn-outline-warning"><i class="bx bxs-edit"></i> Edit</a>
                                                        @endif



                                                    <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $ppembelian->id }}">Delete</button>
                                                </td>
                                                @hasrole('user|super admin')
                                                    <td> <a class="badge {{ $ppembelian->status == 'pending' ? 'bg-warning' : ($ppembelian->status == 'Accepted' ? 'bg-success' : 'bg-danger') }} mt-1"
                                                            style="color: white; font-size:18">{{ $ppembelian->status }}</a></td>
                                                @endhasrole

                                            </tr>
                                         @endforeach
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
