<title>Task List Finance</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datappb as $ppb)
            <div class="modal fade" id="modalItem{{ $ppb->id }}" tabindex="-1" aria-hidden="true">
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
                                    @foreach ($ppb->itemppn as $item)
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
        @endforeach
        @foreach ($datapo as $po)
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
        @endforeach

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Task List Finance</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task List Finance</li>
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
                                        <form action="{{ route('menu-tasklist-finance.SearchTaskFinance') }}" method="get" class="input-group">
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
                                            <th style="text-align: center;">No</th>
                                            <th>No PR/PO</th>
                                            <th>Request By</th>
                                            <th>Item</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Payment Approved')
                                            <tr style="background-color:#F1F6F5;">
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td>{{ $ppb->code_pengajuan }}</td>
                                                <td>
                                                    <a href="{{ url('menu-tasklist-finance/detail/' . $ppb->id)}}">
                                                        <ul>
                                                            <li style="font-weight:600; white-space:nowrap;">{{ $ppb->whosubmit->name }}</li>
                                                            <li>{{ $ppb->desc }}</li>
                                                        </ul>
                                                    </a>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li style="margin-top:4px; white-space:nowrap;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                    </ul>
                                                </td>
                                                <td style="text-align: center; white-space:nowrap;">
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
                                                <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Invoicing Process' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:12">{{ $ppb->status }}</a></td>

                                            </tr>
                                            @foreach ($ppb->quot as $po)
                                                <tr>

                                                    @php
                                                        $po2 = \App\Models\CategoryPO::find($po->id);
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                        // dd($po2->ppb_id);
                                                    @endphp

                                                    @if(empty($po2))

                                                    @else
                                                    <td style="text-align: center">-</td>
                                                    <td>{{ $po->code_po }}</td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                @if($po2->vendorable_id == 0)
                                                                Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                @else
                                                                Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                @endif
                                                            </li>
                                                            <li> Quotation : {{ $po2->quotation }}</li>
                                                        </ul>

                                                    </td>
                                                    <td style="font-weight: 700; white-space:nowrap;">
                                                        @foreach ($po3 as $ipo)
                                                        <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                        @endforeach
                                                    </td>
                                                    <td style="text-align: center">
                                                        @foreach ($po4 as $ipo)
                                                            <label>
                                                                @if($ipo->matauang == "RP")
                                                                Rp.{{ number_format($ipo->grand_total ,2) }}
                                                                @elseif ($ipo->matauang == "USD")
                                                                $ {{ number_format($ipo->grand_total ,2) }}
                                                                @endif
                                                            </label>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center"><a
                                                        class="badge {{ $ppb->status == 'Invoicing Process' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>


    </section>
@endsection
