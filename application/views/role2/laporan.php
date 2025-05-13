    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                    </div>
                    <h3>Tamanpedia</h3>
                    <p class="text-subtitle text-muted">Generate Laporan Keuangan</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Buat Laporan</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical">
                        <div class="form-group position-relative has-icon-left">
                            <label class="label">From</label>
                            <input type="date" class="form form-control" name="start_date" required>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <label class="label">To</label>
                            <input type="date" class="form form-control" name="end_date" required>
                        </div>
                        <div style="float: right;">
                            <button type="button" onclick="generateReport()" class="btn btn-sm btn-success">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr />

            <!-- Section 2 -->
            <div class="report invisible">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Laporan Keuangan <button onclick="sendWhatsapp()" type="button" class="btn btn-sm btn-primary"> <i class="bi bi-share"></i>
                                Share</button>
                        </h6>
                        <p><?= $user['username'] ?> - <span id="monthyear"></span></p>
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
                            <div class=" table-responsive">
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

    <script>
        $(document).ready(function() {
            $('.sidebar-item').removeClass('active');
            $('#sidebar-laporan').addClass('active');
        });


        function getData() {
            const tgl = new Date();
            let m = $('select[name=select_bulan]').val();
            let y = $('select[name=select_tahun]').val();

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

            let m = $('select[name=select_bulan]').val();
            let y = $('select[name=select_tahun]').val();

            $("#monthyear").text(key[m] + " " + y);

            var my = key[m] + "%20" + y;

            return my;
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

        //Fungsi Kirim Whatsapp
        function sendWhatsapp() {
            var monthyear = generateMonthYear();
            var totalPengeluaran = getTotalPengeluaran();
            let m = $('select[name=select_bulan]').val();
            let y = $('select[name=select_tahun]').val();
            var text = "Laporan%20Keuangan%20SN%20%0ANoorman%20-%20" + monthyear + "%0A%0ATotal%20Pengeluaran%20%3A%20Rp%20" + formatRupiah(totalPengeluaran.toString()) + "%0A%0ASelengkapnya%20%3A%20%0Asys.sasanangapak.com%2Flaporan%2Fpreview%2F" + m + "%2F" + y + ""
            var url = "https://wa.me/?text=" + text + "";

            return window.open(url, '_blank');
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