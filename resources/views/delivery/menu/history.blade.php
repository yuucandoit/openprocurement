<title>History Delivery</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="modal fade" id="modalSort" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">

                        <h4 class="modal-title">Sort </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('delivery.SortHistoryDelivery') }}" method="get" class="input-group" >
                        <div class="modal-body ">
                            @php
                                $i = 1;
                            @endphp
                            <h4>Sort by status </h4>
                            <div class="row">
                                <div class="col-sm-12" >
                                    <ul>
                                        <li>
                                            <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Delivery Success' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Delivery Success">&nbsp;Delivery Success
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Sort</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Shipping Process</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Shipping Process</li>
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
                        <div class="col-sm-8">
                            <div style="margin-bottom:-30px; margin-top:20px; margin-left:30px;">
                                <label data-bs-toggle="modal" data-bs-target="#modalSort"><i class="fa fa-filter" style="font-size:20px"></i> Sort</label>
                                @if(empty($sort))

                                @else
                                    @foreach ($sort as $s)
                                        @if(empty($s))

                                        @else
                                        <a class="badge badge-success" style="font-size: 10; color:white;">{{ $s }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                        <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                            <form action="{{ route('delivery.SearchHistoryDelivery') }}" method="get" class="input-group" >
                                <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
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
                                        <th>Applicant Name</th>
                                        <th>Request Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                    $approvedPPB = [];
                                @endphp
                                <tbody>
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Delivery Success')
                                            @php $approvedPPB[] =$ppb; @endphp
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td style="font-weight: 600;"><a  href="{{ url('/delivery/detail/' . $ppb->id) }}">{{ $ppb->whosubmit->name }}</a></td>
                                                <td>{{ $ppb->created_at }}</td>
                                                @hasrole('purchasing|super admin')
                                                    <td>
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('/delivery/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                    </td>
                                                @endhasrole
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $datappb->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends -->
            </div>
        </div>
    </div>
        <script>
            $(document).ready(function() {

                $('.servideletebtn').click(function(e) {
                    e.preventDefault();
                    alert('hello');
                });

            });
        </script>
    </section>
@endsection
