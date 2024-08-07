<title>Create Vendor</title>

@extends('layouts.master')

@section('main')
    <section>
        <!-- Page Sidebar Ends-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Create Private Person</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/menu-private-person/') }}">Data Private Person</a>
                            </li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Create Vendor</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form class="row g-2" action={{ url('/menu-private-person/store/') }}
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icon-user"></i>  Full Name </label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="nama" >
                                            </div>
                                            @error('nama')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icofont icofont-id-card"></i>
                                                    NIK</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="NIK" name="nik" >
                                            </div>
                                            @error('nik')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icofont icofont-id-card"></i>
                                                    NPWP</label>
                                                <input type="text" class="form-control" id="floatingName"
                                                    placeholder="Your Name" name="npwp_pp">
                                            </div>
                                            @error('npwp_pp')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingUnit"><i class="icofont icofont-paper"></i> -- PKP /
                                                    NON-PKP --</label>
                                                <select class="form-select" id="floatingUnit" placeholder="pkp"
                                                    name="pkp">
                                                    <option value="PKP">PKP</option>
                                                    <option value="Non-PKP">Non-PKP</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingEmail">Email</label>
                                               <input type="text" name="email" class="form-control" id="floatingEmail" placeholder="Email" required>
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="floatingContact">Contact </label>
                                               <input type="text" name="contact" class="form-control" id="floatingContact" placeholder="Contact" required>
                                            </div>
                                            @error('contact')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="floatingName"><i class="icon-location-pin"></i> Address</label>
                                                <textarea class="form-control" name="alamat" id="" rows="4"></textarea>
                                            </div>
                                            @error('alamat')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered item order-entry mx-2" id="bankTable">
                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th  style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">No</th>
                                                        <th  style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Bank</th>
                                                        <th  style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Rekening</th>
                                                        <th  style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Penerima</th>
                                                        <th  style="background-color: rgba(150, 148, 255, 0.9); font-weight: bold; font-size: 17px; border: 2px solid black;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="form-row">
                                                        <td style="text-align:center;">1</td>
                                                        <td>
                                                            <select class="form-select js-example-basic-single" name="bank[]">
                                                                @foreach ($bank as $b)
                                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="no_rekening[]" placeholder="Input rekening" class="form-control" style="text-align: center;" />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="nama_penerima[]" placeholder="Input nama penerima" class="form-control" style="text-align: center;" />
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-danger" onclick="deleteRow(this)">X</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary" type="button" onclick="addRow()">Add Row</button>
                                        </div>

                                        <div style="text-align: right; float: right;">
                                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                            <a type="reset" class="btn btn-dark mt-3" href="{{ url('/menu-private-person/') }}">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
    </section>
@endsection

@section('scripts')
     <script>
        $(document).ready(function() {
            // Initialize Select2 on page load
            initializeSelect2();
        });

        // Define the addRow function in the global scope
        function addRow() {
            // Get the table and tbody element
            var table = document.getElementById("bankTable");
            var tbody = table.getElementsByTagName("tbody")[0];

            // Get the last row and clone it
            var lastRow = tbody.querySelector("tr:last-child");
            var newRow = lastRow.cloneNode(true);

            // Increment the row number
            var cells = newRow.getElementsByTagName("td");
            var noCell = cells[0];
            noCell.innerText = parseInt(noCell.innerText) + 1;

            // Clear the values in the cloned inputs
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('select').selectedIndex = 0;

            // Remove the existing Select2 container for the cloned element
            $(newRow).find('.select2-container').remove();

            // Append the new row to the table
            tbody.appendChild(newRow);

            // Re-initialize Select2 for the new select element
            initializeSelect2();
        }

        // Define the deleteRow function in the global scope
        function deleteRow(button) {
            // Get the row to be deleted
            var row = button.parentNode.parentNode;
            var tbody = row.parentNode;

            // Remove the row
            tbody.removeChild(row);

            // Update row numbers
            var rows = tbody.getElementsByClassName('form-row');
            for (var i = 0; i < rows.length; i++) {
                rows[i].getElementsByTagName('td')[0].innerText = i + 1;
            }
        }

        // Define the initializeSelect2 function in the global scope
        function initializeSelect2() {
            // Initialize Select2 for all select elements with the class .js-example-basic-single
            $('.js-example-basic-single').select2();
        }
    </script>
@endsection
