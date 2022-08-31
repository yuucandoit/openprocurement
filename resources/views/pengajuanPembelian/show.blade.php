<title>Pengajuan dana</title>
@extends('layouts.master')

@section('main')
    <section>

        <div class="card shadow mb-5">
            <div class="card-body">
                <h5 class="card-title">Add Form</h5>
                <!-- Floating Labels Form -->
                <form class="row g-3" action="{{ url('/pengajuan-pembelian/update/' . $pp->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="varchar" class="form-control" id="floatingItem" placeholder="Item" name="item"
                                    value="{{ $pp->item }}">
                                <label for="floatingItem">Item</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="int" class="form-control" id="floatingQuantity" placeholder="Quantity"
                                    name="qty" value="{{ $pp->qty }}">
                                <label for="floatingQuantity">Quantity</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="varchar" class="form-control" id="floatingPrice" placeholder="Price"
                                    name="unit_price" value="{{ $pp->unit_price }}">
                                <label for="floatingPrice">Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select" id="floatingdateline" placeholder="Mata Uang" name="matauang" value="{{ $pp->matauang }}" >
                                <option value="USD">USD</option>
                                <option value="RP">RP</option>
                            </select>
                            <label for="floatingdateline">-- Mata Uang --</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/pengajuan-pembelian/' . $pp->id) }}">Back</a>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
