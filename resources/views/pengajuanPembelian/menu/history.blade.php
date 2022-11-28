<title>History Purchase Request</title>

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
                        <h3>History Purchase Request</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Purchase Request</li>
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
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">History Purchase Request</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Who Filed</th>
                                                <th>Description</th>
                                                <th>Purchase Status</th>
                                                <th>Payment Status</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($datappb as $ppembelian)
                                                @if ($ppembelian->status == 'Delivery Success')
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td style="text-align: center;">{{ $ppembelian->date_ps }}</td>
                                                        <td style="text-align: center;">{{ $ppembelian->whosubmit->name }}
                                                        </td>
                                                        <td><a href="{{ $ppembelian->desc }}"
                                                                target="_blank">{{ $ppembelian->desc }}</a></td>
                                                        @hasrole('user')
                                                            <td>
                                                                @if ($ppembelian->status == 'Awaiting Purchase Submission Approval')
                                                                    <a class="badge bg-warning mt-1"
                                                                        style="color: white; font-size:18">Waiting Approval
                                                                        1</a>
                                                                @elseif ($ppembelian->status == 'Waiting For PO Approval')
                                                                    <a class="badge bg-warning mt-1"
                                                                        style="color: white; font-size:18">Waiting Approval
                                                                        2</a>
                                                                @elseif ($ppembelian->status == 'Purchase Submission Approved' ||
                                                                    $ppembelian->status == 'Purchase Proses' ||
                                                                    $ppembelian->status == 'PO Approved' ||
                                                                    $ppembelian->status == 'Invoicing Process' ||
                                                                    $ppembelian->status == 'Payment Approved')
                                                                    <a class="badge bg-success mt-1"
                                                                        style="color:white; font-size:18;">On Process</a>
                                                                @elseif ($ppembelian->status == 'Unpaid' ||
                                                                    $ppembelian->status == 'Paid' ||
                                                                    $ppembelian->status == 'Delivery process' ||
                                                                    $ppembelian->status == 'Delivery Success')
                                                                    <a class="badge bg-success mt-1"
                                                                        style="color:white; font-size:18;">Done</a>
                                                                @elseif ($ppembelian->status == 'Rejected')
                                                                @endif
                                                                {{-- <a class="badge {{ $ppembelian->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppembelian->status == 'Accepted by Super user' || 'Accepted by Purchasing' ? 'bg-success' : 'bg-danger') }} mt-1" style="color: white; font-size:18">{{ $ppembelian->status }}</a> --}}
                                                            </td>
                                                            <td>
                                                                @if ($ppembelian->status == 'Unpaid')
                                                                    <a class="badge bg-warning mt-1"
                                                                        style="color: white; font-size:18">Unpaid</a>
                                                                @elseif ($ppembelian->status == 'Paid' || $ppembelian->status == 'Delivery Success')
                                                                    <a class="badge bg-success mt-1"
                                                                        style="color: white; font-size:18">Paid</a>
                                                                @endif
                                                                {{-- <a class="badge {{ $ppembelian->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppembelian->status == 'Accepted by Super user' || 'Accepted by Purchasing' ? 'bg-success' : 'bg-danger') }} mt-1" style="color: white; font-size:18"></a> --}}
                                                            </td>
                                                            <td>
                                                                @if ($ppembelian->status == 'Paid')
                                                                    <a class="badge bg-warning mt-1"
                                                                        style="color: white; font-size:18"> Delivery On
                                                                        Process</a>
                                                                @elseif ($ppembelian->status == 'Delivery Success')
                                                                    <a class="badge bg-success mt-1"
                                                                        style="color: white; font-size:18">Delivery Success</a>
                                                                @endif
                                                                {{-- <a class="badge {{ $ppembelian->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppembelian->status == 'Accepted by Super user' || 'Accepted by Purchasing' ? 'bg-success' : 'bg-danger') }} mt-1" style="color: white; font-size:18"></a> --}}
                                                            </td>
                                                        @endhasrole

                                                        <td style="text-align: center;">
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
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
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
