<title>Details Delivery</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details Delivery</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('delivery.index') }}">Delivery Process</a></li>
                            <li class="breadcrumb-item active">Details Delivery</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
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
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($status as $s)
                                                <tr>
                                                    <td>{{ $s->status }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>

                                @foreach ($delivery as $d)
                                    <div class="gallery my-gallery card-body text-center" itemscope=""
                                        style="text-align: center;">
                                        <figure class=" xl-33 text-center" itemprop="associatedMedia" itemscope=""><a
                                                href=" {{ asset('images/' . $d->path_image) }}" itemprop="contentUrl"
                                                data-size="1600x950"><img class="img-thumbnail"
                                                    src="{{ asset('images/' . $d->path_image) }}" itemprop="thumbnail"
                                                    alt="Image description"></a>
                                            <figcaption itemprop="caption description" class="text-center">Received By
                                                {{ $d->receiver }}</figcaption>
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>List PO</h5>
                        </div>
                    @if (empty($vendor->vendorable->nama))
                    <div class="card-body">
                        <h6 class="text-center">PO Not Found</h6>
                    </div>
                    @else
                    @foreach ($items as $po)
                    @php
                    foreach($po->itempo as $var_i)
                    {
                        $item_po = $var_i;
                    }
                    @endphp
                      <div class="card-body">
                        <div class="default-according" id="accordionclose{{ $po->id }}">

                          <div class="card">
                            <div class="card-header" id="heading{{ $po->id }}">
                              <h5 class="mb-0">
                                <button class="btn btn-link" style="width:100%" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1">
                                    <span style="font-weight: bold; color:green; float: left;">{{ $po->code_po }}</span>
                                    <span style="float: left;">&nbsp; Vendor #{{ $po->vendorable->nama ?? '-' }}</span>
                                    <span  style="float: right;">
                                        @if(empty($item_po))
                                         -
                                        @else
                                        Rp.{{ number_format($item_po->grand_total,2) }}
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
                                                <label class="form-label" style="font-weight: bold;"><i
                                                        class="fa fa-database"></i>
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
                                                <td class="text-end">{{ $item->matauang }} {{ number_format($item->unit_price) }}</td>
                                                <td class="text-end">{{ $item->matauang }} {{ number_format($item->total) }}</td>
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
                                                {{ $value->matauang }} {{ number_format($value->dpp) }}
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
                                                    $ppn = $afterdisc *11 /100;
                                                @endphp
                                                    {{ $value->matauang }}  {{ number_format($ppn) }}
                                                @else
                                                    {{ $value->matauang }}  0
                                                @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2">Shipping & Protection Fee :</label></td>
                                            <td style="text-align: right;">
                                                {{ $value->matauang }}  {{ number_format($value->ongkir,2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2">Admin Or Service Fee :</label></td>
                                            <td style="text-align: right;">
                                                {{ $value->matauang }}  {{ number_format($value->admin_fee,2) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total
                                                    :</td>
                                            <td style="text-align:right;">
                                            @if ($value->ppn == 1)
                                                {{ $value->matauang }} {{ number_format($value->grand_total) }}
                                            @elseif ($value->ppn == 0)
                                                {{ $value->matauang }} {{ number_format($value->grand_total) }}
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
                                <a class="btn btn-danger mt-3" href="{{ url('/exportpdf/pymnt_id/' . $po->id) }}"
                                    target="_blank" style="font-size:12;">Export PDF Payment</i>
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

    </section>
@endsection
