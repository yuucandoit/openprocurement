<title>Update Data</title>

@extends('layouts.master')

@section('main')
    <section>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Data</h5>
                <table class="table table-bordered mt-4" style="">
                    <tbody>
                        <tr>
                            <td>Date</td>
                            <td>{{ $dv->date_ps }}</td>
                        </tr>
                        <tr>
                            <td>Who Submitted</td>
                            <td>{{ $dv->ws }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $dv->desc }}</td>
                        </tr>
                        <tr>
                            <td>Purpose</td>
                            <td>{{ $dv->referensi->nama }}</td>
                        </tr>
                        <tr>
                            <td>Send To</td>
                            <td>{{ $dv->send_to }}</td>
                        </tr>
                        <tr>
                            <td>Date Line</td>
                            <td>{{ $dv->dateline }}</td>
                        </tr>
                    </tbody>
                </table>
                    <table class="table table-bordered mt-4 mb-4" >
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Kategori</th>
                                <th>Price-per-unit</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $p)
                            <tr>
                                <td>{{ $p->item }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->kategori }}</td>
                            @if ($dv->matauang == 'RP')
                                <td style="text-align:right;">RP. {{ number_format($p->unit_price) }}</td>
                                <td style="text-align:right;">RP. {{ number_format($p->total) }}</td>
                            @elseif ($dv->matauang == 'USD')
                                <td style="text-align:right;">$ {{ number_format($p->unit_price) }}</td>
                                <td style="text-align:right;">$ {{ number_format($p->total) }}</td>
                            @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered ">
                        <tr>
                            <td><label class="pull-right mx-2"> DPP :</label></td>
                            <td style="text-align: right;">
                                @foreach ($dpp as $d)
                                {{-- Ketika mata uang yang dipilih RP --}}
                                    @if ($dv->matauang == 'RP')
                                    RP. {{ number_format($d->total) }}
                                    {{-- Ketika mata uang yang dipilih USD --}}
                                    @elseif ($dv->matauang == 'USD')
                                    $ {{ number_format($d->total) }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><input class="mt-1 pull-right check-box" type="checkbox" value="{{ $dv->ppn }}" @if ($dv->ppn == 1)
                                @checked(true)
                                @else
                            @endif disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                            <td style="text-align:right;">
                                {{-- Ketika gamake ppn  --}}
                                @if ($dv->ppn == 0)
                                    @foreach ($total_tnpa_ppn as $tpn)
                                    {{-- Ketika mata uang yang dipilih RP --}}
                                        @if ($dv->matauang == 'RP')
                                        RP. {{ number_format($tpn->total) }}
                                        {{-- Ketika mata uang yang dipilih USD --}}
                                        @elseif ($dv->matauang == 'USD')
                                        $ {{ number_format($tpn->total) }}
                                        @endif
                                    @endforeach
                                @endif
                                {{-- End Gamake ppn --}}
                                {{-- Ketika make ppn --}}
                                @if ($dv->ppn == 1)
                                    @foreach ($total_tnpa_ppn as $tpn)
                                            @if ($dv->matauang == 'RP')
                                               RP. {{ number_format($tpn->total) }} x 11%
                                                 @elseif ($dv->matauang == 'USD')
                                                $ {{ number_format($tpn->total) }} x 11%
                                            @endif
                                    @endforeach
                                @endif
                                {{-- End make ppn --}}
                            </td>
                        </tr>
                        <tr>
                            <td><label class="pull-right mx-2"> Total PPN :</label></td>
                            <td style="text-align: right;">
                                @foreach ($ppn as $p)
                                {{-- Ketika mata uang yang dipilih RP --}}
                                    @if ($dv->matauang == 'RP')
                                    RP. {{ number_format($p->total) }}
                                    {{-- Ketika mata uang yang dipilih USD --}}
                                    @elseif ($dv->matauang == 'USD')
                                    $ {{ number_format($p->total) }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @if ($dv->ppn == 1)
                        <tr>
                            <td class="text-end">Grand Total :</td>

                            @foreach ($total as $t)
                            {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                            @if ($dv->matauang == 'RP')
                            <td style="text-align:right;" >RP. {{ number_format($t->total) }}</td>

                            {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                            @elseif ($dv->matauang == 'USD')
                            <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                            @endif
                            @endforeach

                            @elseif ($dv->ppn == 0)
                            @foreach ($total_tnpa_ppn as $tpn)
                            @if ($dv->matauang == 'RP')
                            <td style="text-align:right;" >RP. {{ number_format($tpn->total) }}</td>
                        @elseif ($dv->matauang == 'USD')
                            <td style="text-align:right;">$ {{ number_format($tpn->total) }}</td>
                        @endif
                        @endforeach
                        </tr>
                        @endif
                    </table>
                     <!-- Floating Labels Form -->
                <form class="row g-2" action={{ url('/menu-purchase-order/update/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select mt-2" id="floatingproposedto" placeholder="Proposed To" name="atasan_po" >
                                @foreach ($atasan as $sui)
                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingproposedto">-- Approved To --</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="Address" name="address" >
                            <label for="floatingNoTelpon">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="No_Telp" name="no_telp" >
                            <label for="floatingNoTelpon">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="NPWP" name="no_npwp" >
                            <label for="floatingNoTelpon">NPWP</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="Quotation" name="quotation" >
                            <label for="floatingNoTelpon">Quotation</label>
                        </div>
                    </div>

                     {{-- css hide --}}
                     <style>
                        .hide {
                            width: 0;
                            height: 0;
                            opacity: 0;
                        }
                        .page {
                            height: 58px;
                        }
                    </style>

                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-select page mt-4" id="pageSelector" placeholder="Terms and Conditions" name="term_conditions" >
                                <option value="" disabled selected hidden>Terms And Conditions</option>
                                    @foreach ($terms as $t)
                                      <option value="{{ $t->id }}">{{ $t->term_conditon }}</option>
                                    @endforeach
                                <option value="custom">+ Add Terms & Conditions</option>
                            </select>
                        <textarea class="hide form-control mt-2" name="term_condition" id="customInput" cols="30" rows="10" placeholder="Input Terms And Conditions"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a type="reset" class="btn btn-danger" href="{{ url('/menu-purchase-order/') }}">Back</a>
                    </div>
                </form>

            </div>
        </div>

        <script type="text/javascript">
            var pageSelector = document.getElementById('pageSelector');
            var customInput = document.getElementById('customInput');

            pageSelector.addEventListener('change', function(){
                if(this.value == "custom") {
                    customInput.classList.remove('hide');
                } else {
                    customInput.classList.add('hide');
                }
            })
        </script>
    </section>
@endsection
