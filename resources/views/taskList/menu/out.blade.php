<title>Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datappb as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Task List Purchasing</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Task List Purchase order</li>
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
                                <form action="{{ route('menu-task-list.SearchtaskPOOut') }}" method="get" class="input-group" >
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
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Description</th>
                                            <th>Date Line</th>
                                            <th>Approved At</th>
                                            <th>Request By</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
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
                                            @php
                                            $approvedPPB[] =$ppb;

                                            @endphp
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;">{{ $i++ }}</td>
                                                    <td><a href="{{ url('menu-task-list/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                    <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                    <td style="text-align: center;">{{ $ppb->approved_at }}</td>
                                                    <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                    <td>
                                                        <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                            href="{{ url('menu-task-list/detail/' . $ppb->id) }}"><i
                                                                class="icon-zoom-in" title="Details"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
    <!-- Container-fluid starts-->
    </section>
@endsection

