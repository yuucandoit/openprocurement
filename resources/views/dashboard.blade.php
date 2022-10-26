<title>Dashboard</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6 mt-4">
                        <h3>Dashboard</h3>
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
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid general-widget">
            <div class="row">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3"
                            style="border-left: 10px solid rgba(150, 148, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: rgba(150, 148, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    <h6
                                        style="color: rgba(150, 148, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        SUBMISSION</h6>
                                    <h2 class="mb-0 counter" style="color: rgba(150, 148, 255, 0.9);">
                                        {{ \App\Models\CategoryPengajuanPembelian::count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-4"
                            style="border-left: 10px solid rgba(87, 212, 255, 0.9);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="check-circle"
                                        style="color: rgba(87, 212, 255, 0.9);"></i>
                                </div>
                                <div class="media-body">
                                    @if (\App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (\App\Models\CategoryPengajuanPembelian::where('status', 'Purchase Submission Approved'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @elseif (\App\Models\CategoryPengajuanPembelian::where('status', 'Waiting For PO Approval'))
                                        <h6
                                            style="color: rgba(87, 212, 255, 0.9); font-family: 'Times New Roman', Times, serif;">
                                            TASK LIST <br> </h6>
                                        <h2 class="mb-0 counter" style="color: rgba(87, 212, 255, 0.9);">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Awaiting Purchase Submission Approval')->count() }}
                                        </h2>
                                        <i class="icon-bg" data-feather="check-circle"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid red;">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="file-text"
                                        style="color: red;"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: red; font-family: 'Times New Roman', Times, serif;">
                                        PURCHASE <br>
                                        ORDER</h6>
                                    <h2 class="mb-0 counter" style="color: red;">
                                        {{ \App\Models\CategoryPO::count() }}</h2>
                                    <i class="icon-bg" data-feather="file-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="b-r-4 card-body shadow h-100 py-3" style="border-left: 10px solid rgb(251, 140, 1);">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center mb-3"><i data-feather="dollar-sign"
                                        style="color: rgb(251, 140, 1);"></i>
                                </div>
                                <div class="media-body">
                                    <h6 style="color: rgb(251, 140, 1); font-family: 'Times New Roman', Times, serif;">
                                        FUND <br>
                                        SUBMISSION</h6>
                                    <h2 class="mb-0 counter" style="color: rgb(251, 140, 1);">
                                        {{ \App\Models\CategoryPD::count() }}</h2>
                                    <i class="icon-bg" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card card-absolute">
                                <div class="card-header bg-dark">
                                    <h5 class="text-white" style="font-weight: bold; ">Monthly
                                        Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="Po"></canvas>
                                </div>
                            </div>
                        </div>

                        <!--  {{-- <div class="col-xl-2 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
                        <div class="card income-card card-secondary">
                          <div class="card-body text-center">
                            <div class="round-box">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                            <h6 class="text-muted font-semibold">Pembelian Barang</h6>
                            <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPB::count() }}
                            </h6>
                            <div class="parrten">

                            </div>
                        </div>
                    </div>
                </div> --}}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            {{-- <div class="col-xl-4 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-secondary">
                      <div class="card-body text-center">
                        <div class="round-box">
                            <img class="img-90 rounded-circle" src="../assets/images/dashboard/1.png" alt="">
                        </div>
                        <h3 class="font-light">Welcome Back, {{ auth()->user()->name }}!!</h3>
                        <p>Welcome to the Solusi Intek Indonesia Family! we are glad that you are visite this dashboard. we will be happy to help you grow your business.</p>
                        <div class="parrten">

                        </div>
                    </div>
                </div>
            </div> --}}



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        {{-- <div class="page-content mt-4">
                <section class="row">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-xl-3 col-md-5 col-sm-6">
                                <div class="card shadow">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Purchase Order</h6>
                                                <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPO::count() }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="card shadow">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pengajuan Dana</h6>
                                                <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPD::count() }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="card shadow">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon-green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Quotation</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    {{ \App\Models\CategoryQuotation::count() }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-6">
                                <div class="card shadow">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon-red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pembelian</h6>
                                                <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPB::count() }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="col-full ">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Grafik Bulanan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="Po"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}} -->

                    </div>
                </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        const dataPo = {
            labels: labels,
            datasets: [{
                    label: 'Purchase Submission',
                    backgroundColor: 'rgba(150, 148, 255, 0.9)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_ps as $ps)
                            {{ $ps }},
                        @endforeach
                    ],
                },
                {
                    label: 'Task List',
                    backgroundColor: 'rgba(87, 212, 255, 0.9)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_po as $po)
                            {{ $po }},
                        @endforeach
                    ],
                },


                {
                    label: 'Purchase Order',
                    backgroundColor: 'rgb(255, 0, 0)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_po as $po)
                            {{ $po }},
                        @endforeach
                    ],
                },


                {
                    label: 'Fund Submission',
                    backgroundColor: 'rgb(255, 255, 0)',
                    borderColor: 'rgb(93, 218, 180)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_pd as $pd)
                            {{ $pd }},
                        @endforeach
                    ],
                },
            ]
        };
    </script>

    <script>
        const po = {
            type: 'bar',
            data: dataPo,
            options: {
                // fill: true,
                tension: 0.4,
                responsive: true,
                animations: {
                    radius: {
                        duration: 400,
                        easing: 'linear',
                        loop: (context) => context.active
                    }
                },
                hoverRadius: 5,
                hoverBackgroundColor: 'rgb(67, 94, 190)',
                interaction: {
                    mode: 'nearest',
                    intersect: false,
                    axis: 'x'
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month',
                            color: 'rgb(255, 121, 118)',
                            font: {
                                family: 'Nunito',
                                size: 15,
                                weight: 'bold',
                                lineHeight: 1.2,
                            },
                            padding: {
                                top: 20,
                                left: 0,
                                right: 0,
                                bottom: 0
                            }
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Value',
                            color: 'rgb(255, 121, 118)',
                            font: {
                                family: 'Nunito',
                                size: 15,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {
                                top: 30,
                                left: 0,
                                right: 0,
                                bottom: 0
                            }
                        }
                    }
                }
            },
        };
    </script>

    <script>
        const datawarga = {
            labels: ['Januari', 'Februari', 'Maret', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November',
                'Desember'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [
                    11, 12, 15, 43, 53, 32, 10, 45, 12
                ],
                fill: true,
                borderColor: 'rgb(86, 182, 247)',
                tension: 0.3
            }]
        };

        const warga = {
            type: 'line',
            data: datawarga,
            options: {
                responsive: true,
            }
        };
    </script>

    <script>
        const chartPo = new Chart(
            document.getElementById('Po'),
            po
        );
    </script>
    <script>
        const chartWarga = new Chart(
            document.getElementById('warga'),
            warga
        );
    </script>
@endsection
