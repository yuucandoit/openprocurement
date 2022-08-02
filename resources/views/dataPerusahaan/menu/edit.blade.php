<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Vendor</h5>

                <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/menu-perusahaan/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="nama" value="{{ $dv->nama }}" >
                            <label for="floatingName">Nama PT</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="alamat" value="{{ $dv->alamat }}" >
                            <label for="floatingName">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="No Telpon"
                                name="no_telp_kantor" value="{{ $dv->no_telp_kantor }}" >
                            <label for="floatingName">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAddress" placeholder="alamat"
                                name="website" value="{{ $dv->website }}" >
                            <label for="floatingAddress">Website</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="nama_pic" value="{{ $dv->nama_pic }}" >
                            <label for="floatingName">Nama PIC</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="no_telp_pic" value="{{ $dv->no_telp_pic }}" >
                            <label for="floatingName">Contact PIC</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingKeterangan" placeholder="Email"
                                name="email" value="{{ $dv->email }}">
                            <label for="floatingKeterangan">Email</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="npwp_perusahaan" value="{{ $dv->npwp_perusahaan }}" >
                            <label for="floatingName">NPWP PT</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="floatingUnit" placeholder="pkp" name="Pkp" value="{{ $dv->Pkp }}">
                                <option value="PKP">PKP</option>
                                <option value="Non-PKP">Non-PKP</option>
                            </select>
                            <label for="floatingUnit">-- PKP / NON-PKP --</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="nib" value="{{ $dv->nib }}" >
                            <label for="floatingName">Nib</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="bidang_usaha" value={{ $dv->bidang_usaha   }} >
                            <label for="floatingName">Bidang Usaha</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="no_rekening" value="{{ $dv->no_rekening }}" >
                            <label for="floatingName">No Rekening</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="floatingUnit" placeholder="Bank" name="bank" value="{{ $dv->bank }}">
                                <option value="BCA(014)">BCA(014)</option>
                                <option value="Mandiri(008)">Mandiri(008)</option>
                                <option value="BNI(009)">BNI(009)</option>
                                <option value="BRI(002)">BRI(002)</option>
                                <option value="BTN(200)">BTN(200)</option>
                                <option value="Danamon(011)">Danamon(011)</option>
                                <option value="Permata(013)">Permata(013)</option>
                                <option value="Maybank(016)">Maybank(016)</option>
                            </select>
                            <label for="floatingUnit">-- Bank --</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingKeterangan" placeholder="Email"
                                name="nama_penerima" value="{{ $dv->nama_penerima }}">
                            <label for="floatingKeterangan">Nama Penerima</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-perusahaan/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
