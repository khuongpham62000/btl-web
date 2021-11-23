<!-- Custom styles for this page -->
<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/css/custom-table.css" rel="stylesheet">
<link href="assets/css/add-btn.css" rel="stylesheet">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <tr onclick="triggred()" item-id=<?= $product->id ?>>
                            <td class="align-middle"><?= $product->id ?></td>
                            <td class="align-middle"><?= $product->name ?></td>
                            <td class="align-middle"><?= $product->stock ?></td>
                            <td class="align-middle"><?= $product->price ?>$</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    window.onload = function(e) {
        console.log("hic");
        let contentPage = document.getElementById('accordionSidebar');
        let btn = document.createElement("div");
        btn.classList.add("add-btn");
        btn.onclick = function() {
            window.location.href = "index.php?controller=AdminProduct&action=addProduct";
        }
        contentPage.appendChild(btn);
    }

    function triggred() {
        window.location.href = "index.php?controller=AdminProduct&action=viewDetail&id=" + this.event.path[1].getAttribute('item-id');
    }
</script>