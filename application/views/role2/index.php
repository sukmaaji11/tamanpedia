    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                    </div>
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Keuangan Tamanpedia</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dana Tersedia</h4>
                </div>
                <div class="card-body">
               
                </div>
            </div>  
            <div class="d-block text-center mb-3">
                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_kategori">+ Pemasukan</button>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal_kategori">+ Pengeluaran</button>
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
            <!-- Section 3 -->
            <h6 class="card-title mb-2">Pemasukan Terbaru</h6>
            <div class="col-12" id="data-pengeluaran">

            </div>
            <a href="<?= base_url('pengeluaran') ?>" class="btn btn-sm btn-primary">Selengkapnya</a>

            <hr />
            <!-- Section 4 -->
            <h6 class="card-title mb-2">Pengeluaran Terbaru</h6>
            <div class="col-12" id="data-pengeluaran">

            </div>
            <a href="<?= base_url('pengeluaran') ?>" class="btn btn-sm btn-primary">Selengkapnya</a>

            <hr />
        </section>

        <!-- Modal Kategori-->
        <div class="modal fade" id="modal_kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Kategori Pengeluaran</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="form-group">
                                <select class="form form-select" id="select_kategori">
                                    <option value=" "></option>
                                    <?php
                                    $i = 0;
                                    foreach ($kategori as $kt) : ?>
                                        <option value="<?= $kt->kategori_id ?>"><?= $kt->kategori; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-next">Next</button>
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL KANDANG -->
        <div class="modal fade" id="modal_kandang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran Kandang
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal</label>
                                            <input type="date" id="email-id-vertical" class="form-control" name="tgl_pengeluaran_kandang">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Pengeluaran Ke Toko / Penerima</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_kandang" placeholder="Contoh : Rincing PS">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Jenis Barang</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_jenis_barang" placeholder="Contoh : Pakan, Produksi dll">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Jumlah</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="satuan_pengeluaran_kandang" placeholder="5 KG">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Harga Satuan</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="harga_satuan_pengeluaran_kandang" class="form-control harga_satuan_pengeluaran_kandang rupiah_satuan" placeholder="0" aria-label="Harga" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total_pengeluaran_kandang" class="form-control total_pengeluaran_kandang rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" placeholder="Keterangan" name="keterangan_pengeluaran_kandang" id="floatingTextarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-pengeluaran-kandang">
                            <span class=" d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL LAIN-LAIN -->
        <div class="modal fade" id="modal_lain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran Lain-Lain
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal</label>
                                            <input type="date" id="email-id-vertical" class="form-control" name="tgl_pengeluaran_lain">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Pengeluaran</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_lain" placeholder="Contoh : Ongkir Furqon">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total_pengeluaran_lain" class="form-control total_pengeluaran_lain rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_pengeluaran_lain" placeholder="Keterangan" id="floatingTextarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-pengeluaran-lain">
                            <span class=" d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL PROD IDHAM -->
        <div class="modal fade" id="modal_prodidh" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran PROD.(IDHAM)
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal</label>
                                            <input type="date" id="email-id-vertical" class="form-control" name="tgl_pengeluaran_prodidh">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Pengeluaran</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_prodidh" placeholder="Contoh : Biaya Produksi">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total_pengeluaran_prodidh" class="form-control total_pengeluaran_prodidh rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_pengeluaran_prodidh" placeholder="Keterangan" id="floatingTextarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-pengeluaran-prodidh">
                            <span class=" d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL PROD HARY -->
        <div class="modal fade" id="modal_prodhar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran PROD.(HARY)
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal</label>
                                            <input type="date" id="email-id-vertical" class="form-control" name="tgl_pengeluaran_prodhar">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Pengeluaran</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_prodhar" placeholder="Contoh : Biaya Produksi">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total_pengeluaran_prodhar" class="form-control total_pengeluaran_prodhar rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_pengeluaran_prodhar" placeholder="Keterangan" id="floatingTextarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-pengeluaran-prodhar">
                            <span class=" d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL REK.LAIN -->
        <div class="modal fade" id="modal_reklain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran Rek.Lain
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal</label>
                                            <input type="date" id="email-id-vertical" class="form-control" name="tgl_pengeluaran_reklain">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Pengeluaran</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_reklain" placeholder="Contoh : Ongkir Furqon">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total_pengeluaran_reklain" class="form-control total_pengeluaran_reklain rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_pengeluaran_reklain" placeholder="Keterangan" id="floatingTextarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-pengeluaran-reklain">
                            <span class=" d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- MODAL PROYEK -->
        <div class="modal fade" id="modal_proyek" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Form Pengeluaran Proyek
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal</label>
                                            <input type="date" id="email-id-vertical" class="form-control" name="tgl_pengeluaran_proyek">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical text-sm">Pengeluaran</label>
                                            <input type="text" id="first-name-vertical" class="form-control" name="pengeluaran_proyek" placeholder="Contoh : Proyek Kandang">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Total</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                <input type="text" name="total_pengeluaran_proyek" class="form-control total_pengeluaran_proyek rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan</label>
                                            <textarea class="form-control" name="keterangan_pengeluaran_proyek" placeholder="Keterangan" id="floatingTextarea" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <span class="d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1 btn-sm" id="btn-pengeluaran-proyek">
                            <span class=" d-sm-block">Simpan</span>
                        </button>
                    </div>
                    </form>
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
                    'jenis_barang' : jenis_barang,
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
                    'jenis_barang' : jenis_barang,
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
                    'jenis_barang' : jenis_barang,
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
                    'jenis_barang' : jenis_barang,
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
                    'jenis_barang' : jenis_barang,
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