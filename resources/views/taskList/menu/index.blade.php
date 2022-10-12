<title>Task List Purchase Order</title>

@extends('layouts.master')

@section('main')
<section>
    @foreach ($datadv as $a)
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
            <div class="col-sm-6">
                <h3>Task List Purchasing</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Task List Purchase order</li>
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
            <h5>Task List PO</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Description</th>
                        <th>Date Line</th>
                        <th>Countdown</th>
                        <th>Warning</th>
                        <th>Approved At</th>
                        <th>Request By</th>
                        <th>Status</th>
                        <th>Function</th>
                    </tr>
                </thead>
                @php
                $no = 1;
                $approvedPPB = [];
                @endphp
                @foreach ($datappb as $ppb)
                @if ($ppb->status == 'Purchase Submission Approved')
                @php $approvedPPB[] =$ppb; @endphp
                <tbody>
                  <tr id="ppb-{{ $ppb->id }}" style="text-align: center;">
                    <td>{{ $no++ }}</td>
                    <td>{{ $ppb->desc }}</td>
                    <td>{{ $ppb->dateline }}</td>
                    <td class="ppb-countdown"></td>
                    <td>
                        <a class="badge badge-lable" style="font-size: 18">
                            Complete This Task!
                        </a>
                        {{-- @if ($ppb->dateline == '≤3Jam')
                        @if ($ppb->dateline_time == '03:00:00')
                        <a class="badge bg-success" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                        @elseif ($ppb->dateline_time == '02:00:01')
                        <a class="badge bg-warning" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                        @elseif ($ppb->dateline_time == '01:00:01')
                        <a class="badge bg-danger" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                        @elseif ($ppb->dateline_time == '00:05:00')
                        <a class="badge bg-dark" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                        @endif
                        @endif --}}
                    </td>
                    <td>{{ $ppb->approved_at }}</td>
                    <td>{{ $ppb->ws }}</td>
                    <td>
                        <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                            style="color: white; font-size:18">{{ $ppb->status }}</a>
                        </td>
                        <td>
                            <a href="{{ url('menu-task-list/detail/' . $ppb->id) }}"
                                class="btn btn-outline-info"><i class="fa fa-search-plus"></i></a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Zero Configuration  Ends-->
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
                [0, 'bg-dark'],
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
                [0, 'bg-dark'],
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
