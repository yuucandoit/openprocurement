<title>Purchase Order Out</title>
@extends('layouts.master')

@section('main')

<section>

    @foreach ($datappb as $purchase)
        <div class="modal fade" id="modalDelete{{ $purchase->id }}" tabindex="-1" aria-hidden="true">
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
                    <h3>Purchase Order Out</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Purchase Order</li>
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
                            <li><a href="javascript:void(0)"><i class="bookmark-search"
                                        data-feather="star"></i></a>
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

    {{-- History  --}}
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
                            <form action="{{ route('menu-purchase-order.SearchPOOut') }}" method="get" class="input-group" >
                                <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-primary">
                                    <tr >
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        {{-- <th>Send To</th> --}}
                                        <th style="white-space: nowrap; text-align:center;">Approved At</th>
                                        <th style="white-space: nowrap; text-align:center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                @php
                                    // $i = 1 ;
                                    $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                @endphp
                                <tbody>
                                    @foreach ($datappb as $ppb)
                                        @if (
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success')
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td style="white-space: nowrap;">{{ $ppb->whosubmit->name }}</td>
                                                <td><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" style="word-break: break-word;">{{ $ppb->desc }}</a></td>
                                                {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}
                                                <td style="text-align: center; font-size:10"><strong>{{ Carbon\Carbon::parse($ppb->approved_at)->format('d-m-Y H:i:s') }}</strong></td>
                                                <td style="text-align: center;">
                                                    <ul>
                                                        <li>
                                                            <a class="badge" style="text-align: center; font-size:10; color: white; background-color:rgb(0, 121, 6);">{{ $ppb->status }}</a>
                                                        </li>
                                                        <li style="text-align: center;">
                                                            {{-- @foreach ($comments as $c) --}}
                                                                <a style="font-style: italic; font-size:10; " href="{{ route('menu-purchase-order.detail',$ppb->id) }}/#comment">
                                                                - {{ $ppb->comment->count() }} Comments
                                                                </a>
                                                            {{-- @endforeach --}}
                                                        </li>
                                                    </ul>
                                                </td>
                                                @hasrole('purchasing|super admin')
                                                    <td style="text-align: center; white-space:nowrap;">

                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #B1D0E0; font-size:10;"
                                                        href="{{ url('/exportpdf/po/' . $ppb->id) }}" target="_blank"><i
                                                            class="icon-eye" title="Preview Purchase Order"></i>
                                                    </a>
                                                        @if ($ppb->status == 'Purchase Proses')
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #008000; font-size:10;"
                                                                href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                    class="icon-file" title="Record Data"></i>
                                                            </a>
                                                        @endif
                                                    <a class="btn btn-iconsolid mt-1"
                                                        style=  "background-color: #008000;font-size:10;"
                                                        href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                            class="icon-file" title="Record Data"></i>
                                                    </a>
                                                    <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #FF8C00; font-size:10;"
                                                        href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}"><i
                                                            class="icon-pencil-alt" title="Edit"></i>
                                                    </a>
                                                        {{-- <a class="btn btn-iconsolid mt-1"
                                                            style="background-color: #00008B; "
                                                            href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}"><i
                                                                class="icon-zoom-in" title="Details"></i>
                                                        </a> --}}

                                                        <button class="btn btn-iconsolid mt-1"
                                                        style="background-color: #ff0000; font-size:10;"
                                                         data-bs-toggle="modal"
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
                            <div class="mt-4">
                                {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- multiple pagination --}}

</section>

@endsection
