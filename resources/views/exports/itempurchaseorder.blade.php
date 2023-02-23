<style>
    #product-stock {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #product-stock td, #product-stock th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #product-stock tr:nth-child(even){background-color: #f2f2f2;}

    #product-stock tr:hover {background-color: #ddd;}

    #product-stock th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="product-stock" width="100%">
    <thead>
    <tr>
        <td>ID</td>
        <td>Item</td>
        <td>Category</td>
        <td>Qty</td>
        <td>Harga</td>
        <td>Total</td>
        <td>Discount</td>
        <td>DPP</td>
        <td>Ongkir</td>
        <td>Admin Fee</td>
        <td>PPN</td>
        <td>MataUang</td>
        <td>GrandTotal</td>
    </tr>
    </thead>
    @foreach($product_stock as $p)
        <tbody>
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->item }}</td>
            <td>{{ $p->kategori }}</td>
            <td>{{ $p->qty }}</td>
            <td>
                @if(empty($p->unit_price))
                0
                @else
                {{ $p->unit_price }}
                @endif
            </td>
            <td>
                {{-- @dd($p->total) --}}
                @if(empty($p->total))
                0
                @else
                {{ $p->total }}
                @endif
            </td>
            <td>
                @if(empty($p->discount))
                0
                @else
                {{ $p->discount }}
                @endif
            </td>
            <td>
                @if(empty($p->dpp))
                0
                @else
                {{ $p->dpp }}
                @endif
            </td>
            <td>
                @if(empty($p->ongkir))
                0
                @else
                {{ $p->ongkir }}
                @endif
            </td>
            <td>
                @if(empty($p->admin_fee))
                0
                @else
                {{ $p->admin_fee }}
                @endif
            </td>
            <td>
                @if(empty($p->ppn))
                0
                @else
                {{ $p->ppn }}
                @endif
            </td>
            <td>
                @if(empty($p->matauang))

                @else
                {{ $p->matauang }}
                @endif
            </td>
            <td>
                @if(empty($p->grand_total))
                0
                @else
                {{ $p->grand_total }}
                @endif
            </td>
            {{-- @dd($p) --}}
        </tr>
        </tbody>
    @endforeach

</table>
