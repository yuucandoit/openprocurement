<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Purchase Order</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td valign="top" style="padding-right: 2px; width:20px; margin-top:100px"><img
                    src="{{ public_path('assets/images/LogoSII.png') }}" alt="" width="90"> </td>
            <td valign="top">
                <h5>PT.SOLUSI INTEK INDONESIA</h5>
            </td>
            @php
                use Carbon\Carbon;
                $date = Carbon::parse($id->created_at)->format('d/m/Y');
                if (empty($cpo->approved_at)) {
                    $approvedAt = 'Not Record yet';
                } else {
                    $approvedAt = Carbon::parse($cpo->approved_at)->format('d F Y');
                }
            @endphp
        </tr>
    </table>
    <h3 class="text-center">Purchase Order</h3>
    <h6 class="text-center"><span class="digits counter">000{{ $id->id }}/PO/SII/{{ $month }}/{{ $year }}</span>
     </h6>

    <table width="100%" class="mt-5">
        <tr>
            <td>
                @if (empty($cpo->vendorable_type))
                    <p>Not Filled Yet</p>
                @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                    <p>Name Vendor&nbsp; : <span>{{ $cpo->vendorable->nama }}</span><br>
                        Address&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <span>{{ $cpo->vendorable->alamat }}</span><br>
                        Contact&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span>{{ $cpo->vendorable->no_telp_kantor }}</span><br>
                        NPWP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span>{{ $cpo->vendorable->npwp_perusahaan }}</span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                        <span class="digits">
                            @if (empty($cpo->quotation))
                                -
                            @else
                                {{ $cpo->quotation }}
                            @endif
                        </span>
                    </p>
                @elseif ($cpo->vendorable_type == 'App\Models\CategoryPP')
                    <p>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->nama }}</span><br>
                        Address &nbsp;:&nbsp;<span>{{ $cpo->vendorable->alamat }}</span><br>
                        NIK
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->nik }}</span><br>
                        NPWP &nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->npwp_pp }}</span></p>
                        <span class="digits">
                            @if (empty($cpo->quotation))
                                -
                            @else
                                {{ $cpo->quotation }}
                            @endif
                        </span>
                @elseif($cpo->vendorable_type == 'App\Models\CategoryEcommerce')
                    <p>Name &nbsp;:&nbsp;<span>{{ $cpo->vendorable->nama }}</span><br>
                        Link &nbsp;&nbsp;&nbsp; :&nbsp;<span>
                    <a href="{{ $cpo->vendorable->link }}">{{ $cpo->vendorable->link }}</a></span></p>
                    <span class="digits">
                        @if (empty($cpo->quotation))
                            -
                        @else
                            {{ $cpo->quotation }}
                        @endif
                    </span>
                @endif
            </td>

        </tr>
    </table>

    <table class="table table-bordered table-striped" style="margin-bottom: 50px;">
        <tbody>
            <tr class="text-center">
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
                        <p class="text-center">{{ $q->qty }}</p>
                    </td>
                    <td>
                        <p>{{ $q->kategori }}</p>
                    </td>
                    <td class="text-right">
                        <p>Rp.{{ number_format($q->unit_price) }}</p>
                    </td>
                    <td class="text-right">
                        <p>Rp.{{ number_format($q->total) }}</p>
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
                        <p class="m-0 digits text-right">Rp.{{ number_format($dp->total) }}</p>
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
                        <td class="text-right>
                            <p class="m-0 digits text-end">Rp.0</p>
                        </td>
                    @else
                        @foreach ($ppn as $pn)
                            <td class="text-right">
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
                                <td class="text-right">
                                    <h6 class="text-right "> Rp.{{ number_format($tpn->total) }}</h6>
                                </td>
                            @elseif ($c->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="text-right"> $ {{ number_format($tpn->total) }}</h6>
                                </td>
                            @endif
                        @endforeach
                    @elseif($c->ppn == 1)
                        @foreach ($total as $t)
                            @if ($c->matauang == 'RP')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> Rp. {{ number_format($t->total) }}</h6>
                                </td>
                            @elseif ($c->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> $.{{ number_format($t->total) }}</h6>
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
                        @if ($c->status == 'Waiting For PO Approval' ||
                            $c->status == 'Purchase Proses' ||
                            $c->status == 'PO Approved' ||
                            $c->status == 'Invoicing Process' ||
                            $c->status == 'Payment Approved' ||
                            $c->status == 'Unpaid' ||
                            $c->status == 'Paid' ||
                            $c->status == 'Delivery Success')
                            <p>Jakarta, {{ $approvedAt }}</p>
                            @if (empty($cpo->signature))
                            @else
                                <p><img style=" width:100px;"
                                        src="{{ public_path('assets/images/signature_super_user/' . $cpo->signature) }}"
                                        alt=""></p>
                            @endif
                </div>
                @if (empty($atasan->atasans->name))
                    <div style="text-align: center; font-size: 18px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @else
                    <div style="text-align: center; font-size: 18px;">{{ $atasan->atasans->name }} <br>
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
                   height: 2cm;" class="text-center">
        <p>Head Office &nbsp;: Jl Cikunir Raya No.689 Jakamulya, Bekasi Selatan,
            Telp. 021-89454790 <br>
            Marketing Office : Jl Tebet Barat dalam raya No.31 Tebet Barat, Jakarta Selatan,<br>
            Telp. 021-21383852</p>
    </footer>
</body>

</html>
