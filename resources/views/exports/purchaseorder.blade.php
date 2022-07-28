<table>

    <thead>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: center" rowspan="6"></td>
            <td>
                <h1><strong> SOLUSI INTEK INSONESIA </strong></h1>
            </td>
            <td rowspan="3"></td>
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
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: center" rowspan="4" colspan="6" ><strong>PURCHASE ORDER</strong></td>
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
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td>To :</td>
            <td><strong>{{ $category_po->name }}</strong></td>
            <td></td>
            <td></td>
            <td>Date</td>
            @php
            use Carbon\Carbon;
            $date=Carbon::parse($category_po->created_at)->format('d/m/Y');
            @endphp
            <td>{{ $date }}</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td rowspan="1">
                <p>{{ $category_po->address }}</p>
            </td>
            <td></td>
            <td></td>
            <td>No PO</td>
            <td> {{ $category_po->id }}/PO/SII/{{ $month }}/{{ $year }}</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Quot No</td>
            <td> Q{{ $year2 }}{{ $month }}{{ $day }}{{ $category_q->id }}</td>
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
        </tr>

        <tr>
            <td></td>
            <td colspan="6"><strong>Please find below quotation for your inquiries :</strong></td>
        </tr>

    </thead>


    {{-- @php
            dd($quotation);
        @endphp --}}
    <tbody>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="border: 1px solid black">No</td>
            <td style="border: 1px solid black">Detail</td>
            <td style="border: 1px solid black">Qty</td>
            <td style="border: 1px solid black">Unit</td>
            <td style="border: 1px solid black">Unit Price (Rp)</td>
            <td style="border: 1px solid black">Amount (Rp)</td>
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
                <td style="border: 1px solid black">{{ $no++ }}</td>
                <td style="border: 1px solid black">{{ $po->keterangan }}</td>
                <td style="border: 1px solid black">{{ $po->qty }}</td>
                <td style="border: 1px solid black">{{ $po->unit }}</td>
                <td style="border: 1px solid black">{{ $po->unit_price }}</td>
                <td style="border: 1px solid black">{{ $po->amount }}</td>
            </tr>
        @endforeach


        {{-- <tr>
                <td></td>
                <td>2</td>
                <td>TEst</td>
                <td>3</td>
                <td>coba-coba</td>
                <td>2000</td>
                <td>6000</td>
            </tr>

            <tr>
                <td></td>
                <td>3</td>
                <td>TEst</td>
                <td>3</td>
                <td>coba-coba</td>
                <td>2000</td>
                <td>6000</td>
            </tr> --}}

        {{-- <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black"><strong>Subtotal</strong></td>
            <td style="border: 1px solid black">18000</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black"><strong>PPN</strong></td>
            <td style="text-align: right ; border: 1px solid black">10%</td>
        </tr> --}}

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black"><strong>Total</strong></td>
            <td style="border: 1px solid black">{{$data}}</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td colspan="2"><strong> Term and Condition </strong></td>
        </tr>

        <tr>
            <td></td>
            <td>1</td>
            <td> 50% Deposit in advance once confirm the order </td>
            <td></td>
            <td></td>
            <td style="text-align: center" colspan="2"><strong>Thank you for your business!</strong></td>
        </tr>

        <tr>
            <td></td>
            <td>2</td>
            <td> The Rest 50% payment before Shipping </td>
        </tr>

        <tr>
            <td></td>
            <td>3</td>
            <td> Delivery Time : Ex-Work Fakctory </td>
        </tr>

        <tr>
            <td></td>
            <td>4</td>
            <td>Delivery Time : about 4-6 weeks after receiving payment</td>
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
            <td style="text-align: center" colspan="2"><strong>Victor</strong></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center" colspan="2"><strong>Director</strong></td>
        </tr>

    </tbody>

</table>
