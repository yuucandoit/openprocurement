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

    foreach($cpo as $p){
        $date = Carbon::parse($p->ppb->created_at)->format('d/m/Y');
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
        $id_po = $p->ppb_id;
        $po_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
    @endphp
    <h3 class="text-center">Pengajuan Dana</h3>
    <h6 class="text-center"><span class="digits counter">NO {{ $po_number }}/PD/SII/{{ $month }}/{{ $year }}</span>
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
                @foreach($p->itempo as $item)
                        <tr>
                            <td>
                                <p>{{ $no++ }}</p>
                            </td>
                            <td>
                                <label style="word-break: break-word;">{!! nl2br($item->item) !!}</label>
                            </td>
                            <td>
                                <p class="text-center">{{ $item->qty }}</p>
                            </td>
                            <td>
                                <p>{{ $item->kategori }}</p>
                            </td>
                            @if($item->matauang == 'RP')
                            <td class="text-right">
                                <p>Rp.{{ number_format($item->unit_price) }}</p>
                            </td>
                            @endif
                            @if($item->matauang == 'USD')
                            <td class="text-right">
                                <p>$ {{ number_format($item->unit_price /100 ,2) }}</p>
                            </td>
                            @endif

                            @if($item->matauang == 'RP')
                            <td class="text-right">
                                <p>Rp.{{ number_format($item->total) }}</p>
                            </td>
                            @endif
                            @if($item->matauang == 'USD')
                            <td class="text-right">
                                <p>$ {{ number_format($item->total /100 ,2) }}</p>
                            </td>
                            @endif
                        </tr>
                @endforeach
            {{-- @if($p->vendorable->nama === $item->vendorable->nama) --}}

            @foreach ($harga as $price)
            @if($p->id === $price->po_id)
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

                    @if($price->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($price->dpp) }}</p>
                    </td>
                    @endif
                    @if($price->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($price->dpp / 100 ,2) }}</p>
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

                    @if($price->matauang == 'RP')
                    <td>
                        <p class="m-0 digits text-right">Rp.{{ number_format($price->discount) }}</p>
                    </td>
                    @endif
                    @if($price->matauang == 'USD')
                    <td>
                        <p class="m-0 digits text-right">$ {{ number_format($price->discount /100,2) }}</p>
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
                    $dpp = $price->dpp - $price->discount;
                    $ppn = $dpp * 11 / 100;
                @endphp
                    @if ($price->ppn == 0)
                        @if ($price->matauang == 'RP')
                        <td class="text-right">
                            <p class="m-0 digits text-end">Rp.0</p>
                        </td>
                        @endif
                        @if ($price->matauang == 'USD')
                        <td class="text-right">
                            <p class="m-0 digits text-end">$ 0</p>
                        </td>
                        @endif
                    @else
                            @if($price->matauang == 'RP')
                            <td class="text-right">
                                <p class="m-0 digits text-end">Rp.{{ number_format($ppn) }}</p>
                            </td>
                            @endif
                            @if($price->matauang == 'USD')
                            <td class="text-right">
                                <p class="m-0 digits text-end">$ {{ number_format($ppn /100 ,2) }}.00</p>
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
                    @if ($price->ppn == 0)
                            @if ($price->matauang == 'RP')
                                <td class="text-right">
                                    <h6 class="text-right "> Rp.{{ number_format($price->grand_total) }}</h6>
                                </td>
                            @elseif ($price->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="text-right"> $ {{ number_format($price->grand_total /100 ,2) }}</h6>
                                </td>
                            @endif
                    @elseif($price->ppn == 1)
                            @if ($price->matauang == 'RP')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> Rp. {{ number_format($price->grand_total) }}</h6>
                                </td>
                            @elseif ($price->matauang == 'USD')
                                <td class="text-right">
                                    <h6 class="mb-0 text-right"> $ {{ number_format($price->grand_total /100 ,2) }}</h6>
                                </td>
                            @endif
                    @endif
            </tr>
            @endif
            @endforeach
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
                            @if (empty($sig->signature))
                            @else
                                <p><img style=" width:100px;"
                                        src="{{ public_path('assets/images/signature_super_user/'.$sig->signature) }}"
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

</html>
