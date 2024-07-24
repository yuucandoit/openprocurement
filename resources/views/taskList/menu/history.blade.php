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
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Request By</th>
                                            <th>Item</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                    $no = 1;
                                    $status = [];
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Purchase Proses' ||
                                        $ppb->status == 'Cross Check PO' ||
                                        $ppb->status == 'Waiting For PO Approval' ||
                                        $ppb->status == 'PO Approved' ||
                                        $ppb->status == 'Invoicing Process' ||
                                        $ppb->status == 'Payment Approved' ||
                                        $ppb->status == 'Unpaid' ||
                                        $ppb->status == 'Paid' ||
                                        $ppb->status == 'Delivery Process' ||
                                        $ppb->status == 'Delivery Success' ||
                                        $ppb->status == 'PO Rejected by BOD' ||
                                        $ppb->status == 'Rejected by Purchasing' ||
                                        $ppb->status == 'PO & Payment Approved'
                                        )
                                        @php
                                            $status[] = $ppb;
                                        @endphp
                                            <tbody>
                                                <tr style="background-color:#F1F6F5;">
                                                    <td style="text-align: center;">{{ $i++ }}</td>
                                                    <td>
                                                        <a href="{{ url('/menu-task-list/detail/' . $ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                            <li style="word-break: break-word;">{!! nl2br($ppb->desc) !!}</li>
                                                        </ul>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                        </ul>
                                                    </td>
                                                    <td style="text-align: center;">
                                                       <ul>
                                                        <li style="white-space: nowrap;">@if($ppb->dateline == '≤24Jam')
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
                                                                    style="color: white; font-size:12">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_bod_po }}</li>
                                                            @elseif($ppb->status == 'Rejected by Purchasing')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:12">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_purchase }}</li>
                                                            @elseif($ppb->status == 'Payment Rejected By BOD')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:12">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_bod_py }}</li>
                                                            @elseif($ppb->status == 'Rejected by Finance')
                                                            <li>
                                                                <a class="badge badge-danger mt-1 "
                                                                    style="color: white; font-size:12">{{ $ppb->status }}
                                                                </a>
                                                            </li>
                                                            <li class="badge badge-danger mt-2">{{ $ppb->note_finance }}</li>
                                                            @else
                                                            <li><a class="badge badge-success mt-1 "
                                                                style="color: white; font-size:12">{{ $ppb->status }}
                                                            </a>
                                                        </li>
                                                            @endif
                                                            <li></li>
                                                        </ul>
                                                    </td>
                                                    <td style="text-align: center; white-space:nowrap;">
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
                                                    </td>
                                                </tr>
                                                @foreach ($ppb->quot as $po)
                                                    <tr class="">

                                                        @php
                                                            $month = \Carbon\Carbon::parse($po->created_at)->format('m');
                                                            $year = \Carbon\Carbon::parse($po->created_at)->format('y');
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
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
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? '-' }}
                                                                        @endif
                                                                    </li>
                                                                    <li> Quotation : {{ $po2->quotation }}</li>
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
                                                        <td colspan="2"  class="text-center"><a
                                                            class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                        @endif
                                                    </tr>
                                                @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('export-historyPO') }}" class="btn btn-success">Export Data</a>
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
