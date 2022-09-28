<title>Purchase order</title>

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
                                    <input type="text" class="form-control mt-2" id="floatingName" placeholder="Your Name"
                                        name="name">
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
            <div class="modal fade" id="modalDelete{{ $purchase->id }}"  tabindex="-1" aria-hidden="true">
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

        <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h1>Purchase Order</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        @foreach ($datappb as $purchase)
                        {{-- <a href={{ url('/export_excel/purchase_order/' . $purchase->id) }}
                            class="btn btn-success mb-3 mr-1" style="align-self: flex-end"> Export to Excel</a> --}}

                        @endforeach
                        {{-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add+</button> --}}
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Send To</th>
                                    <th>Date Line</th>
                                    <th>Countdown</th>
                                    <th>Date</th>
                                     @hasrole('purchasing|super admin')
                                        <th>Status</th>
                                    @endhasrole
                                    {{--
                                    <th>Action</th>
                                    @hasrole('admin|super admin')
                                        <th>Accept</th>
                                        <th>Reject</th>
                                    @endhasrole --}}
                                    @hasrole('user')
                                        <th>Status</th>
                                    @endhasrole
                                    <th>Function</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            <tbody>
                                @foreach ($datappb as $purchase)
                                @if ($purchase->status == 'Accepted by Purchasing'|| 'Approved by Super user' )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $purchase->ws }}</td>
                                        <td>{{ $purchase->send_to }}</td>
                                        <td>{{ $purchase->dateline }}</td>
                                        <td id="countdown-{{ $purchase->id }}"></td>
                                        <td>{{ $purchase->created_at }}</td>
                                        @hasrole('purchasing|super admin')
                                        <td> <a class="badge {{ $purchase->status == 'pending' ? 'bg-warning' : ($purchase->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                            style="color: white; font-size:18">{{ $purchase->status }}</a></td>

                                        <td>
                                            <a href="{{ url('/menu-purchase-order/edit/' . $purchase->id) }}"
                                                class="btn btn-outline-warning"><i class="bx bx-edit"></i> Add+</a>
                                           <a href="{{ url('/menu-purchase-order/detail/' . $purchase->id) }}"
                                                class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                                <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $purchase->id }}">Delete</button>
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
@section('scripts')
    <script>
        const data = @json($datappb);
        const item =data[0];
        console.log(data);

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (data) => {
            const { approved_at, dateline_time , datetime } = data;
            const approvedAt    = new Date(approved_at);
            const dueDateTime   = new Date(`1970-01-01T${dateline_time}Z`);
            const dueDateAt     = new Date(approvedAt.getTime() + dueDateTime.getTime());
            const remainingTime = new Date(dueDateAt.getTime() - Date.now());

            console.log(remainingTime.getTime());
            if(remainingTime.getTime() < 1) return "Waktu Anda Sudah Habis";

            const hours   = remainingTime.getUTCHours().toString();
            const minutes = remainingTime.getUTCMinutes().toString();
            const seconds = remainingTime.getUTCSeconds().toString();

            return (
                (hours.length   == 1 ? `0${hours}:`   : `${hours}:`) +
                (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                (seconds.length == 1 ? `0${seconds}:` : `${seconds}`)
            );
        }

        // FOR HANDLE REWRITE ELEMENT 😃
        const countdownHandle = (elmnt, item) => {
            elmnt.innerText = remainingTime(item);
        }

        // FOR INITIALIZE COUNTDOWN 😃
        const initCountdown = (data) => {
            data.forEach(item => {
                if(!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#countdown-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(data);
    </script>
@endsection
