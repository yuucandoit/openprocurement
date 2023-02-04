<title>Detail Task List PO</title>

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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-taskList-atasan-po.index') }}">Task List Super
                                    user PO</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
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
                                        <td>Date Line</td>
                                        <td>{{ $data_pengajuan->dateline }}</td>
                                    </tr>
                                    <tr>
                                        <td>PDF Quotation</td>
                                        <td>
                                 @foreach ($items as $pdf)
                                        @if(empty($pdf->path_quotation))

                                        @else
                                        <a href="/upload_quotation/{{ $pdf->path_quotation }}" target="_blank" class="btn btn-danger">PDF Quotation</a>
                                        @endif
                                @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="container-fluid">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="card">
                                    @if (empty($vendor->vendorable->nama))
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
                                                                    Quotation &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :
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
                                                                    File :
                                                                    @if (empty($po->path_quotation))
                                                                        -
                                                                    @else
                                                                        <br>
                                                                        {!! nl2br($po->path_quotation) !!}
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                </div>
                                                @if(empty($vendor->item))

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
                                                    @foreach ($datapo as $i)
                                                        @if ($i->vendorable_id == $po->vendorable_id)
                                                            @if ($i->vendorable_type == $po->vendorable_type)
                                                            <tr>
                                                                <td class="text-center">{{ $id++ }}</td>
                                                                <td class="text-center">{{ $i->item }}</td>
                                                                <td class="text-center">{{ $i->qty }}</td>
                                                                <td class="text-center">{{ $i->kategori }}</td>
                                                                @if ($i->matauang == 'RP')
                                                                    <td class="text-end">RP.
                                                                        {{ number_format($i->unit_price) }}</td>
                                                                    <td class="text-end">RP. {{ number_format($i->total) }}
                                                                    </td>
                                                                @elseif($i->matauang == 'USD')
                                                                    <td class="text-end">$
                                                                        {{ number_format($i->unit_price) }}.00</td>
                                                                    <td class="text-end">$
                                                                        {{ number_format($i->total) }}.00</td>
                                                                @endif
                                                            </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </table>
                                                <table class="table table-bordered ">
                                                    <tbody>
                                                @foreach ($items as $calculate)
                                                    @if ($calculate->vendorable_id == $po->vendorable_id)
                                                    @if ($calculate->vendorable_type == $po->vendorable_type)
                                                    {{-- @if($calculate->item == $po->item) --}}
                                                        <tr>
                                                            <td><label class="pull-right mx-2"> DPP :</label></td>
                                                            <td style="text-align: right;">
                                                                @if ($calculate->matauang == 'RP')
                                                                    RP. {{ number_format($calculate->dpp) }}
                                                                @elseif ($calculate->matauang == 'USD')
                                                                    $ {{ number_format($calculate->dpp) }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label class="pull-right mx-2"> Discount :</label></td>
                                                            <td style="text-align: right;">
                                                                @if ($calculate->matauang == 'RP')
                                                                    RP. {{ number_format($calculate->discount) }}
                                                                @elseif ($calculate->matauang == 'USD')
                                                                    $ {{ number_format($calculate->discount) }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                                    value="{{ $calculate->ppn }}"
                                                                    @if ($calculate->ppn == 1) @checked(true)
                                                                    @else
                                                                    @endif
                                                                    disabled="true"><label class="pull-right mx-2"> PPN 11%
                                                                    :</label></td>
                                                            <td style="text-align:right;">
                                                                @if ($calculate->ppn == 1)
                                                                @php
                                                                    $dpp = $calculate->dpp;
                                                                    $disc = $calculate->discount;
                                                                    $afterdisc = $dpp - $disc;
                                                                    // dd($afterdisc);
                                                                    $ppn = $afterdisc *11 /100;
                                                                @endphp
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($ppn) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($ppn) }}
                                                                    @endif
                                                                @else
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. 0
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ 0
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                                    :</td>
                                                            @if ($calculate->ppn == 1)
                                                            <td style="text-align:right;">
                                                                @if ($calculate->matauang == 'RP')
                                                                    RP.{{ number_format($calculate->grand_total) }}
                                                                @elseif ($calculate->matauang == 'USD')
                                                                    ${{ number_format($calculate->grand_total) }}
                                                                @endif
                                                            </td>
                                                            @elseif ($calculate->ppn == 0)
                                                            <td style="text-align:right;">
                                                                @if ($calculate->matauang == 'RP')
                                                                RP.{{ number_format($calculate->grand_total) }}</td>
                                                                @elseif ($calculate->matauang == 'USD')
                                                                ${{ number_format($calculate->grand_total) }}
                                                                @endif
                                                            </td>
                                                            </tr>
                                                        {{-- @endif --}}
                                                        @endif
                                                        @endif
                                                    @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
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
                             <!-- Modal -->
                             <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="rejectLabel">Reject Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('menu-taskList-atasan-po/reject', $data_pengajuan->id) }}" id="formAdd" method="get"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Comment</label>
                                            <textarea name="note_po" id="note" class="form-control" cols="30" rows="0" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                             <!-- Modal -->
                             <div class="modal fade" id="approve" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="approveLabel">Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('menu-taskList-atasan-po/accept_atasan', $data_pengajuan->id) }}" method="get">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Approver Note</label>
                                            <textarea name="note_po" id="note" class="form-control" ></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>


                                <div class="mt-3">
                            @hasrole('super user|super admin')
                                    @if ($data_pengajuan->status == 'PO Approved' ||
                                    $data_pengajuan->status == 'Invoicing Process' ||
                                    $data_pengajuan->status == 'Payment Approved' ||
                                    $data_pengajuan->status == 'Unpaid' ||
                                    $data_pengajuan->status == 'Paid' ||
                                    $data_pengajuan->status == 'Delivery Process' ||
                                    $data_pengajuan->status == 'Delivery Success')
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-danger text-center" onclick="return">Reject</a>
                                    @elseif($data_pengajuan->status == 'Waiting For PO Approval')
                                    <button type="button" class="btn btn-success text-center" data-bs-toggle="modal" data-bs-target="#approve"> Approve</button>
                                    <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                    @else
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-success text-center" onclick="return">Aprove</a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                    @endif
                                @endhasrole
                            </div>
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

                             <div class="container">
                                <div class="mt-4">
                                     <form action="{{ route('comment.store',$data_pengajuan->id) }}" method="POST" >
                                        @csrf
                                        <textarea name="comment" class="form-control" placeholder='Add Your Comment'></textarea>
                                        <div style="text-align: right; margin-top:20px">
                                            <input type="submit" class="btn btn-primary" value="Comment">
                                            <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                        </div>
                                     </form>
                                    </div>
                                </div>

                                <div class="AllComment" id="comment">
                                    <div class="container">
                                            @foreach($comments as $c)
                                                    {{-- <p>{{ $c->ppb->status }}</p> --}}
                                                    @if($c->ppb->atasan_po == 3)
                                                    <ul>
                                                        <li style="margin-top: 10px;">
                                                            <p>
                                                                <strong>
                                                                @if(empty($c->users->name))

                                                                @else
                                                                - {{ $c->users->name }}
                                                                @endif
                                                            </strong>
                                                            @if(empty($c->created_at))

                                                            @else
                                                            &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                            @endif
                                                            </p>
                                                        </li>
                                                        <li>
                                                            @if(empty($c->comment))

                                                            @else
                                                            <p>{{ $c->comment }}</p>
                                                            @endif
                                                        </li>
                                                        <hr>
                                                    </ul>
                                                        @elseif($c->ppb->atasan_po == 6)
                                                        <ul>
                                                            <li style="margin-top: 10px;">
                                                                <p>
                                                                    <strong>
                                                                    @if(empty($c->users->name))

                                                                    @else
                                                                    - {{ $c->users->name }}
                                                                    @endif
                                                                </strong>
                                                                @if(empty($c->created_at))

                                                                @else
                                                                &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                                @endif
                                                                </p>
                                                            </li>
                                                            <li>
                                                                @if(empty($c->comment))

                                                                @else
                                                                <p>{{ $c->comment }}</p>
                                                                @endif
                                                            </li>
                                                            <hr>
                                                        </ul>
                                                        @elseif($c->ppb->atasan_po == 7)
                                                        <ul>
                                                            <li style="margin-top: 10px;">
                                                                <p>
                                                                    <strong>
                                                                    @if(empty($c->users->name))

                                                                    @else
                                                                    - {{ $c->users->name }}
                                                                    @endif
                                                                </strong>
                                                                @if(empty($c->created_at))

                                                                @else
                                                                &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                                @endif
                                                                </p>
                                                            </li>
                                                            <li>
                                                                @if(empty($c->comment))

                                                                @else
                                                                <p>{{ $c->comment }}</p>
                                                                @endif
                                                            </li>
                                                            <hr>
                                                        </ul>
                                                        @elseif($c->ppb->atasan_po == 8)
                                                        <ul>
                                                            <li style="margin-top: 10px;">
                                                                <p>
                                                                    <strong>
                                                                    @if(empty($c->users->name))

                                                                    @else
                                                                    - {{ $c->users->name }}
                                                                    @endif
                                                                </strong>
                                                                @if(empty($c->created_at))

                                                                @else
                                                                &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                                @endif
                                                                </p>
                                                            </li>
                                                            <li>
                                                                @if(empty($c->comment))

                                                                @else
                                                                <p>{{ $c->comment }}</p>
                                                                @endif
                                                            </li>
                                                            <hr>
                                                        </ul>
                                                        @elseif($c->ppb->atasan_po == 9)
                                                        <ul>
                                                            <li style="margin-top: 10px;">
                                                                <p>
                                                                    <strong>
                                                                    @if(empty($c->users->name))

                                                                    @else
                                                                    - {{ $c->users->name }}
                                                                    @endif
                                                                </strong>
                                                                @if(empty($c->created_at))

                                                                @else
                                                                &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                                @endif
                                                                </p>
                                                            </li>
                                                            <li>
                                                                @if(empty($c->comment))

                                                                @else
                                                                <p>{{ $c->comment }}</p>
                                                                @endif
                                                            </li>
                                                            <hr>
                                                        </ul>
                                                    @endif
                                            @endforeach
                                     </div>
                                </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>

    </section>
@endsection

