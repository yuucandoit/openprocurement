<title>Detail Pages</title>

@extends('layouts.master')

@section('main')
    <section>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details PO {{ $datacpo->code_po }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('delivery.index') }}">Delivery</a></li>
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
                                            <td>Resi Number</td>
                                            <td>
                                                @if (empty($datacpo->no_resi))
                                                    -
                                                @else
                                                   <strong> {{ $datacpo->no_resi }} </strong>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Arrival</td>
                                            <td>
                                                @if (empty($datacpo->first_estimate) && empty($datacpo->last_estimate))
                                                    -
                                                @else
                                                  <strong> Between "{{ \Carbon\Carbon::parse($datacpo->first_estimate)->format('D, d-M-Y') }}" - "{{ \Carbon\Carbon::parse($datacpo->last_estimate)->format('D, d-M-Y') }}" </strong>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                @php
                                   $item_po = \App\Models\ItemPO::where('po_id',$datacpo->id)->groupBy('po_id')->first();
                                @endphp

                                @if(empty($item_po))
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
                                                <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($p->unit_price) }}</td>
                                                <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($p->total) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            @foreach ($dpp as $d)
                                            {{ $datacpo->ppb->matauang }} {{ number_format($d->total) }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            @if($disc == null)
                                            0
                                            @else
                                            {{ $datacpo->ppb->matauang }} {{ number_format($disc->discount) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $datacpo->ppb->ppn }}"
                                                @if ($datacpo->ppb->ppn == 1) @checked(true)
                                            @else
                                        @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        <td style="text-align:right;">
                                            @if ($datacpo->ppb->ppn == 1)
                                                @foreach ($ppn as $p)
                                                    {{ $datacpo->ppb->matauang }} {{ number_format($p->total) }}
                                                @endforeach
                                            @else
                                                @foreach ($ppn as $p)
                                                    {{ $datacpo->ppb->matauang }} 0
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($datacpo->ppb->ppn == 1)
                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                            @foreach ($total as $t)
                                                <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($t->total) }}</td>
                                            @endforeach
                                        @elseif ($datacpo->ppb->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($tpn->total) }}</td>
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

                                @endif
                                <div class="row">
                                    <div class="col-md-12 mb-3 mt-4" style="text-align: center;">
                                         {{-- Start Modal Approval --}}
                                        @if ($datacpo->status == 'Delivery Success')
                                            <button class="btn btn-outline-success mt-3" disabled> Purchase Complete </button>
                                        @elseif ($datacpo->status == 'Paid')
                                            <button class="btn btn-outline-success mt-3" data-bs-toggle="modal" data-bs-target="#modalSelesai">
                                                Set Purchase Complete
                                            </button>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="col-md-12 mt-3">
                                        <a href="{{ url()->previous() }}" class="btn "
                                            style=" color:white; background-color:black">Back</a>
                                        <a href="{{ url('/exportpdf/po_id/' . $datacpo->id) }}" class="btn btn-danger">Export PDF</a>
                                    </div>
                                </div>
                                <div class="mt-4">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modals --}}
            <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Warning</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3" style="text-align: center;">
                            <span class="warning">
                                <img src="{{ asset('assets/images/warning.png') }}">
                            </span>
                            <h2 style="text-align: center; margin-top:25px;">Make Sure! <br>All Items Arrived</h2>
                        </div>
                        {{-- End Modal Approval --}}

                        <div class="modal-footer">
                            <form class="text-center"
                                action="{{ url('delivery/complete_2/' . $datacpo->id) }}">
                                <button type="submit" class="btn btn-outline-danger" @if ($datacpo->status != 'Paid') disabled @endif>
                                    Set Purchase Complete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalDeliveryOtw" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('delivery.startShip',$datacpo->id) }}" method="POST">
                            @csrf
                            <div class="modal-header bg-danger">
                                <h2 class="modal-title" style="color: white">Start Ship</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mb-3">
                                <div class="form-group">
                                    <label for="">No. Resi <span style="color: red;">*</span></label>
                                    <input type="text" name="no_resi" class="form-control" id="" placeholder="Resi Number" required>
                                </div>
                                <div class="row">
                                    <label for="" class="mb-2">Estimated Arrival of Goods <hr style="opacity:10; background-color:rgb(99, 99, 99);"></label>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Fastest <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="first_estimate" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Latest <span style="color: red;">*</span></label>
                                            <input type="date" class="form-control" name="last_estimate" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Approval --}}
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-danger">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFinishDelivery" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Report</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('delivery.endShip',$datacpo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="floatingReceiver">Receiver</label>
                                            <input required type="text" class="form-control" id="floatingReceiver" placeholder="Receiver" name="receiver">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="form-group">
                                            <label for="">Upload Photo</label>
                                            <input class="form-control" type="file" name="path_image" placeholder="Choose image" id="path_image" onchange="loadFile(event)">
                                            @error('path_image')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <img id="output" style="width: 200px;" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-danger">
                                    Complete !
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalSetBackDelivery" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Warning</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3" style="text-align: center;">
                            <span class="warning">
                                <img src="{{ asset('assets/images/warning.png') }}">
                            </span>
                            <h2 style="text-align: center; margin-top:25px;">
                                You are about to revert the delivery status <br> Are you sure you want to proceed?
                            </h2>
                        </div>
                        {{-- End Modal Approval --}}

                        <div class="modal-footer">
                            <form class="text-center" action="{{ route('delivery.setBackShippy',$datacpo->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    Yes, Proceed!
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modals --}}

             <!-- Container-fluid Ends-->
             <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Delivery Status</h5>
                        </div>
                      <div class="card-body">
                        @if(!$datacpo->deliveryStatus->isNotEmpty() && $datacpo->flag_delivery == 2)
                            <div style="text-align: center;">
                                <button class="btn btn-success" data-bs-target="#modalDeliveryOtw" data-bs-toggle="modal">Set Delivery On the way</button>
                            </div>
                        @elseif($datacpo->deliveryStatus->isNotEmpty() && $datacpo->flag_delivery == 0 || $datacpo->flag_delivery == 1)
                            <form action="{{ url('delivery/statusDeliveryStore/' . $datacpo->id) }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="floatingStatus">Status</label>
                                        <div class="input-group">
                                            <input name="status" type="text" class="form-control" id="floatingStatus" placeholder="Out Delivery Jakarta ....">
                                            <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Submit</button>
                                            <a href="{{ route('delivery.track_po',$datacpo->id) }}" class="btn btn-secondary" target="_blank" style="margin-left: 10px;">Timeline</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"  data-bs-target="#modalFinishDelivery" data-bs-toggle="modal">Complete Delivery</button>
                                </div>
                            </form>
                        @elseif($datacpo->deliveryStatus->isNotEmpty() && $datacpo->flag_delivery == 2)
                            <div style="text-align: center;">
                                <h3>Package Arrived !</h3>
                                <button class="btn btn-warning mt-3" data-bs-target="#modalSetBackDelivery" data-bs-toggle="modal">Undo</button>
                            </div>
                        @else
                            <div style="text-align: center;">
                                <button class="btn btn-success" data-bs-target="#modalDeliveryOtw" data-bs-toggle="modal">Set Delivery On the way</button>
                            </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
    </section>
@endsection
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
