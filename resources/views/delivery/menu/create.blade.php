<title>Delivery</title>
@extends('layouts.master')

@section('main')
<section>
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6 mt-4">
         <h1>Report Delivery</h1>
         <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('menu-pengajuan-pembelian.index') }}">Purchase Submission</a></li>
          <li class="breadcrumb-item">Create Purchase Submission</li>
        </ol>
      </div>
      <div class="col-sm-6 mt-4">
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
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5>Form Purchase Submission</h5>
        </div>
        <div class="card-body">
          <form action="{{ url('/menu-pengajuan-pembelian/store') }}" id="formAdd" method="post"
          enctype="multipart/form-data">
          @csrf

          <div class="row">

          <div class="col-md-12">
              <div class="form-group">
                  <input type="file" name="image" placeholder="Choose image" id="image">
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
              </div>
          </div>

          <div class="col-md-12 mb-2">
              <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                  alt="preview image" style="max-height: 250px;">
          </div>

          <div class="col-md-12">
              <button type="submit" class="btn btn-primary" id="submit">Submit</button>
          </div>
      </div>
      <br>
      <div class="modal-footer">
        <a href="{{ route('menu-pengajuan-pembelian.index') }}" class="btn btn-danger-gradien mt-3">Back</a>
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
         //Math
         $(document).ready(function() {
            //Convert To Rupiah
            var rupiah = document.querySelector(".rupiah");
            rupiah.forEach(item => {
                  item.value = formatRupiah(item.value, "Rp. ");
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
         $(".addItem").on('click', function () {
            addItem();
         });
         function addItem(){
            var item =
            '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td><td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> ';
            $(".item").append(item)
        }
        $(document).on('click', '.remove-input-field', function () {
           $(this).parents('tr').remove();
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
              if(this.value == "project") {
                selectedInput.classList.remove('hide');
              } else {
                selectedInput.classList.add('hide');
              }
            })

            // Private Person
            pageSelect.addEventListener('change', function(){
              if(this.value == "office") {
                selectedInput2.classList.remove('hide');
              } else {
                selectedInput2.classList.add('hide');
              }
            })

            // Ecommerce
            pageSelect.addEventListener('change', function(){
              if(this.value == "other_needs") {
                selectedInput3.classList.remove('hide');
              } else {
                selectedInput3.classList.add('hide');
              }
            })
          </script>
    </section>
    @endsection
