<title>Detail Purchase Order</title>

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
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-purchase-order/') }}">Purchase Order</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details {{ $data_pengajuan->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-6">
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
                                            <td>{{ $data_pengajuan->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $data_pengajuan->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Send</td>
                                            <td>{{ $data_pengajuan->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if (empty($data_pengajuan->note_bod_pr))
                                                    -
                                                @else
                                                    {{ $data_pengajuan->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Approve To</td>
                                            <td>
                                                @if (empty($data_pengajuan->atasans->name))
                                                    -
                                                @else
                                                    {{ $data_pengajuan->atasans->name }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered mt-4 mb-4 order-entry">
                                        <thead>
                                            <tr class="text-center"
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Category</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($pengajuan as $p)
                                            {{-- @php
                                                foreach ($items as $item) {
                                                    foreach ($item->itempo as $i) {
                                                        $qtypo = $i->qty;
                                                        $qtypp = $p->qty;
                                                        $sum = $qtypo - $qtypp;
                                                    }
                                                }
                                            @endphp --}}
                                                <tr>
                                                    <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                    <td style="text-align: center;">{{ $p->qty }}</td>
                                                    <td style="text-align: center;">{{ $p->kategori }}</td>
                                                    <td style="text-align: center;">
                                                    @if(empty($p->path_file))
                                                     -
                                                    @else
                                                    <a href="/upload_pengajuan/{{ $p->path_file }}" class="btn btn-danger" target="_blank">See File</a>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </div>
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
                                                                        RP.{{ number_format($value->grand_total,2) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        ${{ number_format($value->grand_total ,2) }}
                                                                    @endif
                                                                @elseif ($value->ppn == 0)
                                                                    @if ($value->matauang == 'RP')
                                                                    RP.{{ number_format($value->grand_total,2) }}</td>
                                                                    @elseif ($value->matauang == 'USD')
                                                                    ${{ number_format($value->grand_total ,2) }}
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
                                                    <a href="{{ url('menu-purchase-order/edit/'.$po->id) }}" type="button" name="add" class=" btn btn-warning mt-3" target="_blank"> Edit PO <i class="fa fa-plus"></i></a>
                                                    @endif

                                                    {{-- @if ($data_pengajuan->status == 'Waiting For PO Approval')
                                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#modalSelesai" disabled>Check PO Done
                                                    </button>
                                                @elseif ($data_pengajuan->status == 'Purchase Proses' || 'Cross Check PO')
                                                    @if (empty($data_pengajuan->atasans->name))
                                                        <div class="text-end">
                                                            <button class="btn btn-outline-success mt-2 disabled" data-bs-toggle="modal"
                                                                data-bs-target="#modalSelesai">Check PO</button>
                                                        </div>
                                                    @else
                                                    @if($data_pengajuan->status == 'Cross Check PO')
                                                    <div class="text-end">
                                                        <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                                            data-bs-target="#modalSelesai" disabled>PO On Check</button>
                                                    </div>
                                                    @else
                                                    <div class="text-end">
                                                        <button class="btn btn-outline-success mt-2 " data-bs-toggle="modal"
                                                            data-bs-target="#modalSelesai">Check PO</button>
                                                    </div>
                                                    @endif
                                                    @endif
                                                @endif --}}
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

                                  {{-- Start Modal Approval --}}
                                @if ($data_pengajuan->status == 'Waiting For PO Approval')
                                <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                    data-bs-target="#modalSelesai" disabled>Check PO Done
                                </button>
                            @elseif ($data_pengajuan->status == 'Purchase Proses' || 'Cross Check PO')
                                @if (empty($data_pengajuan->atasans->name))
                                    <div class="text-center">
                                        <button class="btn btn-outline-success mt-2 disabled" data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai">Check PO</button>
                                    </div>
                                @else
                                @if($data_pengajuan->status == 'Cross Check PO')
                                <div class="text-center">
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai" disabled>PO On Check</button>
                                </div>
                                @else
                                <div class="text-center">
                                    <button class="btn btn-outline-success mt-2 " data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai">Check PO</button>
                                </div>
                                @endif
                                @endif
                            @endif


                                <style>
                                    /* textarea {
                                               height: 20px;
                                               width: 100%;
                                               border: none;
                                               border-bottom: 2px solid #aaa;
                                               background-color: transparent;
                                               margin-bottom: 10px;
                                               resize: none;
                                               outline: none;
                                               transition: .5s
                                           } */

                                    .AllComment {
                                        box-sizing: border-box;
                                        border: 2px solid rgb(236, 236, 236);
                                        border-radius: 10px;
                                        padding: 15px 10px;
                                    }
                                </style>

                                <div class="mt-4">
                                    <form action="{{ route('comment.store', $data_pengajuan->id) }}" method="POST">
                                        @csrf
                                        <textarea class="form-control" name="comment" placeholder='Add Your Comment'></textarea>
                                        <div style="text-align: right; margin-top:20px;">
                                            <input type="submit" class="btn btn-primary" value="Comment">
                                            <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="AllComment" id="comment">
                                    <div class="container">
                                        @foreach ($comments as $c)
                                            <ul>
                                                <li>
                                                    <p>
                                                        <strong>
                                                            @if (empty($c->users->name))
                                                            @else
                                                                - {{ $c->users->name }}
                                                            @endif
                                                        </strong>
                                                        @if (empty($c->created_at))
                                                        @else
                                                            &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if (empty($c->comment))
                                                    @else
                                                        <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h2 class="modal-title" style="color: white">Warning</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mx-5 mb-3">
                                                <span class="warning">
                                                    <img src="{{ asset('assets/images/warning.png') }}">
                                                </span>
                                                <h2 style="text-align: center">Make sure the data is correct!</h2>
                                            </div>
                                            <div class="modal-footer">
                                                @if ($data_pengajuan->status == 'Purchase Proses')

                                                    <form class="text-center" style="text-align: center;"
                                                        action="{{ url('menu-purchase-order/check_po/'.$data_pengajuan->id) }}">
                                                        <button type="submit" class="btn btn-outline-danger "><i
                                                                class="bx bx-trash"></i>
                                                           Check PO
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modalCreatePO" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title">Create PO</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-2 mt-4" action="{{ url('/menu-purchase-order/store/' . $data_pengajuan->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf


                                                    <div class="col-md-4 ">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i
                                                                    class="fa fa-database"></i> Select
                                                                Vendor</label>
                                                            <select class="form-select page pageSelect" id="pageSelect"
                                                                placeholder="Proposed To" name="vendor">
                                                                <option value="" disabled selected hidden>Select
                                                                    Vendor
                                                                </option>
                                                                <option value="company">Company</option>
                                                                <option value="privateperson">Private Person
                                                                </option>
                                                                <option value="ecommerce">Ecommerce</option>
                                                            </select>

                                                            <select class=" form-select perusahaan_0 hide mt-2" id="selectedInput"
                                                                name="perusahaan">
                                                                @foreach ($pt as $p)
                                                                <option value="{{ $p->id }}">{{ $p->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                            <select class=" form-select privateperson_0 hide mt-2" id="selectedInput2"
                                                                name="orangpribadi">
                                                                @foreach ($op as $o)
                                                                <option value="{{ $o->id }}">{{ $o->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                            <select class=" form-select ecommerce_0 hide mt-2" id="selectedInput3"
                                                                name="ecommerce">
                                                                @foreach ($ec as $e)
                                                                <option value="{{ $e->id }}">{{ $e->nama }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 page" style="margin-top: 10px;">
                                                        <div class="form-group">
                                                            <label for="floatingQuotation"><i class="fa fa-file-excel-o"></i>
                                                                Quotation</label>
                                                            <div class="form-floating">
                                                                <input required type="text" class="form-control" id="floatingQuotation"
                                                                    placeholder="Quotation" name="quotation">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i
                                                                    class="fa fa-file-text-o"></i> Terms &
                                                                Conditions</label>
                                                            <select class="form-select page pageSelector" id="pageSelector"
                                                                placeholder="Terms and Conditions" name="term_conditions">
                                                                <option value="" disabled selected hidden>Terms And
                                                                    Conditions
                                                                </option>
                                                                @foreach ($terms as $t)
                                                                <option value="{{ $t->id }}">
                                                                    {{ $t->term_condition }}
                                                                </option>
                                                                @endforeach
                                                                <option value="custom">+ Add Terms & Conditions
                                                                </option>
                                                            </select>
                                                            <textarea class="hide form-control customInput" name="term_condition"
                                                                id="customInput" cols="30" rows="10"
                                                                placeholder="Input Terms And Conditions"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                <i class="fa fa-file-pdf-o" style="font-weight: bold;"></i>
                                                                Upload Quotation
                                                            </label>
                                                            <input type="file" name="path_quotation" class="form-control form-control-lg">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 ">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i
                                                                    class="icofont icofont-stamp"></i> Send Approval To:</label>
                                                            <select class="form-select page" id="floatingproposedto"
                                                                placeholder="Proposed To" name="atasan_po" required="">
                                                                <option selected="" disabled="" value="">-- Please Choose
                                                                    One
                                                                    --
                                                                </option>
                                                                @foreach ($atasan as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label" style="font-weight: bold;"><i class="fa fa-money"></i>
                                                                Currency :</label>
                                                            <select class="form-select page currency" id="floatingdateline" placeholder="Mata Uang"
                                                                name="matauang" required="">
                                                                <option value="RP">RP</option>
                                                                <option value="USD">USD</option>
                                                            </select>
                                                            @error('matauang')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="load">
                                                    <table class="table table-bordered item order-entry mx-2" >
                                                        <tr style="text-align: center;">
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Item</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Qty</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                UOM</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Unit Price</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Total</th>
                                                            <th
                                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                Action</th>
                                                        </tr>
                                                        @php
                                                        $id = 0;
                                                        $id++;
                                                        @endphp
                                                        @foreach ($pengajuan as $i)
                                                        <tr class="form-row">
                                                        <td class="text">

                                                            <input type="text" placeholder="Input Item" class="form-control" name="item[]"
                                                                style="text-align: center;" value="{{ $i->item }}" />
                                                        </td>
                                                        <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                                class="form-control form-calc form-qty" style="text-align: center;"
                                                                value="{{ $i->qty }}" min="1" max="{{ $i->qty }}" />
                                                        </td>
                                                        <td>
                                                            <select class="form-select " placeholder="Kategori" name="kategori[]"
                                                                value="{{ $i->kategori }}">
                                                                <option value="{{ $i->kategori }}">
                                                                    {{ $i->kategori }}</option>
                                                                <option value="Pcs">Pcs </option>
                                                                <option value="Lusin">Lusin </option>
                                                                <option value="Box">Box </option>
                                                                <option value="Unit">Unit </option>
                                                                <option value="Lot">Lot </option>
                                                                <option value="Rim">Rim </option>
                                                                <option value="Org">Org </option>
                                                                <option value="Line">Line </option>
                                                                <option value="Ruang">Ruang </option>
                                                                <option value="Pax">Pax </option>
                                                                <option value="Set">Set </option>
                                                                <option value="Piece">Piece </option>
                                                                <option value="Rol">Rol </option>
                                                                <option value="Pack">Pack </option>
                                                                <option value="Batang">Batang </option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                                <input type="text" name="unit_price[]" placeholder="Input Price"
                                                                class="form-control text-end form-calc form-cost dollar"
                                                                style="text-align: right;" required />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="total[]" class="form-control form-line"
                                                                style="text-align: right;" required  value="0"/>
                                                        </td>
                                                        <td style="text-align: center;"><button type="button"
                                                                class="btn btn-danger remove-input-field"><i
                                                                    class="fa fa-times"></i></button></td>

                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="4">
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    DPP :</label>
                                                            </td>
                                                            <td colspan="2">
                                                                <input style="background-color: #ffff;" class="total_A form-control text-end" type="text" name="dpp" value="0" readonly >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Discount :</label>
                                                            </td>
                                                            <td class="text-end" colspan="2">
                                                                <input class="form-control discount form-calc dollar text-end" type="text"
                                                                    id="discount" name="discount" value="0">
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                                    Discount :</label>
                                                            </td>
                                                            <td class="text-end total_disc" colspan="2">
                                                                <input style="background-color: #ffff;" value="0"  class="form-control total_disc text-end" type="text"
                                                                    name="total_disc" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <input class="mt-1 pull-right check-box-create" type="checkbox" name="ppn"
                                                                    value="1" {{ old('ppn', 0)===1 ? 'checked' : '' }}>
                                                                <label class="pull-right" style="font-weight: bold;"> PPN 11%
                                                                </label>
                                                            </td>
                                                            <td class="ppn text-end" colspan="2">
                                                                <input style="display: none;" class="ppn" type="text" name="ppn" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Shipping & Protection Fee :</label>
                                                            </td>
                                                            <td colspan="2">
                                                                <input  class="ongkir form-control text-end dollar" type="text" name="ongkir" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Admin & Service Fee :</label>
                                                            </td>
                                                            <td colspan="2">
                                                                <input  class="adminfee form-control text-end dollar" type="text" name="admin_fee" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="text-end" style="font-weight: bold;">Grand Total
                                                                :</td>
                                                            <td colspan="2">
                                                                <input class="form-control text-end total"
                                                                    type="text" name="grand_total" value="0">
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    {{-- <table class="table table-bordered mx-2" style="margin-top: 0px;">
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    DPP :</label>
                                                            </td>
                                                            <td>
                                                                <input style="background-color: #ffff;" class="total_A form-control text-end" type="text" name="dpp" value="0" readonly >
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Discount :</label>
                                                            </td>
                                                            <td class="text-end">
                                                                <input class="form-control discount form-calc dollar text-end" type="text"
                                                                    id="discount" name="discount" value="0">
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                                    Discount :</label>
                                                            </td>
                                                            <td class="text-end total_disc">
                                                                <input style="background-color: #ffff;" value="0"  class="form-control total_disc text-end" type="text"
                                                                    name="total_disc" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input class="mt-1 pull-right check-box-create" type="checkbox" name="ppn"
                                                                    value="1" {{ old('ppn', 0)===1 ? 'checked' : '' }}>
                                                                <label class="pull-right" style="font-weight: bold;"> PPN 11%
                                                                </label>
                                                            </td>
                                                            <td class="ppn text-end">
                                                                <input style="display: none;" class="ppn" type="text" name="ppn" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Shipping & Protection Fee :</label>
                                                            </td>
                                                            <td>
                                                                <input  class="ongkir form-control text-end dollar" type="text" name="ongkir" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="pull-right"
                                                                    style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Admin & Service Fee :</label>
                                                            </td>
                                                            <td>
                                                                <input  class="adminfee form-control text-end dollar" type="text" name="admin_fee" value="0">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-end" style="font-weight: bold;">Grand Total
                                                                :</td>
                                                            <td>
                                                                <input class="form-control text-end total"
                                                                    type="text" name="grand_total" value="0">
                                                            </td>
                                                        </tr>
                                                    </table> --}}
                                                </div>
                                                    <div class="form-group" style="text-align:right;">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a type="reset" class="btn btn-dark"
                                                            href="{{ url('/menu-purchase-order/') }}">Back</a>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                            </div>
                                        </div>


                                <div class="mt-4">
                                    <button type="button" name="add" class=" btn btn-outline-primary"  data-bs-toggle="modal"
                                    data-bs-target="#modalCreatePO" data-backdrop="static" data-keyboard="false"> Create PO <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>

                <style>
                    .tutup {
                        width: 0;
                        height: 0;
                        opacity: 0;
                    }
                    .createPO {
                        display: none;
                    }

                    .hide {
                    width: 0;
                    height: 0;
                    opacity: 0;
                    display: none;
                    }

                    .page {
                        height: 60px;
                    }

                    .terms {
                        height: 60px;
                    }
                </style>

    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('assets/AutoNumeric/dist/autoNumeric.min.js') }}"></script>

    {{-- <script>
        var currency =  document.querySelector('.currency');
        // console.log(currency);

        currency.addEventListener('change', function(){
            if (this.value == "USD"){
            document.querySelector('.form-cost').classList.remove('rupiah');
            document.querySelector('.form-cost').classList.add('dollar');
            const dollars = document.querySelectorAll('.dollar');
            dollars.forEach(dollar => {
                new AutoNumeric(dollar,{
                    alwaysAllowDecimalCharacter: true
                });
            })
            const rupiahs = document.querySelectorAll('.rupiah');
            rupiahs.forEach(rupiah => {
                new AutoNumeric(rupiah,'integer');
            })

        } else  {
            document.querySelector('.form-cost').classList.remove('dollar');
            document.querySelector('.form-cost').classList.add('rupiah');
        }
        })
    </script> --}}
    <script>
        const dollars = document.querySelectorAll('.dollar');
        dollars.forEach(dollar => {
            new AutoNumeric(dollar,'dotDecimalCharCommaSeparator');
        })

    </script>

    <script type="text/javascript">
        //Math
        document.querySelectorAll('.form-row').forEach(row => {
            row.addEventListener('input', (e) => updateFileds(e, row));
        })

        function updateFileds(event, row) {
            const qty = row.querySelector('.form-qty').value;
            const price = row.querySelector('.form-cost').value.replace(/\,/g, "");
            const totalElmnt = row.querySelector('.form-line');
            // const discount = row.querySelector('discount');
            // const afterDisc = row.querySelector('total_disc')
            // const dpp = row.querySelector('.total_A');

            totalElmnt.value = new Intl.NumberFormat('en-IN').format(qty *  price);
            var dpp = 0;
            $('.form-line').each(function(key, item){
                // console.log(item);
                dpp += new Number(item.value.replace(/\,/g, ""));
            });
            $(".total_A").val(new Intl.NumberFormat('en-IN').format(dpp));


        var discount = 0 ;
            var diskon = document.querySelector(".discount");
            diskon.addEventListener("input", function() {
                var disc = diskon.value;
                var rep = disc.replace(/\,/g, "");
                var discint = parseInt(rep);
                discount = dpp - discint;
                console.log(discount);
                $(".total_disc").val(new Intl.NumberFormat('en-IN').format(discount));
        })

        var checkbox = document.querySelector(".check-box-create");

        checkbox.addEventListener('change', (event) => {
            var totalppn = 0;
            if (event.currentTarget.checked) {
                totalppn = discount * 11 / 100;
                ppntotal2 = discount + totalppn;
                console.log(discount);
                console.log(ppntotal2);
                $(".ppn").text(totalppn.toLocaleString('en-US'));

                var ongkir = document.querySelector(".ongkir");
                ongkir.addEventListener("input", function(){
                    var ongkos = ongkir.value;
                    var replace = ongkos.replace(/\,/g, "");
                    var ongkoskirim = parseInt(replace);
                    console.log(ppntotal2);
                    grandtotal = ongkoskirim  + ppntotal2;
                });
                var adminfee = document.querySelector(".adminfee");
                adminfee.addEventListener("input", function(){
                    var admin = adminfee.value;
                    var replace = admin.replace(/\,/g, "");
                    var biayaAdmin = parseInt(replace);
                    grandtotal2 = biayaAdmin  + grandtotal ;
                    $(".total").val(grandtotal2);
                });
            } else {
                totalppn = discount * 0;
                ppntotal2 = discount + totalppn;
                $(".ppn").text(totalppn);

                var ongkir = document.querySelector(".ongkir");
                ongkir.addEventListener("input", function(){
                    var ongkos = ongkir.value;
                    var replace = ongkos.replace(/\,/g, "");
                    var ongkoskirim = parseInt(replace);
                    console.log(ppntotal2);
                    grandtotal = ongkoskirim  + ppntotal2 ;
                });
                var adminfee = document.querySelector(".adminfee");
                adminfee.addEventListener("input", function(){
                    var admin = adminfee.value;
                    var replace = admin.replace(/\,/g, "");
                    var biayaAdmin = parseInt(replace);
                    grandtotal2 = biayaAdmin  + grandtotal ;
                    $(".total").val(grandtotal2);
                });
            }
        });
        };


        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
        var rupiah = document.querySelectorAll(".rupiah");
        rupiah.forEach((item) => {
            item.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                item.value = formatRupiah(this.value, "");
            });
        });

    </script>

    <script type="text/javascript">
        var pageSelector = document.querySelector('.pageSelector');
                                var customInput = document.querySelector('.customInput');
                                pageSelector.addEventListener('change', function() {
                                    if (this.value == "custom") {
                                        customInput.classList.remove('hide');
                                    } else {
                                        customInput.classList.add('hide');
                                    }
                                })
    </script>
    <script type="text/javascript">
        var pageSelect = document.querySelector('.pageSelect');

                                var selectedInput = document.querySelector('.perusahaan_0');
                                var selectedInput2 = document.querySelector('.privateperson_0');
                                var selectedInput3 = document.querySelector('.ecommerce_0');
                                // Company
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "company") {
                                        selectedInput.classList.remove('hide');
                                    } else {
                                        selectedInput.classList.add('hide');
                                    }
                                })
                                // Private Person
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "privateperson") {
                                        selectedInput2.classList.remove('hide');
                                    }  else {
                                        selectedInput2.classList.add('hide');
                                    }
                                })
                                // Ecommerce
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "ecommerce") {
                                        selectedInput3.classList.remove('hide');
                                    }  else {
                                        selectedInput3.classList.add('hide');
                                    }
                                })
    </script>



@endsection
