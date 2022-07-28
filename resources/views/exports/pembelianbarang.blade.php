<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>No Doc</strong></td>
            <td style="border: 1px solid black"><strong>Revisi ke-</strong></td>
            <td style="border: 1px solid black"><strong>Date</strong></td>
            <td style="border: 1px solid black"><strong>Rev</strong></td>
            <td style="border: 1px solid black"><strong>Subject</strong></td>
            <td style="border: 1px solid black"><strong>Nama Pemohon</strong></td>
            <td style="border: 1px solid black"><strong>Lokasi</strong></td>
            <td style="border: 1px solid black"><strong>Jangka Waktu Permohonan</strong></td>
            <td style="border: 1px solid black"><strong>Jam Approve</strong></td>
            <td style="border: 1px solid black"><strong>Dana yang Dibutuhkan</strong></td>
            <td style="border: 1px solid black"><strong>No Rek</strong></td>
            <td style="border: 1px solid black"><strong>No</strong></td>
            <td style="border: 1px solid black"><strong>Item</strong></td>
            <td style="border: 1px solid black"><strong>Jumlah Quantity</strong></td>
            <td style="border: 1px solid black"><strong>Unit Quantity</strong></td>
            <td style="border: 1px solid black"><strong>Harga Satuan</strong></td>
            <td style="border: 1px solid black"><strong>Total Harga</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembelian_barang as $pb)
        <tr>
            <td style="border: 1px solid black"> PB/{{ $pb->id }}/SII/{{ $month }}/{{ $year }} </td>
            <td style="border: 1px solid black"> --- </td>
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