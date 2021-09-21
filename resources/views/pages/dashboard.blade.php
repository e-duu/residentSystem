@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div id="app">
  <div class="page-heading">
      <h3>Data Statistik Desa</h3>
  </div>
  <div class="page-content">
      <section class="row">
          <div class="col-12 col-lg-9">
              <div class="row">
                  <div class="col-6 col-lg-3 col-md-6">
                      <div class="card">
                          <div class="card-body px-3 py-4-5">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="stats-icon purple">
                                          <i class="iconly-boldShow"></i>
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                      <h6 class="text-muted font-semibold">Keluarga</h6>
                                      <h6 class="font-extrabold mb-0">{{ $families->count() }}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-6 col-lg-3 col-md-6">
                      <div class="card">
                          <div class="card-body px-3 py-4-5">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="stats-icon blue">
                                          <i class="iconly-boldProfile"></i>
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                      <h6 class="text-muted font-semibold">Penduduk</h6>
                                      <h6 class="font-extrabold mb-0">{{ $residents->count() }}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-6 col-lg-3 col-md-6">
                      <div class="card">
                          <div class="card-body px-3 py-4-5">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="stats-icon green">
                                          <i class="iconly-boldAdd-User"></i>
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                      <h6 class="text-muted font-semibold">Pendatang</h6>
                                      <h6 class="font-extrabold mb-0">{{ $comers->count() }}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-6 col-lg-3 col-md-6">
                      <div class="card">
                          <div class="card-body px-3 py-4-5">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="stats-icon red">
                                          <i class="iconly-boldBookmark"></i>
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                      <h6 class="text-muted font-semibold">Kematian</h6>
                                      <h6 class="font-extrabold mb-0">{{ $dies->count() }}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4>Data Penduduk Berdasarkan Agama</h4>
                          </div>
                          <div class="card-body">
                              <div id="chart-profile-visit"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-lg-3">
              <div class="card">
                  <div class="card-body py-4 px-5">
                      <div class="d-flex align-items-center">
                          <div class="avatar avatar-xl">
                              <img src="/dist/assets/images/faces/8.jpg" alt="Face 1">
                          </div>
                          <div class="ms-3 name">
                              <h5 class="font-bold">King Weswey</h5>
                              <h6 class="text-muted mb-0">kingweswey@gmail.com</h6>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card">
                  <div class="card-header">
                      <h4>Data Penduduk Berdasarkan Jenis Kelamin</h4>
                  </div>
                  <div class="card-body">
                      <div id="chart-visitors-profile"></div>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Jumlah Kematian</h4>
                    </div>
                    <div class="card-body">
                        <div id="radialGradient"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Penduduk Berdasarkan Umur</h4>
                    </div>
                    <div class="card-body">
                        <div id="area"></div>
                    </div>
                </div>
            </div>
        </div>
      </section>
  </div>
@endsection

@push('before-script')
    <script>
        var optionsProfileVisit = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled:false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity:1
            },
            plotOptions: {
            },
            series: [{
                name: 'Total',
                data: [{{ $pie['islam'] }}, {{ $pie['katolik'] }}, {{ $pie['kristen'] }}, {{ $pie['buddha'] }}, {{ $pie['khonghucu'] }}, {{ $pie['hindu'] }}, {{ $pie['atheis'] }}
]
            }],
            colors: '#435ebe',
            xaxis: {
                categories: ["Islam","Katolik","Kristen","buddha","Khonghucu","Hindu","Atheis"],
            },
        }

        let optionsVisitorsProfile  = {
            series: [ {{ $gender['man'] }}, {{ $gender['woman'] }}, {{ $gender['other'] }} ], 
            labels: ['Pria', 'Wanita', 'Lainnya'], 
            colors: ['#435ebe','#FF7976', '#5EDAB4'],
            chart: {
                type: 'donut',
                width: '100%',
                height:'350px'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '30%'
                    }
                }
            }
        }
        var radialGradientOptions = {
            series: [{{ $die }}],
            chart: {
                height: 350,
                type: "radialBar",
                toolbar: {
                show: true,
                },
            },
            plotOptions: {
                radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: "70%",
                    background: "#fff",
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: "front",
                    dropShadow: {
                    enabled: true,
                    top: 3,
                    left: 0,
                    blur: 4,
                    opacity: 0.24,
                    },
                },
                track: {
                    background: "#fff",
                    strokeWidth: "67%",
                    margin: 0, // margin is in pixels
                    dropShadow: {
                    enabled: true,
                    top: -3,
                    left: 0,
                    blur: 4,
                    opacity: 0.35,
                    },
                },

                dataLabels: {
                    show: true,
                    name: {
                    offsetY: -10,
                    show: true,
                    color: "#888",
                    fontSize: "17px",
                    },
                    value: {
                    formatter: function(val) {
                        return parseInt(val);
                    },
                    color: "#111",
                    fontSize: "36px",
                    show: true,
                    },
                },
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: ["#ABE5A1"],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100],
                },
            },
            stroke: {
                lineCap: "round",
            },
            labels: ["Total Kematian"],
            };

            var areaOptions = {
                series: [
                    {
                    name: "Total",
                    data: [{{ $age['10'] }}, {{ $age['20'] }}, {{ $age['30'] }}, {{ $age['40'] }}, {{ $age['50'] }}, {{ $age['60'] }}, {{ $age['70'] }}, {{ $age['80'] }}, {{ $age['90'] }}, {{ $age['100'] }}],
                    }
                ],
                chart: {
                    height: 360,
                    type: "area",
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: "smooth",
                },
                xaxis: {
                    type: "age",
                    categories: [
                    "0 - 10",
                    "11 - 20",
                    "21 - 30",
                    "31 - 40",
                    "41 - 50",
                    "51 - 60",
                    "61 - 70",
                    "71 - 80",
                    "81 - 90",
                    "91 - 100",
                    ],
                },
                tooltip: {
                    x: {
                    format: "dd/MM/yy HH:mm",
                    },
                },
                };
        var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile);
        chartVisitorsProfile.render();
    </script>
@endpush
