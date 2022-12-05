@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistics</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{ $inovasi }}</h4>
                                    <p class="card-text font-small-3 mb-0">Jumlah Inovasi Itenas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{ $inovasi_selesai }}</h4>
                                    <p class="card-text font-small-3 mb-0">Inovasi Selesai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{ $daftar_haki }}</h4>
                                    <p class="card-text font-small-3 mb-0">Inovasi Daftar Haki</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="media">
                                <div class="avatar bg-light-success mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">{{ $peroleh_haki }}</h4>
                                    <p class="card-text font-small-3 mb-0">Inovasi Peroleh haki</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-12">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h4 class="card-title">Statistik terbaru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {

            const statistics = JSON.parse('{{ $statistics }}');

            barChartEx = $('.bar-chart-ex'), polarAreaChartEx = $('.polar-area-chart-ex');
            var primaryColorShade = '#836AF9',
                yellowColor = '#ffe800',
                successColorShade = '#28dac6',
                warningColorShade = '#ffe802',
                warningLightColor = '#FDAC34',
                infoColorShade = '#299AFF',
                greyColor = '#4F5D70',
                blueColor = '#2c9aff',
                blueLightColor = '#84D0FF',
                greyLightColor = '#EDF1F4',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                lineChartPrimary = '#666ee8',
                lineChartDanger = '#ff4961',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

            // Detect Dark Layout
            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }

            var barChartExample = new Chart($(barChartEx), {
                type: 'bar',
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    responsiveAnimationDuration: 500,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        // Updated default tooltip UI
                        shadowOffsetX: 1,
                        shadowOffsetY: 1,
                        shadowBlur: 8,
                        shadowColor: tooltipShadow,
                        backgroundColor: window.colors.solid.white,
                        titleFontColor: window.colors.solid.black,
                        bodyFontColor: window.colors.solid.black
                    },
                    scales: {
                        xAxes: [{
                            barThickness: 15,
                            display: true,
                            gridLines: {
                                display: true,
                                color: grid_line_color,
                                zeroLineColor: grid_line_color
                            },
                            scaleLabel: {
                                display: false
                            },
                            ticks: {
                                fontColor: labelColor
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: {
                                color: grid_line_color,
                                zeroLineColor: grid_line_color
                            },
                            ticks: {
                                stepSize: 100,
                                min: 0,
                                max: 2000,
                                fontColor: labelColor
                            }
                        }]
                    }
                },
                data: {
                    labels: ['inovasi selesai', 'inovasi belum selesai', 'invoasi daftar haki',
                        'inovasi peroleh haki',
                    ],
                    datasets: [{
                        data: statistics,
                        backgroundColor: successColorShade,
                        borderColor: 'transparent'
                    }]
                }
            });
            var polarExample = new Chart(polarAreaChartEx, {
                type: 'polarArea',
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    responsiveAnimationDuration: 500,
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 25,
                            boxWidth: 9,
                            fontColor: labelColor
                        }
                    },
                    layout: {
                        padding: {
                            top: -5,
                            bottom: -45
                        }
                    },
                    tooltips: {
                        // Updated default tooltip UI
                        shadowOffsetX: 1,
                        shadowOffsetY: 1,
                        shadowBlur: 8,
                        shadowColor: tooltipShadow,
                        backgroundColor: window.colors.solid.white,
                        titleFontColor: window.colors.solid.black,
                        bodyFontColor: window.colors.solid.black
                    },
                    scale: {
                        scaleShowLine: true,
                        scaleLineWidth: 1,
                        ticks: {
                            display: false,
                            fontColor: labelColor
                        },
                        reverse: false,
                        gridLines: {
                            display: false
                        }
                    },
                    animation: {
                        animateRotate: false
                    }
                },
                data: {
                    labels: ['Africa', 'Asia', 'Europe', 'America', 'Antarctica', 'Australia'],
                    datasets: [{
                        label: 'Population (millions)',
                        backgroundColor: [
                            primaryColorShade,
                            warningColorShade,
                            window.colors.solid.primary,
                            infoColorShade,
                            greyColor,
                            successColorShade
                        ],
                        data: [19, 17.5, 15, 13.5, 11, 9],
                        borderWidth: 0
                    }]
                }
            });
        });
    </script>
@endsection
