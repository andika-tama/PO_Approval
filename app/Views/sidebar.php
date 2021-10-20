<div class="col-3 sidebar-red p-0">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 icon-sb">
            </div>
            <hr class="bg-white">
            <div class="col-12 menubar d-flex align-items-center">
                <a href="/inventory">Dashboard</a>
            </div>
            <?php if (session()->get('level_user') == 1) : ?>
                <div class="col-12 menubar d-flex align-items-center">
                    <a href="/inventory/Submit_EmptyStock">Submiting Empty Stock</a>
                </div>
            <?php endif; ?>
            <?php if (session()->get('level_user') == 2) : ?>
                <div class="col-12 menubar d-flex align-items-center">
                    <a href="/inventory/view_purchaselist">Purchase List</a>
                </div>
                <div class="col-12 menubar d-flex align-items-center">

                    <a href="/inventory/make_purchase">Make Purchase List</a>
                </div>
            <?php endif; ?>
            <?php if (session()->get('level_user') == 3 || session()->get('level_user') == 4 || session()->get('level_user') == 5) : ?>
                <div class="col-12  menubar d-flex align-items-center">
                    <a href="/inventory/approval_purchase/"> Konfirmasi PO </a>
                </div>
            <?php endif; ?>

            <div class="col-12  menubar d-flex align-items-center">
                <a href="/auth/logout">Logout</a>
            </div>
        </div>
    </div>

</div>