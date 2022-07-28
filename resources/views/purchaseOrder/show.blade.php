<title>Purchase order</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Pembelian Barang</h5>

                <!-- Floating Labels Form -->
                <form class="row g-3" action={{ url('/purchase-order/update/' . $po->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control mt-3" id="floatingName" placeholder="Your Name"
                                name="name" value={{ $data->name }} disabled>
                            <label for="floatingName">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingAddress" placeholder="Address"
                                name="address" value={{ $data->address }} disabled>
                            <label for="floatingAddress">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingKeterangan" placeholder="Keterangan"
                                name="keterangan" value="{{ $po->keterangan }}">
                            <label for="floatingKeterangan">Keterangan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingQty" placeholder="Qty" name="qty"
                                value="{{ $po->qty }}">
                            <label for="floatingQty">Qty</label>
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
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingUnitPrice" placeholder="UnitPrice"
                                name="unit_price" value="{{ $po->unit_price }}">
                            <label for="floatingUnitPrice">Unit Price</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/purchase-order/' . $data->id) }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
