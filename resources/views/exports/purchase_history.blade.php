<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th style="border: 1px solid black"><strong>No.</strong></th>
            <th style="border: 1px solid black"><strong>Project Code</strong></th>
            <th style="border: 1px solid black"><strong>No. PR</strong></th>
            <th style="border: 1px solid black"><strong>Submit Date PR</strong></th>
            <th style="border: 1px solid black"><strong>Date PR Approved</strong></th>
            <th style="border: 1px solid black"><strong>No. PO</strong></th>
            <th style="border: 1px solid black"><strong>Submit Date PO</strong></th>
            <th style="border: 1px solid black"><strong>Date PO Approved</strong></th>
            <th style="border: 1px solid black"><strong>No. PD</strong></th>
            <th style="border: 1px solid black"><strong>Submit Date Pengajuan Dana</strong></th>
            <th style="border: 1px solid black"><strong>Date Pengajuan Dana Approved</strong></th>
            <th style="border: 1px solid black"><strong>Vendor</strong></th>
            <th style="border: 1px solid black"><strong>Items</strong></th>
            <th style="border: 1px solid black"><strong>Qty</strong></th>
            <th style="border: 1px solid black"><strong>Unit Price</strong></th>
            <th style="border: 1px solid black"><strong>Discount</strong></th>
            <th style="border: 1px solid black"><strong>Shipping Cost</strong></th>
            <th style="border: 1px solid black"><strong>Admin Fee</strong></th>
            <th style="border: 1px solid black"><strong>PPN 11%</strong></th>
            <th style="border: 1px solid black"><strong>Grand Total</strong></th>
            <th style="border: 1px solid black"><strong>Status</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
            $x = 1;
        @endphp

        @foreach ($ppb_id as $ppb)
            @php
                // dd($ppb->quot);
                $pos = $ppb->quot;
                $hasPO = $pos->isNotEmpty();
            @endphp
            @if ($hasPO)
                @foreach ($ppb->quot as $p)
                    @php
                        $date_sig = App\Models\POSignature::where('ppb_id', $p->ppb_id)->first();
                        $invoicing = App\Models\Invoicing::where('ppb_id', $p->ppb_id)->get();
                        foreach ($invoicing as $var_pd) {
                            $pd = $var_pd;
                        }
                    @endphp
                    {{-- Foreach Dibawah buat ambil List itemPO --}}
                    @foreach ($p->itempo as $i)
                        <tr>
                            <td style="border: 1px solid black">{{ $x++ }}</td>
                            <td style="border: 1px solid black">
                                {{ $p->ppb->purpose->name }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->ppb->code_pengajuan }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->ppb->created_at }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->ppb->approved_at }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->code_po }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->created_at }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->approved_at }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $pd->code_pd ?? '-' }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $pd->created_at ?? '-' }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $pd->approved_at ?? '-' }}
                            </td>
                            <td style="border: 1px solid black">
                                @if (empty($p->vendorable_type) || empty($p->vendorable))
                                    -
                                @else
                                    {{ $p->vendorable->nama }}
                                @endif
                            </td>
                            <td style="border: 1px solid black">
                                {{ $i->item }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $i->qty }}
                            </td>
                            <td style="border: 1px solid black">
                               {{ $i->matauang }} {{ number_format($i->unit_price) }}
                            </td>
                            <td>
                                {{ $i->matauang }} {{ number_format($i->discount) }}
                            </td>
                            <td>
                                {{ $i->matauang }} {{ number_format($i->ongkir) }}
                            </td>
                            <td>
                                {{ $i->matauang }} {{ number_format($i->admin_fee) }}
                            </td>
                            <td>
                                @if($i->ppn == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>

                            <td style="border: 1px solid black">
                                {{ $i->matauang }} {{ number_format($i->grand_total) }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->ppb->status }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        @endforeach
    </tbody>

</table>
