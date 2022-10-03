<title>Dashboard</title>

@extends('layouts.master')

@section('main')
    <section>
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div>
                    <h1>Dashboard</h1>
                </div>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2" style="border-left: 10px solid blue;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="{{ route('menu-pengajuan-pembelian.index') }}" class="small-box-footer">
                                        <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1"
                                            style="font-weight: bold;">Purchase Submission</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ \App\Models\CategoryPengajuanPembelian::count() }}</div>
                                </div></a>
                                <div class="col-auto font-warning">
                                    <i class="icofont icofont-paper" style="font-size: 40;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2" style="border-left: 10px solid green;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="{{ route('menu-task-list.index') }}" class="small-box-footer">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                            style="font-weight: bold;">Task List</div>
                                        <div class="h5 mb-0 font-weight-bold text-success">
                                            {{ \App\Models\CategoryPengajuanPembelian::where('status', 'Accepted by Purchasing')->count() }}
                                        </div>
                                </div></a>
                                <div class="col-auto font-warning">
                                    <i class="icofont icofont-tasks-alt" style="font-size: 40;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2" style="border-left: 10px solid red;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="{{ route('menu-purchase-order.index') }}" class="small-box-footer">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"
                                            style="font-weight: bold;">Purchase Order</div>
                                        <div class="h5 mb-0 font-weight-bold text-danger">
                                            {{ \App\Models\CategoryPO::count() }}</div>
                                </div></a>
                                <div class="col-auto font-warning">
                                    <i class="icofont icofont-ui-calendar" style="font-size: 40;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2" style="border-left: 10px solid yellow;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="{{ route('menu-pengajuan-dana.index') }}" class="small-box-footer">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                                            style="font-weight: bold;">Fund Submision</div>
                                        <div class="h5 mb-0 font-weight-bold text-warning">
                                            {{ \App\Models\CategoryPD::count() }}</div>
                                </div></a>
                                <div class="col-auto font-warning">
                                    <i class="icofont icofont-coins" style="font-size: 40;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 box-col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5>Monthly Chart</h5>
                                </div>
                                <div class="card-body chart-block">
                                    <canvas id="Po"></canvas>
                                </div>
                            </div>
                        </div>

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
