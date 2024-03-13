<title>Detail Purchase Submission</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header" style="margin-bottom: -20px;">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details {{ $pre_pr->project->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/pre-pr') }}">Pre PR</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-body ">
                                {{-- <p>{{ $data_pengajuan->status }}</p> --}}
                                <table class="table table-bordered" style="">
                                    <tbody>
                                        <tr>
                                            <td>Created By</td>
                                            <td>{{ $pre_pr->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Project</td>
                                            <td>{{ $pre_pr->project->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Due Date</td>
                                            <td>{{ $pre_pr->due_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="order-history table-responsive wishlist">
                                    <table class="table table-bordered mt-4 mb-4">
                                        <thead>
                                            <tr class="text-center" style="font-size: 17; font-weight: bold;">
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Buffer</th>
                                                <th>Description</th>
                                                <th>Link</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pre_pr->partItem as $p)
                                                <tr>
                                                    <td style="text-align: center;">{!! nl2br($p->child_item) !!}</td>
                                                    <td style="text-align: center;">{{ $p->qty }}</td>
                                                    <td style="text-align: center;">{{ $p->buffer }}</td>
                                                    <td style="text-align: center;">{{ $p->desc }}</td>
                                                    <td style="text-align: center;">{{ $p->link }}</td>
                                                    <td style="text-align: center;">{{ $p->status }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <hr>
                                    <div class="button" style="float: right;">
                                        <a href="{{ url('/export_excel/pengajuan_pembelian/' . $pre_pr->id) }}"
                                            class="btn btn-success disabled" style="align-self: flex-end;"> Export to Excel</a>

                                        <a type="reset" class="btn btn-dark"
                                            href="{{ url('pre-pr/') }}">Back</a>
                                    </div>
                                   <!-- Container-fluid Ends-->
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
    </section>

@endsection
