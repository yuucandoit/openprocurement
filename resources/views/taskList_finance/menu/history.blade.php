<title>Task List Finance</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
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
                        <div class="col-sm-8"></div>
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
                                 $ppb->status == 'Delivery Success')
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><a href="{{ $ppb->desc }}" target="_blank">
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
                                    <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Invoicing Process' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                        style="color: white; font-size:12">{{ $ppb->status }}</a>
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
