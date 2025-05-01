<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Taman Pedia</title>
    <link rel="stylesheet" href="<?= base_url('assets/template/mazer/css/main/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/mazer/css/pages/auth.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/image/logo-sn.png') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('assets/image/logo-sn.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/template/mazer/css/shared/iconly.css') ?>">
    <script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>

</head>

<body>
    <div id="auth">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div id="auth-left">
                                <img class="mx-auto d-block mb-5" src="<?= base_url('assets/image/logo-sn.png') ?>" height="100" width="130" />
                                <div class="auth-logo">
                                    <h1 class="title text-center">Taman</h1>
                                    <h1 class="title text-center">Pedia</h1>
                                </div>
                                <form method="post" action="<?= base_url('auth'); ?>">
                                    <?= $this->session->flashdata('message'); ?>
                                    <div class="form-group position-relative has-icon-left mb-4">
                                        <span><?= form_error('user_pin', '<small class="text-danger mb-1">', '</small>'); ?></span>
                                        <div class="input-group">
                                            <input type="password" pattern="[0-9]*" inputmode="numeric" class="form-control form-control-xl" placeholder="Password" name="user_id">
                                            <div class="form-control-icon">
                                                <i class="bi bi-shield-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                                </form>
                            </div>
                            <div class="text-center">
                                <p>2025 &copy; Jadicuan Developer V.01 Beta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>