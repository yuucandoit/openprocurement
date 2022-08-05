<title>Pengajuan Pembelian</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h1>Purchase Submission</h1>
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
                                    <th>PR.NO</th>
                                    <th>Date Submission</th>
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
                $('#formAdd').on('submit', function() {
                    $('#btnAdd').prop('disabled', true);
                })
            })
        </script>
    </section>
@endsection
