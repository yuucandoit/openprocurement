<title>Record Data</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                 <h1>Record Purchase Order</h1>
                 <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('menu-purchase-order.index') }}">Purchase Order</a></li>
                  <li class="breadcrumb-item">Record Purchase Order</li>
                </ol>
              </div>
              <div class="col-sm-6">
                <!-- Bookmark Start-->
                <div class="bookmark">
                  <ul>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                    <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                      <form class="form-inline search-form">
                        <div class="form-group form-control-search">
                          <input type="text" placeholder="Search..">
                        </div>
                      </form>
                    </li>
                  </ul>
                </div>
                <!-- Bookmark Ends-->
              </div>
            </div>
          </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Record Data</h5>
                <table class="table table-bordered mt-4" style="">
                    <tbody>
                        <tr>
                            <td>Who Submitted</td>
                            <td>{{ $dv->whosubmit->name }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>{{ $dv->date_ps }}</td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>{{ $dv->dps->name }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $dv->desc }}</td>
                        </tr>
                        <tr>
                            <td>Purpose</td>
                            <td>{{ $dv->referensi->name }}</td>
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
                                @if ($dv->ppn == 1)
                                @foreach ($ppn as $p)
                                {{-- Ketika mata uang yang dipilih RP --}}
                                @if ($dv->matauang == 'RP')
                                RP. {{ number_format($p->total) }}
                                {{-- Ketika mata uang yang dipilih USD --}}
                                @elseif ($dv->matauang == 'USD')
                                $ {{ number_format($p->total) }}
                                @endif
                                @endforeach
                                @else
                                @foreach ($ppn as $p)
                                {{-- Ketika mata uang yang dipilih RP --}}
                                @if ($dv->matauang == 'RP')
                                RP. 0
                                {{-- Ketika mata uang yang dipilih USD --}}
                                @elseif ($dv->matauang == 'USD')
                                $ 0
                                @endif
                                @endforeach
                                @endif
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
                            <td class="text-end">Grand Total :</td>
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
                <form class="row g-2" action={{ url('/menu-purchase-order/store/' . $dv->id) }} method="POST"
                    enctype="multipart/form-data">
                    @csrf
                     {{-- css hide --}}
                     <style>
                        .tutup {
                            width: 0;
                            height: 0;
                            opacity: 0;
                        }
                        .hide {
                            width: 0;
                            height: 0;
                            opacity: 0;
                        }
                        .page {
                            height: 58px;
                        }
                    </style>
                    <div class="col-12">
                        <div class="form-group">
                            <select class="form-select page mt-2 pageSelect" id="pageSelect" placeholder="Proposed To" name="vendorable_type">
                                <option value="" disabled selected hidden>Select Vendor</option>
                                <option value="company">Company</option>
                                <option value="privateperson">Private Person</option>
                                <option value="ecommerce">Ecommerce</option>
                            </select>
                             {{-- Perusahaan Dropdown --}}
                             <select class=" form-select hide mt-2" id="selectedInput" name="vendorable_id">
                                @foreach ($pt as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            {{-- End Perusahaan Dropdown --}}

                            {{-- Private Person Dropdown --}}
                            <select class=" form-select hide" id="selectedInput2" name="vendorable_id">
                                @foreach ($op as $o)
                                <option value="{{ $o->id }}">{{ $o->nama }}</option>
                                @endforeach
                            </select>
                            {{-- End Private Person Dropdown --}}

                            {{-- Ecommerce Dropdown --}}
                            <select class=" form-select hide" id="selectedInput3" name="vendorable_id">
                                @foreach ($ec as $e)
                                <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                @endforeach
                            </select>
                            {{-- End Ecommerce Dropdown --}}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select mt-2" id="floatingproposedto" placeholder="Proposed To" name="atasan_po" >
                                @foreach ($atasan as $sui)
                                <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingproposedto">-- Approved To --</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="Address" name="address" >
                            <label for="floatingNoTelpon">Alamat</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="No_Telp" name="no_telp" >
                            <label for="floatingNoTelpon">Nomor Telpon</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input required type="text" class="form-control mt-2 " id="floatingNoTelpon"
                                placeholder="NPWP" name="no_npwp" >
                            <label for="floatingNoTelpon">NPWP</label>
                        </div>
                    </div>
                    <div class="col-6">
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

                    <div class="col-6">
                        <div class="form-group">
                            <select class="form-select page mt-2" id="pageSelector" placeholder="Terms and Conditions" name="term_conditions" >
                                <option value="" disabled selected hidden>Terms And Conditions</option>
                                    @foreach ($terms as $t)
                                      <option value="{{ $t->id }}">{{    $t->term_conditon }}</option>
                                    @endforeach
                                <option value="custom">+ Add Terms & Conditions</option>
                            </select>
                        <textarea class="hide form-control mt-2" name="term_condition" id="customInput" cols="30" rows="10" placeholder="Input Terms And Conditions"></textarea>
                    </div>

                    <div class="modal-footer">
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
        <script type="text/javascript">
            var pageSelect = document.getElementById('pageSelect');
            var selectedInput = document.getElementById('selectedInput');
            var selectedInputCustom = document.getElementById('selectedInputCustom');

            var selectedInput2 = document.getElementById('selectedInput2');
            var selectedInputCustom2 = document.getElementById('selectedInputCustom2');

            var selectedInput3 = document.getElementById('selectedInput3');
            var selectedInputCustom3 = document.getElementById('selectedInputCustom3');

            // Company
            pageSelect.addEventListener('change', function(){
                if(this.value == "company") {
                    selectedInput.classList.remove('hide');
                } else {
                    selectedInput.classList.add('hide');
                }
            })

            // Private Person
            pageSelect.addEventListener('change', function(){
                if(this.value == "privateperson") {
                    selectedInput2.classList.remove('hide');
                } else {
                    selectedInput2.classList.add('hide');
                }
            })

            // Ecommerce
            pageSelect.addEventListener('change', function(){
                if(this.value == "ecommerce") {
                    selectedInput3.classList.remove('hide');
                } else {
                    selectedInput3.classList.add('hide');
                }
            })
        </script>
    </section>
@endsection
