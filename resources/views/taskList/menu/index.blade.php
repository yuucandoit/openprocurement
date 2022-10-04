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
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <h3>Task List</h3>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Date Line</th>
                                    <th>Countdown</th>
                                    <th>Warning</th>
                                    <th>Approved At</th>
                                    <th>Request By</th>
                                    <th>Function</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($datappb as $ppb)
                                @if ($ppb->status == 'Accepted by Super user')
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $ppb->desc }}</td>
                                        <td>{{ $ppb->dateline }}</td>
                                        <td id="countdown-{{ $ppb->id }}"></td>
                                      <td>  @if ($ppb->dateline == '≤3Jam')
                                            @if ($ppb->dateline_time == '03:00:00')
                                            <a class="badge bg-success" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                                            @elseif ($ppb->dateline_time == '02:00:01')
                                            <a class="badge bg-warning" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                                            @elseif ($ppb->dateline_time == '01:00:01')
                                            <a class="badge bg-danger" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                                            @elseif ($ppb->dateline_time == '00:05:00')
                                            <a class="badge bg-dark" style="font-size: 18"><i class="bx bx-detail"></i>This Label is Unfinished, Under development</a>
                                            @endif
                                        @endif
                                        @if ($ppb->dateline == '≤24Jam')

                                        @endif
                                        @if ($ppb->dateline == '≤2Hari')

                                        @endif
                                    </td>
                                    <td>{{ $ppb->approved_at }}</td>
                                        <td>{{ $ppb->ws }}</td>
                                        <td>
                                            <a href="{{ url('menu-task-list/detail/' . $ppb->id) }}"
                                                class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                        <td> <a class="badge {{ $ppb->status == 'pending' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                style="color: white; font-size:18">{{ $ppb->status }}</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const data = @json($datappb);
        const item =data[0];
        console.log(data);

        // FOR CALCULATE REMAINING DEADLINE TIME 😃
        const remainingTime = (data) => {
            const { approved_at, dateline_time , datetime } = data;
            const approvedAt    = new Date(approved_at);
            const dueDateTime   = new Date(`1970-01-01T${dateline_time}Z`);
            const dueDateAt     = new Date(approvedAt.getTime() + dueDateTime.getTime());
            const remainingTime = new Date(dueDateAt.getTime() - Date.now());

            // console.log(remainingTime.getTime());
            if(remainingTime.getTime())
            if(remainingTime.getTime() < 1) return "Your time is up";

            const hours   = remainingTime.getUTCHours().toString();
            const minutes = remainingTime.getUTCMinutes().toString();
            const seconds = remainingTime.getUTCSeconds().toString();

            return (
                (hours.length   == 1 ? `0${hours}:`   : `${hours}:`) +
                (minutes.length == 1 ? `0${minutes}:` : `${minutes}:`) +
                (seconds.length == 1 ? `0${seconds}:` : `${seconds}`)
            );
        }

        // FOR HANDLE REWRITE ELEMENT 😃
        const countdownHandle = (elmnt, item) => {
            elmnt.innerText = remainingTime(item);
        }

        // FOR INITIALIZE COUNTDOWN 😃
        const initCountdown = (data) => {
            data.forEach(item => {
                if(!item.approved_at) return;
                setInterval(() => countdownHandle(document.querySelector(
                    `#countdown-${item.id}`
                ), item), 1000);
            });
        }

        initCountdown(data);
    </script>
@endsection
