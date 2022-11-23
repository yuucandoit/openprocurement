<table>
    <thead>

        <tr>
            <td></td>
        </tr>

        <tr>
            <th style="border: 1px solid black" colspan="4" rowspan="3"></th>
            <th style="border: 1px solid black ; text-align: center" colspan="11" rowspan="3">
                <strong>FORM PENGAJUAN PEMBELIAN</strong>
            </th>
            <th style="border: 1px solid black ">Date</th>
            @php
                $date = \Carbon\Carbon::parse($category_ppb->date_ps)->format('d/m/Y');
            @endphp
            <th style="border: 1px solid black" colspan="3">{{ $date }}</th>
        </tr>
        <tr>
            <th style="border: 1px solid black">No. PR</th>
            <th style="border: 1px solid black" colspan="3">PB/{{ $category_ppb->id }}/SII/{{ $month }}/{{ $year }}</th>
        </tr>
        <tr>
            <th style="border: 1px solid black">No. Quotation</th>
            @foreach ($po as $p)
            @if(empty($p->quotation))
            -
            @else
            <th style="border: 1px solid black" colspan="3">{{ $p->quotation }}/{{ $category_ppb->id }}/SII/{{ $month }}/{{ $year }}/{{ $day }}</th>
            @endif
            @endforeach
        </tr>
        <tr>
            <th></th>
        </tr>

        <tr>
            <td></td>
        </tr>

    </thead>

    <tbody>
            <tr>
                <th style="border: 1px solid black" colspan="4">Yang Mengajukan</th>
                <th style="border: 1px solid black">:</th>
                <th style="border: 1px solid black" colspan="14">{{ $category_ppb->whosubmit->name }}</th>
            </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="border: 1px solid black" colspan="4">Department</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="14">{{ $category_ppb->department }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>

        {{-- <tr>
            <td style="border: 1px solid black ; text-align:center">2</td>
            <td style="border: 1px solid black" colspan="4">Lokasi</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="12">{{ $category_pd->lokasi }}</td>
        </tr>

        <tr>
            <td style="border: 1px solid black ; text-align:center">3</td>
            <td style="border: 1px solid black" colspan="4">Jangka Waktu</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="12">{{ $category_pd->jangka_waktu }}</td>
        </tr>

        <tr>
            <td style="border: 1px solid black ; text-align:center">4</td>
            <td style="border: 1px solid black ; text-align: left" colspan="4">Nominal</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="12">{{ $category_pd->nominal }}</td>
        </tr>

        <tr>
            <td style="border: 1px solid black ; text-align:center">5</td>
            <td style="border: 1px solid black ; text-align: left" colspan="4">No Rekening</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="12">{{ $category_pd->no_rek }}</td>
        </tr> --}}

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="4">NO</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="6">Item</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="2">Quantity</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="2">Type</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="2">Price Unit</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="3">Total</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td colspan="16"></td>
        </tr>

        @php
            $no = 1;
            // $total = 0;
        @endphp
        {{-- @php
            $total += $pb->total;
        @endphp --}}
        @foreach ($ppb as $item)
        <tr>
            <td style="text-align: center ; border: 1px solid black" colspan="4">{{ $no++ }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="6">{{ $item->item }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="2">{{ $item->qty }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="2">{{ $item->kategori }}</td>
            @if ($category_ppb->matauang == 'RP')
            <td style="text-align: center ; border: 1px solid black" colspan="2">RP. {{ number_format($item->unit_price) }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">RP. {{ number_format($item->total) }}</td>
            @endif
            @if ($category_ppb->matauang == 'USD')
            <td style="text-align: center ; border: 1px solid black" colspan="2">$ {{ number_format($item->unit_price) }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">$ {{ number_format($item->total) }}</td>
            @endif
        </tr>
        @endforeach

        <tr>
            <td></td>
        </tr>
        @foreach ($dpp as $d)
        <tr>
            <td style="text-align: right ; border: 1px solid black" rowspan="2" colspan="16">DPP :</td>
            @if($category_ppb->matauang == 'RP')

            @endif
            <td style="text-align: right ; border: 1px solid black" rowspan="2" colspan="3">{{ $d->total }}</td>
        </tr>
        @endforeach

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="text-align: right ; border: 1px solid black" rowspan="2" colspan="16">PPN 11% :</td>
            <td style="text-align: right ; border: 1px solid black" rowspan="2" colspan="3"></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        @if($category_ppb->ppn = 1)
        <tr>
            <td style="text-align: right ; border: 1px solid black" rowspan="2" colspan="16">Grand Total :</td>
            @foreach ($total as $t)
            @if ($category_ppb->matauang == 'RP')
                <td style="text-align: center ; border: 1px solid black" rowspan="2" colspan="3">RP. {{ number_format($t->total) }}
                </td>
     {{-- jika mata uang yang di pilih USD Maka Return $    --}}
            @elseif ($category_ppb->matauang == 'USD')
                <td style="text-align: center ; border: 1px solid black" rowspan="2" colspan="3">$ {{ number_format($t->total) }}
                </td>
            @endif
            @endforeach

        @elseif($category_ppb->ppn = 0)
            @foreach ($total_tnpa_ppn as $tpn)
                @if ($category_ppb->matauang == 'RP')
            <td style="text-align: center ; border: 1px solid black" rowspan="2" colspan="3">RP. {{ number_format($tpn->total) }}</td>
                @elseif ($category_ppb->matauang == 'USD')
            <td style="text-align: center ; border: 1px solid black" rowspan="2" colspan="3">$ {{ number_format($tpn->total) }}</td>
                @endif
        @endforeach
        </tr>
        @endif

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style=" border: 1px solid black ; font-size: 12px" colspan="15" rowspan="2"><strong>DIKIRIMKAN KE:</strong></td>
            <td style="text-align: right ; border: 1px solid black" colspan="4" rowspan="2">{{$category_ppb->send_to}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>

        <tr>
            <td style=" border: 1px solid black ; font-size: 12px" colspan="15" rowspan="2"><strong>TANGGAL PENGIRIMAN :</strong></td>
            <td style="text-align: right ; border: 1px solid black" colspan="4" rowspan="2">{{$category_ppb->date_send}}</td>
        </tr>

        <tr>
            <td></td>
        </tr>
        <tr>
            <td style=" ; border: 1px solid black ; font-size: 12px" colspan="15" rowspan="2"><strong>PEMASOK YANG DIUSULKAN :</strong></td>
            <td style="text-align: right ; border: 1px solid black" colspan="4" rowspan="2">{{ $category_ppb->proposed_supplier }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>

        <tr>
            <td colspan="18">Demikian drafting pengajuan dana ini saya Sampaikan, atas bantuan dan kerjasamanya saya ucapkan terima kasih.</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="border: 1px solid black ; text-align: center" colspan="5">Diajukan Oleh</td>
            <td></td>
            <td style="border: 1px solid black ; text-align: center" colspan="5">Diperiksa Dan Disetujui Oleh,</td>
        </tr>

        <tr>
            <td style=" border: 1px solid black ; font-size: 12px" colspan="5" rowspan="3"></td>
            <td></td>
            <td style=" border: 1px solid black ; font-size: 12px" colspan="5" rowspan="3"></td>
        </tr>

        <tr>
            <td></td>
        </tr>


        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="4">{{ $category_ppb->whosubmit->name }}</td>
            <td></td>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="4">..Nama Atasan..</td>

    </tbody>

</table>
