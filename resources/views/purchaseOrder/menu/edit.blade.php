<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data</h5>

                <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/menu-purchase-order/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="date"
                                class="form-control
                                id="floatingTanggal" placeholder="Tanggal" name="date_ps"
                                value="{{ old('date_ps', date('Y-m-d')) }}" disabled >
                            <label for="floatingTanggal">Date</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select mt-1" id="floatingdateline" placeholder="Dateline" name="dateline" value="{{ $dv->dateline }}" disabled>
                                <option value="Urgent">Urgent</option>
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
                            <input type="text" class="form-control mt-1" id="floatingws "
                                placeholder="Who Submitted" name="ws" value="{{ $dv->ws }}" disabled>
                            <label for="floatingws">Who Submitted</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="Purpose" name="purpose" value="{{ $dv->purpose }}" disabled>
                            <label for="floatingNoTelpon">Purpose</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1" id="floatingitem"
                                placeholder="Item" name="item" value="{{ $dv->item }}" disabled>
                            <label for="floatingitem">Item</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1" id="floatingNoTelpon"
                                placeholder="Quantity" name="qty" value="{{ $dv->qty }}" disabled>
                            <label for="floatingNoTelpon">Qty</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1" id="floatingEmail"
                                placeholder="PricePerUnit" name="priceperunit" value="{{ $dv->priceperunit }}" disabled>
                            <label for="floatingEmail">Price/Unit</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="desc" name="desc" value="{{ $dv->desc }}"disabled>
                            <label for="floatingNoTelpon">Description</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="bidang usaha" name="send_to" value="{{ $dv->send_to }}"disabled>
                            <label for="floatingNoTelpon">Send To</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select mt-1" id="floatingdateline" placeholder="proposed_supplier" name="proposed_supplier" disabled>
                                <option value="{{ $dv->proposed_supplier }}">{{ $dv->proposed_supplier }}</option>
                                {{-- <option value="Perusahaan">Perusahaan</option>
                                <option value="OrangPribadi">Orang Pribadi</option>
                                <option value="Ecommerce">Ecommerce</option>
                                <option value="Unknown">Unknown</option> --}}
                            </select>
                            <label for="floatingdateline">-- Proposed Supplier --</label>
                        </div>
                    </div>
                    @if ($dv->proposed_supplier == 'Perusahaan')
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select mt-1" id="floatingdateline" placeholder="Vendor" name="pt_id">
                                @foreach ($pt as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingdateline">-- Perusahaan --</label>
                        </div>
                    </div>
                    @endif

                    @if ($dv->proposed_supplier == 'OrangPribadi')
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select mt-1" id="floatingdateline" placeholder="Vendor" name="op_id">
                                @foreach ($op as $o)
                                <option value="{{ $o->id}}">{{ $o->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingdateline">-- Orang Pribadi --</label>
                        </div>
                    </div>
                    @endif

                    @if ($dv->proposed_supplier == 'Ecommerce')
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select mt-1" id="floatingdateline" placeholder="Vendor" name="ec_id">
                                @foreach ($ec as $e)
                                <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                @endforeach
                            </select>
                            <label for="floatingdateline">-- Ecommerce --</label>
                        </div>
                    </div>
                    @endif

                    @if ($dv->proposed_supplier == 'Unknown')
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="Vendor" name="vendor" >
                            <label for="floatingNoTelpon">Vendor</label>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="Address" name="address" >
                            <label for="floatingNoTelpon">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="No_Telp" name="no_telp" >
                            <label for="floatingNoTelpon">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="NPWP" name="npwp" >
                            <label for="floatingNoTelpon">NPWP</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                placeholder="Quotation" name="quotation" >
                            <label for="floatingNoTelpon">Quotation</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
