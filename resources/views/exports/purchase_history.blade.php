<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th style="border: 1px solid black"><strong>No.</strong></th>
            <th style="border: 1px solid black"><strong>Project Code</strong></th>
            <th style="border: 1px solid black"><strong>No. PR</strong></th>
            <th style="border: 1px solid black"><strong>Date Input PR</strong></th>
            <th style="border: 1px solid black"><strong>Date PR Approved</strong></th>
            <th style="border: 1px solid black"><strong>No. PO</strong></th>
            <th style="border: 1px solid black"><strong>Date Input PO</strong></th>
            <th style="border: 1px solid black"><strong>Date PO Approved</strong></th>
            <th style="border: 1px solid black"><strong>No. PD</strong></th>
            <th style="border: 1px solid black"><strong>Date Input Pengajuan Dana</strong></th>
            <th style="border: 1px solid black"><strong>Date Pengajuan Dana Approved</strong></th>
            <th style="border: 1px solid black"><strong>Vendor</strong></th>
            <th style="border: 1px solid black"><strong>Items</strong></th>
            <th style="border: 1px solid black"><strong>Qty</strong></th>
            <th style="border: 1px solid black"><strong>Grand Total</strong></th>
            <th style="border: 1px solid black"><strong>Status</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
        $x = 1;
        @endphp
        @foreach ($category_ppb as $pb)
        @php
            $date_sig = App\Models\POSignature::where('ppb_id', $pb->id)->first();
            $invoicing = App\Models\Invoicing::where('ppb_id', $pb->id)->get();
            foreach ($invoicing as $var_pd) {
               $pd = $var_pd;
            }
        @endphp

                <tr>
                    <td style="border: 1px solid black">{{ $x++ }}</td>
                    <td style="border: 1px solid black">{{ $pb->purpose->name }}</td>
                    <td style="border: 1px solid black">{{ $pb->code_pengajuan }} </td>
                    <td style="border: 1px solid black">{{ $pb->created_at }}</td>
                    <td style="border: 1px solid black">{{ $pb->approved_at }}</td>

                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                        <ul>
                            <li>{{ $po->code_po }}</li>
                        </ul>
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                        <ul>
                            <li>{{ $po->created_at }}</li>
                        </ul>
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                            @foreach ($invoicing as $date_sig)
                            <ul>
                                <li>{{ $date_sig->approved_at }}</li>
                            </ul>
                            @endforeach
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                            @foreach ($invoicing as $pd)
                            <ul>
                                <li> {{ $pd->code_pd }}</li>
                            </ul>
                            @endforeach
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                            @foreach ($invoicing as $pd)
                            <ul>
                                <li>{{ $pd->created_at }}</li>
                            </ul>
                            @endforeach
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                            @foreach ($invoicing as $pd)
                            <ul>
                                <li>{{ $pd->approved_at }}</li>
                            </ul>
                            @endforeach
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                        @foreach ($pb->quot as $po)
                            <ul>
                                <li>
                                    @if(empty($po->vendorable->nama))
                                        -
                                    @else
                                    <strong>-</strong> {{ $po->vendorable->nama }}
                                    @endif
                                </li>
                            </ul>
                        @endforeach
                    </td>
                    <td style="border: 1px solid black">
                    @foreach ($pb->quot as $po)
                        @foreach ($po->itempo as $i)
                        <ul>
                            <li><strong>-</strong> {{ $i->item }}</li>
                        </ul>
                        @endforeach
                    @endforeach
                    </td>
                    <td style="border: 1px solid black">
                    @foreach ($pb->quot as $po)
                        @foreach ($po->itempo as $i)
                        <ul>
                            <li><strong>-</strong> {{ $i->qty }}</li>
                        </ul>
                        @endforeach
                    @endforeach
                    </td>
                    <td style="border: 1px solid black">
                    @foreach ($pb->quot as $po)
                        @foreach ($po->itempo as $i)
                        <ul>
                            <li><strong>-</strong> {{ number_format($i->grand_total) }}</li>
                        </ul>
                        @endforeach
                    @endforeach

                    </td>
                    <td style="border: 1px solid black">
                        {{ $pb->status }}
                    </td>
                </tr>
        @endforeach
    </tbody>
</table>
