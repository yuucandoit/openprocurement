<title>Edit Vendor</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Vendor</h5>

                <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/menu-ecommerce/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="nama" value="{{ $dv->nama }}" >
                            <label for="floatingName">Nama Ecommerce</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name"
                                name="link" value="{{ $dv->link }}" >
                            <label for="floatingName">Link Penjual</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-private-person/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
