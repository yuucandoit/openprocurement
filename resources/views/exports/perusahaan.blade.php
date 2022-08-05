<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>Nama Perusahaan</strong></td>
            <td style="border: 1px solid black"><strong>Alamat</strong></td>
            <td style="border: 1px solid black"><strong>Contact Kantor</strong></td>
            <td style="border: 1px solid black"><strong>Website</strong></td>
            <td style="border: 1px solid black"><strong>Nama PIC</strong></td>
            <td style="border: 1px solid black"><strong>Contact PIC</strong></td>
            <td style="border: 1px solid black"><strong>Email</strong></td>
            <td style="border: 1px solid black"><strong>NPWP PT</strong></td>
            <td style="border: 1px solid black"><strong>PKP - Non-PKP</strong></td>
            <td style="border: 1px solid black"><strong>NIB</strong></td>
            <td style="border: 1px solid black"><strong>Bidang</strong></td>
            <td style="border: 1px solid black"><strong>No Rekening</strong></td>
            <td style="border: 1px solid black"><strong>Bank</strong></td>
            <td style="border: 1px solid black"><strong>Cabang Bank</strong></td>
            <td style="border: 1px solid black"><strong>Nama Penerima</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($category_pt as $pt)
        <tr>
            <td style="border: 1px solid black">{{ $pt->nama }}</td>
            <td style="border: 1px solid black">{{ $pt->alamat }}</td>
            <td style="border: 1px solid black">{{ $pt->no_telp_kantor }} </td>
            <td style="border: 1px solid black">{{ $pt->website }} </td>
            <td style="border: 1px solid black">{{ $pt->nama_pic }} </td>
            <td style="border: 1px solid black">{{ $pt->no_telp_pic }} </td>
            <td style="border: 1px solid black">{{ $pt->email }} </td>
            <td style="border: 1px solid black">{{ $pt->npwp_perusahaan }} </td>
            <td style="border: 1px solid black">{{ $pt->Pkp }} </td>
            <td style="border: 1px solid black">{{ $pt->nib }} </td>
            <td style="border: 1px solid black">{{ $pt->bidang_usaha }} </td>
            <td style="border: 1px solid black">{{ $pt->no_rekening }} </td>
            <td style="border: 1px solid black">{{ $pt->bank }} </td>
            <td style="border: 1px solid black">{{ $pt->cabang_bank }} </td>
            <td style="border: 1px solid black">{{ $pt->nama_penerima }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
