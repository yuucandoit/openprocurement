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

        @foreach ($ppb_id as $ppb)
            @php
                $pos = $ppb->quot;
                $hasPO = $pos->isNotEmpty();
            @endphp

            @if ($hasPO)
                @foreach ($pos as $p)
                    @php
                        $date_sig = App\Models\POSignature::where('ppb_id', $p->ppb_id)->first();
                        $invoicing = App\Models\Invoicing::where('ppb_id', $p->ppb_id)->get();
                        foreach ($invoicing as $var_pd) {
                            $pd = $var_pd;
                        }
                        $po2 = App\Models\CategoryPO::find($p->id);
                        $ppbid = App\Models\CategoryPengajuanPembelian::get();
                    @endphp

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
                                {{ $pd->code_pd }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $pd->created_at }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $pd->approved_at }}
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
                                {{ number_format($i->grand_total) }}
                            </td>
                            <td style="border: 1px solid black">
                                {{ $p->ppb->status }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endif

            <tr>
                <td style="border: 1px solid black">{{ $x++ }}</td>
                <td style="border: 1px solid black">
                    {{ $ppb->purpose->name }}
                </td>
                <td style="border: 1px solid black">
                    {{ $ppb->code_pengajuan }}
                </td>
                <td style="border: 1px solid black">
                    {{ $ppb->created_at }}
                </td>
                <td style="border: 1px solid black">
                    {{ $ppb->approved_at }}
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    -
                </td>
                <td style="border: 1px solid black">
                    {{ $ppb->status }}
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
