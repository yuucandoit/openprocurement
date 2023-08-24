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
                                        @foreach ($datapo as $po)
                                            <tr>
                                                <td>Code PO</td>
                                                <td>{{ $datacpo->code_po }}</td>
                                            </tr>
                                            <tr>
                                                <td>Who Submitted</td>
                                                <td>{{ $po->ppb->whosubmit->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>{{ $po->ppb->date_ps }}</td>
                                            </tr>
                                            <tr>
                                                <td>Department</td>
                                                <td>{{ $po->ppb->dps->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $po->ppb->desc }}</td>
                                            </tr>
                                            <tr>
                                                <td>Purpose</td>
                                                <td>{{ $po->ppb->purpose->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Send To</td>
                                                <td>{{ $po->ppb->send_to }}</td>
                                            </tr>
                                            <tr>
                                                <td>Deadline</td>
                                                <td>
                                                    @if($po->ppb->dateline == '≤24Jam')
                                                    <strong><p>1 Hari</p></strong>
                                                    @elseif ($po->ppb->dateline == '≤72Jam')
                                                    <strong><p>2 sd 3 Hari</p></strong>
                                                    @elseif ($po->ppb->dateline == '≤168Jam')
                                                    <strong><p>4 sd 7 Hari</p></strong>
                                                    @elseif ($po->ppb->dateline == '≤336Jam')
                                                    <strong><p>7 sd 14 Hari</p></strong>
                                                    @endif
                                                    {{-- {{ $po->ppb->dateline }} --}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Quotation</td>
                                                <td>{{ $po->quotation }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Vendor</td>
                                                @if (empty($po->vendorable_type))
                                                    Belum Diisi Datanya
                                                @else
                                                    <td>{{ $po->vendorable->nama ?? '-' }}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Approver Note</td>
                                                <td>
                                                    @if (empty($po->ppb->note_bod_pr))
                                                        -
                                                    @else
                                                        {{ $po->ppb->note_bod_pr }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Approve To</td>
                                                <td>
                                                    @if (empty($po->ppb->atasans->name))
                                                        -
                                                    @else
                                                        {{ $po->ppb->atasans->name }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @php
                                $item_po = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->first();
                                @endphp
                                @if(empty($item_po))
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
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($p->unit_price) }}</td>
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($p->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            @foreach ($dpp as $d)
                                                {{ $po->ppb->matauang }} {{ number_format($d->total) }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            @if($disc == null)
                                            0
                                            @else
                                                {{ $po->ppb->matauang }} {{ number_format($disc->discount) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $po->ppb->ppn }}"
                                                @if ($po->ppb->ppn == 1) @checked(true)
                                            @else
                                        @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        <td style="text-align:right;">
                                            @if ($po->ppb->ppn == 1)
                                                @foreach ($ppn as $p)
                                                    {{ $po->ppb->matauang }} {{ number_format($p->total) }}
                                                @endforeach
                                            @else
                                                @foreach ($ppn as $p)
                                                    {{ $po->ppb->matauang }} 0
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($po->ppb->ppn == 1)
                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total as $t)
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($t->total) }}</td>
                                            @endforeach
                                        @elseif ($po->ppb->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                <td style="text-align:right;">{{ $po->ppb->matauang }} {{ number_format($tpn->total) }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                </table>
                                @else
                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Category</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($po->itempo as $item)
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
                                @endif
                                <div class="mt-4">
                                    @if ($datacpo->status == 'Invoicing Process')
                                    <div class="text-center">
                                        <button class="btn btn-outline-success mt-2 text-center" data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai" disabled>Successfully send data</button>
                                    </div>
                                    @elseif ($datacpo->status == 'PO Approved')
                                        @if(empty($datacpo->atasan_py))
                                        <div class="text-center">
                                            <button class="btn btn-success mt-4 disabled" data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai">Apply For Payment
                                                Process
                                            </button>
                                        </div>
                                        @else
                                        <div class="text-center">
                                            <button class="btn btn-success mt-4 " data-bs-toggle="modal"
                                                data-bs-target="#modalSelesai">Apply For Payment
                                                Process
                                            </button>
                                        </div>
                                        @endif
                                    @endif
                                    <a href="{{ url()->previous() }}" class="btn "
                                        style=" color:white; background-color:black">Back</a>
                                    <a href="{{ url('/exportpdf/po_id/' . $po->id) }}" class="btn btn-danger">Export PDF</a>
                                </div>
                                <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h2 class="modal-title" style="color: white">Warning</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mx-5 mb-3 text-center">
                                                <span class="warning">
                                                    <img src="{{ asset('assets/images/warning.png') }}">
                                                </span>
                                                <h2 style="text-align: center">Make sure the data is correct!</h2>
                                            </div>
                                            {{-- End Modal Approval --}}

                                            <div class="modal-footer" style="text-align: center;">
                                                @if ($po->status == 'PO Approved')
                                                    <form class="text-center"
                                                        action="{{ url('payment_request/ajukan_dana_ppo/'.$po->id) }}">
                                                        <button type="submit" class="btn btn-outline-danger"><i
                                                                class="bx bx-trash"></i>
                                                            Send For Payment Approval
                                                        </button>
                                                    </form>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if($datacpo->ppb->atasanpymnt == null) --}}
            {{-- @else --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h6>Form Payment Request</h6>
                                <form class="row g-2 mt-4" action="{{ url('/payment_request/store/' . $datacpo->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <?php
                                        $duit = 100000002;

                                      foreach ($datacpo->itempo as $supply) {
                                          $itemprchs = $supply;
                                          $convert = (int)$itemprchs->grand_total;
                                        // $grand = $convert + 60000000;
                                      }

                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    class="icofont icofont-stamp"></i> Send Approval To</label>
                                            <select class="form-select form-select-lg" id="floatingproposedto"
                                                placeholder="Proposed To" name="atasan_py" required="">
                                                <option selected="" disabled="" value="">-- Send Approval To
                                                    --
                                                </option>
                                                @if(empty($convert))
                                                    @foreach ($atasan as $sui)
                                                        <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                    @endforeach
                                                @else
                                                    @if($convert < 10000001 )
                                                        @foreach ($atasan as $sui)
                                                            <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                        @endforeach
                                                    @elseif($convert < 50000001)
                                                        @foreach ($atasan1 as $sui1)
                                                            <option value="{{ $sui1->id }}">{{ $sui1->name }}</option>
                                                        @endforeach
                                                    @elseif($convert < 100000001)
                                                        @foreach ($atasan2 as $sui2)
                                                            <option value="{{ $sui2->id }}">{{ $sui2->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($atasan3 as $sui3)
                                                            <option value="{{ $sui3->id }}">{{ $sui3->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    class="icofont icofont-list"></i> Upload Invoice</label>
                                                    <input type="file" name="path_invoice" class="form-control form-control-lg">
                                            </div>
                                        </div>


                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a type="reset" class="btn btn-dark"
                                            href="{{ url('/payment_request/') }}">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endif --}}

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Comment</h4>
                                        <form action="{{ route('comment.store', $datacpo->ppb->id) }}" method="POST">
                                            @csrf
                                            <textarea class="form-control" name="comment" placeholder='Add Your Comment'></textarea>
                                            <div style="text-align: right; margin-top:20px;">
                                                <input type="submit" class="btn btn-primary" value="Comment">
                                                <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                            </div>
                                        </form>
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
                                            @endforeach
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
