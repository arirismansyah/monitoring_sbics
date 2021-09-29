@extends('layouts.main')
@section('main-container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Monitoring SBICS</span>
                            <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Dashboard Monitoring SBICS</h4>
                            <ul class="nav nav-tabs nav-fill" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="report-kab-tab" data-toggle="pill" href="#report-kab"
                                        role="tab" aria-controls="report-kab" aria-selected="true">Report Kabupaten/Kota</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="report-person-tab" data-toggle="pill"
                                        href="#report-person" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Report Petugas</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="report-kab" role="tabpanel"
                                    aria-labelledby="report-kab-tab">
                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="clearfix">
                                                                <h4 class="card-title float-left">Grafik Report
                                                                    Kabupaten/Kota
                                                                </h4>
                                                                <div id="visit-sale-chart-legend"
                                                                    class="rounded-legend legend-horizontal legend-top-right float-right">
                                                                </div>
                                                            </div>
                                                            <canvas id="visit-sale-chart" class="mt-4 mb-4"></canvas>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="table-responsive col-12 grid-margin"
                                                            id="table-report-kab">
                                                            <div class="clearfix">
                                                                <h4 class="card-title float-left">Table Report
                                                                    Kabupaten/Kota
                                                                </h4>
                                                            </div>
                                                            <table id="table-all-kab" class="table table-bordered">
                                                                <thead>
                                                                    <tr class="table-primary">
                                                                        <th class="text-center">No</th>
                                                                        <th class="text-center" scope="col">Kode
                                                                            Kabupaten/Kota</th>
                                                                        <th class="text-center" scope="col">Nama
                                                                            Kabupaten/Kota</th>
                                                                        <th class="text-center" scope="col">Jumlah
                                                                            Petugas</th>
                                                                        <th class="text-center col-sm-4" scope="col">Jumlah
                                                                            Petugas yang Telah Melakukan Backup</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @foreach ($list_data_all as $data_kab)
                                                                        <tr>
                                                                            <td class="text-right"></td>
                                                                            <td class="text-center">
                                                                                {{ $data_kab['kode_wil'] }}</td>
                                                                            <td>{{ $data_kab['nama_kab'] }}</td>
                                                                            <td class="text-right">
                                                                                {{ $data_kab['jumlah_petugas'] }}</td>
                                                                            <td class="text-right col-sm-4">
                                                                                {{ $data_kab['jumlah_petugas_backup'] }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="report-person" role="tabpanel"
                                    aria-labelledby="report-person-tab">
                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Filter :
                                                            Kabupaten/Kota</label>
                                                        <div class="col-sm-3">
                                                            <select name="kab-filter" id="kab-filter"
                                                                class="form-control">
                                                                <option value="" selected disabled>-- Pilih
                                                                    Kabupaten/Kota --</option>
                                                                <option value="1600">Seluruh Kabupaten/Kota</option>
                                                                @foreach ($list_kab as $kab)
                                                                    <option value="{{ $kab['kab'] }}">
                                                                        {{ $kab['nmkab'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <button id="button-filter-kab" type="button"
                                                                class="btn btn-gradient-primary btn-icon-text">
                                                                <i class="mdi mdi-filter btn-icon-prepend"></i>
                                                                Filter </button>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 grid-margin">
                                                            <div class="clearfix">
                                                                <h4 class="card-title float-left">Table Report Petugas</h4>
                                                            </div>
                                                            <div class="table-responsive col-12 grid-margin" id="table-report-kab">
                                                                <table id="table-petugas" class="table table-bordered">
                                                                    <thead>
                                                                        <tr class="table-primary">
                                                                            <th class="text-center">No</th>
                                                                            <th class="text-center" scope="col">Nama Petugas</th>
                                                                            <th class="text-center" scope="col">Kode Wilayah</th>
                                                                            <th class="text-center" scope="col">Jumlah Upload File Backup</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody id="body-table-petugas">
                                                                      @foreach ($data_all_petugas as $petugas)
                                                                          <tr>
                                                                            <td class="text-right"></td>
                                                                            <td>{{ $petugas['nama'] }}</td>
                                                                            <td class="text-center">{{ $petugas['prov'].$petugas['kab'] }}</td>
                                                                            <td class="text-right">{{ $petugas['jml'] }}</td>
                                                                          </tr>
                                                                      @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © BPS
                    Provinsi Sumatera Selatan 2021</span>
            </div>
        </footer>
        <!-- partial -->
    </div>

    <script>
        $(document).ready(function() {
            var table_all = $('#table-all-kab').DataTable({
                dom: 'Bfrtip',
                pageLength: 17,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            table_all.on('order.dt search.dt', function() {
                table_all.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            var table_petugas = $('#table-petugas').DataTable({
                dom: 'Bfrtip',
                pageLength: 20,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            table_petugas.on('order.dt search.dt', function() {
              table_petugas.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var table_petugas = $('#table-petugas').DataTable({
                dom: 'Bfrtip',
                pageLength: 20,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            table_petugas.on('order.dt search.dt', function() {
              table_petugas.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            $('#button-filter-kab').click(function (e){
                e.preventDefault();
                var kab = $('#kab-filter').val();
                
                var data_petugas = function () {
                    var tmp = null;

                    if(kab != null){
                        $.ajax({
                            async:false,
                            method:"POST",
                            url:"{{ route('datapetugas') }}",
                            data: {
                                'kode_kab':kab,
                            },
                            success: function(data){
                                tmp = data.data;
                            }
                        });
                    }
                    return tmp;
                    
                }();
                
                var table_body = '';
                data_petugas.forEach(element => {
                    
                    var row = '<tr><td class="text-right"></td><td>'+element['nama']+'</td><td class="text-center">'+element['prov']+element['kab']+'</td><td class="text-right">'+element['jml']+'</td></tr>';

                    table_body += row;
                });

                $('#table-petugas').DataTable().destroy();
                $('#body-table-petugas').html(table_body);
                
                var table_petugas = $('#table-petugas').DataTable({
                dom: 'Bfrtip',
                pageLength: 20,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            table_petugas.on('order.dt search.dt', function() {
              table_petugas.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
                

                
            });

            
        });
    </script>

    <script>
        var ctx = document.getElementById('visit-sale-chart').getContext("2d");

        var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
        gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
        gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
        var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';

        var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
        gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
        gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
        var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

        var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
        gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
        var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($list_nama_kab) !!},
                datasets: [{
                        label: "Jumlah Petugas",
                        borderColor: gradientStrokeViolet,
                        backgroundColor: gradientStrokeViolet,
                        hoverBackgroundColor: gradientStrokeViolet,
                        legendColor: gradientLegendViolet,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1,
                        fill: 'origin',
                        data: {!! json_encode($list_jumlah_petugas) !!}
                    },
                    {
                        label: "Jumlah Petugas yang Sudah Melakukan Backup",
                        borderColor: gradientStrokeRed,
                        backgroundColor: gradientStrokeRed,
                        hoverBackgroundColor: gradientStrokeRed,
                        legendColor: gradientLegendRed,
                        pointRadius: 0,
                        fill: false,
                        borderWidth: 1,
                        fill: 'origin',
                        data: {!! json_encode($list_jumlah_petugas_backup) !!}
                    },
                ]
            },
            options: {
                // indexAxis:'y',
                responsive: true,
                legend: false,
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<ul>');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        text.push('<li><span class="legend-dots" style="background:' +
                            chart.data.datasets[i].legendColor +
                            '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false,
                            min: 0,
                            stepSize: 20,
                            max: 80
                        },
                        gridLines: {
                            drawBorder: false,
                            color: 'rgba(235,237,242,1)',
                            zeroLineColor: 'rgba(235,237,242,1)'
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            color: 'rgba(0,0,0,1)',
                            zeroLineColor: 'rgba(235,237,242,1)'
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "#9c9fa6",
                            autoSkip: true,
                        },
                        categoryPercentage: 0.5,
                        barPercentage: 0.5
                    }]
                }
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        })
        // $("#visit-sale-chart-legend").html(myChart.generateLegend());
    </script>
@endsection
