<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Pengajuan Pembelian</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td valign="top" style="padding-right: 2px; width:20px"><img
                    src="{{ public_path('assets/images/LogoSII.png') }}" alt="" width="90"> </td>
            <td valign="top">
                <h5 class="media-heading f-w-600">PT.SOLUSI INTEK INDONESIA</h5>

            </td>
            @php
                use Carbon\Carbon;
                $date = Carbon::parse($id->created_at)->format('d/m/Y');
                if (empty($cpp->approved_at)) {
                    $approvedAt = 'Not Record yet';
                } else {
                    $approvedAt = Carbon::parse($cpp->approved_at)->format('d F Y');
                }
            @endphp
        </tr>
    </table>

    <style>
        .tapper >  h6,p,span{
            display: inline;
        }
        .tapper .pagebreak {

        }
    </style>

    <h3 class="text-center">Pengajuan Pembelian</h3>
    <h6 class="text-center"><span class="digits counter">000{{ $id->id }}/PPB/SII/{{ $month }}/{{ $year }}</span>
    </h6>
    <table width="100%" class="mt-4">
        <tr>
            <td>
                <div class="tapper">
                <h6>Project &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                @if (empty($cpp->purpose_type))
                    <p>Not Filled Yet</p>
                @elseif($cpp->purpose_type == 'App\Models\ReferensiNamaProject')
                    <p> <span>{{ $cpp->purpose->name }}</span>
                @elseif ($cpp->purpose_type == 'App\Models\Office')
                    <p> <span>{{ $cpp->purpose->name }}</span>
                @elseif($cpp->purpose_type == 'App\Models\Workshop')
                    <p> <span>{{ $cpp->purpose->name }}</span>
                @elseif($cpp->purpose_type == 'App\Models\Inventory')
                    <p> <span>{{ $cpp->purpose->name }}</span>
                @elseif($cpp->purpose_type == 'App\Models\RND')
                    <p> <span>{{ $cpp->purpose->name }}</span>
                @endif
                </h6>
             </div>

                <div class="tapper ">
                <h6>Description &nbsp;:  <p><span>{{ $cpp->desc }}</span></p></h6>
                </div>

                <div class="tapper">
                <h6 class="media-heading f-w-600">Request By &nbsp;:</h6>
                {{-- @foreach ($cpp as $p) --}}
                    <p><span>{{ $cpp->whosubmit->name }}</span></p>
                {{-- @endforeach --}}
                </div>
            </td>
        </tr>
    </table>
    <table width="100%" class="table table-bordered table-striped mt-5">
        <tbody class="text-center">
            <tr>
                <td>
                    <h6>Item</h6>
                </td>
                <td class="Hours">
                    <h6>Quantity</h6>
                </td>
                <td class="Rate">
                    <h6>Unit</h6>
                </td>
            </tr>
            @foreach ($category_q as $q)
                <tr>
                    <td>
                        <label style="word-break: break-word;">{!! nl2br($q->item) !!}</label>
                    </td>

                    <td>
                        <p class="itemtext digits text-center">{{ $q->qty }}</p>
                    </td>
                    <td>
                        <p class="itemtext digits">{{ $q->kategori }}</p>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td>
                <p hidden><strong>Terms & Conditions</strong> <br>
                    @if (empty($cpo->term->term_condition))
                        Not Filled in yet
                    @else
                        {!! nl2br($cpo->term->term_condition) !!}
                </p>
                @endif
            </td>
            <td style="padding-left:350px;">


                <div style="text-align: center;">
                    {{-- @foreach ($cpp as $c) --}}
                        @if ($cpp->status == 'Awaiting Purchase Request Approval' ||
                            $cpp->status == 'Purchase Request Approved' ||
                            $cpp->status == 'Purchase Proses' ||
                            $cpp->status == 'Waiting For PO Approval' ||
                            $cpp->status == 'Purchase Proses' ||
                            $cpp->status == 'PO Approved' ||
                            $cpp->status == 'Invoicing Process' ||
                            $cpp->status == 'Payment Approved' ||
                            $cpp->status == 'Unpaid' ||
                            $cpp->status == 'Paid' ||
                            $cpp->status == 'Delivery Success')
                            <p>Jakarta, {{ $approvedAt }}</p>
                </div>
                <div style="text-align: center;">
                    @if (empty($cpp->signature))
                    @else
                        <p><img style=" max-height:120px;"
                                src="{{ public_path('assets/images/signature_super_user/' . $cpp->signature) }}"
                                alt=""></p>
                    @endif
                </div>
                @if (empty($cpp->bod->name))
                    <div style="text-align: center; font-size: 18px;">Unfilled Data <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @else
                    <div style="text-align: center; font-size: 18px;">{{ $cpp->bod->name }} <br>
                        <label style="font-size: 19px; font-weight: bold; text-decoration: overline;">Director</label>
                    </div>
                @endif
                @endif
                {{-- @endforeach --}}

            </td>
        </tr>
    </table>
    <footer
    style="
               position: fixed;
               bottom: 0cm;
               left: 0cm;
               right: 0cm;
               height: 2cm;" class="text-center">
    <p>Head Office &nbsp;: Jl Cikunir Raya No.689 Jakamulya, Bekasi Selatan,
        Telp. 021-89454790 <br>
        Marketing Office : Jl Tebet Barat dalam raya No.31 Tebet Barat, Jakarta Selatan,<br>
        Telp. 021-21383852</p>
</footer>
</body>

</html>
