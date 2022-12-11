<title>Edit Data</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit PO</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-purchase-order.index') }}">Purchase Order</a>
                            </li>
                            <li class="breadcrumb-item">Edit PO</li>
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
                            <h5>Edit Purchase Order</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/menu-purchase-order/update/' . $dv->id) }}" id="formAdd" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-select page mt-2 pageSelect" id="pageSelect"
                                                placeholder="Proposed To" name="vendor">
                                                <option value="" disabled selected hidden>Select Vendor</option>
                                                <option value="company">Company</option>
                                                <option value="privateperson">Private Person</option>
                                                <option value="ecommerce">Ecommerce</option>
                                            </select>
                                            <p style="color: red;">*Please select the vendor again</p>
                                            {{-- Perusahaan Dropdown --}}
                                            <select class=" form-select hide mt-2" id="selectedInput" name="perusahaan">
                                                @foreach ($datapt as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Perusahaan Dropdown --}}

                                            {{-- Private Person Dropdown --}}
                                            <select class=" form-select hide" id="selectedInput2" name="orangpribadi">
                                                @foreach ($op as $o)
                                                    <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Private Person Dropdown --}}

                                            {{-- Ecommerce Dropdown --}}
                                            <select class=" form-select hide" id="selectedInput3" name="ecommerce">
                                                @foreach ($ec as $e)
                                                    <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                                @endforeach
                                            </select>
                                            {{-- End Ecommerce Dropdown --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select mt-2" id="floatingproposedto"
                                                placeholder="Proposed To" name="atasan_po">
                                                @foreach ($atasanpo as $dpo)
                                                <option value="{{ $dpo->atasans->id }}">{{ $dpo->atasans->name }}</option>
                                                @endforeach
                                                @foreach ($atasan as $sui)
                                                    <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingproposedto">-- Approved To --</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control mt-2 "
                                                id="floatingNoTelpon" placeholder="Quotation" name="quotation"
                                                value="{{ $datacpo->quotation }}">
                                            <label for="floatingNoTelpon">Quotation</label>
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
                                            height: 58px;
                                        }
                                    </style>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-select page mt-2" id="pageSelector"
                                                placeholder="Terms and Conditions" name="term_conditions">
                                                <option value="{{ $datacpo->term->id }}" selected>{{ $datacpo->term->term_condition }}
                                                </option>
                                                @foreach ($terms as $t)
                                                    <option value="{{ $t->id }}">{{ $t->term_condition }}</option>
                                                @endforeach
                                                <option value="custom">+ Add Terms & Conditions</option>
                                            </select>
                                            <textarea class="hide form-control mt-2" name="term_condition" id="customInput" cols="30" rows="10"
                                                placeholder="Input Terms And Conditions"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <table class="table table-bordered item mx-2 order-entry">
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
                                                {{-- <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                        File</th> --}}
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Price-per-unit</th>
                                                <th
                                                    style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                                    Total</th>
                                            </tr>
                                            @foreach ($item as $i)
                                                <tr>

                                                    <td class="text">
                                                        <input type="text" name="item[]"
                                                            placeholder="Input Item" class="form-control"
                                                            style="text-align: center;" value="{{ $i->id }}" hidden />
                                                        <input type="text"
                                                            placeholder="Input Item" class="form-control"
                                                            style="text-align: center;" value="{{ $i->item }}" disabled/>
                                                    </td>
                                                    <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                                            class="form-control form-calc form-qty"
                                                            style="text-align: center;" value="{{ $i->qty }}"
                                                            required disabled />
                                                    </td>
                                                    <td>
                                                        <select class="form-select " placeholder="Kategori"
                                                            name="kategori[]" disabled>
                                                            <option value="{{ $i->kategori }}" selected>
                                                                {{ $i->kategori }}</option>
                                                            <option value="Pcs">Pcs </option>
                                                            <option value="Lusin">Lusin </option>
                                                            <option value="Box">Box </option>
                                                            <option value="Unit">Unit </option>
                                                        </select>
                                                    </td>
                                                    {{-- <td>
                                                        <input type="file" name="path_file[]" placeholder="Choose File" class="form-control" enctype="multipart/form-data">
                                                        @error('path_file')
                                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                    </td> --}}
                                                    <td>
                                                        <input type="text" name="unit_price[]"
                                                            placeholder="Input Price"
                                                            class="form-control text-end form-calc form-cost rupiah"
                                                            style="text-align: right;" value="{{ $i->unit_price }}"
                                                            required />
                                                    </td>
                                                    <td>
                                                        <input type="text" name="total[]"
                                                            class="form-control form-line" style="text-align: right;"
                                                            required />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <p style="color: red;">*Please fill in the price per unit again to trigger the total and please refill the file then update the data</p>
                                        <br>
                                        <table class="table table-bordered mx-2">
                                            <tr>
                                                <td>
                                                    <label class="pull-right mx-2"
                                                        style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp; DPP :</label>
                                                </td>
                                                <td class="total_A text-end">
                                                    <input style="display: none;" class="total_A" type="text"
                                                        name="total_a">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="mt-1 pull-right check-box" type="checkbox"
                                                        name="ppn" value="1"
                                                        {{ old('ppn', 0) === 1 ? 'checked' : '' }}>
                                                    <label class="pull-right mx-2" style="font-weight: bold;"> PPN 11%
                                                    </label>
                                                    <p style="color: red;">*Please click again to trigger javascript count</p>
                                                </td>
                                                <td class="ppn text-end">
                                                    <input style="display: none;" class="ppn" type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                                                <td class="total text-end">
                                                    <input style="display: none;" class="total" type="text"
                                                        name="grand_total">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="mt-2">
                                            <button type="button" name="add"
                                                class="addItem btn btn-outline-primary"> AddItem
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                                        <a href="{{ route('menu-purchase-order.index') }}"
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
            //Math
            $(document).ready(function() {
                //Convert To Rupiah
                var rupiah = document.querySelector(".rupiah");
                rupiah.addEventListener('keyup', function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    rupiah.value = formatRupiah(this.value, "");
                });
                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, ""),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
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
                    });
                });
            });
            //Add Form
            $(".addItem").on('click', function() {
                addItem();
            });

            function addItem() {
                var item =
                    '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> <td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;"  required/></td><td><input type="text" name="total[]" class="form-control form-line " style="text-align: right;" required  /></td> <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> ';
                $(".item").append(item)

                var rupiah = document.querySelectorAll(".rupiah");
                rupiah.forEach((item) => {
                    item.addEventListener('keyup', function(e) {
                        // tambahkan 'Rp.' pada saat form di ketik
                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                        item.value = formatRupiah(this.value, "");
                    });
                });
                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, ""),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
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
                    });
                });
            }
            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
            });
            var rupiah = document.querySelectorAll(".rupiah");
            rupiah.forEach((item) => {
                item.addEventListener('keyup', function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    item.value = formatRupiah(this.value, "");
                });
            });
            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, ""),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
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

            // Company
            pageSelect.addEventListener('change', function() {
                if (this.value == "company") {
                    selectedInput.classList.remove('hide');
                } else {
                    selectedInput.classList.add('hide');
                }
            })

            // Private Person
            pageSelect.addEventListener('change', function() {
                if (this.value == "privateperson") {
                    selectedInput2.classList.remove('hide');
                } else {
                    selectedInput2.classList.add('hide');
                }
            })

            // Ecommerce
            pageSelect.addEventListener('change', function() {
                if (this.value == "ecommerce") {
                    selectedInput3.classList.remove('hide');
                } else {
                    selectedInput3.classList.add('hide');
                }
            })
        </script>

    </section>
@endsection
