<title>Pengajuan dana</title>
@extends('layouts.master')

@section('main')
    <section>

        <div class="card shadow mb-5">
            <div class="card-body">
                <h5 class="card-title">Add Form</h5>
                <!-- Floating Labels Form -->
                <form class="row g-3" action="{{ url('/pengajuan-dana/update/' . $pd->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="varchar" class="form-control" id="floatingItem" placeholder="Item" name="item"
                                    value="{{ $pd->item }}">
                                <label for="floatingItem">Item</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="int" class="form-control" id="floatingQuantity" placeholder="Quantity"
                                    name="qty" value="{{ $pd->qty }}">
                                <label for="floatingQuantity">Quantity</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="varchar" class="form-control" id="floatingPrice" placeholder="Price"
                                    name="harga" value="{{ $pd->harga }}">
                                <label for="floatingPrice">Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/pengajuan-dana/' . $pd->id) }}">Back</a>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>

    </section>
@endsection
