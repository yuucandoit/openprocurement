<title>Task List Finance</title>

@extends('layouts.master')

@section('main')
    <section>
    
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Task List Finance</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Task List Finance</li>
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
                                        <form action="{{ route('menu-tasklist-finance.SearchTaskFinance') }}" method="get" class="input-group">
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
                                            <th style="text-align: center;">No</th>
                                            <th>Request By</th>
                                            <th>Description</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Function</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Payment Approved')
                                            <tr>
                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                <td style="font-weight:600;">{{ $ppb->whosubmit->name }}</td>
                                                <td><a href="{{ url('menu-tasklist-finance/detail/' . $ppb->id)}}" >{{ $ppb->desc }}</a>
                                                </td>
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
                                                </td>
                                                <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Invoicing Process' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:12">{{ $ppb->status }}</a></td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                        href="{{ url('menu-tasklist-finance/detail/' . $ppb->id) }}"><i
                                                            class="icon-zoom-in" title="Details"></i>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>


    </section>
@endsection
