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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($accounts as $account) {
                    ?>
                        <tr onclick="triggred()" item-id=<?= $account->id ?>>
                            <td class="align-middle"><?= $account->name ?></td>
                            <td class="align-middle"><?= $account->email ?></td>
                            <td class="align-middle"><?= $account->phone ?></td>
                            <td class="align-middle"><?= $account->address ?></td>
                            <td class="align-middle"><?= $account->role ?></td>
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
        let contentPage = document.getElementsByClassName('container-fluid')[0];
        let btn = document.createElement("div");
        btn.classList.add("add-btn");
        btn.onclick = function() {
            window.location.href = "index.php?controller=AdminUser&action=addUser";
        }
        contentPage.appendChild(btn);
    }

    function triggred() {
        window.location.href = "index.php?controller=AdminUser&action=viewDetail&id=" + this.event.path[1].getAttribute('item-id');
    }
</script>