    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                    </div>
                    <h3>Pengeluaran</h3>
                    <p class="text-subtitle text-muted">Pengeluaran Tamanpedia.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-small btn-success" data-bs-toggle="modal" data-bs-target="#modal_pengeluaran">+ Tambah</button>
                </div>
            </div>

            <hr />
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted font-semibold">Tahun ini</h6>
                                    <h6 class="font-extrabold mb-0" id="pengeluaran_tahun_ini">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr />
            <!-- Section 3 -->
            <h6 class="card-title mb-2">Pengeluaran Terbaru</h6>
            <div class="col-12" id="data-pengeluaran">

            </div>
            <a href="<?= base_url('pengeluaran') ?>" class="btn btn-sm btn-primary">Selengkapnya</a>

            <hr />
        </section>

        <!-- MODAL PEMASUKAN -->
        <div class="modal fade" id="modal_pengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="form-pengeluaran">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pengeluaran_tgl text-sm">Tanggal</label>
                                            <input type="date" id="p" class="pengeluaran_tgl form-control" name="pengeluaran_tgl" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pengeluaran_kategori text-sm">Kategori Pengeluaran</label>
                                            <select class="form form-select pengeluaran_kategori" name="pengeluaran_kategori" id="pengeluaran_kategori" required>
                                                <option value=" "></option>
                                                <?php
                                                $i = 0;
                                                foreach ($kategori as $kt) : ?>
                                                    <option value="<?= $kt->kategori_id ?>"><?= $kt->kategori; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pengeluaran text-sm">Pengeluaran</label>
                                            <input type="text" id="pengeluaran" class="form-control" name="pengeluaran" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="pengeluaran_total" class="form-control pengeluaran_total rupiah" placeholder="0" aria-label="Total" aria-describedby="basic-addon1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Nota/Bukti Transaksi</label>
                                            <div class="input-group mb-3">
                                                <input type="file" name="pemasukan_img_filename" class="form-control pemasukan_img_filename" id="pengeluaranImg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" placeholder="Keterangan" name="pengeluaran_keterangan" id="floatingTextarea" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-add-pengeluaran">
                            <span class="d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- END -->
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.sidebar-item').removeClass('active');
            $('#sidebar-pengeluaran').addClass('active');
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
            getToday();
            getMonth();
            getYear();
            renderPengeluaran();
        });

        // BTN ADD Pengeluaran
        $('#btn-add-pengeluaran').on('click', function() {
            // Get CSRF token
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

            // Get form values
            var formData = {
                [csrfName]: csrfHash, // Include CSRF token
                'pengeluaran_kategori': $('select[name=pengeluaran_kategori]').val(),
                'pengeluaran_tgl': $('input[name=pengeluaran_tgl]').val(),
                'pengeluaran': $('input[name=pengeluaran]').val(),
                'pengeluaran_total': $('input[name=pengeluaran_total]').val(),
                'pengeluaran_keterangan': $('textarea[name=pengeluaran_keterangan]').val()
            };

            // Convert numeric value properly
            if (formData.pengeluaran_total) {
                formData.pengeluaran_total = parseFloat(
                    formData.pengeluaran_total.replace(/[^0-9.]/g, '')
                ) || 0;
            }

            $.ajax({
                type: 'POST',
                url: '<?= site_url("pengeluaran/add") ?>',
                data: formData,
                dataType: 'json', // 👈 Critical for JSON parsing
                success: function(response) {
                    if (response.status === 'success') {
                        getToday();
                        getMonth();
                        getYear();
                        renderPengeluaran();
                        showSuccessAlert('Data berhasil disimpan!');
                    } else {
                        showErrorAlert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    var url = '<?= site_url("pengeluaran/add") ?>';
                    console.log(url);
                    console.error("AJAX Error:", xhr.responseText);
                    alert('Terjadi kesalahan. Cek konsol untuk detail.');
                }
            });
        });

        // Helper functions
        function showSuccessAlert(message) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: message
            });
        }

        function showErrorAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message
            });
        }

        function refreshPengeluaranData() {
            // Your logic to refresh pengeluaran list
        }


        function renderPengeluaran() {
            $.ajax({
                    url: '<?= base_url('pengeluaran/get_data') ?>',
                    type: 'POST',
                    dataType: 'json'
                })
                .done(function(response) {
                    const container = $('#data-pengeluaran');
                    let html = '';
                    // Check if response is valid and has data
                    if (Array.isArray(response) && response.length > 0) {
                        // Show maximum 5 items
                        const itemsToShow = response.slice(0, 5);
                        itemsToShow.forEach(item => {
                            html += `
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="text-right">
                                            ${item.pengeluaran_tgl || '-'}
                                        </div>
                                        <h6>${item.pengeluaran || 'No Information'}</h6>
                                        <p>${item.pengeluaran_keterangan || 'No Description'}</p>
                                        <hr>
                                        <h6>Rp. ${formatRupiah(item.pengeluaran_total?.toString() || '0')}</h6>
                                    </div>
                                </div>
                            </div>`;
                        });
                    } else {
                        html = `
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <h6>Data Kosong</h6>
                                    </div>
                                </div>
                            </div>`;
                    }
                    container.html(html);
                })
                .fail(function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    $('#data-pengeluaran').html(`
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body text-center text-danger">
                                <h6>Gagal memuat data</h6>
                            </div>
                        </div>
                    </div>`);
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

        //Get Selected Value ID 
        function get_selected_id() {
            var e = document.getElementById('select_kategori');
            var value = e.value;
            var text = e.options[e.selectedIndex].text;
            return text;
        }

        function getToday() {
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

        function getMonth() {
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

        function getYear() {
            const tgl = new Date();
            let d = tgl.getDate();
            let m = tgl.getMonth() + 1;
            let y = tgl.getFullYear();

            var datefrom = y + "-" + "1" + "-" + "1";
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
                    $('#pengeluaran_tahun_ini').text("Rp. " + formatRupiah(sum.toString()))
                },
            })
        }
    </script>