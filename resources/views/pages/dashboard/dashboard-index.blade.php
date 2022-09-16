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
    <!-- Kick start -->
    <div class="col-lg-12 col-12">
        <div class="card card-revenue-budget">
            <div class="row mx-0">
                <div class="col-md-8 col-12 revenue-report-wrapper">
                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-50 mb-sm-0">Statistik</h4>
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center mr-2">
                                <span class="bullet bullet-primary font-small-3 mr-50 cursor-pointer"></span>
                                <span>Earning</span>
                            </div>
                            <div class="d-flex align-items-center ml-75">
                                <span class="bullet bullet-warning font-small-3 mr-50 cursor-pointer"></span>
                                <span>Expense</span>
                            </div>
                        </div>
                    </div>
                    <div id="revenue-report-chart"></div>
                </div>
                <div class="col-md-4 col-12 budget-wrapper">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            2020
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);">2020</a>
                            <a class="dropdown-item" href="javascript:void(0);">2019</a>
                            <a class="dropdown-item" href="javascript:void(0);">2018</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle budget-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Jenis Grafik
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);">2020</a>
                            <a class="dropdown-item" href="javascript:void(0);">2019</a>
                            <a class="dropdown-item" href="javascript:void(0);">2018</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Kick start -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            var revenueReportChartOptions;
            var $barColor = '#f3f3f3';
            var $trackBgColor = '#EBEBEB';
            var $textMutedColor = '#b9b9c3';
            var $budgetStrokeColor2 = '#dcdae3';
            var $goalStrokeColor2 = '#51e5a8';
            var $strokeColor = '#ebe9f1';
            var $textHeadingColor = '#5e5873';
            var $earningsStrokeColor2 = '#28c76f66';
            var $earningsStrokeColor3 = '#28c76f33';
            var $revenueReportChart = document.querySelector('#revenue-report-chart');
            revenueReportChartOptions = {
                chart: {
                    height: 230,
                    stacked: true,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '17%',
                        endingShape: 'rounded'
                    },
                    distributed: true
                },
                colors: [window.colors.solid.primary, window.colors.solid.warning],
                series: [{
                        name: 'Earning',
                        data: [95, 177, 284, 256, 105, 63, 168, 218, 72]
                    },
                    {
                        name: 'Expense',
                        data: [-145, -80, -60, -180, -100, -60, -85, -75, -100]
                    },
                    {
                        name: 'Expense',
                        data: [-145, -80, -60, -180, -100, -60, -85, -75, -100]
                    }
                ],
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                grid: {
                    padding: {
                        top: -20,
                        bottom: -10
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                xaxis: {
                    categories: ['2020', '2021'],
                    labels: {
                        style: {
                            colors: $textMutedColor,
                            fontSize: '0.86rem'
                        }
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: $textMutedColor,
                            fontSize: '0.86rem'
                        }
                    }
                }
            };
            revenueReportChart = new ApexCharts($revenueReportChart, revenueReportChartOptions);
            revenueReportChart.render();
        });
    </script>
@endsection
