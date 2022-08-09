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
                        <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select mt-2" id="floatingPKP" placeholder="Company" name="pt_id">
                                        @foreach ($datapt as $pt)
                                        <option value="{{ $pt->id }}">{{ $pt->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingPKP">-- Company --</label>
                                </div>
                            </div>
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
                                    <input required type="date"
                                        class="form-control @error('date_send') is-invalid @enderror mt-2 "
                                        id="floatingTanggal" placeholder="Tanggal" name="date_send"
                                        value="{{ old('date_send', date('Y-m-d')) }}">
                                    <label for="floatingTanggal">Date send</label>
                                    @error('date_send')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingitem"
                                        placeholder="Item" name="item" value="{{ $dv->item }}">
                                    <label for="floatingitem">Item</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingNoTelpon"
                                        placeholder="Quantity" name="qty" value="{{ $dv->qty }}">
                                    <label for="floatingNoTelpon">Qty</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingEmail"
                                        placeholder="PricePerUnit" name="priceperunit" value="{{ $dv->priceperunit }}">
                                    <label for="floatingEmail">Price/Unit</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4" id="floatingNoTelpon"
                                        placeholder="Ref" name="ref" value="{{ $dv->ref }}">
                                    <label for="floatingNoTelpon">Ref</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="desc" name="desc" value="{{ $dv->desc }}">
                                    <label for="floatingNoTelpon">Description</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 " id="floatingNoTelpon"
                                        placeholder="bidang usaha" name="send_to" value="{{ $dv->send_to }}">
                                    <label for="floatingNoTelpon">Send To</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-4 mb-4" id="floatingNoTelpon"
                                        placeholder="PS" name="proposed_supplier" value="{{ $dv->proposed_supplier }}">
                                    <label for="floatingNoTelpon">Proposed Supplier</label>
                                </div>
                            </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-pengajuan-pembelian/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
