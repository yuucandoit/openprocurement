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
                                                        <td>Processer</td>
                                                        <td>{{ $data_pengajuan->process_by ?? 'Tebet' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 600;">SPK</td>
                                                        <td>
                                                            @if (empty($data_pengajuan->file_spk))
                                                                -
                                                            @else
                                                                <a href="/upload_spk/{{ $data_pengajuan->file_spk }}" target="_blank" style="color: rgb(226, 43, 43); text-decoration:underline;">{{ $data_pengajuan->file_spk }}</a>
                                                            @endif
                                                        </td>
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
                                                    <th>UOM</th>
                                                    <th>File</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($pengajuan as $p)
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

                                <hr>

                                <style>

                                    .AllComment {
                                        box-sizing: border-box;
                                        border: 2px solid rgb(236, 236, 236);
                                        border-radius: 10px;
                                        padding: 15px 10px;
                                    }
                                </style>
                            </div>
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>
            </div>

            @php
                $year = Carbon\Carbon::now()->format('y');
                $month = Carbon\Carbon::now()->format('m');
            @endphp


            <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5>List PO</h5>
                      </div>
                      <div class="card-body">
                        @if (empty($vendor->vendorable->nama))
                        {{-- <div class="card-body">
                            <h6 class="text-center">PO Not Found</h6>
                        </div> --}}
                        @else
                        <div class="default-according" id="accordionclose">
                        @foreach ($items as $po)
                            @if($po->status == 'Cross Check PO')
                                <div class="card">
                                <div class="card-header" id="heading{{ $po->id }}">
                                    <h5 class="mb-0">
                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1"><span style="font-weight: bold; color:green;">{{ $po->code_po }}</span> Vendor #<span>{{ $po->vendorable->nama ?? '-' }}</span></button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapse{{ $po->id }}" aria-labelledby="heading{{ $po->id }}" data-bs-parent="#accordionclose{{ $po->id }}">
                                    <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label" style="font-weight: bold;">
                                                        Vendor &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        &nbsp; &nbsp;:
                                                        @if (empty($po->vendorable->nama))
                                                        @else
                                                            {{ $po->vendorable->nama ?? '-' }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label" style="font-weight: bold;">
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
                                                    <label class="form-label" style="font-weight: bold;">
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
                                                    <label class="form-label" style="font-weight: bold;">
                                                        File&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :
                                                        @if (empty($po->path_quotation))
                                                            -
                                                        @else
                                                            <a href="/upload_quotation/{!! nl2br($po->path_quotation) !!}" target="_blank">{!! nl2br($po->path_quotation) !!}</a>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>

                                            @if($po->payment_type == 'Bank')
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="form-label" style="font-weight: bold;">
                                                            Rekening :
                                                            @if (empty($po->vendorRek))
                                                            <br>
                                                                {{ $po->no_rekening ?? '-' }}
                                                            @else
                                                            <br>
                                                                {{ $po->vendorRek->no_rekening ?? '-' }} {{ $po->vendorRek->rel_bank->name ?? '' }}  "{{ $po->vendorRek->nama_penerima ?? '-' }}"
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            @elseif($po->payment_type == 'Va')
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label class="form-label" style="font-weight: bold;">
                                                            VA :
                                                            <br>
                                                            @if (!empty($po->va_code))
                                                            {{ $po->va_code }}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label" style="font-weight: bold;">
                                                        Invoice &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                                                        @if (empty($po->path_invoice))
                                                            -
                                                        @else
                                                            <a href="/upload_invoice/{!! nl2br($po->path_invoice) !!}" target="_blank">{!! nl2br($po->path_invoice) !!}</a>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label class="form-label" style="font-weight: bold;">
                                                        Creator &nbsp; &nbsp; :
                                                        @if (empty($po->creator_id) || empty($po->creator_name))
                                                            -
                                                        @else
                                                            <a>{{ $po->creator->name  ?? $po->creator_name ?? '-'}}</a>
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
                                                <th>UOM</th>
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
                                                    <td style="text-align:right;">{{ $data_pengajuan->matauang }} {{ number_format($p->unit_price) }}</td>
                                                    <td style="text-align:right;">{{ $data_pengajuan->matauang }} {{ number_format($p->total) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered ">
                                        <tr>
                                            <td><label class="pull-right mx-2"> DPP :</label></td>
                                            <td style="text-align: right;">
                                                @foreach ($dpp as $d)
                                                {{ $data_pengajuan->matauang }} {{ number_format($d->total) }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2"> Discount :</label></td>
                                            <td style="text-align: right;">
                                                {{ $data_pengajuan->matauang }} {{ number_format($disc->discount) }}
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
                                                        {{ $data_pengajuan->matauang }} {{ number_format($p->total,2) }}
                                                    @endforeach
                                                @else
                                                    @foreach ($ppn as $p)
                                                        {{ $data_pengajuan->matauang }} 0
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($data_pengajuan->ppn == 1)
                                            <tr>
                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                            @foreach ($total as $t)
                                                <td style="text-align:right;">{{ $data_pengajuan->matauang }} {{ number_format($t->total,2) }}</td>
                                            @endforeach
                                        @elseif ($data_pengajuan->ppn == 0)
                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                @foreach ($total_tnpa_ppn as $tpn)
                                                <td style="text-align:right;">{{ $data_pengajuan->matauang }} {{ number_format($tpn->total,2) }}</td>
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
                                                    <td class="text-end">{{ $item->matauang }} {{ number_format($item->unit_price,2) }}</td>
                                                    <td class="text-end">{{ $item->matauang }} {{ number_format($item->total,2)  }}</td>
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
                                                    {{ $value->matauang }} {{ number_format($value->dpp ,2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right mx-2"> Discount :</label></td>
                                                <td style="text-align: right;">
                                                    {{ $value->matauang }} {{ number_format($value->discount) }}
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
                                                    @php
                                                        $dpp = $value->dpp;
                                                        $disc = $value->discount;
                                                        $afterdisc = $dpp - $disc;
                                                        // dd($dpp);
                                                        $ppn = $afterdisc *11 /100;
                                                    @endphp
                                                    {{ $value->matauang }} {{ number_format($ppn,2) }}
                                                    @else
                                                    {{ $value->matauang }} 0
                                                    @endif

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right mx-2">Shipping & Protection Fee :</label></td>
                                                <td style="text-align: right;">
                                                    {{ $value->matauang }} {{ number_format($value->ongkir,2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right mx-2">Admin Or Service Fee :</label></td>
                                                <td style="text-align: right;">
                                                    {{ $value->matauang }} {{ number_format($value->admin_fee,2) }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                        :</td>
                                                <td style="text-align:right;">
                                                @if ($value->ppn == 1)
                                                    {{ $value->matauang }} {{ number_format($value->grand_total,2) }}
                                                @elseif ($value->ppn == 0)
                                                {{ $value->matauang }} {{ number_format($value->grand_total,2) }}</td>
                                                @endif
                                            </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                    </table>
                                    <a class="btn btn-secondary mt-3" href="{{ url('/exportpdf/po_id/' . $po->id) }}"
                                        target="_blank" style="font-size:12;">Export PDF PO</i>
                                    </a>
                                    <a href="{{ url('menu-purchase-order/edit/'.$po->id) }}" type="button" name="add" class=" btn btn-warning mt-3" target="_blank"> Edit PO <i class="icofont icofont-ui-add"></i></a>
                                        @if ($po->status == 'Waiting For PO Approval')
                                            <button class="btn btn-success mt-3" data-bs-toggle="modal"
                                                data-bs-target="#modalSendToBOD" disabled> Approval Request Sent
                                            </button>
                                        @elseif ($po->status == 'Cross Check PO')
                                            @if (empty($data_pengajuan->atasans->name))
                                                <button class="btn btn-success mt-3 " data-bs-toggle="modal"
                                                    data-bs-target="#modalSendToBOD{{ $po->id }}">
                                                    Send Approval PO
                                                </button>
                                            @else
                                                <button class="btn btn-success mt-3 " data-bs-toggle="modal"
                                                    data-bs-target="#modalSendToBOD{{ $po->id }}">
                                                    Send Approval PO
                                                </button>
                                            @endif
                                        @elseif($po->status == 'Reject PO')
                                            <button class="btn btn-success mt-3" data-bs-toggle="modal"
                                                data-bs-target="#modalSendToBOD{{ $po->id }}" disabled>
                                                Send Approval PO
                                            </button>
                                        @endif
                                        <div class="modal fade" id="modalSendToBOD{{ $po->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h2 class="modal-title" style="color: white">Warning</h2>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body mx-5 mb-3" style="text-align: center;">
                                                        <span class="warning">
                                                            <img src="{{ asset('assets/images/warning.png') }}" >
                                                        </span>
                                                        <h2 style="text-align: center">Make sure the data is correct!</h2>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form class="text-center" style="text-align: center;"
                                                            action="{{ url('check_po/ajukan_keatasan_po/' .$po->id) }}">
                                                            <input type="hidden" name="ppb_id" value="{{ $po->id }}">
                                                            <button type="submit" class="btn btn-outline-danger "><i
                                                                    class="bx bx-trash"></i>
                                                                    Send a purchase order approval request
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($po->status == 'Waiting For PO Approval')
                                            <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                                data-bs-target="#modalReject" disabled> Reject PO
                                            </button>
                                        @elseif ($po->status == 'Cross Check PO')
                                            @if (empty($data_pengajuan->atasans->name))
                                                <button class="btn btn-danger mt-3 " data-bs-toggle="modal"
                                                    data-bs-target="#modalReject{{ $po->id }}">
                                                    Reject PO
                                                </button>
                                            @else
                                                <button class="btn btn-danger mt-3 " data-bs-toggle="modal"
                                                    data-bs-target="#modalReject{{ $po->id }}">
                                                    Reject PO
                                                </button>
                                            @endif
                                        @elseif($po->status == 'Reject PO')
                                            <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                                data-bs-target="#modalReject{{ $po->id }}" disabled>
                                                PO Rejected
                                            </button>
                                        @endif

                                        <div class="modal fade" id="modalReject{{ $po->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h2 class="modal-title" style="color: white">Reject PO</h2>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('check_po.reject_po',$po->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="note" class="form-label">Reason <span style="color: red;">*</span> </label>
                                                                <textarea name="notes" id="note" class="form-control" cols="30" rows="20" placeholder="Reason Here . . ."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Reject</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- Comment Section --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Comment</h4>
                                        <form action="{{ route('comment.store', $data_pengajuan->id) }}" method="POST">
                                            @csrf
                                            <textarea class="form-control" name="comment" placeholder='Add Your Comment'></textarea>
                                            <div style="text-align: right; margin-top:20px;">
                                                <input type="submit" class="btn btn-primary" value="Comment">
                                                <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                            </div>
                                        </form>
                                    <div class="AllComment" id="comment">
                                        @foreach ($comments as $c)
                                            @if($c->user_id == Auth::user()->id)
                                            <ul style="text-align: end; padding-right:10px;">
                                                <li>
                                                    <p>
                                                        <strong>
                                                            @if (empty($c->users->name))
                                                            @else
                                                                You
                                                            @endif
                                                        </strong>
                                                        @if (empty($c->created_at))
                                                        @else
                                                        &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('| l | d-m-Y | H:i:s |') }}
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
                                            @else
                                            <ul style="padding-left:10px;">
                                                <li>
                                                    <p>
                                                        <strong>
                                                            @if (empty($c->users->name))
                                                            @else
                                                                {{ $c->users->name }}
                                                            @endif
                                                        </strong>
                                                        @if (empty($c->created_at))
                                                        @else
                                                            &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('| l | d-m-Y | H:i:s |') }}
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
                                            @endif

                                        @endforeach
                                    </div>
                            </div>
                        </div>
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
