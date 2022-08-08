<title>Purchase Submission</title>

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

                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-2 mb-2" id="floatingPKP" placeholder="No.Po" name="po_id">
                                        @foreach ($datapo as $po)
                                        <option value="{{ $po->id }}">{{ $po->id }}{{ \Carbon\Carbon::parse($po->from_date)->format('dmy') }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingPKP">-- No.Po --</label>
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
                                    <input required type="date"
                                        class="form-control @error('date_send') is-invalid @enderror mt-2 "
                                        id="floatingTanggal" placeholder="Tanggal" name="date_send"
                                        value="{{ old('date_send', date('Y-m-d')) }}">
                                    <label for="floatingTanggal">Date send</label>
                                    @error('date_send')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <select class="form-select mt-4" id="floatingPKP" placeholder="Who Submitted" name="ws" >
                                        <option value="GA">GA</option>
                                        <option value="Purchasing">Purchasing</option>
                                    </select>
                                    <label for="floatingPKP">-- Who Submitted --</label>
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
                    <h1>Purchase Submission</h1>
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
                                                <th>Company</th>
                                                <th>PR.Nomor</th>
                                                <th>Date</th>
                                                <th>Who Filed</th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Ref</th>
                                                <th>Description</th>
                                                <th>Purpose</th>
                                                <th>Price Per Unit</th>
                                                <th>Sent to</th>
                                                <th>Delivery Date</th>
                                                <th>Suggested supplier</th>
                                                @hasrole('admin|super admin')
                                                    <th>Status</th>
                                                @endhasrole
                                                <th>Action</th>
                                                @hasrole('user')
                                                    <th>status</th>
                                                @endhasrole
                                                @hasrole('admin|super admin')
                                                    <th>Accept</th>
                                                    <th>Reject</th>
                                                @endhasrole
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        {{-- @foreach ($data as $pengajuan) --}}
                                            {{-- @php
                                            dd($categorypd);
                                        @endphp --}}
                                            <tr>
                                                {{-- <td>{{ $no++ }}</td> --}}
                                                {{-- <td>{{ $pengajuan->subject }}</td> --}}
                                                {{-- <td>{{ $pengajuan->name }}</td> --}}
                                                {{-- <td>{{ $pengajuan->created_at }}</td> --}}
                                                {{-- <td>{{ $pengajuan->tujuan }}</td> --}}
                                                {{-- <td>{{ $pengajuan->lokasi }}</td> --}}
                                                {{-- <td>{{ $pengajuan->jangka_waktu }}</td> --}}
                                                {{-- <td>{{ $pengajuan->nominal }}</td> --}}
                                                {{-- <td>{{ $pengajuan->no_rek }}</td> --}}
                                                @hasrole('admin|super admin')
                                                    {{-- <td>
                                                        <b>{{ $pengajuan->status }}</b>
                                                    </td> --}}
                                                @endhasrole
                                                {{-- <td>
                                                    {{-- <a href="{{ url('/pengajuan-dana/' . $pengajuan->id) }}"
                                                        class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a> --}}
                                                    {{-- <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $pengajuan->id }}">Delete</button> --}}
                                                {{-- </td>  --}}
                                                @hasrole('user')
                                                    {{-- <td> <a class="badge {{ $pengajuan->status == 'pending' ? 'bg-warning' : ($pengajuan->status == 'Accepted' ? 'bg-success' : 'bg-danger') }} mt-1" --}}
                                                            style="color: white; font-size:18">{{ $pengajuan->status }}</a></td>
                                                @endhasrole
                                                {{-- @hasrole('admin|super admin')
                                                    @if ($pengajuan->status == 'Accepted')
                                                        <td>
                                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                                class="btn btn-success" onclick="return"><b>Accepted</b></a>
                                                        </td>
                                                        <td>
                                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                                class="btn btn-danger" onclick="return">Reject</a>
                                                        </td>
                                                    @elseif($pengajuan->status == 'pending')
                                                        <td>
                                                            <a href="{{ url('menu-pengajuan-dana/accept', $pengajuan->id) }}"
                                                                class="btn btn-success" onclick="return">Accept</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('menu-pengajuan-dana/Reject', $pengajuan->id) }}"
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
                                            </tr> --}}
                                        {{-- @endforeach --}}
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
