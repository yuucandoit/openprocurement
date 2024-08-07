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

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <style>
            .tutup {
                width: 0;
                height: 0;
                opacity: 0;
            }
            .createPO {
                display: none;
            }

            .hide {
                width: 0;
                height: 0;
                opacity: 0;
            }

            /* .page {
                height: 60px;
            }

            .terms {
                height: 60px;
            } */
        </style>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            @foreach ($datapo as $po)
                            <form class="row g-2 mt-4" action="{{ url('/menu-purchase-order/update/'.$po->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- {{ dd($po->id) }} --}}
                                <input type="hidden" name="item_ppid" value="{{ $po->po_id }}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;">Select Vendor</label>
                                        <select class="form-select page pageSelect" id="pageSelect"
                                            placeholder="Proposed To" name="vendor" >
                                            <option value=""  selected hidden>Select
                                                Vendor
                                            </option>
                                            <option value="company">Company</option>
                                            <option value="privateperson">Private Person
                                            </option>
                                            <option value="ecommerce">Ecommerce</option>
                                        </select>

                                        <select class=" form-select perusahaan_0 hide mt-2" id="selectedInput"
                                            name="perusahaan">
                                            @foreach ($pt as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <select class=" form-select privateperson_0 hide" id="selectedInput2"
                                            name="orangpribadi">
                                            @foreach ($op as $o)
                                            <option value="{{ $o->id }}">{{ $o->nama }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <select class=" form-select ecommerce_0 hide" id="selectedInput3"
                                            name="ecommerce">
                                            @foreach ($ec as $e)
                                            <option value="{{ $e->id }}">{{ $e->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 page" style="margin-top: 10px;">
                                    <div class="form-group">
                                        <label for="floatingQuotation">No Invoice</label>
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="floatingQuotation"
                                                placeholder="No Invoice" name="quotation" value="{{ $po->quotation }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;">Terms & Conditions</label>
                                        <select class="form-select page pageSelector" id="pageSelector"
                                            placeholder="Terms and Conditions" name="term_conditions">

                                            @foreach ($terms as $t)
                                                @if($t->term_condition == $po->term->term_condition)
                                                <option value="{{ $po->term_conditions }}" selected >
                                                    {{ $po->term->term_condition }}
                                                </option>
                                                @else
                                                <option value="{{ $t->id }}">
                                                    {{ $t->term_condition }}
                                                </option>
                                                @endif
                                            @endforeach
                                            <option value="custom">+ Add Terms & Conditions
                                            </option>
                                        </select>
                                        <textarea class="hide form-control customInput" name="term_condition"
                                            cols="30" rows="10"
                                            placeholder="Input Terms And Conditions"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Upload Invoice</label>
                                        <input type="file" name="path_invoice" class="form-control form-control-lg">
                                    </div>
                                </div> --}}

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Upload Invoice</label>
                                        <input type="file" name="path_quotation" class="form-control form-control-lg">
                                    </div>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;">Send Approval To</label>
                                        <select class="form-select page" id="floatingproposedto"
                                            placeholder="Proposed To" name="atasan_po" required="">
                                            @foreach ($atasan as $sui)
                                                @if($po->atasan_po == $sui->id)
                                                <option selected value="{{ $po->atasan_po }}">{{ $po->atasans->name }}</option>
                                                @else
                                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;">Currency</label>
                                        <select class="form-select page" id="floatingdateline" placeholder="Mata Uang"
                                            name="matauang" required="">
                                            @foreach ($concurency as $crency)
                                                @if($crency->code == $currency->matauang)
                                                <option value="{{ $currency->matauang }}"> {{ $currency->matauang }} </option>
                                                @else
                                                <option value="{{ $crency->code }}">{{ $crency->code }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('matauang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" style="font-weight: bold;">Payment Type</label>
                                        <select class="form-select pytype" placeholder="Payment Type" name="payment_type">
                                            <option value="" disabled selected hidden>
                                                Select Payment Type
                                            </option>
                                            <option value="Bank">Transfer Bank</option>
                                            <option value="Va">Virtual account</option>
                                        </select>
                                        @error('payment_type')
                                            <div class='mt-1'>
                                                <span class="text-danger" style="font-size: 10;">
                                                    {{ $message }}
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 bank" style="margin-top: 10px; display:none;">
                                    <div class="form-group">
                                        <label for="floatingNorekening">Rekening</label>
                                        <div class="form-group">
                                            <select class="form-select rekening" placeholder="Rekening" name="no_rekening" id="rekeningSelect">
                                                <option value="" disabled selected hidden>Select Rekening</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 va" style="margin-top: 10px; display:none;">
                                    <div class="form-group">
                                        <label for="floatingVa">Virtual Account</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="floatingVa" placeholder="No Virtual Account" name="va_code">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered item order-entry mx-2">
                                    <tr style="text-align: center;">
                                        <th
                                            style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">
                                            No</th>
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
                                    $no = 1;
                                    @endphp

                                    @foreach ($po->itempo as $item)
                                    <tr class="form-row">
                                    <td style="text-align: center;">
                                        {{ $no++ }}
                                    </td>
                                    <td class="text">
                                        <input type="text" name="id[]" placeholder="Input Item" class="form-control"
                                            style="text-align: center;" value="{{ $item->id }}" hidden />
                                        <input type="text" placeholder="Input Item" class="form-control" name="item[]"
                                            style="text-align: center;" value="{{ $item->item }}" />
                                    </td>
                                    <td><input type="number" name="qty[]" placeholder="Input Quantity"
                                            class="form-control form-calc form-qty" style="text-align: center;"
                                            value="{{ $item->qty }}" min="1" />
                                    </td>
                                    <td>
                                        <select class="form-select " placeholder="Kategori" name="kategori[]">
                                        @foreach ($uom as $u)
                                            @if($item->kategori == $u->name)
                                             <option value="{{ $item->kategori }}" selected>{{ $item->kategori }}</option>
                                            @else
                                            <option value="{{ $u->name }}">{{ $u->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="unit_price[]" placeholder="Input Price"
                                            class="form-control text-end form-calc form-cost dollar"
                                            style="text-align: right;" value="{{ $item->unit_price }}" required />
                                    </td>
                                    <td>
                                        <input type="text" name="total[]" class="form-control form-line"
                                            style="text-align: right;" value="{{ $item->total }}" required />
                                    </td>
                                    <td style="text-align: center;"><button type="button"
                                            class="btn btn-danger remove-input-field"><i
                                                class="icofont icofont-ui-close"></i></button></td>

                                        @endforeach
                                    </tr>
                                </table>
                                <table class="table table-bordered  mx-2" style="margin-top: 0px;">
                                    @foreach ($groupedItem as $count)
                                    @if($count->po_id === $po->id)
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold; ">&nbsp;&nbsp;&nbsp;&nbsp;
                                                DPP :</label>
                                        </td>
                                        <td>
                                            <input style="background-color:#ffff"  class="total_A form-control disabled text-end " type="text" name="dpp" value="{{ $count->dpp }}" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                Discount :</label>
                                        </td>
                                        <td class="text-end">
                                            <input class="form-control discount form-calc dollar text-end" type="text"
                                                id="discount" name="discount" value="{{ $count->discount }}">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;After
                                                Discount :</label>
                                        </td>
                                        <td class="total_disc text-end">
                                            <input style="background-color: #ffff;" class="form-control total_disc text-end" type="text"
                                                name="total_disc" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="mt-1 pull-right check-box" type="checkbox" name="ppn"
                                                value="1" {{ old('ppn', 0)===1 ? 'checked' : '' }}>
                                            <label class="pull-right" style="font-weight: bold;"> PPN 11%
                                            </label>
                                        </td>
                                        <td class="ppn text-end">
                                            <input style="display: none;" class="ppn" type="text" name="ppn">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                Shipping & Protection Fee :</label>
                                        </td>
                                        <td>
                                            <input  class="ongkir form-control text-end dollar" type="text" name="ongkir" value="{{ $count->ongkir }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="pull-right"
                                                style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;
                                                Admin & Service Fee :</label>
                                        </td>
                                        <td>
                                            <input  class="adminfee form-control text-end dollar" type="text" name="admin_fee" value="{{ $count->admin_fee }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" style="font-weight: bold;">Grand Total
                                            :</td>
                                        <td>
                                            <input class="form-control text-end total"
                                                type="text" name="grand_total" value="{{ $count->grand_total }}">
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </table>

                                <div class="form-group" style="text-align:right;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a type="reset" class="btn btn-dark"
                                        href="{{ url('/menu-purchase-order/') }}">Back</a>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
          </div>


        <!-- JavaScript Item -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('assets/AutoNumeric/dist/autoNumeric.min.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the select element and the form elements to show/hide
                var paymentTypeSelect = document.querySelector(".pytype");
                var bankForm = document.querySelector(".bank");
                var vaForm = document.querySelector(".va");

                // Event listener for payment type change
                paymentTypeSelect.addEventListener("change", function() {
                    var selectedValue = this.value;

                    // Hide both forms initially
                    bankForm.style.display = "none";
                    vaForm.style.display = "none";

                    // Show the corresponding form based on selected payment type
                    if (selectedValue === "Bank") {
                        bankForm.style.display = "block";
                    } else if (selectedValue === "Va") {
                        vaForm.style.display = "block";
                    }
                });
            });
        </script>

        <script>
            const dollars = document.querySelectorAll('.dollar');
            dollars.forEach(dollar => {
                new AutoNumeric(dollar,'dotDecimalCharCommaSeparator');
            })

        </script>

        <script type="text/javascript">
            //Math
            document.querySelectorAll('.form-row').forEach(row => {
                row.addEventListener('input', (e) => updateFileds(e, row));
            })

            function updateFileds(event, row) {
                const qty = row.querySelector('.form-qty').value;
                const price = row.querySelector('.form-cost').value.replace(/\,/g, "");
                const totalElmnt = row.querySelector('.form-line');

                totalElmnt.value = new Intl.NumberFormat('en-IN').format(qty *  price);
                var dpp = 0;
                $('.form-line').each(function(key, item){
                    // console.log(item);
                    dpp += new Number(item.value.replace(/\,/g, ""));
                });
                $(".total_A").val(new Intl.NumberFormat('en-IN').format(dpp));
                $(".total").val(new Intl.NumberFormat('en-IN').format(dpp));


            var discount = 0 ;
                var diskon = document.querySelector(".discount");
                diskon.addEventListener("input", function() {
                    var disc = diskon.value;
                    var rep = disc.replace(/\,/g, "");
                    var discint = parseFloat(rep);
                    discount = dpp - discint;
                    console.log(discount);
                    $(".total_disc").val(new Intl.NumberFormat('en-IN').format(discount));
                    $(".total").val(new Intl.NumberFormat('en-IN').format(discount));
            })

            var checkbox = document.querySelector(".check-box");

            checkbox.addEventListener('change', (event) => {
                var totalppn = 0;
                if (event.currentTarget.checked) {                  // PPN
                    totalppn = discount * 11 / 100;
                    ppntotal2 = discount + totalppn;
                    console.log(discount);
                    console.log(ppntotal2);
                    $(".ppn").text(totalppn.toLocaleString('en-US'));
                    $(".total").val(new Intl.NumberFormat('en-IN').format(ppntotal2));

                    var ongkir = document.querySelector(".ongkir");
                    ongkir.addEventListener("input", function(){
                        var ongkos = ongkir.value;
                        var replace = ongkos.replace(/\,/g, "");
                        var ongkoskirim = parseFloat(replace);
                        console.log(ongkoskirim);
                        grandtotal = ongkoskirim  + ppntotal2;
                        $(".total").val(grandtotal);
                        console.log(grandtotal);
                    });
                    var adminfee = document.querySelector(".adminfee");
                    adminfee.addEventListener("input", function(){
                        var admin = adminfee.value;
                        var replace = admin.replace(/\,/g, "");
                        var biayaAdmin = parseFloat(replace);
                        grandtotal2 = biayaAdmin  + grandtotal ;
                        $(".total").val(grandtotal2);
                    });
                } else {                                            // Non PPN
                    totalppn = discount * 0;
                    ppntotal2 = discount + totalppn;
                    $(".ppn").text(totalppn);
                    console.log(ppntotal2);
                    $(".total").val(new Intl.NumberFormat('en-IN').format(ppntotal2));

                    var ongkir = document.querySelector(".ongkir");
                    ongkir.addEventListener("input", function(){
                        var ongkos = ongkir.value;
                        var replace = ongkos.replace(/\,/g, "");
                        var ongkoskirim = parseFloat(replace);
                        console.log(ongkoskirim);
                        grandtotal = ongkoskirim  + ppntotal2 ;
                        $(".total").val(grandtotal);
                        console.log(grandtotal);
                    });
                    var adminfee = document.querySelector(".adminfee");
                    adminfee.addEventListener("input", function(){
                        var admin = adminfee.value;
                        var replace = admin.replace(/\,/g, "");
                        var biayaAdmin = parseFloat(replace);
                        grandtotal2 = biayaAdmin  + grandtotal ;
                        $(".total").val(grandtotal2);
                    });
                }
            });
            };


            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
            });
            var rupiah = document.querySelectorAll(".rupiah");
            rupiah.forEach((item) => {
                item.addEventListener('keyup', function(e) {
                    item.value = formatRupiah(this.value, "");
                });
            });

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
            $(document).ready(function() {
                var perusahaanSelect = $('.perusahaan_0');
                var privatepersonSelect = $('.privateperson_0');
                var ecommerceSelect = $('.ecommerce_0');
                var rekeningSelect = $('#rekeningSelect');
                var pageSelect = $('.pageSelect');

                // Function to check if Select2 is initialized
                function isSelect2Initialized(element) {
                    return element.data('select2') !== undefined;
                }

                // Event listener for pageSelect change
                pageSelect.on('change', function() {
                    var selectedValue = $(this).val();

                    // Hide all and destroy Select2 if initialized
                    if (isSelect2Initialized(perusahaanSelect)) {
                        perusahaanSelect.select2('destroy');
                    }
                    perusahaanSelect.addClass('hide');

                    if (isSelect2Initialized(privatepersonSelect)) {
                        privatepersonSelect.select2('destroy');
                    }
                    privatepersonSelect.addClass('hide');

                    if (isSelect2Initialized(ecommerceSelect)) {
                        ecommerceSelect.select2('destroy');
                    }
                    ecommerceSelect.addClass('hide');

                    rekeningSelect.empty().append('<option value="" disabled selected hidden>Select Rekening</option>');

                    // Show and initialize the selected element with Select2
                    if (selectedValue === "company") {
                        perusahaanSelect.removeClass('hide').select2();
                    } else if (selectedValue === "privateperson") {
                        privatepersonSelect.removeClass('hide').select2();
                    } else if (selectedValue === "ecommerce") {
                        ecommerceSelect.removeClass('hide').select2();
                    }
                });


                // Function to fetch rekening data
                function fetchRekeningData(type, id) {
                    $.ajax({
                        url: '/menu-purchase-order/get-data',
                        type: 'POST',
                        data: {
                            type: type,
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(response) {
                            console.log(response);
                            rekeningSelect.empty().append('<option value="" disabled selected hidden>Select Rekening</option>');
                            $.each(response.data, function(index, rekening) {
                                rekeningSelect.append('<option value="' + rekening.id + '| ' + rekening.rel_bank.name + ' ' + rekening.no_rekening + ' ('+ rekening.nama_penerima +')">' + rekening.rel_bank.name + ' ' + rekening.no_rekening + ' ('+ rekening.nama_penerima +')</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error('Failed to fetch rekening data', xhr);
                        }
                    });
                }

                // Event listeners for select changes
                    perusahaanSelect.on('change', function() {
                        fetchRekeningData('company', $(this).val());
                    });

                    privatepersonSelect.on('change', function() {
                        fetchRekeningData('privateperson', $(this).val());
                    });

                    ecommerceSelect.on('change', function() {
                        fetchRekeningData('ecommerce', $(this).val());
                    });
            });
        </script>

    </section>
@endsection
