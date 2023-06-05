<title>Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datappb as $ppb)
        <div class="modal fade" id="modalItem{{ $ppb->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">

                        <h4 class="modal-title" style="color: white">List Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        @php
                            $i = 1;
                        @endphp
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Uom</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ppb->itemppn as $item)
                                <tr>
                                    <td> {{ $item->item }}</td>
                                    <td> {{ $item->qty }}</td>
                                    <td> {{ $item->kategori }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                            <th>No.Pengajuan</th>
                                            <th>Request By</th>
                                            <th>Item</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
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
                                                    <td style="text-align: center;">
                                                        <ul>
                                                            {{-- <li>{{ $id_number }}/PB/SII/{{ $month }}/{{ $year }}</li> --}}
                                                            <li><a href="{{ url('menu-task-list/detail/' . $ppb->id) }}" >{{ $ppb->code_pengajuan }}</a></li>
                                                        </ul>
                                                    </td>
                                                    <td><a href="{{ url('menu-task-list/detail/' . $ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                            <li>{{ $ppb->desc }}</li>
                                                        </ul>

                                                    </a></td>
                                                    <td>
                                                        @foreach ($ppb->itemppn as $ice)
                                                            @php
                                                            $ipb = \App\Models\PengajuanPembelian::select(DB::raw('pp_id,SUM(qty) as qty'))->where('pp_id',$ice->pp_id)->groupBy('pp_id')->first();
                                                            @endphp
                                                        @endforeach
                                                        <ul>
                                                            <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ipb->qty }} Item </label></li>
                                                        </ul>

                                                    </td>
                                                    <td>
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
        const dataTask = @json($approvedPPB);
        const item = dataTask[0];

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (dataTask, elmnt) => {
            const {
                approved_at,
                dateline_time,
                datetime
            } = dataTask;

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
            var currentTimeExp = new Date();
            var remainingTimeExpired = Math.floor((currentTimeExp - dueDateAt.getTime()) / 1000);

            var expWeeks = Math.floor(remainingTimeExpired / (7 * 24 * 3600));
            remainingTimeExpired -= expWeeks * (7 * 24 * 3600);

            var expDays = Math.floor(remainingTimeExpired / (24 * 3600));
            remainingTimeExpired -= expDays * (24 * 3600);

            var expHours = Math.floor(remainingTimeExpired / 3600);
            remainingTimeExpired -= expHours * 3600;

            var expMinutes = Math.floor(remainingTimeExpired / 60);
            remainingTimeExpired -= expMinutes * 60;

            var expSeconds = remainingTimeExpired;

            var weeksDisplay = expWeeks > 0 ? `${expWeeks} week${expWeeks > 1 ? "s" : ""} ` : "";
            var daysDisplay = expDays > 0 ? `${expDays} day${expDays > 1 ? "s" : ""} ` : "";
            var hoursDisplay = expHours < 10 ? "0" + expHours : expHours;
            var minutesDisplay = expMinutes < 10 ? "0" + expMinutes : expMinutes;
            var secondsDisplay = expSeconds < 10 ? "0" + expSeconds : expSeconds;

            let countdown = `-${weeksDisplay}${daysDisplay}${hoursDisplay}:${minutesDisplay}:${secondsDisplay}`;
            return countdown;
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
        const initCountdown = (dataTask) => {
            dataTask.forEach(item => {
                if (!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#ppb-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(dataTask);
    </script>
@endsection
