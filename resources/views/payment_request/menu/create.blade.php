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
                            <!-- Floating Labels Form -->
                            <form class="row g-2 mt-4" action="{{ url('/payment_request/store/' . $dv->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <?php
                                    $duit = 100000002;

                                foreach ($data_pengajuan->quot as $po_atasan) {
                                      $po_bod = $po_atasan;
                                  }
                                  foreach ($po_bod->itempo as $supply) {
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


                                        @if($data_pengajuan->ppn == 0)
                                            @foreach ($total_tnpa_ppn as $tpn)

                                                @if($tpn->total == null)
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
                                                @else
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
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
            <div class="card-header pb-0">
                <h5>List PO</h5>
            </div>
              <div class="card-body">
                @if (empty($vendor->vendorable->nama))
                @else
                @foreach ($items as $po)
                @php
                foreach($po->itempo as $var_i)
                {
                    $item_po = $var_i;
                }
                @endphp
                    <div class="default-according" id="accordionclose">
                    <div class="card">
                        <div class="card-header" id="heading{{ $po->id }}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" style="width: 100%;" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1">
                                <span style="font-weight: bold; color:green; float: left;">{{ $po->code_po }}</span>
                                <span style="float: left;">&nbsp; Vendor #{{ $po->vendorable->nama ?? '-' }}</span>
                                <span  style="float: right;">
                                    @if(empty($item_po))

                                    @else

                                        @if($item_po->matauang == 'RP')
                                        Rp.{{ number_format($item_po->grand_total,2) }}
                                        @elseif ($item_po->matauang == 'USD')
                                        $ {{ number_format($item_po->grand_total,2) }}
                                        @endif

                                    @endif
                                </span>
                            </button>
                        </h5>
                        </div>
                        <div class="collapse" id="collapse{{ $po->id }}" aria-labelledby="heading{{ $po->id }}" data-bs-parent="#accordionclose">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    data-feather="database"></i>
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
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    data-feather="database"></i>
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
                                                    data-feather="database"></i>
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
                                                    data-feather="database"></i>
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
                                            @if(empty($disc->discount))

                                                {{ $data_pengajuan->matauang }} 0

                                            @else

                                                {{ $data_pengajuan->matauang }} {{ number_format($disc->discount) }}

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
                                                {{ $data_pengajuan->matauang }} {{ number_format($p->total) }}
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
                                        <td style="text-align:right;">{{ $data_pengajuan->matauang }} {{ number_format($t->total) }}</td>
                                        @endforeach
                                @elseif ($data_pengajuan->ppn == 0)
                                        <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                        @foreach ($total_tnpa_ppn as $tpn)
                                        <td style="text-align:right;">{{ $data_pengajuan->matauang }} {{ number_format($tpn->total) }}</td>
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
                                            <td class="text-end">{{ $i->matauang }} {{ number_format($i->unit_price,2) }}</td>
                                            <td class="text-end">{{ $i->matauang }} {{ number_format($i->total,2) }}</td>
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
                                            {{ $calculate->matauang }} {{ number_format($calculate->dpp,2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                            {{ $calculate->matauang }} {{ number_format($calculate->discount,2) }}
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
                                                {{ $calculate->matauang }} {{ number_format($ppn,2) }}
                                            @else
                                                {{ $calculate->matauang }} 0
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2">Shipping & Protection Fee :</label></td>
                                        <td style="text-align: right;">
                                               {{ $calculate->matauang  }} {{ number_format($calculate->ongkir,2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2">Admin Or Service Fee :</label></td>
                                        <td style="text-align: right;">
                                            {{ $calculate->matauang  }} {{ number_format($calculate->admin_fee,2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total
                                                :</td>
                                        @if ($calculate->ppn == 1)
                                        <td style="text-align:right;">
                                            {{ $calculate->matauang  }} {{ number_format($calculate->grand_total) }}
                                        </td>
                                        @elseif ($calculate->ppn == 0)
                                        <td style="text-align:right;">
                                            {{ $calculate->matauang  }} {{ number_format($calculate->grand_total) }}</td>
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
                @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
