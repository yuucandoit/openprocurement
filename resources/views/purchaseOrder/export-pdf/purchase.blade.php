<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Purchase Order</title>
        </head>
            <body>
                <table width="100%">
                    <tr>
                        <td valign="top" style="padding-right: 2px; width:20px"><img src="{{ public_path('assets/images/LogoSII.png') }}" alt="" width="90"> </td>
                        <td valign="top"> <h5 class="media-heading f-w-600">PT.SOLUSI INTEK INDONESIA</h5>
                            <p>Head Office :  Jl Cikunir Raya No.689 <br> Jakamulya, Bekasi Selatan, Telp. 021-89454790 <br>
                            Mkt Office &nbsp;&nbsp; : Jl Tebet Barat dalam raya No. 31 <br>Tebet Barat, Jakarta Selatan, Telp 021-21383852</p>
                        </td>
                        @php
                        use Carbon\Carbon;
                        $date=Carbon::parse($id->created_at)->format('d/m/Y');
                        if (empty($cpo->approved_at)) {
                        $approvedAt = "Not Record yet";
                        }else {
                        $approvedAt = Carbon::parse($cpo->approved_at)->format('d/m/Y/ h:i:s A');
                        }
                        @endphp
                        <td valign="top" align="right">
                            <h5><span class="digits counter">000{{ $id->id }}/PO/SII/{{ $month }}/{{ $year }}</span></h5>
                            <p>Date: <span class="digits">{{ $date }}</span><br>Quotation:
                            <span class="digits">
                            @if(empty($cpo->quotation))
                            -
                            @else
                            {{ $cpo->quotation }}
                            @endif
                            </span>
                            <br> Address: <span>
                            @if(empty($cpo->address))
                            -
                            @else
                            {{ $cpo->address }}
                            @endif
                            </span>
                            <br>Contact:<span>
                            @if(empty($cpo->no_telp))
                            -
                            @else
                            {{ $cpo->no_telp }}
                            @endif
                            </span>
                            <br>NPWP:<span>
                            @if(empty($cpo->no_npwp))
                            -
                            @else
                            {{ $cpo->no_npwp }}
                            @endif
                            </span></p>
                        </td>
                    </tr>
                </table>

                <h3 class="text-center">Purchase Order</h3>

                  <table width="100%">
                    <tr>
                        <td>
                            <h6>Vendor :</h6>
                            @if(empty($cpo->vendorable_type))
                            <p>Not Filled Yet</p>
                            @elseif($cpo->vendorable_type == 'App\Models\CategoryPT')
                            <p>Name           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span>{{ $cpo->vendorable->nama }}</span><br>
                            Address       &nbsp; : <span>{{ $cpo->vendorable->alamat }}</span><br>
                            Contact       &nbsp; : <span>{{ $cpo->vendorable->no_telp_kantor }}</span><br>
                            Website       &nbsp; : <span>{{ $cpo->vendorable->website }}</span></p>
                            @elseif ($cpo->vendorable_type == 'App\Models\CategoryPP')
                            <p>Name           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->nama }}</span><br>
                                Address        &nbsp;:&nbsp;<span>{{ $cpo->vendorable->alamat }}</span><br>
                                NIK            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->nik }}</span><br>
                                NPWP           &nbsp;&nbsp;&nbsp;:&nbsp;<span>{{ $cpo->vendorable->npwp_pp }}</span></p>
                            @elseif($cpo->vendorable_type == 'App\Models\CategoryEcommerce')
                            <p>Name         &nbsp;:&nbsp;<span>{{ $cpo->vendorable->nama }}</span><br>
                                Link        &nbsp;&nbsp;&nbsp; :&nbsp;<span><a href="{{ $cpo->vendorable->link }}">{{ $cpo->vendorable->link }}</a></span></p>
                            @endif
                        </td>

                        <td valing="top" align="center">
                            <h6 class="media-heading f-w-600">Request By :</h6>
                            @foreach ($cpp as $p)
                            <p>{{ $p->dps->name }}</p>
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
                            @if ($c->ppn == 0)
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

                    <table width="100%">
                        <tr>
                            <td><p class="legal"><strong>Terms & Conditions</strong> <br>
                            @if (empty($cpo->term->term_condition))
                            Not Filled in yet
                            @else
                            {!!  nl2br($cpo->term->term_condition) !!}</p>
                            @endif</td>
                            <td align="right">


                                <div style="text-align: center;">
                                    @foreach ($cpp as $c)
                                        @if (
                                        $c->status == 'Purchase Proses' ||
                                        $c->status == 'PO Approved' ||
                                        $c->status == 'Invoicing Process' ||
                                        $c->status == 'Payment Approved' ||
                                        $c->status == 'Unpaid' ||
                                        $c->status == 'Paid' ||
                                        $c->status == 'Delivery Success')
                                        <p>{{ $approvedAt }}</p>
                                        @if(empty($cpo->signature))

                                        @else
                                        <p><img  style=" width:100px;" src="{{ public_path('assets/images/signature_super_user/' . $cpo->signature) }}" alt=""></p>
                                        @endif
                                </div>
                                @if (empty($atasan->atasans->name))
                                <div style="text-align: center; font-size: 18px;">Unfilled Data <br>
                                    <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                                </div>

                                @else
                                <div style="text-align: center; font-size: 18px;">{{ $atasan->atasans->name }} <br>
                                    <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            {{-- @foreach ($cpp as $c)
                            @if ($c->status == 'PO Approved' ||
                            $c->status == 'Invoicing Process' ||
                            $c->status == 'Payment Approved' ||
                            $c->status == 'Unpaid' ||
                            $c->status == 'Paid' ||
                            $c->status == 'Delivery Success') --}}
                            {{-- <img src="{{ public_path('assets/images/'.$c->image) }}" alt="" style=" width:80px;"> --}}
                            {{-- <strong>{{ $atasan->atasans->name }}</strong>
                            @else
                            <strong>BOD Name</strong>
                            @endif
                            {{-- @endforeach --}}
                            </td>
                        </tr>
                    </table>
               </body>
            </html>
