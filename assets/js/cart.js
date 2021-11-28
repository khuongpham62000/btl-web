function toFixed(x) {
  return Number.parseFloat(x).toFixed(2);
}

var cartRow = (product, quantity) => {
  return `
<tr item-id="${product.id}" onclick="preview(event)">
  <td>${product.name}</td>
  <td>${product.price}</td>
  <td>${quantity}</td>
  <td>${toFixed(product.price * quantity)}</td>
</tr>
    `;
};

var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

function genCart() {
  let cartBody = $("#cart_body");
  cartBody.html("");
  let data = Cookies.get("cart");
  data = JSON.parse(data === undefined ? "{}" : data);
  let inCart = products.filter((item) => data[item.id] > 0);
  let total = 0;
  inCart.forEach((element) => {
    total += data[element.id] * element.price;
    cartBody.html(cartBody.html() + cartRow(element, data[element.id]));
  });
  $("#cart_total").html(toFixed(total));
}

function preview(event) {
  let row = event.path[0].tagName === "TD" ? event.path[1] : event.path[0];
  let rowId = row.getAttribute("item-id");
  let product = products.find((item) => item.id === rowId);
  if (!$(".preview").is(":visible")) {
    $("#modal-content").html(block(product));
    modal.style.opacity = "1";
    modal.style.zIndex = "2";
  } else {
    $(".preview").html(block(product));
  }
  loadProductFunction(genCart);
}

$(document).ready(() => {
  genCart();

  span.onclick = function () {
    modal.style.opacity = "0";
    modal.style.zIndex = "-1";
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.opacity = "0";
      modal.style.zIndex = "-1";
    }
  };
});
