<title>History Payment Process</title>

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
                    <form action="{{ route('menu-pengajuan-dana.SortHistoryPD') }}" method="get" class="input-group" >
                    <div class="modal-body ">
                        @php
                            $i = 1;
                        @endphp
                        <h4>Sort by status </h4>
                        <div class="row">
                            <div class="col-sm-12" >
                                <ul>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Paid' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Paid">&nbsp;Paid
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Delivery Success' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Delivery Success">&nbsp;Delivery Success
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
                        <h3>History Payment Process</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Payment Process</li>
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
                                <form action="{{ route('menu-pengajuan-dana.SearchHistoryPD') }}" method="get" class="input-group" >
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
                                            <th>Item</th>
                                            <th>Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                         $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @php $approvedPPB[] =$ppb; @endphp
                                            <tr style="background-color:#F1F6F5;">
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>{{ $ppb->whosubmit->name }}</td>
                                                <td><a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                <td>
                                                    <ul>
                                                        <li style="margin-top:4px; white-space:nowrap;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                    </ul>
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    @if($ppb->dateline == '≤24Jam')
                                                    <strong><p>1 Hari</p></strong>
                                                    @elseif ($ppb->dateline == '≤72Jam')
                                                    <strong><p>2 sd 3 Hari</p></strong>
                                                    @elseif ($ppb->dateline == '≤168Jam')
                                                    <strong><p>4 sd 7 Hari</p></strong>
                                                    @elseif ($ppb->dateline == '≤336Jam')
                                                    <strong><p>7 sd 14 Hari</p></strong>
                                                    @endif
                                                </td>
                                                    <td class="text-center">
                                                        <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:10">{{ $ppb->status }}</a>
                                                    </td>

                                                    {{-- <td style="text-align: center">
                                                        <a class="btn btn-iconsolid mt-1"
                                                        style="background-color: #ADD8E6;font-size:10;"
                                                        href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}" target="_blank"><i
                                                            class="icon-eye" title="Preview PDF"></i>
                                                        </a>

                                                    </td> --}}
                                            </tr>
                                            @foreach ($ppb->quot as $po)
                                                <tr>

                                                    @php
                                                        $po2 = \App\Models\CategoryPO::with('vendorable')->find($po->id);
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                    @endphp

                                                    @if(empty($po))

                                                    @else
                                                    <td style="text-align: center">-</td>
                                                    <td>
                                                        <a href="{{ route('menu-pengajuan-dana.po_detail',$po->id) }}">
                                                        {{ $po2->code_po }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <a href="{{ route('menu-pengajuan-dana.po_detail',$po->id) }}">
                                                                <li style="white-space: nowrap;">
                                                                    @if($po2->vendorable_id == 0)
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                    @else
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? ' - ' }}
                                                                    @endif
                                                                </li>
                                                                <li> Quotation : {{ $po2->quotation }}</li>
                                                            </a>
                                                        </ul>
                                                    </td>
                                                    <td style="font-weight: 700; white-space:nowrap;">
                                                        @foreach ($po3 as $ipo)
                                                        <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po2->id }}">{{ $ipo->qty }} Item</label>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($po4 as $ipo)
                                                        <label>
                                                            {{ $ipo->matauang }} {{ number_format($ipo->grand_total ,2) }}
                                                        </label>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center"><a
                                                        class="badge {{ $ppb->status == 'Unpaid' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:10">{{ $po2->status }}</a></td>

                                                    @endif
                                                </tr>
                                            @endforeach
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
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
    </section>
@endsection
