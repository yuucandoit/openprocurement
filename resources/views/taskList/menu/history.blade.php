<title>History Task List Purchase Order</title>

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
            @foreach ($ppb->quot as $po)
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
        @endforeach

        <div class="modal fade" id="modalSort" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">

                        <h4 class="modal-title">Sort </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('menu-task-list.SortTaskPOHistory') }}" method="get" class="input-group" >
                    <div class="modal-body ">
                        @php
                            $i = 1;
                        @endphp
                        <h4>Sort by status </h4>
                        <div class="row" >
                            <div class="col-sm-6" >
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
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'PO & Payment Approved' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="PO & Payment Approved">&nbsp;PO & Payment Approved
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


        <div class="modal fade" id="modalExportSpesific" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">

                        <h4 class="modal-title">Export Spesific </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('export-po-spesific') }}" method="POST" class="input-group" >
                    @csrf
                    <div class="modal-body ">
                        <div class="row" >
                            <div class="col-sm-12" >
                                <div class="form-group">
                                    <label class="form-label" style="font-weight: bold;"> Select Project ID</label>
                                    <select class="form-select js-example-basic-single" placeholder="Purpose ID" name="purpose_id" required>
                                        <option value="" disabled selected hidden>
                                            Select Project
                                        </option>
                                        @foreach ($purpose as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Export</button>
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
                        <h3>History Task List Purchasing</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">History Task List Purchase order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <style>
            li {
                list-style-type: none;
            }

        </style>

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
                                <form action="{{ route('menu-task-list.SearchtaskPOHistory') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-header bg-primary">
                            <h5>History Task List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="le-Table-1">
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
                                    //  use Carbon\Carbon;
                                        $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        $approvedPPB = [];
                                        $status = [];
                                    @endphp
                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            @php
                                                $approvedPPB[] =$ppb;
                                                $id_po = $ppb->id;
                                                $id_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
                                                $year = Carbon\Carbon::now()->format('y');
                                                $month = Carbon\Carbon::now()->format('m');
                                                $status[] = $ppb;
                                            @endphp
                                        <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                            <td style="text-align: center;">{{ $i++ }}</td>
                                            <td style="text-align: center;">
                                                <ul>
                                                    {{-- <li>{{ $id_number }}/PB/SII/{{ $month }}/{{ $year }}</li> --}}
                                                    <li><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" >{{ $ppb->code_pengajuan }}</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" style="font-weight: 600;">{{ $ppb->whosubmit->name }}</a></li>
                                                    <li style="margin-top: 5px;"><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" >{!! nl2br($ppb->desc) !!}</a></li>
                                                </ul>
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
                                       
                                            <td>
                                                <ul>
                                                    <li>
                                                        <p class="ppb-countdown"></p>
                                                    </li>
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
                                            {{-- <td class="ppb-countdown"></td> --}}
                                            <td style="text-align: center;">
                                                <ul>
                                                    <li>
                                                        @if($ppb->status == 'Purchase Proses')
                                                        <a class="badge"
                                                            style="color: white; background-color:rgb(255, 0, 0); font-size:10">
                                                            Waiting Process
                                                        </a>
                                                        @elseif($ppb->status == 'Cross Check PO')
                                                        <a class="badge"
                                                            style="color: white; background-color:rgb(255, 200, 0); font-size:10">
                                                            On Check
                                                        </a>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <a class="badge badge-lable" style="font-size: 10">
                                                            Complete This Task!
                                                        </a>
                                                    </li>
                                                    @if($ppb->type_pr == 'SPKBased')
                                                    <li>
                                                        <a class="badge" style="background-color:coral; font-size: 11;">
                                                            SPK Complete
                                                        </a>
                                                    </li>
                                                    @elseif($ppb->type_pr == 'SPK_Normal')
                                                    <li>
                                                        <a class="badge" style="background-color:#dacf00; font-size:10px;">SPK Normal</a>
                                                    </li>
                                                    @endif
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
                                        <tbody>
                                            @foreach ($ppb->quot as $po)
                                                <tr>

                                                    @php
                                                        $po2 = \App\Models\CategoryPO::find($po->id);
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $isRejected = str_contains(strtolower($po2->status), 'reject');
                                                        $badgeClass = $isRejected ? 'bg-danger' :
                                                                    ($po2->status == 'Waiting For PO Approval' ? 'bg-warning' : 'bg-success');
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
                                                        {{-- <button class="btn btn-iconsolid mt-1" style="background-color: #ff0000; font-size:10;" data-bs-toggle="modal"
                                                            data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                class="icon-trash" title="Delete"></i>
                                                        </button> --}}
                                                    </td>

                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('export-historyPO') }}" class="btn btn-success">Export Data</a>
                                    <a data-bs-toggle="modal" data-bs-target="#modalExportSpesific" class="btn btn-warning">Export Spesific Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>
            <script>
                const status = @json($status);
                console.log(status);
                /* Sort function */
                function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("le-Table-1");
                switching = true;
                //Set the sorting direction to ascending:
                dir = "asc";
                /*Make a loop that will continue until
                no switching has been done:*/
                while (switching) {
                    //start by saying: no switching is done:
                    switching = false;
                    rows = table.rows;
                    /*Loop through all table rows (except the
                    first, which contains table headers):*/
                    for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                        }
                    }
                    }
                    if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount ++;
                    } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                    }
                }
                }

                document.querySelector('#le-Input-1').addEventListener('keyup', filterTable, false);

                function content(elem) {
                }

                /* checkbox filter */
                function filter_type(box) {
                    var cbs = document.getElementsByTagName('input');
                    var all_checked_types = [];
                    for(var i=0; i < cbs.length; i++) {
                        if(cbs[i].type == "checkbox") {
                                if(cbs[i].name.match(/^filter/)) {
                                        if(cbs[i].checked) {
                                            all_checked_types.push(cbs[i].value);
                                        }
                                    }
                            }
                    }
                    if (all_checked_types.length > 0) {
                        $('#le-Table-1 tr').each(function (i, row) {
                            var $tds = $(this).find('td')
                            if ($tds.length) {
                            var type = $tds[2].innerText;
                            console.log(type)
                            if(!(type && all_checked_types.indexOf(type) >= 0)) {
                                $(this).hide();
                                }
                                else {
                                $(this).show();
                                }
                            }
                        });

                    }
                    else {
                        $('#le-Table-1 tr').each(function (i, row) {
                            var $tds = $(this).find('td'),
                            type = $tds.eq(2).text();
                            $(this).show();
                            });
                    }
                    return true;
                }
            </script>
    </section>
