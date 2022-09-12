<table>

    <thead>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: center; background-color: #ffffff;"rowspan="6"></td>
            <td style="background-color: #FFFFFF; font-size: 14; font-weight: bold;">
                PT.SOLUSI INTEK INDONESIA
            </td>
            <td style="text-align: center; font-size: 30; background-color: #29465B; font-weight: bold; color: #ffffff" rowspan="3" colspan="6">PURCHASE ORDER</td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
        </tr>

        <tr>
            <td></td>
            <td rowspan="2">
                <p>
                    Head Office : Emerald Commercial Blok UB No. 50 Summarecon Bekasi Telp. 021-89454790 </p>
            </td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td rowspan="3">
                <p>Mkt Office : Jl Tebet Barat dalam raya No. 31, Tebet Barat, Jakarta Selatan, Telp 021-21383852</p>
            </td>
            <td colspan="6"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: center; background-color: #29465B; color: #ffffff; border: 1px solid black; font-size: 14;" colspan="2"><strong>Date</strong></td>
             <td style="text-align: center; background-color: #29465B; color: #ffffff; border: 1px solid black; font-size: 14;" colspan="2"><strong>No PO</strong></td>
             <td style="text-align: center; background-color: #29465B; color: #ffffff; border: 1px solid black; font-size: 14;" colspan="2"><strong>Quot No</strong></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
              @php
            use Carbon\Carbon;
            $date=Carbon::parse($category_po->created_at)->format('d/m/Y');
            @endphp
            <td style="text-align: center; border: 1px solid black; font-size: 14;" rowspan="1" colspan="2">{{ $date }}</td>
            <td style="text-align: center; border: 1px solid black; font-size: 14;" rowspan="1" colspan="2">{{ $category_po->id }}/PO/SII/{{ $month }}/{{ $year }}</td>
            <td style="text-align: center; border: 1px solid black; font-size: 14;" rowspan="1" colspan="2">Q{{ $year2 }}{{ $month }}{{ $day }}{{ $category_q->id }}</td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right; font-size: 14;"><strong>To</strong></td>
            <td style="font-size: 14" rowspan="1" colspan="3">{{ $category_po->send_to }}</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right; font-size: 14;"><strong>Alamat</strong></td>
            <td style="font-size: 14" rowspan="1" colspan="3">
                <p>{{ $category_po->address }}</p>
            </td>
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
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="background-color: #29465B; color: #ffffff; font-size: 14; text-align: center;" rowspan="1" colspan="2"><strong>Vendor</strong></td>
            <td style="background-color: #29465B"></td>
            <td style="background-color: #29465B"></td>
            <td style="background-color: #29465B; color: #ffffff; text-align: center; font-size: 14" colspan="4"><strong>Customer</strong></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12;"><strong>Name</strong></td>
            <td></td>
            <td rowspan="5" colspan="2"></td>
            <td style="font-size: 12;"><strong>Name</strong></td>
            <td colspan="3"></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12"><strong>Company Name</strong></td>
            <td></td>
            <td style="font-size: 12"><strong>Company Name</strong></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12"><strong>Adress</strong></td>
            <td></td>
            <td style="font-size: 12"><strong>Adress</strong></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12"><strong>Phone</strong></td>
            <td></td>
            <td style="font-size: 12"><strong>Phone</strong></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12"><strong>Email Adress</strong></td>
            <td></td>
            <td style="font-size: 12"><strong>Email Adress</strong></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12; font-weight: bold;" colspan="6">Please find below quotation for your inquiries :</td>
        </tr>

    </thead>


    {{-- @php
            dd($quotation);
        @endphp --}}
    <tbody>

        <tr>
            <td></td>
            <td style="background-color: #29465B; color: #ffffff; font-weight: bold; font-size: 14; text-align: center; border: 1px solid black;">No</td>
            <td style="background-color: #29465B; color: #ffffff; font-weight: bold; font-size: 14; text-align: center; border: 1px solid black;">Item</td>
            <td style="background-color: #29465B; color: #ffffff; font-weight: bold; font-size: 14; text-align: center; border: 1px solid black;">Qty</td>
            <td style="background-color: #29465B; color: #ffffff; font-weight: bold; font-size: 14; text-align: center; border: 1px solid black;">Unit</td>
            <td style="background-color: #29465B; color: #ffffff; font-weight: bold; font-size: 14; text-align: center; border: 1px solid black;" colspan="2">Unit Price (Rp)</td>
            <td style="background-color: #29465B; color: #ffffff; font-weight: bold; font-size: 14; text-align: center; border: 1px solid black;" colspan="2">Amount (Rp)</td>
        </tr>

        @php
            $no = 1;
            $data = 0;
        @endphp
        @foreach ($purchase_order as $po)
            @php
                $data+=$po->amount;
            @endphp
            <tr>
                <td></td>
                <td style="border: 1px solid black; font-size: 14;">{{ $no++ }}</td>
                <td style="border: 1px solid black; font-size: 14;">{{ $po->keterangan }}</td>
                <td style="border: 1px solid black; font-size: 14;">{{ $po->qty }}</td>
                <td style="border: 1px solid black; font-size: 14;">{{ $po->unit }}</td>
                <td style="border: 1px solid black; font-size: 14;">{{ $po->unit_price }}</td>
                <td style="border: 1px solid black; font-size: 14;">{{ $po->amount }}</td>
            </tr>
        @endforeach


           <tr>
                <td></td>
                <td style="border: 3px solid black; font-size: 14; text-align: center;">{{ $no++ }}</td>
                <td style="border: 3px solid black; font-size: 14;">{{ $category_q->item }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: center;">{{ $category_q->qty }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: center;">{{ $category_q->kategori }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: right;" colspan="2">{{ $category_q->unit_price }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: right;" colspan="2">{{ $category_q->total }}</td>
            </tr>

            {{-- <tr>
                <td></td>
                <td>3</td>
                <td>TEst</td>
                <td>3</td>
                <td>coba-coba</td>
                <td>2000</td>
                <td>6000</td>
            </tr> --}}

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; font-size: 14; font-weight: 14;" colspan="2"><strong>DPP</strong></td>
            <td style=" text-align: right; border: 1px solid black; font-size: 14; font-weight: 14;" colspan="2"></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; font-size: 14; font-weight: bold;" colspan="2"><strong>PPN 10%</strong></td>
            <td style="text-align: right ; border: 1px solid black; font-size: 14; font-weight: bold;" colspan="2"></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; font-size: 14; font-weight: bold;" colspan="2"><strong>Total</strong></td>
            <td style="text-align: right; border: 1px solid black; font-size: 14; font-weight: bold" colspan="2">{{$data}}</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14; font-weight: bold; font-family: calibri(body);" colspan="2">Term and Payment Detail</td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14">1. 50% Deposit in advance once confirm the order</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center; font-weight: bold; font-size: 14; font-family: calibri (body);" colspan="4"><strong>Thank you for your business!</strong></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14; text-align: center;" colspan="2">The Rest 50% payment before Shipping  </td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14">2. Delivery Time : Ex-Work Fakctory</td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14">3. Delivery Time : about 4-6 weeks after receiving payment</td>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center; font-size: 14; font-weight: bold; text-decoration: underline; font-family: calibri (body);" colspan="4"> <ins>Victor</ins></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center; font-size: 14; font-weight: bold;" colspan="4">Director</td>
        </tr>

    </tbody>

</table>
