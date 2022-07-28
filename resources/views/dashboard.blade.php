<title>Dashboard</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div>
                    <h1>Dashboard</h1>
                </div>
                <div class="page-content mt-4">
                    <section class="row">
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-6 col-lg-3 col-md-6">
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
                                <div class="col-6 col-lg-3 col-md-6">
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
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card shadow">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon green">
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
                                <div class="col-6 col-lg-3 col-md-6">
                                    <div class="card shadow">
                                        <div class="card-body px-3 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="stats-icon red">
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
                        <div class="col-12 col-lg-4">
                            <div class="col-6 col-lg-12 col-md-6">
                                <div class="card shadow">
                                    <div class="card-body py-4 px-5">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="assets/images/faces/1.jpg" alt="Face 1">
                                            </div>
                                            <div class="ms-3 name">
                                                <h3 class="font-bold">
                                                    {{ \Auth::user()->name ?? 'None' }}
                                                </h3>
                                                <h6 class="text-muted mb-0">{{ \Auth::user()->email ?? 'None' }}</h6>
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
                </div>
            </div>
            {{-- <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Messages</h4>
                        </div>
                        <div class="card-content pb-4">
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/faces/4.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Hank Schrader</h5>
                                    <h6 class="text-muted mb-0">@johnducky</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/faces/5.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">Dean Winchester</h5>
                                    <h6 class="text-muted mb-0">@imdean</h6>
                                </div>
                            </div>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/faces/1.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">John Dodol</h5>
                                    <h6 class="text-muted mb-0">@dodoljohn</h6>
                                </div>
                            </div>
                            <div class="px-4">
                                <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Start
                                    Conversation</button>
                            </div>
                        </div>
                    </div> --}}
    </section>
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
