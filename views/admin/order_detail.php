<!-- Title -->
<div class="row justify-content-between">
    <h1 class="h3 ml-3 mb-0 text-gray-800">Order <?= $order->id ?></h1>
    <?php if (is_null($order->finished_time)) { ?>
        <a href="index.php?controller=AdminOrder&action=finishedOrder&id=<?= $order->id ?>&detail=True" class="btn btn-success btn-icon-split mr-3">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text mr-3 ml-3">Complete Order</span>
        </a>
    <?php } ?>
</div>
<hr class="sidebar-divider" />
<!-- Content -->
<div class="row justify-content-center">
    <div class="col-xl-8 col-md-12 text-gray-900">
        <!-- Field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-3 col-md-3 align-self-center">
                Customer
            </div>
            <div type="text" class="form-control form-control-user col-xl-8 col-md-6"><?= $user->name ?></div>
        </div>
        <!-- Field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-3 col-md-3 align-self-center">
                Order Address
            </div>
            <div type="text" class="form-control form-control-user col-xl-8 col-md-6"><?= $order->address ?></div>
        </div>
        <!-- Field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-3 col-md-3 align-self-center">
                Order Total Price
            </div>
            <div type="text" class="form-control form-control-user col-xl-8 col-md-6"><?= $order->total_price ?></div>
        </div>
        <!-- Field -->
        <div class="form-group row">
            <div class="h5 m-0 col-xl-3 col-md-3 align-self-center">
                Order Time
            </div>
            <div type="text" class="form-control form-control-user col-xl-8 col-md-6"><?= AdminOrderController::convertDate($order->order_time) ?></div>
        </div>
        <?php if (!is_null($order->finished_time)) { ?>
            <!-- Field -->
            <div class="form-group row">
                <div class="h5 m-0 col-xl-3 col-md-3 align-self-center">
                    Finished Time
                </div>
                <div type="text" class="form-control form-control-user col-xl-8 col-md-6"><?= AdminOrderController::convertDate($order->finished_time) ?></div>
            </div>
        <?php } ?>
    </div>
</div>
<hr class="sidebar-divider" />
<!-- Table -->
<!-- Custom styles for this page -->
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/css/custom-table.css" rel="stylesheet">

<!-- DataTales Example -->
<h1 class="h4 ml-3 mb-2 text-gray-800">Order Detail</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($order_items as $item) {
                    ?>
                        <tr onclick="triggred()" item-id=<?= $item['product_id'] ?>>
                            <td class="align-middle"><?= $item['product_name'] ?></td>
                            <td class="align-middle"><?= $item['price'] ?>$</td>
                            <td class="align-middle"><?= $item['quantity'] ?></td>
                            <td class="align-middle"><?= $item['total_price'] ?>$</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function triggred() {
        window.location.href = "index.php?controller=AdminProduct&action=viewDetail&id=" + this.event.path[1].getAttribute('item-id');
    }
</script>