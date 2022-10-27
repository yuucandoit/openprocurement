<!-- Plugins css Ends-->
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ public_path('assets/css/bootstrap.css') }}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{ public_path('assets/css/style.css') }}">
<link id="color" rel="stylesheet" href="{{ public_path('assets/css/color-1.css') }}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{ public_path('assets/css/responsive.css') }}">

<!-- Container-fluid starts-->
    <div class="">
        <div class="row">
            <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <div>
                  <div>
                    <div class="row invo-header">
                      <div class="col-sm-6">
                        <div class="media">
                          <div class="media-left col-sm-4"><img class="media-object img-60" src="{{ public_path('assets/images/Logo-Intek-8K.png') }}" alt=""> <h4 class="media-heading f-w-600">Purchase Order</h4>
                            <p>hello@viho.in<br><span class="digits">289-335-6503</span></p></div>
                        </div>
                        <!-- End Info-->
                      </div>
                      <div class="col-sm-6">
                        <div class="text-md-end text-xs-center">
                          <h3>Invoice #<span class="digits counter">1069</span></h3>
                          <p>Issued: May<span class="digits"> 27, 2015</span><br>Payment Due: June <span class="digits">27, 2015</span></p>
                        </div>
                        <!-- End Title-->
                      </div>
                    </div>
                  </div>
                  <!-- End InvoiceTop-->
                  <div class="row invo-profile">
                    <div class="col-xl-8">
                      <div class="media">
                        {{-- <div class="media-left"><img class="media-object rounded-circle img-60" src="../assets/images/user/1.jpg" alt=""></div> --}}
                        <div class="media-body m-l-20">
                            @foreach ($cpp as $p)
                            <h6 class="media-heading f-w-600">Department: {{ $p->dps->name }}</h6>
                            @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="media">
                            <div class="text-xl-end text-xs-center" id="project">
                                <h6>Vendor</h6>
                                @if($cpo->vendor == 'company')
                                <p>Name           :<span>{{ $cpo->vendorable->nama }}</span><br>
                                Address        :<span>{{ $cpo->vendorable->alamat }}</span><br>
                                Contact        :<span>{{ $cpo->vendorable->no_telp_kantor }}</span><br>
                                Website        :<span>{{ $cpo->vendorable->website }}</span></p>
                                @elseif ($cpo->vendor == 'privateperson')
                                <p>Name           :<span>{{ $cpo->vendorable->nama }}</span><br>
                                    Address        :<span>{{ $cpo->vendorable->alamat }}</span><br>
                                    NIK        :<span>{{ $cpo->vendorable->nik }}</span><br>
                                    NPWP        :<span>{{ $cpo->vendorable->npwp_pp }}</span></p>
                                @elseif($cpo->vendor == 'ecommerce')
                                <p>Name           :<span>{{ $cpo->vendorable->nama }}</span><br>
                                    Link        :<span>{{ $cpo->vendorable->link }}</span></p>

                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                      <div class="text-xl-end" id="project">
                        <h6>Project Description</h6>
                        @foreach ($cpp as $c)
                        <p>{{ $c->desc }}</p>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <!-- End Invoice Mid-->
                  <div>
                    <div class="table-responsive invoice-table" id="table">
                      <table class="table table-bordered table-striped">
                        <tbody>
                          <tr>
                            <td class="item">
                              <h6 class="p-2 mb-0">Item</h6>
                            </td>
                            <td class="Hours">
                              <h6 class="p-2 mb-0">Quantity</h6>
                            </td>
                            <td class="Rate">
                              <h6 class="p-2 mb-0">Unit</h6>
                            </td>
                            <td class="subtotal">
                              <h6 class="p-2 mb-0">Price/Unit</h6>
                            </td>
                            <td class="subtotal">
                                <h6 class="p-2 mb-0">Total</h6>
                              </td>
                          </tr>
                          @foreach ($category_q as $q)
                          <tr>
                            <td>
                              <label>{{ $q->item }}</label>
                            </td>
                            <td>
                              <p class="itemtext digits text-center">{{ $q->qty }}</p>
                            </td>
                            <td>
                              <p class="itemtext digits">{{ $q->kategori }}</p>
                            </td>
                            <td>
                                <p class="itemtext digits">Rp.{{ number_format($q->unit_price) }}</p>
                              </td>
                            <td>
                              <p class="itemtext digits">Rp.{{ number_format($q->total) }}</p>
                            </td>
                          </tr>
                        @endforeach
                          {{-- <tr>
                            <td>
                              <label>Lorem Ipsum</label>
                              <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </td>
                            <td>
                              <p class="itemtext digits">3</p>
                            </td>
                            <td>
                              <p class="itemtext digits">$75</p>
                            </td>
                            <td>
                              <p class="itemtext digits">$225.00</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Lorem Ipsum</label>
                              <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </td>
                            <td>
                              <p class="itemtext digits">10</p>
                            </td>
                            <td>
                              <p class="itemtext digits">$75</p>
                            </td>
                            <td>
                              <p class="itemtext digits">$750.00</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label>Lorem Ipsum</label>
                              <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </td>
                            <td>
                              <p class="itemtext digits">10</p>
                            </td>
                            <td>
                              <p class="itemtext digits">$75</p>
                            </td>
                            <td>
                              <p class="itemtext digits">$750.00</p>
                            </td>
                          </tr>--}}
                          <tr>
                            <td>
                                <p class="itemtext"></p>
                              </td>
                            <td>
                              <p class="itemtext"></p>
                            </td>
                            <td>
                                <p class="itemtext"></p>
                              </td>
                            <td>
                              <p class="m-0">DPP </p>
                            </td>
                            @foreach ($dpp as $dp)
                            <td>
                              <p class="m-0 digits">Rp.{{ number_format($dp->total) }}</p>
                            </td>
                            @endforeach
                          </tr>
                          <tr>
                            <td>
                                <p class="itemtext"></p>
                              </td>
                            <td>
                              <p class="itemtext"></p>
                            </td>
                            <td>
                                <p class="itemtext"></p>
                              </td>
                            <td>
                              <p class="m-0">PPN 11% </p>
                            </td>
                            @foreach ($cpp as $c)
                            @if ($c->ppn == null)
                            <td>
                                <p class="m-0 digits">Rp.0</p>
                            </td>
                            @else
                            @foreach ($ppn as $pn)
                            <td>
                                <p class="m-0 digits">Rp.{{ number_format($pn->total) }}</p>
                            </td>
                            @endforeach
                            @endif
                            @endforeach
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="Rate">
                              <h6 class="mb-0">Total </h6>
                            </td>
                        @foreach ($cpp as $c)
                        @if ($c->ppn == 0)
                            @foreach ($total_tnp_ppn as $tpn)
                               @if ($c->matauang == "RP")
                               <td style="payment digits"><h6 class="mb-0 "> Rp.{{number_format($tpn->total)}}</h6></td>
                               @elseif ($c->matauang == "USD")
                               <td style="payment digits"><h6 class="mb-0 "> $ {{number_format($tpn->total)}}</h6></td>
                               @endif
                            @endforeach
                        @elseif($c->ppn == 1)
                           @foreach ($total as $t)
                               @if ($c->matauang == "RP")
                                   <td style="payment digits"><h6 class="mb-0 "> Rp. {{ number_format($t->total)}}</h6></td>
                                   @elseif ($c->matauang == "USD")
                                   <td style="payment digits"><h6 class="mb-0 "> $.{{number_format($t->total)}}</h6></td>
                               @endif
                           @endforeach
                        @endif
                        @endforeach
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- End Table-->
                    <div class="container">
                    <div class="row mt-3">
                      <div class="col">
                        <div>
                          <p class="legal"><strong>Terms & Conditions</strong> <br>
                            @if (empty($cpo->term->term_condition))
                            Not Filled in yet
                            @else
                            {!!  nl2br($cpo->term->term_condition) !!}</p>
                            @endif
                        </div>
                      </div>
                      <div class="col">
                        <div class="text-end">
                            @foreach ($cpp as $c)
                            @if ($c->status == 'PO Approved')
                            <img src="{{ public_path('assets/images/'.$c->image) }}" alt="" style=" width:90px; height:80px"  class="text-end">
                            <strong style=" padding-right:12px;">{{ $cpo->atasans->name }}</strong>
                            @else
                            <strong style=" padding-right:12px;">BOD Name</strong>
                            @endif
                            @endforeach
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- End InvoiceBot-->
                </div>
                <!-- End Invoice-->
                <!-- End Invoice Holder-->
              </div>
             </div>
            </div>
          </div>
        </div>
