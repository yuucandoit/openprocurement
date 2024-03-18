<title>Edit Project</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h1>Edit Project</h1>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">>Code Project</li>
                    <li class="breadcrumb-item">Form Edit Project</li>
                  </ol>
                </div>
                <div class="col-sm-6">
                </div>
              </div>
            </div>
          </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Project</h5>
                <form class="row g-3" action={{ route('project-code.update',$list->id) }}
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input value="{{ $list->project_code }}" type="text" class="form-control mt-3" id="floatingName" placeholder="Code Project" name="project_name">
                            <label for="floatingName">Input Code Project</label>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/project-code/') }}">back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
