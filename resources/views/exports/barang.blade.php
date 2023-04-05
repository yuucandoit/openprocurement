<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="background-color:#ea772b;"><strong>No</strong></td>
            <td style="background-color:#ea772b;"><strong>Item Name</strong></td>
            <td style="background-color:#ea772b;"><strong>Model Type</strong></td>
            <td style="background-color:#ea772b;"><strong>Qty</strong></td>
            <td style="background-color:#ea772b;"><strong>Unit</strong></td>
            <td style="background-color:#ea772b;"><strong>Price</strong></td>
            <td style="background-color:#ea772b;"><strong>Total Amount</strong></td>
            <td style="background-color:#ea772b;"><strong>Link</strong></td>
            <td style="background-color:#ea772b;"><strong>Desc</strong></td>
            <td style="background-color:#ea772b;"><strong>Image</strong></td>
            <td style="background-color:#ea772b;"><strong>Project</strong></td>
            <td style="background-color:#ea772b;"><strong>Order Date</strong></td>
            <td style="background-color:#ea772b;"><strong>Requester</strong></td>
            <td style="background-color:#ea772b;"><strong>Purchaser</strong></td>
            <td style="background-color:#ea772b;"><strong>Tracking Num / Url</strong></td>
            <td style="background-color:#ea772b;"><strong>Status</strong></td>
            <td style="background-color:#ea772b;"><strong>Delivery Status</strong></td>
        </tr>
    </thead>
    <tbody>
        @php
        $x = 1;
        @endphp
        @foreach ($category_ppb as $pb)
             @foreach ($pb->quot as $po)
                @foreach ($po->itempo as $i)

                <tr>
                    <td style="border: 1px solid black">{{ $x++ }}</td>
                    <td style="border: 1px solid black">{{ $i->item }} </td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{ $i->qty }}</td>
                    <td style="border: 1px solid black">{{ $i->kategori }} </td>
                    <td style="border: 1px solid black">{{ $i->unit_price }} </td>
                    <td style="border: 1px solid black">{{ $i->grand_total }}</td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{ $pb->desc }}</td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{ $pb->purpose->name }}</td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{ $pb->whosubmit->name }}</td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                </tr>


                @endforeach
             @endforeach
        @endforeach
    </tbody>
</table>
