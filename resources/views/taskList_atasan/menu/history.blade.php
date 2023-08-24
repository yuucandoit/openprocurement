<title>History Task List PR</title>

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
        <div class="modal fade" id="modalSort" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">

                        <h4 class="modal-title">Sort </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('menu-taskList-atasan.SortHistoryPrBod') }}" method="get" class="input-group" >
                    <div class="modal-body ">
                        @php
                            $i = 1;
                        @endphp
                        <h4>Sort by status </h4>
                        <div class="row" >
                            <div class="col-sm-6" >
                                <ul>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Purchase Request Approved' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="Purchase Request Approved">&nbsp;Purchase Request Approved
                                        </label>
                                    </li>
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
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Purchase Request Rejected By BOD' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="Purchase Request Rejected By BOD">&nbsp;PR Rejected By BOD
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Rejected by Purchasing' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="Rejected by Purchasing">&nbsp;Rejected by Purchasing
                                        </label>
                                    </li>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'PO Rejected by BOD' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="PO Rejected by BOD">&nbsp;PO Rejected by BOD
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6" >
                                <ul>
                                    <li>
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Invoicing Process' ? 'checked': '' }}  style="margin-left:auto;" name="sort[]" type="checkbox" value="Invoicing Process">&nbsp;Invoicing Process
                                        </label>
                                    </li>
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
                                        <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Payment Rejected By BOD' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Payment Rejected By BOD">&nbsp;Payment Rejected By BOD
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
                        <h3>History Task List Purchase Request</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">History Task List Purchase Request</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-absolute">
                    <div class="row">
                        <div class="col-sm-8">
                            <div style="margin-bottom:-20px; margin-top: 30px; margin-left:30px;">
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
                        <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-taskList-atasan.SearchTaskRequestBodOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                                {{-- Data Keluar --}}
                            <table class="table table-bordered table-hover" >
                                <thead class="bg-primary">
                                    <tr style="text-align: center;">
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Deadline</th>
                                        <th>Request By</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                @php
                                    $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                    $no = 1;
                                @endphp
                                @foreach ($datappb as $ppb)
                                            <tbody>
                                            <tr style="background-color:#F1F6F5;">
                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                <td>
                                                    <a href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}">
                                                    {{ $ppb->code_pengajuan }}
                                                    </a>
                                                </td>
                                                <td><a href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                <td>
                                                    <ul style="white-space: nowrap;">
                                                        <li style="white-space: nowrap;">
                                                            Estimate &nbsp;:
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
                                                        <li>
                                                            <p>Created &nbsp;At : {{ \Carbon\Carbon::parse($ppb->created_at)->format('d-F-y') }}</p>
                                                        </li>
                                                        <li>
                                                            @if($ppb->status == 'Delivery Success')
                                                            <p>Finished At : {{ \Carbon\Carbon::parse($ppb->updated_at)->format('d-F-y') }}</p>
                                                            @else
                                                            <p>Finished At : -</p>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                <td style="text-align: center;">
                                                    <ul>
                                                    @if($ppb->status == 'Rejected by Purchasing' || $ppb->status == 'Purchase Request Rejected By BOD' || $ppb->status == 'PO Rejected by BOD' || $ppb->status == 'Payment Rejected By BOD' || $ppb->status == 'Rejected by Finance')
                                                        <li>
                                                            <a class="badge badge-danger mt-1" style="color: white; font-size:10">
                                                                {{ $ppb->status }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="mt-1" style=" font-size:10; font-weight:600;">
                                                                {{ \Carbon\Carbon::parse($ppb->approved_at)->format('d-m-y  H:i:s') }}
                                                             </a>
                                                        </li>
                                                        <li>
                                                            <a class="mt-1" style=" font-size:10; font-weight:600;">
                                                                @if($ppb->status == 'Rejected by Purchasing')
                                                                    @if(empty($ppb->note_purchase))
                                                                    -
                                                                    @else
                                                                    <a class="badge badge-danger" style="font-size: 10;">{{ $ppb->note_purchase }}</a>
                                                                    @endif
                                                                @endif

                                                                @if($ppb->status == 'Purchase Request Rejected By BOD')
                                                                    @if(empty($ppb->note_bod_pr))
                                                                    -
                                                                    @else
                                                                    <a class="badge badge-danger" style="font-size: 10;">{{ $ppb->note_bod_pr }}</a>
                                                                    @endif
                                                                @endif

                                                                @if($ppb->status == 'PO Rejected by BOD')
                                                                    @if(empty($ppb->note_bod_po))
                                                                    -
                                                                    @else
                                                                    <a class="badge badge-danger" style="font-size: 10;">{{ $ppb->note_bod_po }}</a>
                                                                    @endif
                                                                @endif

                                                                @if($ppb->status == 'Payment Rejected By BOD')
                                                                    @if(empty($ppb->note_bod_py))
                                                                    -
                                                                    @else
                                                                    <a class="badge badge-danger" style="font-size: 10;">{{ $ppb->note_bod_py }}</a>
                                                                    @endif
                                                                @endif

                                                                @if($ppb->status == 'Rejected by Finance')
                                                                    @if(empty($ppb->note_finance))
                                                                    -
                                                                    @else
                                                                    <a class="badge badge-danger" style="font-size: 10;">{{ $ppb->note_finance }}</a>
                                                                    @endif
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @else
                                                    <li>
                                                        <a class="badge badge-success mt-1" style="color: white; font-size:10">
                                                            Approved
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class=" mt-1" style=" font-size:10; font-weight:600;">
                                                            {{ \Carbon\Carbon::parse($ppb->approved_at)->format('d-m-y H:i:s') }}
                                                         </a>
                                                    </li>
                                                    @endif
                                                    </ul>
                                                </td>
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
                                                    <td>-</td>
                                                    <td>{{ $po->code_po }}</td>
                                                    <td>
                                                        <a href="{{ route('menu-taskList-atasan.po_detail',$po->id) }}">
                                                        <ul>
                                                            <li>
                                                                @if($po2->vendorable_id == 0)
                                                                Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                @else
                                                                Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? ' - ' }}
                                                                @endif
                                                            </li>
                                                            <li> Quotation : {{ $po2->quotation }}</li>
                                                        </ul>
                                                        </a>
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
                                                    <td class="text-center">
                                                        @if($ppb->status == 'Rejected by Purchasing' || $ppb->status == 'Purchase Request Rejected By BOD' || $ppb->status == 'PO Rejected by BOD' || $ppb->status == 'Payment Rejected By BOD' || $ppb->status == 'Rejected by Finance')
                                                        <ul>
                                                            <li><a class="badge badge-danger mt-1"style="color: white; font-size:10">Rejected</a></li>
                                                        </ul>
                                                        @else
                                                        <ul>
                                                            <li><a class="badge badge-success mt-1"style="color: white; font-size:10">Approved</a></li>
                                                            <li><a class=" mt-1" style=" font-size:10; font-weight:600;">
                                                                {{ \Carbon\Carbon::parse($po2->approved_at)->format('d-m-y H:i:s') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        @endif
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                @endforeach
                            </table>
                            {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        //Checkbox Cek All
        $("#head-cb").on('click', function() {
            var isChecked = $('#head-cb').prop('checked')
            $(".child-cb").prop('checked', isChecked)
            $("#button-approve-selected").prop('disabled', !isChecked)
        })

        $(".tasklist ").on('click', '.child-cb', function() {
            if ($(this).prop('checked') != true) {
                $("#head-cb").prop('checked', false)
            }
            let semua_checkbox = $(".tasklist  .child-cb:checked")
            let button_approve_selected = (semua_checkbox.length > 0)

            $("#button-approve-selected").prop('disabled', !button_approve_selected)
        })

        function approveDataTerpilih() {
            let checkbox_terpilih = $(".tasklist .child-cb:checked")
            let semua_id = []
            $.each(checkbox_terpilih, function(index, elm) {
                semua_id.push(elm.value)
            })
            let ids = semua_id.join(',')
            $("#button-approve-selected").prop('disabled', true)
            $("#form-export-terpilih [name='ids']").val(ids)
            $("#form-export-terpilih").submit()
            // $.ajax({
            //     url: "{{ url('products') }}" + '/barcodeSelected'+ '/'+ id,
            //     method:'GET',
            //     success:function(res){
            //         console.log(res)
            //         $("#button-export-selected").prop('disabled',true)
            //     }
            // })
        }
    </script>
@endsection
