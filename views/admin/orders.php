<!-- Custom styles for this page -->
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/css/custom-table.css" rel="stylesheet">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Order Time</th>
                        <th>Finished</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Order Time</th>
                        <th>Finished</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                    ?>
                        <tr onclick="triggred()" item-id=<?= $order->id ?>>
                            <td class="align-middle"><?= $order->id ?></td>
                            <td class="align-middle"><?= $order->address ?></td>
                            <td class="align-middle"><?= $order->total_price ?>$</td>
                            <td class="align-middle"><?= AdminOrderController::convertDate($order->order_time) ?></td>

                            <?php
                            if (is_null($order->finished_time) || strcmp($order->finished_time, "0000-00-00 00:00:00") == 0) {
                            ?>
                                <td class="align-middle p-0 pl-3 pr-3"><a href="index.php?controller=AdminOrder&action=finishedOrder&id=<?= $order->id ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50 align-middle">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Complete</span>
                                    </a>
                                </td>
                            <?php
                            } else echo '<td>' . AdminOrderController::convertDate($order->finished_time) . '</td>';
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function triggred() {
        window.location.href = "index.php?controller=AdminOrder&action=viewDetail&id=" + this.event.path[1].getAttribute('item-id');
    }
</script>