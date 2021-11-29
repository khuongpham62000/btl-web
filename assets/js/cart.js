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

var inputForm = () => {
  return user_id === -1
    ? `
  <div class="centered">
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Your Name below:</div>
        <input class="item_input" type="text" name="name" id="name" autocomplete="off">
    </div>
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Phone number below:</div>
        <input class="item_input" type="number" name="phone" id="phone">
    </div>
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Address below:</div>
        <input class="item_input" type="text" name="address" id="address">
    </div>
    <div class="total_row">
      <button id="order">Order</button>
    </div>
  </div>
  `
    : `
  <div class="centered">
    <div class="item_input col">
        <div style="padding-bottom: 1rem;text-align:center">Please add Address below:</div>
        <input class="item_input" type="text" name="address" id="address">
    </div>
    <div class="total_row">
      <button id="order">Order</button>
    </div>
  </div>
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

function inputAddress() {
  $("#modal-content").html(inputForm());
  modal.style.opacity = "1";
  modal.style.zIndex = "2";
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

  $("#confirm").on("click", (e) => {
    inputAddress();
    $("#order").on("click", (e) => {
      let address = $("#address").val();
      if (!(address === "")) {
        let data = Cookies.get("cart");
        data = JSON.parse(data === undefined ? "{}" : data);
        for (const key in data) {
          if (data[key] === 0) delete data[key];
        }
        var cartData;
        if (user_id === -1) {
          let name = $("#name").val();
          let phone = $("#phone").val();
          cartData = {
            data: data,
            address: address,
            name: name,
            phone: phone,
            user_id: user_id,
          };
        } else {
          cartData = {
            data: data,
            address: address,
            user_id: user_id,
          };
        }
        console.log(cartData);
        $.ajax({
          type: "POST",
          url: "index.php?controller=UserCart&action=order",
          data: cartData,
          success: function (data, status) {
            console.log(data);
            // data = JSON.parse(data);
          },
        });
      }
    });
  });
});
