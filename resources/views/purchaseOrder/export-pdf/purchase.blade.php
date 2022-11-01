
<!-- Container-fluid starts-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
        </head>
            <body>
                <table width="100%">
                    <tr>
                        <td><img src="{{ public_path('assets/images/LogoSII.png') }}" alt="" width="50"> </td>
                        <td> <h4 class="media-heading f-w-600">Purchase Order</h4></td>
                        <td align="right" class="text-end">
                            <h3>Invoice #<span class="digits counter">1069</span></h3>
                            <p>Issued: May<span class="digits"> 27, 2015</span><br>Payment Due: June <span class="digits">27, 2015</span></p>
                        </td>
                    </tr>
                </table>

                  <table width="100%">
                    <tr>
                        <td>
                            <h6>Vendor</h6>
                            @if(empty($cpo->vendorable_type))
                            <p>Not Filled Yet</p>
                            @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                            <p>Name           :<span>{{ $cpo->vendorable->nama }}</span><br>
                            Address        :<span>{{ $cpo->vendorable->alamat }}</span><br>
                            Contact        :<span>{{ $cpo->vendorable->no_telp_kantor }}</span><br>
                            Website        :<span>{{ $cpo->vendorable->website }}</span></p>
                            @elseif ($cpo->vendorable_type == 'App\Models\CategoryPP')
                            <p>Name           :<span>{{ $cpo->vendorable->nama }}</span><br>
                                Address        :<span>{{ $cpo->vendorable->alamat }}</span><br>
                                NIK        :<span>{{ $cpo->vendorable->nik }}</span><br>
                                NPWP        :<span>{{ $cpo->vendorable->npwp_pp }}</span></p>
                            @elseif($cpo->vendorable_type == 'App\Models\CategoryEcommerce  ')
                            <p>Name           :<span>{{ $cpo->vendorable->nama }}</span><br>
                                Link        :<span>{{ $cpo->vendorable->link }}</span></p>
                            @endif
                        </td>

                        <td align="right top">
                            <h6 class="media-heading f-w-600">Department </h6>
                            @foreach ($cpp as $p)
                            <p>{{ $p->dps->name }}</p>
                            @endforeach
                        </td>
                        <td align="right top">
                            <h6>Project Description</h6>
                            @foreach ($cpp as $c)
                            <p>{{ $c->desc }}</p>
                            @endforeach
                        </td>
                    </tr>
                  </table>

                      <table class="table table-bordered table-striped" style="margin-bottom: 50px;">
                        <tbody>
                          <tr>
                            <td>
                              <h6 >Item</h6>
                            </td>
                            <td class="Hours">
                              <h6 >Quantity</h6>
                            </td>
                            <td class="Rate">
                              <h6 >Unit</h6>
                            </td>
                            <td class="subtotal">
                              <h6 >Price/Unit</h6>
                            </td>
                            <td class="subtotal">
                                <h6 >Total</h6>
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

                    <table width="90%">
                        <tr>
                            <td><p class="legal"><strong>Terms & Conditions</strong> <br>
                            @if (empty($cpo->term->term_condition))
                            Not Filled in yet
                            @else
                            {!!  nl2br($cpo->term->term_condition) !!}</p>
                            @endif</td>
                            <td align="right">
                            @foreach ($cpp as $c)
                            @if ($c->status == 'PO Approved')
                            <img src="{{ public_path('assets/images/'.$c->image) }}" alt="" style=" width:20px;">
                            <strong>{{ $cpo->atasans->name }}</strong>
                            @else
                            <strong>BOD Name</strong>
                            @endif
                            @endforeach
                            </td>
                        </tr>
                    </table>
               </body>
            </html>
