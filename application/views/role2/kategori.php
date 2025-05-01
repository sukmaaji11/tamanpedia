    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="text-center">
                    <div class="d-block">
                        <img src="<?= base_url('assets/image/logo-sn.png') ?>" alt="Logo" width="100" height="75">
                    </div>
                    <h3>Kategori</h3>
                    <p class="text-subtitle text-muted">Kagegori Tamanpedia</p>
                </div>
            </div>
        </div>
        <section class="section">
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
                        <div class="form-group position-relative has-icon-left">
                             <select class="form form-select" name="kategori_role" id="kategori_role">
                                    <option value="">--Pilih Jenis Kategori--</option>
                                    <option value=1>Pemasukan</option>
                                    <option value=2>Pengeluaran</option>
                            </select>
                        </div>
                        <div style="float: right;">
                            <button type="submit" class="btn btn btn-success">+ Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr />

            <!-- Section 2 -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">List Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-lg" id="table-kategori">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Jenis</th>
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
    </div>
    </div>
    </div>
    <!-- Modal Delete-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Delete Kategori</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                    <form class="form-horizontal">
                        <input type="hidden" name="kategori_id_delete">
                        Are you sure to delete <b><i><span id="kategori_delete"></span></i></b>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger ml-1" id="btn-delete-kategori">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.sidebar-item').removeClass('active');
            $('#sidebar-kategori').addClass('active');
            render();
        });

        //RENDER DATA
        function render() {
            $.ajax({
                url: '<?= base_url('app/get_data_kategori') ?>',
                async: true,
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {},
                complete: function() {

                },
                success: function(response) {
                    var i;
                    var html = '';
                    if (response.length != 0) {
                        for (i = 0; i < response.length; i++) {
                            html += '<tr>';
                            html += '   <td class="">' + response[i].kategori + '</td>';
                            if(response[i].kategori_role = 1) {
                                html += '<td class="">Pemasukan</td>';
                            } else  {
                                html += '<td class="">Pengeluaran</td>';
                            }
                            html += '   <td class="">';
                            html += '       <button class="btn btn-danger btn-sm btn-delete-kategori" data-id="' + response[i].kategori_id + '">Delete</button>';
                            html += '   </td>';
                            html += '</tr>';
                        }
                        $('#table-data').html(html);
                    } else {
                        $('#table-data').html(response);
                    }
                }
            });
        }

        //DELETE 
        $('#table-kategori').on('click', '.btn-delete-kategori', function() {
            var kategori_id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',

                url: '<?= base_url('app/get_data_by_id_kategori'); ?>',
                dataType: 'json',
                data: {
                    'kategori_id': kategori_id
                },
                success: function(response) {
                    console.log(response);
                    $('#delete_modal').modal('show');
                    $('input[name=kategori_id_delete]').val(response[0].kategori_id);
                    $('#kategori_delete').text(response[0].kategori);
                }
            })
        });

        //DELETE PROSES 
        $('#btn-delete-kategori').on('click', function() {
            var kategori_id = $('input[name=kategori_id_delete]').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('app/delete_kategori') ?>',
                data: {
                    'kategori_id': kategori_id
                },
                beforeSend: function() {
                    $('#load-data-process-delete').show();
                    $('#btn-delete-kategori').attr('disabled');
                },
                success: function(response) {
                    $('input[name=kategori_id_delete]').val("");
                    $('#kategori_delete').text("");
                    $('#delete_modal').modal('hide');
                    alert('Data Berhasil Dihapus!');
                    render();
                },
                error: function() {
                    alert('Error Proses');
                }
            })
        })
    </script>