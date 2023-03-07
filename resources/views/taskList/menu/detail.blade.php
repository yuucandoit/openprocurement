<title>Detail Purchasing</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-task-list') }}">Task List Purchasing</a></li>
                            <li class="breadcrumb-item active">Details</li>
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
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
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
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details From {{ $data_pengajuan->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $data_pengajuan->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $data_pengajuan->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $data_pengajuan->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $data_pengajuan->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td> {{ $data_pengajuan->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $data_pengajuan->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>{{ $data_pengajuan->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if(empty($data_pengajuan->note_bod_pr))
                                                -
                                                @else
                                                {{ $data_pengajuan->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="card">
                                        @if (empty($vendor->vendorable->nama))
                                        <div class="card-body">
                                            <h6 class="text-center">PO Not Found</h6>
                                        </div>
                                        @else
                                        @foreach ($items as $po)

                                          <div class="card-body">
                                            <div class="default-according" id="accordionclose{{ $po->id }}">

                                              <div class="card">
                                                <div class="card-header" id="heading{{ $po->id }}">
                                                  <h5 class="mb-0">
                                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1">Vendor #<span>{{ $po->vendorable->nama }}</span></button>
                                                  </h5>
                                                </div>
                                                <div class="collapse" id="collapse{{ $po->id }}" aria-labelledby="heading{{ $po->id }}" data-bs-parent="#accordionclose{{ $po->id }}">
                                                  <div class="card-body">
                                                    <div class="row">
                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        Vendor &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                        &nbsp; &nbsp;:
                                                                        @if (empty($po->vendorable->nama))
                                                                        @else
                                                                            {{ $po->vendorable->nama }}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        Quotation  :
                                                                        @if (empty($po->quotation))
                                                                        @else
                                                                            {{ $po->quotation }}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        Terms conditions :
                                                                        @if (empty($po->term->term_condition))
                                                                        @else
                                                                            <br>
                                                                            {!! nl2br($po->term->term_condition) !!}
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 ">
                                                                <div class="form-group">
                                                                    <label class="form-label" style="font-weight: bold;"><i
                                                                            class="fa fa-database"></i>
                                                                        File&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                                                                        @if (empty($po->path_quotation))
                                                                            -
                                                                        @else
                                                                            <a href="/upload_quotation/{!! nl2br($po->path_quotation) !!}" target="_blank">{!! nl2br($po->path_quotation) !!}</a>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                @php
                                                    foreach($po->itempo as $i)
                                                {
                                                    $e = $i->po_id;
                                                }
                                                @endphp

                                                    @if(empty($e))

                                                    <table class="table table-bordered mt-4 mb-4 order-entry">
                                                        <thead>
                                                            <tr class="text-center"
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                                <th>Item</th>
                                                                <th>Qty</th>
                                                                <th>Category</th>
                                                                <th>Price-per-unit</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pengajuan as $p)
                                                                <tr>
                                                                    <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                                    <td style="text-align: center;">{{ $p->qty }}</td>
                                                                    <td style="text-align: center;">{{ $p->kategori }}</td>
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                                        </td>
                                                                        <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        <td style="text-align:right;">$ {{ number_format($p->unit_price /100 ,2) }}
                                                                        </td>
                                                                        <td style="text-align:right;">$ {{ number_format($p->total /100 ,2) }}</td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-bordered ">
                                                        <tr>
                                                            <td><label class="pull-right mx-2"> DPP :</label></td>
                                                            <td style="text-align: right;">
                                                                @foreach ($dpp as $d)
                                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        RP. {{ number_format($d->total) }}
                                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        $ {{ number_format($d->total /100 ,2) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="pull-right mx-2"> Discount :</label></td>
                                                            <td style="text-align: right;">
                                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        RP. {{ number_format($disc->discount) }}
                                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        $ {{ number_format($disc->discount /100 ,2) }}
                                                                    @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                                    value="{{ $data_pengajuan->ppn }}"
                                                                    @if ($data_pengajuan->ppn == 1) @checked(true)
                                                                @else
                                                            @endif
                                                                    disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                                            <td style="text-align:right;">
                                                                @if ($data_pengajuan->ppn == 1)
                                                                    @foreach ($ppn as $p)
                                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                                        @if ($data_pengajuan->matauang == 'RP')
                                                                            RP. {{ number_format($p->total) }}
                                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                                            $ {{ number_format($p->total /100 ,2) }}
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    @foreach ($ppn as $p)
                                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                                        @if ($data_pengajuan->matauang == 'RP')
                                                                            RP. 0
                                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                                            $ 0
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if ($data_pengajuan->ppn == 1)
                                                            <tr>
                                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                                                @foreach ($total as $t)
                                                                    {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                                        {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                                    @endif
                                                                @endforeach
                                                            @elseif ($data_pengajuan->ppn == 0)
                                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                                @foreach ($total_tnpa_ppn as $tpn)
                                                                    @if ($data_pengajuan->matauang == 'RP')
                                                                        <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                                        <td style="text-align:right;">$ {{ number_format($tpn->total /100 ,2) }}</td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endif
                                                    </table>

                                                    @else


                                                    <table class="table table-bordered item order-entry mx-2">
                                                        <tr style="text-align: center;">
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                No</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Item</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Qty</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Category</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Price-per-unit</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Total</th>
                                                        </tr>
                                                        @php
                                                            $id = 1;
                                                        @endphp
                                                        @foreach ($po->itempo as $item)
                                                        {{-- {{ dd($item) }} --}}
                                                                <tr>
                                                                    <td class="text-center">{{ $id++ }}</td>
                                                                    <td class="text-center">{{ $item->item }}</td>
                                                                    <td class="text-center">{{ $item->qty }}</td>
                                                                    <td class="text-center">{{ $item->kategori }}</td>

                                                                    @if ($item->matauang == 'RP')
                                                                        <td class="text-end">RP.
                                                                            {{ number_format($item->unit_price,2) }}</td>
                                                                        <td class="text-end">RP. {{ number_format($item->total,2)  }}
                                                                        </td>
                                                                    @elseif($item->matauang == 'USD')
                                                                        <td class="text-end">$
                                                                            {{ number_format($item->unit_price  ,2) }}</td>
                                                                        <td class="text-end">$
                                                                            {{ number_format($item->total  ,2) }}</td>
                                                                    @endif
                                                                </tr>
                                                        @endforeach
                                                    </table>
                                                    <table class="table table-bordered ">
                                                        <tbody>
                                                            @foreach ($groupedItem as $value)
                                                            @if($value->po_id === $po->id)
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> DPP :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->dpp ,2) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->dpp ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> Discount :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->discount) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->discount ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input class="mt-1 pull-right check-box" type="checkbox"
                                                                        value="{{ $value->ppn }}"
                                                                        @if ($value->ppn == 1) @checked(true)
                                                                        @else
                                                                        @endif
                                                                        disabled="true"><label class="pull-right mx-2"> PPN 11%
                                                                        :</label>
                                                                    </td>
                                                                <td style="text-align:right;">
                                                                    @if ($value->ppn == 1)
                                                                    {{-- @dd($value->ppn) --}}
                                                                    @php
                                                                        $dpp = $value->dpp;
                                                                        $disc = $value->discount;
                                                                        $afterdisc = $dpp - $disc;
                                                                        // dd($dpp);
                                                                        $ppn = $afterdisc *11 /100;
                                                                    @endphp
                                                                        @if ($value->matauang == 'RP')
                                                                            RP. {{ number_format($ppn,2) }}
                                                                        @elseif ($value->matauang == 'USD')
                                                                            $ {{ number_format($ppn ,2) }}
                                                                        @endif
                                                                    @else
                                                                        @if ($value->matauang == 'RP')
                                                                            RP. 0
                                                                        @elseif ($value->matauang == 'USD')
                                                                            $ 0
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2">Shipping & Protection Fee :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->ongkir,2) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->ongkir ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2">Admin Or Service Fee :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->admin_fee,2) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->admin_fee ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                                        :</td>
                                                                <td style="text-align:right;">
                                                                @if ($value->ppn == 1)
                                                                    @if ($value->matauang == 'RP')
                                                                        RP.{{ number_format($value->grand_total) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        ${{ number_format($value->grand_total /100 ,2) }}
                                                                    @endif
                                                                @elseif ($value->ppn == 0)
                                                                    @if ($value->matauang == 'RP')
                                                                    RP.{{ number_format($value->grand_total) }}</td>
                                                                    @elseif ($value->matauang == 'USD')
                                                                    ${{ number_format($value->grand_total /100 ,2) }}
                                                                    @endif

                                                                @endif
                                                            </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            </tbody>
                                                    </table>
                                                    <a class="btn btn-danger mt-3" href="{{ url('/exportpdf/po_id/' . $po->id) }}"
                                                        target="_blank" style="font-size:12;">Export PDF PO</i>
                                                    </a>
                                                    <a class="btn btn-danger mt-3" href="{{ url('/exportpdf/pymnt_id/' . $po->id) }}"
                                                        target="_blank" style="font-size:12;">Export PDF Payment</i>
                                                    </a>
                                                    <a href="{{ url('menu-purchase-order/edit/'.$po->id) }}" type="button" name="add" class=" btn btn-warning mt-3" target="_blank"> Edit PO <i class="fa fa-plus"></i></a>

                                                    @endif
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          @endforeach
                                        @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <hr>


                                <div>
                                    <a href="{{ url('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) }}"
                                        class="btn btn-success" style="align-self: flex-end"> Export Excel Purchase Request</a>
                                        <a href="{{ url('/export_excel/purchase_order/' . $data_pengajuan->id) }}"
                                            class="btn btn-success" style="align-self: flex-end"> Export Excel Purchase Order</a>
                                        <a href="{{ url('/export_excel/pengajuan_dana/' . $data_pengajuan->id) }}"
                                            class="btn btn-success" style="align-self: flex-end"> Export Excel Payment</a>
                                </div>
                                  <!-- Modal -->
                            <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="rejectLabel">Reject Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('menu-task-list/reject', $data_pengajuan->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Comment</label>
                                            <textarea name="note_purchase" id="note" class="form-control" cols="30" rows="0" required></textarea>
                                        </div>
                                        <div class="col-md-12 mt-4">
                                            <div class="form-group">
                                                <input type="file" name="path_img" placeholder="Choose file" onchange="loadFile(event)" enctype="multipart/form-data"  class="form-control" >
                                                {{-- <input type="file" name="path_file[]" placeholder="Choose File"> --}}
                                                @error('path_img')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                       <img id="output" style="width: 200px;" />
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>

                                    </div>
                                </div>
                            </div>
                            </div>
                                <div class="mt-3">
                                    @hasrole('purchasing|super admin')
                                        <form action="{{ url('menu-task-list/accept', $data_pengajuan->id) }}" method="get">
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Comment</label>
                                                <textarea name="note_purchase" id="note" class="form-control" cols="30" rows="0"></textarea>
                                            </div>
                                            @if ($data_pengajuan->status == 'Purchase Proses' ||
                                            $data_pengajuan->status == 'Waiting For PO Approval' ||
                                            $data_pengajuan->status == 'PO Approved' ||
                                            $data_pengajuan->status == 'Invoicing Process' ||
                                            $data_pengajuan->status == 'Unpaid' ||
                                            $data_pengajuan->status == 'Paid' ||
                                            $data_pengajuan->status == 'Delivery Process' ||
                                            $data_pengajuan->status == 'Delivery Success')
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return"><b>On Process</b></a>
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                            @elseif($data_pengajuan->status == 'Purchase Request Approved')
                                            <button type="submit" class="btn btn-success text-center"> Process</button>
                                            <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                            @else
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return">Process</a>
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                            @endif
                                        </form>
                                        @endhasrole
                                    </div>
                                {{-- <div class="mt-3 text-right">
                                    @hasrole('purchasing|super admin')
                                        @if ($data_pengajuan->status == 'Purchase Proses' ||
                                            $data_pengajuan->status == 'Waiting For PO Approval' ||
                                            $data_pengajuan->status == 'PO Approved' ||
                                            $data_pengajuan->status == 'Invoicing Process' ||
                                            $data_pengajuan->status == 'Unpaid' ||
                                            $data_pengajuan->status == 'Paid' ||
                                            $data_pengajuan->status == 'Delivery Process' ||
                                            $data_pengajuan->status == 'Delivery Success')
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-success text-center" onclick="return"><b>Approved</b></a>

                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-danger text-center" onclick="return">Reject</a>
                                        @elseif($data_pengajuan->status == 'Purchase Request Approved')
                                            <a href="{{ url('menu-task-list/accept', $data_pengajuan->id) }}"
                                                class="btn btn-success text-center" onclick="return">Approve</a>

                                            <a href="{{ url('menu-task-list/reject', $data_pengajuan->id) }}"
                                                class="btn btn-danger text-center" onclick="return">Reject</a>
                                        @else
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-success text-center" onclick="return">Approve</a>

                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                        @endif
                                    @endhasrole
                                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            var loadFile = function(event) {
                var output = document.getElementById('output');

                if (output === null) {
                    output.src = "Image Not Found";
                } else {
                    output.src = URL.createObjectURL(event.target.files[0]);
                }
            };
        </script>
    </section>
@endsection
