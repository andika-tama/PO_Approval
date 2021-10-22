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

<div class="container-fluid">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9 p-5">
            <h2>Approval Purchase List</h2>
            <hr>
            <table class="table table-striped table-bordered table-sm" id="tb_product">
                <thead>
                    <tr class="text-center">
                        <th scope="col" width="30px">No</th>
                        <th scope="col">Created by</th>
                        <th scope="col">Total Cost</th>
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
                            <td class="text-start"><?= $pl['created_by'] ?></td>
                            <td class="text-end"><?= $pl['total_cost'] ?></td>
                            <td class="text-end"><?= $pl['date_needed'] ?></td>
                            <td class="">
                                <a class="btn btn-success border-login fw-bold btn-sm approval-button" href="/inventory/approving_list/<?= $pl['id'] ?>">Approve</a>
                                <a class="btn btn-danger border-login fw-bold btn-sm decline-button" href="/inventory/declining_list/<?= $pl['id'] ?>">Decline</a>
                            </td>
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