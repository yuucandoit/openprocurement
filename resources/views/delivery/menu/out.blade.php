<title>Delivery</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('/menu-purchase-order/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-2" id="floatingName"
                                        placeholder="Your Name" name="name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingAddress"
                                        placeholder="Address" name="address">
                                    <label for="floatingAddress">Address</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        @foreach ($datappb as $purchase)
            <div class="modal fade" id="modalDelete{{ $purchase->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                            <span class="warning">
                                <img src="assets/images/warning.png">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/menu-purchase-order/destroy/' . $purchase->id) }}">
                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Delivery Process Out</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Delivery Process Out</li>
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('delivery.SearchDeliveryOut') }}" method="get" class="input-group" >
                                    <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover display">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Applicant Name</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $approvedPPB = [];
                                        $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Delivery Success')
                                                @php $approvedPPB[] =$ppb; @endphp
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>
                                                        <ul>
                                                            <li><a href="{{ url('/delivery/detail/' . $ppb->id) }}"><strong>{{ Carbon\Carbon::parse($ppb->date_ps)->format('d-m-Y') }}</strong></a></li>
                                                            <li>{{ $ppb->whosubmit->name }}</li>
                                                        </ul>
                                                        {{-- <a href="{{ url('/delivery/detail/' . $ppb->id) }}">{{ $ppb->whosubmit->name }}</a> --}}
                                                    </td>
                                                    <td style="text-align: center">
                                                        @if($ppb->status == 'Delivery Success')
                                                        <a class="badge bg-success mt-1" style="color: white; font-size:12">Request Completed</a>
                                                        @endif
                                                    </td>
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
                    <!-- Container-fluid Ends -->
                </div>
            </div>
        </div>
    </section>
@endsection
