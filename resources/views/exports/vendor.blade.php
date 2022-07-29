<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>Nama Vendor</strong></td>
            <td style="border: 1px solid black"><strong>No Telpon</strong></td>
            <td style="border: 1px solid black"><strong>Alamat</strong></td>
            <td style="border: 1px solid black"><strong>Email</strong></td>
            <td style="border: 1px solid black"><strong>NPWP</strong></td>
            <td style="border: 1px solid black"><strong>PKP</strong></td>
            <td style="border: 1px solid black"><strong>Jenis Usaha</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembelian_barang as $pb)
        <tr>
            <td style="border: 1px solid black">{{ $pb->created_at }}</td>
            <td style="border: 1px solid black">{{ $pb->rev }}</td>
            <td style="border: 1px solid black">{{ $pb->subject }} </td>
            <td style="border: 1px solid black">{{ $pb->nama }} </td>
            <td style="border: 1px solid black">{{ $pb->lokasi }}</td>
            <td style="border: 1px solid black">{{ $pb->jangka_waktu }}</td>
            <td style="border: 1px solid black">{{ $pb->updated_at->format('D/m/Y | h:i') }}</td>
            <td style="border: 1px solid black">{{ $pb->dana_diperlukan }}</td>
            <td style="border: 1px solid black">{{ $pb->no_rek }}</td>
            <td style="border: 1px solid black">{{ $loop->iteration }}</td>
            <td style="border: 1px solid black">{{ $pb->item }}</td>
            <td style="border: 1px solid black">{{ $pb->jumlah_quantity }}</td>
            <td style="border: 1px solid black">{{ $pb->quantity }}</td>
            <td style="border: 1px solid black">{{ $pb->harga_satuan }}</td>
            <td style="border: 1px solid black">{{ $pb->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
