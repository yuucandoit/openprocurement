<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>Nama Lengkap</strong></td>
            <td style="border: 1px solid black"><strong>Alamat</strong></td>
            <td style="border: 1px solid black"><strong>Email</strong></td>
            <td style="border: 1px solid black"><strong>NIK</strong></td>
            <td style="border: 1px solid black"><strong>NPWP</strong></td>
            <td style="border: 1px solid black"><strong>PKP</strong></td>
            <td style="border: 1px solid black"><strong>Contact</strong></td>
            <td style="border: 1px solid black"><strong>No Rekening</strong></td>
            <td style="border: 1px solid black"><strong>Bank</strong></td>
            <td style="border: 1px solid black"><strong>Bank Branch</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($category_pp as $pp)
        <tr>
            <td style="border: 1px solid black">{{ $pp->nama ?? '-' }}</td>
            <td style="border: 1px solid black">{{ $pp->alamat ?? '-' }}</td>
            <td style="border: 1px solid black">{{ $pp->email ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->nik ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->npwp_pp ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->pkp ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->contact ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->no_rekening ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->bank ?? '-' }} </td>
            <td style="border: 1px solid black">{{ $pp->cabang_bank ?? '-' }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
