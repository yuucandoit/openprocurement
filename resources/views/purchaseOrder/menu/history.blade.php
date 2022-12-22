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
                    <div class="col-sm-6 mt-4">
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
                        <div class="card-header bg-primary">
                            <h5>History Purchase order</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="advance-1">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Send To</th>
                                            <th>Date Line</th>
                                            <th>Countdown</th>
                                            <th>Warning</th>
                                            @hasrole('purchasing|super admin')
                                                <th>Status</th>
                                            @endhasrole
                                            @hasrole('user')
                                                <th>Status</th>
                                            @endhasrole
                                            <th>Date</th>
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
                                                    <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                    <td style="text-align: center;">{{ $ppb->send_to }}</td>
                                                    @if ($ppb->status == 'Purchase Proses')

                                                    @else
                                                        <td> -/- </td>
                                                        <td> -/- </td>
                                                        <td> -/- </td>
                                                        <td> -/- </td>
                                                    @endif
                                                    <td style="text-align: center;">{{ $ppb->approved_at }}</td>
                                                    @hasrole('purchasing|super admin')
                                                        <td>
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
                                                            @if ($ppb->status == 'Purchase Proses')
                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #008000;"
                                                                    href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                        class="icon-file" title="Record Data"></i>
                                                                </a>

                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #FF8C00;"
                                                                    href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}"><i
                                                                        class="icon-pencil-alt" title="Edit"></i>
                                                                </a>
                                                            @endif
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            <button class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                                data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                    class="icon-trash" title="Delete"></i>
                                                            </button>

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
