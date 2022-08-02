<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Vendor</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('/data-vendor/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="nama" value={{ $data->nama }} disabled>
                            <label for="floatingName">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="No Telpon"
                                name="no_telp" value={{ $data->no_telp }} disabled>
                            <label for="floatingName">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAddress" placeholder="alamat"
                                name="alamat" value={{ $data->alamat }} disabled>
                            <label for="floatingAddress">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingKeterangan" placeholder="Email"
                                name="email" value="{{ $data->email }}" disabled>
                            <label for="floatingKeterangan">Email</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your NPWP"
                                name="npwp" value={{ $dv->npwp }} >
                            <label for="floatingName">NPWP</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="floatingUnit" placeholder="pkp" name="Pkp" value={{ $dv->Pkp }}>
                                <option value="PKP">PKP</option>
                                <option value="Non-PKP">Non-PKP</option>
                            </select>
                            <label for="floatingUnit">-- PKP / NON-PKP --</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Jenis usaha"
                                name="jenis_usaha" value={{ $dv->jenis_usaha }} >
                            <label for="floatingName">--Jenis Usaha--</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/data-vendor/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
