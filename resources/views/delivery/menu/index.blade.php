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

            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6 mt-4">
                            <h3>Delivery Process</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Delivery Process</li>
                            </ol>
                        </div>
                        {{-- <div class="col-sm-6 mt-4">
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
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5>Shipping Process In List</h5>
                            </div>
                            <div class="mt-4">
                                <div style="max-width: 50%;" class="pull-right">
                                    <form action="{{ route('delivery.SearchDeliveryIn') }}" method="get" class="input-group" >
                                        <input type="text" name="cariIn" class="form-control " placeholder="Search ..." value="{{ request('cariIn') }}">
                                        <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" >
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Applicant Name</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $approvedPPB = [];
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                        @endphp
                                        <tbody>
                                            @foreach ($datappb as $ppb)
                                                @if ($ppb->status == 'Paid')
                                                    @php $approvedPPB[] =$ppb; @endphp
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            <ul>
                                                                <li><a href="{{ url('/delivery/detail/' . $ppb->id) }}"><strong>{{ Carbon\Carbon::parse($ppb->date_ps)->format('d-m-Y') }}</strong></a></li>
                                                                <li>{{ $ppb->whosubmit->name }}</li>
                                                            </ul>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if($ppb->status == 'Paid')
                                                            <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting For Process</a>
                                                            @endif
                                                        </td>
                                                        @hasrole('purchasing|super admin')
                                                            <td style="text-align: center;">
                                                                <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #008b2c;font-size:10;"
                                                                    href="{{ url('/delivery/create/' . $ppb->id) }}">
                                                                    <i class="icon-file" title="Create"></i>
                                                                </a>

                                                                    {{-- <a class="btn btn-iconsolid mt-1"
                                                                        style="background-color: #00008B;"
                                                                        href="{{ url('/delivery/detail/' . $ppb->id) }}"><i
                                                                            class="icon-zoom-in" title="Details"></i>
                                                                    </a> --}}

                                                                    <button class="btn btn-iconsolid mt-1" data-bs-toggle="modal"
                                                                    style="background-color: #ff0000; font-size:10;"
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
                                    <div class="mt-4">
                                        {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container-fluid Ends -->
                    </div>
                </div>
            </div>

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5>Shipping Process Out List</h5>
                            </div>
                            <div class="mt-4">
                                <div style="max-width: 50%;" class="pull-right">
                                    <form action="{{ route('delivery.SearchDeliveryOut') }}" method="get" class="input-group" >
                                        <input type="text" name="cariOut" class="form-control " placeholder="Search ..." value="{{ request('cariOut') }}">
                                        <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover display">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Applicant Name</th>
                                                <th style="text-align: center;">Status</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                            $approvedPPB = [];
                                            $i = 1 + $datappb2->currentPage() * $datappb2->perPage() - $datappb2->perPage();
                                        @endphp
                                        <tbody>
                                            @foreach ($datappb2 as $ppb)
                                                @if ($ppb->status == 'Delivery Success')
                                                    @php $approvedPPB[] =$ppb; @endphp
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>
                                                            <ul>
                                                                <li><a href="{{ url('/delivery/detail/' . $ppb->id) }}"><strong>{{ Carbon\Carbon::parse($ppb->date_ps)->format('d-m-Y') }}</strong></a></li>
                                                                <li>{{ $ppb->whosubmit->name }}</li>
                                                            </ul>
                                                            {{-- <a href="{{ url('/delivery/detail/' . $ppb->id) }}">{{ $ppb->whosubmit->name }}</a> --}}
                                                        </td>
                                                        <td style="text-align: center">
                                                            @if($ppb->status == 'Delivery Success')
                                                            <a class="badge bg-success mt-1" style="color: white; font-size:12">Request Completed</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-4">
                                        {{ $datappb2->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container-fluid Ends -->
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
            console.log(data);

            // FOR CALCULATE REMAINING DEADLINE TIME 😃
            const remainingTime = (data, elmnt) => {
                const {
                    approved_at,
                    dateline_time,
                    datetime
                } = data;
                const approvedAt = new Date(approved_at);
                const dueDateTime = new Date(`1970-01-01T${dateline_time}Z`);
                const dueDateAt = new Date(approvedAt.getTime() + dueDateTime.getTime());
                const remainingTime = new Date(dueDateAt.getTime() - Date.now());

                if (remainingTime.getTime() < 1) return "Your time is up";

                let colors = [];
                const lable = elmnt.querySelector('.badge-lable');
                const hours = remainingTime.getUTCHours().toString();
                const minutes = remainingTime.getUTCMinutes().toString();
                const seconds = remainingTime.getUTCSeconds().toString();

                if (data.dateline == '≤3Jam') colors = [
                    [1, 'bg-danger'],
                    [2, 'bg-warning'],
                    [3, 'bg-success'],
                ]
                if (data.dateline == '≤24Jam') colors = [
                    [8, 'bg-danger'],
                    [16, 'bg-warning'],
                    [24, 'bg-success'],
                ]
                if (data.dateline == '≤2Hari') colors = [
                    [16, 'bg-danger'],
                    [32, 'bg-warning'],
                    [48, 'bg-success'],
                ]

                lable.classList.remove('bg-danger');
                lable.classList.remove('bg-warning');
                lable.classList.remove('bg-success');
                lable.classList.add(colors.find(item => item[0] > hours)[1]);

                return (
                    (hours.length == 1 ? `0${hours}:` : `${hours}:`) +
                    (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                    (seconds.length == 1 ? `0${seconds}:` : `${seconds}`)
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
