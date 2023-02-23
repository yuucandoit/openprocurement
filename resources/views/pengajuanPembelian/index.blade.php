<title>Pengajuan Pembelian</title>
@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>List Item Purchase Request's</h4>
                                <a href="/export_excel/pengajuan_pembelian" class="btn btn-success text-center mb-3" style="align-self: flex-end">Export Excel</a>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                    <form action="{{ route('SearchItemPPB') }}" method="get" class="input-group">
                                        <input type="text" name="carippb" class="form-control " placeholder="Search ..." value="{{ request('carippb') }}">
                                        <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table  table-striped" id="table1">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>PPN</th>
                                    <th>Currency</th>
                                    <th>Total</th>
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
                                    <td> {{ number_format(  $dataPengajuan->unit_price )}}</td>
                                    <td>
                                        @if(empty($dataPengajuan->ppb->ppn))
                                        0
                                        @else
                                        {{ $dataPengajuan->ppb->ppn }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(empty($dataPengajuan->ppb->matauang))
                                        -
                                        @else
                                        {{ $dataPengajuan->ppb->matauang }}
                                        @endif
                                    </td>
                                    <td> {{ number_format( $dataPengajuan->total )}}</td>
                                    <td>
                                        {{-- <a href="{{ url('/pengajuan-pembelian/edit/' . $data_pengajuan->id . '/' . $dataPengajuan->id) }}"
                                            class="btn shadow btn-outline-info">Edit</a> --}}
                                        <a href="{{ url('/pengajuan-pembelian/destroy/' . $dataPengajuan->id) }}"
                                            class="btn shadow btn-outline-danger"
                                            onclick="return confirm ('Are you sure want to delete this item?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $pd->appends(['old'=> request('old')],'old')->withQueryString()->links('pagination::bootstrap-5') }}
                        {{-- {{ $pd->withQueryString()->links('pagination::bootstrap-5') }} --}}
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>List Item Purchase Order's</h4>
                                <a href="/export_excel/purchase_order" class="btn btn-success text-center mb-3" style="align-self: flex-end">Export Excel</a>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div style="margin-top:20px; margin-bottom:-30px; margin-right: 30px;">
                                    <form action="{{ route('SearchItemPO') }}" method="get" class="input-group">
                                        <input type="text" name="caripo" class="form-control " placeholder="Search ..." value="{{ request('caripo') }}">
                                        <span class="input-group-btn "><input type="submit" class="btn btn-primary" value="Go"></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table  table-striped" id="table1">
                            <thead class="bg-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>PPN</th>
                                    <th>Currency</th>
                                    <th>Discount</th>
                                    <th>DPP</th>
                                    <th>Ongkir</th>
                                    <th>Admin Fee</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1 + $new->currentPage() * $new->perPage() - $new->perPage();
                            @endphp
                            @foreach ($new as $item)
                            @php
                            $text = Str::limit($item->item,50);
                            @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td style="white-space: nowrap;">{{ $text }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td> {{ number_format(  $item->unit_price ,2 )}}</td>
                                    <td>
                                        @if(empty($item->ppn))
                                        0
                                        @else
                                        {{ $item->ppn }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(empty($item->matauang))
                                        -
                                        @else
                                        {{ $item->matauang }}
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->discount,2) }}</td>
                                    <td>{{ number_format($item->dpp,2) }}</td>
                                    <td>{{ number_format($item->ongkir,2) }}</td>
                                    <td>{{ number_format($item->admin_fee,2) }}</td>
                                    <td> {{ number_format($item->total,2)}}</td>
                                    <td>
                                        {{-- <a href="{{ url('/pengajuan-pembelian/edit/' . $data_pengajuan->id . '/' . $item->id) }}"
                                            class="btn shadow btn-outline-info">Edit</a> --}}
                                        <a href="{{ url('/pengajuan-pembelian/destroy/' . $item->id) }}"
                                            class="btn shadow btn-outline-danger"
                                            onclick="return confirm ('Are you sure want to delete this item?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $new->appends(['new'=> request('new')],'new')->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
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
