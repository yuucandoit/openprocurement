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

        <div class="modal fade" id="modalSort" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">

                        <h4 class="modal-title">Sort </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('menu-purchase-order.SortHistoryPO') }}" method="get" class="input-group" >
                    <div class="modal-body ">
                        @php
                            $i = 1;
                        @endphp
                        <h4>Sort by status </h4>
                        <div class="row" >
                            <div class="col-sm-6" >
                                <ul>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Purchase Proses' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="Purchase Proses">&nbsp;Purchase Process
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Cross Check PO' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Cross Check PO">&nbsp;Cross Check PO
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Waiting For PO Approval' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Waiting For PO Approval">&nbsp;Waiting For PO Approval
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'PO Approved' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="PO Approved">&nbsp;PO Approved
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Invoicing Process' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="Invoicing Process">&nbsp;Invoicing Process
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Payment Rejected By BOD' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Payment Rejected By BOD">&nbsp;Payment Rejected By BOD
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6" >
                                <ul>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Payment Approved' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Payment Approved">&nbsp;Payment Approved
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Unpaid' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Unpaid">&nbsp;Unpaid
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Paid' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Paid">&nbsp;Paid
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Delivery Success' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Delivery Success">&nbsp;Delivery Success
                                        </label>
                                    </li>

                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'PO Rejected by BOD' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="PO Rejected by BOD">&nbsp;PO Rejected by BOD
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Rejected by Purchasing' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Rejected by Purchasing">&nbsp;Rejected by Purchasing
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Rejected by Finance' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Rejected by Finance">&nbsp;Rejected by Finance
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Sort</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

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
                        <div class="row">
                            <div class="col-sm-9">
                                <div style="margin-top: 40px; margin-left:30px;">
                                    <label data-bs-toggle="modal" data-bs-target="#modalSort"><i class="fa fa-filter" style="font-size:20px"></i> Sort</label>
                                    @if(empty($sort))

                                    @else
                                        @foreach ($sort as $s)
                                            @if(empty($s))

                                            @else
                                            <a class="badge badge-success" style="font-size: 10; color:white;">{{ $s }}</a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        <div class="col-sm-3">
                    <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px; ">
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
                                                    <td style="text-align: center;">
                                                        <ul>
                                                            @if($ppb->status == 'PO Rejected by BOD')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_bod_po }}</li>
                                                            @elseif($ppb->status == 'Rejected by Purchasing')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_purchase }}</li>
                                                            @elseif($ppb->status == 'Payment Rejected By BOD')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_bod_py }}</li>
                                                            @elseif($ppb->status == 'Rejected by Finance')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_finance }}</li>
                                                            @else
                                                            <li><a class="badge badge-success mt-1 "
                                                                style="color: white; font-size:10">{{ $ppb->status }}
                                                            </a>
                                                        </li>
                                                            @endif
                                                            <li></li>
                                                        </ul>
                                                    </td>
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
