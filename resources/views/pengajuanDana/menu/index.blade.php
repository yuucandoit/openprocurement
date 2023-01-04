<title>Payment Process</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Payment Process</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payment Process</li>
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
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Payment Process In</h5>
                        </div>
                        <div class="mt-4">
                            <div style="max-width: 50%;" class="pull-right">
                                <form action="{{ route('menu-pengajuan-dana.SearchPDIn') }}" method="get" class="input-group disabled" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ old('cari') }}" disabled>
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go" disabled></span>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th><input type="checkbox" id="head-cb"></th>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            {{-- <th>Send To</th> --}}
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
                                                    <td style="text-align: center;"><input type="checkbox" name=""
                                                            id=""></td>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                    <td style="text-align: center;"><a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                    {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}
                                                    <td style="text-align: center;">{{ $ppb->dateline }}</td   >
                                                    <td class="ppb-countdown" style="text-align: center;"></td>
                                                    <td style="text-align: center;">
                                                        <a class="badge badge-lable" style="font-size: 18">
                                                            Complete This Task!
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center;">{{ $ppb->created_at }}</td>
                                                    @hasrole('finance|super admin')
                                                        <td>
                                                            <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                        </td>

                                                        <td>
                                                            <a class="btn btn-iconsolid mt-1 mx-2"
                                                                    style="background-color: #ADD8E6;"
                                                                    href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}"><i
                                                                        class="icon-eye" title="Preview PDF"></i>
                                                                </a>

                                                            <a class="btn btn-iconsolid mt-1 mx-2"
                                                                    style="background-color: #008b2c;"
                                                                    href="{{ url('/menu-pengajuan-dana/create/' . $ppb->id) }}"><i
                                                                        class="icon-file" title="Create"></i>
                                                            </a>

                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}"><i
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
                                {{ $datappb->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Payment Process Out</h5>
                        </div>
                        <div class="mt-4">
                            <div style="max-width: 50%;" class="pull-right">
                                <form action="{{ route('menu-pengajuan-dana.SearchPDOut') }}" method="get" class="input-group disabled" >
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ old('cari') }}" disabled>
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go" disabled></span>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            {{-- <th>Send To</th> --}}
                                            <th>Date Line</th>
                                            <th>Date</th>
                                            @hasrole('finance|super admin')
                                                <th>Status</th>
                                            @endhasrole
                                            <th>Function</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($datappb2 as $ppb)
                                            @if ($ppb->status == 'Paid'||
                                                $ppb->status == 'Delivery Process'||
                                                $ppb->status == 'Delivery Success')
                                                @php $approvedPPB[] =$ppb; @endphp
                                                <tr>
                                                    <td style="text-align: center;">{{ $no++ }}</td>
                                                    <td style="text-align: center;">{{ $ppb->whosubmit->name }}</td>
                                                    <td style="text-align: center;"><a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td>
                                                    {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}
                                                    <td style="text-align: center;">{{ $ppb->dateline }}</td>
                                                    <td style="text-align: center;">{{ $ppb->created_at }}</td>
                                                    @hasrole('finance|super admin')
                                                        <td>
                                                            <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'Rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:18">{{ $ppb->status }}</a>
                                                        </td>

                                                        <td>
                                                            <a class="btn btn-iconsolid mt-1"
                                                            style="background-color: #ADD8E6;"
                                                            href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}"><i
                                                                class="icon-eye" title="Preview PDF"></i>
                                                            </a>
                                                            <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #00008B;"
                                                                href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}"><i
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
                                <div class="mt-4">
                                    {{ $datappb2->appends(['out'=> request('out')],'out')->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
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
