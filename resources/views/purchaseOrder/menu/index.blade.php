    <title>Purchase order In</title>

    @extends('layouts.master')

    @section('main')
        <section>

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

            @foreach ($datappb as $ppb)
            <div class="modal fade" id="modalItem{{ $ppb->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h2 class="modal-title" style="color: white">List Item</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-5 mb-3">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($ppb->itemppn as $item)
                                    <ul style="font-size: 18">
                                        <li>- {{ $item->item }}</li>
                                    </ul>
                                    @endforeach
                        </div>
                        <div class="modal-footer">
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
                            <h3>Purchase Order In</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item">Purchase Order</li>
                            </ol>
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
                            <div class="row">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                    <form action="{{ route('menu-purchase-order.SearchPOIn') }}" method="get" class="input-group">
                                        <input type="text" name="cariIn" class="form-control " placeholder="Search ..." value="{{ request('cariIn') }}">
                                        <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" >
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                {{-- <th>Description</th> --}}
                                                <th>Item</th>
                                                <th>PO</th>
                                                <th>Deadline</th>
                                                {{-- <th>Countdown</th> --}}
                                                <th style="text-align: center;">Status</th>
                                                {{-- @hasrole('purchasing|super admin')
                                                <th style="text-align: center;">Status</th>
                                                @endhasrole --}}
                                                <th style="white-space: nowrap;">Approved At</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                        @endphp
                                        <tbody>
                                            @foreach ($datappb as $ppb)
                                                @if ($ppb->status == 'Purchase Proses')
                                                    @php $approvedPPB[] =$ppb; @endphp
                                                    <tr id="ppb-{{ $ppb->id }}">
                                                        <td style="text-align: center;">{{ $i++ }}</td>
                                                        <td>
                                                            <ul>
                                                                <li><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" style="font-weight: 600;">{{ $ppb->whosubmit->name }}</a></li>
                                                                <li style="margin-top: 5px;"><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></li>
                                                            </ul>
                                                            {{-- {{ $ppb->whosubmit->name }} --}}
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item </label></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            {{-- AMBIL DATA pengajuan hasMany ke category po --}}
                                                            @foreach ($ppb->quot as  $quot)
                                                            <ul>
                                                                <li style="margin-top: 5px;"><a href="{{ url('/exportpdf/po_id/'.$quot->id) }}" target="_blank"> PO {{$quot->id}}</a></li>
                                                            </ul>
                                                            @endforeach
                                                        </td>
                                                        {{-- <td style=""><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}">{{ $ppb->desc }}</a></td> --}}
                                                        {{-- <td style="text-align: center;">{{ $ppb->send_to }}</td> --}}

                                                     @if ($ppb->status == 'Purchase Proses')
                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <p class="ppb-countdown" style="color:rgb(81, 171, 71)"></p>
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
                                                            {{-- <td class="ppb-countdown"></td> --}}
                                                            <td style="text-align: center;">
                                                                <ul>
                                                                    <li>
                                                                        <a class="badge"
                                                                            style="color: white; background-color:rgb(255, 0, 0); font-size:10">
                                                                            @if($ppb->status == 'Purchase Proses')
                                                                            Waiting Process
                                                                            @endif
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="badge badge-lable" style="font-size: 10">
                                                                            Complete This Task!
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            {{-- <td>
                                                            </td> --}}
                                                        @else
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                            <td> -/- </td>
                                                        @endif

                                                        <td style="font-size: 10;"><strong>{{ Carbon\Carbon::parse($ppb->approved_at)->format('d-m-Y H:i:s') }}</strong></td>
                                                        @hasrole('purchasing|super admin')
                                                            <td style="text-align: center;">
                                                                <ul>
                                                                    <li style="white-space: nowrap;">
                                                                        <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #B1D0E0; font-size:10;"
                                                                href="{{ url('/exportpdf/po/' . $ppb->id) }}" target="_blank"><i
                                                                    class="icon-eye" title="Preview Purchase Order"></i>
                                                                </a>
                                                                <a class="btn btn-iconsolid mt-1"
                                                                style=  "background-color: #008000;font-size:10;"
                                                                href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                    class="icon-file" title="Record Data"></i>
                                                                </a>
                                                                    </li>
                                                                    <li style="white-space: nowrap;">
                                                                        <a class="btn btn-iconsolid mt-1"
                                                                        style="background-color: #FF8C00;font-size:10;"
                                                                        href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}"><i
                                                                            class="icon-pencil-alt" title="Edit"></i>
                                                                    </a>

                                                                    <button class="btn btn-iconsolid mt-1" style="background-color: #ff0000; font-size:10;" data-bs-toggle="modal"
                                                                    data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                        class="icon-trash" title="Delete"></i>
                                                                </button>
                                                                    </li>
                                                                </ul>
                                                                {{-- <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #B1D0E0; font-size:10;"
                                                                href="{{ url('/exportpdf/po/' . $ppb->id) }}" target="_blank"><i
                                                                    class="icon-eye" title="Preview Purchase Order"></i>
                                                                </a> --}}


                                                                {{-- <a class="btn btn-iconsolid mt-1"
                                                                style=  "background-color: #008000;font-size:10;"
                                                                href="{{ url('/menu-purchase-order/create/' . $ppb->id) }}"><i
                                                                    class="icon-file" title="Record Data"></i>
                                                                </a> --}}

                                                                    {{-- <a class="btn btn-iconsolid mt-1"
                                                                        style="background-color: #FF8C00;font-size:10;"
                                                                        href="{{ url('/menu-purchase-order/edit/' . $ppb->id) }}"><i
                                                                            class="icon-pencil-alt" title="Edit"></i>
                                                                    </a> --}}
                                                                {{-- <a class="btn btn-iconsolid mt-1"
                                                                    style="background-color: #00008B;"
                                                                    href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}"><i
                                                                        class="icon-zoom-in" title="Details"></i>
                                                                </a> --}}

                                                                {{-- <button class="btn btn-iconsolid mt-1" style="background-color: #ff0000; font-size:10;" data-bs-toggle="modal"
                                                                    data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                        class="icon-trash" title="Delete"></i>
                                                                </button> --}}

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
        // console.log(data);
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
