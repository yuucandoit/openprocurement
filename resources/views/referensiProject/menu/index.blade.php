<title>Pengajuan Pembelian</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Add Form</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('/menu-pengajuan-pembelian/store') }} id="formAdd" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row modal-body container">
                            <div class="col-6">
                                <div class="form-floating">
                                    <input required type="date"
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
                                <div class="form-floating">
                                    <select class="form-select mt-2" id="floatingdateline" placeholder="Dateline" value="{{ old('dateline') }}" name="dateline" >
                                        <option value="≤3Jam">≤ 3 Jam</option>
                                        <option value="≤24Jam">≤ 24 Jam</option>
                                        <option value="≤2Hari">≤ 2 Hari</option>
                                        <option value="SesuaiPo">Sesuai PO</option>
                                    </select>
                                    <label for="floatingdateline">-- Date Line --</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4" id="floatingws"
                                        placeholder="Who Submitted" name="ws">
                                    <label for="floatingws">Who Submitted</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="Purpose" name="purpose">
                                    <label for="floatingNoTelpon">Purpose</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-4" id="floatingdepartment" placeholder="department" name="department" >
                                        <option value="Business_Development"    >Business Development   </option>
                                        <option value="Finance"                 >Finance                </option>
                                        <option value="GA"                      >GA                     </option>
                                        <option value="Human_Resource"          >Human Resource         </option>
                                        <option value="Legal"                   >Legal                  </option>
                                        <option value="Project"                 >Project                </option>
                                        <option value="Product"                 >Product                </option>
                                        <option value="Production"              >Production             </option>
                                        <option value="Purchasing"              >Purchasing             </option>
                                        <option value="R&D"                     >R&D                    </option>
                                        <option value="Support_Workshop"        >Support Workshop       </option>
                                        <option value="Tax"                     >Tax                    </option>
                                    </select>
                                    <label for="floatingdepartment">-- Department --</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea required name="desc" id="floatingNoTelpon" class="form-control mt-4" cols="50" rows="30"></textarea>
                                    <label for="floatingNoTelpon">Description</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-4" id="floatingdateline" placeholder="proposed_supplier" name="proposed_supplier" >
                                        <option value="Perusahaan">Perusahaan</option>
                                        <option value="OrangPribadi">Orang Pribadi</option>
                                        <option value="Ecommerce">Ecommerce</option>
                                        <option value="Unknown">Unknown</option>
                                    </select>
                                    <label for="floatingdateline">-- Proposed Supplier --</label>
                                </div>
                            </div>
                            <div class="col-12   ">
                                <div class="form-floating">
                                    <select class="form-select mt-2" id="floatingproposedto" placeholder="Proposed To" name="atasan" >
                                        @foreach ($atasan as $sui)
                                        <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingproposedto">-- Approved By --</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-2 mb-4" id="floatingdateline" placeholder="Mata Uang" name="matauang" >
                                        <option value="USD">USD</option>
                                        <option value="RP">RP</option>
                                    </select>
                                    <label for="floatingdateline">-- Currency --</label>
                                </div>
                            </div>
                            <div class="mx-2">
                                 <div class=" form-group m-t-15 m-checkbox-inline mb-0 ">
                                    <div class="col-sm-12">
                                        <h5>Send To</h5>
                                    </div>
                                 <div class="radio radio-primary col-md-6">
                                    <input id="tebet" type="radio" name="send_to" value="Tebet">
                                    <label for="tebet">Tebet</label>
                                 </div>
                                <div class="radio radio-primary col-md-6">
                                    <input id="cikunir" type="radio" name="send_to" value="Cikunir">
                                    <label for="cikunir">Cikunir</label>
                                </div>
                            </div>
                        </div>

                            <table class="table table-bordered mt-4 mx-2" id="dynamicAddRemove">
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price-per-unit</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="addMoreInputFields[0][item]" placeholder="Input Item" class="form-control" />
                                    </td>
                                    <td><input type="text" name="addMoreInputFields[0][qty]" placeholder="Input Quantity" class="form-control" />
                                    </td>
                                    <td><input type="text" name="addMoreInputFields[0][unit_price]" placeholder="Input Price" class="form-control" />
                                    </td>
                                    <td style="display: none;"><input type="text" name="addMoreInputFields[0][total]" class="form-control" />
                                    </td>
                                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+AddItem</button></td>
                                </tr>
                            </table>

                            {{-- <div class="col-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4 mb-3" id="floatingSubject" placeholder="Item"
                                        name="item">
                                    <label>Item</label>
                                </div>
                            </div>
                            <div class="col-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control mt-4 mb-3" id="floatingName"
                                            placeholder="Jumlah" name="qty">
                                        <label>Quantity</label>
                                    </div>
                            </div>
                                <div class="col-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control mt-4 mb-3" id="floatingName" placeholder="Harga"
                                            name="unit_price">
                                        <label>Price Per Unit</label>
                                    </div>
                                </div> --}}

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

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

        {{-- @foreach ($datadv as $a)
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
        @endforeach --}}

        <div class="container-fluid">
            <div class="row">
                <div class="py-3">
                    <h1>Pengajuan Pembelian</h1>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                                class="bx bx-list-plus"></i> Add+</button>
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Who Filed</th>
                                                <th>Description</th>
                                                {{-- <th>Purpose</th>
                                                <th>Price Per Unit</th>
                                                <th>Sent to</th>
                                                <th>Delivery Date</th>
                                                <th>Suggested supplier</th> --}}
                                                @hasrole('admin|super admin')
                                                    <th>Status</th>
                                                @endhasrole
                                                <th>Action</th>
                                                @hasrole('user')
                                                    <th>status</th>
                                                @endhasrole
                                            </tr>
                                        </thead>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datadv as $ppembelian)

                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $ppembelian->date_ps }}</td>
                                                <td>{{ $ppembelian->ws }}</td>
                                                <td><a href="{{ $ppembelian->desc }}" target="_blank">{{ $ppembelian->desc }}</a></td>
                                                @hasrole('admin|super admin')
                                                   <td>
                                                        <b>{{ $ppembelian->status }}</b>
                                                    </td>
                                                @endhasrole
                                                <td>
                                                    <a href="{{ url('menu-pengajuan-pembelian/detail/' .  $ppembelian->id) }}"
                                                        class="btn btn-outline-info"><i class="bx bx-detail"></i> Detail</a>
                                                        @if ($ppembelian->status == 'Accepted' )

                                                        @else
                                                        <a href="{{ url('/menu-pengajuan-pembelian/edit/' . $ppembelian->id) }}"
                                                            class="btn btn-outline-warning"><i class="bx bxs-edit"></i> Edit</a>
                                                        @endif



                                                    <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalDelete{{ $ppembelian->id }}">Delete</button>
                                                </td>
                                                @hasrole('user|super admin')
                                                    <td> <a class="badge {{ $ppembelian->status == 'pending' ? 'bg-warning' : ($ppembelian->status == 'Accepted by Super user' || 'Accepted by Purchasing' ? 'bg-success' : 'bg-danger') }} mt-1"
                                                            style="color: white; font-size:18">{{ $ppembelian->status }}</a></td>
                                                @endhasrole

                                            </tr>
                                         @endforeach
                                    </table>
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
                    <script type="text/javascript">
                        var i = 0;
                        $("#dynamic-ar").click(function () {
                            ++i;
                            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                                '][item]" placeholder="Input Item" class="form-control" /></td> <td><input type="text" name="addMoreInputFields[' + i +
                                '][qty]" placeholder="Input Quantity" class="form-control" /></td> <td><input type="text" name="addMoreInputFields[' + i +
                                '][unit_price]" placeholder="Input Unit Price" class="form-control" /></td> <td style="display: none;"><input type="text" name="addMoreInputFields[' + i +
                                '][total]" class="form-control" /></td> <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
                                );
                        });
                        $(document).on('click', '.remove-input-field', function () {
                            $(this).parents('tr').remove();
                        });
                    </script>
                </section>
            @endsection
