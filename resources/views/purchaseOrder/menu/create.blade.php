<title>Record Data</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                 <h1>Record Purchase Order</h1>
                 <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('menu-purchase-order.index') }}">Purchase Order</a></li>
                  <li class="breadcrumb-item">Record Purchase Order</li>
                </ol>
              </div>
              <div class="col-sm-6">
                <!-- Bookmark Start-->
                <div class="bookmark">
                  <ul>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
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

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Record Data</h5>
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
                            <td>{{ $dv->referensi->name }}</td>
                        </tr>
                        <tr>
                            <td>Send To</td>
                            <td>{{ $dv->send_to }}</td>
                        </tr>
                        <tr>
                            <td>Date Line</td>
                            <td>{{ $dv->dateline }}</td>
                        </tr>
                    </tbody>
                </table>
                   {{--   <table class="table table-bordered mt-4 mb-4" >
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Kategori</th>
                                <th>Price-per-unit</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $p)
                            <tr>
                                <td>{{ $p->item }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->kategori }}</td>
                            @if ($dv->matauang == 'RP')
                                <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}</td>
                                <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                            @elseif ($dv->matauang == 'USD')
                                <td style="text-align:right;">$ {{ number_format($p->unit_price) }}</td>
                                <td style="text-align:right;">$ {{ number_format($p->total) }}</td>
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered ">
                        <tr>
                            <td><label class="pull-right mx-2"> DPP :</label></td>
                            <td style="text-align: right;">
                                @foreach ($dpp as $d)
                                 Ketika mata uang yang dipilih RP
                                    @if ($dv->matauang == 'RP')
                                    RP. {{ number_format($d->total) }}
                                     Ketika mata uang yang dipilih USD
                                    @elseif ($dv->matauang == 'USD')
                                    $ {{ number_format($d->total) }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><input class="mt-1 pull-right check-box" type="checkbox" value="{{ $dv->ppn }}" @if ($dv->ppn == 1)
                                @checked(true)
                                @else
                            @endif disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                            <td style="text-align:right;">
                                @if ($dv->ppn == 1)
                                @foreach ($ppn as $p)
                 Ketika mata uang yang dipilih RP
                                @if ($dv->matauang == 'RP')
                                RP. {{ number_format($p->total) }}
                                Ketika mata uang yang dipilih USD
                                @elseif ($dv->matauang == 'USD')
                                $ {{ number_format($p->total) }}
                                @endif
                                @endforeach
                                @else
                                @foreach ($ppn as $p)
                             Ketika mata uang yang dipilih RP
                                @if ($dv->matauang == 'RP')
                                RP. 0
                                Ketika mata uang yang dipilih USD
                                @elseif ($dv->matauang == 'USD')
                                $ 0
                                @endif
                                @endforeach
                                @endif
                            </td>
                        </tr>

                        @if ($dv->ppn == 1)
                        <tr>
                            <td class="text-end">Grand Total :</td>

                            @foreach ($total as $t)
                             jika mata uang yang di pilih RP Maka Return RP.
                            @if ($dv->matauang == 'RP')
                            <td style="text-align:right;" >RP. {{ number_format($t->total) }}</td>

                             jika mata uang yang di pilih USD Maka Return $
                            @elseif ($dv->matauang == 'USD')
                            <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                            @endif
                            @endforeach

                            @elseif ($dv->ppn == 0)
                            <td class="text-end">Grand Total :</td>
                            @foreach ($total_tnpa_ppn as $tpn)
                            @if ($dv->matauang == 'RP')
                            <td style="text-align:right;" >RP. {{ number_format($tpn->total) }}</td>
                        @elseif ($dv->matauang == 'USD')
                            <td style="text-align:right;">$ {{ number_format($tpn->total) }}</td>
                        @endif
                        @endforeach
                        </tr>
                        @endif
                     </table>  --}}
                     <!-- Floating Labels Form -->
                <form class="row g-2 mt-4" action={{ url('/menu-purchase-order/store/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <table class="table table-bordered item order-entry" >
                        <tr style="text-align: center;">
                          <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Item</th>
                          <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Qty</th>
                          <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Category</th>
                          <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Price-per-unit</th>
                          <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Total</th>
                        </tr>
                        @foreach ($pengajuan as $p)
                        <tr>

                          <td class="text"><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;" value="{{ $p->item }}" required/>
                          </td>
                          <td><input type="number"  name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" value="{{ $p->qty }}" required/>
                          </td>
                          <td>
                            <select class="form-select " placeholder="Kategori" name="kategori[]" required>
                              <option selected="selected" value="{{ $p->kategori }}">{{ $p->kategori }}</option>
                              <option value="Pcs"  >Pcs   </option>
                              <option value="Lusin">Lusin </option>
                              <option value="Box"  >Box   </option>
                              <option value="Unit" >Unit  </option>
                            </select>
                          </td>
                          <td>
                            <input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;" required/>
                          </td>
                          <td>
                            <input type="text" name="total[]" class="form-control form-line rupiah" style="text-align: right;" required="" />
                          </td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="mt-2">
                        <button type="button" name="add"  class="addItem btn btn-outline-primary"> AddItem
                          <i class="fa fa-plus"></i>
                        </button>
                    </div>
                      <br>
                      <table class="table table-bordered">
                        <tr>
                          <td>
                            <label class="pull-right mx-2" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp; DPP :</label>
                          </td>
                          <td class="total_A text-end">
                            <input style="display: none;" class="total_A" type="text" name="total_a">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input class="mt-1 pull-right check-box" type="checkbox" name="ppn" value="1" {{ old('ppn',0) === 1 ? 'checked' : '' }}>
                            <label class="pull-right mx-2" style="font-weight: bold;"> PPN 11% </label>
                          </td>
                          <td class="ppn text-end">
                            <input style="display: none;" class="ppn" type="text" name="ppn">
                          </td>
                        </tr>
                        <tr>
                          <td class="text-end" style="font-weight: bold;">Grand Total :</td>
                          <td class="total text-end">
                            <input style="display: none;" class="total" type="text" name="grand_total">
                          </td>
                        </tr>
                      </table>
                     {{-- css hide --}}
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
                            height: 58px;
                        }
                    </style>

                    <div class="col-12">
                        <div class="form-group">
                            <select class="form-select page mt-2 pageSelect" id="pageSelect" placeholder="Proposed To" name="vendortype">
                                <option value="" disabled selected hidden>Select Vendor</option>
                                <option value="company">Company</option>
                                <option value="privateperson">Private Person</option>
                                <option value="ecommerce">Ecommerce</option>
                            </select>
                             {{-- Perusahaan Dropdown --}}
                             <select class=" form-select hide mt-2" id="selectedInput" name="vendorable_id">
                                @foreach ($pt as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            {{-- End Perusahaan Dropdown --}}

                            {{-- Private Person Dropdown --}}
                            <select class=" form-select hide" id="selectedInput2" name="vendorable_id">
                                @foreach ($op as $o)
                                <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                @endforeach
                            </select>
                            {{-- End Private Person Dropdown --}}

                            {{-- Ecommerce Dropdown --}}
                            <select class=" form-select hide" id="selectedInput3" name="vendorable_id">
                                @foreach ($ec as $e)
                                <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                @endforeach
                            </select>
                            {{-- End Ecommerce Dropdown --}}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select mt-2" id="floatingproposedto" placeholder="Proposed To" name="atasan_po" >
                                @foreach ($atasan as $sui)
                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingproposedto">-- Approved To --</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="Address" name="address" >
                            <label for="floatingNoTelpon">Alamat</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="No_Telp" name="no_telp" >
                            <label for="floatingNoTelpon">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="NPWP" name="no_npwp" >
                            <label for="floatingNoTelpon">NPWP</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="Quotation" name="quotation" >
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

                    <div class="col-6">
                        <div class="form-group">
                            <select class="form-select page mt-2" id="pageSelector" placeholder="Terms and Conditions" name="term_conditions" >
                                <option value="" disabled selected hidden>Terms And Conditions</option>
                                    @foreach ($terms as $t)
                                      <option value="{{ $t->id }}">{{ $t->term_condition }}</option>
                                    @endforeach
                                <option value="custom">+ Add Terms & Conditions</option>
                            </select>
                        <textarea class="hide form-control mt-2" name="term_condition" id="customInput" cols="30" rows="10" placeholder="Input Terms And Conditions"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>
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
                     parent.find(".form-line").val((parent.find(".form-qty").val() * res) .toFixed(0));
                     var total = 0;
                     $(".form-line").each(function(){
                       total += parseInt($(this).val()||0);
                     });
                     $(".total_A").text(total.toLocaleString('en-US'));
                     var checkbox =  document.querySelector(".check-box");
                     checkbox.addEventListener('change', (event) =>{
                       if(event.currentTarget.checked){
                         totalppn = total * 11 / 100;
                         grandtotal = total + totalppn;
                         $(".ppn").text(totalppn.toLocaleString('en-US'));
                         $(".total").text(grandtotal.toLocaleString('en-US'));
                       }
                       else{
                        totalppn = total * 0;
                        $(".ppn").text(totalppn);
                        $(".total").text(total.toLocaleString('en-US'));
                      }
                    })
                   });
                 });
                 //Add Form

                 $(".addItem").on('click',function () {
                    addItem();
                });
                function addItem(){
                    var item = '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td><td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;" required/></td><td><input type="text" name="total[]" class="form-control form-line rupiah" style="text-align: right;" required="" /> </td> ';
                    $('.item').append(item);
                };
                // //    $(".dynamicAddRemove").append(
                // //     '<tr><td><input type="text" name="addMoreInputFields[' + i +
                // //     '][item]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="addMoreInputFields[' + i +
                // //     '][qty]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="addMoreInputFields[' + i +
                // //     '][kategori]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> '
                // //     );

                //             });
                 $(document).on('click', '.remove-input-field', function () {
                   $(this).parents('tr').remove();
                 });
               </script>

        <script type="text/javascript">
            var pageSelector = document.getElementById('pageSelector');
            var customInput = document.getElementById('customInput');

            pageSelector.addEventListener('change', function(){
                if(this.value == "custom") {
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
            pageSelect.addEventListener('change', function(){
                if(this.value == "company") {
                    selectedInput.classList.remove('hide');
                } else {
                    selectedInput.classList.add('hide');
                }
            })

            // Private Person
            pageSelect.addEventListener('change', function(){
                if(this.value == "privateperson") {
                    selectedInput2.classList.remove('hide');
                } else {
                    selectedInput2.classList.add('hide');
                }
            })

            // Ecommerce
            pageSelect.addEventListener('change', function(){
                if(this.value == "ecommerce") {
                    selectedInput3.classList.remove('hide');
                } else {
                    selectedInput3.classList.add('hide');
                }
            })
        </script>
    </section>
@endsection
