<title>Data Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Data Vendor</h5>
                <form class="row g-3" action={{ url('/data-vendor/store/' . $data_vendor->id) }}
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="nama" value={{ $data_vendor->nama }} disabled>
                            <label for="floatingName">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingNoTelpon" placeholder="NoTelpon"
                                name="no_telp" value={{ $data_vendor->no_telp }} disabled>
                            <label for="floatingNoTelpon">No-Telepon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAlamat" placeholder="Alamat"
                                name="alamat" value={{ $data_vendor->alamat }} disabled>
                            <label for="floatingAlamat">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingEmail" placeholder="Email"
                                name="email" value={{ $data_vendor->email }} disabled>
                            <label for="floatingEmail">Email</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control" id="floatingNPWP"
                                placeholder="NPWP" name="npwp" >
                            <label for="floatingNPWP">NPWP</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="floatingPKP" placeholder="PKP" name="Pkp" >
                                <option value="PKP">PKP</option>
                                <option value="Non-PKP">Non-PKP</option>
                            </select>
                            <label for="floatingPKP">-- PKP / NON-PKP --</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control" id="floatingJenisUsaha"
                                placeholder="Jenis Usaha" name="jenis_usaha">
                            <label for="floatingJenisUsaha">Jenis Usaha</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @hasrole('super admin')
                        <a type="reset" class="btn btn-danger" href="{{ url('/data-vendor/' . $data_vendor->id) }}">back</a>
                        @endhasrole
                        @hasrole('purchasing')
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
                        @endhasrole
                    </div>
                </form>
                <!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
