<title>List PR</title>

@extends('layouts.master')

@section('main')
<section>
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

    <!-- Page Sidebar Ends-->
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6 mt-4">
          <h3>List Purchase Request</h3>
          <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">List Purchase Request</li>
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
            </div>
            <div class="col-sm-4 ">
                <form action="{{ route('PrList.search') }}" method="get" class="input-group">
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
               $i = 1 + $purchaseRequest->currentPage() * $purchaseRequest->perPage() - $purchaseRequest->perPage();
               @endphp
               @foreach($purchaseRequest as $ppembelian)

               <tr style="background-color:#F1F6F5;">
                <td>{{ $i++ }}</td>
                <td><a href="{{ route('ShowPRPurchaseDetail',$ppembelian->id) }}">{{ $ppembelian->code_pengajuan }}</a></td>
                <td style="white-space: nowrap;">
                    <ul>
                        <li><strong>{{ Carbon\Carbon::parse($ppembelian->date_ps)->format('d-m-Y') }}</strong></li>
                        <li>{{ $ppembelian->whosubmit->name }}</li>
                        <li>{{ $ppembelian->userid->department }}</li>
                        <li class="mt-4" style="font-weight: 500;">{{ $ppembelian->purpose->name }}</li>
                    </ul>
                </td>
                <td style=" word-break: break-word;"><a href="{{ route('ShowPRPurchaseDetail',$ppembelian->id) }}">{{ $ppembelian->desc}}</a></td>

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
                        <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Request {{ $ppembelian->bod->name }}</a>
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
                            <a style="font-style: italic; font-size:10; " href="{{ route('ShowPRPurchaseDetail',$ppembelian->id) }}/#comment">
                            - {{ $ppembelian->comment->count() }} Comments
                            </a>
                        {{-- @endforeach --}}
                    </li>
                    </ul>
                </td>

                <td style="text-align: center;">
                    @if ($ppembelian->status == 'Awaiting Purchase Request Approval' )
                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;  font-size:10;" href="{{ route('ShowEditPRPurchase',$ppembelian->id) }}"><i class="icon-pencil-alt" title="Edit"></i></a>
                    @else
                    @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-4">
          {{ $purchaseRequest->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
