<title>Check Logistic | Eprocurement</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($pengajuan as $ppb)
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
                                        <th>Uom</th>
                                        <th>Qty</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($ppb->itemppn as $item)
                                    <tr>
                                        <td> {{ $item->item }}</td>
                                        <td> {{ $item->kategori }}</td>
                                        <td> {{ $item->qty }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Inventory Check</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Inventory Check</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                            <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                <form action="{{ route('logistic.search') }}" method="get" class="input-group" >
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
                                            <th style="text-align: center;">Request By</th>
                                            <th>Item</th>
                                            <th style="text-align: center;">Deadline</th>
                                            <th style="text-align: center;">Status</th>
                                            {{-- <th style="text-align: center;">Action</th> --}}
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                        $i = 1 + $pengajuan->currentPage() * $pengajuan->perPage() - $pengajuan->perPage();
                                    @endphp
                                        <tbody>
                                        @foreach ($pengajuan as $ppb)
                                            <tr>
                                                <td style="text-align: center;"><input type="checkbox" class="child-cb" value="{{ $ppb->id }}"></td>
                                                <td style="text-align: center;"><a href="{{ route('logistic.detail',$ppb->id) }}">{{ $ppb->code_pengajuan }}</a></td>
                                                <td><a href="{{ route('logistic.detail',$ppb->id) }}">
                                                    <ul>
                                                        <li style="font-weight: 600;">{{ $ppb->whosubmit->name }}</li>
                                                        <li style="margin-top:10px;">{{ $ppb->desc }}</li>
                                                    </ul>
                                                </a>
                                                </td>
                                                <td><label data-bs-toggle="modal" data-bs-target="#modalItem{{ $ppb->id }}">{{ $ppb->itemppn->count() }} Item</label></td>
                                                <td style="text-align: center;">
                                                    <ul>
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
                                                            <a class="badge {{ $ppb->status == 'Awaiting Purchase Request Approval' ? 'bg-warning' : ($ppb->status == 'rejected' ? 'bg-danger' : 'bg-success') }} mt-1"
                                                                style="color: white; font-size:12">{{ $ppb->status }}</a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                {{-- <td style="text-align: center;">
                                                    <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00; font-size:10;" href="{{ route('logistic.edit',$ppb->id) }}"><i class="icon-pencil-alt" title="Edit"></i></a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pengajuan->appends(['in'=> request('in')],'in')->withQueryString()->links('pagination::bootstrap-5') }}
                                <div class="box-header">
                                    <button type="button" id="button-approve-selected" disabled class="btn btn-danger"
                                    style="margin-top: 10px;" onclick="approveDataTerpilih()">Approve Selected Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <form action="{{ route('logistic.approveSelected') }}" method="post" id="form-export-terpilih" class="hidden">
                @csrf
                <input type="hidden" name="ids">
                <button class="hidden" style="display: none;" type="submit">S</button>
            </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        //Checkbox Cek All
        $("#head-cb").on('click', function() {
            var isChecked = $('#head-cb').prop('checked')
            $(".child-cb").prop('checked', isChecked)
            $("#button-approve-selected").prop('disabled', !isChecked)
        })

        $(".tasklist ").on('click', '.child-cb', function() {
            if ($(this).prop('checked') != true) {
                $("#head-cb").prop('checked', false)
            }
            let semua_checkbox = $(".tasklist  .child-cb:checked")
            let button_approve_selected = (semua_checkbox.length > 0)

            $("#button-approve-selected").prop('disabled', !button_approve_selected)
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
            $("#form-export-terpilih").submit()
        }
    </script>
@endsection
