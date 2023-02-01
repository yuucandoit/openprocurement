<title>Detail Purchase Order</title>

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
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-purchase-order/') }}">Purchase Order</a></li>
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
                                <h5 class="text-white">Details {{ $data_pengajuan->whosubmit->name }}</h5>
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
                                            <td>{{ $data_pengajuan->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $data_pengajuan->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Send</td>
                                            <td>{{ $data_pengajuan->dateline }}</td>
                                        </tr>
                                        @foreach ($datapo as $po)
                                            <tr>
                                                <td>Quotation</td>
                                                <td>{{ $po->quotation }}</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Vendor</td>
                                                @if(empty($po->vendorable_type))
                                                    Belum Diisi Datanya
                                                @else
                                                <td>{{ $po->vendorable->nama }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
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
                                        <tr>
                                            <td>Approve To</td>
                                            <td>
                                                @if(empty($data_pengajuan->atasans->name))
                                                    -
                                                @else
                                                {{ $data_pengajuan->atasans->name }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Category</th>
                                            <th>File</th>
                                            <th>Price-per-unit</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp

                                    <tbody>
                                        @foreach ($pengajuan as $p)
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td style="text-align: center;">{{ $p->item }}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                @if(empty($p->path_file))
                                                <td></td>
                                                @else
                                                <td style="text-align: center;"><a href="/upload_pengajuan/{{ $p->path_file }}" class="btn btn-danger" target="_blank">See File</a></td>
                                                @endif
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}
                                                    </td>
                                                    <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($p->unit_price /100 ,2) }}
                                                    </td>
                                                    <td style="text-align:right;">$ {{ number_format($p->total /100 ,2) }}</td>
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
                                                    $ {{ number_format($d->total /100 ,2) }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="pull-right mx-2"> Discount :</label></td>
                                        <td style="text-align: right;">
                                                {{-- Ketika mata uang yang dipilih RP --}}
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    RP. {{ number_format($disc->discount) }}
                                                    {{-- Ketika mata uang yang dipilih USD --}}
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    $ {{ number_format($disc->discount /100 ,2) }}
                                                @endif
                                        </td>
                                    </tr>
                                    <tr>

                                        <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                value="{{ $data_pengajuan->ppn }}"
                                                @if ($data_pengajuan->ppn == 1) @checked(true)
                                                @else
                                                 @endif
                                                disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                        <td style="text-align:right;">
                                            @if ($data_pengajuan->ppn == 1)
                                                @foreach ($ppn as $p)
                                                    {{-- Ketika mata uang yang dipilih RP --}}
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        RP. {{ number_format($p->total) }}
                                                        {{-- Ketika mata uang yang dipilih USD --}}
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        $ {{ number_format($p->total /100 ,2) }}
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
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                            @foreach ($total as $t)
                                                {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($t->total) }}</td>

                                                    {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($t->total /100 ,2) }}</td>
                                                @endif
                                            @endforeach
                                        @elseif ($data_pengajuan->ppn == 0)
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            @foreach ($total_tnpa_ppn as $tpn)
                                                @if ($data_pengajuan->matauang == 'RP')
                                                    <td style="text-align:right;">RP. {{ number_format($tpn->total) }}</td>
                                                @elseif ($data_pengajuan->matauang == 'USD')
                                                    <td style="text-align:right;">$ {{ number_format($tpn->total /100 ,2) }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                </table>
                                <hr>

                                {{-- Start Modal Approval --}}
                                @if ($data_pengajuan->status == 'Waiting For PO Approval')
                                    <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modalSelesai" disabled>Approval Request Sent
                                    </button>
                                @elseif ($data_pengajuan->status == 'Purchase Proses')
                                @if(empty($data_pengajuan->atasans->name))
                                <div class="text-center">
                                <button class="btn btn-outline-success mt-2 disabled" data-bs-toggle="modal"
                                data-bs-target="#modalSelesai">Send Approval Request For Purchase Order</button>
                                </div>
                                @else
                                <div class="text-center">
                                <button class="btn btn-outline-success mt-2" data-bs-toggle="modal"
                                data-bs-target="#modalSelesai">Send Approval Request For Purchase Order</button>
                                </div>
                                @endif
                                @endif

                                <style>
                                    /* textarea {
                                           height: 20px;
                                           width: 100%;
                                           border: none;
                                           border-bottom: 2px solid #aaa;
                                           background-color: transparent;
                                           margin-bottom: 10px;
                                           resize: none;
                                           outline: none;
                                           transition: .5s
                                       } */

                                    .AllComment {
                                        box-sizing: border-box;
                                        border: 2px solid rgb(236, 236, 236);
                                        border-radius: 10px;
                                        padding: 15px 10px;
                                    }
                                </style>

                                    <div class="mt-4">
                                        <form action="{{ route('comment.store', $data_pengajuan->id) }}" method="POST">
                                            @csrf
                                            <textarea class="form-control" name="comment" placeholder='Add Your Comment'></textarea>
                                            <div style="text-align: right; margin-top:20px;">
                                                <input type="submit" class="btn btn-primary" value="Comment">
                                            </div>
                                        </form>
                                    </div>
                                <div class="AllComment" id="comment">
                                    <div class="container">
                                        @foreach ($comments as $c)
                                            <ul>
                                                <li>
                                                    <p>
                                                        <strong>
                                                            @if (empty($c->users->name))
                                                            @else
                                                                - {{ $c->users->name }}
                                                            @endif
                                                        </strong>
                                                        @if (empty($c->created_at))
                                                        @else
                                                            &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if (empty($c->comment))
                                                    @else
                                                        <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h2 class="modal-title" style="color: white">Warning</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mx-5 mb-3">
                                                <span class="warning">
                                                    <img src="{{ asset('assets/images/warning.png') }}">
                                                </span>
                                                <h2 style="text-align: center">Make sure the data is correct!</h2>
                                            </div>
                                            {{-- End Modal Approval --}}

                                            <div class="modal-footer" >
                                                @if ($data_pengajuan->status == 'Purchase Proses')
                                                    <form class="text-center" style="text-align: center;"
                                                        action="{{ url('menu-purchase-order/ajukan_keatasan/' . $data_pengajuan->id) }}">
                                                        <button type="submit" class="btn btn-outline-danger " ><i
                                                                class="bx bx-trash"></i>
                                                            Send Approval Request For Purchase Order
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>
                    {{-- <a href="{{ url('/export_excel/purchase_order/' . $data_pengajuan->id) }}"
                        class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a> --}}

                    <a type="reset" class="btn btn-dark mb-3 mr-1" href="{{ url('/menu-purchase-order/in') }}">Back</a>

                    {{-- <a href="{{ url('/exportpdf/po/' . $data_pengajuan->id) }}" class="btn btn-danger mb-3 mr-1"
                        style="align-self: flex-end"> Export to PDF</a> --}}
                        <a class="btn btn-danger mb-3 mr-1"
                        href="{{ url('/exportpdf/po_multi/' . $data_pengajuan->id) }}" target="_blank"
                        style="align-self: flex-end">Export PDF Multi</i>
                        </a>

    </section>
@endsection
