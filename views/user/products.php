<link rel="stylesheet" href="assets/css/product-list.css" />
<link rel="stylesheet" href="assets/css/modal.css" />
<link rel="stylesheet" href="assets/css/product.css" />
<script>
    var data = <?php echo json_encode($products, JSON_HEX_TAG); ?>;
</script>
<div class="container"></div>
<script src="assets/js/product.js"></script>
<script src="assets/js/product-list.js"></script>