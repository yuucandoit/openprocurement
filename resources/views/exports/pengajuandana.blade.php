<table>
    <thead>

        <tr>
            <td></td>
        </tr>

        <tr>
            <th style="border: 1px solid black" colspan="4" rowspan="3"></th>
            <th style="border: 1px solid black ; text-align: center" colspan="11" rowspan="3">
                <strong>FORM PENGAJUAN DANA</strong>
            </th>
            <th style="border: 1px solid black ">Date</th>
            @php
                use Carbon\Carbon;
                $date = Carbon::parse($category_pd->created_at)->format('d/m/Y');
            @endphp
            <th style="border: 1px solid black" colspan="2">{{ $date }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black">No. Doc</th>
            <th style="border: 1px solid black" colspan="2">PD/{{ $category_pd->id }}/SII/{{ $month }}/{{ $year }}</th>
        </tr>

        <tr>
            <th style="border: 1px solid black">Rev</th>
            <th style="border: 1px solid black" colspan="2"></th>
        </tr>

        <tr>
            <td></td>
        </tr>

    </thead>

    <tbody>
            <tr>
                <th style="border: 1px solid black" colspan="3">Subject</th>
                <th style="border: 1px solid black">:</th>
                <th style="border: 1px solid black" colspan="14">{{ $category_pd->subject }}</th>
            </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="border: 1px solid black" colspan="3">Nama Pemohon</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="14">{{ $category_pd->name }}</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="border: 1px solid black ; text-align:center">1</td>
            <td style="border: 1px solid black" colspan="4">Tujuan</td>
            <td style="border: 1px solid black">:</td>
            <td style="border: 1px solid black" colspan="12">{{ $category_pd->tujuan }}</td>
        </tr>

        <tr>
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
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="2">NO</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="6">Item</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="3">Quantity</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="3">Price</td>
            <td style="text-align: center ; border:1px solid black" rowspan="3" colspan="4">Total</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td colspan="16"></td>
        </tr>

        @php
            $no = 1;
            $total = 0;
        @endphp
        @foreach ($pengajuan_d as $pd)
        @php
            $total += $pd->total;
        @endphp
        <tr>
            <td style="text-align: center ; border: 1px solid black" colspan="2">{{ $no++ }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="6">{{ $pd->item }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">{{ $pd->qty }}</td>
            <td style="text-align: center ; border: 1px solid black" colspan="3">{{ $pd->harga }}</td>
            <td style="text-align: right ; border: 1px solid black" colspan="4">{{ $pd->total}}</td>
        </tr>

        @endforeach

        <tr>
            <td style="text-align: right ; border: 1px solid black ; font-size: 12px" colspan="14" rowspan="2"><strong>Sub Total</strong></td>
            <td style="text-align: right ; border: 1px solid black" colspan="4" rowspan="2">{{$total}}</td>
        </tr>

        <tr>
            <td></td>
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
            <td style="border: 1px solid black ; text-align: center" colspan="12">Diperiksa Dan Disetujui Oleh,</td>    
        </tr>

        <tr>    
            <td style="text-align: right ; border: 1px solid black" colspan="5" rowspan="4"></td>  
            <td></td>
            <td style="text-align: right ; border: 1px solid black" colspan="3" rowspan="4"></td>
            <td style="text-align: right ; border: 1px solid black" colspan="3" rowspan="4"></td>
            <td style="text-align: right ; border: 1px solid black" colspan="3" rowspan="4"></td>
            <td style="text-align: right ; border: 1px solid black" colspan="3" rowspan="4"></td>
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
            <td style="border: 1px solid black" colspan="4">{{ $category_pd->name }}</td>
            <td></td>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="2">Nama dua</td>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="2">Nama dua</td>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="2">Nama dua</td>
            <td style="border: 1px solid black">Nama</td>
            <td style="border: 1px solid black" colspan="2">Nama dua</td>
        </tr>

        <tr>
            <td style="border: 1px solid black">Jabatan</td>
            <td style="border: 1px solid black" colspan="4">JabatanDua</td>
            <td></td>
            <td style="border: 1px solid black">Jabatan</td>
            <td style="border: 1px solid black" colspan="2">Jabatan dua</td>
            <td style="border: 1px solid black">Jabatan</td>
            <td style="border: 1px solid black" colspan="2">Jabatan dua</td>
            <td style="border: 1px solid black">Jabatan</td>
            <td style="border: 1px solid black" colspan="2">Jabatan dua</td>
            <td style="border: 1px solid black">Jabatan</td>
            <td style="border: 1px solid black" colspan="2">Jabatan dua</td>
        </tr>

        <tr>
            <td style="border: 1px solid black">Date</td>
            <td style="border: 1px solid black" colspan="4">Datedua</td>
            <td></td>
            <td style="border: 1px solid black">Date</td>
            <td style="border: 1px solid black" colspan="2">Date dua</td>
            <td style="border: 1px solid black">Date</td>
            <td style="border: 1px solid black" colspan="2">Date dua</td>
            <td style="border: 1px solid black">Date</td>
            <td style="border: 1px solid black" colspan="2">Date dua</td>
            <td style="border: 1px solid black">Date</td>
            <td style="border: 1px solid black" colspan="2">Date dua</td>
        </tr>

    </tbody>

</table>

{{-- <table>
    <tr>
        <td>row satu col satu</td>
        <td>row satu col dua</td>
    </tr>
    <tr>
        <td>row dua col satu</td>
        <td>row dua col dua</td>
    </tr>
</table> --}}
