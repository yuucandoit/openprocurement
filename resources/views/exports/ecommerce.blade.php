<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>Nama Toko Ecommerce</strong></td>
            <td style="border: 1px solid black"><strong>Link Toko</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($category_ec as $ec)
        <tr>
            <td style="border: 1px solid black">{{ $ec->nama }}</td>
            <td style="border: 1px solid black">{{ $ec->link }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
