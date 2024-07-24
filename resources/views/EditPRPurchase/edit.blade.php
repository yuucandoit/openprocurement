<title>Edit Data</title>
{{-- @dd($item) --}}
@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit Purchase Request</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/PrList') }}">List Purchase Request</a></li>
                            <li class="breadcrumb-item">Edit Purchase Request</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Edit Purchase Request</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('UpdatePRPurchase',$purchaseRequest->id) }}" id="formAdd"
                                method="post" enctype="multipart/form-data">
                                @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="floatingTanggal"><i data-feather="calendar"></i> Date :</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control @error('date_ps') is-invalid @enderror" id="floatingTanggal" placeholder="Tanggal" disabled name="date_ps" value="{{ old('date_ps', date('Y-m-d')) }}">
                                        @error('date_ps')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingdateline"><i data-feather="clock"></i> Deadline :</label>
                                        <select class="form-select @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline" disabled>
                                            <option selected="" value="{{ $purchaseRequest->dateline }}">{{ $purchaseRequest->dateline }}
                                            </option>
                                            <option value="≤24Jam">1 hari</option>
                                            {{-- <option value="≤48Jam">2 hari</option> --}}
                                            <option value="≤72Jam">2 sd 3 hari</option>
                                            {{-- <option value="≤96Jam">4 hari</option> --}}
                                            <option value="≤168Jam">4 sd 7 hari</option>
                                            <option value="≤336Jam">8 sd 14 hari</option>

                                        </select>
                                        @error('dateline')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="" for="pageSelector"><b><i  data-feather="send"></i> Send To</b></label>
                                        <select class="form-select" id="pageSelector" placeholder="Send To" name="send_to" disabled>
                                            <option value="{{ $purchaseRequest->send_to }}" selected hidden>{{ $purchaseRequest->send_to }}</option>
                                            <option value="Tebet">Tebet</option>
                                            <option value="Cikunir">Cikunir</option>
                                            <option value="other">Other Option</option>
                                        </select>
                                        <input class="hide form-control mt-1" type="text" id="customOther" placeholder="Input Send To">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingrequestby"><i data-feather="user"></i> Request By
                                            :</label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingrequestby" placeholder="Who Submitted" name="ws" disabled data-live-search="true">
                                            <option value="{{ $purchaseRequest->ws }}" selected hidden>{{ $purchaseRequest->whosubmit->name }}</option>
                                            @foreach ($dataws as $ws)
                                            <option value="{{ $ws->id }}">{{ $ws->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ws')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingdepartment"><i data-feather="briefcase"></i> Department
                                            :</label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" disabled>
                                            <option value="{{ $purchaseRequest->department }}" selected hidden>{{ $purchaseRequest->dps->name }}</option>
                                            @foreach ($datadepartment as $dp)
                                            <option value="{{ $dp->id }}">{{ $dp->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="" style="font-weight: bold;"><i class="icofont icofont-stamp"></i> Send Approval To:</label>
                                        <select class="form-select" id="floatingproposedto" placeholder="Proposed To" name="atasan" disabled>
                                            <option selected=""  value="{{ $purchaseRequest->atasan }}">{{ $purchaseRequest->bod->name }}
                                            </option>
                                            @foreach ($atasan as $sui)
                                            <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('atasan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i data-feather="link"></i> Description :</label>
                                        <div class="">
                                            <textarea name="desc" id="floatingNoTelpon" class="form-control" rows="4">{{ $purchaseRequest->desc }}</textarea>
                                            @error('desc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingwhosubmitted"><i class="icofont icofont-macbook"></i>
                                            Purpose
                                            :</label>
                                        <select class="form-select pageSelect" id="pageSelect" placeholder="Purpose" name="category_purpose" data-live-search="true" disabled>
                                            <option value="">Select Category Purpose</option>
                                            <option value="project">Project</option>
                                            <option value="office">Office</option>
                                            <option value="workshop">Workshop</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="rnd">R&D</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- css hide --}}
                                <style>
                                    .hide {
                                        width: 0;
                                        height: 0;
                                        opacity: 0;
                                        display: none;
                                    }

                                    .page {
                                        height: 58px;
                                    }

                                </style>
                                <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                                    <a href="{{ route('menu-pengajuan-pembelian.index') }}" class="btn btn-dark mt-3">Back</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
