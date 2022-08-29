<title>Dashboard</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid dashboard-default-sec">
            <div class="row">
                <div class="col-xl-2 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-secondary">
                      <div class="card-body text-center">
                        <a href="{{ route('menu-pengajuan-pembelian.index') }}">
                        <div class="round-box">
                            <i class="iconly-boldAdd-User"></i>
                        </div>
                        </a>
                        <h6 class="text-muted font-semibold">Pengajuan Pembelian</h6>
                        {{-- <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPengajuanPembelian::count() }} --}}
                        </h6>
                        <div class="parrten">

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-2 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-secondary">
                      <div class="card-body text-center">
                        <a href="{{ route('menu-task-list.index') }}">
                            <div class="round-box">
                                <i class="iconly-boldAdd-User"></i>
                            </div>
                            </a>
                        <h6 class="text-muted font-semibold">Task List</h6>
                        {{-- <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryTL::count() }} --}}
                        </h6>
                        <div class="parrten">

                        </div>
                      </div>
                    </div>
                  </div>

                <div class="col-xl-2 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-secondary">
                      <div class="card-body text-center">
                        <a href="{{ route('menu-purchase-order.index') }}">
                        <div class="round-box">
                            <i class="iconly-boldShow"></i>
                        </div>
                        </a>
                        <h6 class="text-muted font-semibold">Purchase Order</h6>
                        {{-- <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPO::count() }} --}}
                        </h6>
                        <div class="parrten">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-2 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
                    <div class="card income-card card-secondary">
                      <div class="card-body text-center">
                        <a href="{{ route('menu-pengajuan-dana.index') }}">
                        <div class="round-box">
                            <i class="iconly-boldProfile"></i>
                        </div>
                        </a>
                        <h6 class="text-muted font-semibold">Pengajuan Dana</h6>
                        {{-- <h6 class="font-extrabold mb-0">{{ \App\Models\CategoryPD::count() }} --}}
                        </h6>
                        <div class="parrten">

                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- <div class="col-xl-2 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
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

                  <div class="col-xl-4 col-md-5 col-sm-6 box-col-3 des-xl-25 rate-sec">
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
                  </div>


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
                </div> --}}

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
                    label: 'Purchase Order',
                    backgroundColor: 'rgba(150, 148, 255, 0.9)',
                    borderColor: 'rgb(150, 148, 255)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_po as $po)
                            {{ $po }},
                        @endforeach
                    ],
                },
                {
                    label: 'Pengajuan Dana',
                    backgroundColor: 'rgba(87, 212, 255, 0.9)',
                    borderColor: 'rgb(93, 218, 180)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_pd as $pd)
                            {{ $pd }},
                        @endforeach
                    ],
                },
                {
                    label: 'Quotation',
                    backgroundColor: 'rgba(93, 255, 190, 0.9)',
                    borderColor: 'rgb(255, 121, 118)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_qu as $qu)
                            {{ $qu }},
                        @endforeach
                    ],
                },
                {
                    label: 'Pembelian Barang',
                    backgroundColor: 'rgba(255, 131, 118, 0.9)',
                    borderColor: 'rgb(87, 202, 235)',
                    borderRadius: 5,
                    data: [
                        @foreach ($data_pb as $pb)
                            {{ $pb }},
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
