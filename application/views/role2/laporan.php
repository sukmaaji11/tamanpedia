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
                            <button type="button" id="generate-report-btn" class="btn btn-sm btn-success">Generate</button>
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

        // 1. Function to get Pengeluaran (Expenses) data
        function getPengeluaranReport(startDate, endDate) {
            return $.ajax({
                url: '<?= base_url('pengeluaran/get_report') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    start_date: startDate,
                    end_date: endDate
                }
            });
        }

        // 2. Function to get Pemasukan (Income) data
        function getPemasukanReport(startDate, endDate) {
            return $.ajax({
                url: '<?= base_url('pemasukan/get_report') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    start_date: startDate,
                    end_date: endDate
                }
            });
        }

        // 3. Function to calculate and display report
        function generateFinancialReport() {
            const startDate = $('[name="start_date"]').val();
            const endDate = $('[name="end_date"]').val();

            if (!startDate || !endDate) {
                alert('Please select both start and end dates');
                return;
            }

            // Show loading indicator
            $('#report').html('<div class="text-center">Loading...</div>');

            Promise.all([
                getPemasukanReport(startDate, endDate),
                getPengeluaranReport(startDate, endDate)
            ]).then(([pemasukanData, pengeluaranData]) => {
                // Calculate totals
                const totalPemasukan = pemasukanData.reduce((sum, item) => sum + parseFloat(item.pemasukan_total), 0);
                const totalPengeluaran = pengeluaranData.reduce((sum, item) => sum + parseFloat(item.pengeluaran_total), 0);
                const danaTersedia = totalPemasukan - totalPengeluaran;

                // Build report HTML

                const reportHtml = `
            <div class="report-section">
                <p>Period: ${startDate} to ${endDate}</p>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Income</h5>
                                <div class="text-success">${formatRupiah(totalPemasukan.toString())}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Expenses</h5>
                                <div class="text-danger">${formatRupiah(totalPengeluaran.toString())}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Available Funds</h5>
                                <div class="text-primary">${formatRupiah(danaTersedia.toString())}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5>Detailed Transactions</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Income Details</h6>
                            ${renderTransactionList(pemasukanData, 'success')}
                        </div>
                        <div class="col-md-6">
                            <h6>Expense Details</h6>
                            ${renderTransactionList(pengeluaranData, 'danger')}
                        </div>
                    </div>
                </div>
            </div>
        `;
                $('.report').removeClass('invisible');
                $('.report').html(reportHtml);
            }).catch(error => {
                console.error('Error:', error);
                $('.report').html('<div class="alert alert-danger">Error loading report data</div>');
            });
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
        // Helper function to render transaction lists
        function renderTransactionList(data, textClass) {
            if (data.length === 0) return '<div class="text-muted">No transactions found</div>';

            return `
        <ul class="list-group">
            ${data.map(item => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${item.pemasukan?.pemasukan_kategori || item.pengeluaran?.pengeluaran_kategori}</strong><br>
                        <small>$${item.pemasukan?.pemasukan_tgl || item.pengeluaran?.pengeluaran_tgl}</small>
                    </div>
                    <span class="text-${textClass}">${formatRupiah(item.pemasukan_total || item.pengeluaran_total)}</span>
                </li>
            `).join('')}
        </ul>
    `;
        }

        // Add event listener for report generation
        $('#generate-report-btn').click(function(e) {
            e.preventDefault();
            generateFinancialReport();
        });
    </script>