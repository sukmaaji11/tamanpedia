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
    <style>
        /* Custom Styling */
        .section-title {
            color: #2c3e50;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .totals-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
    </style>

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

            Promise.all([
                getPemasukanReport(startDate, endDate),
                getPengeluaranReport(startDate, endDate)
            ]).then(([pemasukanData, pengeluaranData]) => {
                const reportHtml = `
                    <div class="report-section">
                        <p class="periode">Periode : </p>
                        <p>${formatDate(startDate)} - ${formatDate(endDate)}</p>
                                      
                        <!-- Totals Section -->
                        <div class="totals-section mt-4">
                            ${renderTotalSummary(pemasukanData.summary, pengeluaranData.summary)}
                        </div>
                        
                        <!-- Income Section -->
                        ${renderFinancialSection('Pemasukan', pemasukanData.summary, pemasukanData.details, 'success')}
                        
                        <!-- Expenses Section -->
                        ${renderFinancialSection('Pengeluaran', pengeluaranData.summary, pengeluaranData.details, 'danger')}
          
                    </div>
                `;
                $('.report-data').html(reportHtml);
            }).catch(error => {
                console.error('Error:', error);
                $('.report-data').html('<div class="alert alert-danger">Error loading report data</div>');
            });
        }

        // Helper function to render complete financial section
        function renderFinancialSection(title, summaryData, detailsData, themeColor) {
            return `
                <div class="financial-section mt-5 mb-2">
                    <h5 class="section-title">${title}</h5>
                    <div class="category-summary mb-4">
                        <h6>By Category</h6>
                        <div class="row">
                            ${summaryData.map(item => renderSummaryCard(item, themeColor)).join('')}
                            ${summaryData.length === 0 ? '<div class="col-12 text-muted">No categories found</div>' : ''}
                        </div>
                    </div>
                    
                    <div class="transaction-details">
                        <h6>Detailed Transactions</h6>
                        ${renderDetailTable(detailsData, themeColor)}
                    </div>
                </div>
            `;
        }

        // Summary Card Component

        function renderSummaryCard(item, themeColor) {
            return `
                <div class="col-md-4">
                    <div class="card bg-light border-${themeColor}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">${item.kategori}</h6>
                                    <small class="text-muted">${item.transaction_count} transactions</small>
                                </div>
                                <div class="text-end">
                                    <div class="text-${themeColor}">${formatRupiah((item.total).toString())}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Detailed Transactions Table
        function renderDetailTable(data, themeColor) {
            if (data.length === 0) return '<div class="text-muted">No transactions found</div>';

            return `
                <div class="table-responsive">
                    <table class="table text-nowrap table-hover">
                        <thead class="table-${themeColor}">
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${data.map(item => `
                                <tr>
                                    <td>${formatDate(item.pemasukan_tgl || item.pengeluaran_tgl)}</td>
                                    <td>${item.pemasukan || item.pengeluaran || '-'}</td>
                                    <td>${item.pemasukan_keterangan || item.pengeluaran_keterangan || '-'}</td>
                                    <td class="text-end text-${themeColor}">
                                        ${formatRupiah((item.pemasukan_total || item.pengeluaran_total).toString())}
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `;
        }

        function renderTotalSummary(pemasukanSummary, pengeluaranSummary) {
            // Calculate totals
            const totalPemasukan = pemasukanSummary.reduce((sum, item) => sum + parseFloat(item.total), 0);
            const totalPengeluaran = pengeluaranSummary.reduce((sum, item) => sum + parseFloat(item.total), 0);
            const danaTersedia = totalPemasukan - totalPengeluaran;

            return `
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-success">
                            <div class="card-body">
                                <h5 class="card-title">Total Pemasukan</h5>
                                <div class="display-10 text-success">
                                    ${formatRupiah(totalPemasukan.toString(), true)}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-danger">
                            <div class="card-body">
                                <h5 class="card-title">Total Pengeluaran</h5>
                                <div class="display-10 text-danger">
                                    ${formatRupiah(totalPengeluaran.toString(), true)}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h5 class="card-title">Dana Tersedia</h5>
                                <div class="display-10 text-primary">
                                    ${formatRupiah(danaTersedia.toString(), true)}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }


        //Fungsi Kirim Whatsapp
        function sendWhatsapp() {
            const startDate = $('[name="start_date"]').val();
            const endDate = $('[name="end_date"]').val();

            Promise.all([
                getPemasukanReport(startDate, endDate),
                getPengeluaranReport(startDate, endDate)
            ]).then(([pemasukanData, pengeluaranData]) => {
                var tempPemasukan = pemasukanData.summary;
                var tempPengeluaran = pengeluaranData.summary;
                // Calculate totals
                const totalPemasukan = tempPemasukan.reduce((sum, item) => sum + parseFloat(item.total), 0);
                const totalPengeluaran = tempPengeluaran.reduce((sum, item) => sum + parseFloat(item.total), 0);
                const danaTersedia = totalPemasukan - totalPengeluaran;
                var text = "Laporan%20Keuangan%20Tamanpedia%20-%20" + startDate + " " + "to" + " " + endDate + "%0A%0ATotal%20Pengeluaran%20%3A%20Rp%20" + formatRupiah(totalPengeluaran.toString()) + "%0A%0ATotal%20Pemasukan%20%3A%20Rp%20" + formatRupiah(totalPemasukan.toString()) + "%0A%0ADana%20Tersedia%20%3A%20Rp%20" + formatRupiah(danaTersedia.toString()) + "%0A%0ASelengkapnya%20%3A%20%0Atamanpedia.bra-dev.com%2Flaporan%2Fpreview%2F" + startDate + "%2F" + endDate + "";
                var url = "https://wa.me/?text=" + text + "";

                return window.open(url, '_blank');

            }).catch(error => {
                console.error('Error:', error);
            });
        }

        //Format Rupiah
        function formatRupiah(angka, prefix) {
            // Check if number is negative
            const isNegative = angka.startsWith('-');

            // Clean number (allow negative sign)
            let number_string = angka.replace(/[^,\d-]/g, '').toString();

            // Remove negative sign for processing
            if (isNegative) {
                number_string = number_string.replace('-', '');
            }

            const split = number_string.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Add thousand separators
            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            // Add decimal part
            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;

            // Add negative sign back
            if (isNegative) {
                rupiah = '-' + rupiah;
            }

            // Add prefix if requested
            return prefix ?
                (isNegative ? '-Rp. ' : 'Rp. ') + rupiah.replace('-', '') :
                rupiah;
        }

        // Date Formatting Helpers
        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
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