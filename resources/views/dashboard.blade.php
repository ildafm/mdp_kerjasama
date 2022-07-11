@extends('layouts.master')
@section('dashboard', 'Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- Info Box --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-copy mr-1"></i>
                    Info Box
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- Info Mitra, Kerjasama, Kegiatan, Usulan --}}
                <div class="row">
                    {{-- Total Mitra --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                @if (count($getJumlahMitra) > 0)
                                    @foreach ($getJumlahMitra as $data)
                                        <h3>{{ $data->jumlahMitra }}</h3>
                                    @endforeach
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Total Mitra</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <a href="{{ url('/mitras') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    {{-- Total Kerjasama --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                @if (count($getJumlahKerjasama) > 0)
                                    @foreach ($getJumlahKerjasama as $data)
                                        <h3>{{ $data->jumlahKerjasama }}</h3>
                                        {{-- <sup style="font-size: 20px">%</sup> --}}
                                    @endforeach
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Total Kerjasama</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <a href="{{ url('/kerjasamas') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    {{-- Total Kegiatan --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                @if (count($getJumlahKegiatan) > 0)
                                    @foreach ($getJumlahKegiatan as $data)
                                        <h3>{{ $data->jumlahKegiatan }}</h3>
                                    @endforeach
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Total Kegiatan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a href="{{ url('/kegiatans') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    {{-- Total Usulan --}}
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                @if (count($getJumlahUsulan) > 0)
                                    @foreach ($getJumlahUsulan as $data)
                                        <h3>{{ $data->jumlahUsulan }}</h3>
                                    @endforeach
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Total Usulan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <a href="{{ url('/usulans') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Info Status Kerjasama --}}
                <h5>Jumlah Status Kerjasama</h5>
                <div class="row">

                    {{-- Aktif --}}
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Aktif</span>
                                <span class="info-box-number">
                                    @if (count($countStatusAktif) > 0)
                                        @foreach ($countStatusAktif as $item)
                                            {{ $item->jumlah }}
                                        @endforeach
                                    @else
                                        0
                                    @endif

                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Dalam Perpanjangan --}}
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bell"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Dalam Perpanjangan</span>
                                <span class="info-box-number">
                                    @if (count($countStatusDalamPerpanjangan) > 0)
                                        @foreach ($countStatusDalamPerpanjangan as $item)
                                            {{ $item->jumlah }}
                                        @endforeach
                                    @else
                                        0
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix hidden-md-up"></div>
                    {{-- Kadaluarsa --}}
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"> <i class="fas fa-exclamation"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kadaluarsa</span>
                                <span class="info-box-number">
                                    @if (count($countStatusKadaluarsa) > 0)
                                        @foreach ($countStatusKadaluarsa as $item)
                                            {{ $item->jumlah }}
                                        @endforeach
                                    @else
                                        0
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Tidak Aktif --}}
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tidak Aktif</span>
                                <span class="info-box-number">
                                    @if (count($countStatusTidakAktif) > 0)
                                        @foreach ($countStatusTidakAktif as $item)
                                            {{ $item->jumlah }}
                                        @endforeach
                                    @else
                                        0
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                Footer
            </div>

        </div>

        {{-- Script Grafik --}}
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        {{-- Style Grafik --}}
        <style>
            .highcharts-figure,
            .highcharts-data-table table {
                min-width: 320px;
                max-width: 800px;
                margin: 1em auto;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }

            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }

            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }

            .highcharts-data-table td,
            .highcharts-data-table th,
            .highcharts-data-table caption {
                padding: 0.5em;
            }

            .highcharts-data-table thead tr,
            .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }

            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }

            input[type="number"] {
                min-width: 50px;
            }
        </style>

        {{-- Grafik --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Info Grafik
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">

                        {{-- Nav Grafik Mitra --}}
                        <li class="nav-item">
                            <a class="nav-link active" href="#mitra-chart" data-toggle="tab">Mitra</a>
                        </li>

                        {{-- Nav Grafik Kerjasama --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#kerjasama-chart" data-toggle="tab">Kerjasama</a>
                        </li>

                        {{-- Nav Grafik Kegiatan --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#kegiatan-chart" data-toggle="tab">Kegiatan</a>
                        </li>

                        {{-- Nav Grafik Usulan --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#usulan-chart" data-toggle="tab">Usulan</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Canvas Grafik --}}
            <div class="card-body">
                <div class="tab-content p-0">
                    {{-- Grafik Mitra --}}
                    <div class="chart tab-pane active" id="mitra-chart" style="position: relative; height: 450px;">
                        <div class="">
                            <figure class="highcharts-figure">
                                <div id="container1"></div>
                                <p class="highcharts-description">
                                    {{-- Menunjukan jumlah mitra berdasarkan tingkatannya. --}}
                                </p>
                            </figure>

                            <script>
                                Highcharts.chart('container1', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Jumlah Mitra Berdasarkan Tingkatannya'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.y}</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y}'
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'Jumlah',
                                        colorByPoint: true,
                                        data: [
                                            @foreach ($getJumlahMitraBerdasarkanTingkatannya as $data)
                                                {
                                                    name: '{{ Status::mitra($data->tingkat) }}',
                                                    y: {{ $data->jumlahTingkat }},
                                                    sliced: false,
                                                    selected: false
                                                },
                                            @endforeach
                                        ]
                                    }]
                                });
                            </script>
                        </div>
                    </div>

                    {{-- Grafik Kerjasama --}}
                    <div class="chart tab-pane" id="kerjasama-chart" style="position: relative; height: 450px;">
                        <div class="">
                            <figure class="highcharts-figure">
                                <div id="container2"></div>
                                <p class="highcharts-description">
                                    {{-- Menunjukan jumlah kerjasama dengan mitra. --}}
                                </p>
                            </figure>

                            <script>
                                Highcharts.chart('container2', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Jumlah Kerjasama Dengan Mitra'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.y}</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y}'
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'Jumlah Kerjasama',
                                        colorByPoint: true,
                                        data: [
                                            @foreach ($getJumlahKerjasamaDenganMitra as $data)
                                                {
                                                    name: '{{ $data->nama_mitra }}',
                                                    y: {{ $data->jumlah_kerjasama }},
                                                    sliced: false,
                                                    selected: false
                                                },
                                            @endforeach
                                        ]
                                    }]
                                });
                            </script>
                        </div>
                    </div>

                    {{-- Grafik Kegiatan --}}
                    <div class="chart tab-pane" id="kegiatan-chart" style="position: relative; height: 450px;">
                        <div class="">
                            <figure class="highcharts-figure">
                                <div id="container3"></div>
                                <p class="highcharts-description">

                                </p>
                            </figure>

                            <script>
                                Highcharts.chart('container3', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Jumlah Kegiatan Berdasarkan Kerjasama'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.y}</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y}'
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'Jumlah Kegiatan',
                                        colorByPoint: true,
                                        data: [
                                            @foreach ($getJumlahKegiatanBerdasarkanKerjasama as $data)
                                                {
                                                    name: '{{ $data->nama_kerja_sama }}',
                                                    y: {{ $data->jumlahKegiatan }},
                                                    sliced: false,
                                                    selected: false
                                                },
                                            @endforeach
                                        ]
                                    }]
                                });
                            </script>
                        </div>
                    </div>

                    {{-- Grafik Usulan --}}
                    <div class="chart tab-pane" id="usulan-chart" style="position: relative; height: 450px;">
                        <div class="">
                            <figure class="highcharts-figure">
                                <div id="container4"></div>
                                <p class="highcharts-description">

                                </p>
                            </figure>

                            <script>
                                Highcharts.chart('container4', {
                                    chart: {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                        type: 'pie'
                                    },
                                    title: {
                                        text: 'Jumlah Usulan Dosen'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.y}</b>'
                                    },
                                    accessibility: {
                                        point: {
                                            valueSuffix: '%'
                                        }
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.y}'
                                            }
                                        }
                                    },
                                    series: [{
                                        name: 'Jumlah Usulan',
                                        colorByPoint: true,
                                        data: [
                                            @foreach ($getJumlahUsulanDosen as $data)
                                                {
                                                    name: '{{ $data->kode_dosen }} - {{ $data->name }}',
                                                    y: {{ $data->jumlahUsulan }},
                                                    sliced: false,
                                                    selected: false
                                                },
                                            @endforeach
                                        ]
                                    }]
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- endDivContainer-fluid --}}


@endsection
