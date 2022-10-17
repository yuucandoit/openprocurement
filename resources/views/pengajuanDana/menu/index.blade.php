<title>Purchase Funding</title>

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
                    <h1>Purchase Funding</h1>
                </div>
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="head-cb"></th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Send To</th>
                                    <th>Date Line</th>
                                    <th>Countdown</th>
                                    <th>Warning</th>
                                    <th>Date</th>
                                    @hasrole('finance|super admin')
                                        <th>Status</th>
                                    @endhasrole
                                    <th>Function</th>
                                </tr>
                            </thead>
                            @php
                            $no = 1;
                            $approvedPPB = [];
                            @endphp
                            <tbody>
                                @foreach ($datappb as $ppb)
                                    @if ($ppb->status == 'Unpaid')
                                    @php $approvedPPB[] =$ppb; @endphp
                                    <tr id="ppb-{{ $ppb->id }}">
                                        <td><input type="checkbox" name="" id=""></td>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $ppb->whosubmit->name }}</td>
                                        <td>{{ $ppb->send_to }}</td>
                                        <td>{{ $ppb->dateline }}</td>
                                        <td class="ppb-countdown"></td>
                                        <td>
                                            <a class="badge badge-lable" style="font-size: 18">
                                                Complete This Task!
                                            </a>
                                        </td>
                                        <td>{{ $ppb->created_at }}</td>
                                        @hasrole('finance|super admin')
                                        <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                            style="color: white; font-size:18">{{ $ppb->status }}</a></td>

                                        <td>
                                           <a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}"
                                                class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                                <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $ppb->id }}">Delete</button>
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
    {{-- <script src="{{  }}"></script> --}}
    <script>
        const data = @json($approvedPPB);
        const item =data[0];
        console.log(data);

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (data, elmnt) => {
            const { approved_at, dateline_time , datetime } = data;
            const approvedAt    = new Date(approved_at);
            const dueDateTime   = new Date(`1970-01-01T${dateline_time}Z`);
            const dueDateAt     = new Date(approvedAt.getTime() + dueDateTime.getTime());
            const remainingTime = new Date(dueDateAt.getTime() - Date.now());

            if(remainingTime.getTime() < 1) return "Your time is up";

            let colors    = [];
            const lable   = elmnt.querySelector('.badge-lable');
            const hours   = remainingTime.getUTCHours().toString();
            const minutes = remainingTime.getUTCMinutes().toString();
            const seconds = remainingTime.getUTCSeconds().toString();

            if(data.dateline == '≤3Jam') colors = [
                [1, 'bg-danger'],
                [2, 'bg-warning'],
                [3, 'bg-success'],
            ]
            if(data.dateline == '≤24Jam') colors = [
                [8, 'bg-danger'],
                [16, 'bg-warning'],
                [24, 'bg-success'],
            ]
            if(data.dateline == '≤2Hari') colors = [
                [16, 'bg-danger'],
                [32, 'bg-warning'],
                [48, 'bg-success'],
            ]

            lable.classList.remove('bg-danger'); lable.classList.remove('bg-warning'); lable.classList.remove('bg-success');
            lable.classList.add(colors.find(item => item[0] > hours)[1]);

            return (
                (hours.length   == 1 ? `0${hours}:`   : `${hours}:`) +
                (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                (seconds.length == 1 ? `0${seconds}:` : `${seconds}`)
            );
        }

        // FOR HANDLE REWRITE ELEMENT 😃
        const countdownHandle = (elmnt, item) => {
            const countdownElmnt     = elmnt.querySelector('.ppb-countdown');
            countdownElmnt.innerText = remainingTime(item, elmnt);
        }

        // FOR INITIALIZE COUNTDOWN 😃
        const initCountdown = (data) => {
            data.forEach(item => {
                if(!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#ppb-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(data);
    </script>
@endsection
