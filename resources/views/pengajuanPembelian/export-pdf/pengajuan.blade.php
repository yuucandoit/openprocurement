<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Pengajuan Pembelian</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td valign="top" style="padding-right: 2px; width:20px"><img
                    src="{{ public_path('assets/images/LogoSII.png') }}" alt="" width="90"> </td>
            <td valign="top">
                <h5 class="media-heading f-w-600">PT.SOLUSI INTEK INDONESIA</h5>

            </td>
            @php
                use Carbon\Carbon;
                $date = Carbon::parse($id->created_at)->format('d/m/Y');
                if (empty($atasan->approved_at)) {
                    $approvedAt = 'Not Record yet';
                } else {
                    $approvedAt = Carbon::parse($atasan->approved_at)->format('d/m/Y/ h:i:s A');
                }
            @endphp
            <td valign="top" align="right">
                <h5><span
                        class="digits counter">000{{ $id->id }}/PPB/SII/{{ $month }}/{{ $year }}</span>
                </h5>
                <p>Date: <span class="digits">{{ $date }}</span><br></p>
            </td>
        </tr>
    </table>

    <style>
        .tapper >  h6,p,span{
            display: inline;
        }
    </style>

    <table width="100%" class="mt-4">
        <tr>
            <td>
                <div class="tapper">
                <h6>Project &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                @if (empty($atasan->purpose_type))
                    <p>Not Filled Yet</p>
                @elseif($atasan->purpose_type == 'App\Models\ReferensiNamaProject')
                    <p> <span>{{ $atasan->purpose->name }}</span>
                @elseif ($atasan->purpose_type == 'App\Models\Office')
                    <p> <span>{{ $atasan->purpose->name }}</span>
                @elseif($atasan->purpose_type == 'App\Models\Workshop')
                    <p> <span>{{ $atasan->purpose->name }}</span>
                @elseif($atasan->purpose_type == 'App\Models\Inventory')
                    <p> <span>{{ $atasan->purpose->name }}</span>
                @elseif($atasan->purpose_type == 'App\Models\RND')
                    <p> <span>{{ $atasan->purpose->name }}</span>
                @endif
                </h6>
             </div>

                <div class="tapper">
                <h6>Description &nbsp;:  <p><span>{{ $atasan->desc }}</span></p></h6>
                </div>

                <div class="tapper">
                <h6 class="media-heading f-w-600">Request By &nbsp;:</h6>
                @foreach ($cpp as $p)
                    <p><span>{{ $p->whosubmit->name }}</span></p>
                @endforeach
                </div>
            </td>
        </tr>
    </table>

    <h3 class="text-center mt-4 ">Pengajuan Pembelian</h3>
    <table class="table table-bordered table-striped " style="margin-bottom: 50px;">
        <tbody>
            <tr>
                <td>
                    <h6>Item</h6>
                </td>
                <td class="Hours">
                    <h6>Quantity</h6>
                </td>
                <td class="Rate">
                    <h6>Unit</h6>
                </td>
                <td class="subtotal">
                    <h6>Price/Unit</h6>
                </td>
                <td class="subtotal">
                    <h6>Total</h6>
                </td>
            </tr>
            @foreach ($category_q as $q)
                <tr>
                    <td>
                        <label>{!! nl2br($q->item) !!}</label>
                    </td>
                    <td>
                        <p class="itemtext digits text-center">{{ $q->qty }}</p>
                    </td>
                    <td>
                        <p class="itemtext digits">{{ $q->kategori }}</p>
                    </td>
                    <td>
                        <p class="itemtext digits text-end">Rp.{{ number_format($q->unit_price) }}</p>
                    </td>
                    <td>
                        <p class="itemtext digits text-end">Rp.{{ number_format($q->total) }}</p>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="m-0">DPP </p>
                </td>
                @foreach ($dpp as $dp)
                    <td>
                        <p class="m-0 digits text-end">Rp.{{ number_format($dp->total) }}</p>
                    </td>
                @endforeach
            </tr>
            <tr>
                <td>
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="m-0">PPN 11% </p>
                </td>
                @foreach ($cpp as $c)
                    @if ($c->ppn == 0)
                        <td>
                            <p class="m-0 digits text-end">Rp.0</p>
                        </td>
                    @else
                        @foreach ($ppn as $pn)
                            <td>
                                <p class="m-0 digits text-end">Rp.{{ number_format($pn->total) }}</p>
                            </td>
                        @endforeach
                    @endif
                @endforeach
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="Rate">
                    <h6 class="mb-0">Total </h6>
                </td>
                @foreach ($cpp as $c)
                    @if ($c->ppn == 0)
                        @foreach ($total_tnp_ppn as $tpn)
                            @if ($c->matauang == 'RP')
                                <td style="payment digits text-end">
                                    <h6 class="mb-0 "> Rp.{{ number_format($tpn->total) }}</h6>
                                </td>
                            @elseif ($c->matauang == 'USD')
                                <td style="payment digits text-end">
                                    <h6 class="mb-0 "> $ {{ number_format($tpn->total) }}</h6>
                                </td>
                            @endif
                        @endforeach
                    @elseif($c->ppn == 1)
                        @foreach ($total as $t)
                            @if ($c->matauang == 'RP')
                                <td style="payment digits text-end">
                                    <h6 class="mb-0 "> Rp. {{ number_format($t->total) }}</h6>
                                </td>
                            @elseif ($c->matauang == 'USD')
                                <td style="payment digits text-end">
                                    <h6 class="mb-0 "> $.{{ number_format($t->total) }}</h6>
                                </td>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td>
                <p class="legal"><strong>Terms & Conditions</strong> <br>
                    @if (empty($cpo->term->term_condition))
                        Not Filled in yet
                    @else
                        {!! nl2br($cpo->term->term_condition) !!}
                </p>
                @endif
            </td>
            <td align="right">


                <div style="text-align: center;">
                    @foreach ($cpp as $c)
                        @if ($c->status == 'Awaiting Purchase Request Approval' ||
                            $c->status == 'Purchase Request Approved' ||
                            $c->status == 'Purchase Proses' ||
                            $c->status == 'Waiting For PO Approval' ||
                            $c->status == 'Purchase Proses' ||
                            $c->status == 'PO Approved' ||
                            $c->status == 'Invoicing Process' ||
                            $c->status == 'Payment Approved' ||
                            $c->status == 'Unpaid' ||
                            $c->status == 'Paid' ||
                            $c->status == 'Delivery Success')
                            <p>{{ $approvedAt }}</p>
                </div>
                <div style="text-align: center;">
                    @if (empty($atasan->signature))
                    @else
                        <p><img style=" width:100px;"
                                src="{{ public_path('assets/images/signature_super_user/' . $atasan->signature) }}"
                                alt=""></p>
                    @endif
                </div>
                @if (empty($atasan->bod->name))
                    <div style="text-align: center; font-size: 18px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @else
                    <div style="text-align: center; font-size: 18px;">{{ $atasan->bod->name }} <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @endif
                @endif
                @endforeach
                {{-- @foreach ($cpp as $c)
                            @if ($c->status == 'PO Approved' || $c->status == 'Invoicing Process' || $c->status == 'Payment Approved' || $c->status == 'Unpaid' || $c->status == 'Paid' || $c->status == 'Delivery Success') --}}
                {{-- <img src="{{ public_path('assets/images/'.$c->image) }}" alt="" style=" width:80px;"> --}}
                {{-- <strong>{{ $atasan->atasans->name }}</strong>
                            @else
                            <strong>BOD Name</strong>
                            @endif
                            {{-- @endforeach --}}
            </td>
        </tr>
    </table>
    <footer
        style="
                   position: fixed;
                   bottom: 0cm;
                   left: 0cm;
                   right: 0cm;
                   height: 2cm;">
        <p>Head Office &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Jl Cikunir Raya No.689 Jakamulya, <br> Bekasi Selatan, Telp. 021-89454790 <br>
            Marketing Office : Jl Tebet Barat dalam raya No. 31 <br>Tebet Barat, Jakarta Selatan, Telp
            021-21383852</p>
    </footer>
</body>

</html>
