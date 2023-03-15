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
                                                <th>No.Pengajuan</th>
                                                <th>Name</th>
                                                <th>Item</th>
                                                <th>Deadline</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                        //  use Carbon\Carbon;
                                            $i = 1 + $datappb->currentPage() * $datappb->perPage() - $datappb->perPage();
                                            $approvedPPB = [];
                                        @endphp

                                        <tbody>
                                            @foreach ($datappb as $ppb)
                                                @if ($ppb->status == 'Purchase Proses' ||
                                                    $ppb->status == 'Cross Check PO')
                                                    @php
                                                    $approvedPPB[] =$ppb;
                                                    $id_po = $ppb->id;
                                                    $id_number = str_pad($id_po,5,'0', STR_PAD_LEFT);
                                                    $year = Carbon\Carbon::now()->format('y');
                                                    $month = Carbon\Carbon::now()->format('m');

                                                    @endphp
                                                    <tr id="ppb-{{ $ppb->id }}" style="background-color:#F1F6F5;">
                                                        <td style="text-align: center;">{{ $i++ }}</td>
                                                        <td style="text-align: center;">
                                                            <ul>
                                                                {{-- <li>{{ $id_number }}/PB/SII/{{ $month }}/{{ $year }}</li> --}}
                                                                <li><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" >{{ $ppb->code_pengajuan }}</a></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" style="font-weight: 600;">{{ $ppb->whosubmit->name }}</a></li>
                                                                <li style="margin-top: 5px;"><a href="{{ url('/menu-purchase-order/detail/' . $ppb->id) }}" >{!! nl2br($ppb->desc) !!}</a></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            @foreach ($ppb->itemppn as $ice)
                                                                @php
                                                                $ipb = \App\Models\PengajuanPembelian::select(DB::raw('pp_id,SUM(qty) as qty'))->where('pp_id',$ice->pp_id)->groupBy('pp_id')->first();
                                                                @endphp
                                                            @endforeach
                                                            <ul>
                                                                <li style="margin-top:4px;"><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{  $ipb->qty }} Item </label></li>
                                                            </ul>
                                                        </td>

                                                     @if ($ppb->status == 'Purchase Proses'||'Cross Check PO')
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
                                                                        @if($ppb->status == 'Purchase Proses')
                                                                        <a class="badge"
                                                                            style="color: white; background-color:rgb(255, 0, 0); font-size:10">
                                                                            Waiting Process
                                                                        </a>
                                                                        @elseif($ppb->status == 'Cross Check PO')
                                                                        <a class="badge"
                                                                            style="color: white; background-color:rgb(255, 200, 0); font-size:10">
                                                                            On Check
                                                                        </a>
                                                                        @endif
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
                                                        @hasrole('purchasing|super admin')
                                                            <td style="text-align: center;">

                                                                <a class="btn btn-iconsolid mt-1"
                                                                style="background-color: #B1D0E0; font-size:10;"
                                                                href="{{ url('/exportpdf/po/' . $ppb->id) }}" target="_blank"><i
                                                                    class="icon-eye" title="Preview Purchase Order"></i>
                                                                </a>
                                                                {{-- <button class="btn btn-iconsolid mt-1" style="background-color: #ff0000; font-size:10;" data-bs-toggle="modal"
                                                                    data-bs-target="#modalDelete{{ $ppb->id }}"><i
                                                                        class="icon-trash" title="Delete"></i>
                                                                </button> --}}
                                                            </td>
                                                        @endhasrole
                                                    </tr>
                                                    <tbody>
                                                    @foreach ($ppb->quot as $po)
                                                    <tr>

                                                        @php
                                                            $po2 = \App\Models\CategoryPO::find($po->id);
                                                            $po3 = \App\Models\ItemPO::select(DB::raw('po_id,SUM(qty) as qty'))->where('po_id',$po->id)->groupBy('po_id')->get();
                                                            $po4 = \App\Models\ItemPO::where('po_id',$po->id)->groupBy('po_id')->get();
                                                        @endphp

                                                        @if(empty($po2))

                                                        @else
                                                        <td style="text-align: center">-</td>
                                                        <td>
                                                            <a href="{{ route('menu-purchase-order.po_detail',$po->id) }}">
                                                            {{ $po->id }}/PO/SII/{{ $month }}/{{ $year }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <a href="{{ route('menu-purchase-order.po_detail',$po->id) }}">
                                                                    <li style="white-space: nowrap;">
                                                                        @if($po2->vendorable_id == 0)
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -
                                                                        @else
                                                                        Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $po2->vendorable->nama }}
                                                                        @endif
                                                                    </li>
                                                                    <li> Quotation : {{ $po2->quotation }}</li>
                                                                </a>
                                                            </ul>
                                                        </td>
                                                        <td style="font-weight: 700;">
                                                            @foreach ($po3 as $ipo)
                                                            <label data-bs-toggle="modal" data-bs-target="#modalItemVendor{{ $po->id }}">{{ $ipo->qty }} Item</label>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($po4 as $ipo)
                                                                <label>
                                                                    @if($ipo->matauang == "RP")
                                                                    Rp.{{ number_format($ipo->grand_total ,2) }}
                                                                    @elseif ($ipo->matauang == "USD")
                                                                    $ {{ number_format($ipo->grand_total ,2) }}
                                                                    @endif
                                                                </label>
                                                            @endforeach
                                                        </td>
                                                        <td colspan="2"  class="text-center"><a
                                                            class="badge {{ $ppb->status == 'Waiting For PO Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                            style="color: white; font-size:12">{{ $po2->status }}</a></td>

                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
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
        </section>
    @endsection
    @section('scripts')
    {{-- <script src="{{  }}"></script> --}}
    {{-- {{ dd($approvedPPB) }} --}}
    {{-- @php
        $approvedPPB = collect($approvedPPB);
    @endphp --}}
    <script>
        const data = @json($approvedPPB);
        console.log(data);
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
            const remainingExp = new Date(remainingTime.getTime() + Date.now());
            const lable = elmnt.querySelector('.badge-lable');

            console.log(dateline_time, remainingTime.getTime(),remainingTime.getTime(),);

            if (remainingTime.getTime() < 1) {
                lable.classList.remove('bg-dark');
                lable.classList.add('bg-dark');

                const days  = dateline.split()[0] == 24 ? (remainingExp.getDate()-2).toString() : (remainingExp.getDate()-1).toString();
                const hours = remainingExp.getUTCHours().toString();
                const minutes = remainingExp.getUTCMinutes().toString();
                const seconds = remainingExp.getUTCSeconds().toString();
                return (
                (days.length == 1 ? `-0${days}:` : `-${days}:`)+
                (hours.length == 1 ? `0${hours}:` : `${hours}:`) +
                (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                (seconds.length == 1 ? `0${seconds}` : `${seconds}`)
            );
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
