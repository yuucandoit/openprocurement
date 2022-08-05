<title>Pengajuan dana</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ url('menu-pengajuan-dana/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row modal-body container">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-2" id="floatingSubject"
                                        placeholder="Subject" name="subject">
                                    <label for="floatingSubject">Subject</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input required type="date"
                                        class="form-control @error('created_at') is-invalid @enderror mt-2"
                                        id="floatingTanggal" placeholder="Tanggal" name="created_at"
                                        value="{{ old('created_at', date('Y-m-d')) }}">
                                    <label for="floatingTanggal">Date</label>
                                    @error('created_at')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-2" id="floatingName"
                                        placeholder="Nama  Pemohon" name="name">
                                    <label for="flaotingName">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input required type="varchar" class="form-control mt-2" id="floatingTujuan"
                                        placeholder="Tujuan" name="tujuan">
                                    <label for="floatingTujuan">Purpose</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input required type="varchar" class="form-control mt-2" id="floatingLokasi"
                                        placeholder="Lokasi" name="lokasi">
                                    <label for="floatingLokasi">Location</label>
                                </div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="form-floating">
                                    <input required type="date" class="form-control mt-2" id="floatingJangkaWaktu"
                                        placeholder="Jangka Waktu" name="jangka_waktu">
                                    <label for="floatingJangkaWaktu">Period of Time</label>
                                </div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="form-floating">
                                    <input required type="number" class="form-control mt-2" id="floatingNominal"
                                        placeholder="Nominal" name="nominal">
                                    <label for="floatingNominal">Nominal</label>
                                </div>
                            </div>
                            <div class="col-4 mb-4">
                                <div class="form-floating">
                                    <input required type="number" class="form-control mt-2" id="floatingNoRek"
                                        placeholder="No Rekening" name="no_rek">
                                    <label for="floatingNoRek">No Rekening</label>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($datapd as $a)
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
                            <form action="{{ url('/menu-pengajuan-dana/destroy/' . $a->id) }}">
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
                    <h1>Fund Submisson</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">

                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add</button>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subject</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Tujuan</th>
                                    <th>Lokasi</th>
                                    <th>Jangka waktu</th>
                                    <th>Nominal</th>
                                    <th>No Rek</th>
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
                            @foreach ($datapd as $pengajuan)
                                {{-- @php
                                dd($categorypd);
                            @endphp --}}
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pengajuan->subject }}</td>
                                    <td>{{ $pengajuan->name }}</td>
                                    <td>{{ $pengajuan->created_at }}</td>
                                    <td>{{ $pengajuan->tujuan }}</td>
                                    <td>{{ $pengajuan->lokasi }}</td>
                                    <td>{{ $pengajuan->jangka_waktu }}</td>
                                    <td>{{ $pengajuan->nominal }}</td>
                                    <td>{{ $pengajuan->no_rek }}</td>
                                    @hasrole('admin|super admin')
                                        <td>
                                            <b>{{ $pengajuan->status }}</b>
                                        </td>
                                    @endhasrole
                                    <td>
                                        <a href="{{ url('/pengajuan-dana/' . $pengajuan->id) }}"
                                            class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $pengajuan->id }}">Delete</button>
                                    </td>
                                    @hasrole('user')
                                        <td> <a class="badge {{ $pengajuan->status == 'pending' ? 'bg-warning' : ($pengajuan->status == 'Accepted' ? 'bg-success' : 'bg-danger') }} mt-1"
                                                style="color: white; font-size:18">{{ $pengajuan->status }}</a></td>
                                    @endhasrole
                                    @hasrole('admin|super admin')
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
                                </tr>
                            @endforeach
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
