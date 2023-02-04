<title>Detail Task List PO</title>

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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-taskList-atasan-po.index') }}">Task List Super
                                    user PO</a></li>
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
                        </form>
                        </li>
                        </ul>
                    </div> --}}
                    <!-- Bookmark Ends-->
                </div>
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
                                        <td>Date Line</td>
                                        <td>{{ $data_pengajuan->dateline }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered mt-4 mb-4 order-entry">
                                <thead>
                                    <tr class="text-center"
                                        style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
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
                                            <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                            <td style="text-align: center;">{{ $p->qty }}</td>
                                            <td style="text-align: center;">{{ $p->kategori }}</td>
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
                              <!-- Modal -->
                              <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="rejectLabel">Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('menu-taskList-atasan-payment/reject', $data_pengajuan->id) }}" id="formAdd" method="get"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Reject Message</label>
                                            <textarea name="note_py" id="note" class="form-control" cols="30" rows="0" required></textarea>
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

                            <!-- Modal -->
                            <div class="modal fade" id="approve" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="approveLabel">Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('menu-taskList-atasan-payment/approve_payment', $data_pengajuan->id) }}" method="get">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Approve Message</label>
                                            <textarea name="note_py" id="note" class="form-control" cols="30" rows="0"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>


                            <div class="mt-3">
                            @hasrole('super user|super admin')

                                    @if ($data_pengajuan->status == 'Payment Approved' ||
                                    $data_pengajuan->status == 'Unpaid' ||
                                    $data_pengajuan->status == 'Paid' ||
                                    $data_pengajuan->status == 'Delivery Process' ||
                                    $data_pengajuan->status == 'Delivery Success')
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-danger text-center" onclick="return">Reject</a>
                                    @elseif($data_pengajuan->status == 'Invoicing Process')
                                    <button type="button" class="btn btn-success text-center" data-bs-toggle="modal" data-bs-target="#approve"> Approve</button>
                                    <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal" data-bs-target="#reject">Reject</button>
                                    @else
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-success text-center" onclick="return">Aprove</a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                    class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                    @endif
                                @endhasrole
                            </div>
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

                             <div class="container">
                                <div class="mt-4">
                                     <form action="{{ route('comment.store',$data_pengajuan->id) }}" method="POST" >
                                        @csrf
                                        <textarea name="comment" class="form-control" placeholder='Add Your Comment'></textarea>
                                        <div style="text-align: right; margin-top:20px;">
                                            <input type="submit" class="btn btn-primary" value="Comment">
                                            <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                        </div>
                                     </form>
                                    </div>
                                </div>

                                <div class="AllComment" id="comment">
                                    <div class="container">
                                            @foreach($comments as $c)
                                        @if($c->ppb->atasan_py == 3)
                                                    <ul>
                                                        <li style="margin-top: 10px;">
                                                            <p>
                                                                <strong>
                                                                @if(empty($c->users->name))

                                                                @else
                                                                - {{ $c->users->name }}
                                                                @endif
                                                            </strong>
                                                            @if(empty($c->created_at))

                                                            @else
                                                            &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                            @endif
                                                            </p>
                                                        </li>
                                                        <li>
                                                            @if(empty($c->comment))

                                                            @else
                                                            <p>{{ $c->comment }}</p>
                                                            @endif
                                                        </li>
                                                        <hr>
                                                    </ul>
                                            @elseif($c->ppb->atasan_py == 6)
                                            <ul>
                                                <li style="margin-top: 10px;">
                                                    <p>
                                                        <strong>
                                                        @if(empty($c->users->name))

                                                        @else
                                                        - {{ $c->users->name }}
                                                        @endif
                                                    </strong>
                                                    @if(empty($c->created_at))

                                                    @else
                                                    &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                    @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if(empty($c->comment))

                                                    @else
                                                    <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                            @elseif($c->ppb->atasan_py == 7)
                                            <ul>
                                                <li style="margin-top: 10px;">
                                                    <p>
                                                        <strong>
                                                        @if(empty($c->users->name))

                                                        @else
                                                        - {{ $c->users->name }}
                                                        @endif
                                                    </strong>
                                                    @if(empty($c->created_at))

                                                    @else
                                                    &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                    @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if(empty($c->comment))

                                                    @else
                                                    <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                            @elseif($c->ppb->atasan_py == 8)
                                            <ul>
                                                <li style="margin-top: 10px;">
                                                    <p>
                                                        <strong>
                                                        @if(empty($c->users->name))

                                                        @else
                                                        - {{ $c->users->name }}
                                                        @endif
                                                    </strong>
                                                    @if(empty($c->created_at))

                                                    @else
                                                    &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                    @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if(empty($c->comment))

                                                    @else
                                                    <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                            @elseif($c->ppb->atasan_py == 9)
                                            <ul>
                                                <li style="margin-top: 10px;">
                                                    <p>
                                                        <strong>
                                                        @if(empty($c->users->name))

                                                        @else
                                                        - {{ $c->users->name }}
                                                        @endif
                                                    </strong>
                                                    @if(empty($c->created_at))

                                                    @else
                                                    &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('H:i:s D-m-Y') }}
                                                    @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    @if(empty($c->comment))

                                                    @else
                                                    <p>{{ $c->comment }}</p>
                                                    @endif
                                                </li>
                                                <hr>
                                            </ul>
                                        @endif
                                    @endforeach
                                </div>
                                </div>
                            {{-- <div class="mt-3">
                                @hasrole('super user|super admin')
                                    @if ($data_pengajuan->status == 'Unpaid' ||
                                        $data_pengajuan->status == 'Paid' ||
                                        $data_pengajuan->status == 'Delivery Process' ||
                                        $data_pengajuan->status == 'Delivery Success')
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                    @elseif($data_pengajuan->status == 'Invoicing Process')
                                        <a href="{{ url('menu-taskList-atasan-payment/approve_payment', $data_pengajuan->id) }}"
                                            class="btn btn-success text-center" onclick="return">Approve</a>

                                        <a href="{{ url('menu-taskList-atasan-payment/reject', $data_pengajuan->id) }}"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                    @else
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return">Aprove</a>

                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                    @endif
                                @endhasrole

                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        </div>

    </section>
@endsection


<!-- JavaScript Item -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".order-entry").on("keyup", ".form-calc", function() {
            var parent = $(this).closest("tr");
            parent.find(".form-line").val((parent.find(".form-qty").val() * parent.find(".form-cost")
                .val()).toFixed(0));
            var total = 0;
            var checkbox = document.querySelector(".check-box");
            checkbox.addEventListener('change', (event) => {
                if (event.currentTarget.checked) {
                    totalppn = total * 11 / 100;
                    $(".total").text(totalppn);
                } else {
                    $(".total").text(total.toFixed(0));
                }
            })
            $(".form-line").each(function() {
                total += parseInt($(this).val() || 0);
            });

        });
    });
</script>
