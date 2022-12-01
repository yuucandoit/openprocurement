<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Purchase Order</title>
    <style type="text/css">
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font: inherit;
            font-size: 100%;
            vertical-align: baseline;
        }

        html {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        caption,
        th,
        td {
            text-align: left;
            font-weight: normal;
            vertical-align: middle;
        }

        q,
        blockquote {
            quotes: none;
        }

        q:before,
        q:after,
        blockquote:before,
        blockquote:after {
            content: "";
            content: none;
        }

        a img {
            border: none;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        menu,
        nav,
        section,
        summary {
            display: block;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        body a {
            text-decoration: none;
            color: inherit;
        }

        body a:hover {
            color: inherit;
            opacity: 0.7;
        }

        body .container {
            min-width: 700px;
            margin: 0 auto;
            padding: 0 20px;
        }

        body .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        body .left {
            float: left;
        }

        body .right {
            float: right;
        }

        body .helper {
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }

        body .no-break {
            page-break-inside: avoid;
        }

        header {
            margin-top: 20px;
            margin-bottom: 50px;
        }

        header figure {
            float: left;
            width: 70px;
            height: 67px;
            margin-right: 10px;
            background-color: #000000;
            border-radius: 50%;
            text-align: center;
            margin-bottom: 5px;
        }

        header figure img {
            margin-top: 12px;
            width: 65px;
            height: 40px;
        }

        header .company-address {
            float: left;
            max-width: 150px;
            line-height: 1.7em;
        }

        header .company-address .title {
            color: #8BC34A;
            font-weight: 400;
            font-size: 1.5em;
            text-transform: uppercase;
        }

        header .company-contact {
            float: right;
            height: 60px;
            width: 120px;
            padding: 0 10px;
            background-color: #8BC34A;
            color: white;
            font-size: 10px;
        }

        header .company-contact span {
            display: inline-block;
            vertical-align: middle;
        }

        header .company-contact .circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            text-align: center;
        }

        header .company-contact .circle img {
            vertical-align: middle;
        }

        header .company-contact .phone {
            height: 100%;
            margin-right: 20px;
        }

        header .company-contact .email {
            height: 100%;
            min-width: 100px;
            text-align: right;
        }

        section .details {
            margin-bottom: 55px;
        }

        section .details .client {
            width: 50%;
            line-height: 20px;
        }

        section .details .client .name {
            color: #8BC34A;
        }

        section .details .data {
            width: 50%;
            text-align: right;
        }

        section .details .title {
            margin-bottom: 15px;
            color: #8BC34A;
            font-size: 3em;
            font-weight: 400;
            text-transform: uppercase;
        }

        section table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 0.9166em;
        }

        section table .qty,
        section table .unit,
        section table .price,
        section table .total {
            width: 15%;

        }

        section table .unit {
            text-align: center;
        }

        section table .desc {
            width: 3%;
        }

        section table thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        section table thead th {
            padding: 5px 10px;
            background: #8BC34A;
            border-bottom: 5px solid #FFFFFF;
            border-right: 4px solid #FFFFFF;
            text-align: center;
            color: white;
            font-weight: 400;
            text-transform: uppercase;
        }

        section table thead th:last-child {
            border-right: none;
        }

        section table thead .desc {
            text-align: center;
        }

        section table thead .qty {
            text-align: center;
        }

        section table thead .price {
            text-align: right;
        }

        section table tbody td {
            padding: 10px;
            background: #E8F3DB;
            color: #777777;
            text-align: right;
            border-bottom: 5px solid #FFFFFF;
            border-right: 4px solid #E8F3DB;
        }

        section table tbody td:last-child {
            border-right: none;
        }

        section table tbody h3 {
            margin-bottom: 5px;
            color: #8BC34A;
            font-weight: 600;
        }

        section table tbody .desc {
            text-align: left;
        }

        section table tbody .qty {
            text-align: center;
        }

        section table.grand-total {
            margin-bottom: 45px;
        }

        section table.grand-total td {
            padding: 5px 10px;
            border: none;
            color: #777777;
            text-align: right;
        }

        section table.grand-total .desc {
            background-color: transparent;
        }

        section table.grand-total tr:last-child td {
            font-weight: 600;
            color: #8BC34A;
            font-size: 1.18181818181818em;
        }

        footer {
            margin-bottom: 20px;
        }

        footer .thanks {
            margin-bottom: 40px;
            color: #777777;
            font-size: 1.16666666666667em;
            font-weight: 600;
        }

        footer .notice {
            margin-bottom: 25px;
        }

        footer .end {
            padding-top: 5px;
            border-top: 2px solid #8BC34A;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix" style="border-bottom: 2px solid #8BC34A; padding-bottom: 5px;">
        <div class="container">
            <figure>
                <img class="logo" src="{{ public_path('assets/images/Logo-Intek-8K.png') }}" alt="">
            </figure>
            <div class="company-address">
                <h2 class="title" style="min-width: 800px;">PT.Solusi Intek Indonesia</h2>
                <p style="min-width: 800px;">
                    Head Office : Emerald Commercial Blok UB No. 50 Summarecon Bekasi Telp. 021-89454790<br>
                    Mkt Office : Jl Tebet Barat dalam raya No. 31 Tebet Barat, Jakarta Selatan, Telp 021-21383852
                </p>
            </div>
        </div>
    </header>

    <section>
        <div class="container" style="padding-bottom: 8px;">
            <div class="details clearfix">
                <div class="client left">
                    <h6>Vendor:</h6>
                    @if (empty($cpo->vendorable_type))
                        <p>Not Filled Yet</p>
                    @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                        <p class="name">{{ $cpo->vendorable->nama }}</p>
                        <p class="name">{{ $cpo->vendorable->alamat }}</p>
                        <p class="name">{{ $cpo->vendorable->no_telp_kantor }}</p>
                        <a href="">{{ $cpo->vendorable->website }}</a>
                    @elseif ($cpo->vendorable_type == 'App\Models\CategoryPP')
                        <p class="name">{{ $cpo->vendorable->nama }}</p>
                        <p class="name">{{ $cpo->vendorable->alamat }}</p>
                        <p class="name">{{ $cpo->vendorable->nik }}</p>
                        <a href="">{{ $cpo->vendorable->npwp_pp }}</a>
                    @elseif($cpo->vendorable_type == 'App\Models\CategoryEcommerce')
                        <p class="name">{{ $cpo->vendorable->nama }}</p>
                        <p href="{{ $cpo->vendorable->link }}">{{ $cpo->vendorable->link }}</p>
                    @endif
                </div>
                @php
                    use Carbon\Carbon;
                    $date = Carbon::parse($id->created_at)->format('d/m/Y');
                @endphp
                <div class="data right">
                    <div class="title" style="font-size: 20px; font-weight: bold; margin-bottom: 13px;">Purchase Order
                    </div>
                    <div class="title" style="font-size: 17px;">
                        {{ $id->id }}/PO/SII/{{ $month }}/{{ $year }}</div>
                    <div class="date" style="font-size: 16px; font-family: tahoma;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th class="date">Date</th>
                                    <th class="quot">Quotation</th>
                                    <th class="add">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border-right: 4px solid #FFFFFF; text-align: center;">
                                        {{ $date }}
                                    </td>
                                    <td style="border-right: 4px solid #FFFFFF; text-align: center;">
                                        @if (empty($cpo->quotation))
                                            -
                                        @else
                                            {{ $cpo->quotation }}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @if (empty($cpo->address))
                                            -
                                        @else
                                            {{ $cpo->address }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                    <th class="cont">Contact</th>
                                    <th class="npwp">NPWP</th>
                                    <th class="request">Request By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border-right: 4px solid #FFFFFF; text-align: center;">
                                        @if (empty($cpo->no_telp))
                                            -
                                        @else
                                            {{ $cpo->no_telp }}
                                        @endif
                                    </td>
                                    <td style="border-right: 4px solid #FFFFFF; text-align: center;">
                                        @if (empty($cpo->no_npwp))
                                            -
                                        @else
                                            {{ $cpo->no_npwp }}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @foreach ($cpp as $p)
                                            <p>{{ $p->dps->name }}</p>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="desc">Item</th>
                        <th class="qty">Quantity</th>
                        <th class="unit">Unit</th>
                        <th class="price" style="text-align: center;">Price/Unit</th>
                        <th class="total">Total</th>
                    </tr>
                </thead>
                @foreach ($category_q as $q)
                    <tbody>
                        <tr>
                            <td class="desc">
                                <h3>{{ $q->item }}</h3>
                            </td>
                            <td class="qty">{{ $q->qty }}</td>
                            <td class="unit">{{ $q->kategori }}</td>
                            <td class="price">Rp.{{ number_format($q->unit_price) }}</td>
                            <td class="total">Rp.{{ number_format($q->total) }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <div class="no-break">
                <table class="grand-total">
                    <tbody>
                        <tr>
                            <td class="desc"></td>
                            <td class="desc"></td>
                            <td class="desc"></td>
                            <td class="unit" colspan="3">DPP </td>
                            @foreach ($dpp as $dp)
                                <td class="total" colspan="2">
                                    <p class="m-0 digits">Rp.{{ number_format($dp->total) }}</p>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="desc"></td>
                            <td class="desc"></td>
                            <td class="desc"></td>
                            <td class="unit" colspan="3">PPN 11% </td>
                            @foreach ($cpp as $c)
                                @if ($c->ppn == 0)
                                    <td class="total">
                                        <p class="m-0 digits">Rp.0</p>
                                    </td>
                                @else
                                    @foreach ($ppn as $pn)
                                        <td colspan="2">
                                            <p class="m-0 digits">Rp.{{ number_format($pn->total) }}</p>
                                        </td>
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td class="desc"></td>
                            <td class="desc"></td>
                            <td class="desc"></td>
                            <td class="unit" colspan="3">GRAND TOTAL </td>
                            @foreach ($cpp as $c)
                                @if ($c->ppn == 0)
                                    @foreach ($total_tnp_ppn as $tpn)
                                        @if ($c->matauang == 'RP')
                                            <td class="total"> Rp.{{ number_format($tpn->total) }}</td>
                                        @elseif ($c->matauang == 'USD')
                                            <td class="total"> $ {{ number_format($tpn->total) }}</td>
                                        @endif
                                    @endforeach
                                @elseif($c->ppn == 1)
                                    @foreach ($total as $t)
                                        @if ($c->matauang == 'RP')
                                            <td class="total" colspan="2"> Rp. {{ number_format($t->total) }}</td>
                                        @elseif ($c->matauang == 'USD')
                                            <td class="total" colspan="2"> $.{{ number_format($t->total) }}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="thanks"><strong>Term & Conditions :</strong>
                <br>
                @if (empty($cpo->term->term_condition))
                    Not Filled in yet
                @else
                    {!! nl2br($cpo->term->term_condition) !!}
            </div>
            @endif
            <div class="notice">
                <table class="table table-bordered table-striped" style="width: 35%; float: right;">
                    <thead>
                        <tr>
                            <th>
                                <h6 style="text-align: center;"> Diperiksa dan Disetuju Oleh,</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 26%;">
                                <p style=" text-align: center; margin-top: 25%;">
                                    @foreach ($cpp as $c)
                                        @if ($c->status == 'PO Approved')
                                            <p><img src="{{ public_path('assets/images/' . $c->image) }}"
                                                    alt="" style=" width:120px;"></p>
                                </p>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td style="text-align: center; font-size: 18px;">
                                {{ $atasan->atasans->name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                <label>Director</label>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </footer>

</body>

</html>
