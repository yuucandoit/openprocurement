@extends('layouts.master')
@section('main')
<section>
<!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card card-absolute">
                    <div class="card-header" style=" background-color:red; ">
                        <h5 style="color:white;">Activity All User</h5>
                    </div>
                    <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <form action="" method="get"
                                    class="input-group" style="margin-top: 20px; margin-bottom:-20px;">
                                    <input type="text" name="cari" class="form-control " placeholder="Search ..."
                                        value="{{ old('cari') }}">
                                    <span class="input-group-btn "><input type="submit" class="btn" style=" background-color:red; color:white;"
                                            value="Go"></span>
                                </form>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead style=" background-color:red;">
                                    <tr style="text-align: center; ">
                                        <th style="color: white">No</th>
                                        <th style="color: white">Log Name</th>
                                        <th style="color: white">Event</th>
                                        <th style="color: white">User</th>
                                        <th style="color: white">Time</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                    $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                @endphp
                                <tbody>
                                    @foreach ($data as $a)
                                        <tr style="text-align: center;">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $a->log_name }}</td>
                                            <td>{{ $a->description }}</td>
                                            <td>{{ $a->causer->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($a->created_at)->format('d-M-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
<!-- End Container-fluid starts-->
</section>
@endsection
