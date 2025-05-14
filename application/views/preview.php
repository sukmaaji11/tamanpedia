    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Preview - Laporan Keuangan</title>

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
        <input type="hidden" name="start_date" value="<?= $start_date; ?>">
        <input type="hidden" name="end_date" value="<?= $end_date ?>">
        <div id="app">
            <div id="main" style="margin-left: 0px;">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="text-center">
                                <div class="d-block">
                                    <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                                </div>
                                <h3>Tamanpedia</h3>
                                <p class="text-subtitle text-muted">Sistem Keuangan Tamanpedia</p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <!-- Section 2 -->
                        <div class="report visible">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Laporan Keuangan <button onclick="sendWhatsapp()" type="button" class="btn btn-sm btn-primary"> <i class="bi bi-share"></i>
                                            Share</button>
                                    </h6>
                                    <p>Admin - <span id="monthyear">2025</span></p>
                                </div>
                                <div class="card-body">
                                    <div class="report-data">


                                    </div>

                                    <hr />

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
                <p>2022 &copy; Jadicuan Developer V.01 Beta</p>
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
            generateFinancialReport();
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
            $('.report-data').html('<div class="text-center">Loading...</div>');

            Promise.all([
                getPemasukanReport(startDate, endDate),
                getPengeluaranReport(startDate, endDate)
            ]).then(([pemasukanData, pengeluaranData]) => {
                // Calculate totals
                const totalPemasukan = pemasukanData.reduce((sum, item) => sum + parseFloat(item.pemasukan_total), 0);
                const totalPengeluaran = pengeluaranData.reduce((sum, item) => sum + parseFloat(item.pengeluaran_total), 0);
                const danaTersedia = totalPemasukan - totalPengeluaran;

                console.log(danaTersedia);

                // Build report HTML

                const reportHtml = `
     <div class="report-section">
                <p>Period: </p>
                <p class="text-small">${startDate} to ${endDate}</p>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Pemasukan</h5>
                                <div class="text-success">${formatRupiah(totalPemasukan.toString())}</div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Pengeluaran</h5>
                                <div class="text-danger">${formatRupiah(totalPengeluaran.toString())}</div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Dana Tersedia</h5>
                                <div class="text-primary">${formatRupiah(danaTersedia.toString())}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="mt-4">
                    <h5 class="mb-4">Detail Transaksis</h5>
                    <div class="row">
                        <div class="col mb-4">
                            <h6>Detail Pemasukan</h6>
                            ${renderTransactionList(pemasukanData, 'success')}
                        </div>
                        <hr />
                        <div class="col">
                            <h6>Detail Pengeluaran</h6>
                            ${renderTransactionList(pengeluaranData, 'danger')}
                        </div>
                    </div>
                </div>
            </div>
        `;
                $('.report').removeClass('invisible');
                $('.report-data').html(reportHtml);
            }).catch(error => {
                console.error('Error:', error);
                $('.report-data').html('<div class="alert alert-danger">Error loading report data</div>');
            });
        }


        //Fungsi Kirim Whatsapp
        function sendWhatsapp() {
            const startDate = $('[name="start_date"]').val();
            const endDate = $('[name="end_date"]').val();

            Promise.all([
                getPemasukanReport(startDate, endDate),
                getPengeluaranReport(startDate, endDate)
            ]).then(([pemasukanData, pengeluaranData]) => {
                // Calculate totals
                const totalPemasukan = pemasukanData.reduce((sum, item) => sum + parseFloat(item.pemasukan_total), 0);
                const totalPengeluaran = pengeluaranData.reduce((sum, item) => sum + parseFloat(item.pengeluaran_total), 0);
                const danaTersedia = totalPemasukan - totalPengeluaran;
                var text = "Laporan%20Keuangan%20Tamanpedia%20-%20" + startDate + " " + "to" + " " + endDate + "%0A%0ATotal%20Pengeluaran%20%3A%20Rp%20" + formatRupiah(danaTersedia.toString()) + "%0A%0ATotal%20Pemasukan%20%3A%20Rp%20" + formatRupiah(totalPemasukan.toString()) + "%0A%0ADana%20Tersedia%20%3A%20Rp%20" + formatRupiah(totalPengeluaran.toString()) + "%0A%0ASelengkapnya%20%3A%20%0Atamanpedia.bra-dev.com%2Flaporan%2Fpreview%2F" + startDate + "%2F" + endDate + "";
                var url = "https://wa.me/?text=" + text + "";

                return window.open(url, '_blank');

            }).catch(error => {
                console.error('Error:', error);
            });
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
                        <strong>${item.pemasukan || item.pengeluaran}</strong><br>
                        <small>${item.pemasukan_keterangan || item.pengeluaran_keterangan}</small>
                        <br />
                        <small>${item.pemasukan_tgl || item.pengeluaran_tgl}</small>
                    </div>
                    <span class="text-${textClass}">${formatRupiah(item.pemasukan_total || item.pengeluaran_total)}</span>
                </li>
            `).join('')}
        </ul>
    `;
        }
    </script>