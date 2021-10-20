<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid mt-5 mr-3">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-8">
            <h2>Buat Purchase List</h2>
            <hr>

            <div class="row mb-3 mt-3">
                <div class="col">
                    <?= session()->getFlashdata('Alert') ?>
                </div>
            </div>
            <form action="/inventory/make_purchaseList" method="POST">
                <div class="card">
                    <div class="card-header">
                        Make Purchase List!
                    </div>
                    <div class="card-body">

                        <input type="hidden" value="<?= session()->get('id') ?>">
                        <div class="container-fluid">
                            <div class="row mt-3">
                                <div class="col-3">
                                    Pengaju
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-3">
                                    <b><?= session()->get('name') ?></b>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                    Tanggal Pengajuan
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-3">
                                    <b><?= date("Y/m/d") ?> </b>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                    Tanggal Dibutuhkan
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                                <div class="col-3">
                                    <input type="date" name="date_needed">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                    Pilih Product
                                </div>
                                <div class="col-1">
                                    :
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table" id="tb_product">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Pilih Product</th>
                                                    <th scope="col">Prority</th>
                                                    <th scope="col">Quantity Needed</th>
                                                    <th scope="col">Date Needed</th>
                                                    <th scope="col">Product Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($submission as $s) : ?>
                                                    <tr>
                                                        <!-- check box select product -->
                                                        <td scope="row" class="text-center">
                                                            <input name="id[]" type="checkbox" value="<?= $s['id'] ?>">
                                                        </td>
                                                        <td class="text-center"><?= $s['priority'] ?></td>
                                                        <td class="text-center"><?= $s['quantity'] ?></td>
                                                        <td class="text-center"><?= $s['date_needed'] ?></td>
                                                        <td class=""><?= $s['name_product'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class="btn btn-primary"> Buat Purchase List</button>
                        </div>
                    </div>
            </form>
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