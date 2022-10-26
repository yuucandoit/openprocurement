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

            <!-- Page Sidebar Ends-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6 mt-4">
                            <h3>Delivery Process</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Delivery Process</li>
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
                    <!-- Zero Configuration  Starts-->
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5>Delivery Process</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Applicant Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $approvedPPB = [];
                                        @endphp
                                        <tbody>
                                            @foreach ($datappb as $ppb)
                                                @if ($ppb->status == 'Paid')
                                                    @php $approvedPPB[] =$ppb; @endphp
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                        <td style="text-align: center;">{{ $ppb->created_at }}</td>
                                                        @hasrole('purchasing|super admin')
                                                            <td style="text-align: center;">
                                                                <a href="{{ url('/delivery/create/'. $ppb->id) }}"  type="button" class="btn btn-success" ><i class="icofont icofont-data" title="Report Data"></i></a>

                                                                <a href="{{ url('/delivery/edit/' . $ppb->id) }}"  type="button" class="btn btn-warning" ><i class="fa fa-edit" title="Edit"></i></a>


                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #00008B;"
                                                                    href="{{ url('/delivery/detail/' . $ppb->id) }}"><i
                                                                        class="icon-zoom-in" title="Details"></i>
                                                                </a>

                                                                <button class="btn btn-danger mt-1" data-bs-toggle="modal"
                                                                    data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                        class="icon-trash" title="Delete"></i>
                                                                </button>
                                                            </td>
                                                        @endhasrole
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Zero Configuration  Ends-->
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

