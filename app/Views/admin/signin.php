<!DOCTYPE html>
<html lang="en">
<head>
    <title>Identify Image</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/fonts/fontawesome/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/animation/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

<div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch">
    <div class="row align-items-center w-100 align-items-stretch bg-white">
        <div class="d-none d-lg-flex col-md-8 aut-bg-img d-md-flex justify-content-center"></div>

        <div class="col-md-4 align-items-stret h-100 ad-flex justify-content-center">
            <div class="auth-content">
                <!-- <img src="<?= base_url('assets/images/logo-dark.svg') ?>" class="img-fluid mb-4"> -->
                <h2 class="mb-3 f-w-700">Drawing Game</h2>

                <!-- Flash Message -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="email" name="user_email" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group mt-2">
                        <div class="checkbox checkbox-primary d-inline">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" class="cr">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-4">Login</button>
                </form>

              
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="<?= base_url('assets/js/vendor-all.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

</body>
</html>