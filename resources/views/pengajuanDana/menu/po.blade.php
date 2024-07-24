<title>Detail Pages</title>

@extends('layouts.master')

@section('main')
<style>
    .file-item {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        margin-top: 8px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .remove-btn {
        color: red;
        cursor: pointer;
    }

    .progress-bar {
        height: 10px;
        background: green;
        width: 0%;
        transition: width 0.4s ease;
    }
</style>
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details PO {{ $datacpo->code_po }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-pengajuan-dana/') }}">Pengajuan Dana</a></li>
                            <li class="breadcrumb-item active">Details PO</li>
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
                                <h5 class="text-white">Details {{ $datacpo->ppb->whosubmit->name }}</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Code PO</td>
                                            <td>{{ $datacpo->code_po }}</td>
                                        </tr>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{  $datacpo->ppb->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{  $datacpo->ppb->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{  $datacpo->ppb->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{  $datacpo->ppb->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{  $datacpo->ppb->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{  $datacpo->ppb->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>
                                                @if( $datacpo->ppb->dateline == '≤24Jam')
                                                <strong><p>1 Hari</p></strong>
                                                @elseif ( $datacpo->ppb->dateline == '≤72Jam')
                                                <strong><p>2 sd 3 Hari</p></strong>
                                                @elseif ( $datacpo->ppb->dateline == '≤168Jam')
                                                <strong><p>4 sd 7 Hari</p></strong>
                                                @elseif ( $datacpo->ppb->dateline == '≤336Jam')
                                                <strong><p>7 sd 14 Hari</p></strong>
                                                @endif
                                                {{-- {{  $datacpo->ppb->dateline }} --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quotation</td>
                                            <td>{{  $datacpo->quotation }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Vendor</td>
                                            @if (empty( $datacpo->vendorable_type))
                                                Belum Diisi Datanya
                                            @else
                                                <td>{{  $datacpo->vendorable->nama ?? '-' }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Approver Note</td>
                                            <td>
                                                @if (empty( $datacpo->ppb->note_bod_pr))
                                                    -
                                                @else
                                                    {{  $datacpo->ppb->note_bod_pr }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Approve To</td>
                                            <td>
                                                @if (empty( $datacpo->ppb->atasans->name))
                                                    -
                                                @else
                                                    {{  $datacpo->ppb->atasans->name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{  $datacpo->status }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                @php
                                   $item_po = \App\Models\ItemPO::where('po_id', $datacpo->id)->groupBy('po_id')->first();
                                @endphp

                                @if(empty($item_po))
                                    <table class="table table-bordered mt-4 mb-4 order-entry">
                                        <thead>
                                            <tr class="text-center"
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>UOM</th>
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
                                                    <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($p->unit_price) }}</td>
                                                    <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($p->total) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered ">
                                        <tr>
                                            <td><label class="pull-right mx-2"> DPP :</label></td>
                                            <td style="text-align: right;">
                                                @foreach ($dpp as $d)
                                                    {{ $datacpo->ppb->matauang }} {{ number_format($d->total) }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2"> Discount :</label></td>
                                            <td style="text-align: right;">
                                                @if($disc == null)
                                                0
                                                @else
                                                {{ $datacpo->ppb->matauang }} {{ number_format($disc->discount) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                    value="{{ $datacpo->ppb->ppn }}"
                                                    @if ($datacpo->ppb->ppn == 1) @checked(true)
                                                @else
                                            @endif
                                                    disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                            <td style="text-align:right;">
                                                @if ($datacpo->ppb->ppn == 1)
                                                    @foreach ($ppn as $p)
                                                        {{ $datacpo->ppb->matauang }} {{ number_format($p->total) }}
                                                    @endforeach
                                                @else
                                                    @foreach ($ppn as $p)
                                                        {{ $datacpo->ppb->matauang }} 0
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($datacpo->ppb->ppn == 1)
                                            <tr>
                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                @foreach ($total as $t)
                                                <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($t->total) }}</td>
                                                @endforeach
                                            @elseif ($datacpo->ppb->ppn == 0)
                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>

                                                @foreach ($total_tnpa_ppn as $tpn)
                                                <td style="text-align:right;">{{ $datacpo->ppb->matauang }} {{ number_format($tpn->total) }}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    </table>
                                @else
                                    <table class="table table-bordered mt-4 mb-4">
                                        <thead>
                                            <tr class="text-center"
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                <th>No</th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>UOM</th>
                                                <th>Price-per-unit</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tbody>
                                            @foreach ($datacpo->itempo as $item)
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td style="text-align: center;">{{ $item->item }}</td>
                                                    <td style="text-align: center;">{{ $item->qty }}</td>
                                                    <td style="text-align: center;">{{ $item->kategori }}</td>
                                                    <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item->unit_price) }}</td>
                                                    <td style="text-align:right;">{{ $item->matauang }} {{ number_format($item->total) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered ">
                                        <tr>
                                            <td><label class="pull-right mx-2"> DPP :</label></td>
                                            <td style="text-align: right;">
                                                {{ $item_po->matauang }} {{ number_format($item_po->dpp,2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2"> Discount :</label></td>
                                            <td style="text-align: right;">
                                                {{ $item_po->matauang }} {{ number_format($item_po->discount,2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                    value="{{ $item_po->ppn }}"
                                                    @if ($item_po->ppn == 1) @checked(true)
                                                    @else @endif
                                                    disabled="true">
                                                <label class="pull-right mx-2"> PPN 11% :</label>
                                            </td>
                                            @php
                                                $dpp = $item_po->dpp;
                                                $disc = $item_po->discount;
                                                $afterdisc = $dpp - $disc;
                                                $ppn = $afterdisc *11 /100;
                                            @endphp
                                            <td style="text-align:right;">
                                                @if ($item_po->ppn == 1)
                                                    {{ $item_po->matauang }} {{ number_format($ppn) }}
                                                @else
                                                    {{ $item_po->matauang }} 0
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2"> Shipping & Protection Fee :</label></td>
                                            <td style="text-align: right;">
                                                {{ $item_po->matauang }} {{ number_format($item_po->ongkir) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label class="pull-right mx-2"> Admin Or Service Fee :</label></td>
                                            <td style="text-align: right;">
                                                {{ $item_po->matauang }} {{ number_format($item_po->admin_fee) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                            <td style="text-align:right;">{{ $item_po->matauang }} {{ number_format($item_po->grand_total) }}</td>
                                        </tr>

                                    </table>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-3 mb-3" style="text-align: center;">
                                            @hasrole('finance|super admin')
                                                @if ($datacpo->status == 'Paid' || $datacpo->status == 'Delivery Process' || $datacpo->status == 'Delivery Success')
                                                    <div>
                                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                            class="btn btn-danger" onclick="return">Reject</a>
                                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                            class="btn btn-success" onclick="return"><b>Paid Success</b></a>
                                                    </div>
                                                @elseif($datacpo->status == 'Unpaid')
                                                    <div>
                                                        <form action="{{ route('menu-pengajuan-dana-paid_pd', $datacpo->id) }}" method="POST">
                                                            @csrf
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#reject" class="btn btn-danger ">Reject</button>
                                                                <button class="btn btn-success ml-2" type="submit">Paid</button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div>
                                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                            class="btn btn-success" onclick="return">Paid</a>

                                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                                            class="btn btn-danger" onclick="return"><b>Rejected</b></a>
                                                    </div>
                                                @endif
                                            @endhasrole

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12" >
                                        <div class="mt-3">
                                            <a href="{{ url()->previous() }}" class="btn "
                                                style=" color:white; background-color:black">Back</a>
                                            <a href="{{ url('/exportpdf/pymnt_id/' . $datacpo->id) }}" class="btn btn-secondary">Export PDF</a>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5>Report Payment</h5>
                            </div>
                            <div class="card-body">

                                <!-- Floating Labels Form -->
                                <form class="row g-2 mt-4" action="{{ url('/menu-pengajuan-dana/store/'.$datacpo->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 mt-4">
                                        <label for="path_image">Enter payment proof</label>
                                        <div class="form-group">
                                            <input class="form-control" type="file" name="path_image[]" id="path_image" multiple>
                                            @error('path_image')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- List of selected files -->
                                    <div class="col-md-12 mb-4">
                                        <strong>Files to upload:</strong>
                                        <ul id="fileList"></ul>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 mt-4">
                                        <strong>Files uploaded:</strong>
                                        @if (empty($datacpo->pengajuanDana))
                                        @else
                                            <ul>
                                                @foreach ($datacpo->pengajuanDana as $pdd)
                                                <li><a href="{{ asset('images/'.$pdd->path_image) }}" target="_blank">- {{ $pdd->path_image }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                                        <a href="{{ route('menu-pengajuan-dana.index') }}" class="btn btn-dark mt-3">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="rejectLabel">Reject Message</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('menu-pengajuan-dana-reject', $datacpo->id) }}" id="formAdd" method="POST" enctype="multipart/form-data">
                            @csrf
                            <textarea name="notes" id="" cols="30" rows="10" class="form-control"></textarea>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <script>
     document.addEventListener("DOMContentLoaded", function() {
            const inputElement = document.getElementById('path_image');
            let selectedFiles = [];
            let dataTransfer = new DataTransfer();

            inputElement.addEventListener('change', function() {
                updateSelectedFiles(Array.from(inputElement.files));
                refreshFileList();
            });

            function updateSelectedFiles(newFiles) {
                newFiles.forEach(file => {
                    if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                        selectedFiles.push(file);
                    }
                });
                updateDataTransfer();
            }

            function updateDataTransfer() {
                dataTransfer.items.clear();
                selectedFiles.forEach(file => dataTransfer.items.add(file));
                inputElement.files = dataTransfer.files;
            }

            function refreshFileList() {
                const fileList = document.getElementById('fileList');
                fileList.innerHTML = "";

                selectedFiles.forEach((file, index) => {
                    const li = document.createElement('li');
                    li.className = 'file-item';
                    li.innerHTML = `<span class="file-name">${file.name} (${(file.size / 1024).toFixed(2)} KB)</span>
                                    <span class="remove-btn" data-index="${index}">&#x2715;</span>`;
                    fileList.appendChild(li);
                });

                document.querySelectorAll('.remove-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        removeFile(this.getAttribute('data-index'));
                    });
                });
            }

            function removeFile(index) {
                selectedFiles.splice(index, 1);
                updateDataTransfer();
                refreshFileList();
            }
        });

    </script>
@endsection
