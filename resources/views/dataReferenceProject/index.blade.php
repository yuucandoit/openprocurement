<title>Data Purpose</title>

@extends('layouts.master')

@section('main')
    <section>

        @foreach ($data as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3 text-center">
                            <span class="warning">
                                <img src="{{ asset('assets/images/warning.png') }}">
                            </span>
                            <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/project-reference/destroy/' . $a->id) }}" >
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
          <h1>Purpose</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Purpose</li>
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
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('/project-reference/create/') }}" class="btn btn-primary mb-3" ></i> Add <i class="fa fa-plus"></i></a>
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                 <tr style="text-align: center;">
                  <th>No</th>
                  <th>Name</th>
                  <th>Function</th>
                </tr>
              </thead>
              <tbody>
               @php
               $no = 1;
               @endphp
               @foreach ($data as $ws)
               <tr>
                <td style="text-align: center;">{{ $no++ }}</td>
                <td style="text-align: center;">{{ $ws->name }}</td>
                <td style="text-align: center;">
                  <a href="{{ url('/project-reference/edit/' . $ws->id) }}" class="btn btn-outline-warning" ><i class="fa fa-edit" title="Edit."></i></a> 
                 <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $ws->id }}" ><i class="fa fa-trash-o" title="Delete."></i></button>
                </td>

              </tr>
              {{-- @endif --}}
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Zero Configuration  Ends-->
{{-- 
        <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h1>Who Submitted</h1>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                            <a href="{{ url('who-submitted/create/') }}"
                                class="btn btn-primary mb-3"><i class="bx bx-list-plus"></i> Add+</a>
                        {{-- @if ($ws->status == 'Accepted') --}}
                            {{-- <a href={{ url('/export_excel/vendor/' . $ws->id) }}
                                class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a> --}}
                        {{-- @endif --}}
                        {{-- <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($data as $ws)
                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $ws->name }}</td>
                                    <td>
                                        <a href="{{ url('/who-submitted/edit/' . $ws->id) }}"
                                            class="btn btn-outline-info"><i class="bx bxs-edit"></i> Edit</a>
                                        <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $ws->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection
