<title>Detail Funding</title>

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
                            <li class="breadcrumb-item"><a href="{{ route('menu-pengajuan-dana.index') }}">Funding
                                    Submission</a></li>
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
                                            <td>Approver Note</td>
                                            <td>
                                                @if(empty($data_pengajuan->note_bod_py))
                                                -
                                                @else
                                                {{ $data_pengajuan->note_bod_py }}
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
                                                                        File &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :
                                                                        @if (empty($po->path_quotation))
                                                                            -
                                                                        @else
                                                                            <a href="/upload_quotation/{{($po->path_quotation)}}" target="_blank">{!! nl2br($po->path_quotation) !!}</a>
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
                                                    <a class="btn btn-danger mt-3" href="{{ url('/exportpdf/po/' . $data_pengajuan->id) }}"
                                                        target="_blank" style="font-size:12;">Export PDF PO</i>
                                                    </a>
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
                                                        @foreach ($po->itempo as $i)
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
                                                                            {{ number_format($i->unit_price /100,2) }}</td>
                                                                        <td class="text-end">$
                                                                            {{ number_format($i->total /100,2) }}</td>
                                                                    @endif
                                                                </tr>
                                                        @endforeach
                                                    </table>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    @foreach ($groupedItem as $calculate)
                                                        @if ($calculate->po_id == $po->id)
                                                        {{-- @if($calculate->item == $po->item) --}}
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> DPP :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->dpp) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->dpp /100,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><label class="pull-right mx-2"> Discount :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->discount) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->discount /100,2) }}
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
                                                                            $ {{ number_format($ppn /100 ,2) }}
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
                                                                <td><label class="pull-right mx-2">Shipping & Protection Fee :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->ongkir,2) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->ongkir ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2">Admin Or Service Fee :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                        RP. {{ number_format($calculate->admin_fee,2) }}
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                        $ {{ number_format($calculate->admin_fee ,2) }}
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
                                                                        ${{ number_format($calculate->grand_total /100,2) }}
                                                                    @endif
                                                                </td>
                                                                @elseif ($calculate->ppn == 0)
                                                                <td style="text-align:right;">
                                                                    @if ($calculate->matauang == 'RP')
                                                                    RP.{{ number_format($calculate->grand_total) }}</td>
                                                                    @elseif ($calculate->matauang == 'USD')
                                                                    ${{ number_format($calculate->grand_total /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                                </tr>
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

                                  <div class="mt-3" style="text-align: right;">
                                    <a type="reset" class="btn btn-dark" href="{{ url('/menu-pengajuan-dana/') }}"
                                        style="float: left;">Back</a>
                                    @hasrole('finance|super admin')
                                        @if ($data_pengajuan->status == 'Paid')
                                            <div class="text-center">
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                    class="btn btn-success text-center" onclick="return"><b>Paid Success</b></a>

                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                    class="btn btn-danger text-center" onclick="return">Reject</a>
                                            </div>
                                        @elseif($data_pengajuan->status == 'Unpaid')
                                            <div class="text-center">
                                                <a href="{{ url('menu-pengajuan-dana/paid', $data_pengajuan->id) }}"
                                                    class="btn btn-success text-center" onclick="return">Paid</a>

                                                <a href="{{ url('menu-pengajuan-dana/reject', $data_pengajuan->id) }}"
                                                    class="btn btn-danger text-center" onclick="return">Reject</a>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                    class="btn btn-success text-center" onclick="return">Paid</a>

                                                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                    class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                            </div>
                                        @endif
                                    @endhasrole

                                </div>

                                <style>


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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
        </div>

    </section>
@endsection


<!-- JavaScript Item -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".order-entry").on("keyup", ".form-calc", function() {
            var parent = $(this).closest("tr");
            parent.find(".form-line").val((parent.find(".form-qty").val() * parent.find(".form-cost")
                .val()).toFixed(0));
            var total = 0;
            var checkbox = document.querySelector(".check-box");
            checkbox.addEventListener('change', (event) => {
                if (event.currentTarget.checked) {
                    totalppn = total * 11 / 100;
                    $(".total").text(totalppn);
                } else {
                    $(".total").text(total.toFixed(0));
                }
            })
            $(".form-line").each(function() {
                total += parseInt($(this).val() || 0);
            });

        });
    });
</script>

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
