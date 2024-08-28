 <title>Detail Purchase Submission</title>

 @extends('layouts.master')

 @section('main')
     <section>

         <!-- Page Sidebar Ends-->
         <div class="container-fluid">
             <div class="page-header" style="margin-bottom: -20px;">
                 <div class="row">
                     <div class="col-sm-6 mt-4">
                         <h3>Details {{ $data_pengajuan->code_pengajuan }}</h3>
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                             <li class="breadcrumb-item"><a href="{{ url('/menu-pengajuan-pembelian') }}">Purchase
                                     Request</a></li>
                             <li class="breadcrumb-item active">Details</li>
                         </ol>
                     </div>
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
                                    <tr>
                                        <td>Approver</td>
                                        <td>{{ $data_pengajuan->bod->name }}</td>
                                    </tr>
                                    <tr>
                                    <td>File PR</td>
                                    <td><a href="{{ asset('upload_file_pr/'.$data_pengajuan->file_pr) }}" target="_blank">{{ $data_pengajuan->file_pr }}</a></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="order-history table-responsive wishlist">
                                <table class="table table-bordered mt-4 mb-4">
                                    <thead>
                                        <tr class="text-center" style="font-size: 17; font-weight: bold;">
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>UOM</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan as $p)
                                            <tr>
                                                <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                @if(empty($p->path_file))
                                            <td></td>
                                            @else
                                            <td style="text-align: center;"><a href="/upload_pengajuan/{{ $p->path_file }}" target="_blank">{{ $p->path_file }}</a></td>
                                            @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- @foreach ($delivery as $d)
                                    <div class="gallery my-gallery card-body text-center" itemscope="">
                                        <figure class=" xl-33 text-center" itemprop="associatedMedia" itemscope=""><a
                                                href=" {{ asset('images/' . $d->path_image) }}" itemprop="contentUrl"
                                                data-size="1600x950"><img class="img-thumbnail"
                                                    src="{{ asset('images/' . $d->path_image) }}" itemprop="thumbnail"
                                                    alt="Image description"></a>
                                            <figcaption itemprop="caption description" class="text-center">Received By
                                                {{ $d->receiver }}</figcaption>
                                        </figure>
                                    </div>
                                @endforeach --}}

                                <hr>
                                <div class="button" style="float: right;">
                                <a href="{{ url('/exportpdf/ppb/' . $data_pengajuan->id) }}" class="btn btn-secondary" >
                                    Export To PDF
                                </a>

                                    <a href="{{ url('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) }}"
                                        class="btn btn-warning" style="align-self: flex-end"> Export to Excel</a>

                                    <a type="reset" class="btn btn-dark"
                                        href="{{ url('/menu-pengajuan-pembelian/') }}">Back</a>

                                </div>
                            <!-- Container-fluid Ends-->
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

                            <div class="mt-4">
                                <form action="{{ route('comment.store', $data_pengajuan->id) }}" method="POST">
                                    @csrf
                                    <textarea class="form-control" name="comment" placeholder='Add Your Comment'></textarea>
                                    <div style="text-align: right; margin-top:20px;">
                                        <input type="submit" class="btn btn-primary" value="Comment">
                                        <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
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
                                                    &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('| l | d-m-Y | H:i:s |') }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                        <h5>List PO</h5>
                        </div>
                        <div class="card-body">
                            @if ($data_pengajuan->quot->isEmpty())

                            @else
                                <div class="default-according" id="accordionclose">
                                    @foreach ($data_pengajuan->quot as $po)
                                        @if($po->status != 'Reject PO')
                                            @php
                                                foreach($po->itempo as $var_i)
                                                {
                                                    $item_po = $var_i;
                                                }
                                            @endphp
                                            <div class="card">
                                                <div class="card-header" id="heading{{ $po->id }}">
                                                    <button class="btn btn-link" style="width: 100%;" data-bs-toggle="collapse" data-bs-target="#collapse{{ $po->id }}" aria-expanded="true" aria-controls="heading1">
                                                        <span style="font-weight: bold; color:green; float: left;">{{ $po->code_po }}</span>
                                                        <span style="float: left; font-weight:600; color:blueviolet;">&nbsp; ({{ $po->status ?? '-' }})</span>
                                                        <span style="float: right;">
                                                            <a href="{{ route('delivery.track_po',$po->id) }}" class="btn btn-secondary @if(!$po->deliveryStatus->isNotEmpty() && $po->flag_delivery == 0) disabled @endif" @if(!$po->deliveryStatus->isNotEmpty() && $po->flag_delivery == 0) disabled @endif onclick="openLink(event, this)">Timeline</a>
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="collapse" id="collapse{{ $po->id }}" aria-labelledby="heading{{ $po->id }}" data-bs-parent="#accordionclose{{ $po->id }}">
                                                    <div class="card-body">
                                                        @php
                                                            foreach($po->itempo as $i)
                                                        {
                                                            $e = $i->po_id;
                                                        }
                                                        @endphp

                                                        @if(empty($e))
                                                            <table class="table table-bordered mt-4 mb-4 order-entry">
                                                                <thead>
                                                                    <tr class="text-center"
                                                                        style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                                                        <th>Item</th>
                                                                        <th>Qty</th>
                                                                        <th>UOM</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($pengajuan as $p)
                                                                        <tr>
                                                                            <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                                            <td style="text-align: center;">{{ $p->qty }}</td>
                                                                            <td style="text-align: center;">{{ $p->kategori }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <table class="table table-bordered item order-entry mx-2">
                                                                <tr style="text-align: center;">
                                                                    <th
                                                                        style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                        No</th>
                                                                    <th
                                                                        style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                        Item</th>
                                                                    <th
                                                                        style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                        Qty</th>
                                                                    <th
                                                                        style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                                        Uom</th>
                                                                </tr>
                                                                @php
                                                                    $id = 1;
                                                                @endphp
                                                                @foreach ($po->itempo as $item)
                                                                    <tr>
                                                                        <td class="text-center">{{ $id++ }}</td>
                                                                        <td class="text-center">{{ $item->item }}</td>
                                                                        <td class="text-center">{{ $item->qty }}</td>
                                                                        <td class="text-center">{{ $item->kategori }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        @endif

                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mt-4">
                                                                    <ul>
                                                                        <li>
                                                                            <p><strong>Purchase&nbsp;:</strong>

                                                                            @if ($po->status == 'Awaiting Purchase Request Approval')
                                                                            -
                                                                            @elseif ($po->status == 'Waiting For PO Approval')
                                                                            <a class="badge mt-1" style="background-color:#006516; color:white; font-size:8;" >Process PO</a>
                                                                            @elseif($po->status == 'Invoicing Process')
                                                                            <a class="badge mt-1" style="background-color:#006516; color:white; font-size:8;" >Done</a>
                                                                            @elseif ($po->status == 'Purchase Request Approved' )
                                                                            <a class="badge mt-1" style="background-color:#FF8C00; color:white; font-size:8;" >Waiting</a>

                                                                            @elseif( $po->status == 'Purchase Proses')
                                                                            <a class="badge bg-warning mt-1" style="color:white; font-size:8;" >Process PO</a>

                                                                            @elseif( $po->status == 'Cross Check PO')
                                                                            -
                                                                            @elseif( $po->status == 'Rejected From Logistics')
                                                                            -

                                                                            @elseif( $po->status == 'PO Approved')
                                                                            <a class="badge mt-1" style="background-color:#006516; color:white; font-size:8;" >Done</a>

                                                                            @elseif($po->status == 'Payment Approved' )
                                                                            <a class="badge bg-success mt-1" style="color:white; font-size:8;" >On Process</a>

                                                                            @elseif ($po->status == 'PO & Payment Approved' || $po->status == 'Unpaid' || $po->status == 'Paid' || $po->status == 'Delivery process' || $po->status == 'Delivery Success')
                                                                            <a class="badge bg-success mt-1" style="color:white; font-size:8;">Done</a>
                                                                            @endif
                                                                            @if ($po->status == 'Rejected by Purchasing')
                                                                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                                                                            @endif
                                                                            @if ($po->status == 'Purchase Request Rejected By BOD')
                                                                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                                                                            @endif
                                                                            @if ($po->status == 'PO Rejected by BOD')
                                                                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected PO</a>
                                                                            @endif
                                                                            </p>

                                                                        </li>
                                                                        <li>
                                                                            <p><strong>Payment&nbsp; :</strong>
                                                                            @if ($po->status == 'Unpaid' || $po->status == 'PO & Payment Approved')
                                                                            <a class="badge bg-warning mt-1" style="color: white; font-size:8">Unpaid</a>
                                                                            @elseif ($po->status == 'Paid' || $po->status == 'Delivery Success' )
                                                                            <a class="badge bg-success mt-1" style="color: white; font-size:8">Done</a>
                                                                            @elseif ($po->status == 'Purchase Request Approved' || $po->status == 'Purchase Proses'  || $po->status == 'Payment Approved' )
                                                                            -
                                                                            @elseif ($po->status == 'PO Approved')
                                                                            <a class="badge mt-1" style="background-color:#FF8C00; color:white; font-size:8;" >Waiting</a>
                                                                            @elseif ($po->status == 'Awaiting Purchase Request Approval')
                                                                            -
                                                                            @elseif ($po->status == 'Waiting For PO Approval')
                                                                            -
                                                                            @elseif( $po->status == 'Rejected From Logistics')
                                                                            -
                                                                            @elseif($po->status == 'Invoicing Process')
                                                                            <a class="badge mt-1" style="background-color:#FF8C00; color:white; font-size:8;" >On-Process</a>
                                                                            @elseif ($po->status == 'Payment Rejected By BOD')
                                                                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                                                                            @elseif ($po->status == 'Rejected by Finance')
                                                                            <a class="badge bg-danger mt-1" style="color: white; font-size:8">Rejected</a>
                                                                            -
                                                                            @elseif ($po->status == 'Rejected by Purchasing')
                                                                            -
                                                                            @elseif ($po->status == 'Purchase Request Rejected By BOD')
                                                                            -
                                                                            @elseif ($po->status == 'Payment Rejected By BOD')
                                                                            -
                                                                            @elseif ($po->status == 'PO Rejected by BOD')
                                                                            -
                                                                            @elseif ($po->status == 'Rejected by Finance')
                                                                            -
                                                                            @elseif( $po->status == 'Cross Check PO')
                                                                            -
                                                                            @endif
                                                                            </p>
                                                                        </li>
                                                                        <li>
                                                                            <p><strong>Delivery&nbsp;&nbsp;&nbsp;:</strong>
                                                                                @if ($po->status == 'Paid' || (!empty($po->flag_delivery) && $po->flag_delivery == 1) )
                                                                                <a class="badge bg-warning mt-1 btn btn-warning" style="color: white; font-size:8"> On The Way</a>
                                                                                @elseif ($po->status == 'Delivery Success' || (!empty($po->flag_delivery) && $po->flag_delivery == 2))
                                                                                <a class="badge bg-success mt-1" style="color: white; font-size:8">Delivered</a>
                                                                                @elseif ($po->status == 'Purchase Request Approved' || $po->status == 'Purchase Proses' || $po->status == 'PO Approved'  || $po->status == 'Payment Approved' )
                                                                                -
                                                                                @elseif ($po->status == 'Awaiting Purchase Request Approval' || $po->status == 'PO & Payment Approved')
                                                                                -
                                                                                @elseif ($po->status == 'Waiting For PO Approval')
                                                                                -
                                                                                @elseif($po->status == 'Invoicing Process')
                                                                                -
                                                                                @elseif ($po->status == 'Rejected by Purchasing')
                                                                                -
                                                                                @elseif( $po->status == 'Rejected From Logistics')
                                                                                -
                                                                                @elseif ($po->status == 'Purchase Request Rejected By BOD')
                                                                                -
                                                                                @elseif ($po->status == 'Payment Rejected By BOD')
                                                                                -
                                                                                @elseif ($po->status == 'PO Rejected by BOD')
                                                                                -
                                                                                @elseif ($po->status == 'Rejected by Finance')
                                                                                -
                                                                                @elseif ($po->status == 'Cross Check PO')
                                                                                -
                                                                                @endif
                                                                            </p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                @foreach ($po->deliveryss as $deliver)
                                                                    <div class="gallery my-gallery card-body text-right" itemscope="">
                                                                        <figure class=" xl-33 text-right    " itemprop="associatedMedia" itemscope="">
                                                                            <a href="{{ asset('images/' . $deliver->path_image) }}" itemprop="contentUrl"
                                                                                data-size="1600x950"><img class="img-thumbnail" src="{{ asset('images/' . $deliver->path_image) }}"
                                                                                itemprop="thumbnail" alt="Image description">
                                                                            </a>
                                                                            <figcaption itemprop="caption description" class="text-center">Received By {{ $deliver->receiver }}</figcaption>
                                                                        </figure>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

     </section>

    <script>
    function openLink(event, element) {
        if (element.hasAttribute('disabled')) {
            event.preventDefault();
            return false;
        }
        window.open(element.href, '_blank');
    }
    </script>
 @endsection
