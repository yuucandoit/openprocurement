<title>Payment Request</title>

@extends('layouts.master')

@section('main')
<section>

    <!-- Page Sidebar Ends-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6 mt-4">
                    <h3>Payment Request Out</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/payment_request/out') }}">Payment Request Out</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card card-absolute">
                    <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                            <form action="{{ route('payment_request.SearchPaymentreq_out') }}" method="get" class="input-group">
                                <input type="text" name="caripyOut" class="form-control " placeholder="Search ..." value="{{ request('caripyOut') }}">
                                <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Item</th>
                                    {{-- <th>Send To</th> --}}
                                    <th>Deadline</th>
                                    @hasrole('purchasing|super admin')
                                        <th style="text-align: center">Status</th>
                                    @endhasrole
                                    {{-- <th>Function</th> --}}
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                                $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                            @endphp
                            <tbody>
                                @foreach ($datappb as $ppb)
                                    @if ($ppb->status == 'Invoicing Process' || $ppb->status == 'Payment Approved' || $ppb->status == 'Unpaid' ||  $ppb->status == 'Paid'  ||  $ppb->status == 'Delivery Process' ||  $ppb->status == 'Delivery Success'  )
                                        @php $approvedPPB[] =$ppb; @endphp
                                        <tr>
                                            <td style="text-align: center;">{{ $i++ }}</td>
                                            <td >
                                                <ul>
                                                    <li>{{ $ppb->whosubmit->name }}</li>
                                                    <li><a href="{{ url('/payment_request/detail/' . $ppb->id) }}">{!! nl2br($ppb->desc) !!}</a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                @foreach ($ppb->itemppn as $item)
                                                <ul>
                                                    <li style="word-break: break-all;">{{ $item->item }}</li>
                                                </ul>
                                                @endforeach
                                            </td>
                                            {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}
                                            <td style="text-align: center; white-space:nowrap;">
                                                @if($ppb->dateline == '≤24Jam')
                                                <strong><p>1 Hari</p></strong>
                                                @elseif ($ppb->dateline == '≤72Jam')
                                                <strong><p>2 sd 3 Hari</p></strong>
                                                @elseif ($ppb->dateline == '≤168Jam')
                                                <strong><p>4 sd 7 Hari</p></strong>
                                                @elseif ($ppb->dateline == '≤336Jam')
                                                <strong><p>7 sd 14 Hari</p></strong>
                                                @endif
                                                {{-- {{ $ppb->dateline }} --}}
                                            </td>
                                            @hasrole('purchasing|super admin')
                                                <td style="text-align: center;">
                                                    <ul>
                                                        <li>
                                                         <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:10">{{ $ppb->status }}</a>
                                                            </li>
                                                                <li style="text-align: center;">
                                                                    {{-- @foreach ($comments as $c) --}}
                                                                        <a style="font-style: italic; font-size:10; " href="{{ route('payment_request.detail',$ppb->id) }}/#comment">
                                                                        - {{ $ppb->comment->count() }} Comments
                                                                        </a>
                                                            {{-- @endforeach --}}
                                                                </li>
                                                    </ul>
                                                </td>

                                            @endhasrole
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $datappb->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Zero Configuration  Ends-->
</section>
@endsection
