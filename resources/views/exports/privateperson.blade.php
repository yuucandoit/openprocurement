<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>Nama Lengkap</strong></td>
            <td style="border: 1px solid black"><strong>Alamat</strong></td>
            <td style="border: 1px solid black"><strong>NIK</strong></td>
            <td style="border: 1px solid black"><strong>NPWP</strong></td>
            <td style="border: 1px solid black"><strong>PKP</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($category_pp as $pp)
        <tr>
            <td style="border: 1px solid black">{{ $pp->nama }}</td>
            <td style="border: 1px solid black">{{ $pp->alamat }}</td>
            <td style="border: 1px solid black">{{ $pp->nik }} </td>
            <td style="border: 1px solid black">{{ $pp->npwp_pp }} </td>
            <td style="border: 1px solid black">{{ $pp->pkp }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
