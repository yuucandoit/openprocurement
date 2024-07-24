<title>Detail Purchasing</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-task-list') }}">Task List Up Comming</a></li>
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
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details From {{ $datappb->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered mt-4">
                                            <tbody>
                                                <tr>
                                                    <td>Who Submitted</td>
                                                    <td>{{ $datappb->whosubmit->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>{{ $datappb->date_ps }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Department</td>
                                                    <td>{{ $datappb->dps->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td>{{ $datappb->desc }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Purpose</td>
                                                    <td> {{ $datappb->purpose->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Send To</td>
                                                    <td>{{ $datappb->send_to }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Deadline</td>
                                                    <td>{{ $datappb->dateline }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Approver Note</td>
                                                    <td>
                                                        @if(empty($datappb->note_bod_pr))
                                                        -
                                                        @else
                                                        {{ $datappb->note_bod_pr }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        @if($datappb->logistic_check == 1)
                                                        Waiting Approval Inventory Check
                                                        @else
                                                        Waiting Approval Request {{ $datappb->bod->name }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered mt-4 mb-4 order-entry">
                                            <thead>
                                                <tr class="text-center"
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>UOM</th>
                                                    <th>File</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($datappb->itemppn as $p)
                                                    <tr>
                                                        <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                        <td style="text-align: center;">{{ $p->qty }}</td>
                                                        <td style="text-align: center;">{{ $p->kategori }}</td>
                                                        <td style="text-align: center;">
                                                        @if(empty($p->path_file))
                                                        -
                                                        @else
                                                        <a href="/upload_pengajuan/{{ $p->path_file }}" class="btn btn-danger" target="_blank">See File</a>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <hr>
                            <div style="text-align: end;">
                                <a href="{{ url('/export_excel/pengajuan_pembelian/' . $datappb->id) }}"
                                    class="btn btn-success"> Export Excel Purchase Request</a>
                                <a class="btn btn-danger"  href="{{ url('/exportpdf/ppb/' . $datappb->id) }}"
                                    target="_blank" style="font-size:12;">Export PDF PR</i>
                                </a>
                                <a href="{{ route('menu-task-list.upComing') }}"  class="btn btn-secondary" >Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        </div>
    </section>
@endsection
