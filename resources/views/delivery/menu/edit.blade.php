<title>Update Data</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Data</h5>
                     <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/delivery/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
        <div class="row">
            @foreach ($delivery as $d)
            <div class="col-md-12">
                <div class="form-floating">
                  <input required type="text" class="form-control mt-2 " id="floatingReceiver"
                  placeholder="Receiver" name="receiver" value="{{ $d->receiver }}">
                  <label for="floatingReceiver">Receiver</label>
                </div>
            </div>
            @endforeach
          <div class="col-md-12 mt-4">
              <div class="form-group">
                  <input type="file" name="path_image" placeholder="Choose image" id="path_image" onchange="loadFile(event)" >
                    @error('path_image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
              </div>
          </div>
          <img id="output" style="width: 200px;"/>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('delivery.index') }}" class="btn btn-danger-gradien mt-3">Back</a>
                    <button type="submit" class="btn btn-primary-gradien btn_add mt-3">Submit</button>
                  </div>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            var loadFile = function(event) {
                var output = document.getElementById('output');

                if (output === null){
                    output.src = "Image Not Found";
                }else {
                    output.src = URL.createObjectURL(event.target.files[0]);
                }
            };
        </script>
    </section>
@endsection
