<title>History Payment Process</title>

@extends('layouts.master')

@section('main')
    <section>
         <!-- Page Sidebar Ends-->
         <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Payment Process</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Payment Process</li>
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-pengajuan-dana.SearchHistoryPD') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th>Name</th>
                                            <th style="text-align: center; white-space:nowrap;">Send To</th>
                                            <th style="text-align: center; white-space:nowrap;">Deadline</th>
                                            <th style="text-align: center;">Date</th>
                                            <th style="text-align: center;">Status</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $approvedPPB = [];
                                    @endphp

                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Paid'||
                                                $ppb->status == 'Delivery Process'||
                                                $ppb->status == 'Delivery Success')
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td>
                                                    <a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight: 600;"> {{ $ppb->whosubmit->name }}</li>
                                                            <li style="margin-top: 8px;"> {{ $ppb->desc }}</li>
                                                        </ul>
                                                    </a>
                                                    </td>
                                                    <td style="text-align: center;">{{ $ppb->send_to }}</td>
                                                    <td style="text-align: center; white-space:nowrap;">
                                                        <ul>
                                                            <li>
                                                                @if($ppb->dateline == '≤24Jam')
                                                                <strong><p>1 Hari</p></strong>
                                                                @elseif ($ppb->dateline == '≤72Jam')
                                                                <strong><p>2 sd 3 Hari</p></strong>
                                                                @elseif ($ppb->dateline == '≤168Jam')
                                                                <strong><p>4 sd 7 Hari</p></strong>
                                                                @elseif ($ppb->dateline == '≤336Jam')
                                                                <strong><p>7 sd 14 Hari</p></strong>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td style="text-align: center;">{{ $ppb->created_at }}</td>
                                                    @hasrole('finance|super admin')
                                                        <td style="text-align: center">
                                                            <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:12">{{ $ppb->status }}</a>
                                                        </td>

                                                        <td>
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td>
                                                    @endhasrole
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
        <script>
            $(document).ready(function() {

                $('.servideletebtn').click(function(e) {
                    e.preventDefault();
                    alert('hello');
                });

            });
        </script>
    </section>
@endsection
