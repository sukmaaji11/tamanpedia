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
                        <div class="report-data">


                        </div>

                        <hr />

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
                    <hr />
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Expenses</h5>
                                <div class="text-danger">${formatRupiah(totalPengeluaran.toString())}</div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Available Funds</h5>
                                <div class="text-primary">${formatRupiah(danaTersedia.toString())}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="mt-4">
                    <h5>Detailed Transactions</h5>
                    <div class="row">
                        <div class="col mb-4">
                            <h6>Income Details</h6>
                            ${renderTransactionList(pemasukanData, 'success')}
                        </div>
                        <hr />
                        <div class="col">
                            <h6>Expense Details</h6>
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
                        <small>${item.pemasukan?.pemasukan_tgl || item.pengeluaran?.pengeluaran_tgl}</small>
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