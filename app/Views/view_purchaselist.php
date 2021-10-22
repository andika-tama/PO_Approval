<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9 p-5">
            <h2><?= $title_menu ?></h2>
            <hr>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <?= session()->getFlashdata('Alert') ?>
                </div>
            </div>
            <table class="table table-striped table-bordered hover table-sm" id="tb_product">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col" width="100px">Created By</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col" width="30px">Date Needed</th>
                        <th scope="col" width="30px">PM Approval</th>
                        <th scope="col" width="30px">GM Approval</th>
                        <th scope="col" width="30px">CFO Approval</th>
                        <!-- <th scope="col">Comment</th> -->
                        <th scope="col">Aksi</th>
                        <th scope="col" width="30px">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($purchasing_list as $pl) : ?>
                        <tr class="text-center">
                            <td class="text-center"><?= $pl['id'] ?></td>
                            <td class="text-start"><?= $pl['created_by'] ?></td>
                            <td class="text-end"><?= $pl['total_cost'] ?></td>
                            <td class="text-center"><?= $pl['date_needed'] ?></td>

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
                                <a href="/inventory/resubmit_purchase/<?= $pl['id'] ?>" class="btn btn-danger btn-sm bg-login border-login fw-bold <?= ($pl['status'] !== "Declined") ? "d-none" : "" ?>">Resubmit</a>
                            </td>
                            <td>
                                <a href="/inventory/detail_purchase_list/<?= $pl['id'] ?>" class="btn btn-primary btn-sm border-login fw-bold">Detail</a>
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