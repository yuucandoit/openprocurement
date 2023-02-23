<title>Stock Item</title>
@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <h3>List Stock Item's</h3>
                            <div class="table-responsive">
                                <table class="table  table-striped" id="table1">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Discount</th>
                                            <th>DPP</th>
                                            <th>Shipping Fee</th>
                                            <th>Admin Fee</th>
                                            <th>Currency</th>
                                            <th>PPN</th>
                                            <th>Grand Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @php
                                    use Illuminate\Support\Str;
                                        $no = 1 + $pd->currentPage() * $pd->perPage() - $pd->perPage();
                                    @endphp
                                    @foreach ($pd as $dataPengajuan)
                                    @php
                                    $text = Str::limit($dataPengajuan->item,50);
                                    @endphp
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td style="white-space: nowrap;">{{ $text }}</td>
                                            <td>{{ $dataPengajuan->qty }}</td>
                                            <td> {{ number_format(  $dataPengajuan->unit_price,2 )}}</td>
                                            <td> {{ number_format( $dataPengajuan->total,2 )}}</td>
                                            <td>{{ number_format($dataPengajuan->discount,2) }}</td>
                                            <td>{{ number_format($dataPengajuan->dpp ,2) }}</td>
                                            <td>{{ number_format($dataPengajuan->ongkir ,2) }}</td>
                                            <td>{{ number_format($dataPengajuan->admin_fee ,2) }}</td>
                                            <td>{{ $dataPengajuan->matauang }}</td>
                                            <td>{{ $dataPengajuan->ppn }}</td>
                                            <td>{{ number_format($dataPengajuan->grand_total ,2) }}</td>
                                            <td>
                                                <a href="{{ url('/pengajuan-pembelian/destroy/' . $dataPengajuan->id) }}"
                                                    class="btn shadow btn-outline-danger"
                                                    onclick="return confirm ('Are you sure want to delete this item?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                    <div class="mt-4">
                        {{ $pd->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3>Import Stock Item</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id="importform"  action="{{ url('/item-history/importExcel') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile" >
                                                Input File
                                            </label>
                                            <input type="file" id="file" name="file" class="@error('file')is-invalid @enderror form-control">
                                            @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <p class="text-danger">{{ $errors->first('file') }}</p> --}}

                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="text-end" style="margin-right: 30px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                    <div class="card-body">
                                    <div class="alert alert-warning alert-dismissible">
                                        <i class="icon fa fa-warning"></i> Warning! &nbsp;
                                        File Data Item Only Type (.xls, .xlsx)
                                    </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#formAdd').on('submit', function() {
                    $('#btnAdd').prop('disabled', true);
                })
            })
        </script>
    </section>
@endsection
