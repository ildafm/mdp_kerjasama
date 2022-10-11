@extends('layouts.master')
@section('dashboard', 'Dashboard')

@section('content')

    <div class="container-fluid">
        {{-- Script HighChart --}}
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>

        {{-- Card Info Box --}}
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
                                <h3>{{ $getJumlahMitra[0]->jumlahMitra }}</h3>
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
                                <h3>{{ $getJumlahKerjasama[0]->jumlahKerjasama }}</h3>
                                {{-- <sup style="font-size: 20px">%</sup> --}}
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
                                <h3>{{ $getJumlahKegiatan[0]->jumlahKegiatan }}</h3>
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
                                <h3>{{ $getJumlahUsulan[0]->jumlahUsulan }}</h3>
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
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ $namaStatus[0]->nama_status }}</span>
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
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-bell"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ $namaStatus[2]->nama_status }}</span>
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
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"> <i class="fas fa-exclamation"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{ $namaStatus[1]->nama_status }}</span>
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

                </div>
            </div>

            <div class="card-footer">

            </div>

        </div>

        {{-- Card Grafik Pie --}}
        <div>
            {{-- Style Grafik Pie --}}
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

            {{-- Grafik Pie --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Info Grafik
                    </h3>
                    <div class="card-tools">
                        {{-- nav grafik pie --}}
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

                            {{-- Nav Grafik Laporan Unit --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#laporan_unit-chart" data-toggle="tab">Laporan Unit</a>
                            </li>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </ul>
                    </div>
                </div>

                {{-- Canvas Grafik Pie --}}
                <div class="card-body">
                    <div class="tab-content p-0">
                        {{-- Grafik Mitra --}}
                        <div class="chart tab-pane active" id="mitra-chart" style="position: relative; height: 450px;">
                            <div class="">
                                <figure class="highcharts-figure">
                                    <div id="container1"></div>
                                    <p class="highcharts-description">

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
                                            text: 'Jumlah Kerjasama dengan atau tanpa MoU'
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
                                                @foreach ($countKategoriInKerjasama as $data)
                                                    {
                                                        name: '{{ $data->nama_kategori }}',
                                                        y: {{ $data->jumlah_kategori }},
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
                                            name: 'Jumlah',
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
                                            name: 'Jumlah',
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

                        {{-- Grafik Laporan --}}
                        <div class="chart tab-pane" id="laporan_unit-chart" style="position: relative; height: 450px;">
                            <div class="">
                                <figure class="highcharts-figure">
                                    <div id="container5"></div>
                                    <p class="highcharts-description">

                                    </p>
                                </figure>

                                <script>
                                    Highcharts.chart('container5', {
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            type: 'pie'
                                        },
                                        title: {
                                            text: 'Jumlah Total Laporan Setiap Unit'
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
                                                @foreach ($getJumlahLaporanPerUnit as $data)
                                                    {
                                                        name: '{{ $data->nama_unit }}',
                                                        y: {{ $data->jumlah_laporan }},
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
        </div>

        {{-- Card Top 10 negara yang melakukan kerjasama --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-globe mr-1"></i>
                    Top 10 Negara Mitra
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
                <p>Tren negara asal mitra yang melakukan kerjasama</p>
                {{-- Tabel Data --}}
                <table id="dashboardOnly1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Negara</th>
                            <th>Total Kegiatan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($countTotalKegiatanBerdasarkanNegara) > 0)
                            @php
                                $nomor = 1;
                            @endphp

                            @foreach ($countTotalKegiatanBerdasarkanNegara as $data)
                                <tr>
                                    <td>
                                        {{ $nomor++ }}
                                    </td>

                                    <td>{{ $data->nama_negara }}</td>
                                    <td>{{ $data->total_kegiatan }}</td>

                                </tr>
                            @endforeach
                        @endif

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Negara</th>
                            <th>Total Kegiatan</th>
                        </tr>
                    </tfoot>

                </table>

            </div>
        </div>

        {{-- Card top 5 bentuk kegiatan, dan klasifikasi mitra --}}
        <div>
            {{-- Style Grafik --}}
            <style>
                .highcharts-figure,
                .highcharts-data-table table {
                    min-width: 310px;
                    max-width: 800px;
                    margin: 1em auto;
                }

                #container {
                    height: 400px;
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
            </style>

            {{-- top 5 bentuk kegiatan, dan klasifikasi mitra --}}
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Top 5 Tren Kerjasama
                    </h3>
                    <div class="card-tools">
                        {{-- nav grafik batang --}}
                        <ul class="nav nav-pills ml-auto">

                            {{-- Nav Grafik Bentuk Kegiatan --}}
                            <li class="nav-item">
                                <a class="nav-link active" href="#bentuk_kegiatan-chart" data-toggle="tab">Bentuk
                                    Kegiatan</a>
                            </li>

                            {{-- Nav Grafik Klasifikasi Mitra --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#klasifikasi_mitra-chart" data-toggle="tab">Klasifikasi
                                    Mitra</a>
                            </li>

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>

                        </ul>
                    </div>

                </div>

                {{-- Canvas Grafik --}}
                <div class="card-body">
                    <div class="tab-content p-0">
                        {{-- Grafik Bentuk Kegiatan --}}
                        <div class="chart tab-pane active" id="bentuk_kegiatan-chart"
                            style="position: relative; height: 450px;">
                            <div class="">
                                <figure class="highcharts-figure">
                                    <div id="grafik_top_bentuk_kegiatan"></div>
                                    <p class="highcharts-description">
                                    </p>
                                </figure>

                                <script>
                                    Highcharts.chart('grafik_top_bentuk_kegiatan', {
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            align: 'left',
                                            text: 'Tren kerjasama berdasarkan bentuk kegiatan yang dilakukan'
                                        },
                                        subtitle: {
                                            align: 'left',
                                            text: ''
                                        },
                                        accessibility: {
                                            announceNewData: {
                                                enabled: true
                                            }
                                        },
                                        xAxis: {
                                            type: 'category'
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Total percent market share'
                                            }

                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: 'Total : {point.y}'
                                                }
                                            }
                                        },

                                        tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}<br/>'
                                        },

                                        series: [{
                                            name: "Bentuk Kegiatan",
                                            colorByPoint: true,
                                            data: [
                                                @foreach ($top5BentukKegiatan as $data)
                                                    {
                                                        name: '{{ $data->bentuk_kegiatan }}',
                                                        y: {{ $data->total_kegiatan }},
                                                        drilldown: null
                                                    },
                                                @endforeach
                                            ]
                                        }],
                                    });
                                </script>
                            </div>
                        </div>

                        {{-- Grafik Klasifikasi_mitra --}}
                        <div class="chart tab-pane" id="klasifikasi_mitra-chart"
                            style="position: relative; height: 450px;">
                            <div class="">
                                <figure class="highcharts-figure">
                                    <div id="grafik_top_klasifikasi_mitra"></div>
                                    <p class="highcharts-description">

                                    </p>
                                </figure>
                                <script>
                                    Highcharts.chart('grafik_top_klasifikasi_mitra', {
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            align: 'left',
                                            text: 'Tren kerjasama berdasarkan klasifikasi mitra'
                                        },
                                        subtitle: {
                                            align: 'left',
                                            text: ''
                                        },
                                        accessibility: {
                                            announceNewData: {
                                                enabled: true
                                            }
                                        },
                                        xAxis: {
                                            type: 'category'
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Total percent market share'
                                            }

                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: 'Total : {point.y}'
                                                }
                                            }
                                        },

                                        tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}<br/>'
                                        },

                                        series: [{
                                            name: "Klasifikasi Mitra",
                                            colorByPoint: true,
                                            data: [
                                                @foreach ($top5KlasifikasiMitra as $data)
                                                    {
                                                        name: '{{ $data->klasifikasi_mitra }}',
                                                        y: {{ $data->total }},
                                                        drilldown: null
                                                    },
                                                @endforeach
                                            ]
                                        }],
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- end div container-fluid --}}
    </div>
@endsection
