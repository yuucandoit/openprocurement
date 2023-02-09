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
                                            <td>Date Send</td>
                                            <td>{{ $data_pengajuan->dateline }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="card">
                                        @if (empty($vendor->vendorable->nama))
                                        <div class="card-body">
                                            <h6 class="text-center">PO Not Found</h6>
                                        </div>
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

                                                                    @if ($item->matauang == 'RP')
                                                                        <td class="text-end">RP.
                                                                            {{ number_format($item->unit_price) }}</td>
                                                                        <td class="text-end">RP. {{ number_format($item->total) }}
                                                                        </td>
                                                                    @elseif($item->matauang == 'USD')
                                                                        <td class="text-end">$
                                                                            {{ number_format($item->unit_price /100 ,2) }}</td>
                                                                        <td class="text-end">$
                                                                            {{ number_format($item->total /100 ,2) }}</td>
                                                                    @endif
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
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->dpp) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->dpp /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> Shipping & Protection Fee :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->ongkir) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->ongkir /100 ,2) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label class="pull-right mx-2"> Discount :</label></td>
                                                                <td style="text-align: right;">
                                                                    @if ($value->matauang == 'RP')
                                                                        RP. {{ number_format($value->discount) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        $ {{ number_format($value->discount /100 ,2) }}
                                                                    @endif
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
                                                                        @if ($value->matauang == 'RP')
                                                                            RP. {{ number_format($ppn) }}
                                                                        @elseif ($value->matauang == 'USD')
                                                                            $ {{ number_format($ppn /100 ,2) }}
                                                                        @endif
                                                                    @else
                                                                        @if ($value->matauang == 'RP')
                                                                            RP. 0
                                                                        @elseif ($value->matauang == 'USD')
                                                                            $ 0
                                                                        @endif
                                                                    @endif

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="text-end" style="font-weight: bold;">Grand Total
                                                                        :</td>
                                                                <td style="text-align:right;">
                                                                @if ($value->ppn == 1)
                                                                    @if ($value->matauang == 'RP')
                                                                        RP.{{ number_format($value->grand_total) }}
                                                                    @elseif ($value->matauang == 'USD')
                                                                        ${{ number_format($value->grand_total /100 ,2) }}
                                                                    @endif
                                                                @elseif ($value->ppn == 0)
                                                                    @if ($value->matauang == 'RP')
                                                                    RP.{{ number_format($value->grand_total) }}</td>
                                                                    @elseif ($value->matauang == 'USD')
                                                                    ${{ number_format($value->grand_total /100 ,2) }}
                                                                    @endif

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

                                {{-- Start Modal Approval --}}
                                @if ($data_pengajuan->status == 'Purchase Complete')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai" disabled>Purchase Complete
                                    </button>
                                @elseif ($data_pengajuan->status == 'Paid')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai">Set Purchase Complete </button>
                                @endif

                                <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h2 class="modal-title" style="color: white">Warning</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mx-5 mb-3">
                                                <span class="warning">
                                                    <img src="{{ asset('assets/images/warning.png') }}">
                                                </span>
                                                <h2 style="text-align: center">Make Sure! <br>All Items Arrived</h2>
                                            </div>
                                            {{-- End Modal Approval --}}

                                            <div class="modal-footer">
                                                @if ($data_pengajuan->status == 'Paid')
                                                    <form class="text-center"
                                                        action="{{ url('delivery/complete/' . $data_pengajuan->id) }}">
                                                        <button type="submit" class="btn btn-outline-danger "><i
                                                                class="bx bx-trash"></i>
                                                            Set Purchase Complete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if ($data_pengajuan->status == 'PO Approved')
                                        <a href={{ url('/exportpdf/po/' . $data_pengajuan->id) }}
                                            class="btn btn-danger mb-3 mr-1" style="align-self: flex-end"> Export to
                                            PDF</a>

                                        <a type="reset" class="btn btn-dark mb-3 mr-1"
                                            href="{{ route('delivery.index') }}">Back</a>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
    </section>
@endsection
