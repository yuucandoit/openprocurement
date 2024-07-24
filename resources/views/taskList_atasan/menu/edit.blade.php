<title>Edit Data</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit Task List</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-taskList-atasan.history') }}">History Super
                                    User</a></li>
                            <li class="breadcrumb-item">Edit Task List</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
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
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5>Edit Task List</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/menu-taskList-atasan/update/' . $dv->id) }}" id="formAdd"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="floatingTanggal"><i data-feather="calendar"></i> Date :</label>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control page @error('date_ps') is-invalid @enderror"
                                                id="floatingTanggal" placeholder="Tanggal" name="date_ps"
                                                value="{{ old('date_ps', date('Y-m-d')) }}">
                                            @error('date_ps')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingdateline"><i data-feather="clock"></i> Date Line :</label>
                                            <select class="form-select page @error('dateline') is-invalid @enderror"
                                                id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}"
                                                name="dateline">
                                                <option selected hidden value="{{ $dv->dateline }}">{{ $dv->dateline }}</option>
                                                <option value="≤3Jam">≤ 3 Jam</option>
                                                <option value="≤24Jam">≤ 24 Jam</option>
                                                <option value="≤2Hari">≤ 2 Hari</option>
                                                <option value="SesuaiPo">Sesuai PO</option>
                                            </select>
                                            @error('dateline')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingwhosubmitted"><i data-feather="user"></i> Who Submitted
                                                :</label>
                                            <select class="form-select page @error('ws') is-invalid @enderror"
                                                id="floatingwhosubmitted" placeholder="Who Submitted" name="ws">
                                                <option selected hidden value="{{ $dv->whosubmit->id }}">{{ $dv->whosubmit->name }}
                                                </option>
                                                @foreach ($dataws as $w)
                                                    <option value="{{ $w->id }}">{{ $w->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('ws')
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
                                        }

                                        .page {
                                            height: 50px;
                                        }
                                    </style>
                                    {{-- End Css Hide --}}

                                    <div class="col-md-6" style="margin-bottom: -20px;">
                                        <div class="form-group">
                                            <label for="floatingwhosubmitted"><i class="icofont icofont-macbook"></i>
                                                Purpose
                                                : </label>
                                            <select class="form-select page pageSelect" id="pageSelect"
                                                placeholder="Purpose" name="category_purpose">
                                                <option value="">Select Category Purpose</option>
                                                <option value="project">Project</option>
                                                <option value="office">Office</option>
                                                <option value="workshop">Workshop</option>
                                                <option value="inventory">Inventory</option>
                                            </select>
                                            <p style="color: red;">* Please re-input form purpose</p>
                                            {{-- Project Dropdown --}}
                                            <select class=" form-select hide mt-2" id="selectedInput" name="project">
                                                @foreach ($purpose as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Project Dropdown --}}

                                            {{-- Office Dropdown --}}
                                            <select class=" form-select hide" id="selectedInput2" name="office">
                                                @foreach ($purpose_office as $o)
                                                    <option value="{{ $o->id }}">{{ $o->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Office Dropdown --}}

                                            {{-- Workshop Dropdown --}}
                                            <select class=" form-select hide" id="selectedInput3" name="workshop">
                                                @foreach ($purpose_workshop as $e)
                                                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Workshop Dropdown --}}

                                            {{-- Inventory Dropdown --}}
                                            <select class=" form-select hide" id="selectedInput4" name="inventory">
                                                @foreach ($purpose_inventory as $pi)
                                                    <option value="{{ $pi->id }}">{{ $pi->name }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Inventory Dropdown --}}
                                        </div>

                                        @error('category_purpose')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingwhosubmitted"><i data-feather="airplay"></i> Purpose :</label>
                                            <select class="form-select page @error('purpose') is-invalid @enderror"
                                                id="pageSelector" placeholder="Purpose" name="purpose">
                                                <option selected hidden value="{{ $dv->purpose->name }}">{{ $dv->purpose->name }}
                                                </option>
                                                @foreach ($purpose as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                                <option value="custom" hidden disabled>+ Add Project</option>
                                            </select>
                                            <input type="text" class="hide form-control mt-2"
                                                placeholder="Input Project" name="nama" id="customInput">
                                            @error('purpose')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingdepartment"><i data-feather="briefcase"></i> Department
                                                :</label>
                                            <select class="form-select page @error('department') is-invalid @enderror"
                                                id="floatingdepartment" placeholder="department" name="department">
                                                <option value="{{ $dv->dps->id }}" selected hidden>{{ $dv->dps->name }}</option>
                                                @foreach ($datadepartment as $d)
                                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingNoTelpon"><i data-feather="link"></i> Description :</label>
                                            <div class="form-floating">
                                                <textarea name="desc" id="floatingNoTelpon" class="form-control page @error('desc') is-invalid @enderror"
                                                    cols="50" rows="30">{{ $dv->desc }}</textarea>
                                                @error('desc')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    class="icofont icofont-stamp"></i> Approved By :</label>
                                            <select class="form-select page @error('atasan') is-invalid @enderror"
                                                id="floatingproposedto" placeholder="Proposed To" name="atasan">
                                                <option selected hidden value="{{ $dv->bod->id }}"
                                                    {{ $dv->bod->id ? 'selected' : '' }}> {{ $dv->bod->name }}</option>
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    data-feather="dollar-sign"></i> Currency :</label>
                                            <select class="form-select page @error('matauang') is-invalid @enderror"
                                                id="floatingdateline" placeholder="Mata Uang" name="matauang">
                                                <option selected="" value="{{ $dv->matauang }}">{{ $dv->matauang }}</option>
                                                <option value="USD">USD</option>
                                                <option value="RP">RP</option>
                                            </select>
                                            @error('matauang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                     data-feather="send"></i> Send To</label>
                                            <select class="form-select page" id="pageSelector" placeholder="Send To"
                                                name="send_to">
                                                <option selected value="{{ $dv->send_to }}">{{ $dv->send_to }}
                                                </option>
                                                <option value="Tebet">Tebet</option>
                                                <option value="Cikunir">Cikunir</option>
                                                <option value="other">Other Option</option>
                                            </select>
                                            <input class="hide form-control mt-2" type="text" id="customOther"
                                                placeholder="Input Send To">
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="table table-bordered mt-2 mx-2 item order-entry" id="dynamicAddRemove">
                                        <tr style="text-align: center;">
                                            <th
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Item</th>
                                            <th
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Qty</th>
                                            <th
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Category</th>
                                            {{-- <th
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Action</th> --}}
                                        </tr>
                                        @php
                                            $id = 0;
                                            $id++;
                                        @endphp
                                        @foreach ($item as $i)
                                            <tr>
                                                <td class="text">
                                                    <input type="text" name="id[]"
                                                    placeholder="Input Item" class="form-control"
                                                    style="text-align: center;" value="{{ $i->id }}" hidden />
                                                    <input type="text" name="item[]"
                                                        placeholder="Input Item" class="form-control"
                                                        style="text-align: center;" value="{{ $i->item }}"
                                                     />
                                                </td>
                                                <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                        class="form-control form-calc form-qty"
                                                        style="text-align: center;" value="{{ $i->qty }}"
                                                     />
                                                </td>
                                                <td>
                                                    <select class="form-select " placeholder="Kategori" name="kategori[]"
                                                        value="{{ $i->kategori }}">
                                                        <option selected value="{{ $i->kategori }}">{{ $i->kategori }}
                                                        </option>
                                                        <option value="Pcs">Pcs </option>
                                                        <option value="Lusin">Lusin </option>
                                                        <option value="Box">Box </option>
                                                        <option value="Unit">Unit </option>
                                                    </select>
                                                </td>
                                                {{-- <td style="text-align: center;">
                                                    <button type="button" name="add"
                                                        class="btn btn-danger remove-input-field">
                                                        <i class="icofont icofont-ui-close"></i>
                                                    </button>
                                                </td> --}}
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
                                        <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                                        <a href="{{ route('menu-taskList-atasan.index') }}"
                                            class="btn btn-dark mt-3">Back</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript Item -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            //Add Form
            $(".addItem").on('click', function() {
                addItem();
            });

            function addItem() {
                var item =
                    '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td><td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="icofont icofont-ui-close"></i></button></td> ';
                $(".item").append(item)
            }
            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
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
    var pageSelect = document.getElementById('pageSelect');
    var selectedInput = document.getElementById('selectedInput');
    var selectedInputCustom = document.getElementById('selectedInputCustom');

    var selectedInput2 = document.getElementById('selectedInput2');
    var selectedInputCustom2 = document.getElementById('selectedInputCustom2');

    var selectedInput3 = document.getElementById('selectedInput3');
    var selectedInputCustom3 = document.getElementById('selectedInputCustom3');

    var selectedInput4 = document.getElementById('selectedInput4');
    var selectedInputCustom4 = document.getElementById('selectedInputCustom4');


    // Company
    pageSelect.addEventListener('change', function() {
        if (this.value == "project") {
            selectedInput.classList.remove('hide');
        } else {
            selectedInput.classList.add('hide');
        }
    })

    // Private Person
    pageSelect.addEventListener('change', function() {
        if (this.value == "office") {
            selectedInput2.classList.remove('hide');
        } else {
            selectedInput2.classList.add('hide');
        }
    })

    // Ecommerce
    pageSelect.addEventListener('change', function() {
        if (this.value == "workshop") {
            selectedInput3.classList.remove('hide');
        } else {
            selectedInput3.classList.add('hide');
        }
    })

    // Inventory
    pageSelect.addEventListener('change', function() {
        if (this.value == "inventory") {
            selectedInput4.classList.remove('hide');
        } else {
            selectedInput4.classList.add('hide');
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

    </section>
@endsection
