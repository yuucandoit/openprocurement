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
            <th style="border: 1px solid black" colspan="3">QPB/{{ $category_ppb->id }}/SII/{{ $month }}/{{ $year }}/{{ $day }}</th>
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
                <th style="border: 1px solid black" colspan="14">{{ $category_ppb->ws }}</th>
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
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="3">Quantity</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="3">Type</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="3">Price Unit</td>
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
            <td style="text-align: center ; border: 1px solid black" colspan="3">{{ $item->qty }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">{{ $item->kategori }}</td>
            @if ($category_ppb->matauang == 'RP')
            <td style="text-align: center ; border: 1px solid black" colspan="3">RP. {{ number_format($item->unit_price) }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">RP. {{ number_format($item->total) }}</td>
            @endif
            @if ($category_ppb->matauang == 'USD')
            <td style="text-align: center ; border: 1px solid black" colspan="3">$ {{ number_format($item->unit_price) }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">$ {{ number_format($item->total) }}</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>

        <tr>
            <td style=" ; border: 1px solid black ; font-size: 12px" colspan="15" rowspan="2"><strong>DIKIRIMKAN KE:</strong></td>
            <td style="text-align: right ; border: 1px solid black" colspan="4" rowspan="2">{{$category_ppb->send_to}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>

        <tr>
            <td style=" ; border: 1px solid black ; font-size: 12px" colspan="15" rowspan="2"><strong>TANGGAL PENGIRIMAN :</strong></td>
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
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="4">{{ $category_ppb->ws }}</td>
            <td></td>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="4">..Nama Atasan..</td>

    </tbody>

</table>
