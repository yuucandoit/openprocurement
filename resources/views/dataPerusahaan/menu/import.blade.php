<title>Import Excel</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Import Excel</h5>
                <!-- Floating Labels Form -->
                <form class="row" action={{ url('/file-import-perusahaan') }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                        <input class="form-control" name="file" type="file" id="formFileMultiple" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Import</button>
                </form>
            </div>
        </div>

    </section>
@endsection
