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
    @php
         use Carbon\Carbon;
        $date = Carbon::parse($cpo->ppb->created_at)->format('d/m/Y');
        $p =  App\Models\Invoicing::where('ppb_id', $cpo->ppb_id)->first();
        if (empty($p->approved_at)) {
            $approvedAt = 'Not Record yet';
        } else {
            $approvedAt = Carbon::parse($p->approved_at)->format('d F Y');
        }
    @endphp
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
        $id_po = $cpo->id;
        $po_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
    @endphp
    <h3 class="text-center">Pengajuan Dana</h3>
    <h6 class="text-center"><span class="digits counter">NO {{ $po_number }}/PO/SII/{{ $month }}/{{ $year }}</span>
     </h6>
     <table width="100%" class="mt-2">
        <tr>
            <td>
                @if (empty($cpo->vendorable_type))
                    <p>Not Filled Yet</p>
                @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                    <p> Name Vendor&nbsp;&nbsp; : <span>{{ $cpo->vendorable->nama }}</span><br>
                        Address&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: <span>{{ $cpo->vendorable->alamat }}</span><br>
                        Contact&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; : <span> {{ $cpo->vendorable->no_telp_kantor }}</span><br>
                        NPWP&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: <span>{{ $cpo->vendorable->npwp_perusahaan }}</span><br>
                        Bank&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <span>{{ $cpo->vendorable->bank }}</span><br>
                        No.Rekening&nbsp; &nbsp;   : <span>{{ $cpo->vendorable->no_rekening }}</span><br>
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

    <table class="table table-bordered table-striped" style="margin-bottom: 50px; font-size:10;">
        <tbody>
            <tr>
                <td>
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size:10; font-weight:700;">No</p>
                </td>
                <td style="text-align: center">
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size:10; font-weight:700;">Item</p>
                </td>
                <td class="Hours" style="text-align: center">
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size:10; font-weight:700;">Quantity</p>
                </td>
                <td class="Rate">
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size:10; font-weight:700;">Unit</p>
                </td>
                <td class="subtotal" style="text-align: center">
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size:10; font-weight:700;">Price/Unit</p>
                </td>
                <td class="subtotal" style="text-align: center">
                    <p style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size:10; font-weight:700;">Total</p>
                </td>
            </tr>
            @php
                $no = 1
            @endphp
             {{-- @foreach ($cpo->ppb as $c) --}}
             @foreach ($cpo->itempo as $items)
                <tr>
                    <td>
                        <p>{{ $no++ }}</p>
                    </td>

                    <td >
                        <label style="word-break: break-word;">{!! nl2br($items->item) !!}</label>
                    </td>
                    <td>
                        <p class="text-center">{{ $items->qty }}</p>
                    </td>
                    <td>
                        <p>{{ $items->kategori }}</p>
                    </td>
                    @if($items->matauang == 'RP')
                    <td class="text-right">
                        <p>Rp.{{ number_format($items->unit_price,2) }}</p>
                    </td>
                    @endif
                    @if($items->matauang == 'USD')
                    <td class="text-right">
                        <p>$ {{ number_format($items->unit_price,2) }}</p>
                    </td>
                    @endif

                    @if($items->matauang == 'RP')
                    <td class="text-right">
                        <p>Rp.{{ number_format($items->total,2) }}</p>
                    </td>
                    @endif
                    @if($items->matauang == 'USD')
                    <td class="text-right">
                        <p>$ {{ number_format($items->total,2) }}</p>
                    </td>
                    @endif
                </tr>
                @endforeach

            @foreach ($harga as $value)
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
                {{-- {{ dd($value) }} --}}
                    @if($value->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($value->dpp,2) }}</p>
                    </td>
                    @endif
                    @if($value->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($value->dpp,2) }}</p>
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
                    <p class="m-0">Discount </p>
                </td>
                {{-- {{ dd($value) }} --}}
                    @if($value->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($value->discount,2) }}</p>
                    </td>
                    @endif
                    @if($value->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($value->discount ,2) }}</p>
                    </td>
                    @endif
            </tr>

            <tr>
                @php
                $dpp = $value->dpp;
                $disc = $value->discount;
                $afterdisc = $dpp - $disc;
                $ppn = $afterdisc *11 /100 ;
                @endphp
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
                    @if ($value->ppn == 0)
                        @if ($value->matauang == 'RP')
                        <td class="text-right">
                            <p class="m-0 digits text-end">Rp.0</p>
                        </td>
                        @endif
                        @if ($value->matauang == 'USD')
                        <td class="text-right">
                            <p class="m-0 digits text-end">$ 0</p>
                        </td>
                        @endif
                    @else
                            @if($value->matauang == 'RP')
                            <td class="text-right">
                                <p class="m-0 digits text-end">Rp.{{ number_format($ppn,2) }}</p>
                            </td>
                            @endif
                            @if($value->matauang == 'USD')
                            <td class="text-right">
                                <p class="m-0 digits text-end">$ {{ number_format($ppn,2) }}</p>
                            </td>
                            @endif
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
                    <p class="m-0">Shipping & Protection Fee </p>
                </td>
                {{-- {{ dd($value) }} --}}
                    @if($value->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($value->ongkir,2) }}</p>
                    </td>
                    @endif
                    @if($value->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($value->ongkir,2) }}</p>
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
                    <p class="m-0">Admin Or Service Fee </p>
                </td>
                {{-- {{ dd($value) }} --}}
                    @if($value->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($value->admin_fee,2) }}</p>
                    </td>
                    @endif
                    @if($value->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($value->admin_fee,2) }}</p>
                    </td>
                    @endif
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="Rate">
                    <p class="mb-0" style="font-weight: 700;">Total </p>
                </td>
                    @if ($value->ppn == 0)
                            @if ($value->matauang == 'RP')
                                <td class="text-right" style="white-space: nowrap;">
                                    <p style="font-weight: 700;" class="text-right"> Rp.{{ number_format($value->grand_total,2) }}</p>
                                </td>
                            @elseif ($value->matauang == 'USD')
                                <td class="text-right" style="white-space: nowrap;">
                                    <p style="font-weight: 700;" class="text-right"> $ {{ number_format($value->grand_total  ,2) }}</p>
                                </td>
                            @endif
                    @elseif($value->ppn == 1)
                            @if ($value->matauang == 'RP')
                                <td class="text-right" style="white-space: nowrap;">
                                    <p style="font-weight: 700;" class="mb-0 text-right"> Rp. {{ number_format($value->grand_total,2) }}</p>
                                </td>
                            @elseif ($value->matauang == 'USD')
                                <td class="text-right" style="white-space: nowrap;">
                                    <p style="font-weight: 700;" class="mb-0 text-right"> $.{{ number_format($value->grand_total  ,2) }}</p>
                                </td>
                            @endif
                    @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td>
                <p class="legal" style="margin-top:-80px;"><strong>Terms & Conditions</strong> <br>
                    @if (empty($cpo->term->term_condition))
                        Not Filled in yet
                    @else
                        {!! nl2br($cpo->term->term_condition) !!}
                </p>
                @endif
            </td>
            <td align="right">
                @php
                    $sig =  App\Models\Invoicing::where('ppb_id', $cpo->ppb_id)->first();
                @endphp

                <div style="text-align: center; font-size:14px; margin-top:-40px;">
                        @if (
                            $cpo->ppb->status == 'PO Approved' ||
                            $cpo->ppb->status == 'Invoicing Process' ||
                            $cpo->ppb->status == 'Payment Approved' ||
                            $cpo->ppb->status == 'Unpaid' ||
                            $cpo->ppb->status == 'Paid' ||
                            $cpo->ppb->status == 'Delivery Success')
                            <p>Jakarta, {{ $approvedAt }}</p>
                            @if (empty($sig->signature))
                            @else
                                <p><img style="max-height:80px; margin-top:-15px;"
                                        src="{{ public_path('assets/images/signature_super_user/'.$sig->signature) }}"
                                        alt=""></p>
                            @endif
                </div>
                @if (empty($p->ppb->atasanpymnt->name))
                    <div style="text-align: center; font-size: 15px; margin-top:-10px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @else
                    <div style="text-align: center; font-size: 15px; margin-top:-10px;">{{ $p->ppb->atasanpymnt->name }} <br>
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
</body>

</html>
