<title>Detail Pages</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details PO {{ $datacpo->code_po }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-purchase-order/') }}">Purchase Order</a></li>
                            <li class="breadcrumb-item active">Details PO</li>
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
                                <h5 class="text-white">Details {{ $datacpo->ppb->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Code PO</td>
                                            <td>{{ $datacpo->code_po }}</td>
                                        </tr>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $datacpo->ppb->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $datacpo->ppb->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $datacpo->ppb->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $datacpo->ppb->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{ $datacpo->ppb->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $datacpo->ppb->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>
                                                @if($datacpo->ppb->dateline == '≤24Jam')
                                                <strong><p>1 Hari</p></strong>
                                                @elseif ($datacpo->ppb->dateline == '≤72Jam')
                                                <strong><p>2 sd 3 Hari</p></strong>
                                                @elseif ($datacpo->ppb->dateline == '≤168Jam')
                                                <strong><p>4 sd 7 Hari</p></strong>
                                                @elseif ($datacpo->ppb->dateline == '≤336Jam')
                                                <strong><p>7 sd 14 Hari</p></strong>
                                                @endif
                                                {{-- {{ $datacpo->ppb->dateline }} --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quotation</td>
                                            <td>{{ $datacpo->quotation }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Vendor</td>
                                            @if (empty($datacpo->vendorable_type))
                                                Belum Diisi Datanya
                                            @else
                                                <td>{{ $datacpo->vendorable->nama ?? '-' }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td style="font-weight: 600;">SPK</td>
                                            <td>
                                                @if (empty($datacpo->ppb->file_spk))
                                                    -
                                                @else
                                                    <a href="/upload_spk/{{ $datacpo->ppb->file_spk }}" target="_blank" style="color: rgb(226, 43, 43); text-decoration:underline;">{{ $datacpo->ppb->file_spk }}</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if (empty($datacpo->ppb->note_bod_pr))
                                                    -
                                                @else
                                                    {{ $datacpo->ppb->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Approve To</td>
                                            <td>
                                                @if (empty($datacpo->ppb->atasans->name))
                                                    -
                                                @else
                                                    {{ $datacpo->ppb->atasans->name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Notes</td>
                                            <td>
                                                @if (empty($datacpo->notes))
                                                    -
                                                @else
                                                    {{ $datacpo->notes }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if (empty($datacpo->status))
                                                    -
                                                @else
                                                    {{ $datacpo->status }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @php
                                   $item_po = \App\Models\ItemPO::where('po_id',$datacpo->id)->groupBy('po_id')->first();
                                @endphp

                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>UOM</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($datacpo->itempo as $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td style="text-align: center;">{{ $item->item }}</td>
                                                <td style="text-align: center;">{{ $item->qty }}</td>
                                                <td style="text-align: center;">{{ $item->kategori }}</td>
                                                <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item->unit_price) }}</td>
                                                <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->dpp) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->discount) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $item_po->ppn }}"
                                                @if ($item_po->ppn == 1) @checked(true)
                                                @else @endif
                                                disabled="true">
                                            <label class="pull-right mx-2"> PPN 11% :</label>
                                        </td>
                                        @php
                                            $dpp = $item_po->dpp;
                                            $disc = $item_po->discount;
                                            $afterdisc = $dpp - $disc;
                                            $ppn = $afterdisc *11 /100;
                                        @endphp
                                        <td style="text-align:right;">
                                            @if ($item_po->ppn == 1)
                                                {{ $item_po->matauang }} {{ number_format($ppn) }}
                                            @else
                                                {{ $item_po->matauang }} 0
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Shipping & Protection Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->ongkir) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Admin Or Service Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $item_po->matauang }} {{ number_format($item_po->admin_fee) }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                        <td style="text-align:right;">{{ $item_po->matauang }} {{ number_format($item_po->grand_total) }}</td>
                                    </tr>

                                </table>

                                <div class="mt-4 text-end">
                                    <a href="{{ url('po_spk') }}" class="btn" style=" color:white; background-color:black">Back</a>

                                    @if($datacpo->status != 'Waiting Approval PO SPK')
                                    <a class="btn btn-danger disabled" data-bs-toggle="modal"data-bs-target="#modalRejectPO" disabled>Reject</a>
                                    <a class="btn btn-success disabled" data-bs-toggle="modal"data-bs-target="#modalApprovePO" disabled>Approve</a>
                                    @else
                                    <a class="btn btn-danger" data-bs-toggle="modal"data-bs-target="#modalRejectPO">Reject</a>
                                    <a class="btn btn-success" data-bs-toggle="modal"data-bs-target="#modalApprovePO">Approve</a>
                                    @endif
                                    <a href="{{ url('/exportpdf/po_id/' . $datacpo->id) }}" class="btn" style="background-color:rgb(159, 158, 158); color:white;">Export PDF</a>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Approve PO --}}
                        <div class="modal fade" id="modalApprovePO" tabindex="-1" aria-hidden="true">
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
                                        <form class="text-center" style="text-align: center;" action="{{ route('pospk-approve-po', $datacpo->id) }}" method="POST">
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

                        {{-- Modal Reject PO --}}
                        <div class="modal fade" id="modalRejectPO" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h2 class="modal-title" style="color: white">Reason for reject</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pospk.reject.po', $datacpo->id) }}" method="POST">
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
    </section>
@endsection
