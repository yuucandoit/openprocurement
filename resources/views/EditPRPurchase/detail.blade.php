<title>Detail Purchase Submission</title>

@extends('layouts.master')

@section('main')
    <section>

        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header" style="margin-bottom: -20px;">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details {{ $purchaseRequest->code_pengajuan }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-pengajuan-pembelian') }}">Purchase
                                    Request</a></li>
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
                                {{-- <p>{{ $purchaseRequest->status }}</p> --}}
                                <table class="table table-bordered" style="">
                                    <tbody>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $purchaseRequest->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $purchaseRequest->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $purchaseRequest->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $purchaseRequest->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{ $purchaseRequest->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $purchaseRequest->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Line</td>
                                            <td>{{ $purchaseRequest->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Approver</td>
                                            <td>{{ $purchaseRequest->bod->name }}</td>
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
                                    @foreach ($delivery as $d)
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
                                    @endforeach

                                    <hr>
                                    <div class="button" style="float: right;">
                                       <a href="{{ url('/exportpdf/ppb/' . $purchaseRequest->id) }}" class="btn btn-danger" >
                                           Export To PDF
                                       </a>
                                        <a type="reset" class="btn btn-dark"
                                            href="{{ url('/PrList/') }}">Back</a>

                                    </div>
                                   <!-- Container-fluid Ends-->
                                </div>
                                <style>

                                   .AllComment {
                                       box-sizing: border-box;
                                       border: 2px solid rgb(236, 236, 236);
                                       border-radius: 10px;
                                       padding: 15px 10px;
                                   }
                               </style>

                                   <div class="mt-4">
                                       <form action="{{ route('comment.store', $purchaseRequest->id) }}" method="POST">
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
    </section>

@endsection
