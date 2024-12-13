<title>History Check PO</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalSort" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">

                        <h4 class="modal-title">Sort </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('check_po.SortHistoryCheckPO') }}" method="get" class="input-group" >
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
                        <h3>History Check PO</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Check PO</li>
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
                                    <label data-bs-toggle="modal" data-bs-target="#modalSort"><i data-feather="filter" style="font-size:20px"></i> Sort</label>
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
                        <form action="{{ route('check_po.SearchHistoryCheckPO') }}" method="get"
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
                                            <th>No</th>
                                            <th>No.Pengajuan</th>
                                            <th>Name</th>
                                            <th>Item</th>
                                            <th>Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>

                                    @php
                                         $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>{{ $ppb->code_pengajuan }}</td>
                                                <td>
                                                    <ul><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}">
                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                        <li>{{ $ppb->desc }}</li>
                                                    </a></ul>
                                                </td>
                                                <td>
                                                    @foreach ($ppb->itemppn as $ice)
                                                        @php
                                                        $ipb = \App\Models\PengajuanPembelian::select(DB::raw('pp_id,SUM(qty) as qty'))->where('pp_id',$ice->pp_id)->groupBy('pp_id')->first();
                                                        @endphp
                                                    @endforeach
                                                    <ul>
                                                        <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{  $ipb->qty }} Item </label></li>
                                                    </ul>
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
                                                @hasrole('purchasing|super admin|super purchase')
                                                <td style="text-align: center;">

                                                    <a class="btn btn-iconsolid mt-1"
                                                    style="background-color: #B1D0E0; font-size:10;"
                                                    href="{{ url('/exportpdf/ppb/' . $ppb->id) }}" target="_blank"><i
                                                        class="icon-eye" title="Preview Purchase Request    "></i>
                                                    </a>
                                                </td>
                                                @endhasrole
                                            </tr>
                                            @foreach ($ppb->quot as $po)
                                                <tr>

                                                    @php
                                                        $po2 = \App\Models\CategoryPO::find($po->id);
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $isRejected = str_contains(strtolower($po2->status), 'reject');
                                                        $badgeClass = $isRejected ? 'bg-danger' :
                                                                    ($po2->status == 'Waiting For PO Approval' ? 'bg-warning' : 'bg-success');
                                                        $month = \Carbon\Carbon::parse($po->created_at)->format('m');
                                                        $year = \Carbon\Carbon::parse($po->created_at)->format('y');
                                                    @endphp

                                                    @if(empty($po2))

                                                    @else
                                                    <td style="text-align: center">-</td>
                                                    <td>
                                                        <a href="{{ route('menu-purchase-order.po_detail',$po->id) }}">
                                                        {{ $po->id }}/PO/SII/{{ $month }}/{{ $year }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <a href="{{ route('menu-purchase-order.po_detail',$po->id) }}">
                                                                <li style="white-space: nowrap;">
                                                                    @if($po2->vendorable_id == 0)
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                    @else
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? '' }}
                                                                    @endif
                                                                </li>
                                                                <li> No Invoice : {{ $po2->quotation }}</li>
                                                            </a>
                                                        </ul>
                                                    </td>
                                                    <td style="font-weight: 700;">
                                                        @foreach ($po3 as $ipo)
                                                        <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                        @endforeach
                                                    </td>
                                                    <td style="white-space: nowrap;">
                                                    @foreach ($po4 as $ipo)
                                                        <label>{{ $ipo->matauang }} {{ number_format($ipo->grand_total ,2) }}</label>
                                                    @endforeach
                                                    </td>
                                                    <td  class="text-center">
                                                        @if($isRejected)
                                                        <a class="badge  {{ $badgeClass }} mt-1" style="color: white; font-size:12">
                                                            {{ $po2->status }}
                                                        </a>
                                                        <br>
                                                        <a class="badge  {{ $badgeClass }} mt-1" style="color: white; font-size:12">
                                                            {{ $po2->notes ?? '-' }}
                                                        </a>
                                                        @else
                                                        <a class="badge {{ $badgeClass }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center;">

                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #f63900; font-size:10;"
                                                        href="{{ url('/exportpdf/po/' . $po->id) }}" target="_blank"><i
                                                            class="icon-eye" title="Preview Purchase Order"></i>
                                                        </a>
                                                    </td>

                                                    @endif
                                                </tr>
                                            @endforeach
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
    </section>
@endsection
