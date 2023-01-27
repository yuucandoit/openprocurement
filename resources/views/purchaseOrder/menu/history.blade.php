<title>History Purchase order</title>

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
                    <form action={{ url('/menu-purchase-order/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-2" id="floatingName"
                                        placeholder="Your Name" name="name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingAddress"
                                        placeholder="Address" name="address">
                                    <label for="floatingAddress">Address</label>
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

        @foreach ($datappb as $purchase)
            <div class="modal fade" id="modalDelete{{ $purchase->id }}" tabindex="-1" aria-hidden="true">
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
                            <form action="{{ url('/menu-purchase-order/destroy/' . $purchase->id) }}">
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
                        <h3>History Purchase Order</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Purchase Order</li>
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
                        <div class="box-header mt-4">
                            <div style="width: 30%; margin-bottom:-20px; " class="pull-right">
                                <form action="{{ route('menu-purchase-order.SearchHistoryPO') }}" method="get"
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
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th>Name</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            @if (
                                                $ppb->status == 'Waiting For PO Approval' ||
                                                $ppb->status == 'Waiting For PO Approval' ||
                                                $ppb->status == 'PO Approved' ||
                                                $ppb->status == 'Invoicing Process' ||
                                                $ppb->status == 'Payment Approved' ||
                                                $ppb->status == 'Unpaid' ||
                                                $ppb->status == 'Paid' ||
                                                $ppb->status == 'Delivery Process' ||
                                                $ppb->status == 'Delivery Success')
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td>
                                                        <ul><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}">
                                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                            <li>{{ $ppb->desc }}</li>
                                                        </a></ul>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <ul>
                                                            <li style="white-space: nowrap;">
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
                                                    <td style="text-align: center;"><a class="badge badge-primary">{{ $ppb->status }}</a></td>
                                                    @hasrole('purchasing||super admin')
                                                        <td style="white-space: nowrap;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style=" font-size:10; background-color: #0014FF;"
                                                                href="{{ url('/exportpdf/ppb/' . $ppb->id) }}"><i
                                                                    class="icon-eye" title="Preview PDF Purchase request"></i>
                                                                </a>

                                                                <a class="btn btn-iconsolid mt-1"
                                                                style=" font-size:10; background-color: #B1D0E0;"
                                                                href="{{ url('/exportpdf/po/' . $ppb->id) }}"><i
                                                                    class="icon-eye" title="Preview Purchase Order"></i>
                                                            </a>
                                                            <a class="btn btn-iconsolid mt-1"
                                                            style=" font-size:10; background-color: #c713e7;"
                                                            href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}"><i
                                                                class="icon-eye" title="Preview PDF"></i>
                                                        </a>
                                                        </td>
                                                    @endhasrole
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
