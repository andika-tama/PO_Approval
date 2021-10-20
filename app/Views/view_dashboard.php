<?= $this->extend('template'); ?>

<?php $this->section('content') ?>

<div class="container-fluid mt-5">
    <div class="row">
        <?= $this->include('sidebar') ?>
        <div class="col-9">
            <h2>Dashboard</h2>
            <hr>

            something...
        </div>
    </div>
</div>

<?= $this->endSection() ?>