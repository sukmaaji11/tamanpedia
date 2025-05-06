   <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                    </div>
                    <h3>Pemasukan</h3>
                    <p class="text-subtitle text-muted">Pemasukan Tamanpedia.</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Pemasukan</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-small btn-success" data-bs-toggle="modal" data-bs-target="#modal_pemasukan">+ Tambah</button>
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted font-semibold">Tahun ini</h6>
                                    <h6 class="font-extrabold mb-0" id="pemasukan_tahun_ini">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr />
            <!-- Section 3 -->
            <h6 class="card-title mb-2">Pemasukan Terbaru</h6>
            <div class="col-12" id="data-pemasukan">    
                
            </div>
            <a href="<?= base_url('pemasukan') ?>" class="btn btn-sm btn-primary">Selengkapnya</a>

            <hr />
        </section>

        <!-- MODAL PEMASUKAN -->
        <div class="modal fade" id="modal_pemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pemasukan
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="form-pemasukan">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pemasukan_tgl text-sm">Tanggal</label>
                                            <input type="date" id="pemasukan_tgl" class="form-control" name="pemasukan_tgl" required>  
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="pemasukan_kategori text-sm">Kategori Pemasukan</label>
                                            <select class="form form-select pemasukan_kategori" name="pemasukan_kategori" id="pemasukan_kategori" required>
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
                                            <label for="pemasukan_sumber text-sm">Kontributor</label>
                                            <input type="text" id="pemasukan_sumber" class="form-control" name="pemasukan_sumber" placeholder="Cth: Sumarno" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="pemasukan_total" class="form-control pemasukan_total rupiah" placeholder="0" aria-label="Total" aria-describedby="basic-addon1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" placeholder="Keterangan" name="pemasukan_keterangan" id="floatingTextarea" rows="5" required></textarea>
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
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-add-pemasukan">
                            <span class="d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
            getToday();
            getMonth();
            getYear();
            renderPemasukan();
        });
        
        //BTN ADD Pemasukan
        $('#btn-add-pemasukan').on('click', function() {
            // Get CSRF token
            var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
            
            // Get form values
            var formData = {
                [csrfName]: csrfHash, // Include CSRF token
                'pemasukan_kategori': $('select[name=pemasukan_kategori]').val(),
                'pemasukan_tgl': $('input[name=pemasukan_tgl]').val(),
                'pemasukan_sumber': $('input[name=pemasukan_sumber]').val(),
                'pemasukan_total': $('input[name=pemasukan_total]').val(),
                'pemasukan_keterangan': $('textarea[name=pemasukan_keterangan]').val()
            };

            // Convert numeric value properly
            if (formData.pemasukan_total) {
                formData.pemasukan_total = parseFloat(
                    formData.pemasukan_total.replace(/[^0-9.]/g, '')
                ) || 0;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("pemasukan/add"); ?>', // Specify full URL
                data: formData,
                dataType: 'json', // Expect JSON response
                beforeSend: function() {
                    $('#btn-add-pemasukan').prop('disabled', true);
                },
                complete: function() {
                    $('#btn-add-pemasukan').prop('disabled', false);
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Data Berhasil Disimpan!');
                        window.location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan: ';
                    try {
                        const res = JSON.parse(xhr.responseText);
                        errorMessage += res.message || xhr.statusText;
                    } catch(e) {
                        errorMessage += xhr.statusText;
                    }
                    alert(errorMessage);
                }
            });
        });


        function renderPemasukan() {
            $.ajax({
                url: '<?= base_url('pemasukan/get_data') ?>',
                async: true,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    var i;
                    var html = '';
                    if (response.length != 0) {
                        for (i = 0; i < 5; i++) {
                            html += '<div class="card">';
                            html += '<div class="card-content">';
                            html += '<div class="card-body">';
                            html += '<p class="text-right" style="text-align:right;">' + response[i].pemasukan_tgl + '</p>';
                            html += '<h6 class="">' + response[i].pemasukan + '</h6>';
                            html += '<p>' + response[i].pemasukan_keterangan + '</p>';
                            html += '<hr />';
                            html += '<h6>Rp. ' + formatRupiah(response[i].pemasukan_total) + '</h6>';
                            html += '</div></div></div>';
                        }
                        $('#data-pemasukan').html(html);
                    } else {
                        html = "<div class='card'>";
                        html += "<div class='card-content'>";   
                        html += "<div class='card-body'>";
                        html += "<h6 class='text-center'>Data Kosong</h6>";
                        html += "</div></div></div>";
                        $('#data-pemasukan').html(html);
                    }
                }
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
                url: '<?= base_url('pemasukan/get_data_by_date') ?>',
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
                    $('#pemasukan_hari_ini').text("Rp. " + formatRupiah(sum.toString()))
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
                url: '<?= base_url('pemasukan/get_data_by_date') ?>',
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
                    $('#pemasukan_bulan_ini').text("Rp. " + formatRupiah(sum.toString()))
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
                url: '<?= base_url('pemasukan/get_data_by_date') ?>',
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
                    $('#pemasukan_tahun_ini').text("Rp. " + formatRupiah(sum.toString()))
                },
            })
        }
    </script>