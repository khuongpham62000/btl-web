<!-- Custom styles for this page -->
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                    require_once('test.php');
                    // var_pre($orders);
                    foreach ($orders as $order) {
                        // var_pre($order);
                    ?>
                        <tr>
                            <td><?= $order->id ?></td>
                            <td><?= $order->address ?></td>
                            <td><?= $order->total_price ?>$</td>
                            <td><?= AdminOrderController::convertDate($order->order_time) ?></td>
                            <?php
                            if (is_null($order->finished_time)) {
                                echo '<td><a href="index.php?controller=AdminOrder&action=finishedOrder&id=' . $order->id . '">Finish order</a></td>';
                            } else echo '<td>' . AdminOrderController::convertDate($order->finished_time) . '</td>';

                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>