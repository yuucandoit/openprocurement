<title>History Purchase Request Fail</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Purchase Request Fail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Purchase Request Fail</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">History Purchase Request Fail</h5>
                            </div>

                        <div class="box-header mt-4">
                            <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                <form action="{{ route('menu-pengajuan-pembelian.SearchHistoryFailPRQ') }}" method="get"
                                    class="input-group">
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                        value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                            value="Go"></span>
                                </form>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="bg-primary">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Who Filed</th>
                                                <th>Description</th>
                                                {{-- <th>Progress</th> --}}
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                                $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            @endphp
                                            @foreach ($datappb as $ppembelian)
                                                @if ($ppembelian->status == 'Rejected by Purchasing'||
                                                    $ppembelian->status == 'Purchase Request Rejected By BOD' ||
                                                    $ppembelian->status == 'Rejected by Finance'||
                                                    $ppembelian->status == 'PO Rejected by BOD' ||
                                                    $ppembelian->status == 'Payment Rejected By BOD')
                                                    <tr>
                                                        <td style="text-align: center;">{{ $i++ }}</td>
                                                        <td style="text-align: center;">{{ $ppembelian->date_ps }}</td>
                                                        <td style="text-align: center;">{{ $ppembelian->whosubmit->name }}
                                                        </td>
                                                        <td><a href="{{ $ppembelian->desc }}"
                                                                target="_blank">{{ $ppembelian->desc }}</a></td>
                                                        @hasrole('user|super admin')
                                                            <td style="text-align: center">
                                                                <ul>
                                                                @if ($ppembelian->status == 'Rejected by Purchasing')
                                                                <li>
                                                                <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Purchase</a>
                                                                </li>

                                                                <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8">{{  $ppembelian->note_purchase }}</a>
                                                                </li>
                                                                @endif


                                                                @if ($ppembelian->status == 'Purchase Request Rejected By BOD')
                                                                    @if(empty( $ppembelian->bod->name))
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod</a>
                                                                    </li>
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8"> - </a>
                                                                    </li>
                                                                    @else
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod {{ $ppembelian->bod->name }}</a>
                                                                    </li>
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8"> {{ $ppembelian->note_bod_pr }} </a>
                                                                    </li>
                                                                    @endif
                                                                {{-- <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->bod->name }} )</a> --}}
                                                                @endif

                                                                @if ($ppembelian->status == 'Payment Rejected By BOD')
                                                                    @if(empty( $ppembelian->atasanpymnt->name))
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod</a>
                                                                    </li>
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8"> - </a>
                                                                    </li>
                                                                    @else
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod {{ $ppembelian->atasanpymnt->name }}</a>
                                                                    </li>
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8"> {{ $ppembelian->note_bod_py }} </a>
                                                                    </li>
                                                                    @endif
                                                                {{-- <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->atasanpymnt->name }} )</a> --}}
                                                                @endif

                                                                @if ($ppembelian->status == 'PO Rejected By BOD')
                                                                    @if(empty( $ppembelian->atasans->name))
                                                                <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod</a>
                                                                </li>
                                                                    <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8"> - </a>
                                                                </li>
                                                                    @else
                                                                <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod {{ $ppembelian->atasans->name }}</a>
                                                                </li>
                                                                <li>
                                                                    <a class="badge bg-danger mt-1" style="color: white; font-size:8"> {{ $ppembelian->note_bod_po }}</a>
                                                                </li>
                                                                    @endif
                                                                {{-- <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->atasans->name }} )</a> --}}
                                                                @endif

                                                                @if($ppembelian->status == 'Rejected by Finance')
                                                                <li>
                                                                <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Finance</a>
                                                                </li>
                                                                <li>
                                                                <a class="badge bg-danger mt-1" style="color: white; font-size:8">{{  $ppembelian->note_finance }}</a>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                            </td>

                                                        @endhasrole

                                                        {{-- <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-pengajuan-pembelian/detail/' . $ppembelian->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                            @if ($ppembelian->status == 'Awaiting Purchase Submission Approval')
                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #FF8C00;"
                                                                    href="{{ url('/menu-pengajuan-pembelian/edit/' . $ppembelian->id) }}"><i
                                                                        class="icon-pencil-alt" title="Edit"></i>
                                                                </a>
                                                            @else
                                                            @endif
                                                            <button class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                                data-bs-target="#modalDelete{{ $ppembelian->id }}"><i
                                                                    class="icon-trash" title="Delete"></i>
                                                            </button>
                                                        </td> --}}

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
                        <!-- Container-fluid Ends-->
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
