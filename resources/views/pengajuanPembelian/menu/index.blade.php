<title>Purchase Request</title>

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
        <div class="col-sm-6 mt-4">
          <h3>Purchase Request</h3>
          <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Purchase Request</li>
          </ol>
        </div>
        {{-- <div class="col-sm-6 mt-4">
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
        </div> --}}
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <a href="{{ url('menu-pengajuan-pembelian/create/') }}" class="btn btn-primary mb-3" ></i> Add <i class="fa fa-plus"></i></a>
            <div class="pull-right">
                <form action="{{ route('menu-pengajuan-pembelian.SearchPRQ') }}" method="get" class="input-group">
                    <input type="text" name="cari" class="form-control " placeholder="Search ..." value="{{ old('cari') }}">
                    <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                </form>
            </div>
            <div class="table-responsive">
              <table class="table table-striped ">
                <thead class="bg-primary">
                 <tr>
                  <th>No</th>
                  <th>Request By</th>
                  <th>Description</th>
                  <th>Progress</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               @php
               $no = 1;
               $i = 1 + $datadv->currentPage() * $datadv->perPage() - $datadv->perPage();
               @endphp
               @foreach($datadv as $ppembelian)
               {{-- @if ($ppembelian->status == '') --}}
               <tr>
                <td style="">{{ $i++ }}</td>
                <td style=""><ul><li><strong>{{ $ppembelian->date_ps }}</strong></li><li>{{ $ppembelian->whosubmit->name }}</li></ul></td>
                <td style=" word-break: break-word; width:32%;"><a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}">{!! nl2br($ppembelian->desc) !!}</a></td>
                @hasrole('user|super admin')
                <td>
            <ul>
                <li>
                <p><strong>Purchase&nbsp;: </strong>
                  @if ($ppembelian->status == 'Awaiting Purchase Request Approval')
                  -
                  @elseif ($ppembelian->status == 'Waiting For PO Approval')
                  -
                  @elseif($ppembelian->status == 'Invoicing Process')
                  -
                  @elseif ($ppembelian->status == 'Purchase Request Approved' )
                  <a class="badge bg-warning mt-1" style="color:white; font-size:8;" >Waiting</a>
                  @elseif( $ppembelian->status == 'Purchase Proses')
                  <a class="badge bg-success mt-1" style="color:white; font-size:8;" >On Process PO</a>
                  @elseif( $ppembelian->status == 'PO Approved')
                  <a class="badge bg-success mt-1" style="color:white; font-size:8;" >Creating Payment Request</a>
                  @elseif($ppembelian->status == 'Payment Approved' )
                  <a class="badge bg-success mt-1" style="color:white; font-size:8;" >Waiting</a>
                  @elseif ($ppembelian->status == 'Unpaid' || $ppembelian->status == 'Paid' || $ppembelian->status == 'Delivery process' || $ppembelian->status == 'Delivery Success')
                  <a class="badge bg-success mt-1" style="color:white; font-size:8;">Done</a>
                  @elseif ($ppembelian->status == 'Rejected by Purchasing')
                  -
                  @endif
                </p>
                </li>
                <li>
                <p><strong>Payment&nbsp; :</strong>
                  @if ($ppembelian->status == 'Unpaid')
                  <a class="badge bg-warning mt-1" style="color: white; font-size:8">Unpaid</a>
                  @elseif ($ppembelian->status == 'Paid' || $ppembelian->status == 'Delivery Success' )
                  <a class="badge bg-success mt-1" style="color: white; font-size:8">Done</a>
                  @elseif ($ppembelian->status == 'Purchase Request Approved' || $ppembelian->status == 'Purchase Proses' || $ppembelian->status == 'PO Approved'  || $ppembelian->status == 'Payment Approved' )
                  -
                  @elseif ($ppembelian->status == 'Awaiting Purchase Request Approval')
                  -
                  @elseif ($ppembelian->status == 'Waiting For PO Approval')
                  -
                  @elseif($ppembelian->status == 'Invoicing Process')
                  -
                  @elseif ($ppembelian->status == 'Rejected by Purchasing')
                  -
                  @endif
                </p>
                </li>
                <li>
                <p><strong>Delivery &nbsp;&nbsp;:</strong>
                    @if ($ppembelian->status == 'Paid')
                    <a class="badge bg-warning mt-1 btn btn-warning" style="color: white; font-size:8" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"> Delivery On Process</a>
                    @elseif ($ppembelian->status == 'Delivery Success')
                    <a class="badge bg-success mt-1" style="color: white; font-size:8">Delivered</a>
                    @elseif ($ppembelian->status == 'Purchase Request Approved' || $ppembelian->status == 'Purchase Proses' || $ppembelian->status == 'PO Approved'  || $ppembelian->status == 'Payment Approved' )
                    -
                    @elseif ($ppembelian->status == 'Awaiting Purchase Request Approval')
                    -
                    @elseif ($ppembelian->status == 'Waiting For PO Approval')
                    -
                    @elseif($ppembelian->status == 'Invoicing Process')
                    -
                    @elseif ($ppembelian->status == 'Rejected by Purchasing')
                    -
                    @endif
                </p>
                </li>
            </ul>
                </td>
                <td style="">
                    @if ($ppembelian->status == 'Awaiting Purchase Request Approval')
                    <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Purchase Request</a>
                    @endif
                    @if($ppembelian->status == 'Purchase Request Approved')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Approved By {{ $ppembelian->bod->name }}</a>
                    @endif
                    @if($ppembelian->status == 'Purchase Proses')
                    <a class="badge bg-primary mt-1" style="color: white; font-size:12">Request On Process Purchase</a>
                    @endif
                    @if($ppembelian->status == 'Waiting For PO Approval')
                    <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Purchase Order</a>
                    @endif
                    @if($ppembelian->status == 'PO Approved' )
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Approved By {{ $ppembelian->atasans->name }}</a>
                    @endif
                    @if($ppembelian->status == 'Invoicing Process')
                    <a class="badge bg-warning mt-1" style="color: white; font-size:12">Waiting Approval Payment Request</a>
                    @endif
                    @if($ppembelian->status == 'Payment Approved')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Approved By {{ $ppembelian->atasanpymnt->name }}</a>
                    @endif
                    @if($ppembelian->status == 'Unpaid')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Unpaid</a>
                    @endif
                    @if($ppembelian->status == 'Paid')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Paid & Delivery Process</a>
                    @endif
                    @if($ppembelian->status == 'Delivery Success')
                    <a class="badge bg-success mt-1" style="color: white; font-size:12">Completed</a>
                    @endif
                    @if ($ppembelian->status == 'Rejected by Purchasing')
                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Purchase</a>
                    @endif
                    @if ($ppembelian->status == 'Purchase Request Rejected By BOD')
                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->bod->name }} )</a>
                    @endif
                    @if ($ppembelian->status == 'Payment Rejected By BOD')
                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->atasanpymnt->name }} )</a>
                    @endif
                    @if ($ppembelian->status == 'PO Rejected By BOD')
                    <a class="badge bg-danger mt-1" style="color: white; font-size:12">Rejected By Bod ( {{ $ppembelian->atasans->name }} )</a>
                    @endif
                </td>

                @endhasrole

                <td>
                <div>
                <button class="btn btn-iconsolid mt-1" style="background-color: #0693c2; font-size:10;"   >
                    <a href="{{ url('/exportpdf/ppb/' . $ppembelian->id) }}" title="Preview PDF"><i
                        class="icon-eye"></i>
                    </a>
                </button>
            </div>
                   {{-- <div>
                    <button class="btn btn-iconsolid mt-1"  style="background-color: #00008B; font-size:10;" >
                    <a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}" class="example-popover"  title="Details" data-placement="right" data-bs-toggle="tooltip"><i class="icon-zoom-in"></i>
                    </a>
                </button>
                </div> --}}
                    @if ($ppembelian->status == 'Awaiting Purchase Submission Approval' )

                  <a class="btn btn-iconsolid mt-1" style="background-color: #FF8C00;" href="{{ url('/menu-pengajuan-pembelian/edit/' . $ppembelian->id) }}"><i class="icon-pencil-alt" title="Edit"></i>
                  </a>
                  @else

                  @endif
                  <button class="btn btn-iconsolid mt-1" data-bs-toggle="modal" style="background-color: #ff0000; font-size:10;" data-bs-target="#modalDelete{{ $ppembelian->id }}"><i class="icon-trash" title="Delete"></i>
                  </button>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-4">
          {{ $datadv->withQueryString()->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Zero Configuration  Ends-->
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
