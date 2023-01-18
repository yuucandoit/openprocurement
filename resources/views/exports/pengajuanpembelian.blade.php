<table>
    <thead>

        <tr>
            <td colspan="22"></td>
        </tr>

        <tr>
            <th style="border: 1px solid black; vertical-align: center; background: #000000;" colspan="4"
                rowspan="3"></th>
            <th style="border: 1px solid black ; text-align: center; vertical-align: center; font-size: 18;"
                colspan="14" rowspan="3">
                <strong>FORM PURCHASE REQUEST</strong>
            </th>
            <th style="border: 1px solid black;width:100px; font-size: 13px;">Date</th>
            @php
                $date = \Carbon\Carbon::parse($category_ppb->date_ps)->format('d/m/Y');
            @endphp
            <th style="border: 1px solid black; font-size: 13px;" colspan="3">{{ $date }}</th>
        </tr>
        <tr>
            <th style="border: 1px solid black; font-size: 13px;">No. PR</th>
            <th style="border: 1px solid black; font-size: 13px;" colspan="3">
                PB/{{ $category_ppb->id }}/SII/{{ $month }}/{{ $year }}</th>
        </tr>
        <tr>
            <th style="border: 1px solid black; font-size: 13px;">No. Quotation</th>
            <th style="border: 1px solid black; font-size: 13px;" colspan="3">
                -</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

    </thead>

    <tbody>
        <tr>
            <th style="border: 1px solid black; font-size: 13px;" colspan="6">Yang Mengajukan</th>
            <th style="border: 1px solid black">:</th>
            <th style="border: 1px solid black; text-align:left; font-size: 13px;" colspan="15">&nbsp;
                {{ $category_ppb->whosubmit->name }}</th>
        </tr>

        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

        <tr>
            <td style="border: 1px solid black; font-size: 13px;" colspan="6">Department</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black; text-align:left; font-size: 13px;" colspan="15">&nbsp;
                {{ $category_ppb->dps->name }}</td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
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
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

        <tr>
            <td style="text-align: center ; border:1px solid black; font-size: 14px; vertical-align:center; font-weight: bold;"
                rowspan="3" colspan="4">NO</td>
            <td style="text-align: center ; border:1px solid black; font-size: 14px; vertical-align:center; font-weight: bold;"
                rowspan="3" colspan="6">Item</td>
            <td style="text-align: center ; border:1px solid black; font-size: 14px; vertical-align:center; font-weight: bold;"
                rowspan="3" colspan="3">Quantity</td>
            <td style="text-align: center ; border:1px solid black; font-size: 14px; vertical-align:center; font-weight: bold;"
                rowspan="3" colspan="3">Type</td>
            <td style="text-align: center ; border:1px solid black; font-size: 14px; vertical-align:center; font-weight: bold;"
                rowspan="3" colspan="3">Price Unit</td>
            <td style="text-align: center ; border:1px solid black; font-size: 14px; vertical-align:center; font-weight: bold;"
                rowspan="3" colspan="3">Total</td>
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
                <td style="text-align: center ; border: 1px solid black; font-size: 13px;" colspan="4">
                    {{ $no++ }}</td>
                <td style="text-align: center ; border: 1px solid black; font-size: 13px;" colspan="6">
                    {{ $item->item }}</td>
                <td style="text-align: center; border: 1px solid black; font-size: 13px;" colspan="3">
                    {{ $item->qty }}</td>
                <td style="text-align: center ; border: 1px solid black; font-size: 13px;" colspan="3">
                    {{ $item->kategori }}</td>
                @if ($category_ppb->matauang == 'RP')
                    <td style="text-align: right; border: 1px solid black; font-size: 13px;" colspan="3">RP.
                        {{ number_format($item->unit_price) }}</td>
                    <td style="text-align: right; border: 1px solid black; font-size: 13px;" colspan="3">RP.
                        {{ number_format($item->total) }}</td>
                @endif
                @if ($category_ppb->matauang == 'USD')
                    <td style="text-align: right; border: 1px solid black; font-size: 13px;" colspan="3">$
                        {{ number_format($item->unit_price) }}</td>
                    <td style="text-align: right; border: 1px solid black; font-size: 13px;" colspan="3">$
                        {{ number_format($item->total) }}</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

        <tr>
            <td style=" ; border: 1px solid black ; font-size: 13px; vertical-align: center;" colspan="15"
                rowspan="2">
                <strong>DIKIRIMKAN
                    KE:</strong>
            </td>
            <td style="text-align: center ; border: 1px solid black; vertical-align: center;" colspan="7"
                rowspan="2">
                {{ $category_ppb->send_to }}</td>
        </tr>
        <tr>
            <td></td>
        </tr>

        <tr>
            <td style=" ; border: 1px solid black ; font-size: 12px; vertical-align: center;" colspan="15"
                rowspan="2"><strong>TANGGAL
                    PENGIRIMAN :</strong></td>
            <td style="text-align: right; border: 1px solid black; vertical-align: center;" colspan="7"
                rowspan="2">
                {{ $category_ppb->date_send }}</td>
        </tr>

        <tr>
            <td></td>
        </tr>
        <tr>
            <td style=" ; border: 1px solid black ; font-size: 12px; vertical-align: center;" colspan="15"
                rowspan="2"><strong>PEMASOK YANG
                    DIUSULKAN :</strong></td>
            <td style="text-align: right; border: 1px solid black; vertical-align: center;" colspan="7"
                rowspan="2">
                {{ $category_ppb->proposed_supplier }}</td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

        <tr>
            <td colspan="22" style="border-right: 1px solid black; font-size: 14px;">Demikian drafting pengajuan dana
                ini saya
                Sampaikan, atas bantuan dan kerjasamanya saya
                ucapkan terima kasih.</td>
        </tr>

        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="border-right: 1px solid black;"></th>
        </tr>

        <tr>
            <td></td>
            <td style="border: 1px solid black ; text-align: center" colspan="8">Diajukan Oleh</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black ; text-align: center" colspan="6">Diperiksa Dan Disetujui Oleh,</td>
            <td style="border-right: 1px solid black;"></td>
        </tr>

        <tr>
            <td></td>
            <td rowspan="5" colspan="8" style="border-left: 1px solid black; border-right: 1px solid black;">
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td rowspan="5" colspan="6" style="border-left: 1px solid black; border-right: 1px solid black;">
            </td>
            <td style="border-right: 1px solid black;"></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-right: 1px solid black;"></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-right: 1px solid black;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-right: 1px solid black;"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-right: 1px solid black;"></td>
        </tr>

        <tr>
            <td></td>
            <td style="border: 1px solid black;" colspan="2">Nama</td>
            <td style="border: 1px solid black; text-align: left;" colspan="6">{{ $category_ppb->whosubmit->name }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black;" colspan="2">..Nama Atasan..</td>
            <td style="border: 1px solid black; text-align: left;" colspan="4">{{ $category_ppb->bod->name }}</td>
            <td style="border-right: 1px solid black;"></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-right: 1px solid black;"></td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;border-right: 1px solid black;"></td>
        </tr>

    </tbody>

</table>
