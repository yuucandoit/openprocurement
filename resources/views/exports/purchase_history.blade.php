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
    @php
        $x = 1;
        @endphp
        @foreach ($po as $p)
        @php
         $date_sig = App\Models\POSignature::where('ppb_id', $p->ppb_id)->first();
         $invoicing = App\Models\Invoicing::where('ppb_id', $p->ppb_id)->get();
         foreach ($invoicing as $var_pd) {
            $pd = $var_pd;
         }
         $po2 = App\Models\CategoryPO::find($p->id);
        @endphp
         @foreach ($p->itempo as $i)
          @foreach ($invoicing as $pd)
            <tbody>
                <tr>
                    <td style="border: 1px solid black">{{ $x++ }}</td>
                    <td style="border: 1px solid black">
                        @if($p->ppb->id == $p->ppb_id)
                        {{ $p->ppb->purpose->name }}
                        @else

                        @endif
                    </td>
                    <td style="border: 1px solid black">
                        @if($p->ppb->id == $p->ppb_id)
                        {{ $p->ppb->code_pengajuan }}
                        @else

                        @endif
                    </td>
                    <td style="border: 1px solid black">
                        @if($p->ppb->id == $p->ppb_id)
                        {{ $p->ppb->created_at }}
                        @else

                        @endif
                    </td>
                    <td style="border: 1px solid black">
                        @if($p->ppb->id == $p->ppb_id)
                        {{ $p->ppb->approved_at }}
                        @else

                        @endif
                    </td>
                    <td style="border: 1px solid black">
                        {{-- @foreach ($pb->quot as $po) --}}
                        {{ $p->code_po }}
                        {{-- @endforeach --}}
                    </td>
                    <td style="border: 1px solid black">
                       {{ $p->created_at }}
                    </td>
                    <td style="border: 1px solid black">
                        {{ $pd->approved_at }}
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
                        {{-- @dd($p) --}}
                        @if(empty($p->vendorable_type))
                        -
                        @else
                            @if(empty($p->vendorable))
                                -
                            @else
                            {{ $p->vendorable->nama }}
                            @endif
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
            </tbody>
            @endforeach
        @endforeach
    @endforeach
</table>
