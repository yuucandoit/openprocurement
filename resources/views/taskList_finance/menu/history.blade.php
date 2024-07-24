<title>Task List Finance</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="modal fade" id="modalSort" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">

                        <h4 class="modal-title">Sort </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('menu-tasklist-finance.SortHistoryTaskFinance') }}" method="get" class="input-group" >
                        <div class="modal-body ">
                            @php
                                $i = 1;
                            @endphp
                            <h4>Sort by status </h4>
                            <div class="row">
                                <div class="col-sm-12" >
                                    <ul>
                                        <li>
                                            <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Unpaid' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Unpaid">&nbsp;Unpaid
                                            </label>
                                        </li>
                                        <li>
                                            <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Paid' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Paid">&nbsp;Paid
                                            </label>
                                        </li>
                                        <li>
                                            <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Delivery Success' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Delivery Success">&nbsp;Delivery Success
                                            </label>
                                        </li>
                                        <li>
                                            <label style="white-space: nowrap; margin-left:auto;"><input {{ request('sort[]') == 'Rejected by Finance' ? 'checked': '' }} style="margin-left:auto;" name="sort[]" type="checkbox" value="Rejected by Finance">&nbsp;Rejected by Finance
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
                        <h3>History Finance Task's</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Finance Task's</li>
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
                        <div class="col-sm-8">
                            <div style="margin-bottom:-30px; margin-top:20px; margin-left:30px;">
                                <label data-bs-toggle="modal" data-bs-target="#modalSort"><i data-feather="filter" style="font-size:20px"></i> Sort</label>
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
                                    <form action="{{ route('menu-tasklist-finance.SearchHistoryTaskFinance') }}" method="get" class="input-group">
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
                                    <tr style="text-align: center;">
                                        <th>No</th>
                                        <th>Request By</th>
                                        <th>Deadline</th>
                                        <th style="white-space: nowrap">Request Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                    use Carbon\Carbon;
                                    foreach($datappb as $ppb){
                                        $created_at = Carbon::parse($ppb->created_at)->format('d-m-Y');
                                    }
                                @endphp
                                 @foreach ($datappb as $ppb)
                                 @if (
                                 $ppb->status == 'Unpaid'||
                                 $ppb->status == 'Paid'||
                                 $ppb->status == 'Delivery Process' ||
                                 $ppb->status == 'Delivery Success'||
                                 $ppb->status == 'Rejected by Finance')
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><a href="{{ route('menu-tasklist-finance.detail',$ppb->id) }}">
                                        <ul>
                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                            <li> {{ $ppb->desc }}</li>
                                        </ul>
                                    </a></td>
                                    <td style="white-space: nowrap; text-align:center;">
                                        @if($ppb->dateline == '≤24Jam')
                                        <strong><p>1 Hari</p></strong>
                                        @elseif ($ppb->dateline == '≤72Jam')
                                        <strong><p>2 sd 3 Hari</p></strong>
                                        @elseif ($ppb->dateline == '≤168Jam')
                                        <strong><p>4 sd 7 Hari</p></strong>
                                        @elseif ($ppb->dateline == '≤336Jam')
                                        <strong><p>7 sd 14 Hari</p></strong>
                                        @endif
                                    </td>
                                    <td style="font-weight: 700; text-align:center;">
                                        {{ $created_at }}
                                    </td>
                                    <td style="text-align: center;">
                                        <ul>
                                            @if($ppb->status == 'PO Rejected by BOD')
                                            <li>
                                                <a class="badge badge-danger mt-1 "
                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                </a>
                                            </li>
                                            <li class="badge badge-danger mt-2">{{ $ppb->note_bod_po }}</li>
                                            @elseif($ppb->status == 'Rejected by Purchasing')
                                            <li>
                                                <a class="badge badge-danger mt-1 "
                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                </a>
                                            </li>
                                            <li class="badge badge-danger mt-2">{{ $ppb->note_purchase }}</li>
                                            @elseif($ppb->status == 'Payment Rejected By BOD')
                                            <li>
                                                <a class="badge badge-danger mt-1 "
                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                </a>
                                            </li>
                                            <li class="badge badge-danger mt-2">{{ $ppb->note_bod_py }}</li>
                                            @elseif($ppb->status == 'Rejected by Finance')
                                            <li>
                                                <a class="badge badge-danger mt-1 "
                                                    style="color: white; font-size:10">{{ $ppb->status }}
                                                </a>
                                            </li>
                                            <li class="badge badge-danger mt-2">{{ $ppb->note_finance }}</li>
                                            @else
                                            <li><a class="badge badge-success mt-1 "
                                                style="color: white; font-size:10">{{ $ppb->status }}
                                            </a>
                                        </li>
                                            @endif
                                            <li></li>
                                        </ul>
                                    </td>

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
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
                <script>
                    $(document).ready(function() {

                        $('.servidelet  ebtn').click(function(e) {
                            e.preventDefault();
                            alert('hello');
                        });

                    });
                </script>
    </section>
@endsection
