<title>Edit Department</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Edit Department</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('department.index') }}">Department</a></li>
                            <li class="breadcrumb-item">Form Edit Department</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-primary">
                            <h5 class="text-white">Edit Department</h5>
                        </div>
                        <div class="card-body">
                            <!-- Floating Labels Form -->
                            <form class="row g-2" action={{ url('/department/update/' . $data->id) }} method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control mt-3" id="floatingName"
                                            placeholder="Your Name" name="name" value="{{ $data->name }}">
                                        <label for="floatingName">Input Department Name </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                      <select name="purposes[]"  id="purposes-select" class="js-example-basic-multiple form-control" multiple="multiple">
                                        @foreach ($purposes as $p)
                                            <option value="{{ $p }}" 
                                                    {{ in_array($p, $selectedPurposes) ? 'selected' : '' }}>
                                                {{ $p }}
                                            </option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    <a type="reset" class="btn btn-dark mt-3" href="{{ url('/department/') }}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </section>
@endsection
