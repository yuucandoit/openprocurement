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
        <tr>
            <td style="border: 1px solid black">{{ $category_dv->nama }}</td>
            <td style="border: 1px solid black">{{ $category_dv->no_telp }}</td>
            <td style="border: 1px solid black">{{ $category_dv->alamat }} </td>
            <td style="border: 1px solid black">{{ $category_dv->email }} </td>
            <td style="border: 1px solid black">{{ $dv->npwp }}</td>
            <td style="border: 1px solid black">{{ $dv->Pkp }}</td>
            <td style="border: 1px solid black">{{ $dv->jenis_usaha}}</td>
        </tr>
    </tbody>
</table>
