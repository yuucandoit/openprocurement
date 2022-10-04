<title>History Task List Purchase Order</title>

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
                <div class="container-fluid">
                    <div class="row">
                        <div class="card shadow mb-5">
                            <div class="card-body">
                                <h3>Task List</h3>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Description</th>
                                            <th>Date Line</th>
                                            <th>Request By</th>
                                            <th>Function</th>
                                        </tr>
                                    </thead>
                                    @php
                                    $no = 1;
                                    @endphp
                                     @foreach ($datappb as $ppb)
                                     @if ($ppb->status == 'Done' )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $ppb->desc }}</td>
                                        <td>{{ $ppb->dateline }}</td>
                                        <td>{{ $ppb->ws }}</td>
                                        <td>
                                        <a href="{{ url('menu-task-list/detail/' .  $ppb->id) }}"
                                        class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                        <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                            style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
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
