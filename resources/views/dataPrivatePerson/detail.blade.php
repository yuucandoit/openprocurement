<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
     <h1>Detail Dari {{ $data_person->nama }}</h1>
        <table class="table table-bordered mt-4">
            <tbody>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>{{ $data_person->nama }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $data_person->alamat }}</td>
                </tr>
                <tr>
                    <td>Contact Kantor</td>
                    <td>{{ $data_person->nik }}</td>
                </tr>
                <tr>
                    <td>NPWP Perusahaan</td>
                    <td>{{ $data_person->npwp_pp }}</td>
                </tr>
                <tr>
                    <td>PKP / Non-PKP</td>
                    <td>{{ $data_person->pkp }}</td>
                </tr>
            </tbody>
        </table>

        <a type="reset" class="btn btn-danger" href="{{ url('/menu-private-person/') }}">Back</a>
    </section>
@endsection
