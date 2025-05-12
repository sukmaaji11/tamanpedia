    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                    </div>
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Tamanpedia</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dana Tersedia</h4>
                </div>
                <div class="card-body" id="dana-tersedia">
                    <h6 class="font-extrabold mb-0" id="dana-tersedia-total">112.000</h6>
                </div>
                <div class="d-block text-center mb-3">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_kategori">+ Pemasukan</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_kategori">+ Pengeluaran</button>
                </div>
            </div>

            <hr />
            <!-- Section 2 -->
            <h6 class="card-title mb-2">Data Pemasukan</h6>
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted font-semibold">Hari ini</h6>
                                    <h6 class="font-extrabold mb-0" id="pemasukan_hari_ini">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted font-semibold">Bulan ini</h6>
                                    <h6 class="font-extrabold mb-0" id="pemasukan_bulan_ini">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2 -->
            <h6 class="card-title mb-2">Data Pengeluaran</h6>
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted font-semibold">Hari ini</h6>
                                    <h6 class="font-extrabold mb-0" id="pengeluaran_hari_ini">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted font-semibold">Bulan ini</h6>
                                    <h6 class="font-extrabold mb-0" id="pengeluaran_bulan_ini">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr />
        </section>
    </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.sidebar-item').removeClass('active');
            $('#sidebar-dashboard').addClass('active');
            $('.rupiah').priceFormat({
                prefix: '',
                centsLimit: 0,
                thousandSeparator: ','
            });
            $('.rupiah_satuan').priceFormat({
                prefix: '',
                centsLimit: 0,
                thousandSeparator: ','
            });
            getTodayPemasukan();
            getMonthPemasukan();
            getTodayPengeluaran();
            getMonthPengeluaran();
            getDanaTersedia(getAllPemasukan, getAllPengeluaran);
        });

        function getTodayPemasukan() {
            const padNumber = num => num.toString().padStart(2, '0'); // Helper for date formatting
            const today = new Date();

            // Format dates as YYYY-MM-DD
            const dateString = `${today.getFullYear()}-${padNumber(today.getMonth() + 1)}-${padNumber(today.getDate())}`;

            $.ajax({
                    type: 'GET', // Changed to GET as we're fetching data
                    url: '<?= base_url('pemasukan/get_data_by_date') ?>',
                    dataType: 'json',
                    data: {
                        datefrom: dateString,
                        dateto: dateString
                    }
                })
                .done(response => {
                    // 1. Access the nested array
                    const items = response.data || [];

                    // 2. Validate structure
                    const isValidResponse = (
                        Array.isArray(items) &&
                        items.length > 0 &&
                        items.every(item => 'pemasukan_total' in item)
                    );

                    // 3. Calculate total
                    const total = isValidResponse ?
                        items.reduce((sum, item) => sum + (Number(item.pemasukan_total) || 0), 0) :
                        0;

                    $('#pemasukan_hari_ini').html(`<span class="currency-symbol">Rp</span>${formatRupiah(total.toString())}`);
                })
                .fail((xhr, status, error) => {
                    console.error('Error fetching today\'s data:', error);
                    $('#pemasukan_hari_ini').html(`<span class="error-text">Gagal memuat data</span>`);
                });
        }

        function getMonthPemasukan() {
            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth() + 1; // 1-12

            // Get first and last day of month
            const firstDay = `${year}-${String(month).padStart(2,'0')}-01`;
            const lastDay = new Date(year, month, 0).getDate(); // Handles varying month lengths

            $.ajax({
                    type: 'GET',
                    url: '<?= base_url('pemasukan/get_data_by_dateMonthly') ?>',
                    dataType: 'json',
                    data: {
                        datefrom: firstDay,
                        dateto: `${year}-${String(month).padStart(2,'0')}-${lastDay}`
                    }
                })
                .done(response => {
                    const items = response.data || [];
                    const total = items.reduce((sum, item) => sum + (Number(item.pemasukan_total) || 0), 0);
                    $('#pemasukan_bulan_ini').html(`<span class="currency-symbol">Rp</span>${formatRupiah(total.toString())}`);
                })
                .fail(error => {
                    console.error('Error:', error);
                    $('#pemasukan_bulan_ini').html('Gagal memuat data');
                });
        }

        function getTodayPengeluaran() {
            const tgl = new Date();
            let d = tgl.getDate();
            let m = tgl.getMonth() + 1;
            let y = tgl.getFullYear();

            var datefrom = y + "-" + m + "-" + d;
            var dateto = y + "-" + m + "-" + d;

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/get_data_by_date') ?>',
                dataType: 'json',
                data: {
                    'datefrom': datefrom,
                    'dateto': dateto
                },
                success: function(response) {
                    var i;
                    var sum = 0;
                    if (response.length != 0) {
                        for (i = 0; i < response.length; i++) {
                            sum += parseInt(response[i].pengeluaran_total)
                        }
                    }
                    $('#pengeluaran_hari_ini').text("Rp. " + formatRupiah(sum.toString()))
                },
            })
        }

        function getMonthPengeluaran() {
            const tgl = new Date();
            let d = tgl.getDate();
            let m = tgl.getMonth() + 1;
            let y = tgl.getFullYear();

            var datefrom = y + "-" + m + "-" + "01";
            var dateto = y + "-" + m + "-" + "31";


            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/get_data_by_date') ?>',
                dataType: 'json',
                data: {
                    'datefrom': datefrom,
                    'dateto': dateto
                },
                success: function(response) {
                    var i;
                    var sum = 0;
                    if (response.length != 0) {
                        for (i = 0; i < response.length; i++) {
                            sum += parseInt(response[i].pengeluaran_total)
                        }
                    }
                    $('#pengeluaran_bulan_ini').text("Rp. " + formatRupiah(sum.toString()))
                },
            })
        }

        function getDanaTersedia(pemasukan, pengeluaran) {
            total = pemasukan - pengeluaran;
            $('#dana-tersedia-total').text("Rp. " + formatRupiah(sum.toString()));
        }

        function getAllPemasukan() {
            $.ajax({
                url: '<?= base_url('pemasukan/get_data') ?>',
                async: true,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    var i;
                    var sum = 0;
                    if (response.length != 0) {
                        for (i = 0; i < response.length; i++) {
                            sum += parseInt(response[i].pengeluaran_total)
                        }
                    }
                },
            });
            return sum;
        }

        function getAllPengeluaran() {
            $.ajax({
                url: '<?= base_url('pengeluaran/get_data') ?>',
                async: true,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    var i;
                    var sum = 0;
                    if (response.length != 0) {
                        for (i = 0; i < response.length; i++) {
                            sum += parseInt(response[i].pengeluaran_total)
                        }
                    }
                },
            });
            return sum;
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