<title>Task List Atasan</title>

@extends('layouts.master')

@section('main')
<section>


    @foreach ($datadv as $a)
    <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
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
                    <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}">
                        <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                        Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <!-- Page Sidebar Ends-->
    <div class="container-fluid">
        <div class="page-header">
          <div class="row">
            <div class="col-sm-6">
                <h2>Task List</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Task List</li>
                </ol>
            </div>
            <div class="col-sm-6">
              <!-- Bookmark Start-->
              <div class="bookmark">
                <ul>
                  <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                  <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                  <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                  <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
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
</div>
</div>
</div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
      <!-- Zero Configuration  Starts-->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Task List Purchase Submission</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (Auth::user()->id === 3)
                <table class="display" id="basic-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Date Line</th>
                            <th>Request By</th>
                            <th>Function</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($datappb as $ppb)
                    @if ($ppb->status == 'Awaiting Purchase Submission Approval')
                    <tbody>
                        <tr>
                            @if ($ppb->atasan == 3)
                            <td>{{ $no++ }}</td>
                            <td><a href="{{ $ppb->desc }}" target="_blank">{{ $ppb->desc }}</a></td>
                            <td>{{ $ppb->dateline }}</td>
                            <td>{{ $ppb->whosubmit->name }}</td>
                            <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                @endif
                                <td>
                                    <a href="{{ url('menu-taskList-atasan/detail/' .  $ppb->id) }}"
                                        class="btn btn-outline-info"><i class="fa fa-search-plus" title="Detail"></i></a>
                                        <a href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"
                                            class="btn btn-outline-warning"><i class="fa fa-edit" title="Edit"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            @if (Auth::user()->id === 6)
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>No</th>
                                        <th>Description</th>
                                        <th>Date Line</th>
                                        <th>Request By</th>
                                        <th>Function</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($datappb as $ppb)
                                @if ($ppb->status == 'Awaiting Purchase Submission Approval')
                                <tbody>
                                    <tr>
                                        @if ($ppb->atasan == 6)
                                        <td style="text-align: center;">{{ $no++ }}</td>
                                        <td><a href="{{ $ppb->desc }}" target="_blank">{{ $ppb->desc }}</a></td>
                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                        <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                            style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                            @endif
                                            <td style="text-align: center;">
                                                <a href="{{ url('menu-taskList-atasan/detail/' .  $ppb->id) }}"
                                                    class="btn btn-outline-info"><i class="fa fa-search-plus" title="Detail"></i></a>
                                                    <a href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"
                                                        class="btn btn-outline-warning"><i class="fa fa-edit" title="Edit"></i></a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif

                                        @if (Auth::user()->id === 7)
                                        <table class="display" id="basic-1">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>No</th>
                                                    <th>Description</th>
                                                    <th>Date Line</th>
                                                    <th>Request By</th>
                                                    <th>Function</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            @php
                                            $no = 1;
                                            @endphp
                                            @foreach ($datappb as $ppb)
                                            @if ($ppb->status == 'Awaiting Purchase Submission Approval')
                                            <tbody>
                                                <tr>
                                                    @if ($ppb->atasan == 7)
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td><a href="{{ $ppb->desc }}" target="_blank">{{ $ppb->desc }}</a></td>
                                                    <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                    <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                    <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                                        @endif
                                                        <td style="text-align: center;">
                                                            <a href="{{ url('menu-taskList-atasan/detail/' .  $ppb->id) }}"
                                                                class="btn btn-outline-info"><i class="fa fa-search-plus" title="Detail"></i></a>

                                                                <a href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"
                                                                    class="btn btn-outline-warning"><i class="fa fa-edit" title="Edit"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif

                                                    @if (Auth::user()->id === 8)
                                                    <table class="display" id="basic-1">
                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th>No</th>
                                                                <th>Description</th>
                                                                <th>Date Line</th>
                                                                <th>Request By</th>
                                                                <th>Function</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        @php
                                                        $no = 1;
                                                        @endphp
                                                        @foreach ($datappb as $ppb)
                                                        @if ($ppb->status == 'Awaiting Purchase Submission Approval')
                                                        <tbody>
                                                            <tr>
                                                                @if ($ppb->atasan == 8)
                                                                <td style="text-align: center;">{{ $no++ }}</td>
                                                                <td><a href="{{ $ppb->desc }}" target="_blank">{{ $ppb->desc }}</a></td>
                                                                <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                                <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                                <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                                                    @endif
                                                                    <td style="text-align: center;">
                                                                        <a href="{{ url('menu-taskList-atasan/detail/' .  $ppb->id) }}"
                                                                            class="btn btn-outline-info"><i class="fa fa-search-plus" title="Detail"></i></a>

                                                                            <a href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"
                                                                                class="btn btn-outline-warning"><i class="fa fa-edit" title="Edit"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                @endif

                                                                @if (Auth::user()->id === 9)
                                                                <table class="display" id="basic-1">
                                                                    <thead>
                                                                        <tr style="text-align: center;">
                                                                            <th>No</th>
                                                                            <th>Description</th>
                                                                            <th>Date Line</th>
                                                                            <th>Request By</th>
                                                                            <th>Function</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    @php
                                                                    $no = 1;
                                                                    @endphp
                                                                    @foreach ($datappb as $ppb)
                                                                    @if ($ppb->status == 'Awaiting Purchase Submission Approval')
                                                                    <tbody>
                                                                        <tr>
                                                                            @if ($ppb->atasan == 9)
                                                                            <td style="text-align: center;">{{ $no++ }}</td>
                                                                            <td><a href="{{ $ppb->desc }}" target="_blank">{{ $ppb->desc }}</a></td>
                                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                                            <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                                            <td style="text-align: center;">
                                                                                <a href="{{ url('menu-taskList-atasan/detail/' .  $ppb->id) }}"
                                                                                    class="btn btn-outline-info"><i class="fa fa-search" title="Detail"></i></a>

                                                                                    <a href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"
                                                                                        class="btn btn-outline-warning"><i class="fa fa-edit" title="Edit"></i></a>
                                                                                    </td>
                                                                                    <td style="text-align: center;"> <a class="badge {{ $ppb->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                                        style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                                                                        @endif
                                                                                    </tr>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                            @endif


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Zero Configuration  Ends-->
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
