<title>Data Pengajuan</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <a type="reset" class="btn btn-danger mb-2" href="{{ url('/menu-taskList-atasan-po/') }}">Back</a>
            <div class="row">
                <div class="card shadow mb-5">
                    <div class="card-body text-center">
                        <h1>Detail Dari {{ $data_pengajuan->ws }}</h1>
                            <table class="table table-bordered mt-4">
                                <tbody>
                                    <tr>
                                        <td>Proposed Supplier</td>
                                        <td>{{ $data_pengajuan->proposed_supplier }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td>{{ $data_pengajuan->date_ps }}</td>
                                    </tr>
                                    <tr>
                                        <td>Who Submitted</td>
                                        <td>{{ $data_pengajuan->ws }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $data_pengajuan->desc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose</td>
                                        <td>{{ $data_pengajuan->referensi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Send To</td>
                                        <td>{{ $data_pengajuan->send_to }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Line</td>
                                        <td>{{ $data_pengajuan->dateline }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered mt-4 mb-4 order-entry">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Price-per-unit</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuan as $p)
                                    <tr>
                                        <td>{{ $p->item }}</td>
                                        <td >{{ $p->qty }}</td>
                                    @if ($data_pengajuan->matauang == 'RP')
                                        <td style="text-align:right;" >RP. {{ number_format($p->unit_price) }}</td>
                                        <td style="text-align:right;" >RP. {{ number_format($p->total) }}</td>
                                    @elseif ($data_pengajuan->matauang == 'USD')
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
                                            @if ($data_pengajuan->matauang == 'RP')
                                            RP. {{ number_format($d->total) }}
                                            {{-- Ketika mata uang yang dipilih USD --}}
                                            @elseif ($data_pengajuan->matauang == 'USD')
                                            $ {{ number_format($d->total) }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="mt-1 pull-right check-box" type="checkbox" value="{{ $data_pengajuan->ppn }}" @if ($data_pengajuan->ppn == 1)
                                        @checked(true)
                                        @else
                                    @endif disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                    <td style="text-align:right;">
                                        @foreach ($ppn as $p)
                                        {{-- Ketika mata uang yang dipilih RP --}}
                                        @if ($data_pengajuan->matauang == 'RP')
                                        RP. {{ number_format($p->total) }}
                                        {{-- Ketika mata uang yang dipilih USD --}}
                                        @elseif ($data_pengajuan->matauang == 'USD')
                                        $ {{ number_format($p->total) }}
                                        @endif
                                    @endforeach
                                    </td>
                                </tr>
                                @if ($data_pengajuan->ppn == 1)
                                <tr>
                                    <td class="text-end">Grand Total :</td>

                                    @foreach ($total as $t)
                                    {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                    @if ($data_pengajuan->matauang == 'RP')
                                    <td style="text-align:right;" >RP. {{ number_format($t->total) }}</td>

                                    {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                    @elseif ($data_pengajuan->matauang == 'USD')
                                    <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                                    @endif
                                    @endforeach

                                    @elseif ($data_pengajuan->ppn == 0)
                                    @foreach ($total_tnpa_ppn as $tpn)
                                    @if ($data_pengajuan->matauang == 'RP')
                                    <td style="text-align:right;" >RP. {{ number_format($tpn->total) }}</td>
                                @elseif ($data_pengajuan->matauang == 'USD')
                                    <td style="text-align:right;">$ {{ number_format($tpn->total) }}</td>
                                @endif
                                @endforeach
                                </tr>
                                @endif
                            </table>
                            <div class="mt-3">
                                @hasrole('super user|super admin')
                                @if ($data_pengajuan->status == 'Approved by Super user')
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-success text-center" onclick="return"><b>Accepted</b></a>

                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>

                                @elseif($data_pengajuan->status == 'Waiting For PO Approval')
                                        <a href="{{ url('menu-taskList-atasan-po/accept_atasan', $data_pengajuan->id) }}"
                                          class="btn btn-success text-center" onclick="return">Accept</a>

                                        <a href="{{ url('menu-taskList-atasan-po/reject', $data_pengajuan->id) }}"
                                            class="btn btn-danger text-center" onclick="return">Reject</a>
                                @else
                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-successtext-center" onclick="return">Accept</a>

                                        <a style=" cursor: not-allowed; opacity: 0.5; text-decoration: none;"
                                            class="btn btn-danger text-center" onclick="return"><b>Rejected</b></a>

                                @endif
                            @endhasrole
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        @if ($data_pengajuan->status == 'Accepted')
         {{-- <a href=url('#')('/export_excel/pengajuan_pembelian/'.$data_pengajuan->id)
            class="btn btn-success" style="align-self: flex-end"> Export to Excel</a> --}}
    @endif

    </section>
@endsection


<!-- JavaScript Item -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
     $(document).ready(function() {
            $(".order-entry").on("keyup", ".form-calc", function() {
                var parent = $(this).closest("tr");
                parent.find(".form-line").val((parent.find(".form-qty").val() * parent.find(".form-cost").val()) .toFixed(0));
                var total = 0;
                var checkbox =  document.querySelector(".check-box");
                checkbox.addEventListener('change', (event) =>{
                    if(event.currentTarget.checked){
                        totalppn = total * 11 / 100;
                        $(".total").text(totalppn);
                    }
                    else{
                        $(".total").text(total.toFixed(0));
                    }
                })
                $(".form-line").each(function(){
                    total += parseInt($(this).val()||0);
                });

            });
        });
</script>
