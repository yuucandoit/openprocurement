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
                                <form action="{{ route('activity.search') }}" method="get"
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
                                        <th style="color: white">Properties</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                    $i = 1 + $data->currentPage() * $data->perPage() - $data->perPage();
                                @endphp
                                <tbody>
                                    @foreach ($data as $a)
                                    @php
                                        $properties = json_decode($a->properties, true);
                                    @endphp
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $a->log_name }}</td>
                                            <td>{{ $a->description }}</td>
                                            <td>{{ $a->causer->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($a->created_at)->format('d-M-Y') }}</td>
                                            <td>
                                                @if(is_array($properties))
                                                    @foreach($properties as $key => $value)
                                                        <strong>{{ ucfirst($key) }}:</strong>
                                                        @if (is_array($value))
                                                            <ul>
                                                                @foreach ($value as $subkey => $subvalue)
                                                                    <li>
                                                                        @if (is_array($subvalue))
                                                                            <!-- Handle nested arrays if needed -->
                                                                            <strong>{{ ucfirst($subkey) }}:</strong>
                                                                            <ul>
                                                                                @foreach ($subvalue as $nestedKey => $nestedValue)
                                                                                    <li>{{ ucfirst($nestedKey) }}: {{ $nestedValue }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            {{ ucfirst($subkey) }}: {{ $subvalue }}
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @elseif (is_null($value))
                                                            <em>Null</em> <!-- If the value is null, display Null -->
                                                        @else
                                                            {{ $value }} <!-- If the value is a string or numeric, display directly -->
                                                        @endif
                                                        <br>
                                                    @endforeach
                                                @else
                                                    {{ $properties }} <!-- Directly output the properties if it's not an array -->
                                                @endif
                                            </td>
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
