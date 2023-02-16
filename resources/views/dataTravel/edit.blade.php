<title>Edit Project Name</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h4>Edit Project</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('travel.index') }}">Purpose</a></li>
                    <li class="breadcrumb-item">Form Edit Travel</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Travel Name</h5>

                <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/travel/update/' . $data->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="name" value="{{ $data->name }}" >
                            <label for="floatingName">Name </label>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/travel/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
