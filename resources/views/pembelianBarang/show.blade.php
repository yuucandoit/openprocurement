<title>Pembelian barang</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('//update/' . $pb->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingRev" placeholder="Rev" name="rev"
                                value="{{ $pb->rev }}">
                            <label for="floatingRev">Rev</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingLokasi" placeholder="Lokasi" name="lokasi"
                                value="{{ $pb->lokasi }}">
                            <label for="floatingLokasi">Lokasi</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingJangkaWaktu" placeholder="Jangka Waktu"
                                name="jangka_waktu" value="{{ $pb->jangka_waktu }}">
                            <label for="floatingJangkaWaktu">Jangka Waktu</label>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="floatingJamApprove" placeholder="Jam Approve"
                                name="jam_approve" value="{{ $pb->jam_approve }}">
                            <label for="floatingJamApprove">Jam Approve</label>
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingDanaDiperlukan"
                                placeholder="Dana Diperlukan" name="dana_diperlukan" value="{{ $pb->dana_diperlukan }}">
                            <label for="floatingDanaDiperlukan">Dana Diperlukan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingNoRek" placeholder="No Rek"
                                name="no_rek" value="{{ $pb->no_rek }}">
                            <label for="floatingNoRek">No Rek</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingItem" placeholder="Item" name="item"
                                value="{{ $pb->item }}">
                            <label for="floatingItem" value="{{ $pb->item }}">Item</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" id="floatingUnitQuantity" placeholder="Unit Quantity"
                                    name="quantity" value="{{ $pb->quantity }}">
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Box">Box</option>
                                    <option value="Unit">Unit</option>
                                </select>
                                <label for="floatingUnitQuantity">Unit Quantity</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingJumlahQuantity"
                                    placeholder="Jumlah Quantity" name="jumlah_quantity"
                                    value="{{ $pb->jumlah_quantity }}">
                                <label for="floatingJumlahQuantity">Jumlah Quantity</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingHarga" placeholder="Harga"
                                    name="harga_satuan" value="{{ $pb->harga_satuan }}">
                                <label for="floatingHarga">Harga Satuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger"
                            href="{{ url('/pembelian-barang/' . $menu_pb->id) }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
