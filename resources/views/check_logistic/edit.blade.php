<title>Edit Check Logistic</title>
{{-- @dd($item) --}}
@extends('layouts.master')

@section('main')
    <section>
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('error') }}
        </div>
        @elseif ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @elseif(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit Check Logistic</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('logistic.index') }}">Check Logistic</a></li>
                            <li class="breadcrumb-item">Edit Check Logistic</li>
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
                            <h5>Edit Inventory Check</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/check-logistic/updatelogistic/'.$pengajuan->id) }}" id="formAdd"
                                method="post" enctype="multipart/form-data">
                                @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="floatingTanggal"><i data-feather="clock"></i> Date :</label>
                                    <div class="form-group">
                                        <input type="date" class="form-control @error('date_ps') is-invalid @enderror" id="floatingTanggal" placeholder="Tanggal" name="date_ps" value="{{ old('date_ps', date('Y-m-d')) }}" disabled>
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
                                            <option selected="" value="{{ $pengajuan->dateline }}">{{ $pengajuan->dateline }}
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
                                        <label class="" for="pageSelector"><b><i data-feather="send"></i> Send To</b></label>
                                        <select class="form-select" id="pageSelector" placeholder="Send To" name="send_to" disabled>
                                            <option value="{{ $pengajuan->send_to }}" selected hidden>{{ $pengajuan->send_to }}</option>
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
                                            <option value="{{ $pengajuan->ws }}" selected hidden>{{ $pengajuan->whosubmit->name }}</option>
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
                                        <label for="floatingdepartment"><i data-feather="shield"></i> Department
                                            :</label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" disabled>
                                            <option value="{{ $pengajuan->department }}" selected hidden>{{ $pengajuan->dps->name }}</option>
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
                                            <option selected=""  value="{{ $pengajuan->atasan }}">{{ $pengajuan->bod->name }}</option>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i data-feather="clipboard"></i> Description :</label>
                                        <div class="">
                                            <textarea name="desc" id="floatingNoTelpon" class="form-control" rows="4" disabled>{{ $pengajuan->desc }}</textarea>
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
                                        <label> Attach File PR </label>
                                        <input type="file" placeholder="Choose File" class="form-control" enctype="multipart/form-data" name="file_pr" disabled>
                                        @if($pengajuan->file_pr)
                                            <p>Old File: <a href="{{ asset('upload_file_pr/'.$pengajuan->file_pr) }}" target="_blank">{{ $pengajuan->file_pr }}</a></p>
                                        @else
                                        @endif
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
                                        @error('category_purpose')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                                <hr>
                                <table class="table table-bordered item order-entry">
                                    <tr style="text-align: center;">
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            No</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Item</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Qty</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Unit</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            File</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Action</th>

                                    </tr>
                                    @php
                                        $no_edit = 1;
                                    @endphp
                                    @foreach ($pengajuan->itemppn as $i)
                                    <tr>
                                        <td style="text-align: center;">
                                            {{ $no_edit++ }}
                                        </td>
                                        <td class="text">
                                            <input type="text" name="id[]" placeholder="Input Item" class="form-control" style="text-align: center;" value="{{ $i->id }}" hidden />
                                            <textarea id="" class="form-control" rows="2" style="min-width: 300px" disabled>{{ $i->item }}</textarea>
                                            <input type="text" name="item[]" value="{{ $i->item }}" placeholder="Input Item" class="form-control" style="text-align: center;"  hidden/>
                                        </td>
                                        <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" value="{{ $i->qty }}" required />
                                        </td>
                                        <td>
                                            <select class="form-select " placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                                                @foreach($uom as $u)
                                                    @if($u->name == $i->kategori)
                                                    <option value="{{ $i->kategori }}" selected>{{ $i->kategori }}</option>
                                                    @else
                                                    <option value="{{ $u->name }}">{{ $u->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data" disabled>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" name="add" class="btn btn-danger remove-input-field">
                                                <i class="icofont icofont-ui-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                                    <a href="{{ route('logistic.detail',$pengajuan->id) }}" class="btn btn-dark mt-3">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
        });
    </script>
@endsection
