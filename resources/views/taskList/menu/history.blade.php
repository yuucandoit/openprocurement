<title>History Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Task List Purchasing</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">History Task List Purchase order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-task-list.SearchtaskPOHistory') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-header bg-primary">
                            <h5>History Task List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Request By</th>
                                            <th>Item</th>
                                            <th>Deadline</th>
                                            <th>Approved At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Purchase Proses' ||
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td> <a href="{{ url('/menu-task-list/detail/' . $ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                            <li style="width: 40%;">{{ $ppb->desc }}</li>
                                                        </ul>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @foreach ($ppb->itemppn as $item)
                                                        <ul>
                                                            <li style="margin-top:4px; word-break:break-all;">-{{ $item->item }}</li>
                                                        </ul>
                                                        @endforeach
                                                    </td>
                                                    <td style="text-align: center;">
                                                       <ul>
                                                        <li style="white-space: nowrap;">@if($ppb->dateline == '≤24Jam')
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
                                                    <td style="text-align: center;">{{ $ppb->approved_at }}</td>
                                                    <td style="text-align: center;">
                                                        <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1 "
                                                            style="color: white; font-size:12">{{ $ppb->status }}</a>
                                                    </td>
                                                    <td style="text-align: center; white-space:nowrap;">
                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #0014FF;"
                                                        href="{{ url('/exportpdf/ppb/' . $ppb->id) }}"><i
                                                            class="icon-eye" title="Preview PDF Purchase request"></i>
                                                        </a>

                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #B1D0E0;"
                                                        href="{{ url('/exportpdf/po/' . $ppb->id) }}"><i
                                                            class="icon-eye" title="Preview Purchase Order"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1"
                                                    style="background-color: #c713e7;"
                                                    href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}"><i
                                                        class="icon-eye" title="Preview PDF"></i>
                                                     </a>
                                                    </td>
                                                </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
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

                            $('.servidelet  ebtn').click(function(e) {
                                e.preventDefault();
                                alert('hello');
                            });

                        });
                    </script>
                </section>
            @endsection
