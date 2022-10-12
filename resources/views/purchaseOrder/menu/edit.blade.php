<title>Edit Data</title>

@extends('layouts.master')

@section('main')
<section>
    <div class="container-fluid">
        <div class="page-header">
          <div class="row">
            <div class="col-sm-6">
             <h1>Edit Task List</h1>
             <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('menu-taskList-atasan.index') }}">Task List</a></li>
              <li class="breadcrumb-item">Edit Task List</li>
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
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header pb-0">
              <h5>Edit Task List</h5>
            </div>
            <div class="card-body">
              <form action="{{ url('/menu-purchase-order/update/' . $dv->id) }}" id="formAdd" method="post"
              enctype="multipart/form-data">
              @csrf
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="floatingTanggal"><i class="fa fa-calendar"></i> Date :</label>
                  <div class="form-group" >
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
                  <div class="form-group" >
                    <label for="floatingdateline"><i class="fa fa-clock-o"></i>  Date Line :</label>
                    <select class="form-select page @error('dateline') is-invalid @enderror" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline" >
                      <option selected hidden>{{ $dv->dateline }}   *Select For Update Data</option>
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
                    <label for="floatingwhosubmitted"><i class="fa fa-user"></i> Who Submitted :</label>
                    <select class="form-select page @error('ws') is-invalid @enderror" id="floatingwhosubmitted" placeholder="Who Submitted" name="ws" >
                      <option selected hidden                 >{{ $dv->ws }}    *Select For Update Data</option>
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
                    <select class="form-select page @error('purpose') is-invalid @enderror" id="pageSelector" placeholder="Purpose" name="purpose">
                      @foreach ($purpose as $p)
                      <option selected hidden>{{ $p->nama }}    *Select For Update Data</option>
                      <option value="{{ $p->id }}">{{ $p->nama }}</option>
                      @endforeach
                      <option value="custom">+ Add Project</option>
                    </select>
                    <input type="text" class="hide form-control mt-2" placeholder="Input Project" name="nama" id="customInput" >
                    @error('purpose')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="floatingdepartment"><i class="fa fa-institution"></i> Department :</label>
                    <select class="form-select page @error('department') is-invalid @enderror" id="floatingdepartment" placeholder="department" name="department" >
                      <option value="{{ $dv->department }}" selected hidden>{{ $dv->department }}   *Select For Update Data</option>
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
                      <textarea name="desc" id="floatingNoTelpon" class="form-control page @error('desc') is-invalid @enderror" cols="50" rows="30">{{ $dv->desc }}</textarea>
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
                   <label class="form-label" style="font-weight: bold;"><i class="icofont icofont-stamp"></i> Approved By :</label>
                   <select class="form-select page @error('atasan') is-invalid @enderror" id="floatingproposedto" placeholder="Proposed To" name="atasan" >
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
                 <label class="form-label" style="font-weight: bold;"><i class="fa fa-money"></i> Currency :</label>
                 <select class="form-select page @error('matauang') is-invalid @enderror" id="floatingdateline" placeholder="Mata Uang" name="matauang" >
                  <option selected="" value="{{ $dv->matauang }}">{{ $dv->matauang }}   * Select For Update Data</option>
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
             <div class=" form-group m-checkbox-inline mb-0 @error('send_to') is-invalid @enderror" >
              <div class="col-6">
                <label><i class="fa fa-send"></i> Send To :</label>
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
          <hr>
          <table class="table table-bordered mt-2 mx-2 order-entry" id="dynamicAddRemove">
            <tr style="text-align: center;">
              <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Item</th>
              <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Qty</th>
              <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Category</th>
              <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Price-per-unit</th>
              <th style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Total</th>
            </tr>
            @foreach ($item as $i)
            <tr>
              <td class="text"><input type="text" name="addMoreInputFields[$i][item]" placeholder="Input Item" class="form-control" style="text-align: center;"  value="{{ $i['item'] }}" required/>
              </td>
              <td><input type="number"  name="addMoreInputFields[$i][qty]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" value="{{ $i['qty'] }}" required/>
              </td>
              <td>
                <select class="form-select " placeholder="Kategori" name="addMoreInputFields[$i][kategori]" value="{{ $i['kategori'] }}" required>
                  <option selected disabled hidden>Choose a Category</option>
                  <option value="Pcs"  >Pcs   </option>
                  <option value="Lusin">Lusin </option>
                  <option value="Box"  >Box   </option>
                  <option value="Unit" >Unit  </option>
                </select>
              </td>
              <td>
                <input type="text" name="addMoreInputFields[$i][unit_price]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;" value="{{ $i['unit_price'] }}" required/>
              </td>
              <td>
                <input type="text" name="addMoreInputFields[$i][total]" class="form-control form-line" style="text-align: right;" required  />
              </td>
            </tr>
            @endforeach
          </table>
          <br>
          <table class="table table-bordered mx-2">
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
          {{-- <div class="mt-2">
            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary"> AddItem
              <i class="fa fa-plus"></i>
            </button>
          </div>--}}
          <br>
          <div class="modal-footer">
            <a href="{{ route('menu-purchase-order.index') }}" class="btn btn-danger-gradien mt-3">Back</a>
            <button type="submit" class="btn btn-primary-gradien btn_add mt-3">Submit</button>
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

            var rupiah = document.querySelectorAll(".rupiah");
            rupiah.forEach((item) => {
                item.addEventListener('keyup', function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    item.value = formatRupiah(this.value, "Rp. ");
            });

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
        });
        //Add Form

        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(

                '<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][item]" placeholder="Input Item" class="form-control" /></td> <td><input type="text" name="addMoreInputFields[' +
                i +
                '][qty]" placeholder="Input Quantity" class="form-control form-calc form-qty" /></td> <td><select class="form-select" placeholder="Kategori" name="addMoreInputFields[' +
                i +
                '][kategori]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> <td><input type="text" name="addMoreInputFields[' +
                i +
                '][unit_price]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah"/></td> <td><input type="text" name="addMoreInputFields[' +
                i +
                '][total]" class="form-control form-line text-end" /></td></tr>'
            );

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
