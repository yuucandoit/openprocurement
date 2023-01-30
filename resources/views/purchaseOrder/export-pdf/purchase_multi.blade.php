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

    @php
    use Carbon\Carbon;
    $date = Carbon::parse($id->created_at)->format('d/m/Y');
    foreach($cpo as $p){
        if (empty($p->approved_at)) {
            $approvedAt = 'Not Record yet';
        } else {
            $approvedAt = Carbon::parse($p->approved_at)->format('d F Y');
        }
    }
    @endphp
    @foreach($cpo as $p)
    <table width="100%">
        <tr>
            <td valign="top" style="padding-right: 2px; width:20px; margin-top:100px"><img
                    src="{{ public_path('assets/images/LogoSII.png') }}" alt="" width="90"> </td>
            <td valign="top">
                <h5>PT.SOLUSI INTEK INDONESIA</h5>
            </td>
        </tr>
    </table>
    @php
        $id_po = $id->pp_id;
        $po_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
    @endphp
    <h3 class="text-center">Purchase Order</h3>
    <h6 class="text-center"><span class="digits counter">NO {{ $po_number }}/PO/SII/{{ $month }}/{{ $year }}</span>
     </h6>

    <table width="100%" class="mt-2">
        <tr>
            <td>
                @if (empty($p->vendorable_type))
                    <p>Not Filled Yet</p>
                @elseif($p->vendorable_type == 'App\Models\CategoryPT')
                    <p>Name Vendor&nbsp; : <span>{{ $p->vendorable->nama }}</span><br>
                        Address&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <span>{{ $p->vendorable->alamat }}</span><br>
                        Contact&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span> {{ $p->vendorable->no_telp_kantor }}</span><br>
                        NPWP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span>{{ $p->vendorable->npwp_perusahaan }}</span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                        <span class="digits">
                            @if (empty($p->quotation))
                                -
                            @else
                                {{ $p->quotation }}
                            @endif
                        </span>
                @elseif ($p->vendorable_type == 'App\Models\CategoryPP')
                    <p>Name Vendor&nbsp; : <span>{{ $p->vendorable->nama }}</span><br>
                        Address &nbsp;:&nbsp;<span>{{ $p->vendorable->alamat }}</span><br>
                        NIK
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $p->vendorable->nik }}</span><br>
                        NPWP &nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $p->vendorable->npwp_pp }}</span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                        <span class="digits">
                            @if (empty($p->quotation))
                                -
                            @else
                                {{ $p->quotation }}
                            @endif
                        </span>
                    </p>
                @elseif($p->vendorable_type == 'App\Models\CategoryEcommerce')
                    <p>Name Vendor&nbsp; : <span>{{ $p->vendorable->nama }}</span><br>
                        Link &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;<span>
                    <a href="{{ $p->vendorable->link }}">{{ $p->vendorable->link }}</a></span><br>
                        Quotation&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                    <span class="digits">
                        @if (empty($p->quotation))
                            -
                        @else
                            {{ $p->quotation }}
                        @endif
                    </span>
                </p>
                @endif
            </td>

        </tr>
    </table>

    <table class="table table-bordered table-striped" style="margin-bottom: 50px;">
        <tbody>
            <tr class="text-center">
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
                @foreach($cpo as $item)
                    @if($p->vendorable->nama === $item->vendorable->nama)
                        <tr>
                            <td>
                                <p>{{ $no++ }}</p>
                            </td>
                            <td>
                                <label style="word-break: break-word;">{!! nl2br($item->items->item) !!}</label>
                            </td>
                            <td>
                                <p class="text-center">{{ $item->items->qty }}</p>
                            </td>
                            <td>
                                <p>{{ $item->items->kategori }}</p>
                            </td>
                            @if($item->ppb->matauang == 'RP')
                            <td class="text-right">
                                <p>Rp.{{ number_format($item->items->unit_price) }}</p>
                            </td>
                            @endif
                            @if($item->ppb->matauang == 'USD')
                            <td class="text-right">
                                <p>$ {{ number_format($item->items->unit_price) }}.00</p>
                            </td>
                            @endif

                            @if($item->ppb->matauang == 'RP')
                            <td class="text-right">
                                <p>Rp.{{ number_format($item->items->total) }}</p>
                            </td>
                            @endif
                            @if($item->ppb->matauang == 'USD')
                            <td class="text-right">
                                <p>$ {{ number_format($item->items->total) }}.00</p>
                            </td>
                            @endif
                        </tr>
                        @endif
                @endforeach
            {{-- @if($p->vendorable->nama === $item->vendorable->nama) --}}
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
                @php
                $dpp = $item->items->total + $item->items->total;
                @endphp
                    @if($p->ppb->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($dpp) }}</p>
                    </td>
                    @endif
                    @if($p->ppb->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($dpp) }}.00</p>
                    </td>
                    @endif
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
                @php
                    $dpp += $item->items->total + $item->items->total;
                    $ppn = $dpp * 11 / 100;
                @endphp
                    @if ($p->ppb->ppn == 0)
                        @if ($p->ppb->matauang == 'RP')
                        <td class="text-right">
                            <p class="m-0 digits text-end">Rp.0</p>
                        </td>
                        @endif
                        @if ($p->ppb->matauang == 'USD')
                        <td class="text-right">
                            <p class="m-0 digits text-end">$ 0</p>
                        </td>
                        @endif
                    @else
                            @if($p->ppb->matauang == 'RP')
                            <td class="text-right">
                                <p class="m-0 digits text-end">Rp.{{ number_format($ppn) }}</p>
                            </td>
                            @endif
                            @if($p->ppb->matauang == 'USD')
                            <td class="text-right">
                                <p class="m-0 digits text-end">$ {{ number_format($ppn) }}.00</p>
                            </td>
                            @endif
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
                @php
                    $dpp += $item->items->total + $item->items->total;
                    $ppn = $dpp * 11 / 100;
                    $grand_total = $ppn + $dpp;
                    // dd($p->ppb->ppn);

                @endphp

                    @if ($p->ppb->ppn == 0)
                            @if ($p->ppb->matauang == 'RP')
                                <td class="text-right">
                                    <h6 class="text-right "> Rp.{{ number_format($dpp) }}</h6>
                                </td>
                            @elseif ($p->ppb->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="text-right"> $ {{ number_format($dpp) }}.00</h6>
                                </td>
                            @endif
                    @elseif($p->ppb->ppn == 1)
                            @if ($p->ppb->matauang == 'RP')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> Rp. {{ number_format($grand_total) }}</h6>
                                </td>
                            @elseif ($p->ppb->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> $.{{ number_format($grand_total) }}.00</h6>
                                </td>
                            @endif
                    @endif
            </tr>
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td>
                <p class="legal"><strong>Terms & Conditions</strong> <br>
                    @if (empty($p->term->term_condition))
                        Not Filled in yet
                    @else
                        {!! nl2br($p->term->term_condition) !!}
                </p>
                @endif
            </td>
            <td align="right">


                <div style="text-align: center;">
                        @if ($p->ppb->status == 'Waiting For PO Approval' ||
                            $p->ppb->status == 'Purchase Proses' ||
                            $p->ppb->status == 'PO Approved' ||
                            $p->ppb->status == 'Invoicing Process' ||
                            $p->ppb->status == 'Payment Approved' ||
                            $p->ppb->status == 'Unpaid' ||
                            $p->ppb->status == 'Paid' ||
                            $p->ppb->status == 'Delivery Success')
                            <p>Jakarta, {{ $approvedAt }}</p>
                            @if (empty($p->signature))
                            @else
                                <p><img style=" width:100px;"
                                        src="{{ public_path('assets/images/signature_super_user/' . $p->signature) }}"
                                        alt=""></p>
                            @endif
                </div>
                @if (empty($p->ppb->atasans->name))
                    <div style="text-align: center; font-size: 18px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @else
                    <div style="text-align: center; font-size: 18px;">{{ $p->ppb->atasans->name }} <br>
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
                   height: 2cm;" class="text-center">
        <p>Head Office &nbsp;: Jl Cikunir Raya No.689 Jakamulya, Bekasi Selatan,
            Telp. 021-89454790 <br>
            Marketing Office : Jl Tebet Barat dalam raya No.31 Tebet Barat, Jakarta Selatan,<br>
            Telp. 021-21383852</p>
        </footer>
       @if(!$loop->last)
        <div style="page-break-after: always;"></div>
       @endif
    @endforeach
</body>
{{-- <body>
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
    @php
        $id_po = $id->pp_id;
        $po_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
    @endphp
    <h3 class="text-center">Purchase Order</h3>
    <h6 class="text-center"><span class="digits counter">NO {{ $po_number }}/PO/SII/{{ $month }}/{{ $year }}</span>
     </h6>

    <table width="100%" class="mt-2">
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

        </tr>
    </table>

    <table class="table table-bordered table-striped" style="margin-bottom: 50px;">
        <tbody>
            <tr class="text-center">
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
                        @if ($cpp->matauang == 'RP')
                        <td class="text-right">
                            <p class="m-0 digits text-end">Rp.0</p>
                        </td>
                        @endif
                        @if ($cpp->matauang == 'USD')
                        <td class="text-right">
                            <p class="m-0 digits text-end">$ 0</p>
                        </td>
                        @endif
                    @else
                        @foreach ($ppn as $pn)
                            @if($cpp->matauang == 'RP')
                            <td class="text-right">
                                <p class="m-0 digits text-end">Rp.{{ number_format($pn->total) }}</p>
                            </td>
                            @endif
                            @if($cpp->matauang == 'USD')
                            <td class="text-right">
                                <p class="m-0 digits text-end">$ {{ number_format($pn->total) }}.00</p>
                            </td>
                            @endif
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
                                <td class="text-right">
                                    <h6 class="text-right "> Rp.{{ number_format($tpn->total) }}</h6>
                                </td>
                            @elseif ($cpp->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="text-right"> $ {{ number_format($tpn->total) }}.00</h6>
                                </td>
                            @endif
                        @endforeach
                    @elseif($cpp->ppn == 1)
                        @foreach ($total as $t)
                            @if ($cpp->matauang == 'RP')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> Rp. {{ number_format($t->total) }}</h6>
                                </td>
                            @elseif ($cpp->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> $.{{ number_format($t->total) }}.00</h6>
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
                        @if ($cpp->status == 'Waiting For PO Approval' ||
                            $cpp->status == 'Purchase Proses' ||
                            $cpp->status == 'PO Approved' ||
                            $cpp->status == 'Invoicing Process' ||
                            $cpp->status == 'Payment Approved' ||
                            $cpp->status == 'Unpaid' ||
                            $cpp->status == 'Paid' ||
                            $cpp->status == 'Delivery Success')
                            <p>Jakarta, {{ $approvedAt }}</p>
                            @if (empty($cpo->signature))
                            @else
                                <p><img style=" width:100px;"
                                        src="{{ public_path('assets/images/signature_super_user/' . $cpo->signature) }}"
                                        alt=""></p>
                            @endif
                </div>
                @if (empty($cpp->atasans->name))
                    <div style="text-align: center; font-size: 18px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @else
                    <div style="text-align: center; font-size: 18px;">{{ $cpp->atasans->name }} <br>
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
                   height: 2cm;" class="text-center">
        <p>Head Office &nbsp;: Jl Cikunir Raya No.689 Jakamulya, Bekasi Selatan,
            Telp. 021-89454790 <br>
            Marketing Office : Jl Tebet Barat dalam raya No.31 Tebet Barat, Jakarta Selatan,<br>
            Telp. 021-21383852</p>
    </footer>
</body> --}}

</html>
