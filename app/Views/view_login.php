<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>
<div class="container justify-content-center mt-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> <b>Please Sign In!</b> </div>
                <div class="card-body">
                    <div class="row mb-3 mt-3">
                        <div class="col">
                            <?= session()->getFlashdata('Alert') ?>
                        </div>
                    </div>
                    <form action="/auth/login" class="form-login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username" required name="username" value="<?= old('username', NULL); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="password" required name="password" value="<?= old('password', NULL); ?>">
                        </div>
                        <button class="btn btn-primary btn-spinner d-none" type="button" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                        <button class="btn btn-primary btn-login" type="submit">Login!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="box-confirm"> -->

    <!-- </div> -->
</div>

<?= $this->endSection(); ?>