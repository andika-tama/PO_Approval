<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<?php
switch (session()->get('level_user')) {

    case 3:
        $name = "PM Approval";
        break;
    case 4:
        $name = "GM Approval";
        break;
    case 5:
        $name = "CFO Approval";
        break;
}
?>

<div class="container-fluid mt-5 mr-3">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-8">
            <h2>Daftar Purchase List</h2>
            <hr>
            <table class="table table-striped" id="tb_product">
                <thead>
                    <tr class="text-center">
                        <th scope="col" width="30px">No</th>
                        <th scope="col">Date Ceated</th>
                        <th scope="col">Date Needed</th>
                        <th scope="col"><?= $name ?></th>
                        <!-- <th scope="col">Comment</th> -->
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($purchasing_list as $pl) : ?>
                        <tr class="text-center">
                            <td><?= $i++ ?></td>
                            <td><?= $pl['created_at'] ?></td>
                            <td><?= $pl['date_needed'] ?></td>
                            <td class="<?= ($pl['pm_approved'] == NULL) ? "text-warning" : "text-success" ?>">
                                <a class="btn btn-primary" href="/inventory/approving_list/<?= $pl['id'] ?>">Approve</a>
                                <button class="btn btn-danger">Declined</button>
                            </td>
                            </td>
                            <td>
                                <a href="#">Lihat Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<div class="row mt-4"></div>
</div>

<!-- swall -->
<div class="d-none">
    <div class="flash-data-danger" data-flash="<?= session()->getFlashdata('Danger') ?>"></div>
    <div class="flash-data" data-flash="<?= session()->getFlashdata('Success') ?>"></div>
</div>

<?= $this->endSection() ?>