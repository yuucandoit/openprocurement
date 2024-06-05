<title>Purchase Request</title>
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
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
                                    <label for="floatingTanggal"><i class="fa fa-calendar"></i> Date <span style="color: red">*</span></label>
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
                                        <label for="floatingdateline"><i class="fa fa-clock-o"></i> Deadline <span style="color: red">*</span></label>
                                        <select class="form-select @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline" required="">
                                            @if(old('dateline'))
                                            <option selected="" disabled="" value="{{ old('dateline') }}">{{ old('dateline') }}</option>
                                            @else
                                            <option selected="" disabled="" value="">Select Deadline</option>
                                            @endif
                                            <option value="≤24Jam">1 hari</option>
                                            {{-- <option value="≤48Jam">2 hari</option> --}}
                                            <option value="≤72Jam">2 sd 3 hari</option>
                                            {{-- <option value="≤96Jam">4 hari</option> --}}
                                            <option value="≤168Jam">4 sd 7 hari</option>
                                            <option value="≤336Jam">8 sd 14 hari</option>

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
                                        <label class="" for="pageSelector"><i class="fa fa-send"></i> Send To <span style="color: red">*</span></label>
                                        <select class="form-select" id="pageSelector" placeholder="Send To" name="send_to">
                                            <option value="{{ old('send_to')  }}" selected>{{ old('send_to') ?? 'Select Send To'   }}</option>
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
                                        <label for="floatingrequestby"><i class="fa fa-user"></i> Request By <span style="color: red">*</span></label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingrequestby" placeholder="Who Submitted" name="ws" required="" data-live-search="true">

                                            @foreach ($dataws as $ws)

                                            @if(Auth::user()->name == $ws->name)
                                                <option value="{{ $ws->id }}"  selected>{{ $ws->name }}</option>
                                            @else
                                            <option value="{{ $ws->id }}">{{ $ws->name }}</option>
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
                                        <label for="floatingdepartment"><i class="fa fa-institution"></i> Department <span style="color: red">*</span></label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" required="">
                                            @foreach ($datadepartment as $dp)
                                            @if(Auth::user()->department == $dp->name)
                                            <option value="{{ $dp->id }}" selected>{{ $dp->name }}</option>
                                            @else
                                            <option value="{{ $dp->id }}">{{ $dp->name }}</option>
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
                                        <label class="" style="font-weight: bold;"><i class="icofont icofont-stamp"></i> Send Approval To <span style="color: red">*</span></label>
                                        <select class="form-select" id="floatingproposedto" placeholder="Proposed To" name="atasan" required="">
                                            <option selected value="{{ $atasan->id }}">{{ $atasan->name }}</option>
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
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="floatingNoTelpon"><i class="fa fa-link"></i> Description <span style="color: red">*</span></label>
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
                                        <label for="floatingwhosubmitted"><i class="icofont icofont-macbook"></i>
                                            Purpose
                                            <span style="color: red">*</span>
                                        </label>
                                        <select class="form-select pageSelect" id="pageSelect" placeholder="Purpose" name="category_purpose" data-live-search="true">
                                            @if(old('category_purpose'))
                                            <option value="{{ old('category_purpose') }}">{{ old('category_purpose') }}</option>
                                            @else
                                            <option value="">Select Category Purpose</option>
                                            @endif

                                            <option value="project">Project</option>
                                            <option value="office">Office</option>
                                            <option value="workshop">Workshop</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="rnd">R&D</option>
                                            <option value="travel">Travel</option>
                                        </select>
                                        @error('category_purpose')
                                        <div class='mt-1'>
                                            <span class=" text-danger" asp-validation-for="email">
                                                {{ $message }}
                                            </span>
                                        </div>
                                        @enderror
                                        {{-- @error('category_purpose')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror --}}
                                        {{-- Project Dropdown --}}
                                        <div class="hide mt-2" id="selectedInput">
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
                                        <div class="hide" id="selectedInput2">
                                        <select class="js-example-basic-single" name="company">
                                            @foreach ($purpose_office as $o)
                                            <option value="{{ $o->id }}">{{ $o->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Office Dropdown --}}

                                        {{-- Workshop Dropdown --}}
                                        <div class="hide" id="selectedInput3">
                                        <select class="js-example-basic-single" name="workshop">
                                            @foreach ($purpose_workshop as $e)
                                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Workshop Dropdown --}}

                                        {{-- Inventory Dropdown --}}
                                        <div class="hide" id="selectedInput4">
                                        <select class="js-example-basic-single" name="inventory">
                                            @foreach ($purpose_inventory as $pi)
                                            <option value="{{ $pi->id }}">{{ $pi->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Inventory Dropdown --}}

                                        {{-- RND Dropdown --}}
                                        <div class="hide" id="selectedInput5">
                                        <select class="js-example-basic-single" name="rnd">
                                            @foreach ($purpose_rnd as $rnd)
                                            <option value="{{ $rnd->id }}">{{ $rnd->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End RND Dropdown --}}

                                          {{-- Travel Dropdown --}}
                                          <div class="hide" id="selectedInput6">
                                            <select class="js-example-basic-single" name="travel">
                                                @foreach ($purpose_travel as $travel)
                                                <option value="{{ $travel->id }}">{{ $travel->name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            {{-- End Travel Dropdown --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-select mt-4 @if (old('project') != null) hide @endif" placeholder="Purpose" name="-" data-live-search="true" id="pengajuan-select">
                                            <option value="">Select Pengajuan</option>
                                            @foreach ($ppb as $p)
                                            <option value="{{ $p->id }}">{{ $p->id }} - {{ $p->desc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Attach File PR </label>
                                        <input type="file" placeholder="Choose File" class="form-control" enctype="multipart/form-data" name="file_pr">
                                    </div>
                                </div>

                                @php
                                    if (old('project') != null) {
                                        $ItemsProject =  App\Models\Pre_pr::with('partItem')->where('project_id',old('project'))->first();
                                    }
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
                                            Qty</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Unit</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            File</th>
                                        <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Action</th>

                                    </tr>
                                    @if($ppb_old->isEmpty())
                                    @foreach (old('item', ['']) as $index => $oldItem)
                                        <tr>
                                            <td style="text-align:center;">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>
                                                @if(old('category_purpose') == 'project' )
                                                <textarea name="item[]" id="" class="form-control item-text hide" rows="2" style="min-width: 300px">{{ old('item.' . $index) }}</textarea>
                                                <div class="selectItem">
                                                    <select class="js-example-basic-single itemprePR" name="item[]" value="{{ old('item.' . $index) }}">
                                                        @foreach ($ItemsProject->partItem as $itemp)
                                                        <option value="{{ $itemp->id }}" {{ $oldItem == $itemp->id ? 'selected' : '' }}>{{ $itemp->child_item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @else
                                                <textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px">{{ old('item.' . $index) }}</textarea>
                                                <div class="selectItem hide">
                                                    <select class="js-example-basic-single itemprePR" name="item[]" value="{{ old('item.' . $index) }}">{{ old('item.' . $index) }}</select>
                                                </div>
                                                @endif
                                            </td>
                                            <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required value="{{ old('qty.' . $index) }}"/>
                                            </td>
                                            <td>
                                                <select class="form-select " placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                                                    @foreach ($uom as $u)
                                                        <option value="{{ $u->name }}">{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
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
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        @php
                                            $old_number = 1;
                                        @endphp
                                        @foreach ($ppb_old as $item)

                                            <tr>
                                                <td>
                                                    {{ $old_number++ }}
                                                </td>
                                                <td class="text">
                                                    <textarea name="item[]" id="" class="form-control" rows="2" style="min-width: 300px">{{ $item->item }}</textarea>
                                                    {{-- <input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required /> --}}
                                                </td>
                                                <td><input type="number" name="qty[]" placeholder="Input Quantity" value="{{ $item->qty }}" class="form-control form-calc form-qty" style="text-align: center;" required />
                                                </td>
                                                <td>
                                                    <select class="form-select " placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
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
                                                    <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
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
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                                <div class="mt-2">
                                    <button type="button" name="add" class="addItem btn btn-outline-primary">
                                        AddItem
                                        <i class="fa fa-plus"></i>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>

    <script type="text/javascript">
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
        var selectedInputs = [
            document.getElementById('selectedInput2'),
            document.getElementById('selectedInput3'),
            document.getElementById('selectedInput4'),
            document.getElementById('selectedInput5'),
            document.getElementById('selectedInput6')
        ];
        var selectedPage = '';
        // Append Table Item
          let $i = 2;
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
                console.log('Selected page:', selectedPage);
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

            if(selectedValueProject){
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
                    updateSelectOptions(data);
                    selectItemsOptions = updateSelectOptionAppend(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }

            function updateSelectOptions(data) {
                selectElement.innerHTML = '';
                let result = data.data.part_item;
                console.log(result)
                console.log(oldItems);
                result.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.child_item;
                    selectElement.appendChild(option);
                });
            }

            function updateSelectOptionAppend(data){
                let options = ''; // Variabel options didefinisikan di sini
                let result = data.data.part_item;
                console.log(result)
                result.forEach(function(item) {
                    options += `<option value="${item.id}">${item.child_item}</option>`;
                });
                return options;
            }

            function addItem() {
                var item;
                var selectedProject= {!! json_encode(old('project')) ?? null !!};
                console.log(selectedProject);
                console.log(selectedPage);
                console.log(selectItemsOptions);
                if(selectedPage){
                    if(selectedPage === 'project'){
                        formItem = `<select class="js-example-basic-single itemprePR" name="item[]">`+ selectItemsOptions +`</select>`;
                    }else{
                        formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
                    }
                }else if({!! json_encode(old('category_purpose')) ?? null !!}){
                    if( {!! json_encode(old('category_purpose')) ?? null !!} === 'project'){
                        formItem = `<select class="js-example-basic-single itemprePR" name="item[]">`+ selectItemsOptions +`</select>`;
                    }else {
                        formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
                    }
                }
                else {
                    formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
                }


                item =
                    `<tr>
                        <td style="text-align:center;">
                            `+ $i +`
                        </td>
                        <td class="item-text">
                            `+ formItem +`
                        </td>
                        <td>
                            <input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/>
                        </td>
                        <td>
                            <select class="form-select" placeholder="Kategori" name="kategori[]" >
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
                            <button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button>
                        </td> `;
                $(".item").append(item)
                $(".js-example-basic-single").select2();
                $i++
            }
            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
            });
        // End Append Table Item


        // Show And Hide Form Purpose

                // Function to hide all selected inputs
                function hideAllSelectedInputs() {
                    selectedInput.classList.add('hide');
                    selectedInputs.forEach(function(input) {
                        input.classList.add('hide');
                    });
                }

                // Function to show selected input based on pageSelect value
                function showSelectedInput(page) {
                    hideAllSelectedInputs();
                    if (page === "project") {
                        selectedInput.classList.remove('hide');
                        textareanormal.classList.add('hide');
                        document.querySelector('#pengajuan-select').classList.add('hide');
                        textareanormal.disabled = true;
                        selectprepr.classList.remove('hide');
                        selectprepr.classList.disabled = false;
                    } else if(page === "office") {
                        selectedInput2.classList.remove('hide');
                        selectprepr.classList.add('hide');
                        selectprepr.classList.disabled = true;
                        textareanormal.classList.remove('hide');
                        textareanormal.disabled = false;

                    } else if(page === "workshop") {
                        selectedInput3.classList.remove('hide');
                        selectprepr.classList.add('hide');
                        selectprepr.classList.disabled = true;
                        textareanormal.classList.remove('hide');
                        textareanormal.disabled = false;
                    } else if(page === "inventory") {
                        selectedInput4.classList.remove('hide');
                        selectprepr.classList.add('hide');
                        selectprepr.classList.disabled = true;
                        textareanormal.classList.remove('hide');
                        textareanormal.disabled = false;
                    } else if(page === "rnd") {
                        selectedInput5.classList.remove('hide');
                        selectprepr.classList.add('hide');
                        selectprepr.classList.disabled = true;
                        textareanormal.classList.remove('hide');
                        textareanormal.disabled = false;
                    } else if(page === "travel") {
                        selectedInput6.classList.remove('hide');
                        selectprepr.classList.add('hide');
                        selectprepr.classList.disabled = true;
                        textareanormal.classList.remove('hide');
                        textareanormal.disabled = false;
                    } else {
                        if (page !== "") {
                            var index = parseInt(page) - 2; // Assuming IDs start from 2
                            if (index >= 0 && index < selectedInputs.length) {
                                selectedInputs[index].classList.remove('hide');
                            }
                        }
                    }
                }

                // Event listener for preprList change
                selectpreprList.addEventListener('change', function() {
                    var selectedValue = this.value;
                    console.log('Selected value:', selectedValue);
                });

                // Initialize visibility based on initial pageSelect value
            showSelectedInput(pageSelect.value);
        // End Show And Hide Form Purpose
    });
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

</section>
@endsection

