<title>Add Purpose Travel</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h4>Add Purpose Travel</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('travel.index') }}">Purpose</a></li>
                    <li class="breadcrumb-item">Form Add Purpose Travel</li>
                  </ol>
                </div>
                <div class="col-sm-6">

                </div>
              </div>
            </div>
          </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Purpose Travel</h5>
                <form class="row g-3" action={{ url('/travel/store/') }}
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="name">
                            <label for="floatingName">Input Purpose Travel</label>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/travel/') }}">back</a>
                    </div>
                </form>
                <!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
