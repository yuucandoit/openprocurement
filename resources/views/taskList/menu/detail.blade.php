<title>Detail Purchasing</title>

@extends('layouts.master')

@section('main')
<section>

 <!-- Page Sidebar Ends-->
 <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
            <h3>Details</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/menu-task-list') }}">Task List Purchasing</a></li>
                <li class="breadcrumb-item active">Details</li>
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
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">Details From {{ $data_pengajuan->whosubmit->name }}</h5>
      </div>
      <div class="card-body text-center">
        <table class="table table-bordered mt-4">
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
                    <td> {{ $data_pengajuan->referensi->name }}</td>
                </tr>
                <tr>
                    <td>Send To</td>
                    <td>{{ $data_pengajuan->send_to }}</td>
                </tr>
                <tr>
                    <td>Date Line</td>
                    <td>{{ $data_pengajuan->dateline }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-4 mb-4">
            <thead>
                <tr class="text-center">
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $p)
                <tr>
                    <td style="text-align: center;">{{ $p->item }}</td>
                    <td style="text-align: center;">{{ $p->qty }}</td>
                    <td style="text-align: center;">{{ $p->kategori }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

            <div class="mt-3">
                @hasrole('purchasing|super admin')
                @if ($data_pengajuan->status == 'Purchase Proses')
                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                class="btn btn-success text-center" onclick="return"><b>Approved</b></a>

                <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                class="btn btn-danger text-center" onclick="return">Reject</a>

                @elseif($data_pengajuan->status == 'Purchase Submission Approved')
                <a href="{{ url('menu-task-list/accept', $data_pengajuan->id) }}"
                    class="btn btn-success text-center" onclick="return">Approve</a>

                    <a href="{{ url('menu-task-list/reject', $data_pengajuan->id) }}"
                        class="btn btn-danger text-center" onclick="return">Reject</a>
                        @else
                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                        class="btn btn-success text-center" onclick="return">Approve</a>

                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                        class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>

                        @endif
                        @endhasrole


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
</div>
<!--
    {{-- <a href={{ url('#')('/export_excel/pengajuan_pembelian/' . $data_pengajuan->id) class="btn btn-success" style="align-self: flex-end"> Export to Excel</a> -- }} --}}-->
    <a type="reset" class="btn btn-danger" href="{{ url('/menu-task-list/') }}">Back</a>
</section>
@endsection
