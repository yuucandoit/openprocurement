<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Pengajuan Dana</title>
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
                if (empty($sig->approved_at)) {
                    $approvedAt = 'Not Record yet';
                } else {
                    $approvedAt = Carbon::parse($sig->approved_at)->format('d F Y ');
                }
            @endphp
        </tr>
    </table>
    @php
    $id_po = $cpp->id;
    $py_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
    @endphp
    <h3 class="text-center">Pengajuan Dana</h3>
    <h6 class="text-center"><span class="digits counter">NO {{ $py_number }}/PD/SII/{{ $month }}/{{ $year }}</span></h6>

    <table width="100%" class="mt-5">
        <tr>
            <td>
                @if (empty($cpo->vendorable_type))
                    <p>Not Filled Yet</p>
                @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                    <p>Name Vendor&nbsp; : <span>{{ $cpo->vendorable->nama }}</span><br>
                        Address&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <span>{{ $cpo->vendorable->alamat }}</span><br>
                        Contact&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span> {{ $cpo->vendorable->no_telp_kantor }}</span><br>
                        NPWP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span>{{ $cpo->vendorable->npwp_perusahaan }}</span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                        <span class="digits">
                            @if (empty($cpo->quotation))
                                -
                            @else
                                {{ $cpo->quotation }}
                            @endif
                        </span>
                @elseif ($cpo->vendorable_type == 'App\Models\CategoryPP')
                    <p>Name Vendor&nbsp; : <span>{{ $cpo->vendorable->nama }}</span><br>
                        Address &nbsp;:&nbsp;<span>{{ $cpo->vendorable->alamat }}</span><br>
                        NIK
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->nik }}</span><br>
                        NPWP &nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->npwp_pp }}</span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                        <span class="digits">
                            @if (empty($cpo->quotation))
                                -
                            @else
                                {{ $cpo->quotation }}
                            @endif
                        </span>
                    </p>
                @elseif($cpo->vendorable_type == 'App\Models\CategoryEcommerce')
                    <p>Name Vendor&nbsp; : <span>{{ $cpo->vendorable->nama }}</span><br>
                        Link &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;<span>
                    <a href="{{ $cpo->vendorable->link }}">{{ $cpo->vendorable->link }}</a></span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                    <span class="digits">
                        @if (empty($cpo->quotation))
                            -
                        @else
                            {{ $cpo->quotation }}
                        @endif
                    </span>
                </p>
                @endif
            </td>
            <td valing="top" align="center">
                <h6 class="media-heading f-w-600">Request By :</h6>

                    <p>{{ $cpp->dps->name }}</p>

            </td>
        </tr>
    </table>


    <table class="table table-bordered table-striped" style="margin-bottom: 50px;">
        <tbody>
            <tr>
                <td>
                    <h6>No</h6>
                </td>
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
            @php
            $no = 1
        @endphp
        @foreach ($category_q as $q)
            <tr>
                <td>
                    <p>{{ $no++ }}</p>
                </td>
                <td>
                    <label style="word-break: break-word;">{!! nl2br($q->item) !!}</label>
                </td>
                <td>
                    <p class="text-center">{{ $q->qty }}</p>
                </td>
                <td>
                    <p>{{ $q->kategori }}</p>
                </td>
                @if($cpp->matauang == 'RP')
                <td class="text-right">
                    <p>Rp.{{ number_format($q->unit_price) }}</p>
                </td>
                @endif
                @if($cpp->matauang == 'USD')
                <td class="text-right">
                    <p>$ {{ number_format($q->unit_price) }}.00</p>
                </td>
                @endif

                @if($cpp->matauang == 'RP')
                <td class="text-right">
                    <p>Rp.{{ number_format($q->total) }}</p>
                </td>
                @endif
                @if($cpp->matauang == 'USD')
                <td class="text-right">
                    <p>$ {{ number_format($q->total) }}.00</p>
                </td>
                @endif
                {{-- <td class="text-right">
                    <p>Rp.{{ number_format($q->unit_price) }}</p>
                </td> --}}
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
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="m-0">DPP </p>
                </td>
                @foreach ($dpp as $dp)
                @if($cpp->matauang == 'RP')
                <td>
                    <p class="m-0 digits text-right">Rp.{{ number_format($dp->total) }}</p>
                </td>
                @endif
                @if($cpp->matauang == 'USD')
                <td>
                    <p class="m-0 digits text-right">$ {{ number_format($dp->total) }}.00</p>
                </td>
                @endif
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
                    <p class="itemtext"></p>
                </td>
                <td>
                    <p class="m-0">PPN 11% </p>
                </td>

                    @if ($cpp->ppn == 0)
                    @if($cpp->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.0</p>
                    </td>
                    @endif
                    @if($cpp->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ 0</p>
                    </td>
                    @endif
                    @else
                        @foreach ($ppn as $pn)
                            <td>
                                <p class="m-0 digits text-right">Rp.{{ number_format($pn->total) }}</p>
                            </td>
                        @endforeach
                    @endif
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="Rate">
                    <h6 class="mb-0">Total </h6>
                </td>
                    @if ($cpp->ppn == 0)
                        @foreach ($total_tnp_ppn as $tpn)
                            @if ($cpp->matauang == 'RP')
                                <td style="m-0 digits text-right">
                                    <h6 class="text-right"> Rp.{{ number_format($tpn->total) }}</h6>
                                </td>
                            @elseif ($cpp->matauang == 'USD')
                                <td style="m-0 digits text-right">
                                    <h6 class="text-right"> $ {{ number_format($tpn->total) }}.00</h6>
                                </td>
                            @endif
                        @endforeach
                    @elseif($cpp->ppn == 1)
                        @foreach ($total as $t)
                            @if ($cpp->matauang == 'RP')
                                <td style="m-0 digits text-right">
                                    <h6 class="text-right"> Rp. {{ number_format($t->total) }}</h6>
                                </td>
                            @elseif ($cpp->matauang == 'USD')
                                <td style="m-0 digits text-right">
                                    <h6 class="text-right"> $ {{ number_format($t->total) }}.00</h6>
                                </td>
                            @endif
                        @endforeach
                    @endif
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td>
                <p class="legal" style="font-size: 15px;"><strong>Terms & Conditions</strong> <br>
                    @if (empty($cpo->term->term_condition))
                        Not Filled in yet
                    @else
                        {!! nl2br($cpo->term->term_condition) !!}
                </p>
                @endif
            </td>
            <td align="right">
                <div style="text-align: center;">
                        @if ($cpp->status == 'PO Approved' ||
                            $cpp->status == 'Invoicing Process' ||
                            $cpp->status == 'Payment Approved' ||
                            $cpp->status == 'Unpaid' ||
                            $cpp->status == 'Paid' ||
                            $cpp->status == 'Delivery Success')
                            <p>Jakarta, {{ $approvedAt }}</p>
                            @if (empty($sig->signature))
                            @else
                                <p><img style=" max-width:80px;"
                                        src="{{ public_path('assets/images/signature_super_user/' . $sig->signature) }}"
                                        alt=""></p>
                            @endif
                </div>
                <div style="text-align: center; font-size: 15px;">{{ $cpp->atasanpymnt->name }} <br>
                    <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                </div>
            @else
                @if (empty($cpp->atasans->name))
                    <div style="text-align: center; font-size: 15px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @endif
                @endif
            </td>
        </tr>
    </table>
    <footer
        style="
                   position: fixed;
                   bottom: 0cm;
                   left: 0cm;
                   right: 0cm;
                   height: 2cm;"
        class="text-center">
        <p>Head Office &nbsp;: Jl Cikunir Raya No.689 Jakamulya, Bekasi Selatan,
            Telp. 021-89454790 <br>
            Marketing Office : Jl Tebet Barat dalam raya No.31 Tebet Barat, Jakarta Selatan,<br>
            Telp. 021-21383852</p>
    </footer>
</body>

</html>
