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
                                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                                        :</td>
                                                                <td style="text-align:right;">
                                                                @if ($value->ppn == 1)
                                                                    @if ($value->matauang == 'RP')
                                                                        RP.{{ number_format($value->grand_total) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        ${{ number_format($value->grand_total ,2) }}
                                                                    @endif
                                                                @elseif ($value->ppn == 0)
                                                                    @if ($value->matauang == 'RP')
                                                                    RP.{{ number_format($value->grand_total) }}</td>
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



                                {{-- Start Modal Approval --}}
                                @if ($data_pengajuan->status == 'Waiting For PO Approval')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai" disabled>Approval Request Sent
                                    </button>
                                @elseif ($data_pengajuan->status == 'Cross Check PO')
                                    @if (empty($data_pengajuan->atasans->name))
                                        <div class="text-center">
                                            <button class="btn btn-outline-success mt-2 disabled" data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai">Send Approval Request For Purchase
                                                Order</button>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai">Send Approval Request For Purchase
                                                Order</button>
                                        </div>
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
                                            {{-- End Modal Approval --}}

                                            <div class="modal-footer">
                                                    <form class="text-center" style="text-align: center;"
                                                        action="{{ url('check_po/ajukan_keatasan/' . $data_pengajuan->id) }}">
                                                        <button type="submit" class="btn btn-outline-danger "><i
                                                                class="bx bx-trash"></i>
                                                            Send Approval Request For Purchase Order
                                                        </button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
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
                    }

                    .page {
                        height: 60px;
                    }

                    .terms {
                        height: 60px;
                    }
                </style>

    </section>
@endsection
