<title>Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datappb as $a)
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
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Task List Purchasing</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Task List Purchase order</li>
                        </ol>
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
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('menu-task-list.SearchtaskPOIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ request('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Request By</th>
                                            <th>Item</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Approved At</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $approvedPPB = [];
                                    @endphp
                                    @foreach ($datappb as $ppb)
                                        @if ($ppb->status == 'Purchase Request Approved')
                                            @php $approvedPPB[] =$ppb; @endphp
                                            <tbody>
                                                <tr id="ppb-{{ $ppb->id }}">
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td><a href="{{ url('menu-task-list/detail/' . $ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                            <li>{{ $ppb->desc }}</li>
                                                        </ul>

                                                    </a></td>
                                                    <td>
                                                        @foreach ($ppb->itemppn as $item)
                                                        <ul>
                                                            <li style="margin-top:4px;">-{{ $item->item }}</li>
                                                        </ul>
                                                        @endforeach
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <ul>
                                                            <li style="white-space: nowrap;">
                                                                <p class="ppb-countdown"></p>
                                                            </li>
                                                            <li style="white-space: nowrap;">
                                                                @if($ppb->dateline == '≤24Jam')
                                                                <strong><p>1 Hari</p></strong>
                                                                @elseif ($ppb->dateline == '≤72Jam')
                                                                <strong><p>2 sd 3 Hari</p></strong>
                                                                @elseif ($ppb->dateline == '≤168Jam')
                                                                <strong><p>4 sd 7 Hari</p></strong>
                                                                @elseif ($ppb->dateline == '≤336Jam')
                                                                <strong><p>7 sd 14 Hari</p></strong>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <ul>
                                                            <li>
                                                                <a class="badge badge-lable" style="font-size: 10">
                                                                    Complete This Task!
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="badge"
                                                                    style="color: white; background-color:rgb(255, 132, 0); font-size:10">
                                                                    @if($ppb->status == 'Purchase Request Approved')
                                                                    Waiting Process
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td style="text-align: center; font-size:12;"><strong>{{ Carbon\Carbon::parse($ppb->approved_at)->format('d-m-Y H:i:s') }}</strong></td>
                                                    {{-- <td>{{ $ppb->whosubmit->name }}</td>
                                                        <td style="text-align: center;">
                                                            <a class="btn btn-iconsolid mt-1" style="background-color: #00008B;"
                                                                href="{{ url('menu-task-list/detail/' . $ppb->id) }}"><i
                                                                    class="icon-zoom-in" title="Details"></i>
                                                            </a>
                                                        </td> --}}
                                                </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>

    <!-- Container-fluid starts-->
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
            const lable = elmnt.querySelector('.badge-lable');

            console.log(dateline_time, remainingTime.getTime());

            if (remainingTime.getTime() < 1) {
                lable.classList.remove('bg-dark');
                lable.classList.add('bg-dark');
                return "Your time is up";
            }

            let colors = [];
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
