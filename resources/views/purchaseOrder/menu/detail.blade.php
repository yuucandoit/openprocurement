<title>Data Pengajuan</title>

@extends('layouts.master')

@section('main')
    <section>
     <h1>Detail Dari {{ $data_pengajuan->ws }}</h1>
        <table class="table table-bordered mt-4">
            <tbody>

                <tr>
                    <td>Date</td>
                    <td>{{ $data_pengajuan->date_ps }}</td>
                </tr>
                <tr>
                    <td>Who Submitted</td>
                    <td>{{ $data_pengajuan->ws }}</td>
                </tr>
                <tr>
                    <td>Item</td>
                    <td>{{ $data_pengajuan->item }}</td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>{{ $data_pengajuan->qty }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $data_pengajuan->desc }}</td>
                </tr>
                <tr>
                    <td>Purpose</td>
                    <td>{{ $data_pengajuan->purpose }}</td>
                </tr>
                <tr>
                    <td>Price Unit</td>
                    <td>{{ $data_pengajuan->priceperunit }}</td>
                </tr>
                <tr>
                    <td>Send To</td>
                    <td>{{ $data_pengajuan->send_to }}</td>
                </tr>
                <tr>
                    <td>Date Send</td>
                    <td>{{ $data_pengajuan->dateline }}</td>
                </tr>
                <tr>
                    <td>Proposed Supplier</td>
                    <td>{{ $data_pengajuan->proposed_supplier }}</td>
                </tr>
            </tbody>
        </table>
        @if ($data_pengajuan->status == 'Accepted')
        <a href={{ url('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) }}
            class="btn btn-success" style="align-self: flex-end"> Export to Excel</a>
    @endif
    <div class="back mt-4">
        <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
    </div>
    </section>
@endsection
