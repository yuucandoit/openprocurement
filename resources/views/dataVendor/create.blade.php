@extends('layouts.master')

@section('main')
<div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="modal-title" style="color: white">Add Vendor</h2>
                <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action={{ url('/store-vendor') }} id="formAdd" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body container">
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Npwp"
                                name="npwp" required>
                            <label for="floatingKeterangan">NPWP</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Nama Vendor"
                                name="nama" required>
                            <label for="floatingKeterangan">Nama</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Nomor Telpon"
                                name="no_telp" required>
                            <label for="floatingKeterangan">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2" id="floatingName" placeholder="Alamat"
                                name="alamat" required>
                            <label for="floatingKeterangan">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <input required="email" type="email"
                                class="form-control mt-3 @error('email') is invalid @enderror" id="floatingEmail"
                                placeholder="Email" name="email" required>
                            <label for="floatingEmail">Email</label>
                        </div>
                        @error('email')
                            <div class='mt-1'>
                                <span class=" text-danger" asp-validation-for="email">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
