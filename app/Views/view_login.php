<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid justify-content-center">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-4 border-top border-left border-bottom rounded-left bg-white form-login d-flex login-box justify-content-center align-items-center" style="min-height: 450px;">
            <div class="container bg-white">
                <div class="row">
                    <div class="col-12">
                        <div class=" text-center pb-4">
                            <div class="login-color title-login">Login!</div>
                        </div>
                        <form action="/auth/login" class="form-login" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-12 pb-3">
                                    <input type="text" class="form-control border-login" id="username" aria-describedby="emailHelp" placeholder="Username" required name="username" value="<?= old('username', NULL); ?>">
                                </div>
                                <div class="form-group pb-3">
                                    <input type="password" class="form-control border-login" id="password" placeholder="password" required name="password" value="<?= old('password', NULL); ?>">
                                </div>
                                <div class="form-group d-grid gap-2">
                                    <button class="btn btn-danger bg-login border-login" type="submit">Login!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-none d-md-block border-top border-right border-bottom login-box hero-login bg-white">
        </div>
    </div>
</div>

<!-- swall -->
<div class="d-none">
    <div class="flash-data-danger" data-flash="<?= session()->getFlashdata('Danger') ?>"></div>
    <div class="flash-data" data-flash="<?= session()->getFlashdata('Success') ?>"></div>
</div>

<?= $this->endSection(); ?>