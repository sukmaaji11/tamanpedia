<div class="page-heading">
    <div class="col-sm-2">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4> <i class="bi bi-person"></i> User</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add User</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" method="POST" action="<?= base_url('user/add') ?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">User ID</label>
                                    <div class="position-relative">
                                        <input type="number" class="form-control" placeholder="User ID" name="user_id" id="first-name-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-tag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Name" name="username" id="email-id-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="mobile-id-icon">User Role</label>
                                    <div class="position-relative">
                                        <input type="number" class="form-control" placeholder="Role" name="user_role" id="mobile-id-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" placeholder="Password" name="user_pin" id="password-id-icon">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class='form-check'>
                                    <div class="checkbox mt-2">
                                        <input type="checkbox" id="remember-me-v" class='form-check-input' checked>
                                        <label for="remember-me-v">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data User
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="table-user">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Id User</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">User PIN</th>
                                <th class="text-center">User Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
</div>

    <!-- Modal Delete-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                    <form class="form-horizontal">
                        <input type="hidden" name="user_id_delete">
                        Are you sure to delete <b><i><span id="user_fullname_delete"></span></i></b>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger ml-1" id="btn-delete-user">Delete</button>
                </div>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {
        $('.sidebar-item').removeClass('active');
        $('#sidebar-user').addClass('active');
        render();
    });


    //RENDER DATA
    function render() {
        $.ajax({
            url: '<?= base_url('user/get_data') ?>',
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
                if (response.length != 0) {
                    for (i = 0; i < response.length; i++) {
                        html += '<tr>';
                        html += '   <td class="text-center">' + no++ + '</td>';
                        html += '   <td class="text-center">' + response[i].user_id + '</td>';
                        html += '   <td class="text-center">' + response[i].username + '</td>';
                        html += '   <td class="text-center">' + response[i].user_pin + '</td>';
                        html += '   <td class="text-center">' + response[i].user_role + '</td>';
                        html += '   <td class="text-center">';
                        html += '       <button class="btn btn-danger btn-sm btn-delete-user" data-id="' + response[i].user_id + '">Delete</button>';
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
        $('#table-user').on('click', '.btn-delete-user', function() {
            var user_id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('user/get_data_by_id'); ?>',
                dataType: 'json',
                data: {
                    'user_id': user_id
                },
                success: function(response) {
                    console.log(response);
                    $('#delete_modal').modal('show');
                    $('input[name=user_id_delete]').val(response[0].user_id);
                    $('#user_fullname_delete').text(response[0].username);
                }
            })
        });

        //DELETE PROSES 
        $('#btn-delete-user').on('click', function() {
            var user_id = $('input[name=user_id_delete]').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('user/delete') ?>',
                data: {
                    'user_id': user_id
                },
                beforeSend: function() {
                    $('#load-data-process-delete').show();
                    $('#btn-delete-user').attr('disabled');
                },
                success: function(response) {
                    $('input[name=user_id_delete]').val("");
                    $('#user_fullname_delete').text("");
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