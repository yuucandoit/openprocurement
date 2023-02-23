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
        <td>PPN</td>
        <td>MataUang</td>
        <td>Total</td>
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
                @if(empty($p->ppb->ppn))
                0
                @else
                {{ $p->ppb->ppn }}
                @endif
            </td>
            <td>
                @if(empty($p->ppb->matauang))
                
                @else
                {{ $p->ppb->matauang }}
                @endif
            </td>
            <td>
                @if(empty($p->total))
                0
                @else
                {{ $p->total }}
                @endif
            </td>
        </tr>
        </tbody>
    @endforeach

</table>
