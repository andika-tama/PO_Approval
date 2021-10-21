<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9 p-5">
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
                            <td><?= $pl['id'] ?></td>
                            <td><?= $pl['created_at'] ?></td>
                            <td><?= $pl['date_needed'] ?></td>

                            <?php
                            switch ($pl['pm_approved']) {
                                case "Approved":
                                    $textColor = "bg-success";
                                    break;

                                case "Declined":
                                    $textColor = "bg-danger";
                                    break;
                                case "Waiting":
                                    $textColor = "bg-warning";
                                    break;
                            }
                            ?>
                            <td>
                                <span class="badge rounded-pill <?= $textColor ?>">
                                    <?= $pl['pm_approved']; ?>
                                </span>
                            </td>
                            <?php
                            switch ($pl['gm_approved']) {
                                case "Approved":
                                    $textColor = "bg-success";
                                    break;

                                case "Declined":
                                    $textColor = "bg-danger";
                                    break;
                                case "Waiting":
                                    $textColor = "bg-warning";
                                    break;
                            }
                            ?>
                            <td>
                                <span class="badge rounded-pill <?= $textColor ?> <?= ($pl['gm_approved'] == NULL) ? "d-none" : "" ?> ">
                                    <?= $pl['gm_approved']; ?>
                                </span>
                            </td>
                            <?php
                            switch ($pl['cfo_approved']) {
                                case "Approved":
                                    $textColor = "bg-success";
                                    break;

                                case "Declined":
                                    $textColor = "bg-danger";
                                    break;
                                case "Waiting":
                                    $textColor = "bg-warning";
                                    break;
                            }
                            ?>
                            <td>
                                <span class="badge rounded-pill <?= $textColor ?> <?= ($pl['cfo_approved'] == NULL) ? "d-none" : "" ?>">
                                    <?= $pl['cfo_approved']; ?>
                                </span>
                            </td>
                            <td>
                                <a href="/inventory/resubmit_purchase/<?= $pl['id'] ?>">Ajukan Ulang</a>
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