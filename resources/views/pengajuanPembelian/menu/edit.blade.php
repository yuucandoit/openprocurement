<title>Edit Data</title>
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
                        <h3>Edit Purchase Request</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-pengajuan-pembelian.index') }}">Purchase
                                    Submission</a></li>
                            <li class="breadcrumb-item">Edit Purchase Submission</li>
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
                            <h5>Edit Purchase Submission</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/menu-pengajuan-pembelian/update/' . $dv->id) }}" id="formAdd"
                                method="post" enctype="multipart/form-data">
                                @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="floatingTanggal"><i data-feather="calendar"></i> Date :</label>
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
                                        <label for="floatingdateline"><i data-feather="clock"></i> Deadline :</label>
                                        <select class="form-select @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline" required="">
                                            <option selected="" value="{{ $dv->dateline }}">{{ $dv->dateline }}
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
                                        <select class="form-select" id="pageSelector" placeholder="Send To" name="send_to">
                                            <option value="{{ $dv->send_to }}" selected hidden>{{ $dv->send_to }}</option>
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
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingrequestby" placeholder="Who Submitted" name="ws" required="" data-live-search="true">
                                            <option value="{{ $dv->ws }}" selected hidden>{{ $dv->whosubmit->name }}</option>
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
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" required="">
                                            <option value="{{ $dv->department }}" selected hidden>{{ $dv->dps->name }}</option>
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
                                        <select class="form-select" id="floatingproposedto" placeholder="Proposed To" name="atasan" required="">
                                            @if($dv->atasan == $atasan->id)
                                            <option value="{{ $atasan->id }}" selected>{{ $atasan->name }}</option>
                                            @else
                                            <option value="{{ $dv->atasan }}" selected>{{ $dv->bod->name }}</option>
                                            @endif
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
                                        <label for="floatingNoTelpon"><i data-feather="link"></i> Description :</label>
                                        <div class="">
                                            <textarea name="desc" id="floatingNoTelpon" class="form-control" rows="4">{{ $dv->desc }}</textarea>
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
                                        <input type="file" placeholder="Choose File" class="form-control" enctype="multipart/form-data" name="file_pr">
                                        @if($dv->file_pr)
                                            <p>Old File: <a href="{{ asset('upload_file_pr/'.$dv->file_pr) }}" target="_blank">{{ $dv->file_pr }}</a></p>
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
                                        {{-- Project Dropdown --}}
                                        <div class="hide mt-2" id="selectedInput">
                                        <select class= "js-example-basic-single mt-2 "  name="project">
                                            @foreach ($purpose as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                         </div>
                                        {{-- End Project Dropdown --}}

                                        {{-- Office Dropdown --}}
                                        <div class="hide" id="selectedInput2">
                                        <select class="js-example-basic-single" name="office">
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

                                        {{-- Inventory Dropdown --}}
                                        <div class="hide" id="selectedInput5">
                                        <select class="js-example-basic-single" name="rnd">
                                            @foreach ($purpose_rnd as $rnd)
                                            <option value="{{ $rnd->id }}">{{ $rnd->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        {{-- End Inventory Dropdown --}}
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
                                    @foreach ($item as $i)
                                    <tr>
                                        <td style="text-align: center;">
                                            {{ $no_edit++ }}
                                        </td>
                                        <td class="text">
                                            <input type="text" name="id[]" placeholder="Input Item" class="form-control" style="text-align: center;" value="{{ $i->id }}" hidden />
                                            <textarea name="item[]" id="" class="form-control" rows="2" style="min-width: 300px">{{ $i->item }}</textarea>
                                            {{-- <input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required /> --}}
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
                                            <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
                                        </td>
                                        <td style="text-align: center;">

                                        </td>
                                    </tr>
                                    @endforeach
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
                let $i = {{ $no_edit }};
                let pengajuanData = {!! $dv !!};
                    $(".addItem").on('click', function() {
                        addItem();
                    });

                    // Event listener for pageSelect change
                    pageSelect.addEventListener('change', function() {
                        selectedPage = this.value;
                        console.log('Selected page:', selectedPage);
                        showSelectedInput(selectedPage);
                    });


                    console.log(pengajuanData);

                    //Fetch PrePR Data
                    fetch("{{ route('menu-pengajuan-pembelian.getDataPrePR', ':selectedValue') }}".replace(':selectedValue', pengajuanData.purpose_id), {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        selectItemsOptions = updateSelectOptionAppend(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

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
                        console.log(selectedPage);
                        console.log(selectItemsOptions);
                        if(pengajuanData.purpose_type){
                            if(pengajuanData.purpose_type === "App\\Models\\ReferensiNamaProject"){
                                formItem = `<select class="js-example-basic-single itemprePR" name="item[]">`+ selectItemsOptions +`</select>`;
                            }else{
                                formItem = `<textarea name="item[]" id="" class="form-control item-text" rows="2" style="min-width: 300px"></textarea>`;
                            }
                        }else {
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
                                    <button type="button"  class="btn btn-danger remove-input-field"><i class="icofont icofont-ui-close"></i></button>
                                </td> `;
                        $(".item").append(item)
                        $(".js-example-basic-single").select2();
                        $i++
                    }
                    $(document).on('click', '.remove-input-field', function() {
                        $(this).parents('tr').remove();
                    });
                // End Append Table Item
            });
        </script>
        <script type="text/javascript">
            var pageSelector = document.getElementById('pageSelector');
            var customInput = document.getElementById('customInput');

            pageSelector.addEventListener('change', function() {
                if (this.value == "custom") {
                    customInput.classList.remove('hide');
                } else {
                    customInput.classList.add('hide');
                }
            })
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

    </section>
@endsection
