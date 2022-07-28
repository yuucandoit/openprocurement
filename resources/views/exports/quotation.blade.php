<table>

    <thead>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="text-align: center" rowspan="7"></td>
            <td rowspan="2">
                 <h1><strong>PT SOLUSI INTEK INDONESIA</strong></h1>
                 <p>Head Office : Emerald Commercial Blok UB No. 50 Summarecon Bekasi Telp. 021-89454790 </p>
            </td>
            <td rowspan="4"></td>
            <td rowspan="4"></td>
            <td style="margin-bottom: 50%; font-size:15px; text-align:center; height:40px" rowspan="1" colspan="2"><h1><strong>QUOTATION</strong></h1></td>
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
            <td><strong>{{ $category_q->company_name }}</strong></td>
            <td></td>
            <td></td>
            <td style="font-weight: bolder; text-align:right">Date</td>
            @php
                use Carbon\Carbon;
                $date = Carbon::parse($category_q->created_at)->format('d/m/Y');
            @endphp
            <td>{{ $date }}22</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td rowspan="1">
                <p>{{ $category_q->address }}</p>
            </td>
            <td></td>
            <td></td>
            <td style="font-weight: bolder;text-align:right">Quotation#</td>
            <td> QT/{{ $category_q->id }}/SII/{{ $month }}/{{ $year }}</td>
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
            <td style="border: 1px solid black; background-color:#213A5C; text-align:center; color:white; font-weight: bolder;">No</td>
            <td style="border: 1px solid black; background-color:#213A5C; text-align:center; color:white; font-weight: bolder;">Type</td>
            <td style="border: 1px solid black; background-color:#213A5C; text-align:center; color:white; font-weight: bolder;">Qty</td>
            <td style="border: 1px solid black; background-color:#213A5C; text-align:center; color:white; font-weight: bolder;">Unit</td>
            <td style="border: 1px solid black; background-color:#213A5C; text-align:center; color:white; font-weight: bolder;">Unit Price (Rp)</td>
            <td style="border: 1px solid black; background-color:#213A5C; text-align:center; color:white; font-weight: bolder;">Amount (Rp)</td>
        </tr>

        @php
            $no = 1;
            $subtotal = 0;
        @endphp
        @foreach ($q_quotation as $quotation)
        @php
            $subtotal += $quotation->amount;
        @endphp
            <tr>
                <td></td>
                <td style="border: 5px solid black">{{ $no++ }}</td>
                <td style="border: 5px solid black">{{ $quotation->type }}</td>
                <td style="border: 5px solid black">{{ $quotation->qty }}</td>
                <td style="border: 5px solid black">{{ $quotation->unit }}</td>
                <td style="border: 5px solid black">{{ $quotation->unitprice }}</td>
                <td style="border: 5px solid black">{{ $quotation->amount }}</td>
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

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black"><strong>Subtotal</strong></td>
            <td style="border: 1px solid black">{{$subtotal}}</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black"><strong>PPN</strong></td>
            <td style="text-align: right ; border: 1px solid black">10%</td>
        </tr>

        <tr>
            <td></td>
            <td colspan="2"><strong> Term and Payment Detail </strong></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black"><strong>Total</strong></td>
            @php
                $total=$subtotal*1.1;
            @endphp
            <td style="border: 1px solid black">{{$total}}</td>
        </tr>

        <tr>
            <td></td>
            <td>1</td>
            <td> Warranty : 12 months </td>
        </tr>

        <tr>
            <td></td>
            <td>2</td>
            <td> Payment : 100% after BAST </td>
        </tr>

        <tr>
            <td></td>
            <td>3</td>
            <td> Include One Training Session </td>
        </tr>

        <tr>
            <td></td>
            <td>4</td>
            <td>Price include Tax</td>
        </tr>

        <tr>
            <td></td>
            <td>5</td>
            <td>Assistant for 12 months</td>
        </tr>

        <tr>
            <td></td>
            <td>6</td>
            <td>Maintenance</td>
            <td></td>
            <td></td>
            <td style="text-align: center" colspan="2"><strong>Thank you for your business!</strong></td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> *Preventive Maintenance</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> - On Site Technical assistance </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> - Preventive Maintenance report</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td>* Corrective Maintenance</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> - Fast response on call technical support 7 X 24 </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> - On Site for troubleshoot depending on the issues reported</td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> - Add on configuration (if - needed ) </td>
            <td></td>
            <td></td>
            <td style="text-align: center" colspan="2"><strong>Bayu Nugraha</strong></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td> - Corrective support report </td>
            <td></td>
            <td></td>
            <td style="text-align: center" colspan="2"><strong>General Manager</strong></td>
        </tr>

    </tbody>

</table>
