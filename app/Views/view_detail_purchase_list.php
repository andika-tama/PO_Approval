<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9 p-5">
            <h2>Detail Purchasing List</h2>
            <hr>
            <div class="card">
                <div class="card-header bg-login text-white text-center">
                    Detail Purchase List
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- baris pertama : Keterangan tanggal dan COST -->
                        <div class="row mt-3">
                            <!-- keterangan PL (tanggal dan pengaju) -->
                            <div class="col-7">
                                <div class="container">
                                    <!-- keterangan pengaju -->
                                    <div class="row">
                                        <div class="col-5"> Pengaju </div>
                                        <div class="col-1"> : </div>
                                        <div class="col-6"> <b><?= $purchase['created_by'] ?></b></div>
                                    </div>
                                    <!-- tanggal Pengajuan PL -->
                                    <div class="row mt-3">
                                        <div class="col-5">Tanggal Pengajuan</div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><b><?= $purchase['created_at'] ?> </b></div>
                                    </div>
                                    <!-- tanggal pengajuan -->
                                    <div class="row mt-3">
                                        <div class="col-5">Tanggal Dibutuhkan</div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><b><?= $purchase['date_needed'] ?></b></div>
                                    </div>
                                    <!-- keterangan pilih produk -->
                                    <div class="row mt-3">
                                        <div class="col-5">Produk Dalam List</div>
                                        <div class="col-1">:</div>
                                    </div>
                                </div>
                            </div>
                            <!-- total cost -->
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-cost">
                                        <h2>Total Cost (Rp) :</h2>
                                        <div class="total-cost text-danger m-4"><?= $purchase['total_cost'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- tabel pPrudcit dalam Purchase List -->
                        <div class="row mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped" id="tb_product">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">Prority</th>
                                                <th scope="col">Quantity Needed</th>
                                                <th scope="col">Date Needed</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Product Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dataSub as $s) : ?>
                                                <tr>
                                                    <!-- check box select product -->
                                                    <td class="text-center"><?= $s['priority'] ?></td>
                                                    <td class="text-center"><?= $s['quantity'] ?></td>
                                                    <td class="text-center"><?= $s['date_needed'] ?></td>
                                                    <td class=""><?= $s['total_price'] ?></td>
                                                    <td class=""><?= $s['name_product'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- keterangan approval -->
                        <div class="card text-center mt-3">
                            <div class="card-header bg-login text-white fw-bold">
                                Status Approval
                            </div>
                            <div class=" card-body">
                                <img src="/img/<?= $purchase['status'] ?>.png" alt="" class=" img-status">
                                <h2 class="sub-color fw-bold"><?= $purchase['status'] ?></h2>
                            </div>
                        </div>

                    </div>

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