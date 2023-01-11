<title>Payment Process</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Payment Process Out</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payment Process Out</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-pengajuan-dana.SearchPDOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr >
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            {{-- <th>Send To</th> --}}
                                            <th>Deadline</th>
                                            @hasrole('finance|super admin')
                                                <th style="text-align: center;">Status</th>
                                            @endhasrole
                                            <th style="text-align: center;">Function</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                         $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Paid'||
                                                $ppb->status == 'Delivery Process'||
                                                $ppb->status == 'Delivery Success')
                                                @php $approvedPPB[] =$ppb; @endphp
                                                <tr>
                                                    <td style="text-align: center;">{{ $i++ }}</td>
                                                    <td>{{ $ppb->whosubmit->name }}</td>
                                                    <td><a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                    {{-- <td>{{ $ppb->send_to }}</td> --}}
                                                    <td style="white-space: nowrap;">
                                                        @if($ppb->dateline == '≤24Jam')
                                                        <strong><p>1 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤72Jam')
                                                        <strong><p>2 sd 3 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤168Jam')
                                                        <strong><p>4 sd 7 Hari</p></strong>
                                                        @elseif ($ppb->dateline == '≤336Jam')
                                                        <strong><p>7 sd 14 Hari</p></strong>
                                                        @endif
                                                    </td>
                                                    @hasrole('finance|super admin')
                                                        <td>
                                                            <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:10">{{ $ppb->status }}</a>
                                                        </td>

                                                        <td style="text-align: center">
                                                            <a class="btn btn-iconsolid mt-1"
                                                            style="background-color: #ADD8E6;font-size:10;"
                                                            href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}" target="_blank"><i
                                                                class="icon-eye" title="Preview PDF"></i>
                                                            </a>
                                                            {{-- <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B; font-size:10;"
                                                                href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a> --}}

                                                            {{-- <button class="btn btn-iconsolid mt-1" data-bs-toggle="modal"
                                                                style="background-color: #ff0000; font-size:10;"
                                                                data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                    class="icon-trash" title="Delete"></i>
                                                            </button> --}}
                                                        </td>
                                                    @endhasrole
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
    </section>
@endsection
