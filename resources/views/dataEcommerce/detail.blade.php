<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
     <h1>Detail Dari {{ $data_ecommerce->nama }}</h1>
        <table class="table table-bordered mt-4">
            <tbody>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>{{ $data_ecommerce->nama }}</td>
                </tr>
                <tr>
                    <td>Link Penjual</td>
                    <td><a href="{{ $data_ecommerce->link }}">{{ $data_ecommerce->link }}</a></td>
                </tr>
            </tbody>
        </table>

        <a type="reset" class="btn btn-danger" href="{{ url('/menu-ecommerce/') }}">Back</a>
    </section>
@endsection
