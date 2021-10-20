<div class="col-3">
    <div class="card">
        <div class="card-header">
            Menu
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="/inventory">Dashboard</a></li>
            <!-- cek untuk menu yg ditampilkan sesuai level -->
            <?php if (session()->get('level_user') == 1) : ?>
                <li class="list-group-item"><a href="/inventory/Submit_EmptyStock">Submiting Empty Stock</a></li>
            <?php endif; ?>

            <?php if (session()->get('level_user') == 2) : ?>
                <li class="list-group-item"><a href="/inventory/view_purchaselist">Purchase List</a></li>
                <li class="list-group-item"> <a href="/inventory/make_purchase">Make Purchase List</a></li>
            <?php endif; ?>
            <?php if (session()->get('level_user') == 3 || session()->get('level_user') == 4 || session()->get('level_user') == 5) : ?>
                <li class="list-group-item"> <a href="/inventory/approval_purchase/"> Konfirmasi PO </a></li>
            <?php endif; ?>
            <li class="list-group-item"><a href="/auth/logout">Logout</a></li>
        </ul>
    </div>
</div>