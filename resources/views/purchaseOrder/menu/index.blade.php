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
                    <form action="{{ url('/menu-purchase-order/store') }}" id="formAdd" method="post"
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

    <!-- Page Sidebar Ends-->
    <div class="container-fluid">
        <div class="page-header">
          <div class="row">
            <div class="col-sm-6">
                <h3>Purchase Order</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Purchase Order</li>
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
            <h5>Purchase order data list</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                   <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Send To</th>
                    <th>Date Line</th>
                    <th>Countdown</th>
                    <th>Warning</th>
                    <th>Date</th>
                    @hasrole('purchasing|super admin')
                    <th>Status</th>
                    @endhasrole
                    @hasrole('user')
                    <th>Status</th>
                    @endhasrole
                    <th style="width: 700px;">Function</th>
                </tr>
            </thead>

            @php
            $no = 1;
            $approvedPPB = [];
            @endphp
            <tbody>
                @foreach ($datappb as $ppb)
                @if ($ppb->status == 'Purchase Proses' )
                @php $approvedPPB[] =$ppb; @endphp
                <tr id="ppb-{{ $ppb->id }}">
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
                    @hasrole('purchasing|super admin')
                    <td> <a class="badge {{ $ppb->status == '' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                        style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                    <td style="width: 700px;">
                        <a href="{{ url('/exportpdf/po/' . $ppb->id) }}" class=" btn btn-danger" type="button"><i class="icofont icofont-eye-alt" title="Preview PO"></i></a>

                        <a href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}" type="button" class=" btn btn-primary" ><i class="icofont icofont-papers" title="Record Data"></i></a>

                        <a href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}" type="button" class=" btn btn-warning" ><i class="icofont icofont-edit" title="Edit"></i></a>

                        <a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}"  type="button" class="btn btn-info" ><i class="icofont icofont-ebook" title="Detail"></i></a>

                        <a class="btn btn-danger" type="button" data-bs-toggle="modal"data-bs-target="#modalDelete{{ $ppb->id }}" ><i class="icofont icofont-trash" title="Delete"></i></a>

                        @if ($ppb->status == 'Waiting For PO Approval')
                        <button class="btn btn-success mt-2" data-bs-toggle="modal"
                        data-bs-target="#modalSelesai" disabled>Approval Request Sent
                        </button>
                        @elseif ($ppb->status == 'Purchase Proses')
                        <a class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalSelesai"><i class="icofont icofont-send-mail" title=" Send Approval Request For Purchase Order"></i></a>
                        @endif
                     </td>
                @endhasrole
                    </tr>
             @endif
             {{-- Start Modal Approval --}}
         <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                        <h2 class="modal-title" style="color: white">Warning</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center mb-3">
                        <span class="warning">
                            <img src="{{ asset('assets/images/warning.png') }}">
                        </span>
                        <h2 style="text-align: center">Make sure the data is correct!</h2>
                    </div>
                    <div class="modal-footer">
                        @if ($ppb->status == 'Purchase Proses')
                            <form
                            action="{{ url('menu-purchase-order/ajukan_keatasan', $ppb->id) }}">
                            <button type="submit" class="btn btn-outline-danger ">
                                Send Approval Request For Purchase Order
                            </button>
                            </form>
                            @endif
                    </div>
                    {{-- End Modal Approval --}}
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