@endsection
@section('scripts')
    <script>
        const dataprchs = @json($approvedPPB);
        const item = dataprchs[0];

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (dataprchs, elmnt) => {
            const {
                approved_at,
                dateline_time,
                datetime
            } = dataprchs;

            const dateline = {
                day     : () => dateline.toDigit(Math.floor(parseInt(dateline.split()[0])/24.1) || 1),
                hours   : () => dateline.toDigit(Math.floor(parseInt(dateline.split()[0])%24.1)),
                minutes : () => dateline.split()[1],
                seconds : () => dateline.split()[2],
                time    : () => `${dateline.hours()}:${dateline.minutes()}:${dateline.seconds()}`,
                split   : () => dateline_time.split(':'),
                toDigit : (val) => val > 9 ? val : '0'+val,
            }

            const approvedAt = new Date(approved_at);
            const dueDateTime = new Date(`1970-01-${dateline.day()}T${dateline.time()}Z`);
            const dueDateAt = new Date(approvedAt.getTime() +   dueDateTime.getTime());
            const remainingTime = new Date(dueDateAt.getTime() - Date.now());
            const remainingExp = new Date(dueDateAt.getTime() + Date.now());
            const lable = elmnt.querySelector('.badge-lable');

            // console.log(dateline_time, dueDateAt.getTime(),remainingTime.getTime(),);

            if (remainingTime.getTime() < 1) {

                lable.classList.remove('bg-dark');
                lable.classList.add('bg-dark');
                var currentTimeExp = new Date();
                var remainingTimeExpired = Math.floor((currentTimeExp - dueDateAt.getTime()) / 1000);

                var expWeeks = Math.floor(remainingTimeExpired / (7 * 24 * 3600));
                remainingTimeExpired -= expWeeks * (7 * 24 * 3600);

                var expDays = Math.floor(remainingTimeExpired / (24 * 3600));
                remainingTimeExpired -= expDays * (24 * 3600);

                var expHours = Math.floor(remainingTimeExpired / 3600);
                remainingTimeExpired -= expHours * 3600;

                var expMinutes = Math.floor(remainingTimeExpired / 60);
                remainingTimeExpired -= expMinutes * 60;

                var expSeconds = remainingTimeExpired;

                var weeksDisplay = expWeeks > 0 ? `${expWeeks} week${expWeeks > 1 ? "s" : ""} ` : "";
                var daysDisplay = expDays > 0 ? `${expDays} day${expDays > 1 ? "s" : ""} ` : "";
                var hoursDisplay = expHours < 10 ? "0" + expHours : expHours;
                var minutesDisplay = expMinutes < 10 ? "0" + expMinutes : expMinutes;
                var secondsDisplay = expSeconds < 10 ? "0" + expSeconds : expSeconds;

                let countdown = `-${weeksDisplay}${daysDisplay}${hoursDisplay}:${minutesDisplay}:${secondsDisplay}`;
                return countdown;
                }

            let colors = [];
            const days  = dateline.split()[0] == 24 ? (remainingTime.getDate()-2).toString() : (remainingTime.getDate()-1).toString();
            const hours = remainingTime.getUTCHours().toString();
            const minutes = remainingTime.getUTCMinutes().toString();
            const seconds = remainingTime.getUTCSeconds().toString();

            lable.classList.remove('bg-danger');
            lable.classList.remove('bg-warning');
            lable.classList.remove('bg-success');

            // SUDAH OTOMATIS HITUNG DISINI YAAAAA 😁
            lable.classList.add((() => {
                const dueDate   = dueDateTime.getTime();
                const remaining = remainingTime.getTime();

                if(remaining <= 60*60*1000) return 'bg-dark';
                if(remaining <= dueDate*1/3) return'bg-danger';
                if(remaining <= dueDate*2/3) return'bg-warning';
                if(remaining <= dueDate*3/3) return'bg-success';
            })());

            return (
                (days.length == 1 ? `0${days}:` : `${days}:`)+
                (hours.length == 1 ? `0${hours}:` : `${hours}:`) +
                (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                (seconds.length == 1 ? `0${seconds}` : `${seconds}`)
            );
        }

        // FOR HANDLE REWRITE ELEMENT 😃
        const countdownHandle = (elmnt, item) => {
            const countdownElmnt = elmnt.querySelector('.ppb-countdown');
            const remaining = remainingTime(item, elmnt);
            
            if (remaining.startsWith('-')) { // Check if time has passed
                countdownElmnt.style.color = 'red';
                countdownElmnt.style.fontWeight = '600';
            } else {
                countdownElmnt.style.color = 'blue';
                countdownElmnt.style.fontWeight = '600';
            }

            countdownElmnt.innerText = remainingTime(item, elmnt);
        }

        // FOR INITIALIZE COUNTDOWN 😃
        const initCountdown = (dataprchs) => {
            dataprchs.forEach(item => {
                if (!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#ppb-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(dataprchs);
    </script>
@endsection