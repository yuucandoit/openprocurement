<title>Detail Check Logistic</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Details
                            @if(empty($pengajuan->code_pengajuan))
                            {{ $pengajuan->whosubmit->name }}
                            @else
                            {{ $pengajuan->code_pengajuan }}
                            @endif
                        </h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('logistic.index') }}">Check Logistic</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Details
                                    @if (empty($pengajuan->whosubmit->name))
                                        Not Filled
                                    @else
                                        {{ $pengajuan->whosubmit->name }}
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <td>Code</td>
                                            <td>
                                                @if(empty($pengajuan->code_pengajuan))
                                                -
                                                @else
                                                {{ $pengajuan->code_pengajuan }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>
                                                @if (empty($pengajuan->whosubmit->name))
                                                    Not Filled
                                                @else
                                                    {{ $pengajuan->whosubmit->name }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $pengajuan->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $pengajuan->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $pengajuan->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{ $pengajuan->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $pengajuan->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Line</td>
                                            <td>{{ $pengajuan->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>File PR</td>
                                            <td><a href="{{ asset('upload_file_pr/'.$pengajuan->file_pr) }}" target="_blank">{{ $pengajuan->file_pr }}</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered mt-4 mb-4 order-entry">
                                    <thead>
                                        <tr class="text-center"
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17;">
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>UOM</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengajuan->itemppn as $p)
                                            <tr>
                                                <td style="text-align: center;">{!! nl2br($p->item) !!}</td>
                                                <td style="text-align: center;">{{ $p->qty }}</td>
                                                <td style="text-align: center;">{{ $p->kategori }}</td>
                                                @if(empty($p->path_file))
                                                <td></td>
                                                @else
                                                <td style="text-align: center;"><a href="/upload_pengajuan/{{ $p->path_file }}" class="btn btn-danger" target="_blank">See File</a></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <!-- Modal -->
                                <div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="rejectLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="rejectLabel">Message</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('logistic.reject', $pengajuan->id) }}"
                                                id="formAdd" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Reject Message</label>
                                                        <textarea name="note_logistic" id="note" class="form-control" cols="30" rows="0" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="approve" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="approveLabel">Message</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('logistic.approve', $pengajuan->id) }}"
                                            id="formAdd" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="note" class="form-label">Approver Note <p
                                                            style="color: red; font-size:10;">*Optional</p></label>
                                                    <textarea name="note_logistic" id="note" class="form-control" cols="30" rows="0"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @hasrole('Logistic Checker|super admin')
                            <div class="mt-3">
                                @if ($pengajuan->logistic_check == 0)
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return"><b>Approved</b></a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return">Reject</a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-warning text-center">Edit</a>
                                @elseif($pengajuan->logistic_check == 1 && $pengajuan->status == 'Awaiting Purchase Request Approval')
                                    <button type="button" class="btn btn-success text-center" data-bs-toggle="modal"
                                        data-bs-target="#approve">Approve</button>
                                    {{-- <button type="submit" class="btn btn-success text-center"> Approve</button> --}}
                                    <button type="button" class="btn btn-danger text-center" data-bs-toggle="modal"
                                        data-bs-target="#reject">Reject</button>
                                    <a class="btn btn-warning text-center" href="{{ route('logistic.edit',$pengajuan->id) }}">Edit</a>
                                @elseif($pengajuan->status == 'Rejected From Logistics')
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-success text-center" onclick="return">Aprove</a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>
                                    <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                        class="btn btn-warning text-center">Edit</a>
                                @endif

                            </div>
                        @endhasrole
                        <style>
                            /* textarea {
                                height: 20px;
                                width: 100%;
                                border: none;
                                border-bottom: 2px solid #aaa;
                                background-color: transparent;
                                margin-bottom: 10px;
                                resize: none;
                                outline: none;
                                transition: .5s
                            } */

                            .AllComment {
                                box-sizing: border-box;
                                border: 2px solid rgb(236, 236, 236);
                                border-radius: 10px;
                                padding: 15px 10px;
                            }
                        </style>

                        <div class="container">
                            <div class="mt-4">
                                <form action="{{ route('comment.store', $pengajuan->id) }}" method="POST">
                                    @csrf
                                    <textarea name="comment" class="form-control" placeholder='Add Your Comment'></textarea>
                                    <div style="text-align: right; margin-top:20px;">
                                        <input type="submit" class="btn btn-primary" value="Comment">
                                        <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->implode(',') }}">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="AllComment" id="comment">
                            <div class="container">
                                @foreach ($comments as $c)
                                    <ul style="width: 100%">
                                        <li style="margin-top: 10px;">
                                            <p>
                                                <strong>
                                                    @if (empty($c->users->name))
                                                    @else
                                                        - {{ $c->users->name }}
                                                    @endif
                                                </strong>
                                                @if (empty($c->created_at))
                                                @else
                                                    &nbsp;&nbsp;{{ \Carbon\Carbon::parse($c->created_at)->format('| l | d-m-Y | H:i:s |') }}
                                                @endif
                                            </p>
                                        </li>
                                        <li>
                                            @if (empty($c->comment))
                                            @else
                                                <p>{{ $c->comment }}</p>
                                            @endif
                                        </li>
                                        <hr>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <!-- Container-fluid Ends-->
                    </div>
                </div>
                <script>
                    var feild = document.querySelector('textarea');
                    var backUp = feild.getAttribute('placeholder');
                    var btn = document.querySelector('.btn');
                    var clear = document.getElementById('clear')

                    feild.onfocus = function() {
                        this.setAttribute('placeholder', '');
                        this.style.borderColor = '#333';
                        btn.style.display = 'block'
                    }

                    feild.onblur = function() {
                        this.setAttribute('placeholder', backUp);
                        this.style.borderColor = '#aaa'
                    }

                    clear.onclick = function() {
                        btn.style.display = 'none';
                        feild.value = '';
                    }
                </script>
            </div>

        </div>

        </div>
        </div>
        </div>
        <!-- Container-fluid Ends-->
        </div>
        </div>

    </section>
@endsection

