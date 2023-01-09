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
                            <li class="breadcrumb-item"><a href="{{ url('/menu-task-list') }}">Task List Purchasing</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div> --}}
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details From {{ $data_pengajuan->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $data_pengajuan->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $data_pengajuan->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $data_pengajuan->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $data_pengajuan->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td> {{ $data_pengajuan->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $data_pengajuan->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>{{ $data_pengajuan->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if(empty($data_pengajuan->note_bod_pr))
                                                -
                                                @else
                                                {{ $data_pengajuan->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Category</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan as $p)
                                            <tr>
                                                <td style="text-align: center;">{{ $p->item }}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($p->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">$ {{ number_format($p->total) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table table-bordered ">
                                    <tr>
                                        <td><label class="pull-right mx-2"> DPP :</label></td>
                                        <td style="text-align: right;">
                                            @foreach ($dpp as $d)
                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    RP. {{ number_format($d->total) }}
                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    $ {{ number_format($d->total) }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $data_pengajuan->ppn }}"
                                                @if ($data_pengajuan->ppn == 1) @checked(true)
                                                @else @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        <td style="text-align:right;">
                                            @if ($data_pengajuan->ppn == 1)
                                                @foreach ($ppn as $p)
                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        RP. {{ number_format($p->total) }}
                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        $ {{ number_format($p->total) }}
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($ppn as $p)
                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        RP. 0
                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        $ 0
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($data_pengajuan->ppn == 1)
                                        <tr>
                                            <td class="text-end" style="font-weight: bold">Grand Total :</td>

                                            @foreach ($total as $t)
                                                {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                    {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                                                @endif
                                            @endforeach
                                        @elseif ($data_pengajuan->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($tpn->total) }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                </table>
                                <hr>
                                  <!-- Modal -->
                              <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="rejectLabel">Reject Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('menu-task-list/reject', $data_pengajuan->id) }}" id="formAdd" method="get"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Comment</label>
                                            <textarea name="note_purchase" id="note" class="form-control" cols="30" rows="0" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                                <div class="mt-3">
                                    @hasrole('purchasing|super admin')
                                        <form action="{{ url('menu-task-list/accept', $data_pengajuan->id) }}" method="get">
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Comment</label>
                                                <textarea name="note_purchase" id="note" class="form-control" cols="30" rows="0"></textarea>
                                            </div>
                                            @if ($data_pengajuan->status == 'Purchase Proses' ||
                                            $data_pengajuan->status == 'Waiting For PO Approval' ||
                                            $data_pengajuan->status == 'PO Approved' ||
                                            $data_pengajuan->status == 'Invoicing Process' ||
                                            $data_pengajuan->status == 'Unpaid' ||
                                            $data_pengajuan->status == 'Paid' ||
                                            $data_pengajuan->status == 'Delivery Process' ||
                                            $data_pengajuan->status == 'Delivery Success')
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                            @elseif($data_pengajuan->status == 'Purchase Request Approved')
                                            <button type="submit" class="btn btn-success text-center"> Approve</button>
                                            <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                            @else
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return">Aprove</a>
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                            @endif
                                        </form>
                                        @endhasrole
                                    </div>
                                {{-- <div class="mt-3 text-right">
                                    @hasrole('purchasing|super admin')
                                        @if ($data_pengajuan->status == 'Purchase Proses' ||
                                            $data_pengajuan->status == 'Waiting For PO Approval' ||
                                            $data_pengajuan->status == 'PO Approved' ||
                                            $data_pengajuan->status == 'Invoicing Process' ||
                                            $data_pengajuan->status == 'Unpaid' ||
                                            $data_pengajuan->status == 'Paid' ||
                                            $data_pengajuan->status == 'Delivery Process' ||
                                            $data_pengajuan->status == 'Delivery Success')
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-success text-center" onclick="return"><b>Approved</b></a>

                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-danger text-center" onclick="return">Reject</a>
                                        @elseif($data_pengajuan->status == 'Purchase Request Approved')
                                            <a href="{{ url('menu-task-list/accept', $data_pengajuan->id) }}"
                                                class="btn btn-success text-center" onclick="return">Approve</a>

                                            <a href="{{ url('menu-task-list/reject', $data_pengajuan->id) }}"
                                                class="btn btn-danger text-center" onclick="return">Reject</a>
                                        @else
                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-success text-center" onclick="return">Approve</a>

                                            <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                        @endif
                                    @endhasrole
                                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        </div>
        <!--
                            {{-- <a href={{ url('#')('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) class="btn btn-success" style="align-self: flex-end"> Export to Excel</a> -- }} --}}-->
    </section>
@endsection
