<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data</h5>

                <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/menu-pengajuan-pembelian/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
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
                                    <select class="form-select mt-2" id="floatingdateline" placeholder="Dateline" name="dateline" value="{{ $dv->dateline }}">
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
                                        placeholder="Who Submitted" name="ws" value="{{ $dv->ws }}">
                                    <label for="floatingws">Who Submitted</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="Purpose" name="purpose" value="{{ $dv->purpose }}">
                                    <label for="floatingNoTelpon">Purpose</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="desc" name="desc" value="{{ $dv->desc }}">
                                    <label for="floatingNoTelpon">Description</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="desc" name="divisi" value="{{ $dv->divisi }}"">
                                    <label for="floatingNoTelpon">Divisi</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select mt-4" id="floatingdateline" placeholder="proposed_supplier" name="proposed_supplier" value="{{ $dv->proposed_supplier }}">
                                        <option value="Perusahaan">Perusahaan</option>
                                        <option value="OrangPribadi">Orang Pribadi</option>
                                        <option value="Ecommerce">Ecommerce</option>
                                        <option value="Unknown">Unknown</option>
                                    </select>
                                    <label for="floatingNoTelpon">Proposed Supplier</label>
                                </div>
                            </div>
                            <div class="mx-2">
                                <div class=" form-group m-t-15 m-checkbox-inline mb-0">
                                   <div class="col-sm-12">
                                       <h5>Send To</h5>
                                   </div>
                                <div class="radio radio-primary col-md-6">
                                   <input id="tebet" type="radio" name="send_to" value="Tebet" required>
                                   <label for="tebet">Tebet</label>
                                </div>
                               <div class="radio radio-primary col-md-6">
                                   <input id="cikunir" type="radio" name="send_to" value="Cikunir" required>
                                   <label for="cikunir">Cikunir</label>
                               </div>
                           </div>
                                    <table class="table table-bordered mt-4 mx-2" id="dynamicAddRemove">
                                        <tr>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Price-per-unit</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($item as $i)
                                        <tr>
                                            <td><input type="text" name="addMoreInputFields[$i][item]" placeholder="Input Item" class="form-control" value="{{ $i['item'] }}"/>
                                            </td>
                                            <td><input type="text" name="addMoreInputFields[$i][qty]" placeholder="Input Quantity" class="form-control" value="{{ $i['qty'] }}"/>
                                            </td>
                                            <td><input type="text" name="addMoreInputFields[$i][unit_price]" placeholder="Input Price" class="form-control" value="{{ $i['unit_price'] }}"/>
                                            </td>
                                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+AddItem</button></td>
                                        </tr>
                                        @endforeach
                                    </table>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <a type="reset" class="btn btn-danger mt-4" href="{{ url('/menu-pengajuan-pembelian/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>
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
                     '][unit_price]" placeholder="Input Unit Price" class="form-control" /></td> <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
                     );
             });
             $(document).on('click', '.remove-input-field', function () {
                 $(this).parents('tr').remove();
             });
         </script>

    </section>
@endsection
