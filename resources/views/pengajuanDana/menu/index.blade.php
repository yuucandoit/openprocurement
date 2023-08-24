<title>Payment Process</title>

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
        @foreach ($datapo as $po)
            <div class="modal fade" id="modalItemVendor{{ $po->id }}" tabindex="-1" aria-hidden="true">
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

                                    @foreach ($po->itempo as $item)
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
                        <h3>Payment Process In</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payment Process In</li>
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
                                <form action="{{ route('menu-pengajuan-dana.SearchPDIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cariIn" class="form-control " placeholder="Search ..." value="{{ request('cariIn') }}">
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
                                            <th>No</th>
                                            <th>No PR/PO</th>
                                            <th>Name</th>
                                            <th>Item</th>
                                            {{-- <th>Send To</th> --}}
                                            <th>Deadline</th>
                                            <th style="text-align: center;">Status</th>

                                            <th style="text-align: center;">Function</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $approvedPPB = [];
                                        $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                    @endphp
                                    <tbody>
                                        @foreach ($datappb as $ppb)
                                            @php $approvedPPB[] =$ppb; @endphp
                                            <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">

                                                <td>{{ $i++ }}</td>
                                                <td>{{ $ppb->code_pengajuan }}</td>
                                                <td>
                                                    <a href="{{ url('/menu-pengajuan-dana/detail/' . $ppb->id) }}">
                                                        <ul>
                                                            <li style="font-weight:600; white-space:nowrap;">{{ $ppb->whosubmit->name }}</li>
                                                            <li>{{ $ppb->desc }}</li>
                                                        </ul>
                                                    </a>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li style="margin-top:4px; white-space:nowrap;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                    </ul>
                                                </td>
                                                {{-- <td>{{ $ppb->send_to }}</td> --}}
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <p class="ppb-countdown" style="color:rgb(81, 171, 71);width:150px;"></p>
                                                        </li>
                                                        <li>
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
                                                <td style="text-align: center">
                                                    <ul>
                                                        <li>
                                                            <a class="badge mt-1 bg-warning"
                                                                style="color: white; font-size:10">{{ $ppb->status }}</a>
                                                        </li>
                                                        <li>
                                                            <a class="badge badge-lable" style="font-size: 10">
                                                                Complete This Task!
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                @hasrole('finance|super admin')

                                                    <td class="text-center" style="white-space: nowrap;">
                                                        <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #ADD8E6; font-size:10"
                                                                href="{{ url('/exportpdf/pymnt/' . $ppb->id) }}" target="_blank"><i
                                                                    class="icon-eye" title="Preview PDF"></i>
                                                            </a>

                                                        {{-- <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #008b2c; font-size:10"
                                                                href="{{ url('/menu-pengajuan-dana/create/' . $ppb->id) }}"><i
                                                                    class="icon-file" title="Create"></i>
                                                        </a> --}}

                                                        {{-- <button class="btn btn-iconsolid mt-1" data-bs-toggle="modal"
                                                        style="background-color: #ff0000; font-size:10" data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                class="icon-trash" title="Delete"></i>
                                                        </button> --}}
                                                    </td>
                                                @endhasrole
                                            </tr>
                                            @foreach ($ppb->quot as $po)
                                            @if($po->status == 'Unpaid')
                                                <tr>

                                                    @php
                                                        $po2 = \App\Models\CategoryPO::with('vendorable')->find($po->id);
                                                        $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                        $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                    @endphp

                                                    @if(empty($po))

                                                    @else
                                                    <td style="text-align: center">-</td>
                                                    <td>
                                                        <a href="{{ route('menu-pengajuan-dana.po_detail',$po->id) }}">
                                                            {{ $po2->code_po }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <a href="{{ route('menu-pengajuan-dana.po_detail',$po->id) }}">
                                                                <li style="white-space: nowrap;">
                                                                    @if($po2->vendorable_id == 0)
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                    @else
                                                                    Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama ?? ' - ' }}
                                                                    @endif
                                                                </li>
                                                                <li> Quotation : {{ $po2->quotation }}</li>
                                                            </a>
                                                        </ul>
                                                    </td>
                                                    <td style="font-weight: 700; white-space:nowrap;">
                                                        @foreach ($po3 as $ipo)
                                                        <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                            @foreach ($po4 as $ipo)
                                                            <label>
                                                                {{ $ipo->matauang }} {{ number_format($ipo->grand_total ,2) }}
                                                            </label>
                                                            @endforeach
                                                    </td>
                                                    <td colspan="2"  class="text-center"><a
                                                        class="badge {{ $ppb->status == 'Unpaid' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                        style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                    @endif
                                                </tr>
                                                @endif
                                            @endforeach
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
    </section>
@endsection
@section('scripts')
    {{-- <script src="{{  }}"></script> --}}
    <script>
        const dataPD = @json($approvedPPB);
        const item = dataPD[0];

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (dataPD, elmnt) => {
            const {
                approved_at,
                dateline_time,
                datetime
            } = dataPD;

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
        const initCountdown = (dataPD) => {
            dataPD.forEach(item => {
                if (!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#ppb-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(dataPD);
    </script>
@endsection
