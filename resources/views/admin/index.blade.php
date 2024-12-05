<title>Admin</title>
@extends('layouts.master')

@section('main')
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h2 class="modal-title" style="color: white">Add User</h2>
                    <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action={{ url('/store-admin') }} id="formAdd" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body container">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required type="text" class="form-control mt-2" id="floatingName"
                                    placeholder="Name" name="name" required>
                                <label for="floatingKeterangan">Name</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input required asp-for="email" type="email"
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
                        <div class="col-md-12">
                            <div class="form-floating">
                                <div class="input-group mt-4">
                                    <input required type="password" class="form-control pass" id="floatingPassword"
                                    placeholder="Password" name="password">
                                    <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                    <span id="mybutton" onclick="change()" class="input-group-text">

                                        <!-- icon mata bawaan bootstrap  -->
                                        <svg width="1em" height="1.5em" viewBox="0 0 16 16"
                                            class="bi bi-eye-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path fill-rule="evenodd"
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select mt-3" id="floatingRole" placeholder="Select Role" name="role">
                                    <option value="" selected>Select Role</option>
                                    @foreach ($role as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingRole">Role</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select mt-3" id="floatingDepartmnt" placeholder="Select Department" name="department">
                                    @foreach ($department as $d)
                                    <option value="{{ $d->name }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingDepartmnt">Department</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select mt-3" id="floatingLocation" placeholder="Select Location" name="location">
                                    <option value="Tebet">Tebet</option>
                                    <option value="Cikunir">Cikunir</option>
                                </select>
                                <label for="floatingLocation">Location</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">This user can make purchase request with type “SPK Completed”?</label>
                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                <div class="radio radio-primary">
                                  <input id="radioinline1" type="radio" name="is_fast_track" value="1">
                                  <label class="mb-0" for="radioinline1">Yes</label>
                                </div>
                                <div class="radio radio-primary">
                                  <input id="radioinline2" type="radio" name="is_fast_track" value="0">
                                  <label class="mb-0" for="radioinline2">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($admin as $a)
        <div class="modal fade" id="modalEdit{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h2 class="modal-title" style="color: white">Edit User</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action={{ url('admin-update/'.$a->id) }} id="formEdit" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body container">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required type="text" class="form-control mt-2" id="floatingName"
                                        placeholder="Name" name="name" value="{{ $a->name }}" required>
                                    <label for="floatingKeterangan">Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input required asp-for="email" type="email"
                                        class="form-control mt-3 @error('email') is invalid @enderror" id="floatingEmail"
                                        placeholder="Email" name="email" value="{{ $a->email }}" required>
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
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <div class="input-group mt-3">
                                        <input type="password" class="form-control pass" id="floatingPassword"
                                        placeholder="Password" name="password">
                                        <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                        <span id="mybutton" onclick="change()" class="input-group-text">
                                            <!-- icon mata bawaan bootstrap  -->
                                            <svg width="1em" height="1.5em" viewBox="0 0 16 16"
                                                class="bi bi-eye-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- {{ dd($a->getRoleNames()[0]) }} --}}
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select mt-3" id="floatingRole" placeholder="Select Role" name="role">
                                        <option value="">Select Role</option>
                                        @foreach ($role as $r)
                                            @if($r->name == $a->getRoleNames()[0])
                                            <option value="{{ $r->name }}" selected>{{ $r->name }}</option>
                                            @else
                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="floatingRole">Role</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select mt-3" id="floatingDepartmnt" placeholder="Select Department" name="department">
                                        @foreach ($department as $d)
                                            @if($d->name == $a->department)
                                            <option value="{{ $d->name }}" selected>{{ $d->name }}</option>
                                            @else
                                            <option value="{{ $d->name }}">{{ $d->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label for="floatingDepartmnt">Department</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select mt-3" id="floatingLocation" placeholder="Select Location" name="location">
                                        <option value="{{ $a->location }}" selected>{{ $a->location }}</option>
                                        <option value="Tebet">Tebet</option>
                                        <option value="Cikunir">Cikunir</option>
                                    </select>
                                    <label for="floatingLocation">Location</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">This user can make purchase request with type “SPK Completed”?</label>
                                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                    <div class="radio radio-primary">
                                        <input id="radioinline1_{{ $a->id }}" type="radio" name="is_fast_track" value="1" {{ $a->is_fast_track == true ? 'checked' : '' }}>
                                        <label class="mb-0" for="radioinline1_{{ $a->id }}">Yes</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="radioinline2__{{ $a->id }}" type="radio" name="is_fast_track" value="0" {{ $a->is_fast_track == false ? 'checked' : '' }}>
                                        <label class="mb-0" for="radioinline2__{{ $a->id }}">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn_add mt-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" style="color: white">Delete</h2>
                        <button style="color: white" type="button" class="" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body mx-5 mb-3">
                        <span class="warning">
                            <img src="assets/images/warning.png">
                        </span>
                        <h2 style="text-align: center"> are you sure want to delete this admin? </h2>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ url('/admin-destroy/' . $a->id) }}">
                            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i>
                                Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container-fluid">
        <div class="row">
            <div class="card card-absolute">
                <div class="card-header bg-primary">
                    <h5>Add Users</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
                            class="bx bx-list-plus"></i> Add+</button>
                        <div class="pull-right">
                            <form action="{{ route('admin.SearchUser') }}" method="get"
                                class="input-group">
                                <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                    value="{{ old('cari') }}">
                                <span class="input-group-btn "><input type="submit" class="btn btn-primary"
                                        value="Go"></span>
                            </form>
                        </div>
                <div class="table-responsive">
                    <table class="table table-striped" style="width: 100%">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>role</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        @php
                            $serial = 1;
                            $i = 1 + $admin->currentPage() * $admin->perPage() - $admin->perPage();
                        @endphp
                        @foreach ($admin as $dataAdmin)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $dataAdmin->name }}</td>
                                <td>{{ $dataAdmin->email }}</td>
                                <td>{{ $dataAdmin->roles->pluck('name')->implode('') }}</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $dataAdmin->id }}">Edit</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $dataAdmin->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                    <div class="mt-4">
                        {{ $admin->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script>
        // membuat fungsi change
        function change() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password
            var x = document.querySelector('.pass').type;

            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {

                //ubah form input password menjadi text
                document.querySelector('.pass').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                                <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                                </svg>`;
            } else {

                //ubah form input password menjadi text
                document.querySelector('.pass').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1.5em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                </svg>`;
            }
        }
    </script>
@endsection
