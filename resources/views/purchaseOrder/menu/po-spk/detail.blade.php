<title>Detail PO SPK</title>

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
                            <li class="breadcrumb-item"><a href="{{ route('pospk.index') }}">PO SPK</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Modals PR --}}
                {{-- Modal Approve All PO --}}
                <div class="modal fade" id="modalApproveAll" tabindex="-1" aria-hidden="true">
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
                                <h2 style="text-align: center">Are you sure want to approve this request?</h2>
                            </div>
                            <div class="modal-footer">
                                <form class="text-center" style="text-align: center;" action="{{ route('pospk-approve', $datappb->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger ">
                                        <i class="bx bx-trash"></i>
                                        Approve!
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Reject PR With Reason --}}
                <div class="modal fade" id="modalRejectRequest" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h2 class="modal-title" style="color: white">Warning</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('pospk.reject.pr', $datappb->id) }}" method="POST">
                                @csrf
                                <div class="modal-body mb-3">
                                    <div class="form-group">
                                        <label for="floatingreason">Reason <span style="color: red">*</span> </label>
                                        <textarea name="reason" id="" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-danger ">
                                        <i class="bx bx-trash"></i>
                                        Reject!
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Modals PR --}}
            @php
                 $isRejected = str_contains(strtolower($datappb->status), 'reject');
                 $hasWaitingApproval = $datappb->quot->isNotEmpty();
            @endphp

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details {{ $datappb->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                            <table class="table table-bordered mt-4">
                                                <tbody>
                                                    <tr>
                                                        <td>Who Submitted</td>
                                                        <td>{{ $datappb->whosubmit->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>{{ $datappb->date_ps }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Department</td>
                                                        <td>{{ $datappb->dps->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Description</td>
                                                        <td>{{ $datappb->desc }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Purpose</td>
                                                        <td>{{ $datappb->purpose->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Send To</td>
                                                        <td>{{ $datappb->send_to }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date Send</td>
                                                        <td>{{ $datappb->dateline }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: 600;">SPK</td>
                                                        <td>
                                                            @if (empty($datappb->file_spk))
                                                                -
                                                            @else
                                                                <a href="/upload_spk/{{ $datappb->file_spk }}" target="_blank" style="color: rgb(226, 43, 43); text-decoration:underline;">{{ $datappb->file_spk }}</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Approver Note</td>
                                                        <td>
                                                            @if (empty($datappb->note_bod_pr))
                                                                -
                                                            @else
                                                                {{ $datappb->note_bod_pr }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Approve To</td>
                                                        <td>
                                                            @if (empty($datappb->atasans->name))
                                                                -
                                                            @else
                                                                {{ $datappb->atasans->name }}
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

                                                @foreach ($datappb->itemppn as $p)
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
                                <div class="row">
                                    <div class="col-12" style="text-align:center;">
                                        <button class="btn btn-success mt-3" data-bs-toggle="modal"data-bs-target="#modalApproveAll" {{ !$hasWaitingApproval ? 'disabled' : '' }}>
                                            Approve All
                                        </button>
                                        <button class="btn btn-danger mt-3" data-bs-toggle="modal"data-bs-target="#modalRejectRequest" {{ !$hasWaitingApproval ? 'disabled' : '' }}>
                                            Reject PR
                                        </button>
                                    </div>
                                </div>
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

            {{-- Accordion Section --}}
            <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h5>List PO</h5>
                      </div>
                      <div class="card-body">
                        @if (empty($datappb->quot))
                        {{-- <div class="card-body">
                            <h6 class="text-center">PO Not Found</h6>
                        </div> --}}
                        @else
                        <div class="default-according" id="accordionclose">
                        @foreach ($datappb->quot as $po)
                        @php
                            $isRejectedPo = str_contains(strtolower($po->status), 'reject');
                        @endphp
                            <div class="card">
                            <div class="card-header" id="heading{{ $po->id }}">
                                <h5 class="mb-0">
                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1">
                                    <span style="font-weight: bold; color:green; float: left;">{{ $po->code_po }}</span>
                                    <span style="float: left;">&nbsp; Vendor #{{ $po->vendorable->nama ?? '-' }}</span>
                                    <span style="float: left; font-weight:600; color:blueviolet;">&nbsp; ({{ $po->status ?? '-' }})</span>
                                    <span  style="float: right;">
                                        @if(empty($item_po))

                                        @else
                                        {{ $item_po->matauang }} {{ number_format($item_po->grand_total,2) }}
                                        @endif
                                    </span>
                                </button>
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
                                                    File&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
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
                                </div>

                                    <table class="table table-bordered item order-entry">
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
                                            @foreach ($po->itempo as $value)
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
                                    @if ($po->status != 'Waiting Approval PO SPK' && !$isRejectedPo)
                                        <button class="btn btn-success mt-3" data-bs-toggle="modal"
                                            data-bs-target="#modalApprovePO" disabled> PO Approved!
                                        </button>
                                        <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                            data-bs-target="#modalRejectPO" disabled> Reject PO
                                        </button>
                                    @elseif ($po->status == 'Waiting Approval PO SPK' && !$isRejectedPo)
                                        <button class="btn btn-success mt-3 " data-bs-toggle="modal"
                                            data-bs-target="#modalApprovePO{{ $po->id }}">
                                            Approve PO
                                        </button>
                                        <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                            data-bs-target="#modalRejectPO{{ $po->id }}"> Reject PO
                                        </button>
                                    @elseif ($po->status != 'Waiting Approval PO SPK' && $isRejectedPo)
                                        <button class="btn btn-success mt-3 " data-bs-toggle="modal"
                                            data-bs-target="#modalApprovePO" disabled>
                                            Approve PO
                                        </button>
                                        <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                            data-bs-target="#modalRejectPO" disabled> Rejected!
                                        </button>
                                    @else
                                        <button class="btn btn-success mt-3" data-bs-toggle="modal"
                                            data-bs-target="#modalApprovePO" disabled>
                                            Approve PO
                                        </button>
                                        <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                            data-bs-target="#modalRejectPO" disabled> Reject PO
                                        </button>
                                    @endif
                                    <div class="modal fade" id="modalApprovePO{{ $po->id }}" tabindex="-1" aria-hidden="true">
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
                                                    <h2 style="text-align: center">Are you sure want to approve this request?</h2>
                                                </div>
                                                <div class="modal-footer">
                                                    <form class="text-center" style="text-align: center;"
                                                        action="{{ route('pospk-approve-po', $po->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger ">
                                                            <i class="bx bx-trash"></i>
                                                            Approve!
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalRejectPO{{ $po->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h2 class="modal-title" style="color: white">Warning</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pospk.reject.po', $po->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body mb-3">
                                                        <div class="form-group">
                                                            <label for="floatingreason">Reason <span style="color: red">*</span> </label>
                                                            <textarea name="reason" id="" cols="30" rows="10" class="form-control" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-outline-danger ">
                                                            <i class="bx bx-trash"></i>
                                                            Reject!
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            </div>
                            </div>
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
                                        <form action="{{ route('comment.store', $datappb->id) }}" method="POST">
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
