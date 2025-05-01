    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - SN Admin Dashboard</title>

        <link rel="stylesheet" href="<?= base_url('assets/template/mazer/css/main/app.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/template/mazer/css/main/app-dark.css') ?>">
        <link rel="shortcut icon" href="<?= base_url('assets/template/mazer/images/logo/favicon.svg') ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?= base_url('assets/template/mazer/images/logo/favicon.png') ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?= base_url('assets/template/mazer/css/shared/iconly.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/template/mazer/extensions/choices.js/public/assets/styles/choices.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/js/datatables/dataTables.bootstrap4.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/js/datatables/dataTables.bootstrap4.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/js/datatables/responsive.bootstrap4.min.css') ?>">

        <script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery/jquery.price_format.min.js') ?>"></script>
    </head>

    <body>
        <input type="hidden" name="month" value="<?= $month; ?>">
        <input type="hidden" name="year" value="<?= $year ?>">
        <div id="app">
            <div id="main" style="margin-left: 0px;">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="text-center">
                                <div class="d-block">
                                    <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                                </div>
                                <h3>Pengeluaran SN</h3>
                                <p class="text-subtitle text-muted">Sistem Keuangan SN.</p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <!-- Section 2 -->
                        <div class="report visible">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Laporan Keuangan
                                    </h6>
                                    <p>Noorman - <span id="monthyear"></span></p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <h6>Total Pengeluaran</h6>
                                        <p class="h3" id="total_pengeluaran"></p>
                                        <hr />
                                        <h6>Kategori Pengeluaran</h6>
                                        <div class="table-responsive">
                                            <table class="table table-xs">
                                                <tr>
                                                    <td>KANDANG</td>
                                                    <td id="pengeluaran_kandang"></td>
                                                </tr>
                                                <tr>
                                                    <td>PROD.(IDHAM)</td>
                                                    <td id="pengeluaran_prodidh"></td>
                                                </tr>
                                                <tr>
                                                    <td>PROD.(HARY)</td>
                                                    <td id="pengeluaran_prodhar"></td>
                                                </tr>
                                                <tr>
                                                    <td>REK.LAIN</td>
                                                    <td id="pengeluaran_reklain"></td>
                                                </tr>
                                                <tr>
                                                    <td>LAIN-LAIN</td>
                                                    <td id="pengeluaran_lainlain"></td>
                                                </tr>
                                                <tr>
                                                    <td>PROYEK</td>
                                                    <td id="pengeluaran_proyek"></td>
                                                </tr>
                                                <tfoot>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td id="pengeluaran_total_by_kategori"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <hr />
                                        <h6>Detail Pengeluaran</h6>
                                        <div class="table-responsive">
                                            <table class="table table-xs text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tgl</th>
                                                        <th>Kategori</th>
                                                        <th>Pengeluaran</th>
                                                        <th>Jenis Barang</th>
                                                        <th>Jumlah Barang</th>
                                                        <th>Keterangan</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-data">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="text-center" style="font-size:'smaller';">
                <p>2022 &copy; Dev-SN V.01 Beta</p>
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="https://saugi.me">Saugi</a></p>
            </div>
        </div>
    </footer>
    <script src="<?= base_url('assets/template/mazer/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/template/mazer/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/template/mazer/extensions/choices.js/public/assets/scripts/choices.js') ?>"></script>
    <script src="<?= base_url('assets/template/mazer/js/pages/form-element-select.js') ?>"></script>
    <script src="<?= base_url('assets/') ?>js/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/datatables/dataTables.responsive.min.js"></script>


    </html>
    <script>
        $(document).ready(function() {
            $('.sidebar-item').removeClass('active');
            $('#sidebar-laporan').addClass('active');
            generateReport();
        });


        function getData() {
            const tgl = new Date();
            let m = $('input[name=month]').val();
            let y = $('input[name=year]').val();

            var datefrom = y + "-" + m + "-" + "01";
            var dateto = y + "-" + m + "-" + "31";

            var data = $.ajax({
                global: false,
                async: false,
                type: 'POST',
                url: '<?= base_url('pengeluaran/get_data_by_date') ?>',
                dataType: 'json',
                data: {
                    'datefrom': datefrom,
                    'dateto': dateto
                },
                success: function(response) {
                    return response;
                },
            }).responseJSON;

            return data;
        }

        function getTotalPengeluaran() {
            var data = getData();
            var i;
            var sum = 0;

            for (i = 0; i < data.length; i++) {
                sum += parseInt(data[i].pengeluaran_total);
            }
            return sum;
        }

        function getDataByKategori(kategori) {
            var data = getData();
            var sum = 0;
            if (data.length != 0) {
                for (i = 0; i < data.length; i++) {
                    if (data[i].pengeluaran_kategori == kategori) {
                        sum += parseInt(data[i].pengeluaran_total);
                    }
                }
            }
            return sum;
        }


        function generateTable() {
            var data = getData();
            var html = "";
            var no = 1;

            if (data.length != 0) {
                for (i = 0; i < data.length; i++) {
                    html += '<tr>';
                    html += '   <td class="text-xs" style="width:10%;">' + no++ + '</td>';
                    html += '   <td class="text-xs">' + data[i].pengeluaran_tgl + '</td>';
                    html += '   <td class="text-xs">' + data[i].pengeluaran_kategori + '</td>';
                    html += '   <td class="text-xs">' + data[i].pengeluaran + '</td>';
                    html += '   <td class="text-xs">' + data[i].pengeluaran_jenis_barang + '</td>';
                    html += '   <td class="text-xs">' + data[i].pengeluaran_jumlah + '</td>';
                    html += '   <td class="text-xs">' + data[i].pengeluaran_keterangan + '</td>';
                    html += '   <td class="text-xs">Rp. ' + formatRupiah(data[i].pengeluaran_total) + '</td>';
                    html += '</tr>';
                }
                $('#table-data').html(html);
            } else {
                html += '<tr>';
                html += '<td colspan="5">Tidak Ada Data</td>';
                html += '</tr>';

                $('#table-data').html(html);

            }
        }

        function generateMonthYear() {
            var key = {
                1: "Januari",
                2: "Februari",
                3: "Maret",
                4: "April",
                5: "Mei",
                6: "Juni",
                7: "Juli",
                8: "Agustus",
                9: "September",
                10: "Oktober",
                11: "November",
                12: "Desember"
            }
            let m = $('input[name=month]').val();
            let y = $('input[name=year]').val();
            $("#monthyear").text(key[m] + " " + y);
        }

        function generateReport() {
            var data = getData();

            //Remove Class Invisible
            $('.report').removeClass('invisible');

            //Generate Month Year
            generateMonthYear();

            //Total Pengeluaran
            var totalPengeluaran = getTotalPengeluaran();
            $('#total_pengeluaran').text("Rp. " + formatRupiah(totalPengeluaran.toString()));
            $("#pengeluaran_total_by_kategori").text("Rp. " + formatRupiah(totalPengeluaran.toString()));

            //Total Pengeluaran By Kategori
            var kt_kandang = getDataByKategori("KANDANG");
            var kt_prodidh = getDataByKategori("PROD.(IDHAM)");
            var kt_prodhar = getDataByKategori("PROD.(HARY)");
            var kt_reklain = getDataByKategori("REK.LAIN");
            var kt_lainlain = getDataByKategori("LAIN-LAIN");
            var kt_proyek = getDataByKategori("PROYEK");
            $('#pengeluaran_kandang').text("Rp." + formatRupiah(kt_kandang.toString()));
            $('#pengeluaran_prodidh').text("Rp." + formatRupiah(kt_prodidh.toString()));
            $('#pengeluaran_prodhar').text("Rp." + formatRupiah(kt_prodhar.toString()));
            $('#pengeluaran_reklain').text("Rp." + formatRupiah(kt_reklain.toString()));
            $('#pengeluaran_lainlain').text("Rp." + formatRupiah(kt_lainlain.toString()));
            $('#pengeluaran_proyek').text("Rp." + formatRupiah(kt_proyek.toString()));


            //Detail Pengeluaran
            generateTable();
        }

        //Format Rupiah
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? ',' : '';
                rupiah += separator + ribuan.join(',');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>