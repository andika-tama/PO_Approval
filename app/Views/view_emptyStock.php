<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<!-- cek tabel submission -->
<?php
$db      = \Config\Database::connect();
$builder = $db->table('submission');
?>

<div class="container-fluid">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9 p-5">
            <h2>Ajukan Stock Kosong!</h2>
            <hr>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <?= session()->getFlashdata('Alert') ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProduct">
                        Add Product
                    </button>
                </div>
            </div>
            <table class="table" id="tb_product">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Pilih Product</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Priority</th>
                        <th scope="col" width="30px">Quantity</th>
                        <th scope="col">Date Needed</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($product as $p) :
                        // cek apakah product dalam pengajuan
                        $query = $builder->select('*')->where('id_product', $p['id'])->get()->getNumRows();
                    ?>
                        <tr>
                            <!-- check box select product -->
                            <td scope="row" class="text-center">
                                <input name="id" type="checkbox" value="<?= $p['id'] ?>" class="select-product" <?= ($query > 0) ? "disabled" : "" ?>>
                            </td>

                            <form action="/inventory/submit_data" method="POST">
                                <input type="hidden" name="id_product" value="<?= $p['id'] ?>">
                                <td><?= $p['name_product'] ?></td>
                                <td class="text-center">
                                    <input type="checkbox" name="priority" value="YES" class="product-<?= $p['id'] ?>" disabled>
                                </td>
                                <td class="text-center">
                                    <input type="number" class="form-control product-<?= $p['id'] ?>" name="quantity" min="1" disabled required>
                                </td>
                                <td class="text-center">
                                    <input type="date" name="date_needed" class="form-control product-<?= $p['id'] ?>" disabled required>
                                </td>
                                <td class="text-center">
                                    <div class="d-grid gap-2">
                                        <button type="submit" name="submit" class="btn <?= ($query > 0) ? "btn-warning" : "btn-primary" ?>  product-<?= $p['id'] ?>" disabled> <?= ($query > 0) ? "Dalam Pengajuan" : "Ajukan Pembelian" ?> </button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4"></div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="AddProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="/inventory/add_product" method="POST">
                        <div class="row">
                            <div class="col-4">
                                <label for="name_product">Nama Barang</label>
                            </div>
                            <div class="col-8">

                                <input type="text" name="name_product" placeholder="Name Product..." class="form-control" id="name_product">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                <label for="price">Hariga Satuan</label>
                            </div>
                            <div class="col-8">

                                <input type="number" name="price" placeholder="Price Product..." class="form-control" id="price">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Product!</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- swall -->
<div class="d-none">
    <div class="flash-data-danger" data-flash="<?= session()->getFlashdata('Danger') ?>"></div>
    <div class="flash-data" data-flash="<?= session()->getFlashdata('Success') ?>"></div>
</div>

<?= $this->endSection() ?>