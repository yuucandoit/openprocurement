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
                    <div class="col-sm-6 mt-4">
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
                            <h5>Edit Task List</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/menu-taskList-atasan/update/' . $dv->id) }}" id="formAdd"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="floatingTanggal"><i class="fa fa-calendar"></i> Date :</label>
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
                                            <label for="floatingdateline"><i class="fa fa-clock-o"></i> Date Line :</label>
                                            <select class="form-select page @error('dateline') is-invalid @enderror"
                                                id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}"
                                                name="dateline">
                                                <option selected hidden>{{ $dv->dateline }} *Select For Update Data</option>
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
                                            <label for="floatingwhosubmitted"><i class="fa fa-user"></i> Who Submitted
                                                :</label>
                                            <select class="form-select page @error('ws') is-invalid @enderror"
                                                id="floatingwhosubmitted" placeholder="Who Submitted" name="ws">
                                                <option selected hidden>{{ $dv->whosubmit->name }} *Select For Update Data
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

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingwhosubmitted"><i class="fa fa-laptop"></i> Purpose :</label>
                                            <select class="form-select page @error('purpose') is-invalid @enderror"
                                                id="pageSelector" placeholder="Purpose" name="purpose">
                                                <option selected hidden>{{ $dv->referensi->name }} *Select For Update Data
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
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="floatingdepartment"><i class="fa fa-institution"></i> Department
                                                :</label>
                                            <select class="form-select page @error('department') is-invalid @enderror"
                                                id="floatingdepartment" placeholder="department" name="department">
                                                <option value="{{ $dv->dps->name }}" selected hidden>{{ $dv->dps->name }}
                                                    *Select For Update Data</option>
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
                                            <label for="floatingNoTelpon"><i class="fa fa-link"></i> Description :</label>
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
                                                <option selected="" value="">* Select For Update Data</option>
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
                                                    class="fa fa-money"></i> Currency :</label>
                                            <select class="form-select page @error('matauang') is-invalid @enderror"
                                                id="floatingdateline" placeholder="Mata Uang" name="matauang">
                                                <option selected="" value="{{ $dv->matauang }}">{{ $dv->matauang }} *
                                                    Select For Update Data</option>
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
                                        <div
                                            class=" form-group m-checkbox-inline mb-0 @error('send_to') is-invalid @enderror">
                                            <div class="col-6">
                                                <label><i class="fa fa-send"></i> Send To :</label>
                                            </div>
                                            <div class="radio radio-primary col-md-6">
                                                <input id="tebet" type="radio" name="send_to" value="Tebet"
                                                    @if ($dv->send_to === 'Tebet') checked @endif required />
                                                <label for="tebet">Tebet</label>
                                            </div>
                                            <div class="radio radio-primary col-md-6">
                                                <input id="cikunir" type="radio" name="send_to" value="Cikunir"
                                                    @if ($dv->send_to === 'Cikunir') checked @endif required />
                                                <label for="cikunir">Cikunir</label>
                                            </div>
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
                                            <th
                                                style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                Action</th>
                                        </tr>
                                        @php
                                            $id = 0;
                                            $id++;
                                        @endphp
                                        @foreach ($item as $i)
                                            <tr>
                                                <td class="text"><input type="text" name="item[]"
                                                        placeholder="Input Item" class="form-control"
                                                        style="text-align: center;" value="{{ $i->item }}"
                                                        required />
                                                </td>
                                                <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                        class="form-control form-calc form-qty"
                                                        style="text-align: center;" value="{{ $i->qty }}"
                                                        required />
                                                </td>
                                                <td>
                                                    <select class="form-select " placeholder="Kategori" name="kategori[]"
                                                        value="{{ $i->kategori }}" required>
                                                        <option selected value="{{ $i->kategori }}">{{ $i->kategori }}
                                                        </option>
                                                        <option value="Pcs">Pcs </option>
                                                        <option value="Lusin">Lusin </option>
                                                        <option value="Box">Box </option>
                                                        <option value="Unit">Unit </option>
                                                    </select>
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" name="add"
                                                        class="btn btn-danger remove-input-field">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="mt-2">
                                        <button type="button" name="add" class="addItem btn btn-outline-primary">
                                            AddItem
                                            <i class="fa fa-plus"></i>
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
                    '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td><td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> ';
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

    </section>
@endsection
