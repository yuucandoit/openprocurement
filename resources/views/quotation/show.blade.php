<title>Quotation</title>
@extends('layouts.master')

@section('main')
    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Item</h5>
                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('/quotation/update/' . $data->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="company_name" value="{{ $data_company->company_name }}" disabled>
                            <label for="floatingName">Company Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingAddress" placeholder="Address" name="Address" cols="20" rows="30" disabled>{{ $data_company->address }}
                            </textarea>
                            <label for="floatingAddress">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingName" placeholder="Your Name" name="type"
                                value="{{ $data->type }}">
                            <label for="floatingName">Type</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingQty" placeholder="Quantity" name="qty"
                                value="{{ $data->qty }}">
                            <label for="floatingQty">Quantity</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="floatingUnit" placeholder="Unit" name="unit">
                                <option value="Pcs">Pcs</option>
                                <option value="Lusin">Lusin</option>
                                <option value="Box">Box</option>
                                <option value="Unit">Unit</option>
                            </select>
                            <label for="floatingUnit">Unit</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingUnitPrice" placeholder="Unit Price"
                                name="unitprice" value="{{ $data->unitprice }}">
                            <label for="floatingUnitPrice">Unit Price</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger"
                            href="{{ url('/quotation/' . $data_company->id) }}">Back</a>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
