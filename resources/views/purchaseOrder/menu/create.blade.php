<title>Record Data</title>

@extends('layouts.master')

@section('main')
<section>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6 mt-4">
                    <h3>Record Purchase Order</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('menu-purchase-order.index') }}">Purchase
                                Order</a>
                        </li>
                        <li class="breadcrumb-item">Record Purchase Order</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5 class="text-white">Detail Data</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mt-4" style="">
                                    <tbody>
                                        <tr>
                                            <td>Who Submitted</td>
                                            <td>{{ $dv->whosubmit->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $dv->date_ps }}</td>
                                        </tr>
                                        <tr>
                                            <td>Department</td>
                                            <td>{{ $dv->dps->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>{{ $dv->desc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Purpose</td>
                                            <td>{{ $dv->purpose->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Send To</td>
                                            <td>{{ $dv->send_to }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Line</td>
                                            <td>{{ $dv->dateline }}</td>
                                        </tr>
                                        <tr>
                                            <td>Currency</td>
                                            <td>{{ $dv->matauang }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                          <!-- Floating Labels Form -->
                          <form class="row g-2 mt-4" action="{{ url('/menu-purchase-order/store/' . $dv->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    class="fa fa-database"></i> Select
                                                Vendor</label>
                                            <select class="form-select page pageSelect"
                                                id="pageSelect" placeholder="Proposed To"
                                                name="vendor">
                                                <option value="" disabled selected hidden>Select
                                                    Vendor
                                                </option>
                                                <option value="company">Company</option>
                                                <option value="privateperson">Private Person
                                                </option>
                                                <option value="ecommerce">Ecommerce</option>
                                            </select>

                                            <select class=" form-select perusahaan_0 hide mt-2"
                                                id="selectedInput" name="perusahaan">
                                                @foreach ($pt as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <select class=" form-select privateperson_0 hide"
                                                id="selectedInput2" name="orangpribadi">
                                                @foreach ($op as $o)
                                                <option value="{{ $o->id }}">{{ $o->nama }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <select class=" form-select ecommerce_0 hide"
                                                id="selectedInput3" name="ecommerce">
                                                @foreach ($ec as $e)
                                                <option value="{{ $e->id }}">{{ $e->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 page" style="margin-top: 10px;">
                                        <div class="form-group">
                                            <label for="floatingQuotation"><i
                                                    class="fa fa-file-excel-o"></i>
                                                Quotation</label>
                                            <div class="form-floating">
                                                <input required type="text" class="form-control"
                                                    id="floatingQuotation" placeholder="Quotation"
                                                    name="quotation">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" style="font-weight: bold;"><i
                                                    class="fa fa-file-text-o"></i> Terms &
                                                Conditions</label>
                                            <select class="form-select page pageSelector"
                                                id="pageSelector" placeholder="Terms and Conditions"
                                                name="term_conditions">
                                                <option value="" disabled selected hidden>Terms And
                                                    Conditions
                                                </option>
                                                @foreach ($terms as $t)
                                                <option value="{{ $t->id }}">
                                                    {{ $t->term_condition }}
                                                </option>
                                                @endforeach
                                                <option value="custom">+ Add Terms & Conditions
                                                </option>
                                            </select>
                                            <textarea class="hide form-control customInput"
                                                name="term_condition" id="customInput" cols="30"
                                                rows="10"
                                                placeholder="Input Terms And Conditions"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fa fa-file-pdf-o"
                                                    style="font-weight: bold;"></i>
                                                Upload Quotation
                                            </label>
                                            <input type="file" name="path_quotation"
                                                class="form-control form-control-lg">
                                        </div>
                                    </div>
                                <table class="table table-bordered item order-entry mx-2">
                                    <tr style="text-align: center;">
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Item</th>
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Qty</th>
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            UOM</th>
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Price-per-unit</th>
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Total</th>
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            Action</th>




                                    </tr>
                                    @php
                                    $id = 0;
                                    $id++;
                                    @endphp
                                    @foreach ($pengajuan as $i)

                                    <td class="text">
                                        <input type="text" name="id[]" placeholder="Input Item"
                                            class="form-control" style="text-align: center;"
                                            value="{{ $i->id }}" hidden />
                                        <input type="text" placeholder="Input Item"
                                            class="form-control" name="item[]"
                                            style="text-align: center;" value="{{ $i->item }}" />
                                    </td>
                                    <td><input type="number" name="qty[]"
                                            placeholder="Input Quantity"
                                            class="form-control form-calc form-qty"
                                            style="text-align: center;" value="{{ $i->qty }}" max="{{ $i->qty }}" />
                                    </td>
                                    <td>
                                        <select class="form-select " placeholder="Kategori"
                                            name="kategori[]" value="{{ $i->kategori }}">
                                            <option value="{{ $i->kategori }}">
                                                {{ $i->kategori }}</option>
                                            <option value="Pcs">Pcs </option>
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
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="unit_price[]"
                                            placeholder="Input Price"
                                            class="form-control text-end form-calc form-cost rupiah"
                                            style="text-align: right;" required />
                                    </td>
                                    <td>
                                        <input type="text" name="total[]"
                                            class="form-control form-line"
                                            style="text-align: right;" required />
                                    </td>
                                    <td style="text-align: center;"><button type="button"
                                            class="btn btn-danger remove-input-field"><i
                                                class="fa fa-times"></i></button></td>

                                    </tr>
                                    @endforeach
                                </table>

                                <table class="table table-bordered  mx-2" style="margin-top: 0px;">
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                DPP :</label>
                                        </td>
                                        <td class="total_A text-end">
                                            <input style="display: none;" class="total_A"
                                                type="text" name="total_a">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                Ongkir :</label>
                                        </td>
                                        <td>
                                            <input  class="ongkir form-control text-end rupiah" type="text" name="ongkir">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                Discount :</label>
                                        </td>
                                        <td class="text-end">
                                            <input
                                                class="form-control discount form-calc rupiah text-end"
                                                type="text" id="discount" name="discount">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                Discount :</label>
                                        </td>
                                        <td class="total_disc text-end">
                                            <input style="display: none;" class=" total_disc "
                                                type="text" name="total_disc">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="mt-1 pull-right check-box" type="checkbox"
                                                name="ppn" value="1" {{ old('ppn', 0)===1
                                                ? 'checked' : '' }}>
                                            <label class="pull-right"
                                                style="font-weight: bold;"> PPN 11%
                                            </label>
                                        </td>
                                        <td class="ppn text-end">
                                            <input style="display: none;" class="ppn" type="text"
                                                name="ppn">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" style="font-weight: bold;">Grand Total
                                            :</td>
                                        <td class="total text-end">
                                            <input style="display: none;" class="form-control text-end total" type="text"
                                                name="grand_total">
                                        </td>
                                    </tr>
                                </table>

                                <div class="col-md-12 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;"><i
                                                class="icofont icofont-stamp"></i> Send Approval To:</label>
                                        <select class="form-select page" id="floatingproposedto"
                                            placeholder="Proposed To" name="atasan_po" required="">
                                            <option selected="" disabled="" value="">-- Please Choose
                                                One
                                                --
                                            </option>
                                            @foreach ($atasan as $sui)
                                            <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;"><i class="fa fa-money"></i> Currency :</label>
                                        <select class="form-select page" id="floatingdateline" placeholder="Mata Uang" name="matauang" required="">
                                            <option selected="" disabled="" value="">select currency
                                            </option>
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
                                            <div class="form-group" style="text-align:right;">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a type="reset" class="btn btn-dark"
                                                    href="{{ url('/menu-purchase-order/') }}">Back</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <style>
                .tutup {
                    width: 0;
                    height: 0;
                    opacity: 0;
                }
                .hide {
                    width: 0;
                    height: 0;
                    opacity: 0;
                }
                .page {
                    height: 60px;
                }
                .terms {
                    height: 60px;
                }
            </style>

        </div>
            </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="po"></div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $(function(){
            $('.dolar').maskMoney();
            // console.log($('.dolar').maskMoney());
        })
    </script>
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
                        split = number_string.split("."),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        rupiah += separator + ribuan.join(".");
                    }
                    rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                }
                $(".order-entry").on("keyup", ".form-calc", function() {
                    var parent = $(this).closest("tr");
                    var str = parent.find(".form-cost").val();
                    var res = str.replace(/\D/g, "");
                    // console.log(res);
                    parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                    var total = 0;
                    $(".form-line").each(function() {
                        total += parseInt($(this).val() || 0);
                    });
                    $(".total_A").text(total.toLocaleString('en-US'));
                    var diskon = document.querySelector(".discount");
                    diskon.addEventListener("input", function() {
                        var disc = diskon.value;
                        var rep = disc.replace(/\D/g, "");
                        var discint = parseInt(rep);
                        discount = total - discint;
                        console.log(discount);
                        $(".total_disc").text(discount.toLocaleString('en-US'));
                    var checkbox = document.querySelector(".check-box");
                    checkbox.addEventListener('change', (event) => {
                        if (event.currentTarget.checked) {
                            totalppn = discount * 11 / 100;
                            grandtotal = discount + totalppn;
                            $(".ppn").text(totalppn.toLocaleString('en-US'));
                            $(".total").text(grandtotal.toLocaleString('en-US'));
                            // $(".total").val(grandtotal);
                        } else {
                            totalppn = discount * 0;
                            $(".ppn").text(totalppn);
                            $(".total").text(discount.toLocaleString('en-US'));
                            // $(".total").val(discount);
                        }
                    });
                    });
                });
            });
            //Add Form
            $(".addItem").on('click', function() {
                addItem();
            });
            function addItem() {
                var item =
                    `<tr><td><input type="text" name="id[]"
                                            placeholder="Input Item" class="form-control"
                                            style="text-align: center;" value="{{ $i->id }}" hidden /><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" required/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" required/></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option> <option value="Lot">Lot </option> <option value="Rim">Rim </option>
                                    <option value="Org">Org </option><option value="Line">Line </option> <option value="Ruang">Ruang </option><option value="Pax">Pax </option><option value="Set">Set </option>
                                    <option value="Piece">Piece </option><option value="Rol">Rol </option><option value="Pack">Pack </option>
                                    <option value="Batang">Batang </option></select></td> <td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;"  required/></td><td><input type="text" name="total[]" class="form-control form-line" style="text-align: right;" required  /></td> <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> `;
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
        var pageSelector = document.querySelector('.pageSelector');
            var customInput = document.querySelector('.customInput');
            pageSelector.addEventListener('change', function() {
                if (this.value == "custom") {
                    customInput.classList.remove('hide');
                } else {
                    customInput.classList.add('hide');
                }
            })
    </script>
    <script type="text/javascript">
        var pageSelect = document.querySelector('.pageSelect');
            var selectedInput = document.querySelector('.perusahaan_0');
            var selectedInput2 = document.querySelector('.privateperson_0');
            var selectedInput3 = document.querySelector('.ecommerce_0');
            // Company
            pageSelect.addEventListener('change', function() {
                if (this.value == "company") {
                    selectedInput.classList.remove('hide');
                } else if (this.value == "privateperson") {
                    selectedInput.classList.add('hide');
                }  else if (this.value == "ecommerce") {
                    selectedInput.classList.add('hide');
                }
            })
            // Private Person
            pageSelect.addEventListener('change', function() {
                if (this.value == "privateperson") {
                    selectedInput2.classList.remove('hide');
                }  else if (this.value == "company") {
                    selectedInput2.classList.add('hide');
                }  else if (this.value == "ecommerce") {
                    selectedInput2.classList.add('hide');
                }
            })
            // Ecommerce
            pageSelect.addEventListener('change', function() {
                if (this.value == "ecommerce") {
                    selectedInput3.classList.remove('hide');
                }  else if (this.value == "privateperson") {
                    selectedInput3.classList.add('hide');
                }  else if (this.value == "company") {
                    selectedInput3.classList.add('hide');
                }
            })
    </script>
</section>
@endsection
