<title>Purchase Submision</title>
@extends('layouts.master')

@section('main')
    <section>
        <div class="card shadow mb-5">
            <div class="card-body">
                <h5 class="card-title">Form Purchase Submision</h5>

                <form action={{ url('/menu-pengajuan-pembelian/store') }} id="formAdd" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row modal-body container">
                    <div class="col-6">
                        <div class="form-floating" >
                            <input type="date"
                                class="form-control @error('date_ps') is-invalid @enderror mt-2 "
                                id="floatingTanggal" placeholder="Tanggal" name="date_ps"
                                value="{{ old('date_ps', date('Y-m-d')) }}">
                            <label for="floatingTanggal">Date</label>
                                @error('date_ps')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating" >
                            <select class="form-select mt-2 @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline">
                                <option value=""disabled selected hidden>Select Date line</option>
                                <option value="≤3Jam">≤ 3 Jam</option>
                                <option value="≤24Jam">≤ 24 Jam</option>
                                <option value="≤2Hari">≤ 2 Hari</option>
                                <option value="SesuaiPo">Sesuai PO</option>
                            </select>
                            <label for="floatingdateline">-- Date Line --</label>

                                @error('dateline')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating" >
                            <select class="form-select mt-2 @error('ws') is-invalid @enderror" id="floatingwhosubmitted" placeholder="Who Submitted" name="ws">
                                <option value=""disabled selected hidden>Who Submitted</option>
                                <option value="Business_Development"    >Business Development   </option>
                                <option value="Finance"                 >Finance                </option>
                                <option value="GA"                      >GA                     </option>
                                <option value="Human_Resource"          >Human Resource         </option>
                                <option value="Legal"                   >Legal                  </option>
                                <option value="Programmer"              >Programmer             </option>
                                <option value="Project"                 >Project                </option>
                                <option value="Product"                 >Product                </option>
                                <option value="Production"              >Production             </option>
                                <option value="Purchasing"              >Purchasing             </option>
                                <option value="R&D"                     >R&D                    </option>
                                <option value="Support_Workshop"        >Support Workshop       </option>
                                <option value="Tax"                     >Tax                    </option>
                            </select>
                            <label for="floatingwhosubmitted">-- Who Submitted --</label>

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
                            height: 58px;
                        }
                    </style>
                    <div class="col-6">
                        <div class="form-group" >
                            <select class="form-select page mt-2 @error('purpose') is-invalid @enderror" id="pageSelector" placeholder="Purpose" name="purpose">
                                <option value="" disabled selected hidden>Purpose</option>
                                @foreach ($purpose as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                                <option value="custom">+ Add Project</option>
                            </select>
                            <input type="text" class="hide form-control mt-2" placeholder="Input Project" name="nama" id="customInput" />

                                @error('purpose')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                    </div>
              </div>
                    <div class="col-6">
                        <div class="form-floating" >
                            <select class="form-select @error('purpose') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department">
                                <option value="" disabled selected hidden>Department            </option>
                                <option value="Business_Development"    >Business Development   </option>
                                <option value="Finance"                 >Finance                </option>
                                <option value="GA"                      >GA                     </option>
                                <option value="Human_Resource"          >Human Resource         </option>
                                <option value="Legal"                   >Legal                  </option>
                                <option value="Programmer"              >Programmer             </option>
                                <option value="Project"                 >Project                </option>
                                <option value="Product"                 >Product                </option>
                                <option value="Production"              >Production             </option>
                                <option value="Purchasing"              >Purchasing             </option>
                                <option value="R&D"                     >R&D                    </option>
                                <option value="Support_Workshop"        >Support Workshop       </option>
                                <option value="Tax"                     >Tax                    </option>
                            </select>
                            <label for="floatingdepartment">-- Department --</label>

                                @error('department')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating" >
                            <textarea name="desc" id="floatingDesc" class="form-control @error('desc') is-invalid @enderror" cols="50" rows="30"></textarea>
                            <label for="floatingDesc">Description</label>

                                @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                        </div>
                    </div>
                    {{-- <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select mt-2     " id="floatingdateline" placeholder="proposed_supplier" name="proposed_supplier">
                                <option value="Perusahaan">Perusahaan</option>
                                <option value="OrangPribadi">Orang Pribadi</option>
                                <option value="Ecommerce">Ecommerce</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                            <label for="floatingdateline">-- Proposed Supplier --</label>
                        </div>
                    </div> --}}
                    <div class="col-6   ">
                        <div class="form-floating" >
                            <select class="form-select mt-2  @error('atasan') is-invalid @enderror" id="floatingproposedto" placeholder="Proposed To" name="atasan">
                                <option value="" disabled selected hidden>Proposed To</option>
                                @foreach ($atasan as $sui)
                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingproposedto">-- Approved By --</label>
                                @error('atasan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating" >
                            <select class="form-select mt-2 mb-4 @error('matauang') is-invalid @enderror" id="floatingdateline" placeholder="Mata Uang" name="matauang">
                                <option value="" disabled selected hidden>Currency</option>
                                <option value="USD">USD</option>
                                <option value="RP">RP</option>
                            </select>
                            <label for="floatingdateline">-- Currency --</label>
                                @error('matauang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                    </div>
                    <div class="col-6">
                         <div class=" form-group m-checkbox-inline mb-0 @error('send_to') is-invalid @enderror" >
                            <div class="col-6">
                                <h5>Send To</h5>
                            </div>
                         <div class="radio radio-primary col-md-6" required>
                            <input id="tebet" type="radio" name="send_to" value="Tebet" required/>
                            <label for="tebet">Tebet</label>
                         </div>
                        <div class="radio radio-primary col-md-6">
                            <input id="cikunir" type="radio" name="send_to" value="Cikunir" required/>
                            <label for="cikunir">Cikunir</label>
                        </div>
                    </div>
                </div>

                    <table class="table table-bordered mt-2 mx-2 order-entry" id="dynamicAddRemove">
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Category</th>
                            <th>Price-per-unit</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="addMoreInputFields[0][item]" placeholder="Input Item" class="form-control  " required/>
                            </td>
                            <td><input type="number"  name="addMoreInputFields[0][qty]" placeholder="Input Quantity" class="form-control form-calc form-qty  " required/>
                            </td>
                            <td>
                                <select class="form-select " placeholder="Kategori" name="addMoreInputFields[0][kategori]" required>
                                    <option value="Pcs"  >Pcs   </option>
                                    <option value="Lusin">Lusin </option>
                                    <option value="Box"  >Box   </option>
                                    <option value="Unit" >Unit  </option>
                                </select>
                            </td>

                            <td><input type="text" name="addMoreInputFields[0][unit_price]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah " required/>
                            </td>
                            <td ><input type="text" name="addMoreInputFields[0][total]" class="form-control form-line text-end"/>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered mx-2">
                    <tr>
                        <td><label class="pull-right mx-2"> DPP :</label></td>
                        <td class="total_A text-end"><input style="display: none;" class="total_A rupiah" type="text" name="total_a"></td>
                    </tr>
                    <tr>
                        <td><input class="mt-1 pull-right check-box" type="checkbox" name="ppn" value="1" {{ old('ppn',0) === 1 ? 'checked' : '' }}><label class="pull-right mx-2"> PPN 11% :</label></td>
                        <td class="ppn text-end"><input style="display: none;" class="ppn rupiah" type="text" name="ppn"></td>
                    </tr>
                    <tr>
                        <td class="text-end">Grand Total :</td>
                        <td class="total text-end"><input style="display: none;" class="total" type="text" name="grand_total"></td>
                    </tr>
                </table>
                    <div class="mt-2">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+AddItem</button>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('menu-pengajuan-pembelian.index') }}" class="btn btn-danger mt-3">Back</a>
                        <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                    </div>
            </form>

            </div>
        </div>

         <!-- JavaScript Item -->
         <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
         <script src="jquery.maskMoney.js" type="text/javascript"></script>
         <script type="text/javascript">


         //Math

         $(document).ready(function() {

            //Convert To Rupiah

         var rupiah = document.querySelector(".rupiah");
             rupiah.addEventListener('keyup', function(e) {
             // tambahkan 'Rp.' pada saat form di ketik
             // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
             rupiah.value = formatRupiah(this.value, "Rp. ");
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
             return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
             }

             $(".order-entry").on("keyup", ".form-calc", function() {
                 var parent = $(this).closest("tr");
                 var str = parent.find(".form-cost").val();
                 var res = str.replace(/\D/g, "");
                 parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
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

         var i = 0;
             $("#dynamic-ar").click(function () {
                 ++i;
                 $("#dynamicAddRemove").append(

                    '<tr><td><input type="text" name="addMoreInputFields[' + i +
                    '][item]" placeholder="Input Item" class="form-control" /></td> <td><input type="text" name="addMoreInputFields[' + i +
                    '][qty]" placeholder="Input Quantity" class="form-control form-calc form-qty" /></td> <td><select class="form-select" placeholder="Kategori" name="addMoreInputFields[' + i +
                    '][kategori]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> <td><input type="text" name="addMoreInputFields[' + i +
                    '][unit_price]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah"/></td> <td><input type="text" name="addMoreInputFields[' + i +
                    '][total]" class="form-control form-line text-end" /></td></tr>'
                     );
                      var rupiah = document.querySelectorAll(".rupiah");
                        rupiah.forEach((item) => {
                            item.addEventListener('keyup', function(e) {
                                // tambahkan 'Rp.' pada saat form di ketik
                                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                            item.value = formatRupiah(this.value, "Rp. ");
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
                        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
                        }
             });
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

    </section>
@endsection
