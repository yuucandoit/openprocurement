<table>

    <thead>

        <tr>
            <td></td>
            <td></td>
            <td style="vertical-align: center;
                font-size: 14;
                font-weight: bold;
                background-color: #ffffff;"
                rowspan="2">
                PT.SOLUSI INTEK INDONESIA
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="vertical-align: center;
                text-align: center;
                "rowspan="6">
                </td>
            <td style="vertical-align: center;
                text-align: center;
                font-size: 30;
                background-color: #29465B;
                font-weight: bold;
                 color: #ffffff"
                rowspan="3" colspan="6">PURCHASE ORDER</td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
            <td rowspan="3"></td>
        </tr>

        <tr>
            <td></td>
            <td rowspan="2">
                <p>
                    Head Office : Jl Cikunir Raya No.689 Jakamulya, Bekasi Selatan, Telp. 021-89454790 </p>
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
            <td style="text-align: center;
                 background-color: #29465B;
                 color: #ffffff;
                 border: 1px solid black;
                 font-size: 14;"
                 colspan="2">
                 <strong>Date</strong>
             </td>

             <td style="text-align: center;
                  background-color: #29465B;
                  color: #ffffff;
                  border: 1px solid black;
                  font-size: 14;"
                  colspan="2">
                  <strong>No PO</strong>
            </td>

             <td style="text-align: center;
                 background-color: #29465B;
                 color: #ffffff;
                 border: 1px solid black;
                 font-size: 14;"
                 colspan="2">
                 <strong>Quot No</strong>
             </td>

            <td></td>
        </tr>

        <tr>
            <td></td>
              @php
            use Carbon\Carbon;
            $date=Carbon::parse($category_po->created_at)->format('d/m/Y');
            @endphp
            <td style="text-align: center;
                border: 1px solid black;
                font-size: 14;"
                rowspan="1" colspan="2">{{ $date }}</td>

            <td style="text-align: center;
                border: 1px solid black;
                font-size: 14;"
                rowspan="1" colspan="2">{{ $category_po->id }}/PO/SII/{{ $month }}/{{ $year }}</td>

            <td style="text-align: center;
                border: 1px solid black;
                font-size: 14;"
                rowspan="1" colspan="2">Q{{ $year2 }}{{ $month }}{{ $day }}{{ $id->id }}</td>

            <td></td>
        </tr>

       <tr>
            <td colspan="2"></td>
            <td></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td colspan="2"></td>
              <td></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td colspan="2"></td>
              <td></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td colspan="5"></td>
            <td style="background-color: #29465B;
                color: #ffffff;
                text-align: center;
                font-size: 12;
                font-weight: bold;
                border: 2px solid black" colspan="4">Send To :</td>
        </tr>

        <tr>
            <td></td>
            <td style="background-color: #29465B;
                color: #ffffff;
                font-size: 14;
                text-align: center;
                font-weight: bold;
                border: 2px solid black" colspan="2">Vendor</td>

            <td colspan="2"></td>

            <td style="border: 2px solid black;
                vertical-align: center;
                text-align: center;
                font-size: 14;"
                colspan="4" rowspan="2">{{ $category_po->send_to }}</td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12;
                border-right: 2px solid black;
                border-left: 2px solid black;">
                <strong>Name</strong>
            </td>

            <td style="border-right: 2px solid black;"></td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12;
                border-right: 2px solid black;
                border-left: 2px solid black;">
                <strong>Company</strong>
            </td>

            <td style="border-right: 2px solid black;"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2">
            </td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12;
                border-right: 2px solid black;
                border-left: 2px solid black;">
                <strong>Adress</strong>
            </td>

            <td style="border-right: 2px solid black;"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12;
                border-right: 2px solid black;
                border-left: 2px solid black;">
                <strong>Phone</strong>
            </td>

            <td style="border-right:
                2px solid black;">
                </td>

            <td colspan="2"></td>

            <td style="background-color: #29465B;
                color: #ffffff;
                text-align: center;
                font-size: 12;
                font-weight: bold;
                border: 2px solid black"
                colspan="4">Alamat :</td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 12;
                border-right: 2px solid black;
                border-left: 2px solid left;
                border-bottom: 2px solid black;">
                <strong>Email Adress</strong>
            </td>

            <td style="border-bottom: 2px solid black;
                border-right: 2px solid black;">
            </td>

            <td colspan="2"></td>
            <td style="font-size: 14;
                 vertical-align: center;
                 border: 2px solid black;
                 text-align: center;"
                 rowspan="2" colspan="4"><p>{{ $category_po->address }}</p></td>
        </tr>

        <tr>
            <td colspan="5"></td>
            <td colspan="4"></td>
        </tr>

        <tr>
            <td colspan="9"></td>
            <td></td>
        </tr>


        <tr>
            <td></td>
            <td style="font-size: 12; font-weight: bold;" colspan="8">Please find below quotation for your inquiries :</td>
        </tr>

    </thead>


    {{-- @php
            dd($quotation);
        @endphp --}}
    <tbody>

        <tr>
            <td></td>
            <td style="background-color: #29465B;
                color: #ffffff; font-weight: bold;
                font-size: 14; text-align: center;
                border: 1px solid black;">No</td>

            <td style="background-color: #29465B;
                color: #ffffff;
                font-weight: bold;
                font-size: 14;
                text-align: center;
                border: 1px solid black;">Item</td>

            <td style="background-color: #29465B;
                 color: #ffffff;
                 font-weight: bold;
                 font-size: 14;
                 text-align: center;
                 border: 1px solid black;">Qty</td>

            <td style="background-color: #29465B;
                color: #ffffff;
                font-weight: bold;
                font-size: 14;
                text-align: center;
                border: 1px solid black;">Unit</td>

            <td style="background-color: #29465B;
                color: #ffffff;
                font-weight: bold;
                font-size: 14;
                text-align: center;
                border: 1px solid black;"
                colspan="2">Unit Price (Rp)</td>

            <td style="background-color: #29465B;
                color: #ffffff;
                font-weight: bold;
                font-size: 14;
                text-align: center;
                border: 1px solid black;" colspan="2">Amount (Rp)</td>
        </tr>

        @php
            $no = 1;
            $data = 0;
            $grandTotal = 0;
        @endphp

        @foreach ($category_q as $q)
        @php
            $convertedItem = strip_tags(str_replace(["\r", "\n"], '', $q->item));
            $itemPO = App\Models\ItemPO::where('item', 'LIKE', "%" . $convertedItem . "%")->first();

            if(!empty($itemPO->total)){
            $grandTotal += $itemPO->total;
            }

        @endphp
           <tr>
                <td></td>
                <td style="border: 3px solid black; font-size: 14; text-align: center;">{{ $no++ }}</td>
                <td style="border: 3px solid black; font-size: 14;">{{ $q->item }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: center;">{{ $q->qty }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: center;">{{ $q->kategori }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: right;" colspan="2">Rp.{{ number_format($itemPO->unit_price ?? 0) }}</td>
                <td style="border: 3px solid black; font-size: 14; text-align: right;" colspan="2">Rp.{{ number_format($itemPO->total ?? 0) }}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; font-size: 14; font-weight: 14;" colspan="2"><strong>DPP</strong></td>

            <td style=" text-align: right; border: 1px solid black; font-size: 14; font-weight: 14;" colspan="2">RP.{{ number_format( $d->total )}}</td>
            @elseif ($category_po->matauang == "USD")
            <td style=" text-align: right; border: 1px solid black; font-size: 14; font-weight: 14;" colspan="2">$ {{ number_format($d->total) }}</td>
            @endif
            @endforeach
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border: 1px solid black; font-size: 14; font-weight: bold;" colspan="2"><strong>Total</strong></td>
            <td style="text-align: right; border: 1px solid black; font-size: 14; font-weight: bold" colspan="2">{{ number_format($grandTotal) }}</td>
        </tr>

        <tr>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14; font-weight: bold; font-family: calibri(body);" colspan="2">Term and Payment Detail</td>
            <td></td>
            <td></td>
            <td style="text-align: center; font-weight: bold; font-size: 14; font-family: calibri (body);" colspan="4"><strong>Thank you for your business!</strong></td>
        </tr>

        <tr>
            <td></td>
            {{-- <td style="font-size: 14; mso-data-placement:same-cell;">{{ preg_replace("/\r|\n/","<br style=\"mso-data-placement:same-cell;\" />",)$cpo->term->term_condition }}</td> --}}
            <td style="font-size: 14;">{!!  nl2br($cpo->term->term_condition) !!}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14; text-align: center;" colspan="2"> </td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14"></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <td style="font-size: 14"></td>
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

    </tbody>

</table>
