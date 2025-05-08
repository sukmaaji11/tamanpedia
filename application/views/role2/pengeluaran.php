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
                        <form class="form form-vertical" id="form-pemasukan">
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
                                                <input type="file" name="pemasukan_img_filename" class="form-control pemasukan_img_filename rupiah" placeholder="0" aria-label="Total" aria-describedby="basic-addon1" required>
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
            renderPengeluaran();
        });

        //BTN NEXT 
        $('#btn-next').on('click', function() {
            var kategori = get_selected_id();
            console.log(kategori);
            if (kategori == "") {
                alert('Kategori Tidak Boleh Kosong');
            } else if (kategori == "KANDANG") {
                $("#modal_kategori").modal('hide');
                $("#modal_kandang").modal('show');
            } else if (kategori == "LAIN-LAIN") {
                $("#modal_kategori").modal('hide');
                $("#modal_lain").modal('show');
            } else if (kategori == "PROD.(IDHAM)") {
                $("#modal_kategori").modal('hide');
                $("#modal_prodidh").modal('show');
            } else if (kategori == "PROD.(HARY)") {
                $("#modal_kategori").modal('hide');
                $("#modal_prodhar").modal('show');
            } else if (kategori == "REK.LAIN") {
                $("#modal_kategori").modal('hide');
                $("#modal_reklain").modal('show');
            } else if (kategori == "PROYEK") {
                $("#modal_kategori").modal('hide');
                $("#modal_proyek").modal('show');
            } else {
                alert("EROR");
            }
        })

        //BTN KANDANG
        $('#btn-pengeluaran-kandang').on('click', function() {
            var pengeluaran = $('input[name=pengeluaran_kandang]').val();
            var kategori = "KANDANG";
            var tgl_pengeluaran = $('input[name=tgl_pengeluaran_kandang]').val();
            var jenis_barang = $('input[name=pengeluaran_jenis_barang]').val();
            var jumlah_barang = $('input[name=satuan_pengeluaran_kandang]').val();
            var harga_satuan = $('input[name=harga_satuan_pengeluaran_kandang]').val();
            var total = $('input[name=total_pengeluaran_kandang]').val();
            var keterangan = $('textarea[name=keterangan_pengeluaran_kandang]').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/add') ?>',
                data: {
                    'pengeluaran': pengeluaran,
                    'kategori': kategori,
                    'tgl_pengeluaran': tgl_pengeluaran,
                    'jenis_barang': jenis_barang,
                    'jumlah_barang': jumlah_barang,
                    'harga_satuan': harga_satuan.replace(/,(?=\d{3})/g, ''),
                    'total': total.replace(/,(?=\d{3})/g, ''),
                    'keterangan': keterangan
                },
                beforeSend: function() {
                    $('#btn-pengeluaran-kandang').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Disimpan!');
                    location.reload();
                }
            })
        })

        //BTN LAIN-LAIN
        $('#btn-pengeluaran-lain').on('click', function() {
            var pengeluaran = $('input[name=pengeluaran_lain]').val();
            var kategori = "LAIN-LAIN";
            var tgl_pengeluaran = $('input[name=tgl_pengeluaran_lain]').val();
            var jenis_barang = "-"
            var jumlah_barang = "-"
            var harga_satuan = "-"
            var total = $('input[name=total_pengeluaran_lain]').val();
            var keterangan = $('textarea[name=keterangan_pengeluaran_lain]').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/add') ?>',
                data: {
                    'pengeluaran': pengeluaran,
                    'kategori': kategori,
                    'tgl_pengeluaran': tgl_pengeluaran,
                    'jenis_barang': jenis_barang,
                    'jumlah_barang': jumlah_barang,
                    'harga_satuan': harga_satuan,
                    'total': total.replace(/,(?=\d{3})/g, ''),
                    'keterangan': keterangan
                },
                beforeSend: function() {
                    $('#btn-pengeluaran-lain').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Disimpan!');
                    location.reload();
                }
            })
        })

        //BTN PROD IDHAM
        $('#btn-pengeluaran-prodidh').on('click', function() {
            var pengeluaran = $('input[name=pengeluaran_prodidh]').val();
            var kategori = "PROD.(IDHAM)";
            var tgl_pengeluaran = $('input[name=tgl_pengeluaran_prodidh]').val();
            var jenis_barang = "-"
            var jumlah_barang = "-"
            var harga_satuan = "-"
            var total = $('input[name=total_pengeluaran_prodidh]').val();
            var keterangan = $('textarea[name=keterangan_pengeluaran_prodidh]').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/add') ?>',
                data: {
                    'pengeluaran': pengeluaran,
                    'kategori': kategori,
                    'tgl_pengeluaran': tgl_pengeluaran,
                    'jenis_barang': jenis_barang,
                    'jumlah_barang': jumlah_barang,
                    'harga_satuan': harga_satuan,
                    'total': total.replace(/,(?=\d{3})/g, ''),
                    'keterangan': keterangan
                },
                beforeSend: function() {
                    $('#btn-pengeluaran-prodidh').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Disimpan!');
                    location.reload();
                }
            })
        })

        //BTN PROD HARRY
        $('#btn-pengeluaran-prodhar').on('click', function() {
            var pengeluaran = $('input[name=pengeluaran_prodhar]').val();
            var kategori = "PROD.(HARY)";
            var tgl_pengeluaran = $('input[name=tgl_pengeluaran_prodhar]').val();
            var jenis_barang = "-"
            var jumlah_barang = "-"
            var harga_satuan = "-"
            var total = $('input[name=total_pengeluaran_prodhar]').val();
            var keterangan = $('textarea[name=keterangan_pengeluaran_prodhar]').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/add') ?>',
                data: {
                    'pengeluaran': pengeluaran,
                    'kategori': kategori,
                    'tgl_pengeluaran': tgl_pengeluaran,
                    'jenis_barang': jenis_barang,
                    'jumlah_barang': jumlah_barang,
                    'harga_satuan': harga_satuan,
                    'total': total.replace(/,(?=\d{3})/g, ''),
                    'keterangan': keterangan
                },
                beforeSend: function() {
                    $('#btn-pengeluaran-prodhar').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Disimpan!');
                    location.reload();
                }
            })
        })


        //BTN REK LAIN
        $('#btn-pengeluaran-reklain').on('click', function() {
            var pengeluaran = $('input[name=pengeluaran_reklain]').val();
            var kategori = "REK.LAIN";
            var tgl_pengeluaran = $('input[name=tgl_pengeluaran_reklain]').val();
            var jenis_barang = "-"
            var jumlah_barang = "-"
            var harga_satuan = "-"
            var total = $('input[name=total_pengeluaran_reklain]').val();
            var keterangan = $('textarea[name=keterangan_pengeluaran_reklain]').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/add') ?>',
                data: {
                    'pengeluaran': pengeluaran,
                    'kategori': kategori,
                    'tgl_pengeluaran': tgl_pengeluaran,
                    'jenis_barang': jenis_barang,
                    'jumlah_barang': jumlah_barang,
                    'harga_satuan': harga_satuan,
                    'total': total.replace(/,(?=\d{3})/g, ''),
                    'keterangan': keterangan
                },
                beforeSend: function() {
                    $('#btn-pengeluaran-reklain').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Disimpan!');
                    location.reload();
                }
            })
        })

        //BTN PROYEK
        $('#btn-pengeluaran-proyek').on('click', function() {
            var pengeluaran = $('input[name=pengeluaran_proyek]').val();
            var kategori = "PROYEK";
            var tgl_pengeluaran = $('input[name=tgl_pengeluaran_proyek]').val();
            var jenis_barang = "-"
            var jumlah_barang = "-"
            var harga_satuan = "-"
            var total = $('input[name=total_pengeluaran_proyek]').val();
            var keterangan = $('textarea[name=keterangan_pengeluaran_proyek]').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/add') ?>',
                data: {
                    'pengeluaran': pengeluaran,
                    'kategori': kategori,
                    'tgl_pengeluaran': tgl_pengeluaran,
                    'jenis_barang': jenis_barang,
                    'jumlah_barang': jumlah_barang,
                    'harga_satuan': harga_satuan,
                    'total': total.replace(/,(?=\d{3})/g, ''),
                    'keterangan': keterangan
                },
                beforeSend: function() {
                    $('#btn-pengeluaran-proyek').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Disimpan!');
                    location.reload();
                }
            })
        })

        function renderPengeluaran() {
            $.ajax({
                url: '<?= base_url('pengeluaran/get_data') ?>',
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
                            html += '<p class="text-right" style="text-align:right;">' + response[i].pengeluaran_tgl + '</p>';
                            html += '<h6 class="">' + response[i].pengeluaran + '</h6>';
                            html += '<p>' + response[i].pengeluaran_keterangan + '</p>';
                            html += '<hr />';
                            html += '<h6>Rp. ' + formatRupiah(response[i].pengeluaran_total) + '</h6>';
                            html += '</div></div></div>';
                        }
                        $('#data-pengeluaran').html(html);
                    } else {
                        $('#data-pengeluaran').html(response);
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