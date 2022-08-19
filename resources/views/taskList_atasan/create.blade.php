<title>Pengajuan dana</title>
@extends('layouts.master')

@section('main')
    <section>

        <div class="card shadow mb-5">
            <div class="card-body">
                <h5 class="card-title">Form Pengajuan Dana</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('/pengajuan-dana/store/' . $data_pd->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control" id="floatingSubject" placeholder="Subject"
                                name="subject" value={{ $data_pd->subject }} disabled>
                            <label for="floatingSubject">Subject</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="date" class="form-control @error('created_at') is-invalid @enderror"
                                id="floatingTanggal" placeholder="Tanggal" name="created_at"
                                value="{{ old('created_at', date('Y-m-d')) }}">
                            <label for="floatingTanggal">Date</label>
                            @error('created_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control" id="floatingName" placeholder="Nama  Pemohon"
                                name="nama_pemohon" value={{ $data_pd->name }} disabled>
                            <label for="flaotingName">Name</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input required type="varchar" class="form-control" id="floatingTujuan" placeholder="Tujuan"
                                name="tujuan">
                            <label for="floatingTujuan">Purpose</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="varchar" class="form-control" id="floatingLokasi"
                                    placeholder="Lokasi" name="lokasi">
                                <label for="floatingLokasi">Location</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="date" class="form-control" id="floatingJangkaWaktu"
                                    placeholder="Jangka Waktu" name="jangka_waktu">
                                <label for="floatingJangkaWaktu">Period of Time</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="int" class="form-control" id="floatingNominal" placeholder="Nominal"
                                    name="nominal">
                                <label for="floatingNominal">Nominal</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="int" class="form-control" id="floatingNoRek"
                                    placeholder="No Rekening" name="no_rek">
                                <label for="floatingNoRek">No Rekening</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="varchar" class="form-control" id="floatingItem" placeholder="Item"
                                    name="item">
                                <label for="floatingItem">Item</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="int" class="form-control" id="floatingQuantity"
                                    placeholder="Quantity" name="qty">
                                <label for="floatingQuantity">Quantity</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="varchar" class="form-control" id="floatingPrice" placeholder="Price"
                                    name="harga">
                                <label for="floatingPrice">Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/pengajuan-dana/') }}">back</a>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
