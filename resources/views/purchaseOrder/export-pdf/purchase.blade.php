<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Purchase Order</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ public_path('assets/images/Logo-Intek-8K.png') }}">
        </div>
        <div id="company">
            <h2 class="name">PT.SOLUSI INTEK INDONESIA</h2>
            <div>Head Office : Emerald Commercial Blok UB No. 50 </div>
            <div>Summarecon Bekasi Telp. 021-89454790 </div>
            <div>Mkt Office : Jl Tebet Barat dalam raya No. 31 Tebet </div>
            <div>Barat, Jakarta Selatan, Telp 021-21383852 </div>
        </div>
        </div>
    </header>
    <div style="background-color: #29465B; color: #ffffff; font-weight: bold; text-align: center;">
        <h3>PURCHASE ORDER</h3>
    </div>
    <hr>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">VENDOR :</div>
                <p></p>
                @if (empty($cpo->vendorable_type))
                    <p>Not Filled Yet</p>
                @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                    <h2 class="name">{{ $cpo->vendorable->nama }}</h2>
                    <div class="address">{{ $cpo->vendorable->alamat }}</div>
                    <div class="contact">{{ $cpo->vendorable->no_telp_kantor }}</div>
                    <div class="email"><a href="">{{ $cpo->vendorable->website }}</a></div>
                @elseif ($cpo->vendorable_type == 'App\Models\CategoryPP')
                <h2 class="name">{{ $cpo->vendorable->nama }}</h2>
                <div class="address">{{ $cpo->vendorable->alamat }}</div>
                <div class="contact">{{ $cpo->vendorable->nik }}</div>
                <div class="email"><a href="">{{ $cpo->vendorable->npwp_pp }}</a></div>
                @elseif ($cpo->vendorable_type == 'App\Models\CategoryEcommerce')
                <h2 class="name">{{ $cpo->vendorable->nama }}</h2>
                <div class="address"><a href="{{ $cpo->vendorable->link }}">{{ $cpo->vendorable->link }}</a></div>
                @endif
            </div>
            @php
                use Carbon\Carbon;
                if (empty($cpo->created_at)) {
                    $date = '';
                } else {
                    $date = Carbon::parse($cpo->created_at)->format('d/m/Y');
                }
            @endphp
            <div id="invoice">
                <table border="1">
                    <tr>
                        <td
                            style="background-color: #29465B;
                            color: #ffffff; font-size: 18px;
                            font-weight: bold;
                            text-align: center;">
                            No PO
                        </td>
                        <td style="text-align: center; background-color: #ffffff; font-size: 18px; font-weight: bold;">
                        @if(empty($cpo->id))

                        @else
                            {{ $cpo->id }}/PO/SII/{{ $month }}/{{ $year }}
                        @endif

                        </td>
                    </tr>
                </table>
                <hr>
                <p></p>
                <table border="1">
                    <thead>
                        <tr style="border-right: 1px solid black;">
                            <th
                                style="text-align: center;
                                background-color: #29465B;
                                color: #ffffff; f
                                ont-weight: bold; font-size: 18px; border-left: 1px solid black;">
                                Date </th>
                            <th
                                style="text-align: center;
                            background-color: #29465B;
                            color: #ffffff; f
                            ont-weight: bold; font-size: 18px;">
                                Quotation </th>
                            <th
                                style="text-align: center;
                            background-color: #29465B;
                            color: #ffffff; f
                            ont-weight: bold; font-size: 18px;">
                                Address </th>
                    </thead>
                    <tr>
                        <td
                            style="border-right: 1px solid black;
                            border-left: 1px solid black;
                            border-bottom: 1px solid black;
                            background-color: #ffffff; text-align: center; font-weight: bold;">
                            {{ $date }}
                        </td>
                        <td
                            style="border-right: 1px solid black;
                            border-left: 1px solid black;
                            border-bottom: 1px solid black;
                            background-color: #ffffff; text-align: center; font-weight: bold;">
                        @if(empty($cpo->quotation))

                        @else
                            {{ $cpo->quotation }}
                        @endif
                        </td>
                        <td
                            style="border-right: 1px solid black;
                        border-left: 1px solid black;
                        border-bottom: 1px solid black;
                        background-color: #ffffff; text-align: center; font-weight: bold;">
                        @if(empty($cpo->address))

                        @else
                            {{ $cpo->address }}
                        @endif
                        </td>
                    </tr>
                </table>
                <table border="1">
                    <thead>
                        <tr style="border-right: 1px solid black;">
                            <th
                                style="text-align: center;
                                background-color: #29465B;
                                color: #ffffff; f
                                ont-weight: bold; font-size: 18px; border-left: 1px solid black;">
                                Contact </th>
                            <th
                                style="text-align: center;
                            background-color: #29465B;
                            color: #ffffff; f
                            ont-weight: bold; font-size: 18px;">
                                NPWP </th>
                    </thead>
                    <tr>
                        <td
                            style="border-right: 1px solid black;
                            border-left: 1px solid black;
                            border-bottom: 1px solid black;
                            background-color: #ffffff; text-align: center; font-weight: bold;">
                            @if(empty($cpo->no_telp))

                            @else
                            {{ $cpo->no_telp }}
                            @endif
                        </td>
                        <td
                            style="border-right: 1px solid black;
                            border-left: 1px solid black;
                            border-bottom: 1px solid black;
                            background-color: #ffffff; text-align: center; font-weight: bold;">
                            @if(empty($cpo->no_npwp))

                            @else
                            {{ $cpo->no_npwp }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">REQUEST BY :</div>
                @foreach ($cpp as $p)
                    <h2 class="name" style="font-size: 15px;">{{ $p->dps->name }}</h2>
                @endforeach
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="item">Item</th>
                    <th class="qty">Quantity</th>
                    <th class="unit">Unit</th>
                    <th class="price">Price/Unit</th>
                    <th class="total">Total</th>
                </tr>
            </thead>
            @foreach ($category_q as $q)
                <tbody>
                    <tr style="background-color: #ffffff; border: 1px solid #C0C0C0;">
                        <td style="text-align: center; font-size: 14px; border: 1px solid #C0C0C0">
                            {{ $q->item }}
                        </td>
                        <td style="text-align: center; font-size: 14px; border: 1px solid #C0C0C0">
                            {{ $q->qty }}
                        </td>
                        <td style="text-align: center; font-size: 14px; border: 1px solid #C0C0C0">{{ $q->kategori }}
                        </td>
                        <td style="border: 1px solid #C0C0C0">Rp.{{ number_format($q->unit_price) }} </td>
                        <td style="border: 1px solid #C0C0C0">Rp.{{ number_format($q->total) }} </td>
                    </tr>
                </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="font-weight: bold;">DPP :</td>
                    @foreach ($dpp as $dp)
                        <td>Rp.{{ number_format($dp->total) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="font-weight: bold;">PPN 11% :</td>
                    @foreach ($cpp as $c)
                        @if ($c->ppn == null)
                            <td>Rp.0</td>
                        @else
                            @foreach ($ppn as $pn)
                                <td>
                                    Rp.{{ number_format($pn->total) }}
                                </td>
                            @endforeach
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL :</td>
                    @foreach ($cpp as $c)
                        @if ($c->ppn == 0)
                            @foreach ($total_tnp_ppn as $tpn)
                                @if ($c->matauang == 'RP')
                                    <td style="payment digits">
                                        <h6 class="mb-0 "> Rp.{{ number_format($tpn->total) }}</h6>
                                    </td>
                                @elseif ($c->matauang == 'USD')
                                    <td style="payment digits">
                                        <h6 class="mb-0 "> $ {{ number_format($tpn->total) }}</h6>
                                    </td>
                                @endif
                            @endforeach
                        @elseif($c->ppn == 1)
                            @foreach ($total as $t)
                                @if ($c->matauang == 'RP')
                                    <td style="payment digits">
                                        <h6 class="mb-0 "> Rp. {{ number_format($t->total) }}</h6>
                                    </td>
                                @elseif ($c->matauang == 'USD')
                                    <td style="payment digits">
                                        <h6 class="mb-0 "> $.{{ number_format($t->total) }}</h6>
                                    </td>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </tr>
            </tfoot>
        </table>
        <br>
        <br>
        <div id="details" class="clearfix">
            <div id="client">
                <h2 style="font-size: 17px;">Term & conditions</h2>
                <div>
                    <p>
                        @if (empty($cpo->term->term_condition))
                            Not Filled in yet
                        @else
                            {!! nl2br($cpo->term->term_condition) !!}
                    </p>
                    @endif
                </div>
            </div>
            <div id="invoice">
                <h1>Thank You for your business!</h1>
                <div style="text-align: center;">
                    <p></p>
                </div>
                <div style="text-align: center;">
                    <p></p>
                </div>
                <div style="text-align: center;">
                    <p></p>
                </div>
                <div style="text-align: center;">
                    <p></p>
                </div>
                <div style="text-align: center;">
                    <p></p>
                </div>
                <div style="text-align: center;">
                    @foreach ($cpp as $c)
                        @if ($c->status == 'PO Approved')
                            <p><img src="{{ public_path('assets/images/' . $c->image) }}" alt=""
                                    style=" width:120px;"></p>
                </div>
            @else
            @if(empty($atasan->atasans->name))
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
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
