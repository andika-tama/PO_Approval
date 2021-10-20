<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid mt-5 mr-3">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-8">
            <h2>Daftar Purchase List</h2>
            <hr>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <?= session()->getFlashdata('Alert') ?>
                </div>
            </div>
            <table class="table table-striped" id="tb_product">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Date Ceated</th>
                        <th scope="col">Date Needed</th>
                        <th scope="col" width="30px">PM Approval</th>
                        <th scope="col" width="30px">GM Approval</th>
                        <th scope="col" width="30px">CFO Approval</th>
                        <!-- <th scope="col">Comment</th> -->
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($purchasing_list as $pl) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $pl['created_at'] ?></td>
                            <td><?= $pl['date_needed'] ?></td>
                            <td class="<?= ($pl['pm_approved'] == NULL) ? "text-warning" : "text-success" ?>">
                                <?= ($pl['pm_approved'] == NULL) ? "Waiting" : $pl['pm_approved'] ?>
                            </td>
                            <td class="<?= ($pl['gm_approved'] == NULL) ? "text-warning" : "text-success" ?>">
                                <?= ($pl['gm_approved'] == NULL && $pl['pm_approved'] == "Approved") ? "Waiting" : $pl['pm_approved'] ?>
                            </td>
                            <td class="<?= ($pl['cfo_approved'] == NULL) ? "text-warning" : "text-success" ?>">
                                <?= ($pl['cfo_approved'] == NULL && $pl['gm_approved'] == "Approved") ? "Waiting" : $pl['cfo_approved'] ?>
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


<?= $this->endSection() ?>