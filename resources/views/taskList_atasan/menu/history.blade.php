<title>History Task List Super User</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datadv as $a)
            <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">Delete</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <div class="page-header mt-4">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>History Super User</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">History Super User</li>
                        </ol>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
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
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Data History List</h5>
                        </div>
                        <div class="card-body">
                            <div class="order-history table-responsive">
                                @if (Auth::user()->id === 3)
                                    <table class="table table-bordernone display" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Date Line</th>
                                                <th scope="col">Request By</th>
                                                <th scope="col">Approved At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if (($ppb->atasan == 3) | 3)
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ $ppb->desc }}"
                                                                target="_blank">{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                        <td style="text-align: center;">{{ $ppb->ws }}</td>
                                                        <td>{{ $ppb->approved_at }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            {{-- <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                                </a> --}}
                                                        </td>
                                                        <!-- <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                                                                                                                                                            style="color: white; font-size:18">{{ $ppb->status }}</a></td> -->
                                                    </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if (Auth::user()->id === 6)
                                    <table class="table table-bordernone display" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Date Line</th>
                                                <th scope="col">Request By</th>
                                                <th scope="col">Approved At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->atasan == 6)
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ $ppb->desc }}"
                                                                target="_blank">{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                        <td style="text-align: center;">{{ $ppb->ws }}</td>
                                                        <td>{{ $ppb->approved_at }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            {{-- <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                            </a> --}}
                                                        </td>
                                                        <!-- <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                                                                                                                                                        style="color: white; font-size:18">{{ $ppb->status }}</a></td> -->
                                                    </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if (Auth::user()->id === 7)
                                    <table class="table table-bordernone display" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Date Line</th>
                                                <th scope="col">Request By</th>
                                                <th scope="col">Approved At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->atasan == 7)
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ $ppb->desc }}"
                                                                target="_blank">{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                        <td style="text-align: center;">{{ $ppb->ws }}</td>
                                                        <td>{{ $ppb->approved_at }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            {{-- <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                        </a> --}}
                                                        </td>
                                                        <!-- <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                                                                                                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a></td> -->
                                                    </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if (Auth::user()->id === 8)
                                    <table class="table table-bordernone display" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Date Line</th>
                                                <th scope="col">Request By</th>
                                                <th scope="col">Approved At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->atasan == 8)
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ $ppb->desc }}"
                                                                target="_blank">{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                        <td style="text-align: center;">{{ $ppb->ws }}</td>
                                                        <td>{{ $ppb->approved_at }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            {{-- <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                        </a> --}}
                                                        </td>
                                                        <!-- <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                                                                                                                                                style="color: white; font-size:18">{{ $ppb->status }}</a></td> -->
                                                    </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if (Auth::user()->id === 9)
                                    <table class="table table-bordernone display" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Date Line</th>
                                                <th scope="col">Request By</th>
                                                <th scope="col">Approved At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datappb as $ppb)
                                            @if ($ppb->atasan == 9)
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td><a href="{{ $ppb->desc }}"
                                                                target="_blank">{{ $ppb->desc }}</a></td>
                                                        <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                        <td style="text-align: center;">{{ $ppb->ws }}</td>
                                                        <td>{{ $ppb->approved_at }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('menu-taskList-atasan/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>

                                                            {{-- <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ url('/menu-taskList-atasan/edit/' . $ppb->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                        </a> --}}
                                                        </td>
                                                        <!-- <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                                                                                                                                            style="color: white; font-size:18">{{ $ppb->status }}</a></td> -->
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
            </div>
            <!-- Container-fluid Ends                  -->
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
