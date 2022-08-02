<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
     <h1>Detail Dari {{ $data_perusahaan->nama }}</h1>
        <table class="table table-bordered mt-4">
            <tbody>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>{{ $data_perusahaan->nama }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $data_perusahaan->alamat }}</td>
                </tr>
                <tr>
                    <td>Contact Kantor</td>
                    <td>{{ $data_perusahaan->no_telp_kantor }}</td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td><a href="{{ $data_perusahaan->website }}">{{ $data_perusahaan->website }}</a></td>
                </tr>
                <tr>
                    <td>Nama PIC</td>
                    <td>{{ $data_perusahaan->nama_pic }}</td>
                </tr>
                <tr>
                    <td>Contact PIC</td>
                    <td>{{ $data_perusahaan->no_telp_pic }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $data_perusahaan->email }}</td>
                </tr>
                <tr>
                    <td>NPWP Perusahaan</td>
                    <td>{{ $data_perusahaan->npwp_perusahaan }}</td>
                </tr>
                <tr>
                    <td>PKP / Non-PKP</td>
                    <td>{{ $data_perusahaan->Pkp }}</td>
                </tr>
                <tr>
                    <td>NIB</td>
                    <td>{{ $data_perusahaan->nib }}</td>
                </tr>
                <tr>
                    <td>Bidang</td>
                    <td>{{ $data_perusahaan->bidang_usaha }}</td>
                </tr>
                <tr>
                    <td>No Rekening</td>
                    <td>{{ $data_perusahaan->no_rekening }}</td>
                </tr>
                <tr>
                    <td>Bank</td>
                    <td>{{ $data_perusahaan->bank }}</td>
                </tr>
                <tr>
                    <td>Nama Penerima</td>
                    <td>{{ $data_perusahaan->nama_penerima }}</td>
                </tr>
            </tbody>
        </table>

        <a type="reset" class="btn btn-danger" href="{{ url('/menu-perusahaan/') }}">Back</a>
    </section>
@endsection
