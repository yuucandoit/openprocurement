<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Vendor</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('/data-vendor/update/' . $datavendor->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your NPWP"
                                name="npwp" value={{ $datavendor->npwp }} >
                            <label for="floatingName">NPWP</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="nama" value={{ $datavendor->nama }} >
                            <label for="floatingName">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="No Telpon"
                                name="no_telp" value={{ $datavendor->no_telp }} >
                            <label for="floatingName">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAddress" placeholder="alamat"
                                name="alamat" value={{ $datavendor->alamat }} >
                            <label for="floatingAddress">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingKeterangan" placeholder="Email"
                                name="email" value="{{ $datavendor->email }}">
                            <label for="floatingKeterangan">Email</label>
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
