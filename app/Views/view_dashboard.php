<?php
// untuk tesk dalam card welcome!

if ($task !== 0) {
    if (session()->get('level_user') == 2) {
        $pesan = "Terdapat <b>" . $task . "</b> Barang Yang menunggu dibuatkan list loh! Jangan sampai terlewat!";
    } else if (session()->get('level_user') > 2) {
        $pesan = "Terdapat <b>" . $task . "</b> Purchasing List yang perlu kamu konfirmasi! Ayo buruan cek listnya!";
    }
} else {
    $pesan = "Selamat! Tugas Anda sudah selesai seluruhnya! Terima kasih atas kerja kerasnya!";
}
?>



<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9 p-5">

            <h2>Dashboard : <b class="sub-color"><?= session()->get('role') ?></b></h2>
            <hr>

            <?php if (session()->get('level_user') == 2) :  ?>
                <!-- untuk bagian purchasing! -->
                <div class="card border-login bg-white login-box bg-img-1">
                    <div class="container">
                        <div class="row login-box align-items-center">
                            <div class="col-7 p-5">
                                <h5 class="mb-3 login-color"> <b> Selamat datang, <?= session()->get('name') ?> </b></h5>
                                <h6 class="mb-4 sub-color"><?= $pesan ?></h6>

                                <a class="btn btn-danger bg-login border-login" href="/inventory/make_purchase">Lihat!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bagian purchasing -->
            <?php endif; ?>

            <?php if (session()->get('level_user') == 1) :  ?>
                <!-- bagian gudang -->
                <div class="card border-login bg-white login-box bg-img-2">
                    <div class="container">
                        <div class="row login-box align-items-center">
                            <div class="col-7 p-5">
                                <h5 class="mb-3 login-color"> <b> Selamat datang, <?= session()->get('name') ?> </b></h5>
                                <h6 class="mb-4 sub-color">Pastikan barang yang kosong sudah kamu ajukan! Jangan sampai terlambat!</h6>

                                <a class="btn btn-danger bg-login border-login" href="/inventory/submit_emptystock">Ajukan!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bagian gudang -->
            <?php endif; ?>

            <?php if (session()->get('level_user') == 3 || session()->get('level_user') == 4 || session()->get('level_user') == 5) :  ?>
                <!-- bagian manager -->
                <div class="card border-login bg-white login-box bg-img-3">
                    <div class="container">
                        <div class="row login-box align-items-center">
                            <div class="col-7 p-5">
                                <h5 class="mb-3 login-color"> <b> Selamat datang, <?= session()->get('name') ?> </b></h5>
                                <h6 class="mb-4 sub-color"><?= $pesan ?></h6>

                                <a class="btn btn-danger bg-login border-login" href="/inventory/approval_purchase">Lihat!</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- bagian manager -->
        </div>
    </div>
</div>


<!-- swall -->
<div class="d-none">
    <div class="flash-data-danger" data-flash="<?= session()->getFlashdata('Danger') ?>"></div>
    <div class="flash-data" data-flash="<?= session()->getFlashdata('Success') ?>"></div>
</div>

<?= $this->endSection() ?>