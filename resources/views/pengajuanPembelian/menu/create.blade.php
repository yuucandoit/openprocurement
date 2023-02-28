<title>Purchase Request</title>
@extends('layouts.master')

@section('main')
<style>
    .hide {
       width: 0;
       height: 0;
       opacity: 0;
       display: none;
    }

    .page {
        height: 50px;
    }

</style>
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<section>
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
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                {{-- <div class="card card-absolute"> --}}
                    {{-- <div class="card-header bg-primary">
                        <h5>Form Purchase Request</h5>
                    </div> --}}
                    <div class="card-body">
                        <form action="{{ url('/menu-pengajuan-pembelian/store') }}" id="formAdd" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="floatingTanggal"><i class="fa fa-calendar"></i> Date :</label>
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
                                        <label for="floatingdateline"><i class="fa fa-clock-o"></i> Deadline :</label>
                                        <select class="form-select @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline" required="">
                                            <option selected="" disabled="" value="">Select Deadline
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
                                        <label class="" for="pageSelector"><b><i class="fa fa-send"></i> Send To</b></label>
                                        <select class="form-select" id="pageSelector" placeholder="Send To" name="send_to">

                                            <option value="{{ Auth::user()->location }}" selected>{{ Auth::user()->location }}</option>
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
                                        <label for="floatingrequestby"><i class="fa fa-user"></i> Request By
                                            :</label>
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
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floatingdepartment"><i class="fa fa-institution"></i> Department
                                            :</label>
                                        <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" required="">
                                            @foreach ($datadepartment as $dp)
                                            @if(Auth::user()->department == $dp->name)
                                            <option value="{{ $dp->id }}" selected>{{ $dp->name }}</option>
                                            @else
                                            <option value="{{ $dp->id }}">{{ $dp->name }}</option>
                                            @endif
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
                                            <option selected="" disabled="" value="">Please Choose One
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
                                        <label for="floatingNoTelpon"><i class="fa fa-link"></i> Description :</label>
                                        <div class="">
                                            <textarea name="desc" id="floatingNoTelpon" class="form-control" rows="4"></textarea>
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
                                        <select class="form-select pageSelect" id="pageSelect" placeholder="Purpose" name="category_purpose" data-live-search="true">
                                            <option value="">Select Category Purpose</option>
                                            <option value="project">Project</option>
                                            <option value="office">Office</option>
                                            <option value="workshop">Workshop</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="rnd">R&D</option>
                                            <option value="travel">Travel</option>
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

                                {{-- css hide --}}
                                <style>
                                    .hide {
                                        opacity: 0;
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
                                    <tr>
                                        <td class="text">
                                            <textarea name="item[]" id="" class="form-control" rows="2" style="min-width: 300px"></textarea>
                                            {{-- <input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required /> --}}
                                        </td>
                                        <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required />
                                        </td>
                                        <td>
                                            <select class="form-select " placeholder="Kategori" name="kategori[]" required style="min-width: 100px">
                                                <option value="Pcs" selected>Pcs </option>
                                                <option value="Lusin">Lusin </option>
                                                <option value="Box">Box </option>
                                                <option value="Unit">Unit </option>
                                                <option value="Lot">Lot </option>
                                                <option value="Rim">Rim </option>
                                                <option value="Org">Org </option>
                                                <option value="Line">Line </option>
                                                <option value="Ruang">Ruang </option>
                                                <option value="Pax">Pax </option>
                                                <option value="Set">Set </option>
                                                <option value="Piece">Piece </option>
                                                <option value="Rol">Rol </option>
                                                <option value="Pack">Pack </option>
                                                <option value="Batang">Batang </option>
                                                <option value="Dus">Dus </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" name="add" class="btn btn-danger remove-input-field">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
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
        //Math
            $(document).ready(function() {
                //Convert To Rupiah
                var rupiah = document.querySelector(".rupiah");
                rupiah.forEach(item => {
                    item.value = formatRupiah(item.value, "Rp. ");
                });
                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, "")
                        , split = number_string.split(",")
                        , sisa = split[0].length % 3
                        , rupiah = split[0].substr(0, sisa)
                        , ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        rupiah += separator + ribuan.join(".");
                    }
                    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                }
            $(".order-entry").on("keyup", ".form-calc", function() {
                var parent = $(this).closest("tr");
                var str = parent.find(".form-cost").val();
                var res = str.replace(/\D/g, "");
                parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                var total = 0;
                $(".form-line").each(function() {
                    total += parseInt($(this).val() || 0);
                });
                $(".total_A").text(total.toLocaleString('en-US'));
                var checkbox = document.querySelector(".check-box");
                checkbox.addEventListener('change', (event) => {
                    if (event.currentTarget.checked) {
                        totalppn = total * 11 / 100;
                        grandtotal = total + totalppn;
                        $(".ppn").text(totalppn.toLocaleString('en-US'));
                        $(".total").text(grandtotal.toLocaleString('en-US'));
                    } else {
                        totalppn = total * 0;
                        $(".ppn").text(totalppn);
                        $(".total").text(total.toLocaleString('en-US'));
                    }
                })
            });
            $(".js-example-basic-single").select2();
        });
        //Add Form
        $(".addItem").on('click', function() {
            addItem();
        });

        function addItem() {
            var item =
                `<tr><td> <textarea name="item[]" id="" class="form-control" rows="2"></textarea></td>
                     <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/></td>
                     <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option><option value="Lot">Lot </option> <option value="Rim">Rim </option>
                    <option value="Org">Org </option><option value="Line">Line </option><option value="Ruang">Ruang </option><option value="Pax">Pax </option> <option value="Set">Set </option>
                    <option value="Piece">Piece </option><option value="Rol">Rol </option><option value="Pack">Pack </option><option value="Batang">Batang </option> <option value="Dus">Dus </option>
                    </select></td>
                     <td><input type="file" name="path_file[]" placeholder="Choose File" multiple class="form-control">
                    @error('path_file')
                     <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                    </td>
                     <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> `;
            $(".item").append(item)
        }
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "")
                , split = number_string.split(",")
                , sisa = split[0].length % 3
                , rupiah = split[0].substr(0, sisa)
                , ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
        }

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

            var selectedInput5 = document.getElementById('selectedInput5');
            var selectedInputCustom5 = document.getElementById('selectedInputCustom5');

            var selectedInput6 = document.getElementById('selectedInput6');
            var selectedInputCustom6 = document.getElementById('selectedInputCustom6');


            // Project
            pageSelect.addEventListener('change', function() {
                if (this.value == "project") {
                    selectedInput.classList.remove('hide').select2();
                } else {
                    selectedInput.classList.add('hide');
                }
            })

            // Office
            pageSelect.addEventListener('change', function() {
                if (this.value == "office") {
                    selectedInput2.classList.remove('hide');
                } else {
                    selectedInput2.classList.add('hide');
                }
            })

            // Workshop
            pageSelect.addEventListener('change', function() {
                if (this.value == "workshop") {
                    selectedInput3.classList.remove('hide');
                } else {
                    selectedInput3.classList.add('hide');
                }
            })

            // inventory
            pageSelect.addEventListener('change', function() {
                if (this.value == "inventory") {
                    selectedInput4.classList.remove('hide');
                } else {
                    selectedInput4.classList.add('hide');
                }
            })

            // R&D
            pageSelect.addEventListener('change', function() {
                if (this.value == "rnd") {
                    selectedInput5.classList.remove('hide');
                } else {
                    selectedInput5.classList.add('hide');
                }
            })

             // Travel
             pageSelect.addEventListener('change', function() {
                if (this.value == "travel") {
                    selectedInput6.classList.remove('hide');
                } else {
                    selectedInput6.classList.add('hide');
                }
            })

        </script>



    {{-- <script type="text/javascript">
    function otherOptionCheck() {
    if (document.getElementById('otherOption').checked) {
        document.getElementById('other').style.display = 'block';
    }
    else set.style.display = 'none';
    }

    if (document.getElementById('tebet').checked) {
        document.getElementById('tebet').value;
    }
    if (document.getElementById('cikunir').checked) {
        document.getElementById('cikunir').value;
    }

</script> --}}

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

