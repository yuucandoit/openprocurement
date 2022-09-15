<title>Edit Data</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data</h5>
                <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/menu-taskList-atasan/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                            <div class="col-6">
                                <div class="form-floating">
                                    <input required type="date"
                                        class="form-control @error('date_ps') is-invalid @enderror mt-1 "
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
                                    <select class="form-select mt-1" id="floatingdateline" placeholder="Dateline" name="dateline" value="{{ $dv->dateline }}">
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
                                    <input type="text" class="form-control mt-1" id="floatingws"
                                        placeholder="Who Submitted" name="ws" value="{{ $dv->ws }}">
                                    <label for="floatingws">Who Submitted</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                        placeholder="Purpose" name="purpose" value="{{ $dv->purpose }}">
                                    <label for="floatingNoTelpon">Purpose</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-1" id="floatingitem"
                                        placeholder="Item" name="item" value="{{ $dv->item }}">
                                    <label for="floatingitem">Item</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-1" id="floatingNoTelpon"
                                        placeholder="Quantity" name="qty" value="{{ $dv->qty }}">
                                    <label for="floatingNoTelpon">Qty</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-1" id="floatingEmail"
                                        placeholder="PricePerUnit" name="priceperunit" value="{{ $dv->priceperunit }}">
                                    <label for="floatingEmail">Price/Unit</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                        placeholder="desc" name="desc" value="{{ $dv->desc }}">
                                    <label for="floatingNoTelpon">Description</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-1 " id="floatingNoTelpon"
                                        placeholder="bidang usaha" name="send_to" value="{{ $dv->send_to }}">
                                    <label for="floatingNoTelpon">Send To</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select mt-1" id="floatingdateline" placeholder="proposed_supplier" name="proposed_supplier" value="{{ $dv->proposed_supplier }}">
                                        <option value="Perusahaan">Perusahaan</option>
                                        <option value="OrangPribadi">Orang Pribadi</option>
                                        <option value="Ecommerce">Ecommerce</option>
                                        <option value="Unknown">Unknown</option>
                                    </select>
                                    <label for="floatingdateline">-- Proposed Supplier --</label>
                                </div>
                            </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            <a type="reset" class="btn btn-danger mt-4" href="{{ url('/menu-taskList-atasan/') }}">Back</a>
                        </div>
                </form>

            </div>
        </div>

    </section>
@endsection
