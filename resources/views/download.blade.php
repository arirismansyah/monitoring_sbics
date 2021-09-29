@extends('layouts.main')
@section('main-container')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-download"></i>
                    </span> Download FIle Backup
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span>Monitoring SBICS</span>
                            <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle ml-2"></i>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Download File Backup ICS</h4>

                            <div class="row mt-4 mb-4 d-flex justify-content-around">
                                <div class="col-sm-1 d-flex flex-column justify-content-top">
                                    <label class="col-form-label">Filter :</label>
                                </div>
                                <div class="col-sm-2 d-flex flex-column justify-content-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input id="bykab" type="checkbox" class="form-check-input"> By Kabupaten/Kota
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input id="bypetugas" type="checkbox" class="form-check-input"> By Petugas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 d-flex flex-column justify-content-center">
                                    <div class="form-group row">
                                        <div class="col-sm-6 d-flex flex-column justify-content-center">
                                            <label for="kab-filter">Kabupaten/Kota</label>
                                            <select disabled name="kab-filter" id="kab-filter" class="form-control">
                                                <option value="" selected disabled>-- Pilih Kabupaten/Kota --</option>
                                                @foreach ($list_kab as $kab)
                                                    <option value="{{ $kab['kab'] }}">
                                                        {{ $kab['nmkab'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6 d-flex flex-column justify-content-center">
                                            <label for="petugas-filter">Petugas</label>
                                            <select disabled name="petugas-filter" id="petugas-filter"
                                                class="form-control">
                                                <option value="" selected disabled>-- Pilih Petugas --</option>
                                                @foreach ($data_all_petugas as $petugas)
                                                    <option value="{{ $petugas['uname'] }}">{{ $petugas['nama'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 d-flex flex-column justify-content-center">
                                    <div>
                                        <button id="button-filter-backup" type="button"
                                            class="btn btn-gradient-primary btn-icon-text">
                                            <i class="mdi mdi-filter btn-icon-prepend"></i>Filter
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col-12 grid-margin">
                                    <div class="clearfix">
                                        <h4 class="card-title float-left">File Backup ICS</h4>
                                    </div>
                                    <div class="table-responsive col-12 grid-margin" id="table-report-kab">
                                        <table id="table-backup" class="table table-bordered">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th class="text-center">No</th>
                                                    <th class="text-center" scope="col">Nama Petugas</th>
                                                    <th class="text-center" scope="col">Kode Wilayah</th>
                                                    <th class="text-center" scope="col">Nama File</th>
                                                    <th class="text-center" scope="col">Tanggal Backup</th>
                                                    <th class="text-center" scope="col">Download</th>
                                                </tr>
                                            </thead>

                                            <tbody id="body-table-backup">
                                                @foreach ($data_backup as $backup)
                                                    <tr>
                                                        <td class="text-right"></td>
                                                        <td>{{ $backup['nama'] }}</td>
                                                        <td class="text-center">{{ $backup['prov'] . $backup['kab'] }}
                                                        </td>
                                                        <td>{{ $backup['nmfile'] }}</td>
                                                        <td>{{ $backup['tgl'] }}</td>
                                                        <td class="text-center">
                                                            <h1>
                                                                <a href="{{ urlencode($backup['nmfile']) }}"
                                                                    target="_blank"
                                                                    class="mdi mdi-folder-download  primary"></a>
                                                                </h3>
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
            var table_backup = $('#table-backup').DataTable({
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

            table_backup.on('order.dt search.dt', function() {
                table_backup.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            $('#bykab').click(function(e) {
                if ($('#bykab').prop('checked') == true) {
                    //do something
                    $('#kab-filter').attr("disabled", false);
                } else {
                    $('#kab-filter').attr("disabled", "disabled");
                }
            });
            $('#bypetugas').click(function(e) {
                if ($('#bypetugas').prop('checked') == true) {
                    //do something
                    $('#petugas-filter').attr("disabled", false);
                } else {
                    $('#petugas-filter').attr("disabled", "disabled");
                }
            });

            $('#kab-filter').change(function() {
                var kode_kab = $('#kab-filter').val();
                var data_petugas = function() {
                    var tmp = null;

                    if (kode_kab != null) {
                        $.ajax({
                            async: false,
                            method: "POST",
                            url: "{{ route('datapetugas') }}",
                            data: {
                                'kode_kab': kode_kab,
                            },
                            success: function(data) {
                                tmp = data.data;
                            }
                        });
                    }
                    return tmp;
                }();

                var options = '<option value="" selected disabled>-- Pilih Petugas --</option>';
                data_petugas.forEach(element => {
                    var op = '<option value="' + element['uname'] + '">' + element['nama'] +
                        '</option>';
                    options += op;
                });

                $('#petugas-filter').html(options);
            });

            $('#button-filter-backup').click(function(e) {
                e.preventDefault();
                var kab = $('#kab-filter').val();
                var petugas = $('#petugas-filter').val();

                if (kab != null || petugas != null) {
                    var data_backup = function() {
                        var tmp = null;

                        if (kab != null) {
                            $.ajax({
                                async: false,
                                method: "POST",
                                url: "{{ route('databackup') }}",
                                data: {
                                    'kode_kab': kab,
                                    'username': petugas,
                                },
                                success: function(data) {
                                    tmp = data.data;
                                }
                            });
                        }
                        return tmp;

                    }();

                    var table_body = '';
                    data_backup.forEach(element => {
                        var row = '<tr><td class="text-right"></td><td>' + element['nama'] +
                            '</td><td class="text-center">' + element['prov'] + element['kab'] +
                            '</td><td>' + element['nmfile'] + '</td><td>' + element['tgl'] +
                            '</td><td class="text-center"><h1><a href="' +
                            encodeURI(element['nmfile']) +
                            '"target="_blank"class="mdi mdi-folder-download  primary"></a></h3></td></tr>';
                        table_body += row;
                    });
                    $('#table-backup').DataTable().destroy();
                    $('#body-table-backup').html(table_body);

                    var table_backup = $('#table-backup').DataTable({
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

                    table_backup.on('order.dt search.dt', function() {
                        table_backup.column(0, {
                            search: 'applied',
                            order: 'applied'
                        }).nodes().each(function(cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }).draw();
                }
            });
        });
    </script>
@endsection
