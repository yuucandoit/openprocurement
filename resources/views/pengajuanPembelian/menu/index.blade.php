<title>Purchase Request</title>

@extends('layouts.master')

@section('main')
<section>
  @foreach ($datadv as $a)
  <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h2 class="modal-title" style="color: white">Delete</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
        </div>
        <div class="modal-body mx-5 mb-3">
          <span class="warning">
            <img src="assets/images/warning.png">
          </span>
          <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
        </div>
        <div class="modal-footer">
          <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
            Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{--
    @foreach ($a->quot as $po)
    <div class="modal fade" id="modalItemVendor{{ $po->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">

                    <h4 class="modal-title" style="color: white">List Item</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body mx-5 mb-3">
                    @php
                        $i = 1;
                    @endphp
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Uom</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($po->itempo as $item)
                            <tr>
                                <td> {{ $item->item }}</td>
                                <td> {{ $item->qty }}</td>
                                <td> {{ $item->kategori }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach --}}
  @endforeach



@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('error') }}
</div>
@elseif ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@elseif(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('message') }}
    </div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-3 col-lg-6 mt-4" style="margin-bottom: -40px;">
            <a href="{{ url('/menu-pengajuan-pembelian') }}">
            <div class="card o-hidden border-0">
                <div class="b-r-4 card-body shadow h-100 py-3"
                    style="border-left: 10px solid rgba(150, 148, 255, 0.9);">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                style="color: rgba(150, 148, 255, 0.9);"></i>
                        </div>
                        <div class="media-body">
                            <h6 style="color: rgba(150, 148, 255, 0.9); font-size:12;">
                                PURCHASE <br>
                                REQUEST</h6>
                            <h2 class="mb-0 counter" style="color: rgba(150, 148, 255, 0.9); font-size:12;">
                                {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-6 mt-4" style="margin-bottom: -40px;" style="font-size: 10">
            <a href="{{ url('/menu-pengajuan-pembelian') }}">
            <div class="card o-hidden border-0">
                <div class="b-r-4 card-body shadow h-100 py-3"
                    style="border-left: 10px solid rgba(255, 225, 0, 0.9);">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                style="color: rgba(255, 225, 0, 0.9);"></i>
                        </div>
                        <div class="media-body">
                            <h6
                                style="color: rgba(255, 225, 0, 0.9); font-size:12;">
                                PENDING <br>
                                REQUEST</h6>
                            <h2 class="mb-0 counter" style="color: rgba(255, 230, 0, 0.9); font-size:12;">
                                {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status', 'Awaiting Purchase Request Approval')->count() }}</h2>

                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-6 mt-4" style="margin-bottom: -40px;" style="font-size: 10">
            <a href="{{ url('/menu-pengajuan-pembelian') }}">
            <div class="card o-hidden border-0">
                <div class="b-r-4 card-body shadow h-100 py-3"
                    style="border-left: 10px solid rgb(12, 174, 0);">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                style="color: rgb(12, 174, 0);"></i>
                        </div>
                        <div class="media-body">
                            <h6
                                style="color: rgb(12, 174, 0); font-size:12;">
                                PURCHASE <br>
                                COMPLETED</h6>
                            <h2 class="mb-0 counter" style="color: rgb(12, 174, 0); font-size:12;">
                                {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status', 'Delivery Success')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-3 col-lg-6 mt-4" style="margin-bottom: -40px;" style="font-size: 10">
            <a href="{{ url('/menu-pengajuan-pembelian') }}">
            <div class="card o-hidden border-0">
                <div class="b-r-4 card-body shadow h-100 py-3"
                    style="border-left: 10px solid rgb(255, 0, 0);">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                style="color: rgb(255, 0, 0);"></i>
                        </div>
                        <div class="media-body">
                            <h6
                                style="color: rgb(255, 0, 0); font-size:12;">
                                PURCHASE <br>
                                FAILED</h6>
                            <h2 class="mb-0 counter" style="color: rgb(255, 0, 0); font-size:12;">
                                {{ \App\Models\CategoryPengajuanPembelian::where('user_id',Auth::user()->id)->where('status','like',"%Rejected%")->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        </div>
</div>

  <!-- Page Sidebar Ends-->
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6 mt-4">
          <h3>Purchase Request</h3>
          <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Purchase Request</li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
            <div class="col-sm-8">
            <a href="{{ url('menu-pengajuan-pembelian/create/') }}" class="btn btn-primary mb-3" ></i> Add <i class="icofont icofont-ui-add"></i></a>
            </div>
            <div class="col-sm-4 ">
                <form action="{{ route('menu-pengajuan-pembelian.SearchPRQ') }}" method="get" class="input-group">
                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                </form>
            </div>
        </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover ">
                <thead class="bg-primary">
                 <tr>
                  <th>No</th>
                  <th>Code</th>
                  <th style="white-space: nowrap;">Request By</th>
                  <th>Description</th>
                  <th>Progress</th>
                  <th style="text-align: center">Status</th>
                  <th style="text-align: center">Action</th>
                </tr>
              </thead>
              <tbody>
               @php
               $no = 1;
               $i = 1 + $datadv->currentPage() * $datadv->perPage() - $datadv->perPage();
               @endphp
               @foreach($datadv as $ppembelian)

               <tr style="background-color:#F1F6F5;">
                <td>{{ $i++ }}</td>
                <td><a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}">{{ $ppembelian->code_pengajuan }}</a></td>
                <td style="white-space: nowrap;">
                    <ul>
                        <li><strong>{{ Carbon\Carbon::parse($ppembelian->date_ps)->format('d-m-Y') }}</strong></li>
                        <li>{{ $ppembelian->whosubmit->name }}</li>
                        <li>{{ $ppembelian->userid->department }}</li>
                        <li class="mt-4" style="font-weight: 500;">{{ $ppembelian->purpose->name }}</li>
                    </ul>
                </td>
                <td style=" word-break: break-word;"><a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}">{{ $ppembelian->desc}}</a></td>
                @hasrole('user|super admin')

                <td style="white-space: nowrap;">
                    <ul>
                        <li>
                            <p><strong>Purchase&nbsp;:</strong>

                            @if ($ppembelian->status == 'Awaiting Purchase Request Approval')
                            -
                            @elseif ($ppembelian->status == 'Waiting For PO Approval')
                            <a class="badge mt-1" style="background-color:#006516; color:white; font-size:8;" >Process PO</a>
                            @elseif($ppembelian->status == 'Invoicing Process')
                            <a class="badge mt-1" style="background-color:#006516; color:white; font-size:8;" >Done</a>
                            @elseif ($ppembelian->status == 'Purchase Request Approved' )
                            <a class="badge mt-1" style="background-color:#FF8C00; color:white; font-size:8;" >Waiting</a>

                            @elseif( $ppembelian->status == 'Purchase Proses')
                            <a class="badge bg-warning mt-1" style="color:white; font-size:8;" >Process PO</a>

                            @elseif( $ppembelian->status == 'Cross Check PO')
                            -
                            @elseif( $ppembelian->status == 'Rejected From Logistics')
                            -

                            @elseif( $ppembelian->status == 'PO Approved')
                            <a class="badge mt-1" style="background-color:#006516; color:white; font-size:8;" >Done</a>

                            @elseif($ppembelian->status == 'Payment Approved' )
                            <a class="badge bg-success mt-1" style="color:white; font-size:8;" >On Process</a>

                            @elseif ($ppembelian->status == 'PO & Payment Approved' || $ppembelian->status == 'Unpaid' || $ppembelian->status == 'Paid' || $ppembelian->status == 'Delivery process' || $ppembelian->status == 'Delivery Success')
                            <a class="badge bg-success mt-1" style="color:white; font-size:8;">Done</a>
                            @endif
                            @if ($ppembelian->status == 'Rejected by Purchasing')
                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                            @endif
                            @if ($ppembelian->status == 'Purchase Request Rejected By BOD')
                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                            @endif
                            @if ($ppembelian->status == 'PO Rejected by BOD')
                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected PO</a>
                            @endif
                            </p>

                        </li>
                        <li>
                            <p><strong>Payment&nbsp; :</strong>
                            @if ($ppembelian->status == 'Unpaid' || $ppembelian->status == 'PO & Payment Approved')
                            <a class="badge bg-warning mt-1" style="color: white; font-size:8">Unpaid</a>
                            @elseif ($ppembelian->status == 'Paid' || $ppembelian->status == 'Delivery Success' )
                            <a class="badge bg-success mt-1" style="color: white; font-size:8">Done</a>
                            @elseif ($ppembelian->status == 'Purchase Request Approved' || $ppembelian->status == 'Purchase Proses'  || $ppembelian->status == 'Payment Approved' )
                            -
                            @elseif ($ppembelian->status == 'PO Approved')
                            <a class="badge mt-1" style="background-color:#FF8C00; color:white; font-size:8;" >Waiting</a>
                            @elseif ($ppembelian->status == 'Awaiting Purchase Request Approval')
                            -
                            @elseif ($ppembelian->status == 'Waiting For PO Approval')
                            -
                            @elseif( $ppembelian->status == 'Rejected From Logistics')
                            -
                            @elseif($ppembelian->status == 'Invoicing Process')
                            <a class="badge mt-1" style="background-color:#FF8C00; color:white; font-size:8;" >On-Process</a>
                            @elseif ($ppembelian->status == 'Payment Rejected By BOD')
                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                            @elseif ($ppembelian->status == 'Rejected by Finance')
                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                            -
                            @elseif ($ppembelian->status == 'Rejected by Purchasing')
                            -
                            @elseif ($ppembelian->status == 'Purchase Request Rejected By BOD')
                            -
                            @elseif ($ppembelian->status == 'Payment Rejected By BOD')
                            -
                            @elseif ($ppembelian->status == 'PO Rejected by BOD')
                            -
                            @elseif ($ppembelian->status == 'Rejected by Finance')
                            -
                            @elseif( $ppembelian->status == 'Cross Check PO')
                            -
                            @endif
                            </p>
                        </li>
                        <li>
                            <p><strong>Delivery&nbsp;&nbsp;&nbsp;:</strong>
                                @if ($ppembelian->status == 'Paid')
                                <a class="badge bg-warning mt-1 btn btn-warning" style="color: white; font-size:8" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"> On The Way</a>
                                @elseif ($ppembelian->status == 'Delivery Success')
                                <a class="badge bg-success mt-1" style="color: white; font-size:8">Delivered</a>
                                @elseif ($ppembelian->status == 'Purchase Request Approved' || $ppembelian->status == 'Purchase Proses' || $ppembelian->status == 'PO Approved'  || $ppembelian->status == 'Payment Approved' )
                                -
                                @elseif ($ppembelian->status == 'Awaiting Purchase Request Approval' || $ppembelian->status == 'PO & Payment Approved')
                                -
                                @elseif ($ppembelian->status == 'Waiting For PO Approval')
                                -
                                @elseif($ppembelian->status == 'Invoicing Process')
                                -
                                @elseif ($ppembelian->status == 'Rejected by Purchasing')
                                -
                                @elseif( $ppembelian->status == 'Rejected From Logistics')
                                -
                                @elseif ($ppembelian->status == 'Purchase Request Rejected By BOD')
                                -
                                @elseif ($ppembelian->status == 'Payment Rejected By BOD')
                                -
                                @elseif ($ppembelian->status == 'PO Rejected by BOD')
                                -
                                @elseif ($ppembelian->status == 'Rejected by Finance')
                                -
                                @elseif ($ppembelian->status == 'Cross Check PO')
                                -
                                @endif
                            </p>
                        </li>
                    </ul>
                </td>

                <td style="text-align: center" >
                    <ul>
                        <li>
                    @if ($ppembelian->status == 'Awaiting Purchase Request Approval')
                        @if(empty( $ppembelian->bod->name))
                        <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Request </a>
                        <button class="btn btn-primary" type="button">Comments <span class="badge rounded-pill badge-light text-dark"><i data-feather="mail"></i></span></button>
                        @else
                            @if($ppembelian->purpose_type == 'App\Models\ReferensiNamaProject')
                                @if($ppembelian->logistic_check == 1  )
                                <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Inventory Check</a>
                                @else
                                <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Request {{ $ppembelian->bod->name }}</a>
                                @endif
                            @else
                            <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Request {{ $ppembelian->bod->name }}</a>
                            @endif
                        @endif
                    {{-- <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Request {{ $ppembelian->bod->name }}</a> --}}
                    @endif
                    @if($ppembelian->status == 'Purchase Request Approved')
                        @if(empty( $ppembelian->bod->name))
                            <ul>
                                <li><a class="badge bg-success mt-1" style="color: white; font-size:12">Approved Request By BOD </a></li>
                                <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Purchasing PO</a></li>
                            </ul>
                        @else
                        <ul>
                            <li><a class="badge bg-success mt-1" style="color: white; font-size:12">Approved Request By {{ $ppembelian->bod->name }} </a></li>
                            <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Purchasing PO</a></li>
                        </ul>
                        {{-- <a class="badge bg-success mt-1" style="color: white; font-size:12">Approved Request By {{ $ppembelian->bod->name }}</a> --}}
                        @endif
                    {{-- <a class="badge bg-success mt-1" style="color: white; font-size:12">Approved Request By {{ $ppembelian->bod->name }}</a> --}}
                    @endif
                    @if($ppembelian->status == 'Purchase Proses')
                    <a class="badge bg-primary mt-1" style="color: white; font-size:12">On Process Purchasing </a>
                    @endif
                    @if($ppembelian->status == 'Cross Check PO')
                    <a class="badge bg-warning mt-1" style="color: white; font-size:12">On Check Manager Purchase </a>
                    @endif
                    @if($ppembelian->status == 'Waiting For PO Approval')
                        @if(empty( $ppembelian->atasans->name))
                        <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval PO BOD</a>
                        @else
                        <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval PO {{ $ppembelian->atasans->name }}</a>
                        @endif
                    @endif
                    @if($ppembelian->status == 'PO Approved' )
                        @if(empty( $ppembelian->atasans->name))
                        <ul>
                            <li><a class="badge bg-success mt-1" style="color: white; font-size:12">Approved PO By BOD</a></li>
                            <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Purchasing Request</a></li>
                        </ul>
                        {{-- <a class="badge bg-warning mt-1" style="color: white; font-size:12">Approved PO By BOD</a> --}}
                        @else
                        <ul>
                            <li><a class="badge bg-success mt-1" style="color: white; font-size:12">Approved PO By {{ $ppembelian->atasans->name }}</a></li>
                            <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Purchasing Request</a></li>
                        </ul>
                        {{-- <a class="badge bg-warning mt-1" style="color: white; font-size:12">Approved PO By {{ $ppembelian->atasans->name }}</a> --}}
                        @endif
                    @endif
                    @if($ppembelian->status == 'PO & Payment Approved')
                        @if(empty( $ppembelian->atasans->name))
                        <ul>
                            <li><a class="badge bg-success mt-1" style="color: white; font-size:12">Approved PO & PY BOD</a></li>
                            <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Purchasing Request</a></li>
                        </ul>
                        {{-- <a class="badge bg-warning mt-1" style="color: white; font-size:12">Approved PO By BOD</a> --}}
                        @else
                        <ul>
                            <li><a class="badge bg-success mt-1" style="color: white; font-size:12">Approved PO & PY By {{ $ppembelian->atasans->name }}</a></li>
                            <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Finance Pay</a></li>
                        </ul>
                        {{-- <a class="badge bg-warning mt-1" style="color: white; font-size:12">Approved PO By {{ $ppembelian->atasans->name }}</a> --}}
                        @endif
                    @endif
                    @if($ppembelian->status == 'Invoicing Process')
                        @if(empty($ppembelian->atasanpymnt->name))
                            <ul>
                                <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Payment By BOD</a></li>
                            </ul>
                        @else
                            <ul>
                                <li><a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Payment By {{ $ppembelian->atasanpymnt->name }}</a></li>
                            </ul>
                        @endif
                    @endif
                    @if($ppembelian->status == 'Payment Approved')
                        @if(empty( $ppembelian->atasanpymnt->name))
                        <a class="badge bg-warning mt-1" style="color: white; font-size:12">Approved Payment By BOD</a>
                        @else
                        <a class="badge bg-warning mt-1" style="color: white; font-size:12">Approved Payment By {{ $ppembelian->atasanpymnt->name }}</a>
                        @endif
                    {{-- <a class="badge bg-success mt-1" style="color: white; font-size:12">Approved Payment By  {{ $ppembelian->atasanpymnt->name }}</a> --}}
                    @endif
                    @if($ppembelian->status == 'Unpaid')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Waiting Finance Pay</a>
                    @endif
                    @if($ppembelian->status == 'Paid')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Request In-Delivery</a>
                    @endif
                    @if($ppembelian->status == 'Delivery Success')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Request Completed</a>
                    @endif
                    @if ($ppembelian->status == 'Rejected From Logistics')
                    <li><a class="badge bg-danger mt-1" style="color: white; font-size:12;">Rejected From Logistics</a></li>
                    <li><a class="badge bg-danger mt-1" style="color: white; font-size:8;">{{ $ppembelian->note_logistic }}</a></li>
                    <li><a class="badge bg-danger mt-1" style="color: white; font-size:8;">Please update the pre pr</a></li>
                    @endif
                    @if ($ppembelian->status == 'Rejected by Purchasing')
                    <li><a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Purchase</a></li>
                    <li><a class="badge bg-danger mt-1" style="color: white; font-size:8">{{ $ppembelian->note_purchase }}</a></li>
                        @if(empty($ppembelian->path_img))
                            <li><a class="badge bg-danger mt-1" style="color: white; font-size:8">No Image</a></li>
                            @else
                            <li><a class="badge bg-danger mt-1" style="color: white; font-size:8" href="upload_pengajuan_reject/{{ $ppembelian->path_img }}" target="_blank"><i class="icofont icofont-image"></i>Show Image</a></li>
                        @endif
                    @endif
                    @if ($ppembelian->status == 'Purchase Request Rejected By BOD')
                        @if(empty( $ppembelian->bod->name))
                        <li> <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod</a></li>
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:12"> - </a></li>
                        @else
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod {{ $ppembelian->bod->name }}</a></li>
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:8"> {{ $ppembelian->note_bod_pr }} </a></li>
                        @endif
                    {{-- <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->bod->name }} )</a> --}}
                    @endif
                    @if ($ppembelian->status == 'Payment Rejected By BOD')
                        @if(empty( $ppembelian->atasanpymnt->name))
                        <li> <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod</a></li>
                        <li> <a class="badge bg-danger mt-1" style="color: white; font-size:8">-</a></li>

                        @else
                        <li> <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod {{ $ppembelian->atasanpymnt->name }}</a></li>
                        <li> <a class="badge bg-danger mt-1" style="color: white; font-size:12">{{ $ppembelian->note_bod_py }}</a></li>

                        @endif
                    {{-- <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->atasanpymnt->name }} )</a> --}}
                    @endif
                    @if ($ppembelian->status == 'PO Rejected by BOD')
                        @if(empty( $ppembelian->atasans->name))
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod</a></li>
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:8">-</a></li>
                        @else
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod {{ $ppembelian->atasans->name }}</a></li>
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:8">{{ $ppembelian->note_bod_po }}</a></li>

                        @endif
                    {{-- <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->atasans->name }} )</a> --}}
                    @endif
                    @if($ppembelian->status == 'Rejected by Finance')
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Finance</a></li>
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:8">{{ $ppembelian->note_finance }}</a></li>
                    @endif
                    @if($ppembelian->status == 'Canceled')
                        <li><a class="badge bg-danger mt-1" style="color: white; font-size:12">Canceled</a></li>
                    @endif
                    </li>
                    <li style="text-align: center;">
                        {{-- @foreach ($comments as $c) --}}
                            <a style="font-style: italic; font-size:10; " href="{{ route('menu-pengajuan-pembelian.detail',$ppembelian->id) }}/#comment">
                            - {{ $ppembelian->comment->count() }} Comments
                            </a>
                        {{-- @endforeach --}}
                    </li>
                    </ul>
                </td>

                @endhasrole

                <td style="text-align: center;">

                    @if ($ppembelian->status == 'Awaiting Purchase Request Approval' )
                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;  font-size:10;" href="{{ url('/menu-pengajuan-pembelian/edit/' . $ppembelian->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                    </a>
                    <div>
                        <button class="btn btn-iconsolid mt-1" data-bs-toggle="modal" style="background-color: #ff0000; font-size:10;" data-bs-target="#modalDelete{{ $ppembelian->id }}" title="Delete"><i class="icon-trash" title="Delete"></i>
                        </button>
                    </div>
                    @else   

                    @endif

                </td>

              </tr>

              @if(empty($ppembelian->quot))

              @else

              @endif
              @endforeach
            </tbody>
          </table>
          <div class="mt-4">
          {{ $datadv->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
