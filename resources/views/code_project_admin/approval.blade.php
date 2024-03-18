<title>Request List Code Project</title>
@extends('layouts.master')
@section('main')
<section>
    <!-- Page Sidebar Ends-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6 mt-4">
                    <h3>Request List Code Project</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item">Request List Code Project</li>
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
                                <form action="{{ route('menu-taskList-atasan.SearchTaskRequestBodIn') }}" method="get" class="input-group" >
                                    <input type="text" name="cariIn" class="form-control " placeholder="Search ..." value="{{ request('cariIn') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover tasklist" >
                                    <thead class="bg-primary">
                                        <tr style="text-align: center;">
                                            <th><input type="checkbox" id="head-cb"></th>
                                            <th>No</th>
                                            <th>Requester</th>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $i = 1 + $list->currentPage() * $list->perPage() - $list->perPage();
                                    @endphp
                                    <tbody>
                                    @foreach ($list as $l)
                                        <tr>
                                            <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $l->id }}"></td>
                                            <td style="text-align: center;">{{ $i++ }}</td>
                                            <td style="text-align: center;">{{ $l->user->name }}</td>
                                            <td style="text-align: center;">{{ $l->project_code }}</td>
                                            <td style="text-align: center;">
                                                <a class="badge @if($l->status == 'Waiting Approval') bg-warning @elseif($l->status == 'Approved') bg-success @else bg-danger @endif mt-1">
                                                {{ $l->status }}
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('project-code.accept',$l->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success">Accept</button>
                                                </form>
                                                <form action="{{ route('project-code.reject',$l->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $list->withQueryString()->links('pagination::bootstrap-5') }}
                                <div class="box-header">
                                    <button type="button" id="button-approve-selected" disabled class="btn btn-success"
                                    style="margin-top: 10px;" onclick="approveDataTerpilih()">Approve Selected Data</button>

                                    <button type="button" id="button-reject-selected" disabled class="btn btn-danger"
                                    style="margin-top: 10px;" onclick="rejectDataTerpilih()">Reject Selected Data</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <form action="{{ route('project-code.acceptSelect') }}" method="post" id="form-export-terpilih" class="hidden">
                @csrf
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>
            <form action="{{ route('project-code.rejectSelect') }}" method="post" id="form-reject-request" class="hidden">
                @csrf
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>
<!-- Container-fluid Ends-->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    //Checkbox Cek All
    $("#head-cb").on('click', function() {
        var isChecked = $('#head-cb').prop('checked')
        $(".child-cb").prop('checked', isChecked)
        $("#button-approve-selected").prop('disabled', !isChecked)
        $("#button-reject-selected").prop('disabled', !isChecked)
    })

    $(".tasklist").on('click', '.child-cb', function() {
        if ($(this).prop('checked') != true) {
            $("#head-cb").prop('checked', false)
        }
        let semua_checkbox = $(".tasklist  .child-cb:checked")
        console.log(semua_checkbox + ' A');
        let button_approve_selected = (semua_checkbox.length > 0)
        console.log(semua_checkbox + ' B');
        let button_reject_selected = (semua_checkbox.length > 0)
        console.log(semua_checkbox + ' C');

        $("#button-approve-selected").prop('disabled', !button_approve_selected)
        $("#button-reject-selected").prop('disabled', !button_reject_selected)
    })

    function approveDataTerpilih() {
        let checkbox_terpilih = $(".tasklist .child-cb:checked")
        let semua_id = []
        $.each(checkbox_terpilih, function(index, elm) {
            semua_id.push(elm.value)
        })
        let ids = semua_id.join(',')
        $("#button-approve-selected").prop('disabled', true)
        $("#form-export-terpilih [name='ids']").val(ids)
        Swal.fire({
            title: 'Are you sure?',
            text: "You will accept selected data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form-export-terpilih").submit();
            }
        });
    }

    function rejectDataTerpilih() {
        let checkbox_terpilih = $(".tasklist .child-cb:checked")
        let semua_id = []
        console.log(checkbox_terpilih);
        $.each(checkbox_terpilih, function(index, elm) {
            semua_id.push(elm.value)
        })
        let ids = semua_id.join(',')
        $("#button-reject-selected").prop('disabled', true)
        $("#form-reject-request [name='ids']").val(ids)
        Swal.fire({
            title: 'Are you sure?',
            text: "You will reject selected data.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form-reject-request").submit()
            }
        });

    }
</script>
@endsection
