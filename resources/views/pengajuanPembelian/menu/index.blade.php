<title>Purchase Submission</title>

@extends('layouts.master')

@section('main')
    <section>
        @foreach ($datadv as $a)
        <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" style="color: white">Delete</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        <span class="warning">
                            <img src="assets/images/warning.png">
                        </span>
                        <h2 style="text-align: center"> Are you sure want to delete this task? </h2>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('/menu-pengajuan-pembelian/destroy/' . $a->id) }}">
                            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

        <!-- Page Sidebar Ends-->
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h1>Purchase Submission</h1>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Purchase Submission</li>
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
                  <div class="card-header">
                    <a href="{{ url('menu-pengajuan-pembelian/create/') }}" class="btn btn-primary mb-3" ></i> Add <i class="fa fa-plus"></i></a>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="responsive">
                        <thead>
                          <tr style="text-align: center;">
                            <th>No</th>
                            <th>Date</th>
                            <th>Who Filed</th>
                            <th>Description</th>
                            @hasrole('admin|super admin')
                            <th>Status</th>
                            @endhasrole
                            <th>Action</th>
                                @hasrole('user')
                            <th>Status</th>
                               @endhasrole
                          </tr>
                        </thead>
                        <tbody>
                      @php
                        $no = 1;
                     @endphp
                    @foreach ($datadv as $ppembelian)
                    {{-- @if ($ppembelian->status == '') --}}
                   <tr style="text-align: center;">
                      <td>{{ $no++ }}</td>
                      <td>{{ $ppembelian->date_ps }}</td>
                      <td>{{ $ppembelian->ws }}</td>
                      <td><a href="{{ $ppembelian->desc }}" target="_blank">{{ $ppembelian->desc }}</a></td>
                      @hasrole('admin|super admin')
                      <td><b>{{ $ppembelian->status }}</b></td>
                       @endhasrole
                      <td>
                          <a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}" class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                          @if ($ppembelian->status == 'Accepted' )

                           @else
                            <a href="{{ url('/menu-pengajuan-pembelian/edit/' . $ppembelian->id) }}" class="btn btn-outline-warning"><i class="bx bxs-edit"></i> Edit</a>
                            @endif

                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $ppembelian->id }}">Delete</button>
                      </td>
                      @hasrole('user|super admin')
                       <td> <a class="badge {{ $ppembelian->status == 'Awaiting Purchase Submission Approval' ? 'bg-warning' : ($ppembelian->status == 'Accepted by Super user' || 'Accepted by Purchasing' ? 'bg-success' : 'bg-danger') }} mt-1" style="color: white; font-size:18">{{ $ppembelian->status }}</a></td>
                      @endhasrole

                    </tr>
                     {{-- @endif --}}
                     @endforeach
                     </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="u-pearls-sm  row mb-7">
                            <div class="u-pearl current col-4"><span class="u-pearl-number">1</span><span class="u-pearl-title">Add Purchase Submission</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">2</span><span class="u-pearl-title">Approval Super User For PS</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">3</span><span class="u-pearl-title">Task List Purchasing</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">4</span><span class="u-pearl-title">Purchase Order</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">5</span><span class="u-pearl-title">Approval Super User For PO</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">6</span><span class="u-pearl-title">Prepare For Fund Submission</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">7</span><span class="u-pearl-title">Paid</span></div>
                            <div class="u-pearl col-4"><span class="u-pearl-number">7</span><span class="u-pearl-title">Done</span></div>
                        </div>
                </div>
                  </div>
              </div>
                    <script>
                        $(document).ready(function() {

                            $('.servidelet  ebtn').click(function(e) {
                                e.preventDefault();
                                alert('hello');
                            });

                        });
                    </script>
                    <!-- fungsi javascript untuk menampilkan form dinamis  -->
                    <!-- penjelasan :
                    saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".add-more").click(function(){
                            var html = $(".copy").html();
                            $(".after-add-more").after(html);
                        });

                        // saat tombol remove di klik control group akan dihapus
                        $("body").on("click",".remove",function(){
                            $(this).parents(".control-group").remove();
                        });
                    });
                    </script>

                    <!-- JavaScript Item -->
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="jquery.maskMoney.js" type="text/javascript"></script>
                    <script type="text/javascript">

                            $(document).ready(function(){
                                $('#rupiah').maskMoney();
                            });

                    //Math

                    $(document).ready(function() {
                        $(".order-entry").on("keyup", ".form-calc", function() {
                            var parent = $(this).closest("tr");
                            parent.find(".form-line").val((parent.find(".form-qty").val() * parent.find(".form-cost").val()) .toFixed(0));
                            var total = 0;
                            $(".form-line").each(function(){
                                total += parseInt($(this).val()||0);
                            });
                            var checkbox =  document.querySelector(".check-box");
                            checkbox.addEventListener('change', (event) =>{
                                if(event.currentTarget.checked){
                                    totalppn = total * 11 / 100;
                                    $(".total").text(totalppn);
                                }
                                else{
                                    $(".total").text(total.toFixed(0));
                                }
                            })

                        });
                    });

                    //Add Form

                    var i = 0;
                        $("#dynamic-ar").click(function () {
                            ++i;
                            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                                '][item]" placeholder="Input Item" class="form-control" /></td> <td><input type="text" name="addMoreInputFields[' + i +
                                '][qty]" placeholder="Input Quantity" class="form-control form-calc form-qty" /></td> <td><select class="form-select" placeholder="Kategori" name="addMoreInputFields[' + i +
                                '][kategori]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> <td><input type="text" name="addMoreInputFields[' + i +
                                '][unit_price]" placeholder="Input Price" class="form-control text-end form-calc form-cost"/></td> <td><input type="text" name="addMoreInputFields[' + i +
                                '][total]" class="form-control form-line" /></td></tr>'
                                );
                        });
                        $(document).on('click', '.remove-input-field', function () {
                            $(this).parents('tr').remove();
                        });

                    //Convert To Rupiah

                    // var rupiah = document.querySelector(".rupiah");
                    //     rupiah.addEventListener('keyup', function(e) {
                    //     // tambahkan 'Rp.' pada saat form di ketik
                    //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    //     rupiah.value = formatRupiah(this.value, "Rp. ");
                    //     });

                    //     /* Fungsi formatRupiah */
                    //     function formatRupiah(angka, prefix) {
                    //     var number_string = angka.replace(/[^,\d]/g, ""),
                    //         split = number_string.split(","),
                    //         sisa = split[0].length % 3,
                    //         rupiah = split[0].substr(0, sisa),
                    //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    //     if (ribuan) {
                    //         separator = sisa ? "." : "";
                    //         rupiah += separator + ribuan.join(".");
                    //     }

                    //     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                    //     return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
                    //     }


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
