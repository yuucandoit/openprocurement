<title>Record Payment Request</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Record Payment Request</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-purchase-order.index') }}">Purchase Order</a>
                            </li>
                            <li class="breadcrumb-item">Record Payment Request</li>
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
                                <h5 class="text-white">Record Data</h5>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered mt-4" style="">
                                        <tbody>
                                            <tr>
                                                <td>Who Submitted</td>
                                                <td>{{ $dv->whosubmit->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>{{ $dv->date_ps }}</td>
                                            </tr>
                                            <tr>
                                                <td>Department</td>
                                                <td>{{ $dv->dps->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Description</td>
                                                <td>{{ $dv->desc }}</td>
                                            </tr>
                                            <tr>
                                                <td>Purpose</td>
                                                <td>{{ $dv->purpose->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Send To</td>
                                                <td>{{ $dv->send_to }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date Line</td>
                                                <td>{{ $dv->dateline }}</td>
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
                                                                        @if(empty($disc->discount))

                                                                        @if ($data_pengajuan->matauang == 'RP')
                                                                            RP. 0
                                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                                            $ 0
                                                                        @endif

                                                                        @else

                                                                        @if ($data_pengajuan->matauang == 'RP')
                                                                            RP. {{ number_format($disc->discount) }}
                                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                                            $ {{ number_format($disc->discount /100 ,2) }}
                                                                        @endif

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
                                                                {{-- @endif --}}
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

                                    <!-- Floating Labels Form -->
                                    <form class="row g-2 mt-4" action="{{ url('/payment_request/store/' . $dv->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <?php
                                            $duit = 100000002;
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
                                                @if($data_pengajuan->ppn == 0)
                                                    @foreach ($total_tnpa_ppn as $tpn)
                                                        @if($tpn->total < 10000001 )
                                                            @foreach ($atasan as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                            @endforeach
                                                        @elseif($tpn->total < 50000001)
                                                            @foreach ($atasan1 as $sui1)
                                                                <option value="{{ $sui1->id }}">{{ $sui1->name }}</option>
                                                            @endforeach
                                                        @elseif($tpn->total < 100000001)
                                                            @foreach ($atasan2 as $sui2)
                                                                <option value="{{ $sui2->id }}">{{ $sui2->name }}</option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($atasan3 as $sui3)
                                                                <option value="{{ $sui3->id }}">{{ $sui3->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @elseif($data_pengajuan->ppn == 1)
                                                    @foreach ($total as $t)
                                                    @if($t->total < 10000001)
                                                            @foreach ($atasan as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                            @endforeach
                                                    @elseif($t->total < 50000001)
                                                            @foreach ($atasan1 as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                            @endforeach
                                                    @elseif($t->total < 100000001)
                                                            @foreach ($atasan2 as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                            @endforeach
                                                    @else
                                                            @foreach ($atasan3 as $sui)
                                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                            @endforeach
                                                    @endif
                                                    @endforeach
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

                            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
                            <script type="text/javascript">
                                //Math
                                $(document).ready(function() {
                                    //Convert To Rupiah
                                    var rupiah = document.querySelector(".rupiah");
                                    rupiah.addEventListener('keyup', function(e) {
                                        // tambahkan 'Rp.' pada saat form di ketik
                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                        rupiah.value = formatRupiah(this.value, "");
                                    });
                                    /* Fungsi formatRupiah */
                                    function formatRupiah(angka, prefix) {
                                        var number_string = angka.replace(/[^,\d]/g, ""),
                                            split = number_string.split(","),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if (ribuan) {
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }
                                        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                    }
                                    $(".order-entry").on("keyup", ".form-calc", function() {
                                        var parent = $(this).closest("tr");
                                        var str = parent.find(".form-cost").val();
                                        var res = str.replace(/\D/g, "");
                                        parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                                        var total = 0;
                                        $(".form-line").each(function() {
                                            total += parseInt($(this).val() || 0);
                                        });
                                        $(".total_A").text(total.toLocaleString('en-US'));
                                        var checkbox = document.querySelector(".check-box");
                                        checkbox.addEventListener('change', (event) => {
                                            if (event.currentTarget.checked) {
                                                totalppn = total * 11 / 100;
                                                grandtotal = total + totalppn;
                                                $(".ppn").text(totalppn.toLocaleString('en-US'));
                                                $(".total").text(grandtotal.toLocaleString('en-US'));
                                            } else {
                                                totalppn = total * 0;
                                                $(".ppn").text(totalppn);
                                                $(".total").text(total.toLocaleString('en-US'));
                                            }
                                        });
                                    });
                                });
                                //Add Form
                                $(".addItem").on('click', function() {
                                    addItem();
                                });

                                function addItem() {
                                    var item =
                                        '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> <td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;"  required/></td><td><input type="text" name="total[]" class="form-control form-line" style="text-align: right;" required  /></td> <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> ';
                                    $(".item").append(item)

                                    var rupiah = document.querySelectorAll(".rupiah");
                rupiah.forEach((item) => {
                    item.addEventListener('keyup', function(e) {
                        // tambahkan 'Rp.' pada saat form di ketik
                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                        item.value = formatRupiah(this.value, "");
                    });
                });
                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, ""),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        rupiah += separator + ribuan.join(".");
                    }
                    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                }

                $(".order-entry").on("keyup", ".form-calc", function() {
                    var parent = $(this).closest("tr");
                    var str = parent.find(".form-cost").val();
                    var res = str.replace(/\D/g, "");
                    parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                    var total = 0;
                    $(".form-line").each(function() {
                        total += parseInt($(this).val() || 0);
                    });
                    $(".total_A").text(total.toLocaleString('en-US'));
                    var checkbox = document.querySelector(".check-box");
                    checkbox.addEventListener('change', (event) => {
                        if (event.currentTarget.checked) {
                            totalppn = total * 11 / 100;
                            grandtotal = total + totalppn;
                            $(".ppn").text(totalppn.toLocaleString('en-US'));
                            $(".total").text(grandtotal.toLocaleString('en-US'));
                        } else {
                            totalppn = total * 0;
                            $(".ppn").text(totalppn);
                            $(".total").text(total.toLocaleString('en-US'));
                        }
                    });
                });
            }
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
            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, ""),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }
                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
            }
                            </script>

                            <script type="text/javascript">
                                var pageSelector = document.getElementById('pageSelector');
                                var customInput = document.getElementById('customInput');

                                pageSelector.addEventListener('change', function() {
                                    if (this.value == "custom") {
                                        customInput.classList.remove('hide');
                                    } else {
                                        customInput.classList.add('hide');
                                    }
                                })
                            </script>
                            <script type="text/javascript">
                                var pageSelect = document.getElementById('pageSelect');
                                var selectedInput = document.getElementById('selectedInput');
                                var selectedInputCustom = document.getElementById('selectedInputCustom');

                                var selectedInput2 = document.getElementById('selectedInput2');
                                var selectedInputCustom2 = document.getElementById('selectedInputCustom2');

                                var selectedInput3 = document.getElementById('selectedInput3');
                                var selectedInputCustom3 = document.getElementById('selectedInputCustom3');

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
                                    } else {
                                        selectedInput2.classList.add('hide');
                                    }
                                })

                                // Ecommerce
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "ecommerce") {
                                        selectedInput3.classList.remove('hide');
                                    } else {
                                        selectedInput3.classList.add('hide');
                                    }
                                })
                            </script>
    </section>
@endsection
