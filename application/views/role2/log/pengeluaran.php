    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="100">
                    </div>
                    <h3>Pengeluaran</h3>
                    <p class="text-subtitle text-muted">Pengeluaran Tamanpedia</p>
                </div>
            </div>
        </div>
        <!-- <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kategori</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" method="POST" action="<?= base_url('app/add_kategori') ?>">
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="kategori" placeholder="Kategori" required>
                            <div class="form-control-icon">
                                <i class="bi bi-tag"></i>
                            </div>
                        </div>
                        <div style="float: right;">
                            <button type="submit" class="btn btn btn-success">+ Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr />
            -->
        <!-- Section 2 -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Log Data Pengeluaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-xs text-nowrap" id="table-pengeluaran">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl</th>
                                <th>Pengeluaran</th>
                                <th>Kategori</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </section>

        <!-- Modal Delete-->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete Pengeluaran</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <!-- FORM -->
                        <form class="form-horizontal">
                            <input type="hidden" name="pengeluaran_id_delete">
                            Are you sure to delete <b><i><span id="pengeluaran_delete"></span></i></b>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger ml-1" id="btn-delete-pengeluaran">Delete</button>
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
            $('#sidebar-pengeluaran').addClass('active');
            render();
        });

        //RENDER DATA
        function render() {
            $.ajax({
                url: '<?= base_url('pengeluaran/get_data') ?>',
                async: true,
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {},
                complete: function() {

                },
                success: function(response) {
                    var i;
                    var no = 1;
                    var html = '';
                    if ($.fn.DataTable.isDataTable('#table-pengeluaran')) {
                        $('#table-pengeluaran').DataTable().destroy();
                    }
                    if (response.length != 0) {
                        for (i = 0; i < response.length; i++) {
                            html += '<tr>';
                            html += '   <td class="text-xs" style="width:10%;">' + no++ + '</td>';
                            html += '   <td class="text-xs">' + response[i].pengeluaran_tgl + '</td>';
                            html += '   <td class="text-xs">' + response[i].pengeluaran + '</td>';
                            html += '   <td class="text-xs">' + response[i].pengeluaran_kategori + '</td>';
                            html += '   <td class="text-xs">Rp. ' + formatRupiah(response[i].pengeluaran_total) + '</td>';
                            html += '   <td class="text-xs">';
                            html += '       <button class="btn btn-danger btn-sm btn-delete-pengeluaran" data-id="' + response[i].pengeluaran_id + '">Delete</button>';
                            html += '   </td>';
                            html += '</tr>';
                        }
                        $('#table-data').html(html);
                        $('#table-pengeluaran').DataTable({
                            paging: false,
                        });

                    } else {
                        $('#table-data').html(response);
                    }
                }
            });
        }

        //DELETE 
        $('#table-pengeluaran').on('click', '.btn-delete-pengeluaran', function() {
            var pengeluaran_id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',

                url: '<?= base_url('pengeluaran/get_data_by_id'); ?>',
                dataType: 'json',
                data: {
                    'pengeluaran_id': pengeluaran_id
                },
                success: function(response) {
                    console.log(response);
                    $('#delete_modal').modal('show');
                    $('input[name=pengeluaran_id_delete]').val(response[0].pengeluaran_id);
                    $('#pengeluaran_delete').text(response[0].pengeluaran);
                }
            })
        });

        //DELETE PROSES 
        $('#btn-delete-pengeluaran').on('click', function() {
            var pengeluaran_id = $('input[name=pengeluaran_id_delete]').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('pengeluaran/delete') ?>',
                data: {
                    'pengeluaran_id': pengeluaran_id
                },
                beforeSend: function() {
                    $('#load-data-process-delete').show();
                    $('#btn-delete-pengeluaran').attr('disabled');
                },
                success: function(response) {
                    alert('Data Berhasil Dihapus!');
                    location.reload();
                },
                error: function() {
                    alert('Error Proses');
                }
            })
        })

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