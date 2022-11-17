<title>Record Payment Request</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Record Payment Request</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('menu-purchase-order.index') }}">Purchase Order</a>
                            </li>
                            <li class="breadcrumb-item">Record Payment Request</li>
                        </ol>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
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

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h5 class="text-white">Record Data</h5>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
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
                                                <td>{{ $dv->purpose->name }}</td>
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
                                    <table class="table table-bordered mt-4 mb-4">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Kategori</th>
                                                <th>Price-per-unit</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item as $p)
                                                <tr>
                                                    <td>{{ $p->item }}</td>
                                                    <td>{{ $p->qty }}</td>
                                                    <td>{{ $p->kategori }}</td>
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        <td style="text-align:right;">RP.
                                                            {{ number_format($p->unit_price) }}</td>
                                                        <td style="text-align:right;">RP. {{ number_format($p->total) }}
                                                        </td>
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        <td style="text-align:right;">$ {{ number_format($p->unit_price) }}
                                                        </td>
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
                                            <td><input class="mt-1 pull-right check-box" type="checkbox"
                                                    value="{{ $data_pengajuan->ppn }}"
                                                    @if ($data_pengajuan->ppn == 1) @checked(true)
                                                        @else @endif
                                                    disabled="true"><label class="pull-right mx-2"> PPN 11% :</label></td>
                                            <td style="text-align:right;">
                                                @if ($data_pengajuan->ppn == 1)
                                                    @foreach ($ppn as $p)
                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                            RP. {{ number_format($p->total) }}
                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            $ {{ number_format($p->total) }}
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($ppn as $p)
                                                        {{-- Ketika mata uang yang dipilih RP --}}
                                                        @if ($data_pengajuan->matauang == 'RP')
                                                            RP. 0
                                                            {{-- Ketika mata uang yang dipilih USD --}}
                                                        @elseif ($data_pengajuan->matauang == 'USD')
                                                            $ 0
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($data_pengajuan->ppn == 1)
                                            <tr>
                                                <td class="text-end">Grand Total :</td>

                                                @foreach ($total as $t)
                                                    {{-- jika mata uang yang di pilih RP Maka Return RP.   --}}
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        <td style="text-align:right;">RP. {{ number_format($t->total) }}
                                                        </td>

                                                        {{-- jika mata uang yang di pilih USD Maka Return $    --}}
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        <td style="text-align:right;">$ {{ number_format($t->total) }}</td>
                                                    @endif
                                                @endforeach
                                            @elseif ($data_pengajuan->ppn == 0)
                                                <td class="text-end bold">Grand Total :</td>
                                                @foreach ($total_tnpa_ppn as $tpn)
                                                    @if ($data_pengajuan->matauang == 'RP')
                                                        <td style="text-align:right;">RP. {{ number_format($tpn->total) }}
                                                        </td>
                                                    @elseif ($data_pengajuan->matauang == 'USD')
                                                        <td style="text-align:right;">$ {{ number_format($tpn->total) }}
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endif
                                    </table>

                                    <!-- Floating Labels Form -->
                                    <form class="row g-2 mt-4" action="{{ url('/payment_request/store/' . $dv->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" style="font-weight: bold;"><i
                                                        class="icofont icofont-stamp"></i> Approved To</label>
                                                <select class="form-select page" id="floatingproposedto"
                                                    placeholder="Proposed To" name="atasan_py" required="">
                                                    <option selected="" disabled="" value="">-- Approved To
                                                        --
                                                    </option>
                                                    
                                                    @foreach ($atasan as $sui)
                                                        <option value="{{ $sui->id }}">{{ $sui->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a type="reset" class="btn btn-dark"
                                                href="{{ url('/payment_request/') }}">Back</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
                            <script type="text/javascript">
                                //Math
                                $(document).ready(function() {
                                    //Convert To Rupiah
                                    var rupiah = document.querySelector(".rupiah");
                                    rupiah.addEventListener('keyup', function(e) {
                                        // tambahkan 'Rp.' pada saat form di ketik
                                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                        rupiah.value = formatRupiah(this.value, "");
                                    });
                                    /* Fungsi formatRupiah */
                                    function formatRupiah(angka, prefix) {
                                        var number_string = angka.replace(/[^,\d]/g, ""),
                                            split = number_string.split(","),
                                            sisa = split[0].length % 3,
                                            rupiah = split[0].substr(0, sisa),
                                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                        if (ribuan) {
                                            separator = sisa ? "." : "";
                                            rupiah += separator + ribuan.join(".");
                                        }
                                        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                        return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                                    }
                                    $(".order-entry").on("keyup", ".form-calc", function() {
                                        var parent = $(this).closest("tr");
                                        var str = parent.find(".form-cost").val();
                                        var res = str.replace(/\D/g, "");
                                        parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                                        var total = 0;
                                        $(".form-line").each(function() {
                                            total += parseInt($(this).val() || 0);
                                        });
                                        $(".total_A").text(total.toLocaleString('en-US'));
                                        var checkbox = document.querySelector(".check-box");
                                        checkbox.addEventListener('change', (event) => {
                                            if (event.currentTarget.checked) {
                                                totalppn = total * 11 / 100;
                                                grandtotal = total + totalppn;
                                                $(".ppn").text(totalppn.toLocaleString('en-US'));
                                                $(".total").text(grandtotal.toLocaleString('en-US'));
                                            } else {
                                                totalppn = total * 0;
                                                $(".ppn").text(totalppn);
                                                $(".total").text(total.toLocaleString('en-US'));
                                            }
                                        });
                                    });
                                });
                                //Add Form
                                $(".addItem").on('click', function() {
                                    addItem();
                                });

                                function addItem() {
                                    var item =
                                        '<tr><td><input type="text" name="item[]" placeholder="Input Item" class="form-control" style="text-align: center;"/></td> <td><input type="number" name="qty[]" placeholder="Input Quantity" class="form-control form-calc form-qty" style="text-align: center;" /></td> <td><select class="form-select" placeholder="Kategori" name="kategori[]" ><option value="Pcs"  >Pcs   </option><option value="Lusin">Lusin </option><option value="Box"  >Box   </option><option value="Unit" >Unit</option></select></td> <td><input type="text" name="unit_price[]" placeholder="Input Price" class="form-control text-end form-calc form-cost rupiah" style="text-align: right;"  required/></td><td><input type="text" name="total[]" class="form-control form-line" style="text-align: right;" required  /></td> <td style="text-align: center;"><button type="button"  class="btn btn-danger remove-input-field"><i class="fa fa-times"></i></button></td> ';
                                    $(".item").append(item)

                                    var rupiah = document.querySelectorAll(".rupiah");
                rupiah.forEach((item) => {
                    item.addEventListener('keyup', function(e) {
                        // tambahkan 'Rp.' pada saat form di ketik
                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                        item.value = formatRupiah(this.value, "");
                    });
                });
                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, ""),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        rupiah += separator + ribuan.join(".");
                    }
                    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                    return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
                }

                $(".order-entry").on("keyup", ".form-calc", function() {
                    var parent = $(this).closest("tr");
                    var str = parent.find(".form-cost").val();
                    var res = str.replace(/\D/g, "");
                    parent.find(".form-line").val((parent.find(".form-qty").val() * res).toFixed(0));
                    var total = 0;
                    $(".form-line").each(function() {
                        total += parseInt($(this).val() || 0);
                    });
                    $(".total_A").text(total.toLocaleString('en-US'));
                    var checkbox = document.querySelector(".check-box");
                    checkbox.addEventListener('change', (event) => {
                        if (event.currentTarget.checked) {
                            totalppn = total * 11 / 100;
                            grandtotal = total + totalppn;
                            $(".ppn").text(totalppn.toLocaleString('en-US'));
                            $(".total").text(grandtotal.toLocaleString('en-US'));
                        } else {
                            totalppn = total * 0;
                            $(".ppn").text(totalppn);
                            $(".total").text(total.toLocaleString('en-US'));
                        }
                    });
                });
            }
            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
            });
            var rupiah = document.querySelectorAll(".rupiah");
            rupiah.forEach((item) => {
                item.addEventListener('keyup', function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    item.value = formatRupiah(this.value, "");
                });
            });
            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, ""),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }
                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
            }
                            </script>

                            <script type="text/javascript">
                                var pageSelector = document.getElementById('pageSelector');
                                var customInput = document.getElementById('customInput');

                                pageSelector.addEventListener('change', function() {
                                    if (this.value == "custom") {
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
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "company") {
                                        selectedInput.classList.remove('hide');
                                    } else {
                                        selectedInput.classList.add('hide');
                                    }
                                })

                                // Private Person
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "privateperson") {
                                        selectedInput2.classList.remove('hide');
                                    } else {
                                        selectedInput2.classList.add('hide');
                                    }
                                })

                                // Ecommerce
                                pageSelect.addEventListener('change', function() {
                                    if (this.value == "ecommerce") {
                                        selectedInput3.classList.remove('hide');
                                    } else {
                                        selectedInput3.classList.add('hide');
                                    }
                                })
                            </script>
    </section>
@endsection
