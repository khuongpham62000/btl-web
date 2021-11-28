<link rel="stylesheet" href="assets/css/product.css" />
<link rel="stylesheet" href="assets/css/modal.css" />
<link rel="stylesheet" href="assets/css/cart.css" />
<script>
  var products = <?php echo json_encode($products, JSON_HEX_TAG); ?>;
</script>
<div class="container">
  <div class="preview">
    <div class="preview-default">No Item Selected</div>
  </div>
  <div class="cart_table">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody id="cart_body"></tbody>
      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td>Total</td>
          <td id="cart_total">0</td>
        </tr>
      </tfoot>
    </table>
    <div class="total_row">
      <button id="confirm">Confirm</button>
    </div>
  </div>
</div>
<script src="assets/js/product.js"></script>
<script src="assets/js/cart.js"></script>