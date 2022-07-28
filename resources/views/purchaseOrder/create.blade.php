<title>Purchase order</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Puchase Order</h5>
                {{-- @php
                    dd($data_po);
                @endphp --}}

                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('/purchase-order/store/' . $data_company_po->id) }}
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="name" value={{ $data_company_po->name }} disabled>
                            <label for="floatingName">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAddress" placeholder="Address"
                                name="address" value={{ $data_company_po->address }} disabled>
                            <label for="floatingAddress">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control" id="floatingKeterangan"
                                placeholder="Keterangan" name="keterangan">
                            <label for="floatingKeterangan">Keterangan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input required type="number" class="form-control" id="floatingQty" placeholder="Qty"
                                name="qty">
                            <label for="floatingQTY">Qty</label>
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
                            <input required type="number" class="form-control" id="floatingUnitPrice"
                                placeholder="Unit Price" name="unit_price">
                            <label for="floatingUnitPrice">Unit Price</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/purchase-order/' . $data_company_po->id) }}">back</a>
                    </div>
                </form>
                <!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
