<title>Create Purchase Request</title>
@extends('layouts.master')

@section('main')
<style>

    .hide {
        display: none;
        opacity: 0;
    }

    .page {
        height: 58px;
    }

    .custom-loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    }

    .loader {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid #fff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }



</style>
{{-- <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
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
                <div class="col-sm-6 mt-2">
                    <h3>Create Purchase Request</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('menu-pengajuan-pembelian.index') }}">Purchase
                                Request</a></li>
                        <li class="breadcrumb-item">Create Purchase Request</li>
                    </ol>
                </div>
                <div class="col-sm-6 mt-2">
                </div>
            </div>
        </div>
    </div>

    <div class="loader-3"></div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div id="loadingScreen" class="custom-loader">
                            <div class="loader"></div>
                        </div> --}}
                        <form action="{{ url('/menu-pengajuan-pembelian/store') }}" id="formAdd" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="floatingTanggal"><i style="width: 15px; padding-top: 10px;" data-feather="calendar"></i> Date <span style="color: red">*</span></label>
                                    <div class="form-group">
                                        <input type="date" class="form-control @error('date_ps') is-invalid @enderror" id="floatingTanggal" placeholder="Tanggal" name="date_ps" value="{{ old('date_ps', date('Y-m-d')) }}">
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
                                        <label for="floatingdateline"><i style="width: 15px; padding-top: 10px;" data-feather="clock"></i> Deadline <span style="color: red">*</span></label>
                                        <select class="form-select @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" name="dateline" required="">
                                            <option disabled="" value="">Select Deadline</option>
                                            <option value="≤72Jam" {{ old('dateline') == '≤72Jam' ? 'selected' : '' }}>2 sd 3 hari</option>
                                            <option value="≤168Jam" {{ old('dateline') == '≤168Jam' ? 'selected' : '' }}>4 sd 7 hari</option>
                                            <option value="≤336Jam" {{ old('dateline') == '≤336Jam' ? 'selected' : '' }}>8 sd 14 hari</option>
                                        </select>
                                        @error('dateline')
                                        <div class='mt-1'>
                                            <span class=" text-danger" asp-validation-for="dateline">
                                                {{ $message }}
                                            </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="" for="pageSelector"><i  style="width: 15px; padding-top: 10px;" data-feather="send"></i> Send To <span style="color: red">*</span></label>
                                        <select class="form-select" id="pageSelector" placeholder="Send To" name="send_to" required>
                                            <option value="Tebet" {{ old('send_to') == 'Tebet' ? 'selected' : '' }}>Tebet</option>
                                            <option value="Cikunir" {{ old('send_to') == 'Cikunir' ? 'selected' : '' }}>Cikunir</option>
                                            <option value="other" {{ old('send_to') == 'other' ? 'selected' : '' }}>Other Option</option>
                                        </select>
                                        <input class="hide form-control mt-1" type="text" id="customOther" placeholder="Input Send To">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingrequestby"><i style="width: 15px; padding-top: 10px;" data-feather="user"></i> Request By <span style="color: red">*</span></label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingrequestby" placeholder="Who Submitted" name="ws" required="" data-live-search="true">

                                            @foreach ($dataws as $ws)

                                            @if(Auth::user()->name == $ws->name)
                                                <option value="{{ $ws->id }}"  selected>{{ $ws->name }}</option>
                                            @else
                                            <option value="{{ $ws->id }}" {{ old('ws') == $ws->id ? 'selected' : '' }}>{{ $ws->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>

                                        @error('ws')
                                        <div class='mt-1'>
                                            <span class=" text-danger" asp-validation-for="ws">
                                                {{ $message }}
                                            </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingdepartment"><i style="width: 15px; padding-top: 10px;" data-feather="briefcase"></i> Department <span style="color: red">*</span></label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" required="" style="pointer-events: none; background-color: #e9ecef; cursor: not-allowed;">
                                            @foreach ($datadepartment as $dp)
                                            @if(Auth::user()->department == $dp->name)
                                            <option value="{{ $dp->id }}" selected>{{ $dp->name }}</option>
                                            @else
                                            <option value="{{ $dp->id }}" {{ old('department') == $dp->id ? 'selected' : '' }}>{{ $dp->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('departemnt')
                                        <div class='mt-1'>
                                            <span class=" text-danger">
                                                {{ $message }}
                                            </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingtype"><i style="width: 15px; padding-top: 10px;" data-feather="tag"></i> Type PR <span style="color: red">*</span></label>
                                        <select class="form-select type_pr" placeholder="Select Type" name="type" required>
                                            <option value="">Select Type</option>
                                            <option value="Standard"  {{ old('type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                            <option value="SPK_Normal" {{ old('type') == 'SPK_Normal' ? 'selected' : '' }}>SPK</option>
                                            @if (Auth::user()->is_fast_track)
                                            <option value="SPKBased" {{ old('type') == 'SPKBased' ? 'selected' : '' }}>SPK Completed</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="" style="font-weight: bold;"><i style="width: 15px; padding-top: 10px;" data-feather="user-check"></i> Send Approval To <span style="color: red">*</span></label>
                                        <select class="form-select approver" id="floatingproposedto" placeholder="Proposed To" name="atasan" required="">
                                            <option selected value="{{ $atasan->id }}" {{ old('atasan') == $atasan->id ? 'selected' : '' }}>{{ $atasan->name }}</option>
                                            @if(old('atasan') == '6')
                                                <option value="6" selected>Sindu Irawan</option>
                                            @endif
                                        </select>
                                        @error('atasan')
                                        <div class='mt-1'>
                                            <span class=" text-danger">
                                                {{ $message }}
                                            </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-4 spk-upload {{ old('type') == 'SPK_Normal' || old('type') == 'SPKBased' ? '' : 'hide' }}">
                                    <div class="form-group">
                                        <label><i style="width: 15px; padding-top: 10px;" data-feather="file-text"></i> Attach File SPK <span style="color: red">*</span></label>
                                        <input type="file" placeholder="Choose File" class="form-upload-spk form-control"  name="file_spk">
                                    </div>
                                </div>
                                {{-- {{ dd(old('category_purpose'), old('category_purpose') == 'project') }} --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingwhosubmitted"><i style="width: 15px; padding-top: 10px;" data-feather="target"></i>
                                            Purpose
                                            <span style="color: red">*</span>
                                        </label>
                                        <select class="form-select pageSelect" id="pageSelect" name="category_purpose" data-live-search="true" placeholder="Purpose">
                                            <!-- Tampilkan nilai lama jika ada -->
                                            @if (!old('category_purpose'))
                                                <option value="">Select Category Purpose</option>
                                            @endif
                                        
                                            <!-- Looping permitted purposes -->
                                            @foreach ($permitted_purpose as $purpose)
                                                <option value="{{ strtolower($purpose) }}" {{ old('category_purpose') == strtolower($purpose) ? 'selected' : '' }}>{{ ucfirst($purpose) }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_purpose')
                                        <div class='mt-1'>
                                            <span class=" text-danger" asp-validation-for="email">
                                                {{ $message }}
                                            </span>
                                        </div>
                                        @enderror
                                        {{-- Project Dropdown --}}
                                        <div class="mt-2 {{ old('category_purpose') != 'project' ? 'hide' : '' }}" id="selectedInput">
                                        <select class="prepr mt-2 projectList" id="projectlist" name="project" data-live-search="true">
                                            @if(!old('category_purpose'))
                                            <option value="" selected>Select Project</option>
                                            @endif
                                            @foreach ($prepr as $p)
                                                @if(old('project') && old('project') == $p->project_id)
                                                <option value="{{ old('project') }}" selected>{{ $p->project->name }}</option>
                                                @else
                                                <option value="{{ $p->project_id }}">{{ $p->project->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                         </div>
                                        {{-- End Project Dropdown --}}

                                        {{-- Office Dropdown --}}
                                        <div class="{{ old('category_purpose') == 'office' ? '' : 'hide' }}" id="selectedInput2">
                                        <select class="js-example-basic-single" name="company">
                                            @foreach ($purpose_office as $o)
                                            <option value="{{ $o->id }}">{{ $o->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Office Dropdown --}}

                                        {{-- Workshop Dropdown --}}
                                        <div class="{{ old('category_purpose') == 'workshop' ? '' : 'hide' }}" id="selectedInput3">
                                        <select class="js-example-basic-single" name="workshop">
                                            @foreach ($purpose_workshop as $e)
                                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Workshop Dropdown --}}

                                        {{-- Inventory Dropdown --}}
                                        <div class="{{ old('category_purpose') == 'inventory' ? '' : 'hide' }}" id="selectedInput4">
                                        <select class="js-example-basic-single" name="inventory">
                                            @foreach ($purpose_inventory as $pi)
                                            <option value="{{ $pi->id }}">{{ $pi->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Inventory Dropdown --}}

                                        {{-- RND Dropdown --}}
                                        <div class="{{ old('category_purpose') == 'rnd' ? '' : 'hide' }}" id="selectedInput5">
                                        <select class="js-example-basic-single" name="rnd">
                                            @foreach ($purpose_rnd as $rnd)
                                            <option value="{{ $rnd->id }}">{{ $rnd->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End RND Dropdown --}}

                                          {{-- Travel Dropdown --}}
                                          <div class="{{ old('category_purpose') == 'travel' ? '' : 'hide' }}" id="selectedInput6">
                                            <select class="js-example-basic-single" name="travel">
                                                @foreach ($purpose_travel as $travel)
                                                <option value="{{ $travel->id }}">{{ $travel->name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            {{-- End Travel Dropdown --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i style="width: 15px; padding-top: 10px;" data-feather="link"></i> Description <span style="color: red">*</span></label>
                                        <div class="">
                                            <textarea name="desc" id="floatingNoTelpon" class="form-control" rows="4" required>{{ old('desc') }}</textarea>
                                            @error('desc')
                                            <div class='mt-1'>
                                                <span class=" text-danger">
                                                    {{ $message }}
                                                </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-select mt-4 @if (old('project') != null) hide @endif" placeholder="Purpose" name="-" data-live-search="true" id="pengajuan-select">
                                            <option value="">Select Pengajuan</option>
                                            @foreach ($ppb as $p)
                                            <option value="{{ $p->id }}">{{ $p->id }} - {{ $p->desc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group process_by_form hide">
                                        <label> Process By <span style="color: red;">*</span></label>
                                        <select class="form-select form-select-process-by" placeholder="Process By" name="process_by">
                                            <option value="{{ old('process_location')  }}" selected>{{ old('process_location') ?? 'Select Processor'   }}</option>
                                            <option value="Tebet">Tebet</option>
                                            <option value="Cikunir">Cikunir</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Attach File PR </label>
                                        <input type="file" placeholder="Choose File" class="form-control"  name="file_pr">
                                    </div>
                                </div>

                                @php
                                    $ItemsProject = [];
                                    if (old('project') != null) {
                                        // dd(old('project'));
                                        $ItemsProject =  App\Models\Pre_pr::with('partItem')->where('project_id',old('project'))->first();
                                    }
                                    $no = 1;
                                    $paramItems = request()->query('items');
                                @endphp


                                <br>
                                <hr>
                                <table class="table table-bordered item order-entry">
                                    <tr style="text-align: center;">
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            No</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Item</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Link</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Qty</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            UOM</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            File</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Action</th>

                                    </tr>
                                    @if($ppb_old->isEmpty() && empty(old('item')) && empty($paramItems))
                                    <tr>
                                        <td style="text-align:center;">
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            <textarea name="item[]" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>
                                            <div class="selectItem hide">
                                                <select class="js-example-basic-single itemprePR miaw1 " name="item[]"></select>
                                            </div>
                                        </td>
                                        <td class="td-link wave1">
                                            <input type="text" class="form-control form-link" name="link[]" placeholder="Link (Not Mandatory)">
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/>
                                        </td>
                                        <td class="td-uom wave1">
                                            <select class="form-select form-uom" placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                                                @foreach ($uom as $u)
                                                    <option value="{{ $u->name }}">{{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" >
                                            @error('path_file')
                                            <div class='mt-1'>
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            </div>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" name="add" class="btn btn-danger remove-input-field">
                                                <i class="icofont icofont-ui-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @elseif($ppb_old->isEmpty())
                                        @php
                                            // Ambil data item dan qty
                                            $items = old('item', []);
                                            $uniqueItems = array_unique($items);
                                            $items = array_values($uniqueItems);
                                        @endphp

                                        @foreach ($items as $index => $oldItem)
                                            <tr>
                                                <td style="text-align:center;">
                                                    {{ $no++ }}
                                                </td>
                                                <td>
                                                    @if(old('category_purpose') == 'project' && empty($paramItems))
                                                        {{-- Jika kategori tujuan adalah project, tampilkan select, bukan textarea --}}
                                                        <div class="selectItem">
                                                            <select class="js-example-basic-single" name="item[]" value="{{ $oldItem }}">
                                                                @foreach ($ItemsProject->partItem as $itemp)
                                                                    <option value="{{ $itemp->id }}" {{ $itemp->id == intval($oldItem) ? 'selected' : '' }}>
                                                                        {{ $itemp->child_item }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                        {{-- Jika bukan project, tampilkan textarea --}}
                                                        <textarea name="item[]" class="form-control item-text" rows="2" style="min-width: 300px">{{ $oldItem }}</textarea>
                                                    @endif
                                                    <textarea name="item[]" class="form-control item-text hide" rows="2" style="min-width: 300px">{{ $oldItem }}</textarea>
                                                </td>
                                                <td class="td-link wave2"> 
                                                    <input type="text" class="form-control form-link" name="link[]" placeholder="Link (Not Mandatory)" value="{{ old('link.' . $index) }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required value="{{ old('qty.' . $index) }}"/>
                                                </td>
                                                <td class="td-uom wave2">
                                                    <select class="form-select form-uom" name="kategori[]" required style="min-width: 100px">
                                                        @foreach ($uom as $u)
                                                            <option value="{{ $u->name }}" {{ old('kategori.' . $index) == $u->name ? 'selected' : '' }}>{{ $u->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="file" name="path_file[]" class="form-control" >
                                                    @error('path_file')
                                                    <div class='mt-1'>
                                                        <span class="text-danger">
                                                            {{ $message }}
                                                        </span>
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" name="add" class="btn btn-danger remove-input-field">
                                                        <i class="icofont icofont-ui-close"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @php
                                            $old_number = 1;
                                        @endphp
                                        @if (empty(old('project')))
                                            @foreach ($ppb_old as $item)
                                                <tr>
                                                    <td>
                                                        {{ $old_number++ }}
                                                    </td>
                                                    <td class="text">
                                                        <textarea name="item[]" id="" class="form-control" rows="2" style="min-width: 300px">{{ $item->item }}</textarea>
                                                        {{-- <input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required /> --}}
                                                    </td>
                                                    <td class="td-link wave3">
                                                        <input type="text" class="form-control form-link" name="link[]" placeholder="Link (Not Mandatory)" value="{{ $item->link }}">
                                                    </td>
                                                    <td><input type="number" name="qty[]" placeholder="Input Quantity" value="{{ $item->qty }}" class="form-control form-calc form-qty" style="text-align: center;" required />
                                                    </td>
                                                    <td class="td-uom wave3">
                                                        <select class="form-select form-uom" placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                                                            @foreach ($uom as $u)
                                                                @if($item->kategori == $u->name)
                                                                <option value="{{ $item->kategori }}" selected>{{ $item->kategori }} </option>
                                                                @else
                                                                <option value="{{ $u->name }}">{{ $u->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" >
                                                        @error('path_file')
                                                        <div class='mt-1'>
                                                            <span class=" text-danger" >
                                                                {{ $message }}
                                                            </span>
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <button type="button" name="add" class="btn btn-danger remove-input-field">
                                                            <i class="icofont icofont-ui-close"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                </table>
                                <div class="mt-2">
                                    <button type="button" name="add" class="addItem btn btn-outline-primary">
                                        AddItem
                                        <i class="icofont icofont-ui-add"></i>
                                    </button>
                                </div>
                                <br>
                               <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn_add mt-3" id="submitBtn">Submit</button>
                                    <a href="{{ route('menu-pengajuan-pembelian.index') }}" class="btn btn-dark mt-3">Back</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript Item -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>

    <script>
       let itemsDataMap = {};
       document.addEventListener('DOMContentLoaded', function() {
        var pageSelect = document.getElementById('pageSelect');
        var selectElement = document.querySelector('.itemprePR');
        var selectpreprList = document.querySelector('#projectlist');
        var selectedInput = document.getElementById('selectedInput');
        var selectedInput2 = document.getElementById('selectedInput2');
        var selectedInput3 = document.getElementById('selectedInput3');
        var selectedInput4 = document.getElementById('selectedInput4');
        var selectedInput5 = document.getElementById('selectedInput5');
        var selectedInput6 = document.getElementById('selectedInput6');
        var textareanormal = document.querySelector('.item-text');
        var selectprepr = document.querySelector('.selectItem');
        let oldItems = {!! json_encode(old('item', [''])) !!};
        var selectedValueProject = {!! json_encode(old('project')) ?? 'null' !!};
        let formItem;
        var selectItemsOptions;
        var oldCategoryPurpose = @json(old('category_purpose', ''));
        var selectedInputs = [
            document.getElementById('selectedInput2'),
            document.getElementById('selectedInput3'),
            document.getElementById('selectedInput4'),
            document.getElementById('selectedInput5'),
            document.getElementById('selectedInput6')
        ];
        var selectedPage = '';

        const form_processBy = document.querySelector('.process_by_form');
        const selectProcessBy = document.querySelector('.form-select-process-by');

        // Check URL parameters for project and items
        var urlParams = new URLSearchParams(window.location.search);
        var projectParam = urlParams.get('project');
        var itemsParam = urlParams.get('items');

        if (projectParam) {
            selectedPage = 'project';
            pageSelect.value = selectedPage;
            selectpreprList.value = projectParam;

            // Fetch project data
            fetchProjectData(projectParam);
        }

        let $i;
        if (oldItems) {
            @if(isset($items))
            $i = {{ count($items) }} + 1; // Tambah 1 jika selectedValueProject adalah null
            @else
            $i = 2; // Default ke 1 jika tidak ada item, karena Anda menambah 1
            @endif
        } else {
            $i = 2;
        }

        $(".addItem").on('click', function() {
            addItem();
        });

        document.querySelector('#pengajuan-select').addEventListener('change', (e) => {
            const { value } = e.target;

            const url = new URL(window.location.href);
            url.searchParams.set('pengajuan_id', value);
            window.location.href = url;
        });

        // Event listener for pageSelect change
        pageSelect.addEventListener('change', function() {
            selectedPage = this.value;
            showSelectedInput(selectedPage);
        });

        $('#projectlist').on("select2:select", function(e) {
            console.log(e);
            console.log(selectedValueProject);

            // Jika ada nilai 'old', maka lakukan fetch data
            if (selectedValueProject !== null) {
                fetchProjectData(selectedValueProject);
            } else {
                // Jika tidak ada nilai 'old', gunakan nilai terpilih saat ini
                var currentValue = this.value;
                if (currentValue !== null && currentValue !== '') {
                    fetchProjectData(currentValue);
                }
            }
        });

        if (selectedValueProject) {
            fetchProjectData(selectedValueProject);
        }



        function fetchProjectData(value) {
            console.log(value);
            fetch("{{ route('menu-pengajuan-pembelian.getDataPrePR', ':selectedValue') }}".replace(':selectedValue', value), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(!itemsParam);
                if(!itemsParam){
                updateSelectOptions(data);
                }

                selectItemsOptions = updateSelectOptionAppend(data);

                // If itemsParam exists, pre-select items
                if (itemsParam) {
                    var itemsArray = itemsParam.split(',');
                    itemsArray.forEach(itemId => {
                        addItem(itemId);
                    });
                }

                data.data.part_item.forEach(function(item) {
                    itemsDataMap[item.id] = {
                        uom: item.uom, 
                        link: item.link 
                    };
                });

                // Set selected project value and trigger change
                selectpreprList.value = value;
                $(selectpreprList).trigger('change.select2');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        if (!selectElement) {
            console.log("selectElement not found in the DOM");
        } else {
            function updateSelectOptions(data) {
                console.log(data);
                selectElement.innerHTML = ''; // Now this should work without throwing an error
                let result = data.data.part_item;
                let parentTR = selectElement.closest('tr');
                // Get references to the UOM select and description input
                let uomSelect = parentTR.querySelector('.form-uom');
                let linkform = parentTR.querySelector('.form-link');

                result.forEach(function(item,index) {
                    console.log(item.is_check + item.child_item);
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.child_item;
                    if (index === 0) {
                        option.selected = true;
                        // Set the initial UOM and description
                        updateDetails(item, uomSelect, linkform);
                    }
                    selectElement.appendChild(option);
                    
                });
                 // Add an onchange event listener to update data on selection change
                selectElement.onchange = function() {
                    let selectedItem = result.find(item => item.id == selectElement.value);
                    if (selectedItem) {
                        updateDetails(selectedItem, uomSelect, linkform);
                    }
                };
            }

            // Function to update the UOM and description fields
            function updateDetails(item, uomSelect, linkform) {
                linkform.value = item.link;
            }
        }

        function updateSelectOptionAppend(data) {
            let options = ''; // Variabel options didefinisikan di sini
            let result = data.data.part_item;
            result.forEach(function(item) {
                options += `<option value="${item.id}">${item.child_item}</option>`;
                if(projectParam){
                    itemsDataMap[item.id] = {
                        uom: item.uom, // Assuming 'uom' is available in the fetched data
                        link: item.link // Assuming 'description' is available in the fetched data
                    };
                }
                
            });

            return options;

        
        }

        function addItem(itemId = null) {
            var item;
            var selectedProject = {!! json_encode(old('project')) ?? null !!};
            console.log(selectItemsOptions);
            if (selectedPage) {
                if (selectedPage === 'project') {
                    formItem = `<select class="js-example-basic-single itemprePR miaw2" name="item[]" onchange="generateUomDesc(this);">` + selectItemsOptions + `</select>`;
                    if (itemId) {
                        formItem = formItem.replace(`<option value="${itemId}">`, `<option value="${itemId}" selected>`);
                    }
                } else {
                    formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
                }
            } else if ({!! json_encode(old('category_purpose')) ?? 'null' !!} !== 'null') {
                if ({!! json_encode(old('category_purpose')) ?? null !!} === 'project') {
                    formItem = `<select class="js-example-basic-single itemprePR" name="item[]" onchange="generateUomDesc(this);">
                        @if(!empty($ItemsProject->partItem) || !empty($ItemsProject))
                            @foreach ($ItemsProject->partItem as $itemp)
                                <option value="{{ $itemp->id }}">
                                    {{ $itemp->child_item }}
                                </option>
                            @endforeach
                        @else
                        <option value="Null">Null</option>
                        @endif
                    </select>`;
                } else {
                    formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
                }
            } else {
                formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
            }

            console.log(formItem);
            item = `<tr>
                        <td style="text-align:center;">
                            `+ $i +`
                        </td>
                        <td class="item-text">
                            `+ formItem +`
                        </td>
                        <td class="td-link waveappend">
                            <input type="text" class="form-control form-link" name="link[]" placeholder="Link (Not Mandatory)">
                        </td>
                        <td>
                            <input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/>
                        </td>
                        <td class="td-uom waveappend">
                            <select class="form-select form-uom" placeholder="Kategori" name="kategori[]" >
                                @foreach ($uom as $u)
                                    <option value="{{ $u->name }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="file" name="path_file[]" placeholder="Choose File" multiple class="form-control">
                            @error('path_file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </td>
                        <td style="text-align: center;">
                            <button type="button"  class="btn btn-danger remove-input-field"><i class="icofont icofont-ui-close"></i></button>
                        </td> `;
            $(".item").append(item)
            let newSelectElements = document.querySelectorAll(".itemprePR");
                if (newSelectElements.length > 0) {
                    newSelectElements.forEach(function(element) {
                        console.log(element)
                        generateUomDesc(element);
                    });
                }
            $(".js-example-basic-single").select2();
            $i++
        }

        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });

        // Show And Hide Form Purpose
        // function hideAllSelectedInputs() {
        //     selectedInput.classList.add('hide');
        //     selectedInputs.forEach(function(input) {
        //         input.classList.add('hide');
        //     });
        // }

        function showSelectedInput(page) {
            // hideAllSelectedInputs();
            if (page === "project") {
                selectedInput.classList.remove('hide');
                selectedInput2.classList.add('hide');
                selectedInput3.classList.add('hide');
                selectedInput4.classList.add('hide');
                selectedInput5.classList.add('hide');
                selectedInput6.classList.add('hide');
                textareanormal.classList.add('hide');
                document.querySelector('#pengajuan-select').classList.add('hide');
                textareanormal.disabled = true;
                selectprepr.classList.remove('hide');
                selectprepr.classList.disabled = false;
                form_processBy.classList.add('hide');
                selectProcessBy.removeAttribute("required");

            } else if(page === "office") {
                selectedInput2.classList.remove('hide');
                selectedInput.classList.add('hide');
                selectedInput3.classList.add('hide');
                selectedInput4.classList.add('hide');
                selectedInput5.classList.add('hide');
                selectedInput6.classList.add('hide');
                selectprepr.classList.add('hide');
                selectprepr.classList.disabled = true;
                document.querySelector('#pengajuan-select').classList.remove('hide');
                document.querySelector('#pengajuan-select').classList.remove('hide');
                textareanormal.classList.remove('hide');
                textareanormal.disabled = false;
                form_processBy.classList.add('hide');
                selectProcessBy.removeAttribute("required");

            } else if(page === "workshop") {
                selectedInput3.classList.remove('hide');
                selectedInput.classList.add('hide');
                selectedInput2.classList.add('hide');
                selectedInput4.classList.add('hide');
                selectedInput5.classList.add('hide');
                selectedInput6.classList.add('hide');
                selectprepr.classList.add('hide');
                selectprepr.classList.disabled = true;
                document.querySelector('#pengajuan-select').classList.remove('hide');
                textareanormal.classList.remove('hide');
                textareanormal.disabled = false;
                form_processBy.classList.remove('hide');
                selectProcessBy.setAttribute('required', '');
            } else if(page === "inventory") {
                selectedInput4.classList.remove('hide');
                selectedInput.classList.add('hide');
                selectedInput2.classList.add('hide');
                selectedInput3.classList.add('hide');
                selectedInput5.classList.add('hide');
                selectedInput6.classList.add('hide');;
                selectprepr.classList.add('hide');
                selectprepr.classList.disabled = true;
                document.querySelector('#pengajuan-select').classList.remove('hide');
                textareanormal.classList.remove('hide');
                textareanormal.disabled = false;
                form_processBy.classList.remove('hide');
                selectProcessBy.setAttribute('required', '');
            } else if(page === "rnd") {
                selectedInput5.classList.remove('hide');
                selectedInput.classList.add('hide');
                selectedInput2.classList.add('hide');
                selectedInput4.classList.add('hide');
                selectedInput3.classList.add('hide');
                selectedInput6.classList.add('hide');
                selectprepr.classList.add('hide');
                selectprepr.classList.disabled = true;
                document.querySelector('#pengajuan-select').classList.remove('hide');
                textareanormal.classList.remove('hide');
                textareanormal.disabled = false;
                form_processBy.classList.remove('hide');
                selectProcessBy.setAttribute('required', '');
            } else if(page === "travel") {
                selectedInput6.classList.remove('hide');
                selectedInput.classList.add('hide');
                selectedInput2.classList.add('hide');
                selectedInput4.classList.add('hide');
                selectedInput5.classList.add('hide');
                selectedInput3.classList.add('hide');
                selectprepr.classList.add('hide');
                selectprepr.classList.disabled = true;
                document.querySelector('#pengajuan-select').classList.remove('hide');
                textareanormal.classList.remove('hide');
                textareanormal.disabled = false;
                form_processBy.classList.add('hide');
                selectProcessBy.removeAttribute("required");
            } else {
                if (page !== "") {
                    var index = parseInt(page) - 2; // Assuming IDs start from 2
                    if (index >= 0 && index < selectedInputs.length) {
                        selectedInputs[index].classList.remove('hide');
                    }
                }
            }
        }

        showSelectedInput(selectedPage);
       });

       function generateUomDesc(elementOrEvent) {
            var selectedElement = elementOrEvent.target || elementOrEvent;
            console.log(selectedElement);
            let selectedValue = selectedElement.value;
            console.log(selectedValue);
            let parentTd = selectedElement.closest('tr');
            let uomSelect = parentTd.querySelector('.form-uom');
            let formlink = parentTd.querySelector('.form-link');
            let uomData = selectedElement.getAttribute('data-uom');
            let linkData = selectedElement.getAttribute('data-link');
            console.log(itemsDataMap);
            // Assuming itemsDataMap is populated correctly from fetchProjectData
            if (itemsDataMap[selectedValue]) {
                let selectedData = itemsDataMap[selectedValue];

                // uomSelect.innerHTML = ''; // Clear existing options
                // let option = document.createElement('option');
                // option.value = selectedData.uom;
                // option.textContent = selectedData.uom;
                // option.selected = true;
                // uomSelect.appendChild(option);
                console.log(selectedData)
                formlink.value = selectedData.link || null;
            } else if(uomData || linkData) {
                // uomSelect.innerHTML = ''; // Clear existing options
                // let option = document.createElement('option');
                // option.value = uomData;
                // option.textContent = uomData;
                // option.selected = true;
                // uomSelect.appendChild(option);

                formlink.value = linkData;
            } 
        }
    </script>

    <script type="text/javascript">
        var pageSelector = document.getElementById('pageSelector');
        var customOther = document.getElementById('customOther');

        pageSelector.addEventListener('change', function() {
            if (this.value == "other") {
                customOther.setAttribute('name', 'send_to');
                customOther.classList.remove('hide');
            } else {
                customOther.removeAttribute('name', 'send_to');
                customOther.classList.add('hide');
            }
        })

    </script>

    <script type="text/javascript">
     document.getElementById('formAdd').addEventListener('submit', function() {
        var submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Processing';
     });
    </script>

    <script>
        document.getElementById('floatingdepartment').addEventListener('change', function () {
            const departmentId = this.value;

            // Clear the category_purpose select
            const pageSelect = document.getElementById('pageSelect');
            pageSelect.innerHTML = '<option value="">Loading...</option>';

            // Fetch permitted_purposes from server
            fetch(`/department/get-permitted-purposes/${departmentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        pageSelect.innerHTML = '<option value="">No permitted purposes available</option>';
                        return;
                    }

                    // Populate the category_purpose select with the fetched data
                    if (Array.isArray(data) && data.length > 0) {
                        let options = '<option value="">Select Category Purpose</option>';
                        data.forEach(purpose => {
                            options += `<option value="${purpose.toLowerCase()}">${purpose.charAt(0).toUpperCase() + purpose.slice(1)}</option>`;
                        });
                        pageSelect.innerHTML = options;
                    } else {
                        // Jika data kosong
                        pageSelect.innerHTML = '<option value="">No permitted purposes available</option>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    pageSelect.innerHTML = '<option value="">Error loading data</option>';
                });
        });
    </script>



    {{-- Script buat Show And Hide Upload File --}}
    <script>
        const typePR = document.querySelector('.type_pr');
        const spkUpload = document.querySelector('.spk-upload');
        const formSpk = document.querySelector('.form-upload-spk');
        const sendApproval = document.querySelector('.approver');
        let existingOption = sendApproval.querySelector("option[value='6']");
        const selectDepartment = document.getElementById('floatingdepartment');
        let opt = document.createElement('option');

        typePR.addEventListener('change', function() {
            if (this.value == 'SPKBased' || this.value == 'SPK_Normal') {
                spkUpload.classList.remove('hide');
                if (formSpk && formSpk.tagName.toLowerCase() === 'input') {
                    formSpk.setAttribute('required', ''); // Tambahkan atribut required
                } else {
                    console.error('Element is not an input or does not exist');
                }
                if (!existingOption) {
                    opt.value = 6;
                    opt.text = 'Sindu Irawan';
                    sendApproval.appendChild(opt);
                    existingOption = opt; // Update existingOption to point to the newly added option                
                }
                if(this.value == 'SPKBased'){
                    selectDepartment.style.pointerEvents = "";
                    selectDepartment.style.backgroundColor = "";
                    selectDepartment.style.cursor = "";
                }else{
                    selectDepartment.style.pointerEvents = "none";
                    selectDepartment.style.backgroundColor = "#e9ecef";
                    selectDepartment.style.cursor = "not-allowed";
                }
                    

                
            } else {
                spkUpload.classList.add('hide');
                document.querySelector('.form-upload-spk').removeAttribute('required');
                if (existingOption) {
                    sendApproval.removeChild(existingOption);
                    existingOption = null; // Reset existingOption after removal
                }
                selectDepartment.style.pointerEvents = "none";
                selectDepartment.style.backgroundColor = "#e9ecef";
                selectDepartment.style.cursor = "not-allowed";
            }
        });
    </script>
</section>
@endsection

