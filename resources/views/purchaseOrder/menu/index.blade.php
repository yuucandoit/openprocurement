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
                            <h3>Purchase Order</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Purchase Order</li>
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
                                    <li><a href="javascript:void(0)"><i class="bookmark-search"
                                                data-feather="star"></i></a>
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

            {{-- Purchase Order --}}
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <!-- Zero Configuration  Starts-->
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5>Purchase order data list In</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="basic-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Send To</th>
                                                <th>Date Line</th>
                                                <th>Countdown</th>
                                                <th>Warning</th>
                                                @hasrole('purchasing|super admin')
                                                    <th>Status</th>
                                                @endhasrole
                                                @hasrole('user')
                                                    <th>Status</th>
                                                @endhasrole
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
                                                @if ($ppb->status == 'Purchase Proses')
                                                    @php $approvedPPB[] =$ppb; @endphp
                                                    <tr id="ppb-{{ $ppb->id }}">
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                        <td style="text-align: center;">{{ $ppb->send_to }}</td>
                                                        @if ($ppb->status == 'Purchase Proses')
                                                            <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                            <td class="ppb-countdown"></td>
                                                            <td>
                                                                <a class="badge badge-lable" style="font-size: 18">
                                                                    Complete This Task!
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a class="badge {{ $ppb->status == '' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                    style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                            </td>
                                                        @else
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                        @endif
                                                        <td style="text-align: center;">{{ $ppb->approved_at }}</td>
                                                        @hasrole('purchasing|super admin')
                                                            <td>
                                                                <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #0014FF;"
                                                                href="{{ url('/exportpdf/ppb/' . $ppb->id) }}"><i
                                                                    class="icon-eye" title="Preview PDF Purchase request"></i>
                                                                </a>

                                                                <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #B1D0E0;"
                                                                href="{{ url('/exportpdf/po/' . $ppb->id) }}"><i
                                                                    class="icon-eye" title="Preview Purchase Order"></i>
                                                            </a>

                                                                <a class="btn btn-iconsolid mt-1"
                                                                style=  "background-color: #008000;"
                                                                href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                    class="icon-file" title="Record Data"></i>
                                                                </a>

                                                                    <a class="btn btn-iconsolid mt-1"
                                                                        style="background-color: #FF8C00;"
                                                                        href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}"><i
                                                                            class="icon-pencil-alt" title="Edit"></i>
                                                                    </a>
                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #00008B;"
                                                                    href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}"><i
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
                </div>
          </div>

            {{-- History  --}}
              <!-- Container-fluid starts-->
              <div class="container-fluid">
                <div class="row">
                    <!-- Zero Configuration  Starts-->
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5>Purchase order data list Out</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display" id="advance-1">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Send To</th>
                                                <th>Date Line</th>
                                                <th>Countdown</th>
                                                <th>Warning</th>
                                                @hasrole('purchasing|super admin')
                                                    <th>Status</th>
                                                @endhasrole
                                                @hasrole('user')
                                                    <th>Status</th>
                                                @endhasrole
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        @php
                                            $no = 1;
                                        @endphp
                                        <tbody>
                                            @foreach ($datahstry as $ppb)
                                                @if (
                                                    $ppb->status == 'Waiting For PO Approval' ||
                                                    $ppb->status == 'PO Approved' ||
                                                    $ppb->status == 'Invoicing Process' ||
                                                    $ppb->status == 'Unpaid' ||
                                                    $ppb->status == 'Paid' ||
                                                    $ppb->status == 'Delivery Process' ||
                                                    $ppb->status == 'Delivery Success')
                                                    <tr>
                                                        <td style="text-align: center;">{{ $no++ }}</td>
                                                        <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                        <td style="text-align: center;">{{ $ppb->send_to }}</td>
                                                        @if ($ppb->status == 'Purchase Proses')

                                                        @else
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                        @endif
                                                        <td style="text-align: center;">{{ $ppb->approved_at }}</td>
                                                        @hasrole('purchasing|super admin')
                                                            <td>
                                                                <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #0014FF;"
                                                                href="{{ url('/exportpdf/ppb/' . $ppb->id) }}"><i
                                                                    class="icon-eye" title="Preview PDF Purchase request"></i>
                                                                </a>

                                                                <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #B1D0E0;"
                                                                href="{{ url('/exportpdf/po/' . $ppb->id) }}"><i
                                                                    class="icon-eye" title="Preview Purchase Order"></i>
                                                            </a>
                                                                @if ($ppb->status == 'Purchase Proses')
                                                                    <a class="btn btn-iconsolid mt-1"
                                                                        style="background-color: #008000;"
                                                                        href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                            class="icon-file" title="Record Data"></i>
                                                                    </a>

                                                                    <a class="btn btn-iconsolid mt-1"
                                                                        style="background-color: #FF8C00;"
                                                                        href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}"><i
                                                                            class="icon-pencil-alt" title="Edit"></i>
                                                                    </a>
                                                                @endif
                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #00008B;"
                                                                    href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}"><i
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
        const item = data[0];

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (data, elmnt) => {
            const {
                approved_at,
                dateline_time,
                datetime
            } = data;

            const dateline = {
                day     : () => dateline.toDigit(Math.floor(parseInt(dateline.split()[0])/24.1) || 1),
                hours   : () => dateline.toDigit(Math.floor(parseInt(dateline.split()[0])%24.1)),
                minutes : () => dateline.split()[1],
                seconds : () => dateline.split()[2],
                time    : () => `${dateline.hours()}:${dateline.minutes()}:${dateline.seconds()}`,
                split   : () => dateline_time.split(':'),
                toDigit : (val) => val > 9 ? val : '0'+val,
            }

            const approvedAt = new Date(approved_at);
            const dueDateTime = new Date(`1970-01-${dateline.day()}T${dateline.time()}Z`);
            const dueDateAt = new Date(approvedAt.getTime() + dueDateTime.getTime());
            const remainingTime = new Date(dueDateAt.getTime() - Date.now());

            console.log(dateline_time, remainingTime.getTime());

            if (remainingTime.getTime() < 1) return "Your time is up";

            let colors = [];
            const lable = elmnt.querySelector('.badge-lable');
            const days  = dateline.split()[0] == 24 ? (remainingTime.getDate()-2).toString() : (remainingTime.getDate()-1).toString();
            const hours = remainingTime.getUTCHours().toString();
            const minutes = remainingTime.getUTCMinutes().toString();
            const seconds = remainingTime.getUTCSeconds().toString();

            lable.classList.remove('bg-danger');
            lable.classList.remove('bg-warning');
            lable.classList.remove('bg-success');

            // SUDAH OTOMATIS HITUNG DISINI YAAAAA 😁
            lable.classList.add((() => {
                const dueDate   = dueDateTime.getTime();
                const remaining = remainingTime.getTime();

                if(remaining <= 60*60*1000) return 'bg-dark';
                if(remaining <= dueDate*1/3) return'bg-danger';
                if(remaining <= dueDate*2/3) return'bg-warning';
                if(remaining <= dueDate*3/3) return'bg-success';
            })());

            return (
                (days.length == 1 ? `0${days}:` : `${days}:`)+
                (hours.length == 1 ? `0${hours}:` : `${hours}:`) +
                (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                (seconds.length == 1 ? `0${seconds}` : `${seconds}`)
            );
        }

        // FOR HANDLE REWRITE ELEMENT 😃
        const countdownHandle = (elmnt, item) => {
            const countdownElmnt = elmnt.querySelector('.ppb-countdown');
            countdownElmnt.innerText = remainingTime(item, elmnt);
        }

        // FOR INITIALIZE COUNTDOWN 😃
        const initCountdown = (data) => {
            data.forEach(item => {
                if (!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#ppb-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(data);
    </script>
@endsection
